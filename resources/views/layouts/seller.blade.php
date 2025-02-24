<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
     @if(isset($custom))
    <title>{{ $custom['title'] }}</title>
    @else
    <title>@yield('title')</title>
    @endif
    <script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "Future Starr | Self Promotion | Entertainment Careers",
			"url": "https://www.futurestarr.com",
			"name": "Future Starr",
			"contactPoint": 
			{
				"@type": "ContactPoint",
				"telephone": "(800) 667-4919",
				"contactType": "Customer service"
			}
		}
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="title" content="{{isset($metaTags['title'])?$metaTags['title']: '' }}">
    <meta name="description" content="{{isset($metaTags['description'])?$metaTags['description']: '' }}">
    <meta name="keywords" content="{{isset($metaTags['keywords'])?$metaTags['keywords']: '' }}">
   
	<script type="application/ld+json">
     {
      "@context": "https://schema.org",
      "@type": "Future Starr | Self Promotion | Entertainment Careers",
      "url": "https://www.futurestarr.com",
      "name": "Future Starr",
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "(800) 667-4919",
        "contactType": "Customer service"
      }
    }
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site-url" content="{{ url('/') }}">
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <!-- Latest compiled and minified CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="preload" as="font" href="{{ asset('assets/css/font.css') }}" rel="stylesheet">
 
    <link defer href="{{ url('assets/css/et-line-icons.css') }}" rel="stylesheet">

    <link rel="preload" as="font" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">

    <link rel="preload" as="font" href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&display=swap" rel="stylesheet">

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-39143753-1');
        // new WOW().init();
    </script>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-39143753-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-39143753-1');
	</script>

    <input type="hidden" id="current_user" value="{{ !empty(Auth::check() ) ? Auth::user()->id: '' }}" />
    <input type="hidden" id="pusher_app_key" value="{{ Config::get('constants.pusher.app_key') }}" />
    <input type="hidden" id="pusher_cluster" value="{{ Config::get('constants.pusher.cluster') }}" />
   <script>
            var base_url = '{{ url("/") }}';
        </script>
        
        <style>
  .detail-blog-secss p
  {
    text-align: justify;
  }
  @media(max-width:768px)
  {
    a.navbar-brand 
    {
      right: 0;
    }
    .main-slider .owl-dots 
    {
      bottom: 2px;
    }
    .main-slider .owl-dots .owl-dot 
    {
      width: 15px;
      height: 15px;
    }
    .aside-title:after 
    {
      top:99%;
    }
    .hpfs01 
    {
      margin-top: 1px!important;
    }
   /* nav.navbar.navbar-inverse.fixed-top
    {
      background-color: rgb(21, 24, 41);
    } */
  }
</style>
<style>
      /* Audio Call css*/
  
  .start_receiver_div #sender-video-call-div #sender-video-call-subdiv
  {
     font-size: 80px!important; 
     text-align: center!important; 
     background-color:white!important; 
     height: 250px!important;
  }
</style>
</head>
@php $segment = Request::segment(1);
 if(!empty($segment)) { $bodyClass = Request::segment(1); } else { $bodyClass ='home'; }
@endphp
<body class="{{ $bodyClass }}">
    <script >       
        var preload = document.createElement("div");
        preload.className = "preloader";
        preload.innerHTML =
        '<p class="hello"><img src="//' + window.location.host + '/assets/images/gif-img/img-5.gif" alt="Preloader Image" class="img-fluid"></p><div id="preloader"><div id="loader"></div></div>';
        document.body.appendChild(preload);
        window.addEventListener("load", function() {
        //  Uncomment to fade preloader after document load
            preload.className += " fade";
            setTimeout(function() {
              preload.style.display = "none";
            }, 1500);
        });
    </script>
     <!-- <div id="load"></div> -->
    @include('layouts.talent.header')
    @yield('content')
    @include('layouts.talent.footer')
    <script>
    document.onreadystatechange = function () {
        var state = document.readyState
        if (state == 'complete') {
            setTimeout(function(){
                document.getElementById('interactive');
                document.getElementById('load').style.visibility="hidden";
            },1000);
        }
    }
    </script>
       <script>
        jQuery(document).ready(function(){
            jQuery('.scroll-top-arrow').fadeOut();
        });
        jQuery(window).scroll(function(){
            if (jQuery(this).scrollTop() > 100) {
                jQuery('.scroll-top-arrow').fadeIn();
            } else {
                jQuery('.scroll-top-arrow').fadeOut();
            }
        });
        jQuery(".scroll-top-arrow").click(function() {
          jQuery("html, body").animate({ scrollTop: 0,behavior: 'smooth' }, "slow");
          return false;
      });
  </script>
    @yield('javascript')
    {{-- <script src="{{ asset('assets/js/custom.js') }}" type="text/javascript"></script> --}}


</body>
</html>
