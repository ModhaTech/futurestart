<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Socialite;
use Laravel\Socialite\Facades\Socialite;
use App\Services\SocialLinkedinAccountService;
use Auth;
use Session;
class SocialAuthLinkedinController extends Controller
{
  /**
   * Create a redirect method to linkedin api.
   *
   * @return void
   */
    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * Return a callback method from linkedin api.
     *
     * @return callback URL from linkedin
     */
    // public function callback(SocialLinkedinAccountService $service)
    // {
    //     $user = $service->createOrGetUser( Socialite::driver('linkedin')->stateless()->user() );
    //     Auth::login($user,true);
    //     Session::flash('success','Login successfully to futurestarr!');
    //     return redirect()->to('/home');
    // }
    
    public function handleLinkedinCallback()
    {
        $user = Socialite::driver('linkedin')->user();

        dd($user);

        // return redirect('/home'); // Redirect to the home page after successful authentication
    }
}

