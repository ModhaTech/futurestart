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
use Carbon;
use Response;
use Session;

class BlogController extends Controller
{
    /**
     * Display as listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($cat_id = '' , Request $request) {

        $category_id = $cat_id;
        $talentCategories = TalentCatagory::select('id', 'name', 'slug', 'catagory_image_path')->get();
        // return $talentCategories;
        $blogs = array();
        $catid = TalentCatagory::where('slug', $category_id)->first();

            if(!empty($talentCategories)) {
               
                 $first_record =  $talentCategories->first();
                 $where_condtiton = ['cat_id' => $first_record['id'], 'blog_status' => 1];
                 $blogs = BlogContent::with('getBlogCatagories')->select('id', 'cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'author_first_name', 'author_last_name', 'blog_video', 'alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status')->where($where_condtiton)->paginate(10);
                 $categoryName = isset($blogs[0]->getBlogCatagories['name'])?$blogs[0]->getBlogCatagories['name']:'';
                 $metaTags =  Metatags::where('page_title','=','Blog')->first();
            }
            if($category_id) {
                 
                  $where_condtiton = ['cat_id' => $catid['id'] , 'blog_status' => 1];
                  $blogs = BlogContent::with('getBlogCatagories')->select('id', 'cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'author_first_name', 'author_last_name', 'blog_video', 'alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status')->where($where_condtiton)->paginate(10);
                  $categoryName =  TalentCatagory::where('slug','=', $category_id)->pluck('name')->first();
                  $whereArr =  ['type'=>'blog_category','page_title'=>$categoryName];
                  $metaTags =  Metatags::where($whereArr)->first();
                  //dd($metaTags);
                
            } 
            // return $blogs;
           // dd($catid);
            // $relatedBlogs = BlogContent::where('cat_id', $catid)->select('id', 'cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'author_first_name', 'author_last_name', 'blog_video', 'alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status')->get();  
            
            // $randomBlog = BlogContent::where('blog_status', 1)->select('id', 'cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'author_first_name', 'author_last_name', 'blog_video', 'alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status')->get()->random(1);

            $latestBlog = BlogContent::with('getBlogCatagories')->select('id', 'cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'author_first_name', 'author_last_name', 'blog_video', 'alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status')->where('blog_status', 1)->latest('id')->first();
            
            return view('frontend.blog.index', compact('blogs', 'talentCategories','metaTags', 'latestBlog','catid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()) {
            $post = $request->all();
            
            if($post['first_name'] =='' || $post['last_name'] =='' || $post['email'] =='') {

                 $response = ['error' => 'Validation error. All fields are required.','status'=>'validation'];
                 return Response::json($response);
            }
            $check_exist = BlogSubscription::where('email', '=',$post['email'])->first();
            if(!empty($check_exist)) {

                 $response = ['info' => 'You are already subscribed with Future Starr!'];
                 return Response::json($response);
            }
            $table_array = ['first_name' => $post['first_name'], 'last_name' =>$post['last_name'], 'email' => $post['email']];
            
            $inserted = BlogSubscription::create($table_array)->id;
            if(!empty($inserted) ) {

                   $response = ['success' => 'Thank you for subscribing with Future Starr!'];
                   return Response::json($response);

             } else {
                   $response = ['error' => 'Technical error.'];
                   return Response::json($response);
            }
        } else {

            $response = ['error' => 'No direct script access allowed.'];
            return Response::json($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Single Blog Data Based Upon Blog Id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function singleDetailedRq($cat_slug = '', $blog_slug = '' ,Request $request) 
    {

        if(!empty($blog_slug) && is_string($blog_slug)) {
                    
             $talentCategories = [];
             $blogData = [];
             $relatedBlogs = [];
             $metaTags = [];
             $tag_array = [];
            
             $talentCategories = TalentCatagory::all();

             $blogCondition = ['slug' => $blog_slug];
             $blogData = BlogContent::with(['getBlogCatagories', 'getBlogComments'])->where($blogCondition)->first();

             if(!empty($blogData)) {

                 $category_id = $blogData['cat_id'];
                 $relatedBlogCond = ['cat_id' => $category_id, 'blog_status' => 1];
                 $relatedBlogs = BlogContent::where($relatedBlogCond)->select('id', 'cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'author_first_name', 'author_last_name', 'blog_video', 'alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status')->where('id',  '!=',  $blogData['id'])->inRandomOrder()->take(15)->get();

                 $metaTags['title'] = $blogData['title'];
                 $metaTags['og_image'] = env('APP_URL') .'/'. $blogData['blog_img'];
                 
                 $tag_array = ['meta_tags' => $blogData['meta_tags'], 'meta_keywords' => $blogData['meta_keywords'], 'meta_description' => $blogData['meta_description'] ];

                 $check = Auth::check();
                 $categoryName = TalentCatagory::where('id', $category_id)->pluck('name')->first();
                 $catog['cat']  = $categoryName;
                 
                 return view('frontend.blog.detailed', compact('blogData', 'talentCategories', 'check', 'relatedBlogs','tag_array', 'metaTags' ,'catog'));
             } else {

                    Session::flash('info', 'Sorry No such blog available.');
                    return redirect( route('blog.index') );
             }
             

         } else {

              return redirect( route('blog.index') );
         }
           
    }

    public function addBlogLinks(Request $request){
        $validated = $request->validate([
            'anchor' => 'required',
            'website' => 'required',
            'link' => 'required',
            'term' => 'required',
            'blog_id' => 'required',
        ]);
        if (Auth::check()) {
            $bl = new BlogLink;
            $bl->blog_id = $request->blog_id;
            $bl->user_id = Auth::id();
            $bl->anchor = $request->anchor;
            $bl->website = $request->website;
            $bl->link = $request->link;
            $bl->save();

            return response()->json(['status' => true, 'success' => true]); 
        }else{
            return response()->json(['status' => false, 'info' => true]);
        }
    } 



}
