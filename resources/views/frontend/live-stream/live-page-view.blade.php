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
      <img style="width: 100%;" id="livestream-video-call-div" src="">
      <input type="hidden" value="{{$livestream_data_get->user_id}}" id="live_page_userid">
    </div>
  </div>
 </section>
     
</body>
@endsection 