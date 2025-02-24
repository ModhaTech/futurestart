<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\VideoCall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AudioVideoController extends Controller
{
    public function send_call($id)
    {
        return view('video.sender',compact('id'));
    }

    public function receive_call($id)
    {
        return view('video.receiver',compact('id'));
    }

     public function audio_send_call($id)
    {
        $user = User::where('id',$id)->firstOrFail();
        $full_name = $user['first_name'].' '.$user['last_name'];
        return view('video.audio_sender',compact('id', 'full_name'));
    }

    public function audio_receive_call($id)
    {
        $user = User::where('id',$id)->firstOrFail();
        $full_name = $user['first_name'].' '.$user['last_name'];
        return view('video.audio_receiver',compact('id', 'full_name'));
    }

     public function liveStreamStart($id)
    {
        return view("video.live-stream-page",compact('id'));
    }

    public function liveStreamView($id)
    {
        return view("video.live-stream-view",compact('id'));
    }

}
