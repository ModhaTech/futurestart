<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BlogContent;
use App\Models\TalentCatagory;
use App\Models\BlogComment;
use App\Models\Metatags;
use App\Models\BlogLink;
use App\Models\BlogSubscription;
use Auth;
use Carbon\Carbon;
use Response;
use Session;

class BlogController extends Controller
{
    /**
     * Display as listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($cat_id = '' , Request $request) 
    {
    
        $category_id = $cat_id;
        $talentCategories = TalentCatagory::select('id', 'name', 'slug', 'catagory_image_path')->get();
        // return $talentCategories;
        $blogs = array();
        $catid = TalentCatagory::where('slug', $category_id)->first();

            if(!empty($talentCategories)) 
            {
                 $first_record =  $talentCategories->first();
                $where_condtiton = ['cat_id' => $first_record['id'], 'blog_status' => 1];
                 $blogs = BlogContent::with('getBlogCatagories')->select('id', 'cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'author_first_name', 'author_last_name', 'blog_video', 'alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status', 'date')->where($where_condtiton)->orderBy('id', 'desc')->paginate(10);
                 $categoryName = isset($blogs[0]->getBlogCatagories['name'])?$blogs[0]->getBlogCatagories['name']:'';
                 $metaTags =  Metatags::where('page_title','=','Blog')->first();
            }
            if($category_id) 
            {
                if(!$catid)
                {
                   Session::flash('info', 'Sorry No such category available.');
                    return redirect( route('blog.index') );
                }
                  $where_condtiton = ['cat_id' => $catid['id'] , 'blog_status' => 1];
                  $blogs = BlogContent::with('getBlogCatagories')->select('id', 'cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'author_first_name', 'author_last_name', 'blog_video', 'alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status', 'date')->where($where_condtiton)->orderBy('id', 'desc')->paginate(10);
                  $categoryName =  TalentCatagory::where('slug','=', $category_id)->pluck('name')->first();
                  $whereArr =  ['type'=>'blog_category','page_title'=>$categoryName];
                  $metaTags =  Metatags::where($whereArr)->first();
            } 
            $latestBlog = BlogContent::with('getBlogCatagories')->select('id', 'cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'author_first_name', 'author_last_name', 'blog_video', 'alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status')->where('blog_status', 1)->latest('id')->first();

            return view('frontend.blog.index', compact('blogs', 'talentCategories','metaTags', 'latestBlog','catid'));
    }

    /*** Show the form for creating a new resource.* @return \Illuminate\Http\Response*/
    public function create()
    {
        //
    }

    /*** Store a newly created resource in storage.** @param  \Illuminate\Http\Request  $request* @return \Illuminate\Http\Response*/
    public function store(Request $request)
    {
        if($request->ajax()) 
        {
            $post = $request->all();
            
          if($post['first_name'] =='' || $post['last_name'] =='' || $post['email'] =='') 
            {
                $response = ['error' => 'Validation error. All fields are required.','status'=>'validation'];
                 return Response::json($response);
            }
            $check_exist = BlogSubscription::where('email', '=',$post['email'])->first();
            if(!empty($check_exist)) 
            {
                 $response = ['info' => 'You are already subscribed with Future Starr!'];
                 return Response::json($response);
            }
            $table_array = ['first_name' => $post['first_name'], 'last_name' =>$post['last_name'], 'email' => $post['email']];
            
            $inserted = BlogSubscription::create($table_array)->id;
            if(!empty($inserted) ) 
            {
               $response = ['success' => 'Thank you for subscribing with Future Starr!'];
                   return Response::json($response);

             } 
             else 
             {
                   $response = ['error' => 'Technical error.'];
                   return Response::json($response);
             }
        } 
        else 
        {
            $response = ['error' => 'No direct script access allowed.'];
            return Response::json($response);
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
        //
    }

    /*** Update the specified resource in storage.** @param  \Illuminate\Http\Request  $request* @param  int  $id* @return \Illuminate\Http\Response*/
    public function update(Request $request, $id)
    {
        //
    }

    /*** Remove the specified resource from storage.** @param  int  $id* @return \Illuminate\Http\Response*/
    public function destroy($id)
    {
        //
    }

    /*** Single Blog Data Based Upon Blog Id** @param  int  $id* @return \Illuminate\Http\Response*/

    public function singleDetailedRq($cat_slug = '', $blog_slug = '' ,Request $request) 
    {

        if(!empty($blog_slug) && is_string($blog_slug)) 
        {
             $talentCategories = [];
             $blogData = [];
             $relatedBlogs = [];
             $metaTags = [];
             $tag_array = [];
            
             $talentCategories = TalentCatagory::all();


             $blogCondition = ['slug' => $blog_slug];
             $blogData = BlogContent::with(['getBlogCatagories', 'getBlogComments'])->where($blogCondition)->first();

             if(!empty($blogData)) 
             {
                    $slug_cat_id = '';
                   foreach ($talentCategories as $allcats) {
                     if(strtolower(str_replace(' ', '-', $allcats['name'])) == strtolower($cat_slug)){
                        $slug_cat_id = $allcats['id'];
                     }
                   }
                 $category_id = $blogData['cat_id'];
                 if($category_id == $slug_cat_id || $cat_slug == 'detailed' ){
                   $relatedBlogCond = ['cat_id' => $category_id, 'blog_status' => 1];
                   $relatedBlogs = BlogContent::where($relatedBlogCond)->select('id', 'cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'author_first_name', 'author_last_name', 'blog_video', 'alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status', 'date')->where('id',  '!=',  $blogData['id'])->inRandomOrder()->take(15)->get();

                   $metaTags['title'] = $blogData['title'];
                   $metaTags['title'] = strlen($metaTags['title']) > 45 ? substr($metaTags['title'],0,45)."..." : $metaTags['title'];
                   $metaTags['og_image'] = env('APP_URL') .'/'. $blogData['blog_img'];
                   
                   $tag_array = ['meta_tags' => $blogData['meta_tags'], 'meta_keywords' => $blogData['meta_keywords'], 'meta_description' => $blogData['meta_description'] ];

                   $check = Auth::check();
                   $categoryName = TalentCatagory::where('id', $category_id)->pluck('name')->first();
                   $catog['cat']  = $categoryName;
                   $blogData->content = str_replace('<h1', '<h2', $blogData->content);
                   $blogData->content = str_replace('</h1', '</h2', $blogData->content);
                   $blogData->content = str_replace('http://futurestarr', 'https://www.futurestarr', $blogData->content);
                   $blogData->content = str_replace('http://www.futurestarr', 'https://www.futurestarr', $blogData->content);

                   $blogData->content = $this->removeDuplicateHeadings($blogData->content);
                   
                   //// check same headings for SEO
                   $itavail = strpos(strtolower($blogData->content), strtolower('>'.$blogData->title));
                   // dd(strtolower('>'.$blogData->title));
                   if($itavail !== false)
                    {
                        
                        $isHeading = $blogData->content[($itavail-2)];
                        
                        if($isHeading == "h")
                        {   
                           $isHeading .= $blogData->content[($itavail-1)];
                           $blogData->content = str_replace('<'.$isHeading.'>'.$blogData->title.'</'.$isHeading.'>', '', $blogData->content);
                        }
                    }
                    $tag_array['meta_description'] = strlen($tag_array['meta_description']) > 45 ? substr($tag_array['meta_description'],0,45)."..." : $tag_array['meta_description'];
                   return view('frontend.blog.detailed', compact('blogData', 'talentCategories', 'check', 'relatedBlogs','tag_array', 'metaTags' ,'catog'));
                 }
                 else
                 {
                    Session::flash('info', 'Sorry No such blog available in this category.');
                    return redirect( route('blog.index') );
                 }
             } 
             else 
             {
                Session::flash('info', 'Sorry No such blog available.');
                return redirect( route('blog.index') );
             }
        } 
        else 
        {
            return redirect( route('blog.index') );
        }
    }
    public function addBlogLinks(Request $request)
    {
        $validated = $request->validate([
            'anchor' => 'required',
            'website' => 'required',
            'link' => 'required',
            'term' => 'required',
            'blog_id' => 'required',
        ]);
        if (Auth::check()) 
        {
            $bl = new BlogLink;
            $bl->blog_id = $request->blog_id;
            $bl->user_id = Auth::id();
            $bl->anchor = $request->anchor;
            $bl->website = $request->website;
            $bl->link = $request->link;
            $bl->save();
            return response()->json(['status' => true, 'success' => true]); 
        }
        else
        {
            return response()->json(['status' => false, 'info' => true]);
        }
    }
    public function blogPostpage()
    {
        $talent_categories = [];
        $talent_categories = TalentCatagory::all();
        return view('frontend.blog.blog_post',compact('talent_categories'));
    }
    public function blogPostpageCreate(Request $request)
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
          
          $category_name = TalentCatagory::where('id', $request->category)->pluck('name')->first();
          $blog_array = [

            'cat_id' => $request['category'],
            'title' => $request['title'],
            'slug' => \Str::slug($request['title'], '-'),
            'canonical_url' => route('blog.index'). '/'. $category_name. '/' .\Str::slug($request['title'], '-'),
            'blog_img' => $path_name,
            'blog_video' => '',
            'content' => $request['content'],
            'author_image' => $_author_path_name,
            'author_first_name' => $request['author_first_name'],
            'author_last_name' => $request['author_last_name'],
            'meta_tags' => $request['meta-tags'],
            'alt'=> $request['alt-tags'],
            'meta_keywords' => $request['meta-keywords'],
            'meta_description' => $request['meta-description'],
            'blog_status' => ($request->has('draft')) ? 0 : 1 ,
            'date' => Carbon::now(),
            'created_by' => Auth::user()->id
        ];

        $created  = BlogContent::insert($blog_array);

        if(!empty($created)) 
        {
            Auth::logout();
            Session::flash('success' , 'Blog created successfully.');
            return redirect( route('blog.index') );
        } 
        else 
        {
            Session::flash('error' , 'Technical error.');
            return redirect( route('blog.post') );
        }
    }

    public function removeDuplicateHeadings($htmlContent)
    {
        // Create a new DOMDocument instance and load the HTML content
        $xml = simplexml_load_string('<root>' . trim($htmlContent) . '</root>', 'SimpleXMLElement', LIBXML_NOERROR | LIBXML_NOWARNING);
        if ($xml) {
            $figures = $xml->xpath('//figure');

            if($figures)
            {
                 return $htmlContent;
            }
            // Do something with the parsed XML

            $dom = new \DOMDocument();
            $dom->loadHTML($htmlContent);
            
            // Loop through each heading element and keep track of the text content
            $headings = [];
            foreach ($dom->getElementsByTagName('h1') as $heading) {
                $text = trim($heading->textContent);
                if (in_array($text, $headings)) {
                    // If the text content has already been seen, remove the heading element
                    $heading->parentNode->removeChild($heading);
                } else {
                    // Otherwise, add the text content to the list of seen headings
                    $headings[] = $text;
                }
            }
            foreach ($dom->getElementsByTagName('h2') as $heading) {
                $text = trim($heading->textContent);
                if (in_array($text, $headings)) {
                    $heading->parentNode->removeChild($heading);
                } else {
                    $headings[] = $text;
                }
            }

            foreach ($dom->getElementsByTagName('h3') as $heading) {
                $text = trim($heading->textContent);
                if (in_array($text, $headings)) {
                    $heading->parentNode->removeChild($heading);
                } else {
                    $headings[] = $text;
                }
            }

            foreach ($dom->getElementsByTagName('h4') as $heading) {
                $text = trim($heading->textContent);
                if (in_array($text, $headings)) {
                    $heading->parentNode->removeChild($heading);
                } else {
                    $headings[] = $text;
                }
            }

            foreach ($dom->getElementsByTagName('h5') as $heading) {
                $text = trim($heading->textContent);
                if (in_array($text, $headings)) {
                    $heading->parentNode->removeChild($heading);
                } else {
                    $headings[] = $text;
                }
            }

            foreach ($dom->getElementsByTagName('h6') as $heading) {
                $text = trim($heading->textContent);
                if (in_array($text, $headings)) {
                    $heading->parentNode->removeChild($heading);
                } else {
                    $headings[] = $text;
                }
            }
            // Repeat for h3 to h6 elements
            // Return the modified HTML content
            $body = $dom->getElementsByTagName('body')->item(0);
            $bodyChildren = $body->childNodes;

            // Remove the <html> and <body> tags from the document
            $dom->removeChild($dom->doctype);
            $dom->replaceChild($body, $dom->getElementsByTagName('html')->item(0));
            $dom->appendChild($body);

            // Get the inner HTML of the <body> element
            $innerHtml = '';
            foreach ($bodyChildren as $child) {
                $innerHtml .= $dom->saveHTML($child);
            }
            // dd($innerHtml);
            return $innerHtml;
        }else{
            return $htmlContent;
        }

    }
}
