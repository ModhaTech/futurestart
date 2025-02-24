<?php 

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Repository\Apis\UserApi;
use Illuminate\Support\Str;
use Mail;
use Illuminate\Http\Request;
use JWTAuth;
use Response;
use \Illuminate\Http\Response as Res;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use PhpParser\Node\Stmt\TryCatch;
use PHPUnit\Framework\Exception;
use URL;
use File;
use DB;
use App\Traits\MailsendTrait;
use App\Models\BlogContent;
use App\Models\BlogComment;
use App\Models\TalentCatagory;
use App\Models\BlogSubscription;
use Auth;


class BlogController extends ApiController
{

    use MailsendTrait;

    public function blogCategory(){
        try{
            $categories = TalentCatagory::all();
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Blog Categories!',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' => $categories
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

       public function blogs($slug = '', Request $request)
    {
        // return "test";
        try {
            $catid = TalentCatagory::where('slug', $slug)->first();
            $per_page = $request->per_page ? $request->per_page : 10;
            if ($catid != null) {                
                $where_condtiton = ['cat_id' => $catid['id'], 'blog_status' => 1];
                $data['blogs'] = BlogContent::with('getBlogCatagories')->select('id', 'cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'author_first_name', 'author_last_name', 'blog_video', 'alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status', 'date')->where($where_condtiton)->paginate($per_page);

                $data['latest_blog'] = BlogContent::with('getBlogCatagories')->select('id', 'cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'author_first_name', 'author_last_name', 'blog_video', 'alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status', 'date')->where($where_condtiton)->latest()->first();
            }else{
                // $catid = TalentCatagory::first();
                $where_condtiton = ['blog_status' => 1];
                $data['blogs'] = BlogContent::with('getBlogCatagories')->select('id', 'cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'author_first_name', 'author_last_name', 'blog_video', 'alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status', 'date')->where($where_condtiton)->paginate($per_page);

                $data['latest_blog'] = BlogContent::with('getBlogCatagories')->select('id', 'cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'author_first_name', 'author_last_name', 'blog_video', 'alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status', 'date')->where($where_condtiton)->latest()->first();
            }
            
             
            // $blogs = BlogContent::select("id", "title", "blog_img", "author_first_name", "author_last_name", "date", "blog_status","content")->where('blog_status', 1)->orderBy('id', 'DESC')
            // ->limit(3)->get();

            // foreach($blogs as $blog){
            //     $latestBlog[] = [
            //         "id" => $blog->id,
            //         "title" => $blog->title,
            //         "blog_img" => $blog->blog_img,
            //         "author_first_name" => $blog->author_first_name,
            //         "author_last_name" => $blog->author_last_name,
            //         "date" => date('M d, Y', strtotime($blog->date)),
            //         "blog_status" => $blog->blog_status,
            //         "content" => \Illuminate\Support\Str::limit(strip_tags($blog->content), 100)
            //     ];
            // }
            // $blogArray = ['latestBlog' => $latestBlog];
            $notification = [];
            $notification["home"] = "0";
            $notification["dashboard"] = "1";
            $notification["starrsearch"] = "2";
            $notification["talentmall"] = "3";
            $notification["socialbuzz"] = "4";
            return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Blog listing!',
                    'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                    'data' => $data,
                    'notification' => &$notification
           ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function relatedBlogs($slug = '', Request $request)
    {
        try {
            $per_page = $request->per_page ? $request->per_page : 10;
            $catid = TalentCatagory::where('slug', $slug)->first();
            $where_condtiton = ['cat_id' => $catid['id'], 'blog_status' => 1];
            $data['blogs'] = BlogContent::with('getBlogCatagories')->select('id', 'cat_id', 'title', 'slug', 'canonical_url', 'blog_img', 'author_first_name', 'author_last_name', 'blog_video', 'alt', 'author_image', 'meta_tags', 'meta_keywords', 'meta_description', 'blog_status', 'date')->where($where_condtiton)->where('id',  '!=',  $request->current_blog_id)->paginate($per_page);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Related Blogs',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' => $data
           ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function blogById($cat_slug = '', $blog_slug = '', Request $request) {
        try{  
            $blogData = [];
            $blogCondition = ['slug' => $blog_slug];
            $blogData = BlogContent::with(['getBlogCatagories'])->where($blogCondition)->first();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Blog detailed data!',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' => $blogData
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function getComment($cat, $slug, Request $request){
        try{
            $per_page = $request->per_page ? $request->per_page : 10;
            $blogCondition = ['slug' => $slug];
            $blog = BlogContent::select('id')->where($blogCondition)->first();
            $comments = BlogComment::with('getCommentUser')->where('blog_id', $blog->id)->where('status', 1)->paginate($per_page);
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Blog Comments',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' => $comments
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function addComment(Request $request){
        try{
            $rules = array(
                'blog_id' => 'required|numeric|min:0|not_in:0',
                'message' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $comment = new BlogComment;
            $comment->blog_id = $request->blog_id;
            $comment->message = $request->message;
            $comment->user_id = Auth::id();
            $comment->created_by = Auth::id();
            $comment->updated_by = Auth::id();
            $comment->save();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Add Blog Comment',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' => $comment
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function blogSubscribe(Request $request){
        try{
            $rules = array(
                'first_name' => 'required',
                'last_name' => 'required',
                'email'     =>  'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $sub = new BlogSubscription;
            $sub->first_name = $request->first_name;
            $sub->last_name = $request->last_name;
            $sub->email = $request->email;
            $sub->save();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Add blog subscribe',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' => $sub
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

}
