<!DOCTYPE html>
<html>
    <head>
        <title>Sender</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<!--        <link rel="stylesheet" href="../style.css">-->
        <style>
    #video-call-div {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: none;
    background: black;
}

#local-video {
    position: absolute;
    top: 4%;
    left: 1%;
    border-radius: 16px;
    max-width: 80%;
    padding-left: 60px; 
    max-height: 22%;
    background: black;
}

#remote-video {
    width: 100%;
    height: 100%;
    background: black;
}



button {
    cursor: pointer;
}
        </style>
    </head>
    <body>
        <div>
            <input placeholder="Enter username..."
                    type="hidden"
                    id="username-input" value="{{$id}}" /><br>
            <!-- <button onclick="sendUsername()">Send</button> -->
            <!-- <button onclick="startCall()">Start Call</button> -->
        </div>
        <div id="video-call-div">
            <video muted id="local-video" autoplay></video>
            <video id="remote-video" autoplay></video>
            
        </div>
        <!-- <script src="./sender.js"></script> -->
        <script>
            const webSocket = new WebSocket("wss://futurestarr.com:3002");

webSocket.onmessage = (event) => {
    handleSignallingData(JSON.parse(event.data))
}

function handleSignallingData(data) 
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

let username
function sendUsername(callback) 
{
    username = document.getElementById("username-input").value
    sendData({
        type: "store_user"
    });
    console.log(document.getElementById("username-input").value);
    // Android.onPeerConnected()
    callback()
}

function sendData(data) 
{
    data.username = username
    webSocket.send(JSON.stringify(data))
}

let localStream
let peerConn
function startCall() 
{
    console.log("Start Call");
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
                type: "store_candidate",
                candidate: e.candidate
            })
        })

        createAndSendOffer()
    }, (error) => {
        console.log(error)
    })
}

function createAndSendOffer() 
{
    peerConn.createOffer((offer) => {
        sendData({
            type: "store_offer",
            offer: offer
        })

        peerConn.setLocalDescription(offer)
    }, (error) => {
        console.log(error)
    })
}

let isAudio = true
function muteAudio() 
{
    isAudio = !isAudio
    localStream.getAudioTracks()[0].enabled = isAudio
}

let isVideo = true
function muteVideo() 
{
    isVideo = !isVideo
    localStream.getVideoTracks()[0].enabled = isVideo
}


// setTimeout(() => {
//     var autoNavcancel = setInterval(callCancleSocketclose, 5000);
//   }, 5000);
// function callCancleSocketclose()
// {
//    receiver_data_id = $('.msg_head .action_menu_btn').attr("data-id");
//    receiver_data_id_receiver_end = $('#username-input').val();
  
//    $.ajax({
//             url: '{!! route('video.videopopupcancel') !!}',
//             type: 'GET',
//             data: {
//                     "_token": "{{ csrf_token() }}",
//                     "receiver_id":receiver_id,
//                     "sender_id": sender_id,
//                   },
//                  success: function(response) 
//                  {
                  
//                  },
//                  error:function(error) 
//                  { 
//                     //console.log('error', error);
//                  }
//           });
// }

function endCall()
{
    peerConn.close();
    webSocket.close();

    const tracks = localStream.getTracks();
    tracks.forEach((track) => {
        track.stop();
      });
    console.log('End Call Socket Close');
}

setTimeout(function () 
{
    console.log("hi");
  sendUsername(startCall)
}, 3000)

 </script>
</body>

</html>
