<!-- For Android Page -->
<!DOCTYPE html>
<html>
    <head>
        <title>Receiver</title>
        <style type="text/css">
           <style type="text/css">
            #remote-video, #video-call-div
            {
                width: 1710px;
                margin-top: -30px !important;
            }
        </style>
        </style>
    </head>
    <body>
        <input placeholder="Enter username..." type="hidden" value="{{$id}}" id="username-input" /><br>
        <div id="video-call-div">
            <video style="width: 100%; height: 100vh;" id="remote-video" autoplay></video>
        </div>
    </body>

<script type="text/javascript">
    
    const webSocket = new WebSocket("wss://futurestarr.com:3002");

    webSocket.onmessage = (event) => {
        handleSignallingData(JSON.parse(event.data))
    }

function handleSignallingData(data) 
{
    switch (data.type) {
        case "offer":
            console.log('offer')
            peerConn.setRemoteDescription(data.offer)
            createAndSendAnswer()
            break
        case "candidate":
            peerConn.addIceCandidate(data.candidate)
    }
}

function createAndSendAnswer () 
{
    peerConn.createAnswer((answer) => {
        console.log('answer')
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
setTimeout(joinCall, 1000);
function joinCall() 
{
    username = document.getElementById("username-input").value

    document.getElementById("video-call-div").style.display = "inline"

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

    peerConn.onaddstream = (e) => {
            document.getElementById("remote-video").srcObject = e.stream
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
</script>
</html>