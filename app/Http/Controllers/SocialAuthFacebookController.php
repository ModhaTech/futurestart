<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Socialite;
use Laravel\Socialite\Facades\Socialite;
use App\Services\SocialFacebookAccountService;
use Auth;
use Session;
class SocialAuthFacebookController extends Controller
{
  /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        dd($user);
        // return view('frontend.talentmall.index');

        // return Redirect::to('/home'); // Redirect to the home page after successful authentication
    }
}

