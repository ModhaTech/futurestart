{{-- Start Video Calling code set --}}

  <div class="container">
  <!-- The Modal -->
  @if(Auth::user())

  {{-- Audio Start Call Div --}}

    <div class="start_receiver_div" id="audioStartCallbySender{{Auth::user()->id}}">
      
         <!-- Modal Header -->
        <div>
          <p class="modal-title">Audio Call</p>
        </div>
        
        <!-- Modal body -->
        <div style="padding: 0;">
          <div id="sender-video-call-div">
           <div id="sender-video-call-subdiv">
              <div style="padding-top: 30px;">
                <img alt="audio call" style="height: 85px; width: 85px; border-radius: 50%;"  src="" id="audio_callthisuser">
                <span style="display: block;font-size: 20px;" id="audio_callthisusername"></span>
              </div>
              
           </div>
            
            <div class="call-action-div" style="bottom: 40px;margin-left: 24px;">
             <span style="margin-left: 15px;margin-right: 15px;padding: 10px 18px 10px 18px; display: none;" class="mute-audio mute-audio-close" onclick="muteAudio()"><i class="fa fa-microphone-slash"></i></span>

              <span class="mute-audio mute-audio-open" style="margin-left: 15px;margin-right: 15px;padding: 10px 18px 10px 18px;" onclick="muteAudio()"><i class="fa fa-microphone" aria-hidden="true"></i></span>  
              <a onclick="callCancelSenderside()"><img  style="width: 54px;" class="img-responsive sm-logo" alt="futurestarr logo" title="Futurestarr Logo" src="{{ asset('assets/images/Group_2.png')}}" ></a>
            </div>
          </div>
         </div>
    </div>

  {{-- Audio End Call Div --}}

  <div class="start_receiver_div" id="startCallbySender{{Auth::user()->id}}">
         <!-- Modal Header -->
        <div>
          <p class="modal-title">Video Call</p>
        </div>
        
        <!-- Modal body -->
        <div style="padding: 0;">
          <div id="sender-video-call-div">
            <video muted id="sender-local-video" autoplay></video>
            <video id="sender-remote-video" autoplay></video>
            <div class="call-action-div">
              <span style="margin-top: 10px;" onclick="muteVideo()"><i style="padding: 15px;" class="fa fa-video-camera"></i></span>
              <span class="mute-audio mute-audio-close" style="padding: 10px 18px 10px 18px;display: none;" onclick="muteAudio()"><i class="fa fa-microphone-slash" aria-hidden="true"></i></span> 
              <span class="mute-audio mute-audio-open" style="padding: 10px 18px 10px 18px;" onclick="muteAudio()"><i class="fa fa-microphone" aria-hidden="true"></i></span> 
              <a onclick="callCancelSenderside()">
                <img  style="width: 54px;" class="img-responsive sm-logo" alt="futurestarr logo" title="Futurestarr Logo" src="{{ asset('assets/images/Group_2.png')}}">
              </a>
            </div>
          </div>
        </div>
    </div>
  </div>
    @endif
</div>
{{-- End Sender Call Model popup open --}}

{{-- Start Video Get Call Of Receiver Side --}}
    <div class="container">
      @if(Auth::user())
        <div id="myModalDataShow{{Auth::user()->id}}"></div>
      @endif

    {{-- Popup Open Click on Accept Button --}}

    {{-- Audio Receiver side Design --}}

       <div class="start_receiver_div" id="AudiomyAcceptModal">
        <!-- Modal Header -->
        <div>
          <p class="modal-title">Audio Call</p>
        </div>
        
        <!-- Modal body -->
        <div style="padding: 0;">
          <div>
            <div id="section_1">
              <div class="article">
                 <div>
                    <div style="text-align: center; background-color:white; height: 250px;">
                        <div id="audioCall_user" style="padding-top: 30px;"></div>
                    </div>
                    <div class="call-action-div" style="margin-left: 24px;">
                      <span style="margin-left: 15px;margin-right: 15px;padding: 10px 18px 10px 18px; display: none;" class="mute-audio mute-audio-close" onclick="muteAudio()"><i class="fa fa-microphone-slash"></i></span>
                      <span class="mute-audio mute-audio-open" style="margin-left: 15px;margin-right: 15px;padding: 10px 18px 10px 18px;" onclick="muteAudio()"><i class="fa fa-microphone" aria-hidden="true"></i></span> 
                      <a onclick="callCancelBtn()">
                        <img  style="width: 54px;" class="img-responsive sm-logo" alt="futurestarr logo" title="Futurestarr Logo" src="{{ asset('assets/images/Group_2.png')}}"></a>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    {{-- Audio Receiver side Design --}}

   <!-- The Modal -->
  <div class="start_receiver_div" id="myAcceptModal">
    <div>
      <div>
        <!-- Modal Header -->
        <div>
          <p style="text-align: center;" class="modal-title">Video Call</p>
        </div>
        
        <!-- Modal body -->
        <div style="padding: 0;">
          <div>
            <div id="section">
              <div class="article">
                 <div id="video-call-div">
                      <video muted id="local-video" autoplay></video>
                      <video id="remote-video" autoplay></video>
                      <div class="call-action-div">
                          <span style="margin-top: 10px;" class="mute-video" onclick="muteVideo()"><i style="padding: 15px;" class="fa fa-video-camera"></i></span>
                          <span class="mute-audio mute-audio-close" style="padding: 10px 18px 10px 18px;display: none;" onclick="muteAudio()"><i class="fa fa-microphone-slash" aria-hidden="true"></i></span> 
                          <span class="mute-audio mute-audio-open" style="padding: 10px 18px 10px 18px;" onclick="muteAudio()"><i class="fa fa-microphone" aria-hidden="true"></i></span> 
                          <a onclick="callCancelBtn()"><img  style="width: 54px;" class="img-responsive sm-logo" alt="futurestarr logo" title="Futurestarr Logo" src="{{ asset('assets/images/Group_2.png')}}" ></a>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Popup Open Click on Accept Button --}}
  
</div>

<div id="call_cut_messageshow"></div>
      <audio id="myAudio">
        <source src="{{asset('Skype_ring.mp3')}}" type="audio/mpeg">
      </audio>
      <input type="hidden" value="{{ Carbon\Carbon::now()->toDateTimeString() }}" name="current_time" id="get_current_time_function">
      
{{-- End Video Get Call Of Receiver Side --}}

{{-- Start Video Calling js code --}}


  <script>

    // In Mobile View Menu open by click
    $(".navbar-toggle").click(function()
    {
      $('.navbar-collapse.collapse').toggle();
    });

    $(".show-pass").on("click", function()
    {
        if($(this).hasClass("fa-eye-slash"))
        {
            $(this).removeClass("fa-eye-slash");
            $(this).addClass("fa-eye");
            $(this).attr("title", "Hide Password");
            $(".password").attr("type", "text");
        }
        else
        {
            $(this).addClass("fa-eye-slash");
            $(this).removeClass("fa-eye");
            $(this).attr("title", "Show Password");
            $(".password").attr("type", "password");
        }
    });
    const x = document.getElementById("myAudio"); 

    function playAudio() 
    { 
      x.play(); 
      console.log('play Audio Function');
    } 

    function pauseAudio() 
    { 
      x.pause(); 
      console.log('pause Audio Function');
    } 
       const webSocket = new WebSocket("wss://futurestarr.com:3002");

        webSocket.onopen = function(e) 
        {
            console.log('Connection is open',e);
        };

       webSocket.onmessage = (event) => {
          handleSignallingData(JSON.parse(event.data));
          handleSenderData(JSON.parse(event.data));
        }

       function handleSignallingData(data) 
        {
          switch (data.type) 
            {
              case "offer":
                  peerConn.setRemoteDescription(data.offer)
                  createAndSendAnswer()
                  break
              case "candidate":
                 console.log(data.candidate,"GEt candidate");
                  peerConn.addIceCandidate(data.candidate)
                 
            }
        }
        // for Sender video call js code
        function handleSenderData(data) 
        {
           switch (data.type) 
            {
              case "answer":
                  peerConn.setRemoteDescription(data.answer)
                  break
              case "candidate":
                  peerConn.addIceCandidate(data.candidate)
            }
        }
        // for Sender video call js code
        function createAndSendAnswer () 
        {
            peerConn.createAnswer((answer) => {
                peerConn.setLocalDescription(answer)
                sendData({
                    type: "send_answer",
                    answer: answer
                })
            }, error => {
                console.log(error)
            })
        }
        function sendData(data) 
        {
            data.username = username
            webSocket.send(JSON.stringify(data))
            console.log(data.username);
        }
        let localStream
        let peerConn
        let username
        let name2;
        let name3;

        function sendUsername(name) 
        {
           name2 = name;
           username = name2
            sendData({ type: "store_user" });
            console.log('sendUsername',name2);
        }

        // Audio Join Call

function audiojoinCall()
{
  $("#AudiomyAcceptModal").show();
  @if(Auth::user())
    name3 = {{Auth::user()->id}}
  @endif

   //  Call Accept so status change in database

        $('#myModalDataShow'+name3).css('display','none');
         var receiver_id = name3;
         var sender_id = $('#user_sender_id').val();
 
   $.ajax({
            url: '{!! route('video.callingCancle') !!}',
            type: 'GET',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "sender_id": sender_id,
                    "receiver_id": receiver_id,
                    "status":'2',
                    "status_type" : "connected",
                    "message" : "User busy on another call"
                 },
                 success: function(response) 
                 {
                   console.log('in rejected function',response);
                 },
                 error:function(error) 
                 {
                    //console.log('error', error);
                 }
          });
        //  Call Accept so status change in database

  // Data Store in Database
  
  username = name3
  console.log('joinCall 700',name3)
    document.getElementById("video-call-div")
    .style.display = "inline"
    navigator.getUserMedia({
        video: false,
        audio: true
    }, (stream) => {
        localStream = stream
        let configuration = {
            iceServers: [
                {
                    "urls": ["stun:stun.l.google.com:19302",
                    "stun:stun1.l.google.com:19302",
                    "stun:stun2.l.google.com:19302"]
                }
            ]
        }
        peerConn = new RTCPeerConnection(configuration)
        peerConn.addStream(localStream)
        peerConn.onaddstream = (e) => {
            document.getElementById("remote-video")
            .srcObject = e.stream
        }
        peerConn.onicecandidate = ((e) => {
            if (e.candidate == null)
                return
            sendData({
                type: "send_candidate",
                candidate: e.candidate
            })
        })
        sendData({
            type: "join_call"
        })
    }, (error) => {
        console.log(error)
    })
  }
        // Audio Join Call
        function joinCall() 
        {
          
          @if(Auth::user())
            name3 = {{Auth::user()->id}}
          @endif

          $("#myAcceptModal").show();

        //  Call Accept so status change in database

        $('#myModalDataShow'+name3).css('display','none');
         var receiver_id = name3;
         var sender_id = $('#user_sender_id').val();
 
   $.ajax({
            url: '{!! route('video.callingCancle') !!}',
            type: 'GET',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "sender_id": sender_id,
                    "receiver_id": receiver_id,
                    "status":'2',
                    "status_type" : "connected",
                    "message" : "User busy on another call"
                 },
                 success: function(response) 
                 {
                   console.log('in rejected function',response);
                 },
                 error:function(error) 
                 {
                    //console.log('error', error);
                 }
          });
        //  Call Accept so status change in database
          
           $('#myModalDataShow'+name3).hide();

    // Data Store in Database
  
    username = name3
    console.log('joinCall 700',name3)
    document.getElementById("video-call-div")
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
        localStream = stream
        document.getElementById("local-video").srcObject = localStream
        let configuration = {
            iceServers: [
                {
                    "urls": ["stun:stun.l.google.com:19302",
                    "stun:stun1.l.google.com:19302",
                    "stun:stun2.l.google.com:19302"]
                }
            ]
        }
        peerConn = new RTCPeerConnection(configuration)
        peerConn.addStream(localStream)
        peerConn.onaddstream = (e) => {
            document.getElementById("remote-video")
            .srcObject = e.stream
        }
        peerConn.onicecandidate = ((e) => {
            if (e.candidate == null)
                return

            sendData({
                type: "send_candidate",
                candidate: e.candidate
            })
        })
        sendData({
            type: "join_call"
        })
    }, (error) => {
        console.log(error)
    })
}

  // Rejected Call
  function closebtn()
  {
    $('.show').css('display','none');
  }

   // Call Cancel by Sender Side
function callCancelSenderside()
{
   //location.reload(true);
   receiver_data_id = $('.msg_head .action_menu_btn').attr("data-id");
   receiver_data_id_receiver_end = $('#username-input').val();
   if (receiver_data_id_receiver_end != null) 
   {
     var receiver_id = receiver_data_id_receiver_end;
   }
   else
   {
     var receiver_id = receiver_data_id;
   }
   var sender_id = $('#user_sender_id').val();
   console.log(receiver_data_id,'sender_id',sender_id,'776');
   $.ajax({
            url: '{!! route('video.callingCancle') !!}',
            type: 'GET',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "sender_id": sender_id,
                    "receiver_id": receiver_id,
                    "status":'4',
                    "status_type":"sender_rejected",
                    "message":"call reject by sender"
                  },
                 success: function(response) 
                 {
                    $('#call_cut_messageshow').html("<div class='article' style='position: absolute;z-index: 2000000;top: 30%;left: 38%; width:340px;background: rgb(180, 62, 56);padding:45px;border:2px solid #ddd;border-radius:10px;position:fixed;'><div class='col-md-12' style='text-align:center;margin-bottom:20px;'><p style='color:white!important;'>Call Disconnect</p></div></div>");

                    $('#startCallbySender'+sender_id).css('display','none');
                    $('#audioStartCallbySender'+sender_id).css('display','none');
                    $('#myModalDataShow'+receiver_id).css('display','none');
                    $('#myAcceptModal').css('display','none');
                    $('#AudiomyAcceptModal').css('display','none');
                    $('.modal-backdrop').css('position','inherit');
                    console.log('in cancel button function',response);
                 },
                 error:function(error) 
                 {
                    //console.log('error', error);
                 }
      });
}

// Call Cancel by receiver Side
function callCancelBtn()
{
   //location.reload(true);
   receiver_data_id = $('.msg_head .action_menu_btn').attr("data-id");
   receiver_data_id_receiver_end = $('#username-input').val();
   if (receiver_data_id_receiver_end != null) 
   {
     var receiver_id = receiver_data_id_receiver_end;
   }
   else
   {
     var receiver_id = receiver_data_id;
   }
   var sender_id = $('#user_sender_id').val();
   console.log(receiver_data_id,'sender_id',sender_id,'776');
   $.ajax({
            url: '{!! route('video.callingCancle') !!}',
            type: 'GET',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "sender_id": sender_id,
                    "receiver_id": receiver_id,
                    "status":'3',
                    "status_type":"receiver_rejected",
                    "message":"call reject by receiver"
                   },
                 success: function(response) 
                 {
                   $('#call_cut_messageshow').html("<div class='article' style='position: absolute;z-index: 2000000;top: 30%;left: 38%; width:340px;background: rgb(180, 62, 56);padding:45px;border:2px solid #ddd;border-radius:10px;position:fixed;'><div class='col-md-12' style='text-align:center;margin-bottom:20px;'><p style='color:white!important;'>Call Disconnect</p></div></div>");

                    $('#startCallbySender'+sender_id).css('display','none');
                    $('#audioStartCallbySender'+sender_id).css('display','none');
                    $('#myModalDataShow'+receiver_id).css('display','none');
                    $('#myAcceptModal').css('display','none');
                    $('#AudiomyAcceptModal').css('display','none');
                    $('.modal-backdrop').css('position','inherit');
                    console.log('in cancel button function',response);
                 },
                 error:function(error) 
                 {
                    //console.log('error', error);
                 }
      });
}

// Call Cancle Sender and Receiver side Both.

setTimeout(() => {
    var autoNavcancel = setInterval(callCanclecutbtn, 5000);
  }, 5000);
function callCanclecutbtn()
{
   receiver_data_id = $('.msg_head .action_menu_btn').attr("data-id");
   receiver_data_id_receiver_end = $('#username-input').val();
   
   if (receiver_data_id_receiver_end != null) 
   {
     var receiver_id = receiver_data_id_receiver_end;
   }
   else
   {
    var receiver_id = receiver_data_id;
   }
   var sender_id = $('#user_sender_id').val();
  
  //  $.ajax({
  //           url: '{!! route('video.videopopupcancel') !!}',
  //           type: 'GET',
  //           data: {
  //                   "_token": "{{ csrf_token() }}",
  //                   "receiver_id":receiver_id,
  //                   "sender_id": sender_id,
  //                 },
  //                success: function(response) 
  //                {
                 
  //                 if ((response.status == 3) || (response.status == 4)) 
  //                 {
                   
  //                   pauseAudio();
  //                   $('#startCallbySender'+sender_id).css('display','none');
  //                   $('#audioStartCallbySender'+sender_id).css('display','none');
  //                   $('#myModalDataShow'+receiver_id).css('display','none');
  //                   $('#myAcceptModal').css('display','none');
  //                   $('#AudiomyAcceptModal').css('display','none');
  //                   $('.modal-backdrop').css('position','inherit');
  //                   console.log('in cancel function',response);

  //                   $('#call_cut_messageshow').html("<div class='article' style='position: absolute;z-index: 2000000;top: 30%;left: 38%; width:340px;background: rgb(180, 62, 56);padding:45px;border:2px solid #ddd;border-radius:10px;position:fixed;'><div class='col-md-12' style='text-align:center;margin-bottom:20px;'><p style='color:white!important;'>Call Disconnect</p></div></div>");
                     
  //                    setTimeout(function() 
  //                     {
  //                         location.reload(true);
  //                     }, 5000);
  //                    endCall();

  //                 }
  //                 if (response.status == 5) 
  //                 {
                   
  //                   pauseAudio();
  //                   $('#call_cut_messageshow').html("<div class='article' style='position: absolute;z-index: 2000000;top: 30%;left: 38%; width:340px;background: rgb(180, 62, 56);padding:45px;border:2px solid #ddd;border-radius:10px;position:fixed;'><div class='col-md-12' style='text-align:center;margin-bottom:20px;'><p style='color:white!important;'>Missed call</p></div></div>");
                    
  //                    setTimeout(function() 
  //                     {
  //                         location.reload(true);
  //                     }, 5000);
  //                     endCall();
  //                 }

  //                 if(response.status == 1)
  //                 {
  //                   playAudio();
                   
  //                   console.log('in play audio',response);
  //                 }
  //                 if (response.status == 2) 
  //                 {
  //                    pauseAudio();
  //                    console.log('in pause audio',response);
  //                 }
                  
  //                },
  //                error:function(error) 
  //                { 
  //                   //console.log('error', error);
  //                }
  //         });
}

function endCall()
{
     // Stream Disconnect code
    peerConn.close();
    webSocket.close();

    const tracks = localStream.getTracks();
    tracks.forEach((track) => {
        track.stop();
      });
    console.log('End Call Socket Close');
  // Stream Disconnect code
}
 // Call Cancle Sender and Receiver side Both.

  let isAudio = true
  function muteAudio() 
  {
    if (isAudio == true) 
    {
      isAudio = !isAudio
      localStream.getAudioTracks()[0].enabled = isAudio
      $(".mute-audio-close").show();
      $(".mute-audio-open").hide();
    }
    else if(isAudio == false) 
    {
      isAudio = !isAudio
      localStream.getAudioTracks()[0].enabled = isAudio
      $(".mute-audio-close").hide();
      $(".mute-audio-open").show();
    }
  }
  let isVideo = true
  function muteVideo() 
  {
      isVideo = !isVideo
      localStream.getVideoTracks()[0].enabled = isVideo
  }
 

// load js some time
 setTimeout(() => {
    var autoNavInterval = setInterval(autoNav, 5000);
  }, 5000);

  // function autoNav() 
  // {
  //   $.ajax({
  //           url: '{!! route('video.videogetreceiverdata') !!}',
  //           type: 'GET',
  //           data: {
  //                   "_token": "{{ csrf_token() }}",
  //                 },
  //                success: function(response) 
  //                {
                 
  //                  if ((response.status == 1) && (response.type == "video_call")) 
  //                  {
  //                   $('#myModalDataShow'+response.receiver_id).html("<div class='article' style='position: absolute;z-index: 2000000;top: 30%;left: 38%; width:340px;background: white;padding:20px;border:2px solid #ddd;border-radius:10px;position:fixed;'><div class='col-md-12' style='text-align:center;margin-bottom:20px;'><img fetchpriority='high' rel='preload' alt='profile pic' style='margin-bottom:10px; height:85px; width:85px; border-radius:50%;' src=https://www.futurestarr.com/"+response.profile_img+"><p>"+response.profile_name+"</p><p>The call will start as soon as you accept</p></div><div class='join-div row'><input id='username-input' type='hidden' class='form-control' value="+response.receiver_id+"><input type='hidden' class='form-control' value="+response.sender_id+" id='user_sender_id'><div class='col-md-4 col-md-offset-2' style='text-align:center'><span style='background-color:red; color:white;padding:10px 14px;border-radius:50%;cursor:pointer;' onclick='callCancelBtn()' class='join-call'><i class='fa fa-times' aria-hidden='true'></i></span><p style='margin-top:20px;'>Decline</p></div><div class='col-md-4' style='text-align:center;'><span class='join-call'onclick='joinCall()' style='cursor:pointer; color:white;background-color:green;padding:10px;border-radius:50%;'><i class='fa fa-video-camera'></i></span><p style='margin-top:14px; margin-left:17px;'>Accept</p></div></div></div>");
                     

  //                       console.log('success',response);
                    
  //                  }
  //                  else if((response.status == 1) && (response.type == "audio_call"))
  //                  {
                      
  //                   $('#myModalDataShow'+response.receiver_id).html("<div class='article' style='position: absolute;z-index: 2000000;top: 30%;left: 38%; width:340px;background: white;padding:20px;border:2px solid #ddd;border-radius:10px;position:fixed;'><div class='col-md-12' style='text-align:center;margin-bottom:20px;'><img fetchpriority='high' rel='preload' alt='profile pic' style='margin-bottom:10px; height:85px; width:85px; border-radius:50%;' src=https://www.futurestarr.com/"+response.profile_img+"><p>"+response.profile_name+"</p><p>The call will start as soon as you accept</p></div><div class='join-div row'><input id='username-input' type='hidden' class='form-control' value="+response.receiver_id+"><input type='hidden' class='form-control' value="+response.sender_id+" id='user_sender_id'><div class='col-md-4 col-md-offset-2' style='text-align:center'><span style='background-color:red; color:white;padding:10px 14px;border-radius:50%;cursor:pointer;' onclick='callCancelBtn()' class='join-call'><i class='fa fa-times' aria-hidden='true'></i></span><p style='margin-top:20px;'>Decline</p></div><div class='col-md-4' style='text-align:center;margin-top:-10px;'><span class='join-call'onclick='audiojoinCall()' style='cursor:pointer; color:white;'><img fetchpriority='high' rel='preload' style='width:40px;' src='{{ asset('assets/images/Group_1.png')}}' alt='group' ></span><p style='margin-top:20px;'>Accept</p></div></div></div>");
  //                      console.log('success',response);

  //                   $("#AudiomyAcceptModal #audioCall_user").html("<div><img alt='profile pic' fetchpriority='high' rel='preload' style='margin-bottom:10px; height:85px; width:85px; border-radius:50%;' src=https://www.futurestarr.com/"+response.profile_img+"><span style='font-size:20px;display:block;'>"+response.profile_name+"</span></div>")

  //                       console.log('success',response);

  //                  }
  //                },
  //                error:function(error) 
  //                {
  //                   console.log('error', error);
  //                }
  //          });
  // }
// Load js some time

 function callNotReceive(sender_id,receiver_id,ringtone_time,current_time_ring)
  {
    if (ringtone_time < current_time_ring) 
    {
      var sender_id = sender_id;
      var receiver_id = receiver_id; 
  
       $.ajax({
            url: '{!! route('video.videostoredata') !!}',
            type: 'GET',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "sender_id": sender_id,
                    "receiver_id": receiver_id,
                    "status":4,
                  },
                 success: function(response) 
                 {
                   $('#audioStartCallbySender'+sender_id).css('display','none');
                   $('#myModalDataShow'+receiver_id).css('display','none');
                   $('.modal-backdrop').css('position','inherit');
                   console.log('sender success in start call',response)
                 },
                 error:function(error) 
                 {
                    console.log('error', error);
                 }
           }); 
     }        
  }

// Sender js code

function sendData(data) 
{
    data.username = username;
    webSocket.send(JSON.stringify(data));
}
  var data_id;

  // Start Audio Call Function
function audioStartCall() 
{
   imggetuser_data_img = $('.msg_head .img_cont .user_img').attr("src");
   user_data_name = $('.msg_head .main_chat span').html();
   $('#audio_callthisuser').attr("src",imggetuser_data_img);
   $('#audio_callthisusername').html(user_data_name);

  // End Audio Call Function
   
   var sender_id = $('#user_sender_id').val();
   $("#audioStartCallbySender"+sender_id).show();
   receiver_data_id = $('.msg_head .action_menu_btn').attr("data-id");
   sendUsername(receiver_data_id);
    console.log(receiver_data_id,'919');
    document.getElementById("sender-video-call-div")
    .style.display = "inline"
    navigator.getUserMedia({
        video:false,
        audio: true
    }, (stream) => {
        localStream = stream
        document.getElementById("sender-local-video").srcObject = localStream
        let configuration = {
            iceServers: [
                {
                    "urls": ["stun:stun.l.google.com:19302",
                    "stun:stun1.l.google.com:19302",
                    "stun:stun2.l.google.com:19302"]
                }
            ]
          }
        peerConn = new RTCPeerConnection(configuration)
        peerConn.addStream(localStream)
        peerConn.onaddstream = (e) => {
            document.getElementById("sender-remote-video")
            .srcObject = e.stream
        }
        peerConn.onicecandidate = ((e) => {
            if (e.candidate == null)
                return
            sendData({
                type: "store_candidate",
                candidate: e.candidate })
        })
        createAndSendOffer()
    }, (error) => { console.log(error) });

    // Data Store in Database

    @if(Auth::user())
      var profile_name = $(".auth_user_username").val();
      var profile_img = $(".auth_user_profilepic").val();
    @endif
   var receiver_id = name2;
   console.log("receiver_id 935",receiver_id)
   console.log('receiver_id',receiver_id,'sender_id',sender_id);
   $.ajax({
            url: '{!! route('video.videostoredata') !!}',
            type: 'GET',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "sender_id": sender_id,
                    "receiver_id": receiver_id,
                    "profile_name": profile_name,
                    "profile_img": profile_img,
                    "status":1,
                    "message" : "User busy",
                    "status_type":"calling",
                    "type":"audio_call"
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
  // End Audio Call Function

function startCall() 
{
   var sender_id = $('#user_sender_id').val();
   $("#startCallbySender"+sender_id).show();
   receiver_data_id = $('.msg_head .action_menu_btn').attr("data-id");
   sendUsername(receiver_data_id);

    // Data Store in Database

    @if(Auth::user())
      var profile_name = $(".auth_user_username").val();
      var profile_img = $(".auth_user_profilepic").val();
    @endif
   var receiver_id = name2;
   console.log("receiver_id 935",receiver_id)
   console.log('receiver_id',receiver_id,'sender_id',sender_id);
   $.ajax({
            url: '{!! route('video.videostoredata') !!}',
            type: 'GET',
            data: {
                    "_token": "{{ csrf_token() }}",
                    "sender_id": sender_id,
                    "receiver_id": receiver_id,
                    "status":1,
                    "status_type" : "calling",
                    "message" : "User busy",
                    "type":"video_call"
                  },
                 success: function(response) 
                 {
                  console.log('sender success in start call',response)
                  if(response == 2)
                  {
                     console.log('sender success in start call',response)
                    $('#call_cut_messageshow').html("<div class='article' style='position: absolute;z-index: 2000000;top: 30%;left: 38%; width:340px;background: rgb(180, 62, 56);padding:45px;border:2px solid #ddd;border-radius:10px;position:fixed;'><div class='col-md-12' style='text-align:center;margin-bottom:20px;'><p style='color:white!important;'>User busy another call.</p></div></div>");
                     setTimeout(function() 
                      {
                          location.reload(true);
                      }, 5000);
                  }
                  
                 },
                 error:function(error) 
                 {
                    console.log('error', error);
                 }
           });
       // Data Store in Database

        document.getElementById("sender-video-call-div")
    .style.display = "inline"
    navigator.getUserMedia({
        video: {
            frameRate: 24,
            width: { min: 480, ideal: 720, max: 1280 },
            aspectRatio: 1.33333
        },
        audio: true
    }, (stream) => {
        localStream = stream
        document.getElementById("sender-local-video").srcObject = localStream
        let configuration = {
            iceServers: [
                {
                    "urls": ["stun:stun.l.google.com:19302",
                    "stun:stun1.l.google.com:19302",
                    "stun:stun2.l.google.com:19302"]
                }
            ]
          }
        peerConn = new RTCPeerConnection(configuration)
        peerConn.addStream(localStream)
        peerConn.onaddstream = (e) => {
            document.getElementById("sender-remote-video")
            .srcObject = e.stream
        }
        peerConn.onicecandidate = ((e) => {
            if (e.candidate == null)
                return

            sendData({
                type: "store_candidate",
                candidate: e.candidate })
        })
        createAndSendOffer()
    }, (error) => { console.log(error) });

}

  function createAndSendOffer() 
  {
    peerConn.createOffer((offer) => {
        sendData({
            type: "store_offer",
            offer: offer
        })
        peerConn.setLocalDescription(offer);
        console.log(offer,"createAndSendOffer Function");
    }, (error) => { console.log(error) })
  }

// Sender js code
    </script>

{{-- End Video Calling js code --}}

