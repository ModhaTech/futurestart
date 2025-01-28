<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User;
use App\Models\ChatMessage;
use App\Lib\PusherFactory;
use App\Message;
use Auth;
use DB;
use Cache;
use Carbon\Carbon;
use Validator;
use App\Traits\MailsendTrait;

class ChatMessageController extends ApiController
{
    use MailsendTrait;
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function chat(Request $request){
        try {
            $rules = array(
                'user_id' => 'required|numeric|min:0|not_in:0',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $this->id = $request->user_id;
            $per_page = $request->per_page ? $request->per_page : 10;
            $data['receiver'] = User::where('id', $this->id)->first(); 

            $data['messages'] = ChatMessage::where('sent_by', Auth::id())
                ->where('received_by', $this->id)
                ->where('deleted_sent_by', NULL)            
                ->orWhere(function ($query) {
                    $query->where('sent_by', $this->id)
                        ->where('received_by', Auth::id())
                        ->where('deleted_received_by', NULL);                       
                })
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);

            DB::table('chat_messages')->where('sent_by', $this->id)
            ->where('received_by', Auth::id())->update([
                'read_flag' => 1
            ]);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Get All Messages',
                'file_url' => env('APP_FILE_URL','http://www.futurestarr.com/'),
                'data' =>  $data,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function refreshMessage(Request $request){
        try {

            $rules = array(
                'user_id' => 'required|numeric|min:0|not_in:0',
                'last_msg' => 'required|numeric|min:0|not_in:0'
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $this->receiver_id = $request->user_id;
            $data['receiver'] = User::where('id', $this->receiver_id)->first();
            $data['messages'] = ChatMessage::where('id', '>', $request->last_msg)
                ->where(function ($query) 
                {
                    $query->where('sent_by', Auth::id())
                        ->where('received_by', $this->receiver_id)
                        ->where('deleted_sent_by', NULL) 
                        ->orWhere(function ($add) 
                        {
                            $add->where('sent_by', $this->receiver_id)
                                ->where('received_by', Auth::id())  
                                ->where('deleted_received_by', NULL);                   
                        });                     
                })
                ->orderBy('created_at', 'desc')
                ->get();

            DB::table('chat_messages')->where('sent_by', $this->receiver_id)
            ->where('received_by', Auth::id())->update([
                'read_flag' => 1
            ]);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Get Current Messsage',
                'data' =>  $data,
            ]);            

        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }      
    }


    public function sendMessage(Request $request)
    {
        try
        {
            $rules = array('received_by' => 'required|numeric|min:0|not_in:0');
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) 
            {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
            $mess = new ChatMessage;
            $mess->sent_by = Auth::id();
            $mess->received_by = $request->received_by;
            $mess->message = $request->message;

            $message_file = $request->file('message_file');
            if ($message_file) 
            {
                $fileName = $message_file->getClientOriginalName();
                $fileName1 = Auth::id() . '-' . date("YmdHis") . str_replace(" ", "-", $fileName).".jpg";
                $pathName = 'uploads/message-media/' . $fileName1;
                //$path = storage_path();
                $path = public_path();
                $message_file->move($path . '/uploads/message-media/', $fileName1);
                $mess->message_media = $pathName;
            }
            
            $mess->save();
            // code start
            if(Cache::get('user_is_online_'.$mess->received_by))
            {
                
            }
            else
            {
                $message_from = User::find($mess->sent_by);
                $message_to = User::find($mess->received_by);

                $email['from'] = $message_from['email'];
                $email['to'] = $message_to['email'];

              $email['to_name'] = $message_to['first_name'].' '.$message_to['last_name'];
                $email['from_name'] = $message_from['first_name'].' '.$message_from['last_name'];
                $email['content'] = strip_tags($request->message);
                $this->triggerMessageEmail($email);
            }
            // code end 

            $mess->profile_pic = Auth::user()->profile_pic;
            $data['messages'] = $mess;


            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Sent Messsage',
                'data' =>  $data,
            ]);            
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }    

    }


    public function getInboxMessage(Request $request)
    {
        try{
        	$per_page = $request->per_page ? $request->per_page : 10;
            $messages = ChatMessage::RightJoin('users', 'chat_messages.sent_by', 'users.id')
                ->select('chat_messages.*', 'users.id as user_id','users.username', 'users.profile_pic', DB::raw('COUNT(chat_messages.sent_by) as message_count'))
                ->where('chat_messages.received_by', Auth::id())
                ->where('chat_messages.deleted_received_by', NULL)
                ->where('chat_messages.read_flag', 0)
                ->orderBy('chat_messages.created_at', 'desc');
                // ->take(40)

            $data['count'] = $messages->count();
            $messages->groupBy('chat_messages.sent_by');
            $data['messages'] = $messages->paginate($per_page);

             return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Get all inbox messages',
                    'data' =>  $data,
                ]);
        } 
        catch (Exception $e) 
        {
            return $this->respondWithError($e->getMessage());
        }    
        
    }


    public function deleteInboxMessage(Request $request){
        try{
            $rules = array(
                'message_id' => 'required|numeric|min:0|not_in:0',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $id = $request->message_id;
            $deleted_sent_msg = ChatMessage::where('id', $id)
                ->where('sent_by', Auth::id())->first();
            $data = [];
            if ($deleted_sent_msg) {
                $deleted_sent_msg->deleted_sent_by = date('Y-m-d H:i:s');
                $deleted_sent_msg->update();
                $data['messsage'] = $deleted_sent_msg;
            }

            $deleted_received_msg = ChatMessage::where('id', $id)
                ->where('received_by', Auth::id())->first();
            if ($deleted_received_msg) {
                $deleted_received_msg->deleted_received_by = date('Y-m-d H:i:s');
                $deleted_received_msg->update();
                $data['messsage'] = $deleted_received_msg;
            }

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Message deleted successfully',
                'data' =>  $data,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }    

    }

    public function massDeleteInboxMessage(Request $request){
        try{
            $rules = array(
                'message_id' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $messages = [];
            foreach ($request->message_id as $key => $id) {
                $deleted_sent_msg = ChatMessage::where('id', $id)
                        ->where('sent_by', Auth::id())->first();
                if ($deleted_sent_msg != null) {
                    $deleted_sent_msg->deleted_sent_by = date('Y-m-d H:i:s');
                    $deleted_sent_msg->save();
                    array_push($messages, $deleted_sent_msg);
                }
                

                $deleted_received_msg = ChatMessage::where('id', $id)
                    ->where('received_by', Auth::id())->first();

                if ($deleted_received_msg != null) {
                    $deleted_received_msg->deleted_received_by = date('Y-m-d H:i:s');
                    $deleted_received_msg->save();
                    array_push($messages, $deleted_received_msg);
                }
                 
            }

            $data['message'] = $messages;  
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'delete message successful',
                'data' =>  $data,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }   

    }


    public function getAllUser(Request $request)
    {
        try{
        	$per_page = $request->per_page ? $request->per_page : 10;
            $data['messages'] = ChatMessage::RightJoin('users', 'chat_messages.sent_by', 'users.id')
                ->select('chat_messages.*', 'users.username', 'users.profile_pic', 'users.role_id', 'users.public_profile')
                ->where('chat_messages.received_by', Auth::id())
                ->where('chat_messages.deleted_received_by', NULL)
                ->orderBy('chat_messages.created_at', 'desc')
                ->paginate($per_page);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Get all users',
                'data' =>  $data,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }   
    }


    public function getAllReadMsg(Request $request){
        try{
        	$per_page = $request->per_page ? $request->per_page : 10;
            $data['messages'] = ChatMessage::RightJoin('users', 'chat_messages.sent_by', 'users.id')
                ->select('chat_messages.*', 'users.username', 'users.profile_pic', 'users.role_id', 'users.public_profile')
                ->where('chat_messages.received_by', Auth::id())
                ->where('chat_messages.read_flag', 1)
                ->where('chat_messages.deleted_received_by', NULL)
                ->orderBy('chat_messages.created_at', 'desc')
                // ->take(40)
                // ->groupBy('chat_messages.sent_by');
                ->paginate($per_page);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Get all read messages',
                'data' =>  $data,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }   
    }


    public function getAllUnreadMsg(Request $request)
    {
        try{
        	$per_page = $request->per_page ? $request->per_page : 10;
	        $data['messages'] = ChatMessage::RightJoin('users', 'chat_messages.sent_by', 'users.id')
	            ->select('chat_messages.*', 'users.username', 'users.profile_pic', 'users.role_id', 'users.public_profile')
	            ->where('chat_messages.received_by', Auth::id())
	            ->where('chat_messages.read_flag', 0)
	            ->where('chat_messages.deleted_received_by', NULL)
	            ->orderBy('chat_messages.created_at', 'desc')
	            // ->take(40)
	            // ->groupBy('chat_messages.sent_by');
	            ->paginate($per_page);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Get all unread messages',
                'data' =>  $data,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        } 
    }


    public function sendAutoMessage(){
        try{
            $users = User::where('auto_reply', 1)->select('id', 'automatic_message')->get();

            foreach ($users as $key => $user) {
                $message = ChatMessage::where('received_by', $user->id)->latest()->first();  

                if ($message->auto_reply == NULL && $message->read_flag == 0 && Carbon::parse($message->created_at)->addHours(24) <= Carbon::now()) {

                    $chat = ChatMessage::where('id', $message->id)->first();
                    $chat->auto_reply = 1;
                    $chat->save();

                    $chat = new ChatMessage;
                    $chat->message = $user->automatic_message;
                    $chat->sent_by = $message->received_by;
                    $chat->received_by = $message->sent_by;
                    $chat->auto_reply = 1;
                    $chat->save();
                }          
            }

             return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Reply sended to user',
                    'data' =>  [],
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
        // return $all_message;
    }


    public function autoreplySetting(Request $request) {
        try{
            $rules = array(
                'auto_reply' => 'required',
                'message' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $user = User::where('id', Auth::id())->first();
            $user->auto_reply = $request->auto_reply;
            $user->automatic_message = $request->message;
            $user->save();

            $data['user'] = $user;
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


    public function getAutoMessage(Request $request) {
        try{

            $user = User::where('id', Auth::id())->select('automatic_message', 'auto_reply')->first();
            
            $data['user'] = $user;
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


    public function getAllContact(Request $request) {
        try{
            $per_page = $request->per_page ? $request->per_page : 10;
            $AllUsers = DB::table('users')
                ->where('id', '!=', Auth::id())
                ->where('email_verified', '=', 'yes')
                ->orderBy('id', 'desc')
                ->paginate($per_page);

            $root = $request->root();
            foreach ($AllUsers as $user) {
                if ($user->profile_pic) {
                    $user->new_profile_pic = $root . '/public' . '/' . $user->profile_pic;
                } else {
                    $user->new_profile_pic = '';
                }
            }
            $data['users'] = $AllUsers;

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

}
