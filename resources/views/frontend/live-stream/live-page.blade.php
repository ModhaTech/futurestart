@extends('layouts.talent')

@section('content')
    <body>
        <section class="wow fadeIn cover-background socail-buzz background-position-top top-space" style="background-image:url({{ asset('assets/images/social-buzz/banner-buzz.jpg')}});">
            <div class="opacity-medium bg-extra-dark-gray"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
                        <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
                            <h1 class="alt-font text-white font-weight-600 mb-2">
                                FutureStarr&nbsp;<i class="fa fa-comments" aria-hidden="true"></i>&nbsp;Live Video
                            </h1>
                            <span class="display-block text-white opacity6 alt-font">
                                Promote your Products
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="knowledge-section live_channel">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" id="video-call-div-livestream">
                        <div class="user_live" style="display: none; position: absolute;padding: 3px 15px;background-color: #ef174f;border-radius: 5px; left:25px;top:16px;color: white;font-weight: 600;">Live</div>
                        <video width="85px;" id="local-video-livestream" autoplay></video>
                        <div style="display: none;position: absolute;top: 75%;left: 45%;" class="call-action-div-live">
                            <span style="margin-top: 10px; cursor: pointer;" onclick="muteVideoLiveStream()">
                                <i style="padding: 15px;" class="fa fa-video-camera"></i>
                            </span>
                            <span class="mute-audio mute-audio-close" style="padding: 10px 18px; display: none; cursor: pointer;" onclick="muteAudio()">
                                <i class="fa fa-microphone-slash" aria-hidden="true"></i>
                            </span> 
                            <span class="mute-audio mute-audio-open" style="padding: 10px 18px; cursor: pointer;" onclick="muteAudio()">
                                <i class="fa fa-microphone" aria-hidden="true"></i>
                            </span> 
                        </div>
                    </div>

                    <div class="col-lg-4" style="padding-right: 0px;padding-left: 10px;">
                        <button onclick="userStatusStore()" style="width: 100%; background: rgb(239, 23, 79);color: white;padding: 10px;font-weight: 600; border-radius: 5px;border-color: rgb(239, 23, 79);">
                            End Live Stream
                        </button>
                        <div id="view_count_show">
                            <img style='width: 30px;position: absolute;top: 70px;left: 145px;' src="{{ asset('assets/images/view.png') }}">
                            <button style="width: 100%; margin-top: 10px; background: rgb(239, 23, 79);color: white;padding: 10px;font-weight: 600; border-radius: 5px;border-color: rgb(239, 23, 79);"></button>
                        </div>
                        <div style="display: none; height: 200px; border: 2px solid #ddd; padding: 10px;margin-top: 15px;overflow-y: scroll;" id="view_comment_show">
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="{{ Auth::user()->id }}" id="username-input"/>
        </section>
    </body>

<script type="text/javascript">
    const webSocketstreamlive = new WebSocket("ws://127.0.0.1:6001");

    webSocketstreamlive.onmessage = (event) => {
        handleSignallingDataLiveStream(JSON.parse(event.data));
    };

    webSocketstreamlive.onclose = function (e) {
        console.log('Connection is closed', e);
    };

    function handleSignallingDataLiveStream(data) {
        switch (data.type) {
            case "answer":
                peerConnlive.setRemoteDescription(data.answer);
                break;
            case "candidate":
                peerConnlive.addIceCandidate(data.candidate);
                createNewPeer();
                break;
        }
    }

    function sendUsernameLiveStream() {
        username = document.getElementById("username-input").value;
        sendDatalive({ type: "store_user" });
    }

    function sendDatalive(data) {
        data.username = username;
        webSocketstreamlive.send(JSON.stringify(data));
    }

    let localStreamlive, peerConnlive;
    setTimeout(startCallLiveStream, 3000);

    function startCallLiveStream() {
        var stream_id = $("#username-input").val();
        $('.call-action-div-live').show();
        $('.user_live').show();
        sendUsernameLiveStream();

        navigator.mediaDevices.getUserMedia({
            video: { frameRate: 24, width: { min: 480, ideal: 720, max: 1280 }, aspectRatio: 1.33333 },
            audio: true
        }).then((stream) => {
            localStreamlive = stream;
            document.getElementById("local-video-livestream").srcObject = localStreamlive;
            createNewPeer();
        }).catch((error) => {
            console.log(error);
        });

        $.ajax({
            url: '{!! route('livestream.live-page-store-data') !!}',
            type: 'POST',
            data: { 
                "_token": "{{ csrf_token() }}",  // Ensure this is correctly included
                "stream_id": stream_id, 
                "type": "online", 
                "status": '1' 
            },
            success: function(response) { 
                console.log('Live stream started', response); 
            },
            error: function(error) { 
                console.log('Error', error); 
            }
        });
    }

    setTimeout(() => { setInterval(viewLivestream, 1000); }, 1000);

    function viewLivestream() {
        var stream_id = $("#username-input").val();
        $.ajax({
            url: '{!! route('livestream.liveviewCount') !!}',
            type: 'POST',
            data: { "_token": "{{ csrf_token() }}", "stream_id": stream_id },
            success: function(response) {
                $("#view_comment_show").show();
                $("#view_count_show button").html("<span style='font-size: 18px; font-weight: 600;'>" + response.view_count + "</span>");
                $("#view_comment_show").html(response.viewRender);
            },
            error: function(error) { console.log('Error', error); }
        });
    }

    function createNewPeer() {
        let configuration = {
            iceServers: [{ "urls": ["stun:stun.l.google.com:19302", "stun:stun1.l.google.com:19302", "stun:stun2.l.google.com:19302"] }]
        };
        peerConnlive = new RTCPeerConnection(configuration);
        peerConnlive.addStream(localStreamlive);

        peerConnlive.onicecandidate = ((e) => {
            if (e.candidate) {
                sendDatalive({ type: "store_candidate", candidate: e.candidate });
            }
        });

        createAndSendOfferLiveStream();
    }

    function createAndSendOfferLiveStream() {
        peerConnlive.createOffer().then((offer) => {
            sendDatalive({ type: "store_offer", offer: offer });
            peerConnlive.setLocalDescription(offer);
        }).catch((error) => {
            console.log(error);
        });
    }

    function userStatusStore() {
        var stream_id = $("#username-input").val();
        $.ajax({
            url: '{!! route('livestream.live-page-store-data') !!}',
            type: 'POST',
            data: { "_token": "{{ csrf_token() }}", "stream_id": stream_id, "type": "offline", "status": '2' },
            success: function(response) {
                window.location.replace("https://www.futurestarr.com");
            }
        });
    }
</script>

@endsection
