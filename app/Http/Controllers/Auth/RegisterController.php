<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
use App\Traits\MailsendTrait;
use Illuminate\Support\Str;
use Auth;
use Laravel\Socialite\Facades\Socialite;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use MailsendTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

    if($data['role_id'] =='3')
    {
        
         Session::flash('buyer','buyer');
         return Validator::make($data, [

            'firstname' => ['required', 'regex:/^[a-zA-Z]*$/u', 'max:255'],
            'lastname' => ['required', 'regex:/^[a-zA-Z]+$/u', 'max:255'],
            'username' => ['required', 'string', 'max:15','unique:users'],
            'email' => ['required', 'email:rfc,dns', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mng-cap'   =>  ['required', 'string'],
            'cap'       =>  ['required', 'same:mng-cap'],
        ],[
            'cap.same' => 'Captcha does not match',
            'firstname.required'=> 'The First name field is required',
            'lastname.required'=> 'The Last name field is required',
            'username.required'=> 'The User name field is required',
            'cap.required' => "Captcha is required",
            'password.confirmed' => 'Passwords do not match',
        ]);

    } 
    elseif ($data['role_id'] =='4') 
    {

        Session::flash('seller','seller');
        return Validator::make($data, [
            'firstname' => ['required', 'regex:/^[a-zA-Z]*$/u', 'max:255'],
            'lastname' => ['required', 'regex:/^[a-zA-Z]+$/u', 'max:255'],
            'username' => ['required', 'string', 'max:15','unique:users'],
            'email' => ['required', 'email:rfc,dns', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mng-cap'   =>  ['required', 'string'],
            'cap'       =>  ['required', 'same:mng-cap'],
        ],[
            'cap.same' => 'Captcha does not match',
            'cap.required' => "Captcha is required",
            'firstname.required'=> 'The First name field is required',
            'lastname.required'=> 'The Last name field is required',
            'username.required'=> 'The User name field is required',
            'password.confirmed' => 'Passwords do not match',
        ]);
    }
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data);
        if ($data['mng-cap'] !== $data['cap']) 
        {
            // Session::flash('error', 'Please enter a valid captcha.');
            // return redirect('/register');
            // Session::flash('cap', "Please enter a valid captcha.");
            // return Redirect::back();
            // return Redirect::back()->with('cap', 'Please enter a valid captcha.');
            // Session::flash('cap', 'Please enter a valid captcha.');
            return back();
        }

        if($data['role_id'] =='3') 
        {
        
        $user =  User::create([
            'role_id' => $data['role_id'],
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'public_profile' => \Str::slug($data['firstname']).'-'.\Str::slug($data['lastname']).'-'.substr(md5(rand()), 0, 11)
        ]);
        
         $this->registerEmailToAdmin($data);
         $this->registerEmailToBuyer($data,$data['email']);
         Session::flash('success','Thank you for regisreted as buyer with futurestarr.');
         session(['welcome_user' => 'buyer']);
         return $user;

      } 
      elseif ($data['role_id'] =='4') 
      {
        
        $user =  User::create([
            'role_id' => $data['role_id'],
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'public_profile' => \Str::slug($data['firstname']) .'-'.\Str::slug($data['lastname']).'-'.substr(md5(rand()), 0, 11)
        ]);
        
          $this->registerEmailToAdmin($data);
          $this->registerEmailToSeller($data,$data['email']);
          Session::flash('success','Thank you for regisreted as seller with futurestarr.');
          session(['welcome_user' => 'seller']);
          return $user;
        }
    }

    public function curlG($Url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $head = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        // print_r($httpCode);
        print_r($head);
        // $response = curl_exec($ch);
        // return (object) $response_body;
    }

    public function twitter(Request $request){

  //       $fp = fopen('callback.txt', 'a');//opens file in append mode  
		// fwrite($fp, json_encode($request->all()));
		// fwrite($fp, '\r\n');

		// fclose($fp);
        // $user = Socialite::driver('twitter')->redirect();

        // return response()->json($user);
        // $client_id = 'irE7MOpf1O7bFILGtjMU59T0F';
        // $client_secret = 'gDmu3qcOnnFEGM7XhSUVBw4ZmJEDGWWAQ2N2p6Ay5rCzw4ZZWO';
        // $token = '489451297-ottHLWiYIHji3c1UAgTWhaR7PLWtL87GyfVWCBtr';
        // $secret = 'Rged4cNshPDlb5XfYkzOtjeBThks8OvXNCf1LuEHKXR57';
  //       // return Socialite::driver('twitter')->userFromTokenAndSecret($token, $secret);
  //       $access_token = 'AAAAAAAAAAAAAAAAAAAAANVzOgAAAAAAPOFq%2BU12Yro9OB1p%2FisGDKT%2BUoI%3DVdPmFEbLI0VZ5nJw1AmxqAgRrpUjgou3x8FXororexw9fLeJmu';
  //       $callback = 'http://ec2-18-224-33-209.us-east-2.compute.amazonaws.com/twitter-callback';
  //       // , $token, $secret
  //       $connection = new TwitterOAuth($client_id, $client_secret);
		// $request_token = $connection->oauth('oauth/request_token',  ["oauth_verifier" => $access_token]);

  //       // $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $access_token]);
        // return $request->all();
  //       print_r($request_token);

  //       $connection = new TwitterOAuth($client_id, $client_secret, $request_token['oauth_token'], $request_token['oauth_token_secret']);
  //       $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
  //       // // $user = $connection->get("account/verify_credentials");
  //       print_r($url);
		// // $_SESSION['oauth_token'] = $request_token['oauth_token'];
		// // $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		// // $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

  //       $fp = fopen('callback.txt', 'a');//opens file in append mode  
		// fwrite($fp, $url);
		// fclose($fp); 
  //       // print_r($url);

  //       // return $this->curlG($url);

  //       // return $this->curlG('https://api.twitter.com/oauth/access_token?oauth_verifier='.$access_token);

  //       // $request_token['oauth_token'] = $_SESSION['oauth_token'];
  //       // $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
        
  //       // $access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $access_token));
  //       // $_SESSION['access_token'] = $access_token;
  //       // $user = $connection->get("account/verify_credentials", ['include_email' => 'true']);

  //       // print_r($user);
		// // return $this->curlG($url);
		// // $access_token = $_SESSION['access_token'];
		// // $connection = new TwitterOAuth($client_id, $client_secret, $access_token['oauth_token'], $access_token['oauth_token_secret']);
		// // $user = $connection->get("account/verify_credentials", ['include_email' => 'true']);

		// // return $url;
    }

    public function twitterCallback(Request $request){
  //       $fp = fopen('callback.txt', 'a');//opens file in append mode  
		// fwrite($fp, json_encode($request->all()));
		// fclose($fp); 
		// echo "File appended successfully"; 

    }


}
 