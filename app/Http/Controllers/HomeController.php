<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogContent;
use App\Models\TalentCatagory;
use App\Models\SocialBuzzRiders;
use App\Models\Metatags;
use App\Models\Fanbase;
use App\User;
use Cache;
use Auth;
use DB as DB;
use Response;
use App\Models\FavrioteUser;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log; 

class HomeController extends Controller
{
    /*** Create a new controller instance.** @return void*/
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /*** Show the application dashboard.** @return \Illuminate\Contracts\Support\Renderable*/
    public function index(Request $request)
    {
      
        $blogs = BlogContent::with('getBlogCatagories')->where('blog_status', 1)->orderBy('id', 'DESC')
        ->limit(3)->get();
        $metaTags =  Metatags::where('page_title','=','Home')->first();
        // $catagories = TalentCatagory::all()->random(8);
        $catagories = TalentCatagory::whereNotIn('id', [17,18])->inRandomOrder()->limit(8)->get();

        $display_pop = session('welcome_user');
        if ($display_pop == 'seller' || $display_pop == 'buyer') 
        {
            $request->session()->pull('welcome_user');
        }
        
        $users = [];
        
        if(!empty(Auth::check())) 
        {
             $users = $this->users();
        }
        if (Auth::check()==true)
        {
            return view($this->getView('home'),compact('blogs','metaTags', 'catagories', 'display_pop'));
        }
        else
        {
         return view($this->getView('home'),compact('blogs','metaTags', 'catagories', 'display_pop'));
        }
    }

    public function home_more()
    {
        $blogs = BlogContent::with('getBlogCatagories')->where('blog_status', 1)->orderBy('id', 'DESC')
        ->limit(3)->get();
        $catagories = TalentCatagory::whereNotIn('id', [17,18])->inRandomOrder()->limit(8)->get();
        $response = view('home_more',compact('blogs', 'catagories'))->render();
        return Response::json($response);
    }

    public function users() 
    {
        // $users = [];
        // $fav_users = [];
        // $following = DB::table('fanbases')
        //             ->join('users','fanbases.follower', '=', 'users.id')
        //             ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
        //             ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users.username', 'users.email', 'users_roles.name as role','users_roles.id as role_id')
        //             ->where('following', Auth::user()->id)
        //             ->where('follower','!=' ,Auth::user()->id)
        //             ->where('is_fav','!=' , '1')
        //             ->get()->toArray();

        // $fav = DB::table('fanbases')
        //             ->join('users','fanbases.follower', '=', 'users.id')
        //             ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
        //             ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users.username', 'users.email', 'users_roles.name as role','users_roles.id as role_id')
        //             ->where('following', Auth::user()->id)
        //             ->where('follower','!=' ,Auth::user()->id)
        //             ->where('is_fav','!=' , '0')
        //             ->get()->toArray();

        // $users = $following;
        // $fav_users = $fav;

        $users = [];
        $fav_users = [];

        $return = [];
               $return[] = view('chat-users-list')->with(['users' => $users, 'fav_users' => $fav_users])->render();
        return response()->json(['state' => 1, 'messages' => $return]);
        
    }

    public function searchChatUsers(Request $request) 
    {
       if($request->ajax()) 
        {
            $users = [];
            $fav_users = [];
            
            $following = DB::table('fanbases')
                        ->join('users','fanbases.follower', '=', 'users.id')
                        ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                        ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users.username', 'users.email', 'users_roles.name as role','users_roles.id as role_id')
                        ->where('following', Auth::user()->id)
                        ->where('follower','!=' ,Auth::user()->id)
                        ->where('is_fav','!=' , '1')
                        ->where('users.username','LIKE',"%{$request->search}%")
                        ->get()->toArray();

            $fav = DB::table('fanbases')
                        ->join('users','fanbases.follower', '=', 'users.id')
                        ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                        ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users.username', 'users.email', 'users_roles.name as role','users_roles.id as role_id')
                        ->where('following', Auth::user()->id)
                        ->where('follower','!=' ,Auth::user()->id)
                        ->where('is_fav','!=' , '0')
                        ->where('users.username','LIKE',"%{$request->search}%")
                        ->get()->toArray();

            $users = $following;
            $fav_users = $fav;

            $return = [];
            $return[] = view('ajax-chat-users-list')->with(['users' => $users, 'fav_users' => $fav_users, 'search' => $request->search ])->render();
            return response()->json(['state' => 1, 'messages' => $return]);

        }
    }

    public function oldhomepage(Request $request) 
    {
        $blogs = BlogContent::with('getBlogCatagories')->where('blog_status', 1)->orderBy('id', 'desc')->limit(3)->get();
        $metaTags =  Metatags::where('page_title','=','Home')->first();
        $catagories = TalentCatagory::all()->random(8);
  
        $users = [];
        if(!empty(Auth::check())) 
        {
             $users = $this->users();
        }
        return view('home--old',compact('blogs','metaTags', 'catagories', 'users'));

    }

    private function getView($viewName)
    {
        if (request()->segment(1) == 'amp') 
        {
            if (view()->exists($viewName . '-amp')) 
            {
                $viewName .= '-amp';
            } 
            else 
            {
                abort(404);
            }
        }
        return $viewName;
    }
    
   public function newhome(Request $request){
        
       
         $blogs = BlogContent::with('getBlogCatagories')->where('blog_status', 1)->orderBy('id', 'DESC')
        ->limit(3)->get();
        $metaTags =  Metatags::where('page_title','=','Home')->first();
        // $catagories = TalentCatagory::all()->random(8);
        $catagories = TalentCatagory::whereNotIn('id', [17,18])->inRandomOrder()->limit(8)->get();

        $display_pop = session('welcome_user');
        if ($display_pop == 'seller' || $display_pop == 'buyer') 
        {
            $request->session()->pull('welcome_user');
        }
        
        $users = [];
        
        if(!empty(Auth::check())) 
        {
             $users = $this->users();
        }
        if (Auth::check()==true)
        {
            return view($this->getView('newhome'),compact('blogs','metaTags', 'catagories', 'display_pop'));
        }
        else
        {
         return view($this->getView('newhome'),compact('blogs','metaTags', 'catagories', 'display_pop'));
        }
    }
    
     public function homenew(Request $request){
        
         $blogs = BlogContent::with('getBlogCatagories')->where('blog_status', 1)->orderBy('id', 'DESC')
        ->limit(3)->get();
        $metaTags =  Metatags::where('page_title','=','Home')->first();
        // $catagories = TalentCatagory::all()->random(8);
        $catagories = TalentCatagory::whereNotIn('id', [17,18])->inRandomOrder()->limit(8)->get();

        $display_pop = session('welcome_user');
        if ($display_pop == 'seller' || $display_pop == 'buyer') 
        {
            $request->session()->pull('welcome_user');
        }
        
        $users = [];
        
        if(!empty(Auth::check())) 
        {
             $users = $this->users();
        }
        if (Auth::check()==true)
        {
            return view($this->getView('homenew'),compact('blogs','metaTags', 'catagories', 'display_pop'));
        }
        else
        {
         return view($this->getView('homenew'),compact('blogs','metaTags', 'catagories', 'display_pop'));
        }
    }
    
}
