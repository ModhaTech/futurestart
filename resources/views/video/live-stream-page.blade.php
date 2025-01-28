
<!-- For Android Page -->
 <!DOCTYPE html>
<html>
    <head>
        <title>Sender</title>
        <style type="text/css">
            #local-video, #video-call-div{
                width: 1710px;
                margin-top: -30px !important;
            }
        </style>
    </head>
    <body>
        <input placeholder="Enter username..."type="hidden" value="{{$id}}" id="username-input" /><br>
        <div id="video-call-div">
            <video muted id="local-video" autoplay></video>
        </div>
    </body>
<script type="text/javascript">
  const webSocketstreamlive = new WebSocket("wss://futurestarr.com:3002")

webSocketstreamlive.onmessage = (event) => {
    handleSignallingDataLiveStream(JSON.parse(event.data))
}

function handleSignallingDataLiveStream(data) 
{
    switch (data.type) 
    {
        case "answer":
          console.log('answer')
            peerConnlive.setRemoteDescription(data.answer)
            break
        case "candidate":
          console.log('candidate')
            peerConnlive.addIceCandidate(data.candidate)
            createNewPeer()
    }
}

let username
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

setTimeout(startCallLiveStream, 1000);
let localStreamlive
let peerConnlive
function startCallLiveStream() 
{
    sendUsernameLiveStream();
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
        localStreamlive = stream
        document.getElementById("local-video").srcObject = localStreamlive
        createNewPeer()

    }, (error) => {
        console.log(error)
    })
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
        console.log('offer')
        peerConnlive.setLocalDescription(offer)
    }, (error) => {
        console.log(error)
    })
}

let isAudiolive = true
function muteAudio() 
{
    isAudiolive = !isAudiolive
    localStreamlive.getAudioTracks()[0].enabled = isAudiolive
}

let isVideolive = true
function muteVideo() 
{
    isVideolive = !isVideolive
    localStreamlive.getVideoTracks()[0].enabled = isVideolive
}
</script>
</html>
