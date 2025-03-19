@extends('layouts.talent')
@section('content')
<style>

.n-dark-sec p {
    color: #c2b9b9 !important;
}
.nmbar {
    background-color: rgba(0, 0, 0, 0.5) !important; /* Semi-transparent black background */
    color: white !important; /* Text color */
    z-index: 999; /* Ensures the element is on top of other content */
}

  .card-container {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh; 
}

.custom-card {
    background-color: rgba(0, 0, 0, 0.7) !important;
    /* background-color: rgb(126 126 52 / 65%) !important; */
    color: white !important; 
    height: 250px;
    padding: 25px;
    max-width: 49% !important;
    display: flex;
    flex-direction: column;
    justify-content: center; 
    text-align: center; 
    border-radius: 40px !important;
    margin-top: 120px;
   
}

.search-container {
    margin-bottom: 13px;
    margin-top: 7px;
    position: relative;
    display: flex;
    justify-content: center;
}

.search-container input {
    width: 300px;
    padding: 13px 22px 10px 20px;
    border-radius: 25px; /* Border radius set to 10px */
    border: 3px solid #FFD700;
    box-shadow: none;
}

.search-container i {
    position: absolute;
    right: 0%;
    top: 50%;
    transform: translateY(-50%);
    color: #000;
    background-color: yellow; /* Set background color to yellow */
    padding: 16px;
    border-radius: 25px 25px 25px 25px; /* Rounded corners on the right side */
}


   .btn-link {
   padding: 15px;
    margin: 10px;
    display: inline-block;
    text-decoration: none;
    color: white;
    background-color: black;
    border-radius: 20px;
    border: 2px solid white;
    width: 40%;
    height: 40px;
    text-align: center;
    line-height: 5px;
    text-transform: uppercase;
    font-size: small;
}



.btn-link.active {
    background-color: red;
    color: black;
    border: 2px solid black; 
}
.btn-link:hover,
.btn-link:focus {
    background-color: red; 
    color: white;
    text-decoration: none; 
}

.textcard {
    font-size: 20px !important;
    line-height: 45px !important;
    word-break: break-word; 
    hyphens: auto;
    color: white !important;
      text-transform: uppercase;
}

 .hpfs01 {
    width: 100%;
    height: 100vh;
    background: url('assets/images/new-home/home_bg_new.webp') no-repeat center center;
    background-size: cover;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

@media (max-width: 768px) {
    .hh34 {
    padding: 1.25rem !important;
}

    .hpfs01 {
    background: url('https://www.futurestarr.com/assets/images/new-home/home_bg.png') no-repeat center center;
    background-size: cover;
    width: 100%; /* Full width of the viewport */
    height: 54vh; /* Full height of the viewport */
    overflow: hidden; /* Ensure no overflow */
    display: flex;
    align-items: center;
    justify-content: center;
    margin:0px !important;
    }
      .custom-card {
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        height: auto;
        padding: 0px;
        max-width: 100% !important;
              margin-top: 57px !important;
    }

     .textcard {
      font-size: 15px !important;
      line-height: 15px !important;
      color: white !important;
        text-transform: uppercase; /* Makes the text uppercase */
    letter-spacing: 1px;
        }
       .btn-link{
        width: 33% !important;
           }
      .sm-logo {
         display: block !important; /* Hide logo on small screens */
          }
      .nmbar {
            
        background-color: rgba(0, 0, 0, 0.5) !important; /* Fully transparent background */
            color: white !important; /* Ensure text color is visible */
            transition: background-color 0.3s ease; /* Smooth transition for background color changes */
          
        }
        .nmbar.active {
            background-color: rgba(0, 0, 0, 1) !important; /* Opaque black background */
        }
}

.unic {
    margin-top: 0 !important;
    margin-bottom: 40px !important;
    padding-top: 10px !important;
    padding-bottom: 8px !important;
    background-color: #fffcf3;
}

@media (max-width: 768px) {
    .unic {
        
        background-color: #fffcf3; /* Keep the same background color */
    }

    .unic1{
    margin-top: 40px !important;
    }

    .text34 h2 {
        white-space: nowrap; /* Prevent line breaks */
        margin: 0 !important; /* Remove default margin */
        font-size: 2rem; /* Adjust font size as needed */
        font-weight: 700; /* Adjust font weight */
    }
.feature-box-content video{
    margin: 0px !important;
    min-height: 0px !important;
}
    .feature-box-content p {
        display: none; /* Hide paragraph text on mobile */
    }

    /* Ensure that each card takes up 50% width on smaller screens */
    .col-sm-6.col-lg-3 {
        flex: 0 0 50%; /* Make each feature box take up 50% width */
        max-width: 50%; /* Ensure the max width is 50% */
    }

    .nw {
        margin-bottom: 10px !important; /* Reduce margin-bottom */
    }
}

.half-background {
    background: 
        linear-gradient(to bottom, rgba(0, 0, 0, 0.9) 50%, white 50%), /* 50% black with reduced opacity, 50% white */
        linear-gradient(to bottom, rgba(255, 255, 255, 0) 50%, white 50%), /* Transparent to white gradient */
        url('assets/images/new-home/bg.png'); /* Background image */
    background-size: cover, cover; /* Ensure the gradients and the image cover the entire element */
    background-repeat: no-repeat, no-repeat; /* Prevent gradients and image from repeating */
    background-position: center, center; /* Center the gradients and the image */
}

.half-background .text-center h2 {
    color: white; 
}

.half-background .separator-line {
    background-color: #ff1493; 
}

.card {
    height: auto !important; /* Ensure height is set to auto */
    border-radius: 0px !important; /* Ensure border radius is 0px */
    border: 1px solid #ccc; /* Add a 1px solid border for visual definition */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Shadow for better visual depth */
}

.card:hover {
    transform: scale(1.05) !important; /* Slightly enlarges the card */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2) !important; /* Adds a shadow effect */
    transition: all 0.3s ease-in-out !important; /* Smooth transition */
}


.card-title {
    color: white !important;
    font-size: 16px !important;
}

.card-text {
    color: white !important;
    font-size: 14px !important;
}


.flip-card {
    perspective: 1000px; /* Gives a 3D effect */
    width: 100%;
    height: 300px; /* Set fixed height */
}

.flip-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transform-style: preserve-3d;
    transition: transform 0.6s;
}

.flip-card:hover .flip-card-inner {
    transform: rotateY(180deg); /* Flips the card */
}

.flip-card-front, .flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 15px;
    overflow: hidden;
}

.flip-card-front {
    display: flex;
    justify-content: center;
    align-items: center;
    background: white;
}

.flip-card-front img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures proper image fit */
    border-radius: 15px;
}

.flip-card-back {
    background: #1c1c1c;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
    transform: rotateY(180deg);
}

.flip-card-back h4 {
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.flip-card-back p {
    font-size: 0.9rem;
    text-align: center;
}

.hh1{
    margin-bottom: 6rem !important;
}

.card-text {
    color: black; /* Set text color for card text */
    margin-top: 30px !important; /* Ensure margin-top is 30px */
}

.card-body p {
    margin-top: 40px !important; /* Ensure margin-top for paragraphs is 40px */
}

/* .sm-logo{
    margin: -19px!important;
    height:10px !importent;
} */
    
 
    .hpfs02{
        visibility: visible;
    }
    /*.hpfs03{
        background-image: url('/assets/images/post342.gif'); visibility: visible; animation-duration: 900ms;
    }*/
    .hpfs04{
        visibility: visible; animation-duration: 900ms;
    }
    .hpfs05{
        background-image: url('{{ asset("assets/images/designer-working-online-K5B663T.jpg")}}');
    }
    .hpfs06{
        visibility: visible; animation-delay: 0.4s;
    }
    

    .hpfs07{
        background-image: url('{{ asset("assets/images/parallax-bg2.jpg") }}');
    }

@media (max-width: 768px) {
    .half-background.blog-post-style31 {
        
        padding: 20px;
     background: rgba(20, 20, 20, 1); /* Very dark gray, close to black */

        height: auto;
        overflow: hidden !important;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .hh1 {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        box-sizing: border-box;
    }

    .grid-item {
        flex: 0 0 auto;
        width: 90%; /* Width set to 90% for better scrollability */
        margin: 0 0px; /* Adjust margin for spacing between cards */
    }

    .blog-post1 {
        margin-bottom: 30px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border: none !imporatnt;
        border-radius: 8px;
        background-color: white !imporatnt;
        position: relative;
        border: 0 !important;
    }
    .text11 h2{
                  white-space: nowrap;
        margin: 0 !important;
        font-size: 2.5rem;
        font-weight: 600;
        color: white;
        text-align: center;
        margin: 8px !important;
    }
.half-background .separator-line{
    background-color: red !important;
}    

  .card-body p1{
     margin-top: 16px !important;
   }
   .card-body{
   padding: 2.25rem;
   }
    
}

@media (max-width: 768px) {
    .n-dark-sec p {
        color: black !important;
    }
}


@media (max-width: 768px) {
    .hide1{
        display: none !important;
    }
    .bg-extra-dark-gray{
          background-color: white;
    }
        .text33 h2{
        white-space: nowrap;
        margin: 0 !important;
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        text-align: center;
        margin: 8px !important;
        color: black;
    }
   .text33 p {
    text-align: center !important;
    color: black !important; /* Ensures black text color for paragraphs inside .text33 */
}


/* Increase specificity for p tag inside .text33 in case other styles are conflicting */
.text33 p.alt-font {
    color: black !important;
}

.text33 {
    padding-bottom: 4.5rem !important;
    margin-top: 2.5rem !important;
}

}

@media (max-width: 768px) {
    .hide2 img {
        display: none !important;
    }
    .gray12 {
        background-color: #000000cc !important; /* Background with a slight transparency */
    }
    .feature-box-5 i {
        color: #cccccc !important; /* Lighter color for the icons */
        font-size: 45px;
    }
    .feature-content .text-extra-dark-gray {
        color: #f2f2f2 !important; /* Lighter color for the headings */
        font-size: 20px!important; /* Increase the font size of headings */
    }
    .feature-content p {
        color: #e6e6e6 !important; /* Lighter color for the text */
        font-size: 13px !important; /* Increase the font size of paragraphs */
    }
    .text-uppercase1.alt-font.text-extra-dark-gray {
        font-size: 3rem !important; /* Increase the font size of the h2 heading */
        margin-bottom: 50px !important; /* Add space below the h2 heading */
        color: white !important;
    }
    .text22 a.btn {
        color: black;
        font-size: 14px;
        background-color: #ffffff !important;
        border-color: #ffffff !important;
        height: 55px !important;
        padding: 10px 20px !important;
        line-height: 2.5 !important;
        border-radius: 30px !important;
    }
}

@media (max-width: 768px) {
.hpfs05, .hpfs07{
      display: none !impoatant;
}

.text12 h2 {
    white-space: nowrap;
    margin: 0 !important;
    font-size: 2.5rem;
    font-weight: 700;
            padding-left: 20px;
}

.text12 p {
      font-weight: 400 !important;
    font-size: 15px !important;
    padding-left: 15px;
    line-height: 26px
    }
}

@media (max-width: 768px) {
    .scroll-horizontal {
        overflow-x: auto; /* Enable horizontal scrolling */
        -webkit-overflow-scrolling: touch; /* Smooth scrolling for iOS */
    }
    
    .scroll-horizontal .row {
        flex-wrap: nowrap; /* Prevent row items from wrapping */
    }

    .scroll-horizontal .col-sm-6, 
    .scroll-horizontal .col-md-4, 
    .scroll-horizontal .col-xl-3 {
        min-width: 250px; /* Set minimum width for each item */
    }

    .new1{
                background-color: #080808;
                padding: 0 !important;
    }
    .hidep{
        display: none !important;
    }

   .new2 span{
       margin-bottom: 30px !important;
   }
    .new2 p{
                    margin-top: 10px;
        font-size: 20px !important;
        text-align: center;
   }
   .scroll-horizontal .grid-item {
    min-width: 250px; /* Adjust the width based on your design */
    margin-right: 10px; /* Add space between items */
}
.blog-post-images1 img {
    width: 100%; /* Make the image take the full width of its container */
    height: 200px; /* Set a fixed height for all images */
    object-fit: cover; /* Ensure the image covers the entire area without distortion */
}
.blog-post-style33{
    background-color:  #FFFFEF !important;
 padding: 5px !important;
}
.new2 h2 {
         white-space: nowrap;
        margin: 0 !important;
        font-size: 1.9rem;
        font-weight: 600;
        color: black;
        text-align: center;
    }

}

@media (max-width: 768px) {
    .footer .col-sm-3 {
        width: 100%; /* 4 columns (25% width each) on mobile */
        flex: auto;
        max-width: 100%;
        margin-bottom: 19px;
    }

    .footer .row {
        display: flex;
        flex-wrap: wrap;
    }
}

.search-container {
    position: relative; /* Ensure container holds absolute children */
    width: 100%; /* Set the container width */
}


.feature-box-content .nw {
    display: flex;
    justify-content: center;
}

.feature-box-content .p-4 {
    border-radius: 15px; /* Rounded corners */
    background: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.feature-box-content .p-4:hover {
    transform: translateY(-5px); /* Slight lift effect */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Enhanced shadow on hover */
}

.feature-box-content video {
    width: 100%;
    height: auto;
    border-radius: 10px; /* Rounded corners for videos */
    object-fit: cover; /* Ensures video fits nicely */
}

.feature-box-content span {
    margin-top: 20px;
    font-size: 1.8rem;
    color: #333;
    font-weight: 700;
}

.feature-box-content p {
    font-size: 0.9rem;
    font-weight: 500;
    opacity: 0.8; /* Slight transparency for better readability */
}

/* Custom text colors */
.text-blue { color: #007bff; } /* Bootstrap primary blue */
.text-red { color: #e74c3c; } /* Red */
.text-yellow { color: #f1c40f; } /* Yellow */
.text-green { color: #2ecc71; } /* Green */


.search-results {
    position: absolute;
    top: 100%; /* Makes the list appear right below the search bar */
 width:100%
    background-color: #fff;
    z-index: 1000;
    border: 1px solid #ccc; 
    max-height: 300px;
    overflow-y: auto; 
    overflow-x: hidden;
    list-style-type: none; 
    padding: 0;
    margin: 0;
        width: calc(100% - 100px) !important;
    /* scrollbar-width: thin;  */
}

/* Style individual search results */
.search-results li {
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #ddd;
}

.search-results li:hover {
    background-color: #f0f0f0;
}

/* Hide scrollbar until needed (for Chrome, Edge, Safari) */
.search-results::-webkit-scrollbar {
    width: 0px;
    background: transparent; 
}

/* Show scrollbar when hovering over the list */
.search-results:hover::-webkit-scrollbar {
    width: 5px;
}

.search-results::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 5px;
}


 #search::placeholder {
    color: #000; /* Set the color to dark (black) */
    font-weight: bold; /* Set the font weight to bold */
    opacity: 1;  /* Ensure the color is fully opaque */
}

</style>
<div class="home">
      <section class="p-0 parallax mobile-height wow fadeIn hpfs01" data-stellar-background-ratio="0.5">
          <div class="container card-container">
        <div class="custom-card">
            <div class="card-body hh34">
                {{-- <h2 class="future_tittle">FUTURESTARR</h2> --}}
                {{-- <h6  class="textcard">The Ultimate Talent Marketplace</h6> --}}
                <div class="search-container">
                    <input class="mb-0 bg-search-theme-light text-dark" name="name" id="search" placeholder="Search" type="text" autocomplete="off">
                    <i class="fa fa-search" aria-hidden="true"></i>
                     <ul class="search-results list-unstyled"></ul>
                </div>
                 @if (Auth::guest())
                   <a href="{{ route('register') }}" class="btn-link">sign-up</a>
                <a href="javascript:void(0)" data-toggle="modal" data-target="#login" class="btn-link">sign-in</a>
              
                @endif
            </div>
        </div>
          </div>
</section>

   <section  class=" unic  bg-light-gray bg-light-cream">
        <div class="container unic1">
            <div class="text-center mb-3 mb-sm-5 text34">
                <p class="alt-font text-medium-gray margin-5px-bottom text-uppercase text-small">FEATURES11</p>
                <h2 class="text-uppercase alt-font text-extra-dark-gray margin-20px-bottom font-weight-700 sm-width-100 xs-width-100 extras">@lang('home.WHOCHOOSE')</h2><span class="d-block separator-line-horrizontal-medium-light2 bg-deep-pink mx-auto width-100px"></span></div>
            <div class="row feature-box-content">
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0 nw">
                    <div class="p-4 h-100 bg-white box-shadow-m text-center">
                        <div>
                            <video preload="" muted loop autoplay >
                              <source  src="{{ asset('/assets/home_gifs/post296_1.mp4') }}" type="video/mp4">
                              <source  src="{{ asset('/assets/home_gifs/post296_1.mp4') }}" type="video/ogg">
                              Your browser does not support the video tag.
                            </video>
                        </div>
                        <span class="alt-font text-extra-dark-gray font-weight-600 display-block mb-2 text-medium">@lang('home.TAKECONTROLTITLE')</span>
                        <p class="mb-0 text-blue">@lang('home.TAKECONTROLDESCRIPTION')</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0 nw">
                    <div class="p-4 h-100 bg-white box-shadow-m text-center">
                        <div>
                            <video muted loop autoplay >
                              <source  src="{{ asset('/assets/home_gifs/post289_1.mp4') }}" type="video/mp4">
                              <source  src="{{ asset('/assets/home_gifs/post289_1.mp4') }}" type="video/ogg">
                              Your browser does not support the video tag.
                            </video>
                        </div>
                        <span class="alt-font text-extra-dark-gray font-weight-600 display-block mb-2 text-medium">@lang('home.EXPLORETALENT')</span>
                        <p class="mb-0 text-red ">@lang('home.EXPLORETALENTDESCRIPTION')</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0 nw">
                    <div class="p-4 h-100 bg-white box-shadow-m text-center">
                        <div>
                            <video muted loop autoplay >
                              <source src="{{ asset('/assets/home_gifs/post318_1.mp4') }}" type="video/mp4">
                              Your browser does not support the video tag.
                            </video>
                        </div>
                        <span class="alt-font text-extra-dark-gray font-weight-600 display-block mb-2 text-medium">@lang('home.EARNWAYTOSTARDOM')</span>
                        <p class="mb-0 text-yellow">@lang('home.EARNWAYTOSTARDOMDESCRIPTION')</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-sm-4 mb-lg-0 nw">
                    <div class="p-4 h-100 bg-white box-shadow-m text-center">
                        <div>
                            <video muted loop autoplay>
                              <source src="{{ asset('/assets/home_gifs/post338_1.mp4') }}" type="video/mp4">
                              Your browser does not support the video tag.
                            </video>
                        </div>
                        <span class="alt-font text-extra-dark-gray font-weight-600 display-block mb-2 text-medium">@lang('home.GETREWARD')</span>
                        <p class="mb-0 text-green">@lang('home.GETREWARDDESCRIPTION')</p>
                    </div>
                </div>
            </div>
        </div>
</section>
    
      <!--neww-->
 <section class="half-background blog-post-style31" style="padding: 8px 0 !important;">
    <div class="container">
        <div class="text-center mb-5 text11">
            <h2 class="text-uppercase text-extra-dark-gray">Featured Artists</h2>
            <span class="separator-line bg-deep-pink d-block mx-auto mb-3" style="width: 100px; height: 2px;"></span>
        </div>
        <div class="row hh1">
            <div class="col-md-4 mb-4 text-center grid-item">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <!-- Front Side (Image) -->
                        <div class="flip-card-front">
                            <img src="{{ asset('assets/images/new-home/new3.jpg') }}" class="card-img-top" alt="JAZZY B">
                        </div>
                        <!-- Back Side (Content) -->
                        <div class="flip-card-back">
                            <h4 class="card-title">- JAZZY B -</h4>
                            <p class="card-text">An upcoming Atlanta-based hip-hop artist who has used FutureStarr to grow her audience and sell her latest album.</p>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-md-4 mb-4 text-center grid-item">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="{{ asset('assets/images/new-home/new2.jpg') }}" class="card-img-top" alt="DJ BEATMASTER B">
                        </div>
                        <div class="flip-card-back">
                            <h4 class="card-title">- DJ BEATMASTER B -</h4>
                            <p class="card-text">A well-known DJ in Atlanta who leverages FutureStarr to share exclusive mixes and connect with fans.</p>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-md-4 mb-4 text-center grid-item">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="{{ asset('assets/images/new-home/new1.jpg') }}" class="card-img-top" alt="Rhythm and Flow">
                        </div>
                        <div class="flip-card-back">
                            <h4 class="card-title">- RHYTHM AND FLOW -</h4>
                            <p class="card-text">A hip-hop duo that has seen significant revenue growth and fan engagement through their profile on FutureStarr.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

    <!--newand-->
    
    
    <section class="no-padding wow fadeIn bg-extra-dark-gray hpfs02" id="services">
        <div class="container-fluid no-padding">
            <div class="row equalize sm-equalize-auto no-margin n-dark-sec">
                <div  class="col-md-6 position-relative sm-height-auto xs-height-350px wow slideInLeft hpfs03 image-blur hide1" data--duration="900ms">
                    <video style="border: none !important;" muted loop autoplay>
                      <source src="{{ asset('assets/images/post342.mp4') }}" type="video/mp4">
                      Your browser does not support the video tag.
                    </video>
                </div>
                <div class="col-md-6 wow slideInRight hpfs04" data--duration="900ms">
                    <div class="text-center text-md-left py-4 py-sm-5 px-md-4 p-lg-5 m-lg-5 text33">
                        <div class="mb-3 mb-sm-5">
                            <p class="alt-font text-medium-gray margin-5px-bottom text-uppercase text-small">DISCOVER</p>
                             <h2 class="text-uppercase alt-font text-light-gray margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Future Starr</h2><span class="d-block separator-line-horrizontal-medium-light2 bg-deep-pink mx-auto width-100px mr-md-auto ml-md-0"></span>
                         </div>
                          @lang('home.DISCOVERDESCRIPTION')
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
   <section class=" wow fadeIn hpfs02 bg-gray gray12">
        <div class="container">
            <div class="row">
                <div class="d-md-none d-lg-block col-md-5 pr-sm-5 pr-lg-0 text-center  wow fadeIn hpfs02">
                    <div class="display-table-cell vertical-align-middle hide2"><img alt="LET'S GET STARTED!" title="LET'S GET STARTED!" class="img-fluid" src="{{asset('assets/images/image-3.png') }}"></div>
                </div>
                <div class="pl-lg-5 col-md-12 col-lg-7  wow fadeIn hpfs06" data--delay="0.4s">
                    <div class="mb-3 mt-5 mt-md-0 mb-sm-5 text-center ">
                         <h2 class="text-uppercase1 alt-font text-extra-dark-gray margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">@lang('home.LETSTART')<span class="separator-line-horrizontal-medium-light2 bg-deep-pink d-block mx-auto width-100px"></span></div></h2>
                    <div class="row">
                        <div class="col-12 margin-six-bottom md-margin-six-bottom xs-margin-ten-bottom  wow fadeInUp last-paragraph-no-margin hpfs02">
                            <div class="feature-box-5 position-relative"><i class="icon-global text-medium-gray icon-medium"></i>
                                <div class="feature-content">
                                    <div class="text-extra-dark-gray margin-10px-bottom alt-font font-weight-600">@lang('home.HOWTOUSE')</div>
                                    <p class="color-black">@lang('home.HOWTOUSEDESCRIPTION')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 margin-six-bottom md-margin-six-bottom xs-margin-ten-bottom  wow fadeInUp last-paragraph-no-margin hpfs06" data--delay="0.2s">
                            <div class="feature-box-5 position-relative"><i class="icon-video text-medium-gray icon-medium"></i>
                                <div class="feature-content">
                                    <div class="text-extra-dark-gray margin-10px-bottom alt-font font-weight-600">@lang('home.VISITEUPCOMINGTALENT')</div>
                                    <p class="color-black">@lang('home.VISITEUPCOMINGTALENTDESCRIPTION')</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 margin-six-bottom md-margin-six-bottom xs-margin-ten-bottom  wow fadeInUp last-paragraph-no-margin hpfs06" data--delay="0.4s">
                            <div class="feature-box-5 position-relative"><i class="icon-tools text-medium-gray icon-medium"></i>
                                <div class="feature-content">
                                    <div class="text-extra-dark-gray margin-10px-bottom alt-font font-weight-600">@lang('home.CREATEARTIST')</div>
                                    <p class="color-black">@lang('home.CREATEATRISATDESCRIPTION')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                      @if(Auth::check() && Auth::user()->role_id =='4')
                      <div class="text-center text22"><a class="btn btn-small btn-dark-gray" href="{{ route('seller.index') }}">Click here to create page</a></div>
                     @elseif(Auth::check() && Auth::user()->role_id =='3')
                      <div class="text-center text22"><a class="btn btn-small btn-dark-gray" href="javascript:void(0);" data-toggle="modal" data-target="#information_modal">Click here to create page</a></div>
                    @else
                    <div class="text-center text22"><a class="btn btn-small btn-dark-gray" href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">Click here to create page</a></div>
                  @endif
                </div>
            </div>
        </div>
  </section>
 <section class="no-padding  wow fadeIn xs-text-center hpfs02">
        <div class="container-fluid no-padding">
            <div class="row no-gutters">
                <div class="d-none d-lg-block col-sm-4 col-xl-3 p-0 cover-background hpfs05">
                    <div class="sm-height-500px xs-height-350px"></div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 bg-white text-center text-md-left px-md-4 px-lg-5 text12">
                    <div class="py-4">                      
                        <h2 class="alt-font font-weight-700 text-extra-dark-gray text-uppercase">@lang('home.ABOUT')</h2><span class="d-block separator-line-horrizontal-medium-light2 bg-deep-pink mx-auto width-100px mb-3 mb-md-4 mr-md-auto ml-md-0"></span>
                        <p class="color-black">@lang('home.ABOUTDESCRIPTION')</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-6 cover-background p-0 hpfs07">
                    <div class="sm-height-auto xs-height-350px"></div>
                </div>
            </div>
        </div>
    
</section>
 <section class="bg-extra-dark-gray wow fadeIn hpfs02 new1">
    <div class="container">
        <div class="row text-center new2">
            <div class="col-md-12 n-dark-sec">
                <p class="alt-font margin-5px-bottom text-uppercase text-small text-medium-gray">EXPLORE</p>
                <h2 class="text-uppercase alt-font text-white margin-10px-top margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">@lang('home.MARKETPLACE')</h2>
                <span class="separator-line-horrizontal-medium-light2 bg-deep-pink d-block mx-auto width-100px mb-sm-5"></span>
                <p class="mt-3 mb-sm-5 hidep">@lang('home.MARKETPLACEDESCRIPTION')</p>
            </div>
        </div>
        <div class="scroll-horizontal"> <!-- New Wrapper Class -->
            <div class="row">
                @if(!empty($catagories))
                  @foreach($catagories as $category)
                <div class="col-sm-6 col-md-4 col-xl-3 mb-4 wow fadeInUp last-paragraph-no-margin">
                    <div class="h-100 blog-post blog-post-style1 xs-text-center bg-white">
                        <div class="blog-post-images overflow-hidden">
                            <a href="{{ route('search.index',$category->slug) }}">
                                @php
                                $catagory_image_path = str_replace('.gif', '.mp4', $category->catagory_image_path);
                                @endphp
                                <video muted loop autoplay>
                                  <source src="{{asset('assets/'.$catagory_image_path)}}" type="video/mp4">
                                  Your browser does not support the video tag.
                                </video>
                                </a>
                        </div>
                        <div class="post-details p-3">
                            <p class="text-medium mb-0 text-black ovpasstitle">{{ $category->name }}</p>
                            <div class="separator-line-horrizontal-full bg-medium-light-gray my-2"></div>
                            <p class="width-90 xs-width-100 color-black">  
                                {!! Str::limit(strip_tags($category->catagory_desc), 200) !!} 
                            </p>
                        </div>
                    </div>
                </div>
               @endforeach
               @endif
            </div>
        </div> <!-- End of Wrapper -->
    </div>
</section>

  <section class="wow fadeIn hover-option4 blog-post-style33">
    <div class="container">
        <div class="text-center mb-5 new2">
            <p class="alt-font margin-5px-bottom text-uppercase text-small text-medium-gray">NEWS</p>
            <h2 class="text-uppercase alt-font text-extra-dark-gray margin-10px-top margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Latest Blogs</h2>
            <span class="separator-line-horrizontal-medium-light2 bg-deep-pink display-table margin-auto width-100px"></span>
        </div>
        <div class="scroll-horizontal"> <!-- New Wrapper Class -->
            <div class="row">
                @if($blogs)
                    @foreach($blogs as $blog)
                    @php $slug = $blog->id.'/'.Str::slug($blog->title,'-'); @endphp
                    <div class="grid-item col-md-4 margin-30px-bottom xs-text-center wow fadeInUp">
                        <div class="blog-post bg-light-gray inner-match-height">
                            <div class="blog-post-images1 overflow-hidden position-relative">
                                <a href="{{ route('blog.detailed',[$blog->getBlogCatagories['slug'], $blog->slug]) }}">
                                  <img src="{{asset( !empty($blog->blog_img) ? $blog->blog_img:'assets/images/default-ad-banner.png')}}" alt="Blog Media" title="{{$blog->title}}" loading="lazy">
                                    <div class="blog-hover-icon"><span class="text-extra-large font-weight-300">+</span></div>
                                </a>
                            </div>
                            <div class="post-details padding-40px-all sm-padding-20px-all" style="padding: 25px;">
                                <a class="ovpasstitle alt-font post-title text-medium text-extra-dark-gray width-100 display-block md-width-100 margin-15px-bottom" href="{{ route('blog.detailed',[$blog->getBlogCatagories['slug'], $blog->slug]) }}"> {{ $blog->title }}...</a>
                                <div class="blog-content" style="margin-top: 30px;">
                                   <p class="width-90 xs-width-100 color-black"> {!! Str::limit(strip_tags($blog->content), 100) !!} </p>
                                </div>
                                <div class="separator-line-horrizontal-full bg-medium-gray margin-20px-tb"></div>
                                <div class="author mt-auto"><span class="width-90 xs-width-100 color-black">By {{ $blog->author_first_name  }} {{ $blog->author_last_name  }}
                                <a class="text-medium-gray"  href="javascript:void(0);"></a>&nbsp;&nbsp;|&nbsp;&nbsp; {{date('M d, Y', strtotime($blog->date))}} </span></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div> <!-- End of Wrapper -->
    </div>
</section>

</div>

<a class="scroll-top-arrow" href="javascript:void(0);"><i   class="ti-arrow-up"></i></a>

<!-- sell your talent modal -->
<div class="modal-ask-to-login" id="askToJoinAsSeller" role="dialog">
    <div class="modal-dialog">
        <form>
            <!-- Modal content-->
            <div class="modal-content ask-to-login">
                <div class="modal-body">
                    <br>
                    <h3 class="ask-register"> To use this feature please register as Seller. <br> <small>By clicking Register, you will be logged out from your current account. </small></h3>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">REGISTER</button>
                    <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end of sell your talent modal -->
<!-- buy your talent modal -->
<div class="modal-ask-to-login " id="askToJoinAsBuyer" role="dialog">
    <div class="modal-dialog">
        <form>
            <!-- Modal content-->
            <div class="ask-to-login">
                <div class="modal-body">
                    <br>
                    <h3 class="ask-register"> To use this feature please register as Buyer. <br> <small>By clicking Register, you will be logged out from your current account. </small></h3>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-danger" data-dismiss="modal" onclick="goToRegister()">REGISTER</button>
                    <button type="button" class="btn btn-default btn-d" data-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end of buy your talent modal -->
<!-- ASK TO LOGIN -->
<div class="modal-ask-to-login " id="askToLogin" role="dialog">
    <div class="modal-dialog">
        <form>
            <!-- Modal content-->
            <div class="ask-to-login">
                <div class="modal-body">
                    <div class="form-group text-spinner">
                        <h3 class="deleteConfirmation">Please login to use this feature! </h3>
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
<!-- this is for the registration new pop-up screen -->
<!-- Ask to join as Seller -->
    <!-- Modal -->

@auth
<div class="pop-up-after-register" style="display: {{ $display_pop == 'seller' ? 'block' : 'none' }}">
    <div class="after-register seller">
        <div class="pop-img-div">
            <img  alt="Demo_user" title="Demo User" class="demo-user" src="{{asset('assets/images/demo-user-360.png') }}" loading="lazy">
        </div>
        <div class="div-text">
            <p class="head">Congrats {{ $current_user->username }}! Let's Get Started</p>
            <p class="text">Click the Dashboard and Setup your Personal & Public Profile</p>
            <a href="{{ url('/seller/dashboard') }}" class="btn btn-primary">Continue</a>
        </div>
    </div>
</div>
<div class="pop-up-after-register" style="display: {{ $display_pop == 'buyer' ? 'block' : 'none' }}">
    <div class="after-register buyer">
        <div class="pop-img-div">
            <img  alt="mobile_cover" title="Mobile Cover" class="mobile-cover" src="{{ asset('assets/images/yellow-mobile-cover.png') }}" loading="lazy">
            <div class="demo-user-div">
                <img  alt="demo_user" title="demo user" class="demo-user" src="{{ asset('assets/images/demo-user-360.png') }}" loading="lazy">                
            </div> 
            <p class="demo-buy">Buy</p>
        </div>
        <div class="div-text">
            <p class="head">Congrats {{ $current_user->username }}! Let's Get Started</p>
            <p class="text">Click the Dashboard and Setup your Personal & Public Profile</p>
            <a href="{{ url('/buyer/dashboard') }}" class="btn btn-primary">Continue</a>
        </div>
    </div>
</div>
@endauth
<style>
    .pop-up-after-register
    {
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background: #0000009c;
    }
    .pop-up-after-register .after-register
    {
        margin: auto;
        display: block;
        position: fixed;
        right: 0;
        left: 0;
        top: 0;
        bottom: 0;
        width: 500px;        
        background: #ffffff;
        border-radius: 7px;
        box-shadow: 0px 1px 11px 7px #444444;
        padding: 30px;
    }
    .pop-up-after-register .after-register.seller
    {
        height: 320px;
    }
    .pop-up-after-register .after-register.buyer
    {
        height: 355px;
    }
    .pop-up-after-register .after-register.seller .pop-img-div
    {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: #b52323;
        overflow: hidden;
        margin: auto;
    }
    .pop-up-after-register .after-register.seller .pop-img-div img.demo-user
    {
        display: block;
        width: 100%;
        height: 100%;
        padding: 6px 6px 0 6px;
    }
    .pop-up-after-register .after-register.buyer .pop-img-div
    {
        width: 85px;
        margin: auto;
        position: relative;
    }
    .pop-up-after-register .after-register.buyer .pop-img-div .demo-user-div
    {
        border-radius: 50%;
        background: #b52323;
        overflow: hidden;
        margin: auto;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 50px;
        height: 50px;
        margin: 27px auto 10px auto;
    }
    .pop-up-after-register .after-register.buyer p.demo-buy
    {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 29px;
        width: 50px;
        padding: 1px 0px;
        border-radius: 12px;
        color: #ffffff !important;
        text-align: center;
        margin: auto;
        background: #ff6a00;
        text-transform: uppercase;
        padding-top: 2px;
    }
    .pop-up-after-register .after-register.buyer .pop-img-div img.demo-user
    {
        padding: 6px 6px 0 6px;
    }
    .pop-up-after-register .after-register .div-text
    {
        text-align: center;
        margin-top: 30px;
    }
    .pop-up-after-register .after-register .div-text .head
    {
        font-size: 20px !important;
    }
    .pop-up-after-register .after-register .div-text .btn{
        margin-top: 20px;
    }
    .image-blur
    {
        cursor: pointer;
        overflow: hidden; 
        background-position: center; 
        background-size: 100% 100%;
        background-repeat: no-repeat;
    }

@media screen and (min-width: 1500px) and (max-width: 1899px)
{
    .no-margin 
    {
      height: 510px;
    }
}
@media screen and (min-width: 1900px) and (max-width: 2990px)
{
    .no-margin 
    {
      margin: 0!important;
      height: 768px;
    }
}
@media screen and (min-width: 2992px)
{
    .no-margin 
    {
      margin: 0!important;
      height: 1145px;
    }
}
</style>
<script>
var vid = document.getElementById("home-slider");

function setPlaySpeed() { 
  vid.playbackRate = 0.5;
} 
setPlaySpeed();
</script> 
<script>
        document.addEventListener('DOMContentLoaded', () => {
            const links = document.querySelectorAll('.btn-link');

            links.forEach(link => {
                link.addEventListener('click', function() {
                    links.forEach(l => {
                        l.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });
        });
    </script>
 <script>
            var navbar = document.getElementById("navbar");
            // if (window.location.href === "https://www.futurestarr.com/newhome") {
                 if (window.location.href === "https://www.futurestarr.com/") {
                if (navbar) {
                    navbar.style.display = "none";
                }
            }
    </script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    var navbar = document.querySelector('.nmbar');
    
    // Toggle 'active' class on click
    navbar.addEventListener('click', function() {
        navbar.classList.toggle('active');
    });
});
</script>


@endsection


