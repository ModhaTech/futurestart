<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <style>
#video-call-div 
{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: none;
}

#local-video 
{
    position: absolute;
    top: 4%;
    left: 1%;
    border-radius: 16px;
    max-width: 80%;
    padding-left: 60px; 
    max-height: 22%;
    background: black;
}

#remote-video 
{
    width: 100%;
    height: 100%;
    background: black;
}

.call-action-div 
{
    position: absolute;
    left: 45%;
    bottom: 32px;
}

button 
{
    cursor: pointer;
}
        </style>


    </head>
    <body>
        <div>
          
            <input placeholder="Enter username..."
                    type="hidden"
                    id="username-input" value="{{$id}}" /><br>
        </div>
        <div id="video-call-div">
            <video muted id="local-video" autoplay></video>
            <video id="remote-video" autoplay></video>

            <div class="call-action-div">
               <!--  <button onclick="muteVideo()">Mute Video</button>
                <button onclick="muteAudio()">Mute Audio</button> -->
                <!-- <button onclick="endCall()">End Call</button> -->
            </div>
        </div>
        <!-- <script src="./receiver.js"></script> -->
        <script>
            const webSocket = new WebSocket("wss://futurestarr.com:3002")

webSocket.onmessage = (event) => {
    handleSignallingData(JSON.parse(event.data)) }

function handleSignallingData(data) 
{
    switch (data.type) 
    {
        case "offer":peerConn.setRemoteDescription(data.offer)
             createAndSendAnswer()
             break
        case "candidate":
             peerConn.addIceCandidate(data.candidate)
    }
}

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
}

let localStream
let peerConn
let username

function joinCall() 
{
    username = document.getElementById("username-input").value

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
            .srcObject = e.stream }

        peerConn.onicecandidate = ((e) => {
            if (e.candidate == null)
                return
            
            sendData({
                type: "send_candidate",
                candidate: e.candidate
            })
        })

        sendData({ type: "join_call" })

    }, (error) => {
        console.log(error)
    })

     // $.ajax({
     //        url: '{!! route('video.videostoredata') !!}',
     //        type: 'GET',
     //        data: {
     //                "_token": "{{ csrf_token() }}",
     //                "sender_id": 7315,
     //                "receiver_id": 7316,
     //                "status":0
     //             },
     //             success: function(response) 
     //             {
     //               console.log('sender success in start call',response)
     //             },
     //             error:function(error) 
     //             {
     //                console.log('error', error);
     //             }
     //       });
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
setTimeout(function(){
    console.log("hi");
    joinCall()
}, 3000);

</script>
</body>

</html>