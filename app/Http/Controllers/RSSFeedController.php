<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\BlogContent;
use App\Models\TalentCatagory;
use App\Models\BlogComment;
  
class RSSFeedController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $posts = BlogContent::where('blog_status', '1')->where('cat_id', '18')->orderBy('id', 'desc')->limit(10)->get();
       
        return response()->view('rss', [
            'posts' => $posts
        ])->header('Content-Type', 'text/xml');
    }

    public function comments()
    {
        $postsIdArr = BlogContent::where('blog_status', '1')->where('cat_id', '18')->select('id')->orderBy('id', 'desc')->get()->toArray();
        
        $posts = BlogComment::where('status', '1')->whereIn('blog_id', $postsIdArr)->orderBy('blog_id', 'desc')->get();
        
        if($posts->count() < 1)
        {
          return view('comment-rss', ['mess' => 'Currently No comments there']);  
        }
        else
        {
         
            $oldPid = '';
            foreach ($posts as $post) {
                if($oldPid != $post->blog_id)
                {
                    $BlogTitle =  BlogContent::where('id','=', $post->blog_id)->pluck('title')->first();
                    $BlogLink =  BlogContent::where('id','=', $post->blog_id)->pluck('canonical_url')->first();
                }
                $oldPid = $post->blog_id;
                $post->blog_id = $BlogTitle;
                $post->status = $BlogLink;
            }
            return response()->view('comment-rss', [
                'posts' => $posts,
                'mess' => ''
            ])->header('Content-Type', 'text/xml');
        }
    }
}