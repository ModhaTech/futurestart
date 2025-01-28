<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialTwitterAccountService;
use Auth;
use Log;
use Session;
use Exception;

class SocialAuthTwitterController extends Controller
{
  /**
   * Create a redirect method to twitter api.
   *
   * @return void
   */
    public function redirect()
    {
        $token = 'fMFqRVTKyA1LwCTFQR1VESfug';
        $secret = 'YQCtWeMkab5UB3AALwOeLSQAGs4eq6DHkOHi6gbiYqoAdGbbPz';
        $user = Socialite::driver('twitter')->userFromTokenAndSecret($token, $secret);
        return $user;
    }

    /**
     * Return a callback method from twitter api.
     *
     * @return callback URL from twitter
     */
    public function callback(SocialTwitterAccountService $service)
    {
     
        $user = $service->createOrGetUser(Socialite::driver('twitter')->user());
        auth()->login($user);
        Session::flash('success','Login successfully to futurestarr!');
        return redirect()->to('/home');
    }
}

