<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\BlogContent;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\EditBlogRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\TalentCatagory;
use App\Models\Tag;
use App\Models\Blog_tag;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Session;
use Storage;
use Response;

class BlogController extends Controller
{

    /*** Display a listing of the resource.** @return \Illuminate\Http\Response*/
    public function index(Request $request)
    {
       
    $blogs = [];
    $categories = [];
    $search = $request['search'] ?? "";

    // Adjust this query to filter only guest blogs by adding your specific condition
    $query = BlogContent::where('blog_role', 'admin') // Assuming 'role' column indicates 'guest'
                        ->with(['getBlogCatagories', 'getBlogComments'])
                        ->orderBy('id', 'DESC');

    if ($search != '') {
        $query->where(function($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('author_first_name', 'LIKE', "%{$search}%");
        });
    }

    $blogs = $query->paginate(200);
    $blog_count = $query->count();
     $categories = TalentCatagory::all();

          return view('admin.blog.index', compact('blogs' , 'categories','blog_count'));
      }

    /*** Show the form for creating a new resource.** @return \Illuminate\Http\Response*/
    public function create()
    {
        $talent_categories = [];
        $talent_categories = TalentCatagory::all();
        $allAuthors = [];
        $allAuthors = DB::select("SELECT * FROM authors");
        // echo $allAuthors;
        return view('admin.blog.create-blog' , compact('talent_categories', 'allAuthors') );
    }

    /*** Store a newly created resource in storage.** @param  \Illuminate\Http\Request  $request* @return \Illuminate\Http\Response*/
    public function store(BlogStoreRequest $request)
    {
      
        
        if($request->has('feature_image')) 
        { 
            $file = $request->file('feature_image');
            $extension = $file->extension();
            $file_name = md5($file->getClientOriginalName()). '.' .$extension;

            $path_name = 'blog-media/'.$file_name;
            $file->move('blog-media/', $file_name);
        } 
        else 
        {
            $path_name = 'blog-media/default-ad-banner.png';
        }
        $image_data = $request['encode_image'];
          if(!empty($image_data)) 
          {
                $image_array_1 = explode(";", $image_data);
                $image_array_2 = explode(",", $image_array_1[1]);
                $data = base64_decode($image_array_2[1]);
                $image_name = time().$request['author_first_name']. '.png';
                $upload_path = public_path('blog-media/' . $image_name);
                file_put_contents($upload_path, $data);
                $_author_path_name = 'blog-media/' . $image_name;
          } 
          else 
          {
               $_author_path_name = asset('assets/images/default-ad-banner.png');
          }
          $token = dechex(mt_rand(1, pow(16, 12) - 1));
          $category_name = TalentCatagory::where('id', $request->category)->pluck('name')->first();
          $blog_array = [
            'cat_id' => $request['category'],
            'title' => $request['meta-tags'],
            'slug' => \Str::slug($request['meta-tags'], '-'),
            'canonical_url' => route('blog.index'). '/'. $category_name. '/' .\Str::slug($request['meta-tags'], '-'),
            'blog_img' => $path_name,
            'blog_video' => '',
            'content' => $request['content'],
            'author_image' => $_author_path_name,
            'author_first_name' => $request['author_first_name'],
            'author_last_name' => $request['author_last_name'],
            'author_token'=> $token,
            'meta_tags' => $request['meta-tags'],
            'alt'=> $request['alt-tags'],
            'meta_keywords' => $request['meta-keywords'],
            'meta_description' => $request['meta-description'],
            'blog_status' => ($request->has('draft')) ? 0 : 1 ,
            'date' => Carbon::now(),
            'created_by' => Auth::user()->id
        ];

        $created  = BlogContent::insert($blog_array);
        // $token = dechex(mt_rand(1, pow(16, 12) - 1));
        $author_name = DB::select("SELECT * FROM authors WHERE author_name = ?",  [$blog_array['author_last_name']]);
        if($author_name){
            $firstAuthor = reset($author_name);
            $authorToken = $firstAuthor->author_token;
            $subscribedUsersOfAuthor = DB::select("SELECT email FROM blog_subscriptions WHERE author_token = ?", [$authorToken]);
            // var_dump($subscribedUsersOfAuthor);
            foreach ($subscribedUsersOfAuthor as $subscriber) {
                $email = $subscriber->email;
                
                // Email content
                $content = "Thank you for subscribing to our blog!";
                
                // Send email
                Mail::raw($content, function ($message) use ($email) {
                    $message->to($email)
                            ->subject('Subscription Confirmation');
                });
            }
        }else{
        $authorCreate = DB::select("INSERT INTO authors (author_name, author_token) VALUES (?, ?)", [$blog_array['author_last_name'], $token]);
        }

        if(!empty($created)) 
        {
            Session::flash('success' , 'Blog created successfully.');
            return redirect( route('admin.blog') );
        } 
        else 
        {
            Session::flash('error' , 'Technical error.');
            return redirect( route('admin.blog') );
        }
  
    }

    /*** Display the specified resource.** @param  int  $id* @return \Illuminate\Http\Response*/
    public function show($id)
    {
      //
    }

    /*** Show the form for editing the specified resource.** @param  int  $id* @return \Illuminate\Http\Response*/
    public function edit($id)
    {    
         $start = microtime(true);
         $blog = [];
         $blog = BlogContent::with(['blog_tag'])->find($id);
         if(empty($blog)) 
         {
            return redirect(route('admin.blog'));
         }
         $time = microtime(true) - $start;
         $talent_categories = [];
         $talent_categories = TalentCatagory::all();
      return view('admin.blog.edit-blog' , compact('talent_categories', 'blog'));
    }

    /*** Update the specified resource in storage.** @param  \Illuminate\Http\Request  $request* @param  int  $id* @return \Illuminate\Http\Response*/
    public function tinyblogUpdate(EditBlogRequest $request, $id)
    {
     
        if($request->has('feature_image')) 
        {
            $file = $request->file('feature_image');
               
            $extension = $file->extension();
            $file_name = md5($file->getClientOriginalName()). '.' .$extension;
                
            $path_name = 'blog-media/'.$file_name;
            $file->move('blog-media/', $file_name);
          if($request['previous_image'] !='' && file_exists($request['previous_image']))
          {
            unlink($request['previous_image']);
          } 
        } 
        else 
        {
           $path_name = $request['previous_image'];
        }
           $image_data = $request['encode_image'];
               
        if(!empty($image_data)) 
        {
           $image_array_1 = explode(";", $image_data);
           $image_array_2 = explode(",", $image_array_1[1]);
           $data = base64_decode($image_array_2[1]);
           $image_name = time().$request['author_first_name']. '.png';
           $upload_path = public_path('blog-media/' . $image_name);
           file_put_contents($upload_path, $data);
           $_author_path_name = 'blog-media/' . $image_name;
        } 
        else 
        {
           $_author_path_name = $request['previous_author'];
        }

        $blog = BlogContent::find($id);
        $category_name = TalentCatagory::where('id', $request->category)->pluck('name')->first();
        $blog_array = [
                'cat_id' => $request['category'],
                'title' => $request['meta-tags'],
                'slug' => \Str::slug($request['meta-tags'], '-'),
                'canonical_url' => route('blog.index'). '/'. $category_name. '/' .\Str::slug($request['meta-tags'], '-'),
                'blog_img' => $path_name,
                'blog_video' => '',
                'content' => $request['content'],
                'author_image' => $_author_path_name,
                'author_first_name' => $request['author_first_name'],
                'author_last_name' => $request['author_last_name'],
                'meta_tags' => $request['meta-tags'],
                'alt'       => $request['alt-tags'],
                'meta_keywords' => $request['meta-keywords'],
                'meta_description' => $request['meta-description'],
                'blog_status' => ($request->has('draft')) ? 0 : 1 ,
                'date' => $blog['date'],
                'updated_by' => Auth::user()->id
            ];

        $created  = BlogContent::where('id', '=', $id)->update($blog_array);
        if(!empty($created)) 
        {            
            Session::flash('success' , 'Blog updated successfully.');
            return redirect( route('admin.blog') );
        } 
        else 
        {
            Session::flash('error' , 'Technical error.');
            return redirect( route('admin.blog') );
        }
    }

    /*** Remove the specified resource from storage.** @param  int  $id* @return \Illuminate\Http\Response*/
    public function destroy($id)
    {
        if(!empty($id)) 
        {
            $find_blog = BlogContent::find($id);
            $image = asset($find_blog['blog_img']);
            if(file_exists($image)) 
            {
                 unlink($image);
            }
            $deleted = BlogContent::destroy($id);
            if(!empty($deleted) ) 
            {
                $response = ['success' => 'Blog deleted successfully!'];
                return Response::json($response);
            } 
            else 
            {
                $response = ['error' => 'Technical error.'];
                return Response::json($response);
            }
        }
    }

     /*** Remove the specified bulk resource from storage.** @param  int  $id* @return \Illuminate\Http\Response*/
    public function bulk_delete(Request $request)
    {
        if($request->ajax()) 
        {
            $blogId =  $request['ids'];
            $deleted = BlogContent::WhereIn('id', $blogId)->delete();
             if (!empty($deleted)) 
             {
                $response = ['success' => 'Deleted successfully.'];
                return Response::json($response);
             } 
             else 
             {
                $response = ['error' => 'Unable to delete the records.'];
                return Response::json($response);
             }
         } 
         else 
         {
            $response = ['error' => 'No direct script access allowed.'];
            return Response::json($response);
         }
    }

    public function tags() 
    {
        $tags = [];
        $tags = Tag::paginate(10);
        return view('admin.blog.tags', compact('tags'));
    }

    public function create_tag(Request $request) 
    {
        return view('admin.blog.blog-tag');
    }

    public function store_tag(Request $request) 
    {
        $validatedData = $request->validate(['tag_name' => 'required',
                    'url_slug' => 'required',
                    'status' => 'required'
            ]);

        $table_array = ['name' => $request['tag_name'], 'url_slug' => $request['url_slug'], 'status' => $request['status'] ];

        $insert = Tag::create($table_array)->id;

        if(!empty($insert)) 
        {
            Session::flash('success', 'Added successfully!');
            return redirect( route('admin.tags') );
        } 
        else 
        {
            Session::flash('error', 'Unable to process your request. Please try agian later.');
            return redirect( route('admin.tags') );
        }
    }
    public function tag_listing(Request $request) 
    {
       if(!empty($request['search'])) 
       {
             $tags = [];
             $tagList ='';
             $tagListArr = [];

             $searchQuery = $request['search'];
             $condition = ['status' => 'Active'];
             $tags = Tag::where('name', 'like', '%' . $searchQuery . '%')->where($condition)->get();
             if(count($tags) > 0) 
             {
                foreach($tags as $tag) 
                {
                  $tagList = '<a href="javascript:void(0)" onclick="addTag('.$tag->id.')" id="add-tag-'.$tag->id.'" data-id="'.$tag->name.'"><li class="search-results-items">'.$tag->name.'</li></a>';
                  $tagListArr[] = $tagList;                 
                }
             } 
             $response = ['tags' => $tagListArr];
             return Response::json($response);
        }  
    }

     public function blog_role(Request $request)
{
    $blogs = [];
    $categories = [];
    $search = $request['search'] ?? "";

    // Adjust this query to filter only guest blogs by adding your specific condition
    $query = BlogContent::where('blog_role', 'guest') // Assuming 'role' column indicates 'guest'
                        ->with(['getBlogCatagories', 'getBlogComments'])
                        ->orderBy('id', 'DESC');

    if ($search != '') {
        $query->where(function($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('author_first_name', 'LIKE', "%{$search}%");
        });
    }

    $blogs = $query->paginate(200);
    $blog_count = $query->count();
    $categories = TalentCatagory::all();

    return view('admin.blog.blog-role', compact('blogs', 'categories', 'blog_count'));
}

public function approve($id)
{
    
    $blog = BlogContent::findOrFail($id);
    $blog->blog_status = 1; // Set status to approved
    $blog->save();

    return redirect()->back()->with('success', 'Blog approved successfully.');
}

public function unapprove($id)
{
   
    $blog = BlogContent::findOrFail($id);
   
    $blog->blog_status = 0; // Set status to unapproved
    $blog->save();

    return redirect()->back()->with('success', 'Blog unapproved successfully.');
}


}
