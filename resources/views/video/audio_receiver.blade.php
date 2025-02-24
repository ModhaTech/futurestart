<!DOCTYPE html>
<html>
    <head>

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
    top: 0;
    left: 0;
    margin: 16px;
    border-radius: 16px;
    max-width: 20%;
    max-height: 20%;
    background: #ffffff;
}

#remote-video 
{
    background: #000000;
    width: 100%;
    height: 100%;
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
            <button onclick="joinCall()" class="btn btn-successs">Call Accept</button>
            <input placeholder="Enter username..."
                    type="hidden"
                    id="username-input" value="{{$id}}" /><br>
        </div>
        <div id="video-call-div">
            <video style="display: none;" muted id="local-video" autoplay></video>
            <video style="display: none;" id="remote-video" autoplay></video>
            <div style="font-size: 80px; text-align: center; background-color:white; height: 250px;">
              <div style="padding-top: 30px;">
                <img style="height: 85px; width: 85px; border-radius: 50%;" src="https://www.futurestarr.com/userImage/ca06cfae4b68b98f7cd860fc8abb83a3.jpg" id="audio_callthisuser">
                <span style="display: block;font-size: 20px;" id="audio_callthisusername">{{$full_name}}</span>
              </div>
              
           </div>
           <div class="call-action-div" style="bottom: 40px;">
              <span class="mute-audio" style="margin-right: 20px;margin-left: 15px;padding: 10px 18px 10px 18px;" onclick="muteAudio()"><i class="fa fa-microphone-slash" aria-hidden="true"></i></span> 
              <span onclick="callCancelBtn()"><i class="fa fa-phone"></i></span>
            </div>
           
        </div>
    
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
        video: false,
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

           // Android.onPeerConnected()

    }, (error) => {
        console.log(error)
    })
}

function endCall()
{
  // Stream Disconnect code
    peerConn.removeStream(localStream);
    peerConn.close();
    console.log('End Call')
  // Stream Disconnect code
}

let isAudio = true
// function muteAudio() 
// {
//     isAudio = !isAudio
//     localStream.getAudioTracks()[0].enabled = isAudio
// }

let isVideo = true
function muteVideo() 
{
    isVideo = !isVideo
    localStream.getVideoTracks()[0].enabled = isVideo
}
setTimeout(function(){
    console.log("hi");
    joinCall()
}, 1000);

</script>
</body>

</html>