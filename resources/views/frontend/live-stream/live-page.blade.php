@extends('layouts.talent') 
     @section('content') 
    <body>
        <section class="wow fadeIn cover-background socail-buzz background-position-top top-space" style="background-image:url({{ asset('assets/images/social-buzz/banner-buzz.jpg')}});">
            <div class="opacity-medium bg-extra-dark-gray"></div>
              <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
                      <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
                           <!-- start page title -->
                           <h1 class="alt-font text-white font-weight-600 mb-2">FutureStarr&nbsp;<i class="fa fa-comments" aria-hidden="true"></i>&nbsp;Live Video</h1>
                           <!-- end page title -->
                           <!-- start sub title -->
                           <span class="display-block text-white opacity6 alt-font">
                           Promote your Products</span>
                           <!-- end sub title -->
                      </div>
                    </div>
                </div>
              </div>
        </section>
        <section class="knowledge-section live_channel">
           
                <!-- <div style='text-align:center;' class="col-lg-12">
                    <button style="background: #0f1d6b;color: white;padding: 6px;font-weight: bold;border-radius: 5px;border: 2px solid #ff503f; margin-bottom: 40px;" onclick="startCallLiveStream()">Start Live video</button>
                </div> -->
              <div class="container"> 
                <div class="row"> 
                  <div class="col-lg-8" id="video-call-div-livestream">
                    <div class="user_live" style="display: none; position: absolute;padding: 3px 15px;background-color: #ef174f;border-radius: 2px;text-transform: uppercase;left:25px;top:16px;color: white;font-weight: 600;border-radius: 5px;">Live</div>
                    <video width="85px;" id="local-video-livestream" autoplay></video>
                    <div style="display: none;position: absolute;top: 75%;left: 45%;" class="call-action-div-live">
                        <span style="margin-top: 10px; cursor: pointer;" onclick="muteVideoLiveStream()"><i style="padding: 15px;" class="fa fa-video-camera"></i></span>
                        <span class="mute-audio mute-audio-close" style="padding: 10px 18px 10px 18px;display: none;cursor: pointer;" onclick="muteAudio()"><i class="fa fa-microphone-slash" aria-hidden="true"></i></span> 
                        <span class="mute-audio mute-audio-open" style="padding: 10px 18px 10px 18px;cursor: pointer;" onclick="muteAudio()"><i class="fa fa-microphone" aria-hidden="true"></i>
                        </span> 
 
                    </div>
                  </div>
                  <div class="col-lg-4" style="padding-right: 0px;padding-left: 10px;">
                    <button onclick="userStatusStore()" style="width: 100%; background: rgb(239, 23, 79);color: white;padding: 10px;font-weight: 600; border-radius: 5px;border-color: rgb(239, 23, 79);">End Live Stream</button>
                    <div id="view_count_show">
                      <img style='width: 30px;position: absolute;top: 70px;left: 145px;' src="{{ asset('assets/images/view.png') }}">
                      <button style="width: 100%; margin-top: 10px; background: rgb(239, 23, 79);color: white;padding: 10px;font-weight: 600; border-radius: 5px;border-color: rgb(239, 23, 79);"></button>
                    </div>
                    <div style="display: none; height: 200px; border: 2px solid #ddd; padding: 10px;margin-top: 15px;overflow-y: scroll;" id="view_comment_show">
                    
                    </div>
                  </div>
                </div>
              </div>
         <input placeholder="Enter username..."type="hidden" value="{{Auth::user()->id}}" id="username-input"/>
        </section>
    </body>
<script type="text/javascript">
  const webSocketstreamlive = new WebSocket("wss://futurestarr.com:3002")

webSocketstreamlive.onmessage = (event) => {
    handleSignallingDataLiveStream(JSON.parse(event.data))
}
webSocketstreamlive.onclose = function(e) 
{
    console.log('Connection is Close',e);
};
 webSocketstreamlive.onclose = function () 
{
   console.log("hello.. The coonection has been clsoed");
};

function handleSignallingDataLiveStream(data) 
{
    switch (data.type) 
    {
        case "answer":
          console.log(data.answer,'answer')
            peerConnlive.setRemoteDescription(data.answer)
            break
        case "candidate":
          // console.log(data.candidate,'candidate')
            peerConnlive.addIceCandidate(data.candidate)
            createNewPeer()
    }
}

// let username
function sendUsernameLiveStream() 
{
    username = document.getElementById("username-input").value
    sendDatalive({
        type: "store_user"
    })
}

function sendDatalive(data) 
{
    data.username = username
    webSocketstreamlive.send(JSON.stringify(data))
}


let localStreamlive
let peerConnlive
setTimeout(startCallLiveStream, 3000);
function startCallLiveStream() 
{
  // viewLivestream();
  var stream_id = $("#username-input").val();
    $('.call-action-div-live').show();
    $('.user_live').show();
    sendUsernameLiveStream()
    document.getElementById("video-call-div-livestream")
    .style.display = "inline"

    navigator.getUserMedia({
        video: {
            frameRate: 24,
            width: {
                min: 480, ideal: 720, max: 1280
            },
            aspectRatio: 1.33333
        },
        audio: true
    }, (stream) => {
        localStreamlive = stream
        document.getElementById("local-video-livestream").srcObject = localStreamlive
        createNewPeer()

    }, (error) => {
        console.log(error)
    })

    // Data Store in Database
    $.ajax({
            url: '{!! route('livestream.live-page-store-data') !!}',
            type: 'POST',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "stream_id":stream_id,
                    "type":"online",
                    "status":'1'
                  },
                 success: function(response) 
                 {
                   console.log('sender success in start call',response)
                 },
                 error:function(error) 
                 {
                    console.log('error', error);
                 }
          });
    // Data Store in Database
}
setTimeout(() => {
    var autoNavcancel = setInterval(viewLivestream, 1000);
  }, 1000);
// viewLivestream()
function viewLivestream()
{
  var stream_id = $("#username-input").val();
  console.log(stream_id, "Stream id in view count")
  $.ajax({
            url: '{!! route('livestream.liveviewCount') !!}',
            type: 'POST',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "stream_id":stream_id
                  },
                 success: function(response) 
                 {
                  $("#view_comment_show").show();
                  console.log(response);
                  $("#view_count_show button").html("<span style='font-size: 18px; font-weight: 600;'>"+response.view_count+"</span>");
                  $("#view_comment_show").html(response.viewRender);
                 },
                 error:function(error) 
                 {
                    console.log('error', error);
                 }
        });
}

function createNewPeer() 
{
  let configuration = {
            iceServers: [
                {
                    "urls": ["stun:stun.l.google.com:19302", 
                    "stun:stun1.l.google.com:19302", 
                    "stun:stun2.l.google.com:19302"]
                }
            ]
        }

        peerConnlive = new RTCPeerConnection(configuration)
        peerConnlive.addStream(localStreamlive)

        peerConnlive.onaddstream = (e) => {
            //document.getElementById("remote-video").srcObject = e.stream
        }

        peerConnlive.onicecandidate = ((e) => {
            if (e.candidate == null)
                return
            sendDatalive({
                type: "store_candidate",
                candidate: e.candidate
            })
        })

        createAndSendOfferLiveStream()
}

function createAndSendOfferLiveStream() 
{
    peerConnlive.createOffer((offer) => {
        sendDatalive({
            type: "store_offer",
            offer: offer
        })
        console.log(offer,'offer')
        peerConnlive.setLocalDescription(offer)
    }, (error) => {
        console.log(error)
    })
}

function userStatusStore()
{
  var stream_id = $("#username-input").val();
  $.ajax({
            url: '{!! route('livestream.live-page-store-data') !!}',
            type: 'POST',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "stream_id":stream_id,
                    "type":"offline",
                    'status':'2'
                  },
                 success: function(response) 
                 {
                  window.location.replace("https://www.futurestarr.com");
                  console.log(response,"User Status");
                 },
                 error:function(error) 
                 { 
                    //console.log('error', error);
                 }
          });
}




let isAudiolive = true
function muteAudioLiveStream() 
{
  console.log('Audio in')
  if (isAudiolive == true) 
    {
      isAudiolive = !isAudiolive
      localStream.getAudioTracks()[0].enabled = isAudiolive
      $(".mute-audio-close").show();
      $(".mute-audio-open").hide();
    }
    else if(isAudiolive == false) 
    {
      isAudiolive = !isAudiolive
      localStream.getAudioTracks()[0].enabled = isAudiolive
      $(".mute-audio-close").hide();
      $(".mute-audio-open").show();
    }
    // isAudiolive = !isAudiolive
    // localStreamlive.getAudioTracks()[0].enabled = isAudiolive
}

let isVideolive = true
function muteVideoLiveStream() 
{
    isVideolive = !isVideolive
    localStreamlive.getVideoTracks()[0].enabled = isVideolive
}
</script>
@endsection
