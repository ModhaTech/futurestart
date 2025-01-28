<?php 

namespace App\Http\Controllers\Api;

use App\Lib\PusherFactory;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use DB;
use App\User;
use App\Models\Fanbase;
use Cache;
use App\Traits\MailsendTrait;

class FloatChatController extends ApiController
{
    use MailsendTrait;
    public function users(Request $request) 
    {
        try{
            $users = [];
            $fav_users = [];
            $following = DB::table('fanbases')
                ->join('users','fanbases.follower', '=', 'users.id')
                ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                // ->leftJoin('messages_live', 'fanbases.follower', '=', 'messages_live.from_user')
                ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users.username', 'users.email', 'users.activity', 'users_roles.name as role','users_roles.id as role_id')
                ->where('following', Auth::user()->id)
                ->where('follower','!=' ,Auth::user()->id)
                ->where('is_fav','!=' , '1');
            if (isset($request->search)) 
            {
                $following->where('users.username','LIKE',"%{$request->search}%");
            }            
            $following = $following->get()->toArray();
            foreach ($following as $key => $follow)
            {
                // $time = \Carbon\Carbon::parse($follow->activity)->subHours(4);
                $follow->online = Cache::get('user_is_online_'.$follow->user_id) ? 'online' : 'offline';
                $follow->message_count = DB::table('messages_live')->where('from_user', $follow->user_id)->where('to_user',Auth::user()->id)->where('notify', 1)->count();
            }
            $fav = DB::table('fanbases')
                ->join('users','fanbases.follower', '=', 'users.id')
                ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
                // ->leftJoin('messages_live', 'fanbases.follower', '=', 'messages_live.from_user')
                ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users.username', 'users.email', 'users.activity', 'users_roles.name as role','users_roles.id as role_id')
                ->where('following', Auth::user()->id)
                ->where('follower','!=' ,Auth::user()->id)
                ->where('is_fav','!=' , '0');
            if (isset($request->search)) {
                $fav->where('users.username','LIKE',"%{$request->search}%");
            }            
            $fav = $fav->get()->toArray();
            foreach ($fav as $key => $follow){
                $follow->online = Cache::get('user_is_online_'.$follow->user_id) ? 'online' : 'offline';
                // $follow->message_count = DB::table('messages_live')->where('from_user', $follow->user_id)->where('notify', 1)->count();
                $follow->message_count = DB::table('messages_live')->where('from_user', $follow->user_id)->where('to_user',Auth::user()->id)->where('notify', 1)->count();
            }

            $data['users'] = $following;
            $data['fav_users'] = $fav;

            return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Get users',
                    'data' =>  $data,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
        
    }

    // public function searchChatUsers(Request $request) {
        
    //     try{

    //         $rules = array(
    //             'search' => 'required',
    //         );

    //         $validator = Validator::make($request->all(), $rules);
    //         if ($validator->fails()) {
    //             return $this->respondValidationError('Fields Validation Failed.', $validator);
    //         }
                
    //         $users = [];
    //         $fav_users = [];
            
    //         $following = DB::table('fanbases')
    //             ->join('users','fanbases.follower', '=', 'users.id')
    //             ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
    //             ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users.username', 'users.email', 'users_roles.name as role','users_roles.id as role_id')
    //             ->where('following', Auth::user()->id)
    //             ->where('follower','!=' ,Auth::user()->id)
    //             ->where('is_fav','!=' , '1')
    //             ->where('users.username','LIKE',"%{$request->search}%")
    //             ->get()->toArray();

    //         $fav = DB::table('fanbases')
    //             ->join('users','fanbases.follower', '=', 'users.id')
    //             ->join('users_roles', 'users.role_id', '=', 'users_roles.id')
    //             ->select('fanbases.*','users.first_name','users.last_name', 'users.id as user_id', 'users.profile_pic', 'users.public_profile', 'users.username', 'users.email', 'users_roles.name as role','users_roles.id as role_id')
    //             ->where('following', Auth::user()->id)
    //             ->where('follower','!=' ,Auth::user()->id)
    //             ->where('is_fav','!=' , '0')
    //             ->where('users.username','LIKE',"%{$request->search}%")
    //             ->get()->toArray();
            
    //         $data['users'] = $following;
    //         $data['fav_users'] = $fav;

    //         return $this->respond([
    //                 'status' => 'success',
    //                 'status_code' => $this->getStatusCode(),
    //                 'message' => 'Get latest messages',
    //                 'data' =>  $data,
    //         ]);            

    //     } catch (Exception $e) {
    //         return $this->respondWithError($e->getMessage());
    //     }

    // }

	public function getLoadLatestMessages(Request $request)
    {
        try{
            $rules = array(
                'user_id' => 'required|numeric|min:0|not_in:0',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }



            $messages = Message::where(function($query) use ($request) 
            {
                $query->where('from_user', Auth::user()->id)->where('to_user', $request->user_id)->where('delete_by_from_user', NULL);
            })->orWhere(function ($query) use ($request) {
                $query->where('from_user', $request->user_id)->where('to_user', Auth::user()->id)->where('delete_by_to_user', NULL);
            })->orderBy('created_at', 'ASC')->get();
             
            // $return = [];

            // foreach ($messages as $message) {
            //        $return[] = view('message-line')->with('message', $message)->render();
            // }
            Message::where('to_user', Auth::user()->id)->update([
                'notify' => 0,
            ]);

            $data['messages'] = $messages;

            return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Get latest messages',
                    'data' =>  $data,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

      public function videoCallingStoredata(Request $request)
    {
            $message = new Message();
            $message->from_user = $request->sender_id;
            $message->to_user = $request->receiver_id;
            $message->content = $request->message;
            $message->type = $request->type;
            $message->save();

             return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => $message->type,
                'data'  =>  $message
            ]);
       
    }
     public function videoCallinggetdata(Request $request)
    {
        $user = VideoCall::where('type',$request->start_call)->where('receiver_id',$request->receiver_id)->first();
         return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Video Call',
                'data'  =>  $user
            ]);
        
    }
    
    public function postSendMessage(Request $request)
    {
        try{
            $rules = array(
                'to_user' => 'required|numeric|min:0|not_in:0',
                // 'message' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            $user = User::where('id', (int)$request->to_user)->first();
            if ($user == null) 
            {
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'User id is invalid',
                ]);
            }
            $pathName = '';
            $message_file = $request->file('attachment');
            if ($message_file) 
            {
                $fileName = $message_file->getClientOriginalName();
                $fileName1 = Auth::id() . '-' . date("YmdHis") . str_replace(" ", "-", $fileName);
                $pathName = 'uploads/message-media/' . $fileName1;
                //$path = storage_path();
                $path = public_path();
                $message_file->move($path . '/uploads/message-media/', $fileName1);
                // $mess->message_media = $pathName;
            }

            $message = new Message();
            $message->from_user = Auth::user()->id;
            $message->to_user = (int)$request->to_user;
            $message->content = $request->message;
            $message->attachment = $pathName;
            $message->notify = 1;
            $message->save();

            $mess = $message;
            // code start
            if(Cache::get('user_is_online_'.$mess->received_by))
            {
            }
            else
            {
                $message_from = User::find(Auth::user()->id);
                $message_to = User::find($request->to_user);

                $email['from'] = $message_from['email'];
                $email['to'] = $message_to['email'];

                $email['to_name'] = $message_to['first_name'].' '.$message_to['last_name'];
                $email['from_name'] = $message_from['first_name'].' '.$message_from['last_name'];

                $email['content'] = strip_tags($request->message);

                $this->triggerMessageEmail($email);
            }
            // code end 
            $message->dateTimeStr = date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString()));
            $message->dateHumanReadable = $message->created_at->diffForHumans();
            $message->fromUserName = $message->fromUser->name;
            $message->from_user_id = Auth::user()->id;
            $message->toUserName = $message->toUser->name;
            $message->to_user_id = $request->to_user;
            PusherFactory::make()->trigger('chat', 'send', ['data' => $message]);

            $this->push_notification($mess, $user);
            $data['message'] = $message;

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Sent Message',
                'data' =>  $data,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function push_notification($message, $user){
        // $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();
          // return $name;
        $SERVER_API_KEY = 'AAAAtHD36-M:APA91bHIRdQctCXYBLTO2Svgzz2oq8KcLDfJAkVAM9Lko9hUWloXrHxzzNPOwNegdupY_7Yxx4-iALR8MYwHDaA4Wd8x70VPffX5oX-FrY9uKxVKqcv5iOcNr-kHruGv7UhlfFXTldv2';

        // $SERVER_API_KEY = "AAAA5YpbIV0:APA91bFcB42FWHSqLkudUNo_6nYY4CUQky6rbQ6sGtQGJhIo8yx3w4VsWBLTElQCXFcUG42n4b_2Xl8hRegie7KNrkzuPMFE-tfGHUExG14ir-FgRMnLLhhXHEIqjx-3UJlL1xl-IfwE";
  
        $data = [
            "to" => $user->device_token,
            "notification" => [
                "title" => Auth::user()->username, 
                "body" => $message->content,
                "image" => url($message->attachment),
                "sound" => 'zapsplat_musical.mp3',
                // "click_action" => "TOP_STORY_ACTIVITY"v
            ],
            "data" => [
                "title" => $user->username, 
                "body" => $message,
                'user_id'  => $user->id
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


    public function getOldMessages(Request $request)
    {
        try{
            $rules = array(
                'to_user' => 'required|numeric|min:0|not_in:0',
                'old_message_id' => 'required|numeric|min:0|not_in:0',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $message = Message::find($request->old_message_id);
            if ($message == null) {
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Message id is invalid',
                ]);
            }

            $lastMessages = Message::where(function($query) use ($request, $message) {
                $query->where('from_user', Auth::user()->id)
                    ->where('delete_by_from_user', NULL)
                    ->where('to_user', $request->to_user)
                    ->where('created_at', '<', $message->created_at);
            })
                ->orWhere(function ($query) use ($request, $message) {
                $query->where('from_user', $request->to_user)
                    ->where('to_user', Auth::user()->id)
                    ->where('delete_by_to_user', NULL)
                    ->where('created_at', '<', $message->created_at);
            })
                ->orderBy('created_at', 'ASC')->get();

            Message::where('to_user', $request->to_user)->update([
                'notify' => 0,
            ]);

            if($lastMessages->count() > 0) {            
                PusherFactory::make()->trigger('chat', 'oldMsgs', ['to_user' => $request->to_user, 'data' => $lastMessages]);
            }
            $data['last_message'] = $lastMessages;

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Get all old messages',
                'data' =>  $data,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function deleteMessage(Request $request){
        try{
            $rules = array(
                'user_id' => 'required|numeric|min:0|not_in:0',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            DB::table('fanbases')
                ->where('following', Auth::user()->id)
                ->where('follower', $request->user_id)
                ->delete();

            Message::where('from_user', Auth::id())
                ->where('to_user', $request->user_id)
                ->update([
                    'delete_by_from_user' => date('Y-m-d H:i:s')
                ]);

            Message::where('from_user', $request->user_id)
                ->where('to_user', Auth::id())
                ->update([
                    'delete_by_to_user' => date('Y-m-d H:i:s')
                ]);

            return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Message Deleted',
                    // 'data' =>  $data,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function addSuperStar(Request $request){

        try{
            $rules = array(
                'user_id' => 'required|numeric|min:0|not_in:0',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            // $where_condition = ['user_id' => Auth::user()->id, 'fav_user_id' => $request->user_id];
              
             $where = ['follower' => $request->user_id, 'following' => Auth::user()->id];
             if($request->type =='remove') {
                  $table_array = ['is_fav' => '0'];
                  $message = 'Removed from super star list.';
             } else {
                $table_array = ['is_fav' => '1'];
                $message = 'Added as super user.';
             }
             
             $added = Fanbase::where($where)->update($table_array);

             // if(!empty($added)) {
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => $message,
                ]);   
             // } else {
             //       $response = ['error' => 'Unable to process the request.'];
             //       return Response::json($response);
             // }

                     

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
        
    }
}