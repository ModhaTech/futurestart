<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Future Starr</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">


    <style>
 .custom-card {
    background-color: rgba(0, 0, 0, 0.5) !important; /* Black background with 50% opacity */
    color: white !important;
    height: 250px !important;
    padding: 18px; 
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    border-radius: 0px !important;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.7); /* Dark box shadow */
    max-width: 41% !important;
}




        .card-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 120px;
        }

        .search-container {
            display: flex;
            align-items: center;
            background-color: yellow;
            border-radius: 20px;
            padding: 5px;
        }

        .search-container input {
            border: none;
            outline: none;
            border-radius: 20px;
            background-color: white;
            margin-right: 10px;
            flex-grow: 1;
        }

        .search-container .fa-search {
            color: black;
        }

        .btn-link {
            padding: 10px;
            margin: 10px;
            display: inline-block;
            text-decoration: none;
            color: white;
            background-color: black;
            border-radius: 20px;
            border: 2px solid white;
        }

        .btn-link.active {
            background-color: yellow;
            color: black;
            border: 2px solid black;
        }

        .hpfs01 {
            width: 100%;
            height: 100vh;
            background: url('https://www.futurestarr.com/assets/images/new-home/home_bg.jpg') no-repeat center center;
            background-size: cover;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .s11 {
            position: relative;
            height: 600px;
            overflow: hidden;
        }

        .s11 img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }

        .text-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2;
            text-align: center;
        }

        .slider-typography .slider-text-middle-main .slider-text-middle {
            max-width: 100%;
            margin: 0 auto;
        }

        .bg-search-theme {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 5px;
            padding: 10px;
        }

        .bg-search-theme-light {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 5px;
            padding: 5px;
            width: 100%;
        }

        .alt-font {
            font-family: 'YourChosenFont', sans-serif;
        }

        .text-white {
            color: #fff;
        }

        .text-very-light-gray {
            color: #d3d3d3;
        }

        .font-weight-700 {
            font-weight: 700;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .feature-box {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
        }

        .separator-line {
            height: 2px;
            background-color: #FF1493;
            /* deep pink */
            width: 100px;
            margin: 20px auto;
        }

        .feature-box-5 {
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #f0f4ed;
            border-radius: 5px;
        }

        .feature-box-5 i {
            font-size: 24px;
        }

        .btn-dark-gray {
            background-color: #333;
            color: #fff;
            border: none;
        }

        .hpfs07 {
            background-image: url('https://www.futurestarr.com/assets/images/parallax-bg2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .hpfs05 {
            background-image: url('https://www.futurestarr.com/assets/images/designer-working-online-K5B663T.jpg');
            ;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .feature-box {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            height: 100%;
            padding: 20px;
        }

        .feature-box img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }

        .feature-box-content {
            flex-grow: 1;
            text-align: center;
        }

        @media (max-width: 768px) {
            .py-5 {
                padding-top: 0 !important;
                padding-bottom: 0 !important;
                margin-bottom: 10px !important;
            }

            .py-5 h2 {
                white-space: nowrap;
                margin: 0px !important;
                font-size: 1.5rem;
                /* Adjust as needed to match h4 size */
                font-weight: 400;
            }

            .feature-box-content p {
                display: none;
                /* Hide the paragraph content on mobile */
            }

            .col-sm-6.col-lg-3 {
                flex: 0 0 50%;
                /* Make each feature box take up 50% width */
                max-width: 50%;
            }

            .mb-4 {
                margin-bottom: 10px !important;
                /* Remove margin-bottom */
            }
        }


        .equal-height {
            display: flex;
            flex-wrap: wrap;
        }

        .equal-height .col-lg-3 {
            display: flex;
        }



        .icon-large {
            font-size: 3rem;
            color: #333;
            display: inline-block;
            margin-right: 15px;
        }

        .feature-content {
            margin-left: 15px;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }



        .feature-box-5 {
            display: flex;
            align-items: center;
        }

        .image-wrapper {
            position: relative;
            overflow: hidden;
        }

        .image-wrapper::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 50%;
            width: 100%;
            background-color: black;
            z-index: 1;
            mix-blend-mode: screen;
        }

        .image-wrapper img {
            display: block;
            width: 100%;
            height: auto;
        }

        .top-bottom-bg {
            background:
                linear-gradient(to bottom, rgba(0, 0, 0, 0.9) 50%, white 50%),
                url("C:/Users/Rohit/Downloads/home-images/bg.png") top left/cover no-repeat;
            position: relative;
            padding: 50px 0;
        }

        .top-bottom-bg .container,
        .top-bottom-bg .separator-line,
        .top-bottom-bg .separator-line-horizontal-medium-light2,
        .top-bottom-bg .card,
        .top-bottom-bg .card-body,
        .top-bottom-bg .card-img-top,
        .top-bottom-bg .post-details,
        .top-bottom-bg .blog-content {
            position: relative;
            z-index: 1;
        }


        .top-bottom-bg .card-img-top {
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }

        .card.shadow-sm {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

        }



        .feature-content {
            margin-left: 20px;
        }




        .transparent-navbar {
          background-color: rgba(0, 0, 0, 0.5) !important;
            border-color: transparent !important;
            position: fixed;
            width: 100%;
            z-index: 999;
            transition: background-color 0.3s, border-color 0.3s;
        }


        .navbar-scroll {
            background-color: #151829 !important;
            border-color: #151829 !important;
        }

        .navbar-inverse .navbar-nav>li>a,
        .navbar-inverse .navbar-brand {
            color: white !important;
        }

        @media (max-width: 768px) {
            .navbar {
                background-color: #151829 !important;
                /* Set navbar background to black */
            }

            .navbar-nav .nav-link,
            .navbar-brand,
            .navbar-toggler {
                color: white !important;
                /* Set text color to white */
            }

            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E") !important;
            }
        }


        .header-icon {
            text-align: center;
        }

        .header-icon img {
            width: 30px;
            height: 30px;
        }

        .nav-link {
            color: #f7f7f7 !important;
        }

        .nav-link:hover {
            color: #ffffff !important;
        }

        footer {
            background-color: #151829;
        }

        .footer-s p,
        .footer-s a {
            color: rgb(157, 156, 156);
            font-size: 14px;
        }

        .footer-s {
            color: rgb(239, 233, 233);
            font-size: 16px;
        }

        .footer-s a:hover {
            color: #ccc;
        }



        .social-icon a {
            color: white;
            font-size: 18px;
            display: flex !important;
        }

        .social-icon a:hover {
            color: #ccc;
        }

        .footer-m p {
            color: #777;
            font-size: 15px;
        }

        .video-wrapper {
            margin-bottom: 15px;
        }


        .blog-post-images img {
            width: 100%;
            height: 300px;

        }

        .blog-post-images {
            height: 300px;
            overflow: hidden;
        }



        @media (max-width: 768px) {
            .row.overflow-auto {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
            }

            .col-md-4 {
                flex: 0 0 auto;
                width: 80%;
                margin-right: 1rem;
            }

            .card {
                height: auto;
            }

            .unique-image-class {
                width: 100%;
                height: auto;
            }

            .top-bottom-bg {
                background: url("C:/Users/Rohit/Downloads/home-images/bg.png") top left/cover no-repeat;
                position: relative;
                color: black;
                padding: 50px 0;
                overflow: hidden;
                /* Ensure the pseudo-element doesn't overflow */
            }

            .top-bottom-bg::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                /* Adjust the opacity and color */
                z-index: 1;
                /* Place it behind the content */
            }

            .top-bottom-bg .container {
                position: relative;
                z-index: 2;
                /* Ensure content is above the overlay */
            }

            .top-bottom-bg .container,
            .top-bottom-bg .separator-line,
            .top-bottom-bg .separator-line-horizontal-medium-light2,
            .top-bottom-bg .card,
            .top-bottom-bg .card-body,
            .top-bottom-bg .card-img-top,
            .top-bottom-bg .post-details,
            .top-bottom-bg .blog-content {
                position: relative;
                z-index: 1;
            }

            .hidemb video {
                display: none;
            }

            .hidemb1 {
                margin: 0px;
                background-color: white !important;
                color: black;
                padding-left: 0px !important;
                padding-right: 0px !important;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);

            }

            .hidemb1 h2 {
                color: black !important;
            }

            .hidemb3 {
                margin: 0px !important;
                background-color: black !important;
                color: white !important;
            }

            .hidemb3 .text-center a {
                background-color: red !important;
                color: rgb(243, 241, 241) !important;
                margin-bottom: 20px !important;
            }

            .icon-large {
                font-size: 3rem;
                color: darkgray;
                display: inline-block;
                margin-right: 15px;
            }
        }

        @media (max-width: 768px) {

            .hidemb6 {
                height: 50rem !important;
                margin: 0px !important;
            }

            .hidemb6 .hh1 {
                display: none;
            }

            .hidemb6 .hh2 {
                margin: 0px !important;
            }

            .hidemb4 {
                margin: 0px !important;
            }

            .hidemb4 p {
                white-space: nowrap;
                margin: 0px !important;
            }

            .hidemb4 h2 {
                white-space: nowrap;
                margin: 0px !important;
                font-size: 1.2rem;
                /* Adjust as needed to match h4 size */
                font-weight: 300;
                /* Adjust weight as needed, h4 is usually lighter */
            }


            .hidemb5 {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .hidemb5>.col-sm-6,
            .hidemb5>.col-md-4,
            .hidemb5>.col-xl-3 {
                flex: 0 0 auto;
                /* Optional: add some spacing between items */
            }
        }



        @media (max-width: 768px) {
            .footer .row {
                display: flex;
                flex-wrap: wrap;
            }

            .footer .col-md-3 {
                flex: 0 0 50%;
                /* Each column will take up 50% width */
                max-width: 50%;
                /* Ensure no column exceeds 50% width */
            }

            .footer-box {
                text-align: center;
                /* Center align social icons for better mobile view */
            }

            .social-icon {
                justify-content: center;
                /* Center the social icons */
            }

            .social-icon li {
                display: flex !important;
                /* Display social icons in a row */
                margin: 0 10px;
                /* Add horizontal spacing between icons */
            }

            .footer .footer-s {
                text-align: center;
                /* Center align text for mobile */
            }
        }

        @media (max-width: 768px) {
            .blog-post-style3 .row {
                display: flex;
                flex-wrap: nowrap;
                overflow-x: auto;
                padding: 0 15px;
            }

            .blog-post-style3 .grid-item {
                flex: 0 0 auto;
                width: 100%;
                max-width: 500px;
                margin-right: 15px;
                /* Space between items */
            }

            .blog-post {
                width: 100%;
                max-width: 500px;
                height: auto;
                margin-bottom: 20px;
            }

            .blog-content {
                max-height: 100px;
                overflow: hidden;
                position: relative;
            }

            .blog-content::after {
                content: '...';
                position: absolute;
                bottom: 0;
                right: 0;
                background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 100%);
                padding: 5px;
                font-size: 0.8rem;
            }



            .post-title .hh3 {
                font-size: 1rem;
                white-space: nowrap;
                overflow: hidden !important;
            }

            .blog-post-style3 {
                margin: 0px !important;
            }

            .blog-post-style3 .author {
                display: none;
            }

            .blog-post-style3 h2 {
                margin: 0px !important;
            }
        }
    </style>
    
</head>

<body>
    <div class="home">
        <nav class="navbar navbar-expand-lg navbar-light bg-light transparent-navbar navbar-inverse">
            <a class="navbar-brand" href="#">
                <img loading="lazy" decoding="async" class="img-responsive sm-logo" alt="futurestarr logo"
                    src="https://www.futurestarr.com/assets/images/futurelogo.png">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto" style="font-size: 14px;">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="https://www.futurestarr.com/homenew" title="Entertainment Career, community">
                            <div class="header-icon">
                                <img loading="lazy" decoding="async" class="fa-icon-font" alt="Futurestarr Home"
                                    src="https://www.futurestarr.com/assets/images/home/home.png">
                            </div>
                            <b>HOME</b>
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="https://www.futurestarr.com/star-search"
                            title="Future Starr, Tattoo Artists">
                            <div class="header-icon">
                                <img loading="lazy" decoding="async" class="fa-icon-font"
                                    src="https://www.futurestarr.com/assets/images/home/starr_s.png"
                                    alt="Star Search Icon">
                            </div>
                            <b>STARR SEARCH</b>
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="https://www.futurestarr.com/talent-mall"
                            title="Sign up, Future Starr, model photos, music songs, educational courses, fitness tips">
                            <div class="header-icon">
                                <img loading="lazy" decoding="async" class="fa-icon-font"
                                    src="https://www.futurestarr.com/assets/images/home/tallent_m.png"
                                    alt="Talent Mall Icon">
                            </div>
                            <b>TALENT MALL</b>
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="https://www.futurestarr.com/social-buzz">
                            <div class="header-icon">
                                <img loading="lazy" decoding="async" class="fa-icon-font"
                                    src="https://www.futurestarr.com/assets/images/home/social_b.png"
                                    alt="Social Buzz Icon">
                            </div>
                            <b>SOCIAL BUZZ</b>
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="https://www.futurestarr.com/blog">
                            <div class="header-icon">
                                <img loading="lazy" decoding="async" class="fa-icon-font"
                                    src="https://www.futurestarr.com/assets/images/home/blog.png" alt="Blog Icon">
                            </div>
                            <b>BLOG</b>
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="https://www.futurestarr.com/contact-us">
                            <div class="header-icon">
                                <img loading="lazy" decoding="async" class="fa-icon-font"
                                    src="https://www.futurestarr.com/assets/images/home/contact.png"
                                    alt="Contact Us Icon">
                            </div>
                            <b>CONTACT US</b>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

    


        <section class=" p-0 parallax mobile-height wow fadeIn hpfs01" data-stellar-background-ratio="0.5">
            <div id="videoMessage" class="container position-relative">
                <div class="slider-typography text-center">
                    <div class="slider-text-middle-main">
                        <div class="slider-text-middle">
                            <div class="container card-container">
                                <div class="card custom-card">
                                    <div class="card-body">
                                       <img src="{{ asset('assets/images/new-home/futurestarr_text.svg') }}" alt="FutureStarr" class="card-title" style="height: auto; max-width: 100%;">
<h4 class="card-text" style="color: white; font-size: 20px!important; line-height: 23px!important;">
    The ultimate Talent Marketplace for Atlanta hip-hop Artists
</h4>

                                        <div class="search-container">
                                            <input class="mb-0 bg-search-theme-light text-dark" name="name" id="search"
                                                placeholder="Search Talent" type="text" autocomplete="off">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </div>
                                        <ul class="search-results list-unstyled"></ul>
                                        <a href="" data-toggle="modal" data-target="#login" class="btn-link">sign-in</a>
                                        <a href="" class="btn-link">sign-up</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5" style="background-color: #fffcf3; margin-bottom: 100px;">
            <div class="container">
                <div class="text-center mb-5">
                    <p class="text-muted text-uppercase small">Features</p>
                    <h2 class="text-uppercase font-weight-bold">Why Choose Future Starr</h2>
                    <div class="separator-line"></div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-3 mb-4">
                        <div class="p-4 bg-white text-center feature-box">
                            <div class="video-wrapper mb-3">
                                <video muted loop autoplay class="feature-video" style="width: 100%;">
                                    <source src="https://www.futurestarr.com/assets/home_gifs/post296_1.mp4"
                                        type="video/mp4">
                                    <source src="https://www.futurestarr.com/assets/home_gifs/post296_1.mp4"
                                        type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="feature-box-content">
                                <span class="font-weight-bold d-block mb-2">Take Control</span>
                                <p class="mb-0">Turn your Entertainment Career Into a profitable business. Whether
                                    you're a novice at your talent or an established star, our power-packed platform
                                    will help you to grow.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-4">
                        <div class="p-4 bg-white text-center feature-box">
                            <div class="video-wrapper mb-3">
                                <video muted loop autoplay class="feature-video" style="width: 100%;">
                                    <source src="https://www.futurestarr.com/assets/home_gifs/post289_1.mp4"
                                        type="video/mp4">
                                    <source src="https://www.futurestarr.com/assets/home_gifs/post289_1.mp4"
                                        type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="feature-box-content">
                                <span class="font-weight-bold d-block mb-2">Explore Talent</span>
                                <p class="mb-0">Explore and Support undiscovered and unsigned talents and help them to
                                    realize their dreams and be the stars of tomorrow.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-4">
                        <div class="p-4 bg-white text-center feature-box">
                            <div class="video-wrapper mb-3">
                                <video muted loop autoplay class="feature-video" style="width: 100%;">
                                    <source src="https://www.futurestarr.com/assets/home_gifs/post318_1.mp4"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="feature-box-content">
                                <span class="font-weight-bold d-block mb-2">Earn your way to Stardom</span>
                                <p class="mb-0">By Signing up with Future Starr, all talent can redefine their Stardom.
                                    Build up your fan community, celebrate and engage with them.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-4">
                        <div class="p-4 bg-white text-center feature-box">
                            <div class="video-wrapper mb-3">
                                <video muted loop autoplay class="feature-video" style="width: 100%;">
                                    <source src="https://www.futurestarr.com/assets/home_gifs/post338_1.mp4"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="feature-box-content">
                                <span class="font-weight-bold d-block mb-2">Get Rewarded</span>
                                <p class="mb-0">Build up your market, manage your clients or audiences and show the
                                    world what makes you unique. Our Support Your Branding.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="hover-option3 blog-post-style3 top-bottom-bg">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="text-uppercase alt-font text-extra-dark-gray margin-10px-top margin-20px-bottom font-weight-700 sm-width-100 xs-width-100"
                        style="color: white;">Featured Artists</h2>
                    <div class="separator-line"></div>
                    <span
                        class="separator-line-horizontal-medium-light2 bg-deep-pink display-table margin-auto width-100px"></span>
                </div>
                <div class="row overflow-auto d-flex flex-nowrap flex-md-wrap">
                    <!-- Artist Card -->
                    <div class="col-md-4 mb-4 flex-shrink-0">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-0">
                                <div class="blog-post-images overflow-hidden position-relative image-wrapper">
                                    <img src="https://www.futurestarr.com/assets/images/new-home/new3.jpg" alt="abc"
                                        class="unique-image-class">
                                </div>
                                <div class="post-details p-4">
                                    <p
                                        class="ovpasstitle alt-font post-title text-medium text-extra-dark-gray width-100 display-block md-width-100 mb-3 text-center">
                                        <b>JAZZY B</b>
                                    </p>
                                    <div class="blog-content mt-3">
                                        <p class="width-90 xs-width-100 color-black mx-auto">An upcoming Atlanta-based
                                            hip-hop artist who has used FutureStarr to grow her audience and sell her
                                            latest album. Jazzy B is known for her vibrant energy and unique style,
                                            captivating a growing fan base with her powerful performances.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- DJ Card -->
                    <div class="col-md-4 mb-4 flex-shrink-0">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-0">
                                <div class="blog-post-images overflow-hidden position-relative image-wrapper">
                                    <img src="https://www.futurestarr.com/assets/images/new-home/new2.jpg" alt="abc"
                                        class="unique-image-class">
                                </div>
                                <div class="post-details p-4 text-center">
                                    <b
                                        class="ovpasstitle alt-font post-title text-medium text-extra-dark-gray width-100 display-block md-width-100 mb-3">
                                        DJ BEATMASTER</b>
                                    <div class="blog-content mt-3">
                                        <p class="width-90 xs-width-100 color-black mx-auto">A well-known DJ in Atlanta
                                            who leverages FutureStarr to share exclusive mixes and connect with fans. DJ
                                            BeatMaster is celebrated for his charismatic stage presence and innovative
                                            mixes, drawing large crowds and energizing any event.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Duo Card -->
                    <div class="col-md-4 mb-4 flex-shrink-0">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body p-0">
                                <div class="blog-post-images overflow-hidden position-relative image-wrapper">
                                    <img src="https://www.futurestarr.com/assets/images/new-home/new1.jpg" alt="abc"
                                        class="unique-image-class">
                                </div>
                                <div class="post-details p-4 text-center">
                                    <b
                                        class="ovpasstitle alt-font post-title text-medium text-extra-dark-gray width-100 display-block md-width-100 mb-3">
                                        RHYTHM AND FLOW</b>
                                    <div class="blog-content mt-3">
                                        <p class="width-90 xs-width-100 color-black mx-auto">A hip-hop duo that has seen
                                            significant revenue growth and fan engagement through their profile on
                                            FutureStarr. Rhythm and Flow combine dynamic lyrics with engaging
                                            performances, quickly becoming a favorite in the Atlanta hip-hop scene.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="no-padding fadeIn bg-extra-dark-gray hpfs02" id="services">
            <div class="container-fluid no-padding">
                <div class="row no-margin no-gutters d-flex">
                    <!-- Left Image Column -->
                    <div class="col-md-6 position-relative wow slideInLeft hpfs03 image-blur p-0 hidemb"
                        data--duration="900ms" style="display: flex; align-items: center; justify-content: center;">
                        <video style="border: none !important; width: 100%; height: auto;" muted loop autoplay>
                            <source src="https://www.futurestarr.com/assets/images/post342.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <!-- Right Text Column -->
                    <div class="col-md-6 d-flex wow slideInRight hpfs04 p-0 hidemb1" data--duration="900ms"
                        style="background-color: black; color: #656262; display: flex; flex-direction: column; justify-content: flex-start;">
                        <div class="text-center text-md-left py-sm-5 px-md-4 p-lg-5"
                            style="max-width: 90%; margin-top: 0;">
                            <div class="mb-3 mb-sm-5">
                                <p class="alt-font text-medium-gray margin-5px-bottom text-uppercase text-small">
                                    DISCOVER</p>
                                <h2 class="text-uppercase alt-font margin-20px-bottom font-weight-700 sm-width-100 xs-width-100"
                                    style="color:rgb(245, 245, 245);">Future Starr</h2>
                                <span
                                    class="d-block separator-line bg-deep-pink mx-auto width-100px mr-md-auto ml-md-0"></span>
                            </div>
                            <p>Future Starr is a unique talent platform, which ensures direct engagement between talent
                                and targeted audiences. Here at Future Starr, we provide promising talent from around
                                the world with the opportunity to showcase their talent to a global audience, sponsors,
                                and mentors. You should upload your original videos, PDFs, or MP3s, and we will support
                                you in becoming global stars.</p>
                            <p>We serve as a link between authentic talent and potential fan communities. With Future
                                Starr, you can immediately share and engage your audiences who will support you to
                                become a promising star.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section style="margin-top: 100px; margin-bottom: 100px; background-color: white;" class="hidemb3">
            <div class="container">
                <div class="row">
                    <!-- Left Image Column (visible on large screens only) -->
                    <div class="d-none d-lg-block col-lg-5 text-center wow fadeIn hpfs02">
                        <div class="display-table-cell vertical-align-middle">
                            <img alt="LET'S GET STARTED!" title="LET'S GET STARTED!" class="img-fluid"
                                src="https://www.futurestarr.com/assets/images/image-3.png">
                        </div>
                    </div>
                    <!-- Right Content Column -->
                    <div class="col-12 col-lg-7 wow fadeIn hpfs06" data--delay="0.4s">
                        <div class="mb-3 mt-5 mt-md-0 mb-sm-5 text-center">
                            <h2
                                class="text-uppercase alt-font text-extra-dark-gray margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">
                                LET'S GET STARTED <span class="separator-line"></span></h2>
                        </div>
                        <div class="row">
                            <!-- Feature 1 -->
                            <div class="col-12 mb-4 wow fadeInUp last-paragraph-no-margin hpfs02">
                                <div class="position-relative d-flex align-items-center">
                                    <i class="fa-solid fa-globe icon-large mr-4"></i>
                                    <div class="feature-content ml-3">
                                        <div class="mb-2 alt-font font-weight-600"><b>How to use FutureStarr.com</b>
                                        </div>
                                        <p class="color-black">First, create an account. Once that's set up, use your
                                            talent dashboard to discover and view other talent, upload your own, and
                                            create an artist page...!</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Feature 2 -->
                            <div class="col-12 mb-4 wow fadeInUp last-paragraph-no-margin hpfs06" data--delay="0.2s">
                                <div class="position-relative d-flex align-items-center">
                                    <i class="fa-solid fa-video icon-large mr-4"></i>
                                    <div class="feature-content ml-3">
                                        <div class="mb-2 alt-font font-weight-600"><b>Visit upcoming talent on
                                                FutureStarr.com</b></div>
                                        <p class="color-black">Discovering new talent on FutureStarr is free. Browse
                                            through songs, books, or videos uploaded by unsigned talents specializing in
                                            various genres.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Feature 3 -->
                            <div class="col-12 mb-4 wow fadeInUp last-paragraph-no-margin hpfs06" data--delay="0.4s">
                                <div class="position-relative d-flex align-items-center">
                                    <i class="fa-solid fa-screwdriver-wrench icon-large mr-4"></i>
                                    <div class="feature-content ml-3">
                                        <div class="mb-2 alt-font font-weight-600"><b>Create an artist page on
                                                FutureStarr.com</b></div>
                                        <p class="color-black">When you create an Artist Page on FutureStarr.com, you
                                            get an entire page that showcases your images, videos, eBooks, up to five
                                            mp3 songs, and overall passion.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <a class="btn btn-small btn-dark-gray" href="create-page.html">Click here to create page</a>
                        </div>
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
                    <div class="col-md-6 col-lg-4 col-xl-3 bg-white text-center text-md-left px-md-4 px-lg-5">
                        <div class="py-4">
                            <h2 class="alt-font font-weight-700 text-extra-dark-gray text-uppercase">About Future Starr
                            </h2><span
                                class="d-block separator-line-horrizontal-medium-light2 bg-deep-pink mx-auto width-100px mb-3 mb-md-4 mr-md-auto ml-md-0"></span>
                            <p class="color-black">Future Starr is a stand-apart and unconventional consumer internet
                                company that helps the creative talents build their own online portfolios to reach
                                passionate audiences and the community. With Future Starr, you get instant access to
                                your targeted audience. We provide you with next level services that let you connect
                                with your clients conveniently. We help you to take your talent to the next level and
                                become a Star.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-6 cover-background p-0 hpfs07">
                        <!-- <img src="C:/Users/Rohit/Pictures/front-left-side-47.webp" alt="Take Control"> -->
                        <div class="sm-height-auto xs-height-350px"></div>
                    </div>
                </div>
            </div>
        </section>



        <section style="background-color: #1c1c1c; height: 100rem;" class="hidemb6">
            <div class="container">
                <div class="row text-center hidemb4">
                    <div class="col-md-12 n-dark-sec hh2" style="margin-top: 100px;">
                        <p class="alt-font margin-5px-bottom text-uppercase text-small text-light-gray"
                            style="color: #ae9e9eae;">EXPLORE</p>
                        <h2
                            class="text-uppercase alt-font text-white margin-10px-top margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">
                            Future Starr Marketplace
                        </h2>
                        <div class="separator-line"></div>
                        <span
                            class="separator-line-horrizontal-medium-light2 bg-deep-pink d-block mx-auto width-100px mb-sm-5"></span>
                        <p class="mt-3 mb-sm-5 hh1" style="color: #ae9e9eae;">
                            Explore, acquire, and engage your clients or mentor’s dreams and targeted audiences with our
                            customized and sterling online campaigns. Our unique business model will help your career to
                            grow and prosper. Give yourself a much-awaited exposure into the entertainment industry with
                            Future Starr and Experience the Stardom.
                        </p>
                    </div>
                </div>
                <div class="row  hidemb5">
                    <!-- Loop starts here for 8 items -->
                    <!-- Item 1 -->
                    <div class="col-sm-6 col-md-4 col-xl-3 mb-4 wow fadeInUp last-paragraph-no-margin">
                        <div class="h-100 blog-post blog-post-style1 xs-text-center bg-white d-flex flex-column">
                            <div class="blog-post-images overflow-hidden flex-grow-1">
                                <video muted loop autoplay class="w-100 h-100">
                                    <source
                                        src="https://www.futurestarr.com/assets/talent-mall-category-gifs/talentmallpage-categ-Food.mp4"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="post-details p-3 d-flex flex-column">
                                <p class="text-medium mb-0 text-black ovpasstitle">Food</p>
                                <div class="separator-line-horrizontal-full bg-medium-light-gray my-2"></div>
                                <p class="width-90 xs-width-100 color-black">Turn your Cooking Talent into a digital
                                    business Future Starr talent marketplace is reaching out to chefs, cooks, or anyone
                                    passionate about cooking and wants to discover new ways to make a living f...</p>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat similar blocks for Items 2 to 8 -->
                    <!-- Item 2 -->
                    <div class="col-sm-6 col-md-4 col-xl-3 mb-4 wow fadeInUp last-paragraph-no-margin">
                        <div class="h-100 blog-post blog-post-style1 xs-text-center bg-white d-flex flex-column">
                            <div class="blog-post-images overflow-hidden flex-grow-1">
                                <video muted loop autoplay class="w-100 h-100">
                                    <source
                                        src="https://www.futurestarr.com/assets/talent-mall-category-gifs/talentmallpage-categ-Model.mp4"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="post-details p-3 d-flex flex-column">
                                <p class="text-medium mb-0 text-black ovpasstitle">Model</p>
                                <div class="separator-line-horrizontal-full bg-medium-light-gray my-2"></div>
                                <p class="width-90 xs-width-100 color-black">Sell Your Modeling Agencies in Atlanta
                                    Photos Attention all Models: market and sell your model photos here with Future
                                    Starr. The Modeling Agencies in Atlanta industry is a tough market where it’s a...
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat similar blocks for Items 3 through 8 -->
                    <!-- Item 3 -->
                    <div class="col-sm-6 col-md-4 col-xl-3 mb-4 wow fadeInUp last-paragraph-no-margin">
                        <div class="h-100 blog-post blog-post-style1 xs-text-center bg-white d-flex flex-column">
                            <div class="blog-post-images overflow-hidden flex-grow-1">
                                <video muted loop autoplay class="w-100 h-100">
                                    <source
                                        src="https://www.futurestarr.com/assets/talent-mall-category-gifs/talentmallpage-categ-Mathematics.mp4"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="post-details p-3 d-flex flex-column">
                                <p class="text-medium mb-0 text-black ovpasstitle">Mathematics</p>
                                <div class="separator-line-horrizontal-full bg-medium-light-gray my-2"></div>
                                <p class="width-90 xs-width-100 color-black">Become a Self-Employed Math Tutor Online
                                    Math Teachers are hardworking dedicated people who are passionate about educating
                                    young students in improving their math skills. Unfortunately, math teachers do...
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Item 4 -->
                    <div class="col-sm-6 col-md-4 col-xl-3 mb-4 wow fadeInUp last-paragraph-no-margin">
                        <div class="h-100 blog-post blog-post-style1 xs-text-center bg-white d-flex flex-column">
                            <div class="blog-post-images overflow-hidden flex-grow-1">
                                <video muted loop autoplay class="w-100 h-100">
                                    <source
                                        src="https://www.futurestarr.com/assets/talent-mall-category-gifs/talentmallpage-categ-Music.mp4"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="post-details p-3 d-flex flex-column">
                                <p class="text-medium mb-0 text-black ovpasstitle">Music</p>
                                <div class="separator-line-horrizontal-full bg-medium-light-gray my-2"></div>
                                <p class="width-90 xs-width-100 color-black">Express your Passion for Music Notes,
                                    Lyrics, and Songs Buy and Sell your music online with Future Starr! Every music
                                    composer dreams of getting connected with millions of fans and build up their
                                    legac...</p>
                            </div>
                        </div>
                    </div>
                    <!-- Item 5 -->
                    <div class="col-sm-6 col-md-4 col-xl-3 mb-4 wow fadeInUp last-paragraph-no-margin">
                        <div class="h-100 blog-post blog-post-style1 xs-text-center bg-white d-flex flex-column">
                            <div class="blog-post-images overflow-hidden flex-grow-1">
                                <video muted loop autoplay class="w-100 h-100">
                                    <source
                                        src="https://www.futurestarr.com/assets/talent-mall-category-gifs/talentmallpage-categ-National-Geographic.mp4"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="post-details p-3 d-flex flex-column">
                                <p class="text-medium mb-0 text-black ovpasstitle">Social Studies</p>
                                <div class="separator-line-horrizontal-full bg-medium-light-gray my-2"></div>
                                <p class="width-90 xs-width-100 color-black">Establish a new National Geographic Career
                                    Transition your National Geographic career toward a global market that exists online
                                    here with Future Starr. Whether you are a dedicated environmental activis...</p>
                            </div>
                        </div>
                    </div>
                    <!-- Item 6 -->
                    <div class="col-sm-6 col-md-4 col-xl-3 mb-4 wow fadeInUp last-paragraph-no-margin">
                        <div class="h-100 blog-post blog-post-style1 xs-text-center bg-white d-flex flex-column">
                            <div class="blog-post-images overflow-hidden flex-grow-1">
                                <video muted loop autoplay class="w-100 h-100">
                                    <source
                                        src="https://www.futurestarr.com/assets/talent-mall-category-gifs/talentmallpage-categ-Science.mp4"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="post-details p-3 d-flex flex-column">
                                <p class="text-medium mb-0 text-black ovpasstitle">Science</p>
                                <div class="separator-line-horrizontal-full bg-medium-light-gray my-2"></div>
                                <p class="width-90 xs-width-100 color-black">Take Control of Your Science Career
                                    Endeavors Advance in your Science Career by using Future Starr’s platform. Many
                                    science careers exist; however, supply and demand can be challenging. It can be
                                    diffi...</p>
                            </div>
                        </div>
                    </div>
                    <!-- Item 7 -->
                    <div class="col-sm-6 col-md-4 col-xl-3 mb-4 wow fadeInUp last-paragraph-no-margin flex-shrink-0">
                        <div class="h-100 blog-post blog-post-style1 xs-text-center bg-white d-flex flex-column">
                            <div class="blog-post-images overflow-hidden flex-grow-1">
                                <video muted loop autoplay class="w-100 h-100">
                                    <source
                                        src="https://www.futurestarr.com/assets/talent-mall-category-gifs/talentmallpage-categ-Cosmetics.mp4"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="post-details p-3 d-flex flex-column">
                                <p class="text-medium mb-0 text-black ovpasstitle">Cosmetics</p>
                                <div class="separator-line-horrizontal-full bg-medium-light-gray my-2"></div>
                                <p class="width-90 xs-width-100 color-black">Sell Your Camera Ready Cosmetics Online Get
                                    ready to sell your camera cosmetics online with Future Starr! If you are an upcoming
                                    makeup artist who dreamed of making the art of beauty your career and w.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Item 8 -->
                    <div class="col-sm-6 col-md-4 col-xl-3 mb-4 wow fadeInUp last-paragraph-no-margin flex-shrink-0">
                        <div class="h-100 blog-post blog-post-style1 xs-text-center bg-white d-flex flex-column">
                            <div class="blog-post-images overflow-hidden flex-grow-1">
                                <video muted loop autoplay class="w-100 h-100">
                                    <source
                                        src="https://www.futurestarr.com/assets/talent-mall-category-gifs/talentmallpage-categ-Photography.mp4"
                                        type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="post-details p-3 d-flex flex-column">
                                <p class="text-medium mb-0 text-black ovpasstitle">Photography</p>
                                <div class="separator-line-horrizontal-full bg-medium-light-gray my-2"></div>
                                <p class="width-90 xs-width-100 color-black">Embrace Different Types of Photography &
                                    Photoshoot Ideas Embrace different types of Photographers with Future Starr! Beauty
                                    lies in the eyes of the beholder of different types of photographers. Th...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="wow fadeIn hover-option4 blog-post-style3" style="margin-top: 100px; margin-bottom: 100px;">
            <div class="container">
                <div class="text-center mb-5">
                    <p class="alt-font margin-5px-bottom text-uppercase text-small text-medium-gray">NEWS</p>
                    <h2
                        class="text-uppercase alt-font text-extra-dark-gray margin-10px-top margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">
                        Latest Blogs
                    </h2>
                    <div class="separator-line"></div>
                    <span
                        class="separator-line-horrizontal-medium-light2 bg-deep-pink display-table margin-auto width-100px"></span>
                </div>
                <div class="row">

                    <div class="grid-item col-md-4 margin-30px-bottom xs-text-center wow fadeInUp">
                        <div class="blog-post bg-light-gray inner-match-height card-shadow">
                            <div class="blog-post-images overflow-hidden position-relative">
                                <img src="https://www.futurestarr.com/blog-media/c33d2f7e15fc4886fce4680d51508f31.jpg"
                                    alt="Blog Media" title="gfdgfdg" data-mm="gfhh" loading="lazy">
                            </div>
                            <div class="post-details padding-40px-all sm-padding-20px-all"
                                style="padding: 25px; background-color: rgb(245, 240, 240);">
                                <b
                                    class="ovpasstitle1 alt-font post-title text-medium text-extra-dark-gray width-100 display-block md-width-100 margin-15px-bottom">
                                    <p class="hh3"> Soulja Boy Squashes Drake Beef Celebrates with Tesla Cybertruck &
                                        SeaWorld Visit...</p>
                                </b>
                                <div class="blog-content" style="margin-top: 30px;">
                                    <p class="width-90 xs-width-100 color-black">Soulja Boy Squashes Drake Beef 2024:
                                        Celebrates with Tesla Cybertruck and SeaWorld Soulja Boy has j...</p>
                                </div>
                                <div class="separator-line-horrizontal-full bg-medium-gray margin-20px-tb"></div>
                                <div class="author mt-auto"><span class="width-90 xs-width-100 color-black">By Future
                                        Starr&nbsp;&nbsp;|&nbsp;&nbsp; Jul 29, 2024</span></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid-item col-md-4 margin-30px-bottom xs-text-center wow fadeInUp">
                        <div class="blog-post bg-light-gray inner-match-height card-shadow">
                            <div class="blog-post-images overflow-hidden position-relative">
                                <img src="https://www.futurestarr.com/blog-media/ca15121e95cf11e1ef8731283b4b4bd9.jpg"
                                    alt="Blog Media" title="gfdgfdg" data-mm="gfhh" loading="lazy">
                            </div>
                            <div class="post-details padding-40px-all sm-padding-20px-all"
                                style="padding: 25px; background-color: rgb(245, 240, 240);">
                                <b
                                    class="ovpasstitle alt-font post-title text-medium text-extra-dark-gray width-100 display-block md-width-100 margin-15px-bottom">
                                    <p class="hh3"> Soulja Boy Squashes Drake Beef Celebrates with Tesla Cybertruck &
                                        SeaWorld Visit...</p>
                                </b>
                                <div class="blog-content" style="margin-top: 30px;">
                                    <p class="width-90 xs-width-100 color-black">Soulja Boy Squashes Drake Beef 2024:
                                        Celebrates with Tesla Cybertruck and SeaWorld Soulja Boy has j...</p>
                                </div>
                                <div class="separator-line-horrizontal-full bg-medium-gray margin-20px-tb"></div>
                                <div class="author mt-auto"><span class="width-90 xs-width-100 color-black">By Future
                                        Starr&nbsp;&nbsp;|&nbsp;&nbsp; Jul 29, 2024</span></div>
                            </div>
                        </div>
                    </div>

                    <div class="grid-item col-md-4 margin-30px-bottom xs-text-center wow fadeInUp">
                        <div class="blog-post bg-light-gray inner-match-height card-shadow">
                            <div class="blog-post-images overflow-hidden position-relative">
                                <img src="https://www.futurestarr.com/blog-media/5c4342d518022833e5af8841823fd533.jpg"
                                    alt="Blog Media" title="gfdgfdg" data-mm="gfhh" loading="lazy">
                            </div>
                            <div class="post-details padding-40px-all sm-padding-20px-all"
                                style="padding: 25px; background-color: rgb(245, 240, 240);">
                                <b
                                    class="ovpasstitle1 alt-font post-title text-medium text-extra-dark-gray width-100 display-block md-width-100 margin-15px-bottom">
                                    <p class="hh3"> Soulja Boy Squashes Drake Beef Celebrates with Tesla Cybertruck &
                                        SeaWorld Visit...</p>
                                </b>
                                <div class="blog-content" style="margin-top: 30px;">
                                    <p class="width-90 xs-width-100 color-black">Soulja Boy Squashes Drake Beef 2024:
                                        Celebrates with Tesla Cybertruck and SeaWorld Soulja Boy has j...</p>
                                </div>
                                <div class="separator-line-horrizontal-full bg-medium-gray margin-20px-tb"></div>
                                <div class="author mt-auto"><span class="width-90 xs-width-100 color-black">By Future
                                        Starr&nbsp;&nbsp;|&nbsp;&nbsp; Jul 29, 2024</span></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!--footer-->
        <footer style="background-color: #151829; padding-top: 20px;">
            <div class="container footer-s mt-5">
                <div class="row footer">
                    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
                        <h4 class="footer-s"><b>Quick Links</b></h4>
                        <p><a href="/">Home</a></p>
                        <p><a href="#">About Us</a></p>
                        <p><a href="#">Starr Search</a></p>
                        <p><a href="#">Talent Mall</a></p>
                        <p><a href="#">Blog</a></p>
                        <p><a href="#">Contact Us</a></p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
                        <h4 class="footer-s"><b>Terms & Privacy</b></h4>
                        <p><a href="#">Privacy Policy</a></p>
                        <p><a href="#">Terms and Conditions</a></p>
                        <p><a href="#">Refund Policy</a></p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
                        <h4 class="footer-s"><b>Contact Us</b></h4>
                        <p>FUTURESTARR MEDIA LLC.,<br>285 West Wieuca Road NE,<br>PMB # 5191,<br>Atlanta, GA<br></p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-3 mb-md-0">
                        <h4 class="footer-s">Connect with Us</h4>
                        <div class="footer-box">
                            <ul class="social-icon list-unstyled d-flex flex-column align-items-start">
                                <li class="mb-2">
                                    <a data-toggle="tooltip" title="Facebook" target="_blank"><i
                                            class="fa fa-facebook"></i></a>
                                </li>
                                <li class="mb-2">
                                    <a data-toggle="tooltip" title="Twitter" target="_blank"><i
                                            class="fa fa-twitter"></i></a>
                                </li>
                                <li class="mb-2">
                                    <a data-toggle="tooltip" title="LinkedIn" target="_blank"><i
                                            class="fa fa-linkedin"></i></a>
                                </li>
                                <li class="mb-2">
                                    <a data-toggle="tooltip" title="News Feeds" target="_blank"><i
                                            class="fa fa-rss"></i></a>
                                </li>
                                <li class="mt-3">
                                    <a target="_blank">
                                        <img loading="lazy" decoding="async" alt="FutureStarr App"
                                            title="FutureStarr App" style="width: 70%;"
                                            src="https://www.futurestarr.com/assets/footer/google-play.png">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 footer-m text-center">
                        <p>© 2024, Future Starr Media LLC, All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </footer>




    </div>


    <script>
        window.addEventListener('scroll', function () {
            var navbar = document.querySelector('.transparent-navbar');
            if (window.scrollY > 50) { // Change 50 to the scroll position you want the background to appear
                navbar.classList.add('navbar-scroll');
            } else {
                navbar.classList.remove('navbar-scroll');
            }
        });
    </script>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

        
</body>

</html>