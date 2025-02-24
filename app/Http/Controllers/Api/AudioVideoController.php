<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User;
use App\Models\VideoCall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AudioVideoController extends ApiController
{
    //
    public function send_call(Request $request)
    {
        $SERVER_API_KEY = 'AAAARUKFSpY:APA91bFXtp6KYd1pnxUmccyi8acVKmPt4y9JqpqAQkDkb3S_rPPOt0280nFFcEIXYDHNPHui0dryJAECcPRBfc3Xl-6JK-Gd1B8_xZo4kcFcByRJqOFUNuMijwPZZ4PNAbBOvAIoJcqf';

        $user = User::find($request->to_user);
        $data = [
            "to" => $user->device_token,
            "notification" => [
                "title" => $request->title, 
                "body" => $request->body,
                "image" => $request->image,
            ],
            "data" => [
                "title" => $request->title, 
                "body" => $request->body,
                'image'  => $request->image,
                'to_user' => $request->to_user,
                'from_user' => $request->from_user,
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

    public function liveStreamStart(Request $request)
    {
        return view("video.live-stream-page");
    }

    // public function videoCallinggetdata(Request $request)
    // {
    //     $user = VideoCall::where('sender_id',$request->sender_id)->where('receiver_id',$request->receiver_id)->first();
    //      return $this->respond([
    //             'status' => 'success',
    //             'status_code' => $this->getStatusCode(),
    //             'message' => 'Video Call',
    //             'data'  =>  $user
    //         ]);
        
    // }
    //     // Start Video Calling Api Code

    //    public function videoCallingStoredata(Request $request)
    // {
    //     $video_data = VideoCall::where('receiver_id',$request->receiver_id)->where('sender_id',$request->sender_id)->first();
    //     if (!empty($video_data)) 
    //     {
    //         $video_data->status = $request->status;
    //         $video_data->update();
    //          return $this->respond([
    //             'status' => 'success',
    //             'status_code' => $this->getStatusCode(),
    //             'message' => 'Video Call',
    //             'data'  =>  $video_data
    //         ]);
    //     }
    //     else
    //     {
    //         $video_call = new VideoCall();
    //         $video_call->receiver_id = $request->receiver_id;
    //         $video_call->sender_id = $request->sender_id;
    //         $video_call->profile_name = $request->profile_name;
    //         $video_call->profile_img = $request->profile_img;
    //         $video_call->status = $request->status;
    //         $video_call->save();
    //         return $this->respond([
    //             'status' => 'success',
    //             'status_code' => $this->getStatusCode(),
    //             'message' => 'Video Call',
    //             'data'  =>  $video_call
    //         ]);
    //     }
    // }
}
