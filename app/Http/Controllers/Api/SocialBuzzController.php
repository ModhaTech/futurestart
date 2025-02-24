<?php 
namespace App\Http\Controllers\Api;
use App\Http\Requests;
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
use Auth;
use App\Traits\MailsendTrait;
use App\Models\TalentCatagory;
use App\Models\SocialBuzz;
use App\Models\SocialBuzzComments;
use App\Models\SocialBuzzReplies;
use App\Models\SocialBuzzRiders;
use App\Models\SocialBuzzAwards;
use App\Models\SocialBuzzReports;
use App\Models\CommercialAds;
use App\Models\Fanbase;
use App\Models\Talents;
use App\Models\SocialBuzzViews;
use App\User;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class SocialBuzzController extends ApiController
{
    use MailsendTrait;

     public function socialBuzz(Request $request) 
    {
        try 
        {
            if(Auth::user())
            {
                $socialbuzzrider = SocialBuzzRiders::where('social_buzz_by',Auth::user()->id)->where('read_flag',0)->update(['read_flag' => 1]);
                $socialbuzzcomment = SocialBuzzComments::where('post_user_id',Auth::user()->id)->where('read_flag',0)->update(['read_flag' => 1]);
                $socialbuzzaward = SocialBuzzAwards::where('post_user_id',Auth::user()->id)->where('read_flag',0)->update(['read_flag' => 1]);            
            }
            $per_page = $request->per_page ? $request->per_page : 10;
            $socialBuzzList = array();
            $whereArr = array('category_id' => $request->category_id, 'active' => 1);
           
            // set Cache for get Server Data

            //   if (Cache::has('socialbuzzlistcache')) 
            // {
            //     $socialBuzzList = Cache::get("socialbuzzlistcache");
            // } 
            // else 
            // {
                $socialBuzzList = SocialBuzz::withCount(['getSocialBuzzComments', 'getSocialBuzzRiders', 'getSocialBuzzAwards','getSocialBuzzViewcount', 'totalPurchase'])->with(['getUserData'])->where($whereArr)->orderBy('id', 'DESC')->paginate($per_page);
                
             //     $expiresAt = Carbon::now()->endOfDay();
             //     Cache::put("socialbuzzlistcache", $socialBuzzList, $expiresAt);
                
             // }

            foreach ($socialBuzzList as $socialbuzz) 
            {
                 $socialbuzz->comment = str_replace('https://', '', $socialbuzz->comment);
                  $socialbuzz->comment = str_replace('http://', '', $socialbuzz->comment);
                  $socialbuzz->comment = str_replace('www.', '', $socialbuzz->comment);
            }

                return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Social Buzz Listing!',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' =>  $socialBuzzList]);
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    /*** Create Social Buzz post ***/

    public function postSocialBuzz(Request $request) 
    {
        // return json_encode($request->comment);
     try 
        {
            $rules = array(
                'comment'      => 'required',
                'category_id'  => 'required|numeric|min:0|not_in:0',
            'media_file'   => 'sometimes|mimes:jpeg,jpg,png,mp4,wav,mp3,mpeg|required',);
          
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            } 
            else 
            {
                $posted_by = Auth::user()->id;
                if ($request->hasFile('media_file')) 
                {
                    $image = $request->file('media_file');
                    $name = time() . '.' . $image->getClientOriginalName();
                        
                    $fpath = env('APP_FILE_UPLOAD','/home/futurest/public_html');
                    $destinationPath = $fpath.'/public/uploads/social-buzz/';
                       
                    chmod($image->move($destinationPath, $name),0777);
                    $imageName = 'uploads/social-buzz/' . $name;
                } 
                else 
                {
                    $imageName = '';
                }
                   $table_array  = [ 
                        'user_id' => $posted_by, 
                        'category_id' => $request->category_id, 
                        // 'comment' => $request->comment, 
                        // 'comment' => json_decode('"' . str_replace('%', '\\', $request->comment) . '"'), 
                        'comment' => urldecode($request->comment), 
                        'product_link' => $request->product_link, 
                        'product_img_path' => $imageName, 
                        'posted_by' => $posted_by, 
                        'updated_by' => $posted_by, 
                        'media_type' => $request->media_type ];

                    SocialBuzz::create($table_array);
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Social Buzz posted saved successfully!',]);
             }
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    /*** Update Social Buzz  post ***/

    public function updateSocialBuzz(Request $request) 
    {
        try 
        {
            $rules = array(                
                'social_buzz_id' => 'required|numeric|min:0|not_in:0',
                'comment'        => 'required',
                'category_id'    => 'required|numeric|min:0|not_in:0',
                'media_file'     => 'sometimes|mimes:jpeg,jpg,png,mp4,wav,mp3,mpeg|required',);
            
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            } 
            else 
            {
                $posted_by = Auth::user()->id; 
                if($request->has('media_file')) 
                {
                    $image = $request->file('media_file');
                    $name = time() . '.' . $image->getClientOriginalName();
                    
                    $fpath = env('APP_FILE_UPLOAD','/home/futurest/public_html');
                    $destinationPath = $fpath.'/public/uploads/social-buzz/';
                    
                    chmod($image->move($destinationPath, $name),0777);
                    $imageName = 'uploads/social-buzz/' . $name;

                    if($request['previous_file'] !='' && file_exists($request['previous_file']))
                    {
                            $file_path = public_path().'/'.$request['previous_file'];
                            unlink($file_path);
                    }       
                } 
                else 
                {
                    $imageName = $request['previous_file'];
                }                
                    $table_array  = [ 
                        'user_id' => $posted_by, 
                        'category_id' => $request->category_id, 
                        'comment' => $request->comment, 
                        'product_link' => $request->product_link, 
                        'product_img_path' => $imageName, 
                        'posted_by' =>$posted_by, 
                        'updated_by' => $posted_by, 
                        'media_type' => $request->media_type];
                
                $updateCondition = ['id'=> $request->social_buzz_id, 'user_id' => $posted_by ];
                $updated = SocialBuzz::where($updateCondition)->update($table_array);

                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Social Buzz posted update successfully!',
                ]);
                
            }
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }


    /*
    *
    * Social Buzz Comments get and post functions
    *
    */

    public function postSocialBuzzComment(Request $request) 
    {

           try {
                $rules = array(
                    'comment'      => 'required',
                    'social_buzz_id' => 'required|numeric|min:0|not_in:0'
                );
                // return $request->all();
                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return $this->respondValidationError('Fields Validation Failed.', $validator);
                } else {
                    $socialbuzz = SocialBuzz::find($request->social_buzz_id);
                    // $socialbuzz = SocialBuzz::where('id',$request->social_buzz_id)->first();
                    $posted_by = Auth::user()->id;
                    $table_array = array(
                        'user_id' => $posted_by,
                        'post_id' => $request->social_buzz_id,
                        'post_comment' => $request->comment,
                        'posted_by' => $posted_by,
                        'created_by' => $posted_by,
                        'updated_by' => $posted_by

                     );

                    $socialbuzzcomment = SocialBuzzComments::create($table_array);
                    $socialbuzzcomment->post_user_id = $socialbuzz->user_id;
                    $socialbuzzcomment->save();
                    $socialbuzz = SocialBuzz::find($request->social_buzz_id);
                    $a_user = User::where('id', Auth::user()->id)->first();
                    $b_user = User::where('id', $socialbuzz->user_id)->first();
                    if($socialbuzzcomment->user_id != $socialbuzzcomment->post_user_id){
                        $this->socialbuzz_push_notification($a_user,$b_user,$request->comment,$socialbuzz);
                    }
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Comment posted successfully!',
                    ]);
                    
                }
            } catch (Exception $e) {
                return $this->respondWithError($e->getMessage());
            }
    }
    public function socialbuzz_push_notification($a_user,$b_user,$message,$socialbuzz)
    {
        
        $SERVER_API_KEY = 'AAAAtHD36-M:APA91bHIRdQctCXYBLTO2Svgzz2oq8KcLDfJAkVAM9Lko9hUWloXrHxzzNPOwNegdupY_7Yxx4-iALR8MYwHDaA4Wd8x70VPffX5oX-FrY9uKxVKqcv5iOcNr-kHruGv7UhlfFXTldv2';
  
        $data = [
            "to" => $b_user->device_token,
            "notification" => [
                "title" => $a_user->username, 
                "body" => "comment on your socialbuzz: " .$message,
                "image" => 'https://futurestarr.com/public/'.$socialbuzz->product_img_path,
                "sound" => 'zapsplat_musical.mp3',
            ],
            "data" => [
                "title" => $a_user->username, 
                "body" => " rider on social buzz",
                'user_id'  => $b_user->id
            ],
            "android" => [
                "notification" => [
                    "click_action" => "HomeActivity"
                ]
             ],
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        // curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);      
        curl_close($ch);
        // print_r($response);
        return $response;
    }

    public function getSocailBuzzComments(Request $request) 
    {
       try 
        {
        
            $socialBuzzComments = array();
            $per_page = $request->per_page ? $request->per_page : 10;
            $socialBuzzComments = SocialBuzzComments::with(['commentBy'])->where('post_id', $request->post_id)->paginate($per_page);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Social Buzz Comments!',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' => $socialBuzzComments,
            ]);

        } catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    /*
    *
    * Social Buzz rider get and post functions
    *
    */

    public function postSocialBuzzRider(Request $request) 
    {
        try {
            $rules = array(
                'social_buzz_id' => 'required|numeric|min:0|not_in:0'
            );
            
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            } 

            $posted_by = SocialBuzz::where('id', $request->social_buzz_id)->pluck('user_id')->first();

            if ($posted_by == Auth::user()->id) 
            {
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'User can not add yourself as a rider',
                ]);
            }
            $oLd  = SocialBuzzRiders::Where('post_id', $request->social_buzz_id)
                ->where('social_buzz_by', $posted_by)
                ->where('user_id', Auth::user()->id)->first();
            if ($oLd  != null) 
            {
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Rider already added.',
                ]);
            }
            $socialbuzz_rider = SocialBuzz::where('id',$request->social_buzz_id)->first();
            $rider = 1;
            $rider_data = new SocialBuzzRiders();
            $rider_data->post_id = $request->social_buzz_id;
            $rider_data->user_id = Auth::user()->id;
            $rider_data->social_buzz_by = $posted_by;
            $rider_data->platform = 'SocialBuzz';
            $rider_data->save();
            $a_user = User::where('id', Auth::user()->id)->first();
            $b_user = User::where('id', $posted_by)->first();
            $this->rider_push_notification($a_user,$b_user,$socialbuzz_rider);
            $insertedId = $rider_data->id;

            if (!empty($insertedId)) 
            {
                $fan_where =  ['follower' => Auth::user()->id, 'following' => $posted_by ];
                $checkFanbase = Fanbase::where($fan_where)->first();
                
                if(empty($checkFanbase))
                {
                    $fanbase = ['follower' => Auth::user()->id, 'following' => $posted_by ];
                    $insert = Fanbase::create($fanbase);
                }

                $user = User::where('id', $posted_by)->first();
                $message = [];
                $name = $user->first_name.' '.$user->last_name;
                $sender = Auth::user()->first_name.' '.Auth::user()->last_name;
                $message = ['sender'=> $sender, 'name' => $name, 'email' => $user->email, 'content' => ''];
                $sendOrfail = $this->triggerRiderEmail($message);

                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Rider Added Successfully.',
                ]);
            } else {
                return $this->respond([
                    'status' => 'error',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Something went wrong.',
                ]);
            }            
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    public function rider_push_notification($a_user,$b_user,$socialbuzz_rider)
    {
        $SERVER_API_KEY = 'AAAAtHD36-M:APA91bHIRdQctCXYBLTO2Svgzz2oq8KcLDfJAkVAM9Lko9hUWloXrHxzzNPOwNegdupY_7Yxx4-iALR8MYwHDaA4Wd8x70VPffX5oX-FrY9uKxVKqcv5iOcNr-kHruGv7UhlfFXTldv2';
  
        $data = [
            "to" => $b_user->device_token,
            "notification" => [
                "title" => $a_user->username, 
                "body" => " rider on social buzz",
                "image" => 'https://futurestarr.com/public/'.$socialbuzz_rider->product_img_path,
                "sound" => 'zapsplat_musical.mp3',
            ],
            "data" => [
                "title" => $a_user->username, 
                "body" => " rider on social buzz",
                'user_id'  => $b_user->id
            ],
            "android" => [
                "notification" => [
                    "click_action" => "HomeActivity"
                ]
             ],
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);      
        curl_close($ch);
        // print_r($response);
        return $response;
    }

    /**
     * @description: Api To follow Followings
     * @param: following
     * @return: Json String Response
     */
    public function followUser(Request $request) 
    {
        try {
            $rules = array(
                'posted_by'    => 'required|numeric|min:0|not_in:0',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $ride_by = Auth::user()->id;
            $posted_by = $request->posted_by;
            $user = User::find($posted_by);
            if(!$user){
                return $this->respondWithOtherError("User is not available.", Res::HTTP_BAD_REQUEST);
            }
            if($user && $user->role_id == '1' || $ride_by == $user->id){
                return $this->respondWithOtherError("You can not be a rider of Admin/Yourself.", Res::HTTP_BAD_REQUEST);
            }else{
                $fan_where =  ['follower' => $ride_by, 'following' => $posted_by ];
                $checkFanbase = Fanbase::where($fan_where)->first();
                if(empty($checkFanbase)){
                    $fanbase = ['follower' => $ride_by, 'following' => $posted_by ];
                    $message = Fanbase::create($fanbase);
                    $a_user = User::where('id', Auth::user()->id)->first();
                    $b_user = User::where('id', $posted_by)->first();
                    $this->push_notification($a_user,$b_user);
                    $user = User::where('id', $posted_by)->first();
                    $message = [];
                    $name = $user->first_name.' '.$user->last_name;
                    $sender = Auth::user()->first_name.' '.Auth::user()->last_name;
                    $message = ['sender'=> $sender, 'name' => $name, 'email' => $user->email, 'content' => ''];
                    $sendOrfail = $this->triggerRiderEmail($message);
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Rider added successfully!',
                    ]);
                }else{
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'You are already a rider!',
                    ]);
                }
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    public function push_notification($a_user,$b_user)
    {
      
        $SERVER_API_KEY = 'AAAARUKFSpY:APA91bFXtp6KYd1pnxUmccyi8acVKmPt4y9JqpqAQkDkb3S_rPPOt0280nFFcEIXYDHNPHui0dryJAECcPRBfc3Xl-6JK-Gd1B8_xZo4kcFcByRJqOFUNuMijwPZZ4PNAbBOvAIoJcqf';
  
        $data = [
            "to" => $b_user->device_token,
            "notification" => [
                "title" => $a_user->username, 
                "body" => "started following you",
                "sound" => 'zapsplat_musical.mp3',
            ],
            "data" => [
                "title" => $a_user->username, 
                "body" => "started following you",
                'user_id'  => $b_user->id
            ],
            "android" => [
                "notification" => [
                    "click_action" => "HomeActivity"
                ]
             ],
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);      
        curl_close($ch);
        // print_r($response);
        return $response;
    }

    public function getSocailBuzzRiders(Request $request) 
    {
        try {
            
            $rules = array('post_id' => 'required|numeric|min:0|not_in:0',);

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $per_page = $request->per_page ? $request->per_page : 10;
            
            $data['riders'] = SocialBuzzRiders::with(['rideBy'])->where('post_id', $request->post_id)->paginate($per_page);

            $socialBuzzRiders = SocialBuzzRiders::with(['rideBy'])
                ->where('post_id', $request->post_id)
                ->where('user_id', Auth::id())
                ->first();
            if ($socialBuzzRiders == null) 
            {
                $data['isRider'] = false;
            }
            else
            {
                $data['isRider'] = true;
            }

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Social Buzz Riders!',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' => $data,
            ]);

        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    } 
    /*
    *
    * Social Buzz award get and post functions
    *
    */
    public function postSocialBuzzAward(Request $request)
    {
        try {
            $rules = array(                
                'social_buzz_id' => 'required|numeric|min:0|not_in:0'
            );
          
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            } else {
                $ride_by = Auth::user()->id;
                $checkCondition = ['user_id' => $ride_by, 'post_id' => $request->social_buzz_id ];
                $checkAlreadyExist = SocialBuzzAwards::where($checkCondition)->first();

                if(!empty($checkAlreadyExist)) 
                {
                   
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Already awarded the SocialBuzz.',
                    ]);

                } 
                else 
                {
                    $award = 1;
                    $table_array = array(
                        'user_id' => $ride_by,
                        'post_id' => $request->social_buzz_id,
                        'award'   => $award            
                     );
                    
                    $awarded = SocialBuzzAwards::create($table_array);

                    $social_buzz = SocialBuzz::find($awarded->post_id);
                    $awarded->post_user_id = $social_buzz->user_id;
                    $awarded->save();
                    $a_user = User::where('id', Auth::user()->id)->first();
                    $b_user = User::where('id', $social_buzz->user_id)->first();
                    $this->award_push_notification($a_user,$b_user);
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Award Added Successfully.',
                    ]);
                }
                
            }
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }
    public function award_push_notification($a_user,$b_user)
    {
        
        $SERVER_API_KEY = 'AAAAtHD36-M:APA91bHIRdQctCXYBLTO2Svgzz2oq8KcLDfJAkVAM9Lko9hUWloXrHxzzNPOwNegdupY_7Yxx4-iALR8MYwHDaA4Wd8x70VPffX5oX-FrY9uKxVKqcv5iOcNr-kHruGv7UhlfFXTldv2';

        $data = [
            "to" => $b_user->device_token,
            "notification" => [
                "title" => $a_user->username, 
                "body" => "award your social buzz",
                "sound" => 'zapsplat_musical.mp3',
            ],
            "data" => [
                "title" => $a_user->username, 
                "body" => "award your social buzz",
                'user_id'  => $b_user->id
            ],
            "android" => [
                "notification" => [
                    "click_action" => "HomeActivity"
                ]
             ],
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        // curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);      
        curl_close($ch);
        // print_r($response);
        return $response;
    }
    public function getSocialBuzzAwards(Request $request) 
    {
        
        try {
            
            $rules = array(                
                'post_id' => 'required|numeric|min:0|not_in:0'
            );
          
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            
            $per_page = $request->per_page ? $request->per_page : 10;
            // $getSocialBuzzAwards = array();
            
            $data['awards'] = SocialBuzzAwards::with(['awardBy'])->where('post_id', $request->post_id)->paginate($per_page);
            $checkAward = SocialBuzzAwards::where('post_id', $request->post_id)->where('user_id', Auth::id())->first();
            if ($checkAward == null) {
                $data['isAwarded'] = false;
            }else{
                $data['isAwarded'] = true;
            }

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Social Buzz Awards!',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' => $data,
            ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    } 

    public function socialBuzzReport(Request $request)  {
       
        try {
            $rules = array(                
                'social_buzz_id' => 'required|numeric|min:0|not_in:0'
            );
          
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            } else {
                $user_id = Auth::user()->id;
                $checkCondition = ['post_id' => $request->social_buzz_id, 'user_id' => $user_id];
                $checkAlreadyExist = SocialBuzzReports::where($checkCondition)->first();

                if(!empty($checkAlreadyExist)) {
                
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Already Reported!.',
                    ]);

                } else {

                    $table_array = array (
                       'post_id' => $request->social_buzz_id,
                        'user_id' => $user_id
                    );

                    $saved = SocialBuzzReports::create($table_array);
                    /*** REPORTER DATA START*******/
                    $reporter = User::find($user_id);

                    $report_name = $reporter['first_name'] . ' ' . $reporter['last_name'];
                    $report_email = $reporter['email'];
                    /*** REPORTER DATA END*******/
                    /*** REPORT DATA START ******/
                    $whereArr = array('id' => $request['social_buzz_id'], 'active' => 1);
                    $reportData = SocialBuzz::with('getUserData')->where($whereArr)->first();
                    $email = $reportData->getUserData['email'];
                    $name = $reportData->getUserData['first_name'] . ' ' . $reportData->getUserData['last_name'];
                    $comment = $reportData['comment'];
                    $created_at = $reportData->getUserData['created_at'];
                    /** REPORT DATA END **/
                   
                    /** EMAIL FUNCTION **/
                    $mail = $this->sendReportRequestMailToAdmin($email, $name, $comment, $report_name, $report_email);
                    /** EMAIL FUNCTION END **/

                    return $this->respond([
                        'status' => 'success',   
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Reported Successfully!.',   
                    ]);
                }

            }          
            
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

    }

    public function socialBuzzProductListing(Request $request) {
             
        try {      
        
            $productListng = array();  
            $user_id = Auth::user()->id;        
            $talentCondition = ['user_id' => $user_id, 'active'=>'Active','approved' => 1,'delete_flag'=>0];    
            $productListng  = Talents::where($talentCondition)->get();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Social Buzz Product Listing!',   
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' => $productListng,
            ]);

        } catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function getAds(Request $request)
    {
        try {
        
            $ads = getAds($request->category_id);
            foreach ($ads as $key => $ad) {
                 $t = Talents::where('id', $ad->product_id)->first();
                 if ($t != null) 
                 {
                    $ad->slug = $t->slug;
                 }else{
                    $ad->slug = null;
                 }
                 
            }

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Social Buzz Product Listing!',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' => $ads,
            ]);

        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

    // Video View count
    public function storeViewcount(Request $request)
    {
      try 
      {
        $user_id = Auth::user()->id;
        $socialbuzzviews = SocialBuzzViews::where('user_id',$user_id)->where('post_id',$request->post_id)->first();
        if (!empty($socialbuzzviews)) 
        {
             return $this->respond([
                'status' => 'success',
                'message' => 'User already view']);
        }
        else
        {
            $socialbuzz = new SocialBuzzViews();
            $socialbuzz->post_id = $request->post_id;
            $socialbuzz->user_id = $user_id;
            $socialbuzz->views = 1;
            $socialbuzz->save();
            return $this->respond([
                'status' => 'success',
                'message' => 'Social Buzz Video Count Store!']);
        }
       }
       catch (Exception $e) 
       {
           return $this->respondWithError($e->getMessage());
       }
     }

    public function getSocailBuzzViews(Request $request) 
    {
    	try 
        {
        	$socialBuzzViews = array();
            $per_page = $request->per_page ? $request->per_page : 10;
            $socialBuzzViews = SocialBuzzViews::with(['viewBy'])->where('post_id', $request->post_id)->paginate($per_page);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Social Buzz Views!',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' => $socialBuzzViews,
            ]);
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    public function getFollowers(Request $request){
        try 
        {
            if(Auth::user())
            {
                
              $followersids = Fanbase::where('following', Auth::user()->id)->select('follower')->get();
              $per_page = $request->per_page ? $request->per_page : 10;
              $followers_details = User::whereIn('id', $followersids)->select('id', 'role_id', 'first_name', 'last_name', 'username', 'email', 'profile_pic')->paginate($per_page);
              return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'All followers details !',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' => $followers_details,
            ]);
            }else{
                return 'ok';
            }
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    public function followersSendMail(Request $request){
        try 
        {
            // return $request;
            $rules = array(
                'emails' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
               $user = Auth::user();
               
            foreach ($request->emails as $key => $to) {
                $touser = User::where('email', $to)->first();
                
                Mail::send('email-templates.follow-as-rider', ['user' => $user, 'touser' => $touser, 'pathToImage' => public_path() . "/assets/images/futurelogo.png", 'to' => $to], function ($message) use ($user, $to) 
        		{
        			$message->from($user->email);
        			$message->to($to);
        			$message->subject("Request to follow as a 'Rider'");
        		});

                                // Start push Notification code

                $SERVER_API_KEY = 'AAAAtHD36-M:APA91bHIRdQctCXYBLTO2Svgzz2oq8KcLDfJAkVAM9Lko9hUWloXrHxzzNPOwNegdupY_7Yxx4-iALR8MYwHDaA4Wd8x70VPffX5oX-FrY9uKxVKqcv5iOcNr-kHruGv7UhlfFXTldv2';

                 $data = [
                     //"registration_ids" => $user->device_token,
                    "to" => $touser->device_token,
                    "notification" => [
                        "title" => "You Have Recive A Mail Please Check Your Email", 
                        "body" => "Recive Mail | futurestarr",
                        // "image" => url($message->attachment),
                       // "sound" => 'zapsplat_musical.mp3',
                        // "click_action" => "TOP_STORY_ACTIVITY"v
                    ],
                    "android" => [         
                        "notification" => [
                            "click_action" => "HomeActivity"
                        ]
                     ],
                ];

                 $dataString = json_encode($data);

                 $headers = [
                    'Authorization: key=' . $SERVER_API_KEY,
                    'Content-Type: application/json',
                ];
    
                $ch = curl_init();
              
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                       
                $response = curl_exec($ch);      
                curl_close($ch);

                            // End push Notification code ************

            }
    		if (Mail::failures()) 
    		{
    			return false;
    		}else{
              return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Mail has been send!',
              ]);
    		}
            
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }
    }

}
