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
            <div class="container">
              <div class="row">
                <div style='text-align:center;' class="col-lg-12">
                    <input placeholder="Enter username..." type="text" id="username-input" /><br>
                    <button style="background: #0f1d6b;color: white;padding: 6px;font-weight: bold;border-radius: 5px;border: 2px solid #ff503f; margin-bottom: 40px;" onclick="joinCallstreamview()">Join Stream</button>
                </div>
                <video id="remote-video-stream-view" autoplay></video>
               
              </div>
            </div>
        </section>
    </body>

<script type="text/javascript">
    
    const webSocketstreamview = new WebSocket("wss://futurestarr.com:3002");

    webSocketstreamview.onmessage = (event) => {
        handleSignallingDatastreamview(JSON.parse(event.data))
    }

function handleSignallingDatastreamview(data) 
{
    switch (data.type) 
    {
        case "offer":
            console.log('offer')
            peerConnstreamview.setRemoteDescription(data.offer)
            createAndSendAnswerstreamview()
            break
        case "candidate":
            peerConnstreamview.addIceCandidate(data.candidate)
    }
}

function createAndSendAnswerstreamview () 
{
    peerConnstreamview.createAnswer((answer) => {
        console.log('answer')
        peerConnstreamview.setLocalDescription(answer)
        sendDatastreamview({
            type: "send_answer",
            answer: answer
        })
    }, error => {
        console.log(error)
    })
}

function sendDatastreamview(data) 
{
    data.username = username
    webSocketstreamview.send(JSON.stringify(data))
}


let localStreamstreamview
let peerConnstreamview
// let username

function joinCallstreamview() 
{
    username = document.getElementById("username-input").value

    let configuration = {
            iceServers: [
                {
                    "urls": ["stun:stun.l.google.com:19302", 
                    "stun:stun1.l.google.com:19302", 
                    "stun:stun2.l.google.com:19302"]
                }
            ]
        }

    peerConnstreamview = new RTCPeerConnection(configuration)

    //peerConn.addStream(localStream)

    peerConnstreamview.onaddstream = (e) => {
            document.getElementById("remote-video-stream-view").srcObject = e.stream
        }

    peerConnstreamview.onicecandidate = ((e) => {
            if (e.candidate == null)
                return
            
            sendDatastreamview({
                type: "send_candidate",
                candidate: e.candidate
            })
        })

        sendDatastreamview({ type: "join_call" })
}


let isAudiostreamview = true
function muteAudio() 
{
    isAudiostreamview = !isAudiostreamview
    localStreamstreamview.getAudioTracks()[0].enabled = isAudiostreamview
}

let isVideostreamview = true
function muteVideo() 
{
    isVideostreamview = !isVideostreamview
    localStreamstreamview.getVideoTracks()[0].enabled = isVideostreamview
}
</script>
@endsection