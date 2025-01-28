<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Auth;
use Session;
use Hash;
use App\User;

class AdminController extends Controller
{
    /*** Display a listing of the resource.** @return \Illuminate\Http\Response */
    public function index()
    {
        $dashboard_data = [];
        Session::flash('success','Welcome to future Starr admin panel.');
        return view('admin.dashboard', compact('dashboard_data'));
    }

    /*** Show the form for creating a new resource.** @return \Illuminate\Http\Response */
    public function create(Request $request)
    {
        $social_share = [];
        return view('admin.social-share' ,  compact('social_share'));
    }

    /*** Store a newly created resource in storage.** @param  \Illuminate\Http\Request  $request * @return \Illuminate\Http\Response */
    public function store(Request $request)
    {
        //
    }

    /*** Display the specified resource.** @param  int  $id * @return \Illuminate\Http\Response */
    public function show($id)
    {
        //
    }

    /*** Show the form for editing the specified resource.** @param  int  $id
     * @return \Illuminate\Http\Response */
    public function edit($id)
    {
        //
    }

    /*** Update the specified resource in storage.** @param  \Illuminate\Http\Request  $request * @param  int  $id * @return \Illuminate\Http\Response */
    public function update(Request $request, $id)
    {
        //
    }

    /*** Remove the specified resource from storage.** @param  int  $id * @return \Illuminate\Http\Response */
    public function destroy($id)
    {
        //
    }

    public function change_password() 
    {
        return view('admin.change-password');
    }
    public function notificationSendAlluser()
    {
        return view('admin.user_notification_send');
    }
    public function notificationSendAll_user(Request $request)
    {
      $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->toArray();
        
      $SERVER_API_KEY = 'AAAAtHD36-M:APA91bHIRdQctCXYBLTO2Svgzz2oq8KcLDfJAkVAM9Lko9hUWloXrHxzzNPOwNegdupY_7Yxx4-iALR8MYwHDaA4Wd8x70VPffX5oX-FrY9uKxVKqcv5iOcNr-kHruGv7UhlfFXTldv2';
         
          $data = [
             "registration_ids" => $firebaseToken,
            // "to" => $firebaseToken,
            "notification" => [
                "title" => $request->notification_title, 
                "body" => $request->notification_message,
                // "image" => url($message->attachment),
               // "sound" => 'zapsplat_musical.mp3',
                // "click_action" => "TOP_STORY_ACTIVITY"v
            ],
            "data" => [
                "title" => $request->notification_title, 
                "body" => $request->notification_message
                // 'user_id'  => $b_user->id
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
        // return $response;
        session::flash('success', 'Message send successfully!');
        return redirect( route('admin.notification.create') );
    }

    public function update_password(Request $request)
    {
        $validatedData = $request->validate([
                    'old_password' => 'required',
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required'
            ]);

        //echo Hash::check($request->get('old_password'));
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) 
        {
            // The passwords not matches
            //return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
            //return response()->json(['errors' => ['current'=> ['Current password does not match']]], 422);
            Session::flash('error', 'Current password does not match.');
            return redirect( route('admin.change-password') );
        }
            //uncomment this if you need to validate that the new password is same as old one

        if(strcmp($request->get('old_password'), $request->get('password')) == 0)
        {
            //Current password and new password are same
            //return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
            //return response()->json(['errors' => ['current'=> ['New Password cannot be same as your current password']]], 422);
            Session::flash('error', 'New Password cannot be same as your current password.');
                return redirect(route('admin.change-password'));
        }
             
            //Change Password
            $user = Auth::user();
            $user->password = Hash::make($request->password);
            $updated = $user->save();

        if(!empty($updated)) 
        {
            Auth::logout();
            session::flash('success', 'Password changed successfully!');
            return redirect('/');
        } 
        else 
        {
            Session::flash('error', 'Unable to process request. Please try agian later.');
            return redirect( route('admin.change-password') );
        }
    }
    
}


