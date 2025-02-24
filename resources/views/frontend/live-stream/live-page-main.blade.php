@extends('layouts.talent') 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
@section('content') 
<body>
  <section class="wow fadeIn cover-background socail-buzz background-position-top top-space" style="background-image:url({{ asset('assets/images/social-buzz/banner-buzz.jpg')}});">
   <div class="opacity-medium bg-extra-dark-gray"></div>
   <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
          <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
               <!-- start page title -->
               <h1 class="alt-font text-white font-weight-600 mb-2">FutureStarr&nbsp;<i class="fa fa-comments" aria-hidden="true"></i>&nbsp;Live User</h1>
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
      <a class="user_live" style="position: relative;padding: 2px 12px 2px 12px;background-color: #ef174f;border-radius: 3px;text-transform: uppercase;left:10px;top:40px;color: white;font-weight: 600;">Live</a>
      <video style="border-radius: 10px;" id="livestream-video-call-div" autoplay></video>
      <input type="hidden" value="{{ Auth::user()->id }}" id="live_page_userid" name="">
    </div>
  </div>
 </section>
</body>

<script type="text/javascript">
    // get video dom element
        // const video = document.querySelector('video');
        const video = document.getElementById("livestream-video-call-div");
        const live_page_userid = $('#live_page_userid').val();
        
        // request access to webcam
        navigator.mediaDevices.getUserMedia({video: {width: 426, height: 240}}).then((stream) => video.srcObject = stream);
        
        // returns a frame encoded in base64
        const getFrame = () => {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            const data = canvas.toDataURL('image/png');
            const dataget = 
            {
              id:live_page_userid,
              data:data
            }
            return (JSON.stringify(dataget));
        }
        const WS_URL = location.origin.replace(/^http/, 'ws');
        const FPS = 3;
        const ws = new WebSocket("wss://futurestarr.com:3001");
        ws.onopen = () => {
            console.log(`Connected to ${WS_URL}`);
            setInterval(() => {
                ws.send(getFrame());
            }, 1000 / FPS);
        }
</script>
@endsection 