<?php 

namespace App\Http\Controllers\Api;

use App\User;
use Auth;
use App\Models\Talents;
use App\Models\TalentAwards;
use App\Models\ProfileVisitor;
use App\Models\PurchasedProduct;
use Illuminate\Http\Request;
use JWTAuth;
use \Illuminate\Http\Response as Res;
use Validator;
use App\Models\DeletedAccount;
use Tymon\JWTAuth\Exceptions\JWTException;
use PHPUnit\Framework\Exception;
use Hash;
use App\Traits\MailsendTrait;
use App\SocialFacebookAccount;
use App\Models\UsersRoles;
use App\Models\SellerStripeAccounts;
use App\Models\Fanbase;
use App\Models\SocialBuzz;
use App\Models\SocialBuzzComments;
use App\Models\SocialBuzzRiders;
use App\Models\SocialBuzzAwards;
use App\Models\TalentCatagory;
use App\Models\BuyerProducts;
use Carbon\Carbon;
use App\Models\TalentRiders;
use DB;
use Socialite;
use App\Models\ContactUs;
use App\Models\ChatMessage;
use GuzzleHttp\Client;

class UserController extends ApiController
{

     use MailsendTrait;

    /*** @description: Api user authenticate method* @param: email, password* @return: Json String response*/
    public function authenticate(Request $request)
    {
        $rules = array(
            'email' => 'required',
            'password' => 'required',);

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {
          return $this->respondValidationError('Fields Validation Failed.', $validator);
        } 
        else 
        {
            $user = User::Where('email', $request['email'])->orWhere('username', $request['email'])->first();

            
            if(!empty($user) && !empty($user->email)) 
            {
                 $user->device_token = $request->device_token;
                 // return $user->device_token;
                 $user->save();



                
                //return $response; 

                 

                return $this->_login($user->email, $request['password']);
            } 
            else 
            {
                return $this->respondWithError("Invalid Username/Password");
            }
            
        }
    }

    private function _login($email, $password)
    {
        $credentials = ["email" => $email, 'password' => $password];
        if (!$token = JWTAuth::attempt($credentials)) 
        {
            return $this->respondWithError("Invalid Username/Password");
        }
        $user = User::find(Auth::id());

        if($user->role_id == 1) 
        {
            return $this->respondWithError("Not Authorized : You are not authorized to login.");
        }

        $user->api_token = $token;
        $user->save();

        $profile_picture = "";

        $user->stripe_account = SellerStripeAccounts::Where('user_id', Auth::id())->first();
        $roleName = $this->userRole($user->role_id);

        return $this->respond([
            'status' => 'success',
            'status_code' => $this->getStatusCode(),
            'message' => 'Login Successful!',
            'data' => $user,
            'roleName' => $roleName,
        ], ['x-app-token' => $user->api_token]);
    }

    public function userRole($id) 
    {        
        $role =  UsersRoles::where('id', $id)->first();
        return $role['name'];
    }

    /*** @description: Api user register method (First Step Basic Registeration)* @param: lastname, firstname, username, email, password* @return: Json String response*/

    public function register(Request $request)
    {
        // return $request->all();
        // die('hello');
        try {

            $rules = array(
                'first_name' => 'required|max:255',
                'last_name'  => 'required|max:255',
                'email'      => 'required|email|max:255|unique:users',
                'username'   => 'required|max:15|unique:users',
                'password'   => 'required|min:6',
                'role'       => 'required');

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            } 
            else 
            {
                $insertedArr = array(
                    'first_name'       => $request['first_name'],
                    'last_name'        => $request['last_name'],
                    'email'            => $request['email'],
                    'username'         => $request['username'],
                    'password'         => \Hash::make($request['password']),
                    'role_id'          => $request['role'],
                    'public_profile' => $request['first_name'] . '-' . $request['last_name'] . '-' . substr(md5(rand()), 0, 11)
                );

                $email = $request['email'];
                $password = $request['password'];
                $user = User::create($insertedArr);
                $roleName = $this->userRole($user->role_id);

                //new code
                $credentials = ["email" => $email, 'password' => $password];
                if (!$token = JWTAuth::attempt($credentials)) 
                {
                    return $this->respondWithError("Invalid Username/Password");
                }

                $user = User::find(Auth::id());
                $user->device_token = $request->device_token;
                $user->save();
                if ($user->role_id == 1) 
                {
                    return $this->respondWithError("Not Authorized : You are not authorized to login.");
                }
                $user->api_token = $token;
                $user->save();
                //new code end

                $data = array();
                $data['first_name'] = $user->first_name;
                $data['last_name'] = $user->last_name;
                $data['email']  = $user->email;
                $data['username'] = $user->user_name;
                $data['role_id'] = $user->role_id;

                $user->stripe_account = SellerStripeAccounts::Where('user_id', Auth::id())->first();
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Basic Registeration Successful!',
                    'data' => $user,
                    'roleName' => $roleName,
                ], ['x-app-token' => $user->api_token]);
            }
        } 
        catch (Exception $e) 
        {
            return response()->json($e->getMessage());
        }
    }

    /*** @description: Api user Signup & Signin method by Apple Account* @param: null* @return: Json String response*/

     public function redirectToApple()
    {
        $state = bin2hex(random_bytes(5)); // Generate a random state

        $authUrl = 'https://appleid.apple.com/auth/authorize?' . http_build_query([
            'response_type' => 'code',
            'client_id' => 'futurestarrs.com',
            'redirect_uri' => 'https://www.futurestarr.com/apple/callback',
            'state' => $state,
            'scope' => 'email name', // Include the scopes you need
            'response_mode' => 'form_post'
        ]);

        return redirect()->away($authUrl);
    }

    public function handleAppleCallback(Request $request)
    {
      try
      {
         $code = $request->input('code');
         $response = (new Client)->post('https://appleid.apple.com/auth/token', [
            'form_params' => [
                'client_id' => 'futurestarrs.com',
                'client_secret' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiJ9.eyJpc3MiOiI3QzkyMlpRTDQyIiwiaWF0IjoxNjkyMzM5NzI3LCJkb21haW5zIjpbInd3dy5mdXR1cmVzdGFyci5jb20iXX0.gUTKl8rwDE_LCqWkTsSaOHjjkRF5CU4klw_N55NltIge9BT5xgE8dgZx2TkcwIY9Wyr3nWYIbYpQj7u7ucuL5A',
                'code' => $code,
                'grant_type' => 'authorization_code',
                'redirect_uri' => 'https://www.futurestarr.com/apple/callback',
            ],
          ]);

          $data = json_decode((string) $response->getBody(), true);

        // Check if the user already exists in your database
        // $user = User::where('apple_id', $appleUser->id)->first();
        // if (!$user) 
        // {
        //     // Create a new user using Apple data
        //     $user = User::create([
        //         'apple_id' => $appleUser->id,
        //     ]);
        // }

        // Auth::login($user, true);

        return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Basic Registeration Successful!',
                    'data' => $data,
                ]);
      }
      catch(\Throwable $th)
      {
        throw $th;
      }
    }

    /*** @description: Api user logout method* @param: null* @return: Json String response*/
    public function logout(Request $request)
    {
        try 
        {
            $api_token = $request->header('authorization');
            $api_token  = trim(str_replace("bearer", "", $api_token));
            $api_token  = trim(str_replace("Bearer", "", $api_token));

            $user = User::find(Auth::id());

            $user->api_token = null;
            $user->device_token = null;
            $user->save();
            
            JWTAuth::setToken($api_token)->invalidate();
            $this->setStatusCode(Res::HTTP_OK);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Logout successful!',
            ]);

        } 
        catch (JWTException $e) 
        {
            return $this->respondInternalError($e->getMessage());
        }
    }

    /*** @description: Update User Account Password Method* @param: User Id respective to password updated* @return: Json String response*/

    public function updateUserPassword($user_id = null, Request $request)
    {
        $rules = array(
            'password' => 'required|min:6',
            'password_confirmation'  => 'required|min:6|same:password');

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {
            return $this->respondValidationError('Fields Validation Failed.', $validator);
        } 
        else 
        {
            $user = User::where('id', $user_id)->first();
            if (!empty($user->id)) 
            {
                $user->password   = \Hash::make($request['password']);
                $user->updated_at = date('Y-m-d h:i:s');
                $user->save();
                if ($user->id) 
                {
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => "User Password Successfully Updated!"]);
                }
            } 
            else 
            {
                return $this->respondWithError("No Such Record Found!!");
            }
        }
    }
    public function updateProfilePicture (Request $request)
    {
        try {
            $rules = array(
                'profile_pic' => 'required|mimes:jpeg,bmp,png,jpg',);
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            } 
            else 
            {
                $file = $request->file('profile_pic');
                $fileType = $file->getMimeType();
                $fileExt = $file->getClientOriginalExtension();
                $filename = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                $fileName = md5($filename).'.'.$fileExt;
                $userId = Auth::user()->id;

                //Move Uploaded File
                $fpath = env('APP_FILE_UPLOAD','/home/futurest/public_html');
                
                $destinationPath = $fpath.'/public/userImage/';
                $uploaded = $file->move($destinationPath,$fileName);
                $file_name = $uploaded->getFileName();
               
                if($uploaded) 
                {
                    $userProfile = User::where('id', $userId)->first();
                    $userProfile->profile_pic = "userImage/".$file_name;
                    $userProfile->save();  

                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Profile Picture Updated Successfully!',
                        'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                        'profile_pic' => 'userImage/'.$file_name
                    ]);      
                }
            }
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }


    /*** @description: Api For Updating User Current Password ()* @param: email, current password , new password & confirm password* @return: Json String response*/
    public function changePassword(Request $request)
    {
        try {
            $rules = array(
                'current_password' => 'required|string|min:6',
                'password' => 'required|string|min:6|confirmed', 
                'password_confirmation' => 'required');
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) 
            {
              return $this->respondValidationError('Fields Validation Failed.', $validator);
            } 
            else 
            {
                $userId = Auth::user()->id;
                $currentUser = User::find($userId);
                if ($currentUser) 
                {
                    if (!(Hash::check($request->get('current_password'), $currentUser->password))) 
                    {
                        return $this->respondWithError("Current Password Not Matched");
                    }
                    elseif (strcmp($request->get('current_password'), $request->get('password')) == 0) 
                    {
                        return $this->respondWithError("New Password cannot be same as your current password. Please choose a different password.");
                    } 
                    else 
                    {
                        $currentUser->password =  \Hash::make($request['password']);
                        $currentUser->save();

                        return $this->respond([
                            'status' => 'success',
                            'status_code' => $this->getStatusCode(),
                            'message' => 'Password Updated Successfully!']);
                    }
                }
            }
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function fetchUserInfo(Request $request) 
    {
        try {
             $userInfo = [];
             $userId = Auth::user()->id;
             $userInfo = User::find($userId);

             return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'User Information!',
                'file_url' => env('APP_FILE_URL'),
                'data' =>  $userInfo,]);
         } 
         catch (Exception $e) 
         {
            return $this->respondWithError($e->getMessage());
         }
    }

    /*** @description: Api For Updating User Role* @param: userId, roleId* @return: Json String response*/
    public function updateRole(Request $request) 
    {
        try {
            $rules = array(
                'role_id' => 'required',);

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            $userId = Auth::user()->id;
            $user = User::find($userId);
            $user->role_id   =  $request['role_id'];
            $user->save();

             return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'User role has been updated successfully',
                'data' =>  $user]);

         } 
         catch (Exception $e) 
         {
            return $this->respondWithError($e->getMessage());
         }
       
    }

    /*** Handle a CURL Request .** @access public* @param  $url [string] and $params [array]* @return object*/
	public function curlGet($url, $params=array(), $header = [])
	{ 
		$url = $url.'?'.http_build_query($params, '', '&');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response);
		if(empty($response->error))
        {
			$social_login_info = $response;
			$data = array('status'=>'success','value'=>$social_login_info);
			return (object) $data;
		}
        else
        {
			$social_login_error = $response->error->message;
			$data = array('status'=>'fail','value'=>$social_login_error);
			return (object) $data;
		}
    }
    
    public function curlG($Url, $token)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$token,
        'X-Restli-Protocol-Version: 2.0.0',
        'Accept: application/json',
        'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        $response = curl_exec($ch);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($response, $headerSize);
        $response_body = json_decode($body,true);
        return (object) $response_body;
    }

    /*** Handle a Social Login and User Details.** @access public* @param  accessToken [string]* @return JSON response User object or fail*/
	public function socialUserRegister(Request $request)
	{
        $data = $request->all();
		$accessToken = trim($request->get('accessToken'));
	    $data_one = array('accessToken'=>$accessToken);
		$validator = Validator::make($request->all(), [
			'accessToken' => 'required',
            'provider'    => 'required']);
		if($validator->fails())
        {
         return $this->respondValidationError('Fields Validation Failed.', $validator);
		}
        else
        {
            $accessToken = $data['accessToken'];
            $provider = $data['provider'];
            if($provider == 'facebook')
            {
                $socialArray = array(
                    'fields'=>'id,name,first_name,last_name,gender,email,picture.type(square).height(480),hometown,birthday',
                    'access_token'=> $accessToken);
                $socialUserData = $this->curlGet('https://graph.facebook.com/me', $socialArray);
            }
            elseif($provider == 'linkedin')
            {
                $socialUserData = $this->curlG("https://api.linkedin.com/v2/me", $accessToken);
                $socialUserData1 = $this->curlG("https://api.linkedin.com/v2/emailAddress?q=members&projection=(elements*(handle~))", $accessToken);

                $a = 'handle~'; 
                $socialUserData->email = $socialUserData1->elements[0][$a]['emailAddress'];
                $socialUserData->first_name = $socialUserData->localizedFirstName;
                $socialUserData->last_name = $socialUserData->localizedFirstName;
                if($socialUserData->email != null)
                {
                    $socialUserData->status = 'success';
                }
                else
                {
                    return $this->respondWithError("Not Authorized : You are not authorized to login.");
                }
            }
            elseif($provider == 'twitter')
            {
               return $this->curlG("api.twitter.com/oauth/request_token", $accessToken);
            }

			if($socialUserData->status == 'success')
            {
                if($provider == 'facebook')
                {
                    $socialUserData = $socialUserData->value;
                }
					$email = trim($socialUserData->email);
                    $checkemail = User::checkUserEmail($email);
					if($checkemail)
                    {
                        $result = User::checkUserEmailForSocialLogin($email);
						if($result)
                        {
							if(isset($socialUserData->email))
                            {
								$email = $socialUserData->email;
							}
                            else
                            {
							return $this->respondWithOtherError("Not Authorized : You are not authorized to login.", Res::HTTP_BAD_REQUEST);
							}
                            $password = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
							$socialUser = [
								'password' 	    => \Hash::make($password),
								'email' 		=> $email];
							$socialResult = User::createSocialAccount($socialUser);
							if($socialResult)
                            {
								$userLoginInformation = ['email' => $email, 'password' => $password];
								if ($token = JWTAuth::attempt($userLoginInformation)) 
                                {
                                    $user = User::find(Auth::id());
                                    $user->api_token = $token;
                                    $user->save();
                                    $user->stripe_account = SellerStripeAccounts::Where('user_id', Auth::id())->first();
                                    return $this->respond([
                                        'status' => 'success',
                                        'status_code' => $this->getStatusCode(),
                                        'message' => 'Login Successful!',
                                        'data' => $user,
                                    ], ['x-app-token' => $token]);
								}
                                else
                                {
                                    return $this->respondWithError("Not Authorized : You are not authorized to login.");
								}
							}
                            else
                            {
                                return $this->respondWithOtherError("Not Authorized : You are not authorized to login.", Res::HTTP_BAD_REQUEST);
							}
						}
                        else
                        {
                            return $this->respondWithOtherError("Email already registered with Future Starr. Please login using email/username and password.", Res::HTTP_CONFLICT);
						}
					}
                    else
                    {
						if(isset($socialUserData->hometown))
                        {
							$city = explode(',', $socialUserData->hometown->name);
							$city = trim($city[0]);
						}
                        else
                        {
							$city = '';
                        }
						$password = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                        $socialUser = [
                            'first_name'	=> $socialUserData->first_name,
                            'last_name'	    => $socialUserData->last_name,
                            'password' 	    => \Hash::make($password),
                            'email' 		=> $email,
                            'profile_pic' 	=> isset($socialUserData->picture->data->url)? $socialUserData->picture->data->url : '',
                            'city' 		    => $city,
                            'role_id'       => '3',
                            'provider'	    => $provider];

						$socialResult = User::createSocialAccount($socialUser);
                        if($socialResult)
                        {
                           $userLoginInformation = ['email' => $email, 'password' => $password];
                            if ($token = JWTAuth::attempt($userLoginInformation)) 
                            {
                                $user = User::find(Auth::id());
                                $user->api_token = $token;
                                $user->save();

                                $user->stripe_account = SellerStripeAccounts::Where('user_id', Auth::id())->first();
                                return $this->respond([
                                    'status' => 'success',
                                    'status_code' => $this->getStatusCode(),
                                    'message' => 'Registeration Successful!',
                                    'data' => $user,
                                ], ['x-app-token' => $token]);
                            }
                            else
                            {
                                return $this->respondWithError("Not Authorized : You are not authorized to login.");
                            }
                        }
                        else
                        {
                            return $this->respondWithError("Not Authorized : You are not authorized to login.");
                        }
					}
			}
            else
            {
                return $this->respondWithError("Not Authorized : You are not authorized to login.");
			}
		}
    }
    /*** @description: Api For Buyer Account Details* @param: userId* @return: Json String Response*/
    public function buyerAccount(Request $request)
    {
        try {
            $profileData = [];
            $userId = Auth::user()->id;
            $profileData['user'] = User::find(Auth::user()->id);
            $profileData['profileViews'] = ProfileVisitor::where(['profile_id' => $userId])->count();
            $profileData['buyerTotalPurchase'] = PurchasedProduct::where('user_id', '=', $userId)->where('delete_flag', 0)->where('purchased', 1)->sum('total_amount');
                $riders = DB::table('fanbases')
                ->join('users', 'fanbases.follower', '=', 'users.id')
                ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                ->select('fanbases.*', 'users.first_name', 'users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users_roles.name as role')
                ->where('following', $userId)
                ->get();

            $profileData['riders'] = count($riders);
            $following = DB::table('fanbases')
                ->join('users', 'fanbases.following', '=', 'users.id')
                ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                ->select('fanbases.*', 'users.first_name', 'users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users_roles.name as role')
                ->where('follower', $userId)
                ->get();

            $profileData['following'] = count($following);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Buyer Information!',
                'file_url' => env('APP_FILE_URL'),
                'data' =>  $profileData,
            ]);
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    /*** @description: Api For Public Profile Details* @param: publicProfileId
     * @return: Json String Response*/
    public function publicProfile($publicProfileId) 
    {
        try {

            if(!empty($publicProfileId) && is_string($publicProfileId)) 
            {
               $user  = User::where('public_profile', $publicProfileId)->first();
                   if(empty($user)) 
                   {
                        return $this->respond([
                            'status' => 'error',
                            'status_code' => $this->getStatusCode(),
                            'message' => 'Public Profile',
                            'file_url' => env('APP_FILE_URL'),
                            'data' =>  'no such public profile found'
                        ]);
                    }
                    $riders = DB::table('fanbases')
                       ->join('users','fanbases.follower', '=', 'users.id')
                       ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                       ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile',  'users_roles.name as role')
                       ->where('following', $user['id'])
                       ->get();
                    $ride_where = ['following' => $user['id'], 'follower' => !empty(Auth::user()->id) ? Auth::user()->id : '' ];
                    $self_rider = Fanbase::where($ride_where)->first();
                    $following = Fanbase::where('follower', $user['id'])->count();
       
                    $profile_views = ProfileVisitor::where(['profile_id' => $user['id'] ])->count();
                    
                    $talent_where = ['user_id' => $user['id'], 'approved' => 1];
                    $talents = Talents::with(['commercialMedia'])->where($talent_where)->get();
                    /************* TALENT CATEGORIES **************/
                    
                    $talentCategories = TalentCatagory::select('id','name','slug','catagory_image_path','catagory_main_banner','catagory_banner','catagory_detailed_banner','catagory_detailed_icon_img','tarending_catagory_sidebar_icon')->get();
       
                    /************* SOCIAL BUZZ ******************/
       
                    $metaTags = [];
                    $metaTags  = ['title' => $user['username'], 'description' => $user['description'], 'keywords' => $user['username']];
       
                    $check = Auth::check();
                    $whereCondition = ['user_id' => $user['id'], 'active' => 1];
                    $socialBuzzList = SocialBuzz::with('getUserData', 'getTalentCatagories', 'getSocialBuzzComments', 'getSocialBuzzRiders', 'getSocialBuzzAwards', 'alreadyAwarded', 'selfRider')->where($whereCondition)->orderBy('id', 'DESC')->get();
        
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Public Profile',
                    'file_url' => env('APP_FILE_URL'),
                    'data' =>  ['userData' => $user,'following' => $following,'riders' => $riders,'selfRider' => $self_rider,'profileViews' => $profile_views,'check' => $check, 'talents' => $talents, 'talentCategories' => $talentCategories,'socialBuzzList' => $socialBuzzList,'metaTags' => $metaTags]
                ]);
            }
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    /*** @description: Api For User Details* @param: userId* @return: Json String Response*/
    public function managePublicProfile(Request $request)
    {
        try 
        {
            $userInfo = [];
            $userId = Auth::user()->id;
            $userInfo = User::find($userId);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'User Information!',
                'file_url' => env('APP_FILE_URL'),
                'data' =>  $userInfo,]);
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    /*** @description: Api For Edit Manage Profile Bio* @param:* @return: Json String Response*/
    public function publicProfileStoreBio(Request $request) 
    {
        try {
            $rules = array(
                 'bio_video' => 'required|mimes:mp4,wav');
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            if(!empty(Auth::check())) 
            {
                $userData = User::find(Auth::user()->id);
                if($request->has('bio_video') ) 
                {
                    $video = $request->file('bio_video');
                
                    $extension = $video->extension();
                    $vidfilename = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                    $video_name = md5($vidfilename). '.' .$extension;

                    $fpath = env('APP_FILE_UPLOAD','/home/futurest/public_html');
                    $destinationPath = $fpath.'/public/userImage/video-bio/';
                    $uploaded = $video->move($destinationPath,$video_name);
                    $file_name = $uploaded->getFileName();

                    $video_path = 'userImage/video-bio/' . $file_name;

                }  
                else 
                {
                    $video_path = $userData['bio_video'];
                }
                if(!empty($video_path))
                {
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Profile data updated successfully!',
                        'file_url' => env('APP_FILE_URL'),
                        'data' =>  [
                            'bio_video' => $video_path
                        ]
                    ]);
                } 
                else 
                {
                    return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Unable to upload the requested files. Please try agian later.'
                    ]);
                }
            } 
            else 
            {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Unable to upload the requested files. Please try agian later.']);
            }
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }
    /*** @description: Api For Edit Manage Profile Bio* @param: * @return: Json String Response*/
    public function publicProfileStore(Request $request) 
    {
        try {
            $rules = array('bio_info' => 'required');

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            
            if(!empty(Auth::check())) 
            {
                $userData = User::find(Auth::user()->id);
                if($request['encode_image'])
                {  
                    $banner_image = $request['encode_image'];
                }
                else
                {
                    $banner_image = $userData['banner_image'];
                }
                if($request['bio_video'])
                {  
                    $bio_video = $request['bio_video'];
                }
                else
                {
                    $bio_video = $userData['bio_video'];
                }
                if($request['bio_info'])
                {  
                    $bio_info = $request['bio_info'];
                }
                else
                {
                    $bio_info = $userData['bio_info'];
                }
                $table_array = [
                    'bio_video' => $bio_video,
                    'description' => $bio_info,
                    'banner_image' => $banner_image];
                $update = User::where('id', Auth::user()->id)->update($table_array);
                if(!empty($update)) 
                {
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Profile data updated successfully!',
                        'file_url' => env('APP_FILE_URL'),
                        'data' =>   $table_array]);
                } 
                else 
                {
                    return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Unbale to process the request. Please try agian later.']);
                }
            } 
            else 
            {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Unable to upload the requested files. Please try agian later.']);
            }
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    /*** @description: Api For Edit Manage Profile Image* @param: * @return: Json String Response*/
    public function publicProfileStoreImage(Request $request) 
    {
        try {
            $rules = array(
                'encode_image' => 'required|mimes:jpeg,bmp,png,jpg');
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            if(!empty(Auth::check())) 
            {
                $userData = User::find(Auth::user()->id);
                $image_data = $request['encode_image'];
                if(!empty($image_data)) 
                {
                    $file = $request->file('encode_image');
                    $fileType = $file->getMimeType();
                    $fileExt = $file->getClientOriginalExtension();
                    $imgfilename = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 1) . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
                    $fileName = md5($imgfilename).'.'.$fileExt;
                    $fpath = env('APP_FILE_UPLOAD','/home/futurest/public_html');
                    $destinationPath = $fpath.'/public/userImage/banner/';
                    $uploaded = $file->move($destinationPath,$fileName);
                    $file_name = $uploaded->getFileName();
                    $path_name = 'userImage/banner/' . $file_name;
                } 
                else 
                {
                    $path_name = $userData['banner_image'];
                }
                if(!empty($path_name))
                {
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Profile data updated successfully!',
                        'file_url' => env('APP_FILE_URL'),
                        'data' =>  [
                            'banner_image' => $path_name
                        ]
                    ]);
                } 
                else 
                {
                    return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Unable to upload the requested files. Please try agian later.']);
                }
            } 
            else 
            {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Unable to upload the requested files. Please try agian later.']);
            }
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    /*** @description: Api For Edit/Add Cover Pic* @param: * @return: Json String Response*/
    public function editCoverPic(Request $request) 
    {
        try {
            $rules = array(
                'encode_image' => 'required|mimes:jpeg,bmp,png,jpg');
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            if(!empty(Auth::check())) 
            {
                $userData = User::find(Auth::user()->id);
                $image_data = $request['encode_image'];
                if(!empty($image_data)) 
                {
                    $file = $request->file('encode_image');
                    $fileType = $file->getMimeType();
                    $fileExt = $file->getClientOriginalExtension();
                    $fileName = md5($file->getClientOriginalName()).'.'.$fileExt;
                    $fpath = env('APP_FILE_UPLOAD','/home/futurest/public_html');
                    $destinationPath = $fpath.'/public/userImage/banner/';
                    $uploaded = $file->move($destinationPath,$fileName);
                    $file_name = $uploaded->getFileName();
                    $path_name = 'userImage/banner/' . $file_name;
                        
                } 
                else 
                {
                    $path_name = $userData['banner_image'];
                }
                if(!empty($path_name))
                {
                    $table_array = ['banner_image' => $path_name];
                    $update = User::where('id', Auth::user()->id)->update($table_array);
                    if(!empty($update)) 
                    {
                        return $this->respond([
                            'status' => 'success',
                            'status_code' => $this->getStatusCode(),
                            'message' => 'Profile data updated successfully!',
                            'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                            'profile_pic' => $path_name
                        ]);
                    } 
                    else 
                    {
                        return $this->respond([
                            'status' => 'error',
                            'status_code' => $this->getStatusCode(),
                            'message' => 'Unbale to process the request. Please try agian later.']);
                    }
                } 
                else 
                {
                    return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Path name can not be empty.']);
                }
            } 
            else 
            {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'You need to login first.']);
            }
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    /*** @description: Api For Seller Account Details* @param: null* @return: Json String Response*/
    public function sellerAccount(Request $request)
    {
        try {
            $profileData = [];
            $userId = Auth::user()->id;
            $profileData['user'] = User::find($userId);
            $profileData['profileViews'] = ProfileVisitor::where(['profile_id' => $userId])->count();

            $riders = DB::table('fanbases')
                ->join('users', 'fanbases.follower', '=', 'users.id')
                ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                ->select('fanbases.*', 'users.first_name', 'users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users_roles.name as role')
                ->where('following', $userId)
                ->get();

            $profileData['riders'] = count($riders);

            $talendIdArray = [];
            $today = Carbon::now()->format('Y-m-d');
            $condition = ['user_id' => Auth::user()->id ];
                $sellerTalent = BuyerProducts::where($condition)->get();
                if (!empty($sellerTalent)) 
                {
                    foreach ($sellerTalent as $key => $value) 
                    {
                        $talentId = $value->talent_id;
                        array_push($talendIdArray, $talentId);
                    }
                }
            $whereCondition = ['date' => $today, 'active' => 1, 'user_id' => Auth::user()->id];
            $profileData['dailySales'] = BuyerProducts::with('getTalent')->whereIn('talent_id', $talendIdArray)->where($whereCondition)->count();

            $following = DB::table('fanbases')
                ->join('users', 'fanbases.following', '=', 'users.id')
                ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                ->select('fanbases.*', 'users.first_name', 'users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users_roles.name as role')
                ->where('follower', $userId)
                ->get();

            $profileData['following'] = count($following);

            $talentCondition = ['user_id' => $userId, 'active' => 'Active'];
            $talents = Talents::where($talentCondition)->get();
            $talentIdsArray = [];
            foreach ($talents as $key => $value) 
            {
                array_push($talentIdsArray, $value->id);
            }
            $profileData['awardsCount'] = TalentAwards::WhereIn('talent_id', $talentIdsArray)->with('getUsers', 'getTalents')->get()->count();
            $profileData['stripe_account'] = SellerStripeAccounts::Where('user_id', Auth::id())->first();
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Seller Information!',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' =>  $profileData,
            ]);
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    /*** @description: Api For user Account Update* @param: user Data* @return: Json String Response*/
    public function userAccountUpdate(Request $request) 
    {
        try {
            if (!empty(Auth::check())) 
            {
                $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
                $rules = array(
                    'bio_information' => 'required',
                    'first_name' => 'required|regex:/^[a-zA-Z]+$/u', 
                    'last_name' => 'required|regex:/^[a-zA-Z]+$/u',
                    'city' => 'required',
                    'zip_code' => 'regex:/^[0-9]+$/u|min:5|max:9', 
                    'phone' => 'regex:/^[0-9]+$/u|min:10');
                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) 
                {
                    return $this->respondValidationError('Fields Validation Failed.', $validator);
                }
                $user = user::findOrFail($id);
                $user->description = $request['bio_information'];
                $user->first_name = $request['first_name'];
                $user->last_name = $request['last_name'];
                if ($request->hasFile('profile_pic')) 
                {
                    $image = $request->file('profile_pic');
                    $extension = $image->extension();
                    $name = md5($image->getClientOriginalName()). '.' .$extension;
                    $destinationPath = public_path('/userImage');
                    chmod($image->move($destinationPath, $name), 0777);
                    $imageName = 'userImage/'.$name;
                    $user->profile_pic  = $imageName;
                }
                $user->address = $request['address'];
                $user->city = $request['city'];
                $user->state = $request['state'];
                $user->zip_code = $request['zip_code'];
                $user->phone = $request['phone'];
                $user->save();
                
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'User Information Updated!',
                    'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                    'data' =>  $user]);
            } 
            else 
            {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'You have to login first!']);
            }
        } 
        catch(Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }             
    }
    
  /*** @description: Api To Get Riders* @param: null* @return: Json String Response*/
    function getRiders(Request $request) 
    {
        try {
            if (!empty(Auth::check())) 
            {
                $per_page = isset($request->per_page) ? $request->per_page : 10;
                $isRiderOfAnotherUser = false;
                $userId = isset($request->user_id) ? $request->user_id : Auth::user()->id;
                $riders = DB::table('fanbases')
                        ->join('users','fanbases.follower', '=', 'users.id')
                        ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                        ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users_roles.name as role', 'users_roles.id as role_id')
                        ->where('following', $userId)
                        ->paginate($per_page);

                if(isset($request->user_id) && $request->user_id)
                {
                    $following = $request->user_id;
                    $follower = Auth::user()->id;
                    $fanbases = DB::table('fanbases')
                        ->select('fanbases.id')
                        ->where('following', $following)
                        ->where('follower', $follower)
                        ->first();
                    $isRiderOfAnotherUser = isset($fanbases) ? true : false;
                }
                
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Total riders',
                    'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                    'isRiderOfAnotherUser' => $isRiderOfAnotherUser,
                    'riders' => $riders
                ]);
            } 
            else 
            {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Plaese Login First!'
                ]);
            }
        } 
        catch(Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    /*** @description: Api To Get Followings* @param: null* @return: Json String Response*/
    function getFollowing(Request $request) 
    {
        try {
            if (!empty(Auth::check())) 
            {
                $per_page = isset($request->per_page) ? $request->per_page : 10;
                $userId = Auth::user()->id;
                $following = [];
                $following = DB::table('fanbases')
                        ->join('users','fanbases.following', '=', 'users.id')
                        ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                        ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users_roles.name as role', 'users_roles.id as role_id')
                        ->where('follower', $userId)
                        ->paginate($per_page);
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Total following',
                    'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                    'followings' => $following
                ]);
            } 
            else 
            {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Plaese Login First!'
                ]);
            }
        }
        catch(Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    /*** @description: Api To Get Followings* @param: null* @return: Json String Response*/
    function getAwards(Request $request) 
    {
        try {
            if (!empty(Auth::check())) 
            {
                $per_page = isset($request->per_page) ? $request->per_page : 10;
                $userId = Auth::user()->id;
                $talendAward['count'] = getSellerTalentAward($userId);
                $talentCondition = ['user_id' => $userId, 'active' => 'Active'];
                $talents = Talents::where($talentCondition)->get();
                $talentIdsArray = [];
                $talendAwardUsers = [];
                foreach ($talents as $key => $value) 
                {
                    array_push($talentIdsArray, $value->id);
                }
                $talendAward['awards'] = TalentAwards::WhereIn('talent_id', $talentIdsArray)->with('getUsers', 'getTalents')->paginate($per_page);
                // return $talendAward;                
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Total Awards',
                    'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                    'awards' => $talendAward]);
            } 
            else 
            {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Plaese Login First!']);
            }
        } 
        catch(Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    /*** @description: Api To Unfollow Followings* @param: following
     * @return: Json String Response*/
    public function unfollowUser($following) 
    {
        try {
            if(!empty(Auth::check())) 
            {
                $id  = $following;
                $userId = Auth::user()->id;
                
                $unfollow = User::find($id);
                $unfollowUsername = $unfollow->username;

                $where = ['following' => $id , 'follower' => $userId ];
                $unfollow = Fanbase::where($where)->delete();
                
                if(!empty($unfollow)) 
                {
                    $soc_where = ['user_id' => $userId, 'social_buzz_by' => $id];
                    SocialBuzzRiders::where($soc_where)->delete();

                    $talent_where = ['user_id' => $userId, 'talent_by' => $id];
                    TalentRiders::where($talent_where)->delete();

                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'You have unfollow '.$unfollowUsername]);
                } 
                else 
                {
                    return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Wrong follower Id']);
                }
            } 
            else 
            {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Login First!']);
            }
        } 
        catch(Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }
    public function contactUs(Request $request)
    {
        try {
            $rules = array(
                'name'        => 'required',
                'email'       => 'required',
                'message'     => 'required',);

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
                
            $insertedArr = array(
                'name'    => $request['name'],
                'email'   => $request['email'],
                'message' => $request['message'],
            );

            $contact = ContactUs::create($insertedArr);

            $this->sendConfirmationMail($request['email'], $request['name']);
            $this->sendContactRequestMailToAdmin('custserv@futureStarr.com', 'Futurestarr', $request);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Message sent successfully!',
            ]);
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function deleteUserAccount(Request $request)
    {
        try{
            $rules = array('description'  => 'required',);
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
             return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            $user = User::find(Auth::id());
            // $user->delete();
            $deleteAccountTableArray = [
                'user_id' => Auth::user()->id,
                'description' => $request->description,
                'account_type' => Auth::user()->role_id,
                'email' => Auth::user()->email];

            Auth::logout();
            if ($user->delete()) 
            {
                DeletedAccount::insert($deleteAccountTableArray);
            }

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Your account has been deleted!',
            ]);
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }
    public function changeUserAccountPassword(Request $request)
    {
        try{
            $rules = array(
                'current_password' => 'required|string|min:8',  
                'password' => 'min:8|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:8');

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) 
            {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Your current password does not matches with the password you provided. Please try again.',]);
            }

            $user = Auth::user();
            $user->password = bcrypt($request->get('password'));
            $user->save();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Password changed successfully!',
            ]);
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }
    public function usernotification()
    {
        if(Auth::user())
        {
                $notification = [];
                $dashboard = ChatMessage::where('read_flag',0)->where('received_by',Auth::user()->id)->count();
                $notification["dashboard"] = (string)$dashboard;

                $socialbuzzrider = SocialBuzzRiders::where('social_buzz_by',Auth::user()->id)->where('read_flag',0)->count();
                $socialbuzzcomment = SocialBuzzComments::where('post_user_id',Auth::user()->id)->where('read_flag',0)->count();
                $socialbuzzaward = SocialBuzzAwards::where('post_user_id',Auth::user()->id)->where('read_flag',0)->count();

                $notification["socialbuzz"] = (string)($socialbuzzrider+$socialbuzzcomment+$socialbuzzaward);
                $notification["total"] = (string)($dashboard+$socialbuzzrider+$socialbuzzcomment+$socialbuzzaward);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'notifications',
                'notification' => &$notification]);
        }
    }
    public function usernotification2()
    {
        if(Auth::user())
        {
            $notification = [];
            $notification["dashboard"] = (string)ChatMessage::where('read_flag',0)->where('received_by',Auth::user()->id)->count();

            $socialbuzzrider = SocialBuzzRiders::where('social_buzz_by',Auth::user()->id)->where('read_flag',0)->count();
            $socialbuzzcomment = SocialBuzzComments::where('post_user_id',Auth::user()->id)->where('read_flag',0)->count();
            $socialbuzzaward = SocialBuzzAwards::where('post_user_id',Auth::user()->id)->where('read_flag',0)->count();
            $notification["socialbuzzrider"] = (string)$socialbuzzrider;
            $notification["socialbuzzcomment"] = (string)$socialbuzzcomment;
            $notification["socialbuzzaward"] = (string)$socialbuzzaward;
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'notifications',
                'notification' => &$notification]);
        }
    }
}
