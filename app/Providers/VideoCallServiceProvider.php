<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Models\VideoCall;
use App\Models\User;
use Auth;
use View;
use App\Models\Chats;
use App\Models\ChatMessages;

class VideoCallServiceProvider extends ServiceProvider
{
    /*** Register services.** @return void*/
    public function register()
    {
        
    }
    /*** Bootstrap services.** @return void*/
    public function boot()
    {
       // Data Show for User Header for Accrpt call and Rejected Call.
        View::composer(['layouts.talent.header'], function($view)
        {
            if (Auth::check()) 
            {
              $user_chat_message = ChatMessages::where('received_by',Auth::user()->id)->where('read_flag',0)->get()->count();      
            }
            else
            {          
               $user_chat_message = null;            
            }
            $view->with('user_chat_message', $user_chat_message);  
        });
    }
}
