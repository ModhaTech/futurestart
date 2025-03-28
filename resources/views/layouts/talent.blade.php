@php $segment = Request::segment(1);
	$segment2 = Request::segment(2);

	if($segment == 'talent-mall' && $segment2 != '')
	{
		$secondclass = ' product_data_page';
	}
	else if($segment == 'blog' && $segment2 != '')
	{
		$secondclass = ' blog-detail-page';
	}
	else if($segment == 'star-search' && $segment2 != '')
	{
		$secondclass = ' star-search-detail-page';
	}
	else
	{
		$secondclass = '';
	}

if(!empty($segment)) { $bodyClass = Request::segment(1); } else { $bodyClass ='home'; }
@endphp
<!DOCTYPE html>
<html itemscope lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{url('/')}}" />
    <meta name="robots" content="index, follow">

	@if(Request::is('social-buzz/*') || Request::is('talent-mall/*') || Request::is('contact-us'))
	@endif
	@if(Request::is('social-buzz/*'))
		@php
			$social_title = [
			1 => 'How to Promote book | Future Starr- Social Buzz',
			2 => 'Future Starr - Social Buzz | Entertainment Promotion',
			4 => 'Global Music Promotion | Future Starr',
			5 => 'Global Photography Promotion | Future Starr',
			6 => 'Comedy for sale - Online | Future Starr',
			7 => 'Premier Models- Available | Future Starr',
			8 => 'Fitness Your Way | Future Starr - Social Buzz',
			9 => 'National Geographic Hot Zone - Promotion | Future Starr',
			10 => 'Science Revolution- Social Update | Future Starr',
			11 => 'Future Starr- Social Buzz | Food open',
			12 => 'Promote and Sell - Nutrition | Future Starr',
			13 => 'Future Starr | Self-employed - Mathematics jobs',
			14 => 'Future Starr- Global cosmetics brands | Social Buzz',
			15 => 'American Fashion Designer - Social News | Future Starr',
			16 => 'Promote Your Tattoos ideas - Future Starr | Social Buzz'
		]
    @endphp
    <title>{{$social_title[$categorySelect]}}</title>
	@elseif(isset($metaTags['title'])) 
	<title>{{ isset($metaTags['title']) ? $metaTags['title'].' | Future Starr' : '' }}</title>
	@elseif(isset($custom))
	@foreach($custom as $title)
	<title> {{$title}} </title>
    @endforeach
    @else
    <title> @yield('title') </title>
	@endif
        	  <script type="application/ld+json">
            <?php
                $currentUrl = url()->current();
                $schemaData = [];
        
                if (strpos($currentUrl, '/social-buzz') !== false) {
                    $schemaData = [
                        "@context" => "https://schema.org",
                        "@type" => "SocialMediaPosting",
                        "mainEntityOfPage" => [
                            "@type" => "WebPage",
                            "@id" => "https://www.futurestarr.com/social-buzz"
                        ],
                        "headline" => "FutureStarr Social Buzz",
                        "image" => [
                            "https://www.futurestarr.com/assets/images/futurestarrlogo.jpg"
                        ],
                        "description" => "Stay updated with the latest social buzz from FutureStarr.",
                        "articleBody" => "This page provides updates and news about the social buzz surrounding FutureStarr."
                    ];

                }else if (strpos($currentUrl, '/blog/news') !== false) {
                    $schemaData = [
                        "@context" => "https://schema.org",
                        "@type" => "BlogPosting",
                        "headline" => "FutureStarr News Blog",
                        "url" => $currentUrl,
                    ];
                }else if (strpos($currentUrl, '/register') !== false) {
                    $schemaData = [
                        "@context" => "https://schema.org",
                        "@type" => "WebPage",
                        "name" => "Register - FutureStarr",
                        "url" => "https://www.futurestarr.com/register",
                        "description" => "Register with FutureStarr to join our talent community and unlock exciting opportunities.",
                        "publisher" => [
                            "@type" => "Organization",
                            "name" => "FutureStarr",
                            "logo" => [
                                "@type" => "ImageObject",
                                "url" => "https://www.futurestarr.com/assets/images/futurestarrlogo.jpg"
                            ]
                        ]
                    ];

                }else if (strpos($currentUrl, '/contact-us') !== false) {
                    $schemaData = [
                        "@context" => "https://schema.org",
                        "@type" => "ContactPage",
                        "name" => "Contact Us - FutureStarr",
                        "url" => "https://www.futurestarr.com/contact-us",
                        "description" => "Get in touch with FutureStarr for inquiries, feedback, or support.",
                        "contactPoint" => [
                            "@type" => "ContactPoint",
                            "telephone" => "+1-888-704-0504",
                            "contactType" => "customer support",
                            "areaServed" => ["US", "CA"],
                            "availableLanguage" => ["English", "Spanish"]
                        ],
                        "potentialAction" => [
                            "@type" => "CommunicateAction",
                            "target" => [
                                "@type" => "EntryPoint",
                                "urlTemplate" => "https://www.futurestarr.com/contact-us",
                                "inLanguage" => "en-US"
                            ]
                        ]
                    ];

                } else if (strpos($currentUrl, '/talent-mall/searchauthor') !== false) {
                    $schemaData = [
                        "@context" => "https://schema.org",
                        "@type" => "Item",
                        "description" => "Explore a wide range of talented individuals and services in the FutureStarr Talent Mall.",
                        "name" => "FutureStarr Talent Mall",
                        "url" => $currentUrl,
                        "image" => "https://www.futurestarr.com/assets/images/futurestarrlogo.jpg"
                    ];

                }else if (strpos($currentUrl, '/talent-mall/searchentertainment') !== false) {
                    $schemaData = [
                        "@context" => "https://schema.org",
                        "@type" => "Item",
                        "description" => "Explore a wide range of talented individuals and services in the FutureStarr Talent Mall.",
                        "name" => "FutureStarr Talent Mall",
                        "url" => $currentUrl,
                        "image" => "https://www.futurestarr.com/assets/images/futurestarrlogo.jpg"
                    ];

                }else if (strpos($currentUrl, '/talent-mall/searchmusic') !== false) {
                    $schemaData = [
                        "@context" => "https://schema.org",
                        "@type" => "Item",
                        "description" => "Explore a wide range of talented individuals and services in the FutureStarr Talent Mall.",
                        "name" => "FutureStarr Talent Mall",
                        "url" => $currentUrl,
                        "image" => "https://www.futurestarr.com/assets/images/futurestarrlogo.jpg"
                    ];

                }else if (strpos($currentUrl, '/talent-mall') !== false) {
                    $schemaData = [
                        "@context" => "https://schema.org",
                        "@type" => "Items",
                        "description" => "Explore a wide range of talented individuals and services in the FutureStarr Talent Mall.",
                        "name" => "FutureStarr Talent Mall",
                        "url" => $currentUrl,
                        "image" => "https://www.futurestarr.com/assets/images/futurestarrlogo.jpg"
                    ];

                } else if (strpos($currentUrl, '/star-search') !== false) {
                    $schemaData = [
                        "@context" => "https://schema.org",
                        "@type" => "WebSite",
                        "name" => "FutureStarr - Star Search",
                        "url" => $currentUrl,
                        "potentialAction" => [
                            "@type" => "SearchAction",
                            "target" => [
                                "@type" => "EntryPoint",
                                "urlTemplate" => "https://www.futurestarr.com/search?q={search_term_string}",
                                "encodingType" => "application/x-www-form-urlencoded"
                            ],
                            "query-input" => "required name=search_term_string"
                        ]
                    ];
                } else if (strpos($currentUrl, '/video/live-page') !== false) {
                    $schemaData = [
                        "@context" => "https://schema.org",
                        "@type" => "VideoObject",
                        "name" => "Live Video - FutureStarr",
                        "description" => "Watch live videos and streams on FutureStarr's platform.",
                        "contentUrl" => "https://www.futurestarr.com/video/live-page",
                        "embedUrl" => "https://www.futurestarr.com/embed/live-video",
                        "interactionCount" => "2345",
                        "publisher" => [
                            "@type" => "Organization",
                            "name" => "FutureStarr",
                            "logo" => [
                                "@type" => "ImageObject",
                                "url" => "https://www.futurestarr.com/assets/images/futurestarrlogo.jpg"
                            ]
                        ]
                    ];
                }else if (strpos($currentUrl, '/blog') !== false)  {
                    $schemaData = [
                        "@context" => "https://schema.org",
                        "@type" => "Blog",
                        "name" => "FutureStarr Blog",
                        "url" => $currentUrl,
                    ];
                }else if (strpos($currentUrl, '/') !== false)  {
                    $schemaData = [
                        "@context" => "https://schema.org",
                        "@type" => "Organization",
                        "name" => "FutureStarr",
                        "url" => "https://www.futurestarr.com",
                        "logo" => "https://www.futurestarr.com/assets/images/futurestarrlogo.jpg",
                        "contactPoint" => [
                            "@type" => "ContactPoint",
                            "telephone" => "+1-888-704-0504",
                            "contactType" => "customer service"
                        ],
                        "sameAs" => [
                            "https://www.facebook.com/futurestarr",
                            "https://twitter.com/futurestarr",
                            "https://www.instagram.com/futurestarr"
                        ],
                        "potentialAction" => [
                            "@type" => "SearchAction",
                            "target" => "https://www.futurestarr.com/search?q={search_term_string}",
                            "query-input" => "required name=search_term_string"
                        ]
                    ];
                }
        
                echo json_encode($schemaData, JSON_PRETTY_PRINT);
            ?>
        </script>

	@php $registerRoute = Route::currentRouteName() @endphp
	@if($registerRoute =='register')
	<meta name="title" content="Sign Up & Earn Income | Sell Your Talent Online">
	<meta name="description" content="Join Future Starr today! Sell your talent and earn high commission payments directly into your Stripe account. Work from home and start earning now!">
	<meta name="keywords" content="sign up, earn money online, sell your talent, work from home, passive income, high commission pay, make money from hobbies, online marketplace">
	<meta charset="utf-8" name="google-site-verification" content="oyw7CbWFqAYVXogBH2hIOFvTZD58CIU3xqatT70VVe0">
	<meta name="seobility" content="525cf60fddc61098d6209176d70a48ce">
	@elseif($registerRoute =='about-us')
	<meta name="title" content="Our Journey to Success | About Future Starr">
	<meta name="description" content="Success takes passion, persistence, and sacrifice. Learn how Future Starr helps talents grow and achieve their dreams.">
	<meta name="keywords" content="success journey, about Future Starr, passion and persistence, achieve dreams, key success factors, business success, growth strategy">
	@elseif($registerRoute =='term-conditions')
	<meta name="title" content="Terms & Conditions | Future Starr Policies">
	<meta name="description" content="Read our Terms and Conditions to understand how we collect, manage, and protect user data at Future Starr.">
	<meta name="keywords" content="terms and conditions, user agreement, website policies, Future Starr terms, legal agreements, data privacy">
	@elseif($registerRoute =='refund-policy')
	<meta name="title" content="Refund Policy | Customer Satisfaction at Future Starr">
	<meta name="description" content="Your satisfaction matters! Learn about Future Starr's refund policy and how we ensure quality service and happy customers.">
	<meta name="keywords" content="refund policy, customer satisfaction, return policy, Future Starr refunds, money-back guarantee, service quality">
	@elseif($registerRoute =='privacy-policy')
	<meta name="title" content="Privacy Policy | How Future Starr Protects Your Data">
	<meta name="description" content="Understand how Future Starr collects, uses, and protects your personal information in our Privacy Policy. Read more here.">
	<meta name="keywords" content="privacy policy, data protection, Future Starr privacy, personal data security, online privacy policy, information security">
	@elseif($registerRoute == 'talent.index')
	<meta name="title" content="Discover & Shop Talent | Future Starr Talent Mall">
	<meta name="description" content="Explore undiscovered talent at Future Starr’s online Talent Mall! Buy and sell creative skills, music, art, and more worldwide.">
	<meta name="keywords" content="talent marketplace, buy and sell talent, undiscovered artists, creative skills, online shopping for talent, independent artists, underground talent">
	@elseif(Request::is('social-buzz/*'))
	@php
	$social_desc = [
    1 => "Book Authors: Maximize your reach and attract ready-to-buy readers on Future Starr's Social Buzz page.",
    2 => "Looking for fresh entertainment? Connect with passionate entertainers on Future Starr’s unique Social Buzz platform.",
    4 => "Global Music Promotion: Underground artists, showcase your music to an engaged community of music lovers on Future Starr.",
    5 => "Calling all photographers! Sell your professional photography to a global audience through Future Starr's Social Buzz.",
    6 => "Comedy for Sale: Discover and promote the best undiscovered comedy videos. Start selling your talent on Future Starr today!",
    7 => "Casting Calls for Aspiring Models: Chocolate models, Asian models, bikini models, and more—network and showcase your talent on Social Buzz.",
    8 => "Fitness Gurus: Build your fitness brand and connect with a dedicated community that supports your health journey on Future Starr.",
    9 => "The Social Buzz page is a hotspot for National Geographic enthusiasts to promote, discuss, and sell their expertise and photography.",
    10 => "Science Fair Ideas & Innovation: Share and sell your groundbreaking science projects with local schools and colleges via Social Buzz.",
    11 => "Food Experts & Chefs: Promote and sell your culinary expertise to a community of buyers eager to support your passion on Future Starr.",
    12 => "Nutritionists: Engage, educate, and sell nutrition plans or consultations through Future Starr's Social Buzz platform.",
    13 => "Math Entrepreneurs: Turn your math expertise into income by selling educational resources and tutoring on Social Buzz.",
    14 => "Cosmetic Professionals: Build your brand, gain a loyal fanbase, and promote your beauty products through Future Starr.",
    15 => "The next big American fashion designer might not be discovered on Instagram or YouTube—but right here on Future Starr.",
    16 => "Tattoos & Design Ideas: Express your artistry and sell your unique tattoo designs to an engaged creative community on Future Starr."
	];
	@endphp
	@php
	$social_keyword = [
	1 => "how to promote a book, promote self-published book, book promotion on social media, sell books online, book advertising strategies, best sites to sell books, book marketing tips,",
    2 => "entertainment marketing, entertainment promotion strategies, engaging entertainment content, entertain me ideas, entertainment business growth, creative entertainment campaigns,",
    4 => "top music promotion, discover new music, underground music releases, music marketing strategies, music streaming tips, how to promote your music,",
    5 => "sell photography online, best sites for photography sales, photography business marketing, professional photography gear, creative photography ideas, props for professional photography,",
    6 => "comedy promotion, best comedy content, funny video marketing, comedy open mic, stand-up comedy ideas, viral comedy videos, joke writing tips,",
    7 => "top fashion models, emerging model trends, Asian models, plus-size lingerie models, Japanese models, bikini models, male model industry, modeling career tips,",
    8 => "find fitness trainers, fitness motivation tips, fitness transformation stories, best fitness plans, fitness training programs, health and wellness coaching,",
    9 => "National Geographic photography, best nature photographers, wildlife photography tips, National Geographic photo submissions, iconic travel photography,",
    10 => "science fair project ideas, easy science experiments, science facts for kids, scientific discoveries, science fiction novels, latest science breakthroughs,",
    11 => "high-protein foods, top potassium-rich foods, best food for energy, healthy food recipes, food trends 2025, nutrition-packed meal ideas,",
    12 => "nutrition tips, benefits of healthy eating, mushroom nutrition facts, salmon nutrition benefits, best plant-based foods, balanced diet recommendations,",
    13 => "math education tools, best math learning resources, interactive math quizzes, careers in mathematics, top math skills for jobs, practical math applications,",
    14 => "trending cosmetic brands, best beauty products, skincare and cosmetics market, professional makeup tips, top-selling beauty products, fashion beauty trends,",
    15 => "fashion designer career, top fashion design schools, best fashion design software, how to become a fashion designer, successful fashion designer stories,",
    16 => "tattoo ideas, trending tattoo designs, best tattoos for men, sleeve tattoos, unique tattoo placements, tattoo inspiration, minimalist tattoos,"
	]
	@endphp
	<meta name="title" content="{{$social_title[$categorySelect]}}">
	<meta name="description" content="{{$social_desc[$categorySelect]}}">
	<meta name="keywords" content="{{$social_keyword[$categorySelect]}}">
	@elseif($registerRoute == 'blog.detailed')
	<meta name="title" content="{{ isset($tag_array['meta_tags']) ? $tag_array['meta_tags']: '' }}">
	
	<meta name="description" content="{{ isset($tag_array['meta_description']) ? $tag_array['meta_description'] : '' }} ">
	<meta name="keywords" content="{{ isset($tag_array['meta_keywords']) ? $tag_array['meta_keywords'] : '' }}">
	@else 
	<meta name="title" content="{{isset($metaTags['title'])?$metaTags['title']: '' }}">
	<meta name="description" content="{{isset($metaTags['description'])?$metaTags['description']: '' }}">
	<meta name="keywords" content="{{isset($metaTags['keywords'])?$metaTags['keywords']: '' }}">
	@endif
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}">

	<link rel="canonical" href="{{ url()->canonical() }}" >
    
	   <meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="site-url" content="{{ url('/') }}">
	<!-- CSRF Token -->
	@php $homeRoute = Route::currentRouteName() @endphp
	<meta name="google-site-verification" content="oyw7CbWFqAYVXogBH2hIOFvTZD58CIU3xqatT70VVe0">
	<meta name="seobility" content="525cf60fddc61098d6209176d70a48ce">
	<meta property="og:title" content="{{ $metaTags['title'] ?? '' }}">
	<meta property="og:image" content="{{ isset($metaTags['og_image']) ? $metaTags['og_image'] : 'https://www.futurestarr.com/assets/images/futurestarrlogo.jpg' }}">
	  @if(isset($metaTags['og_video'])) 
		<meta property="og:video" content="{{ $metaTags['og_video'] }}">
		<meta property="og:video:url" content="{{ $metaTags['og_video'] }}">
	  @endif 
	@if($registerRoute == 'register')
	<meta property="og:description" content="{{isset($metaTags['description'])?$metaTags['description']: "Sign up today! Earn income from your home. Receive high commission pay deposited into your Stripes merchant account from selling your Talent. "}}">
	@else 
	<meta property="og:description" content="{{isset($metaTags['description'])?$metaTags['description']: ''}}">
	@endif
	<meta property="og:url" content="{{ Request::url() }}">
	<meta property="og:site_name" content="FutureStarr">
	<meta property="og:locale" content="en_US">
	<meta property="og:type" content="website">


  <meta itemprop="name" content="Talent Marketplace: Buy&amp;Sell-Mp3,Mp4,Photo" />
  <meta itemprop="description" content="Talent Marketplace: Buy or Sell - Mp3s,Mp4s,Photos: If you want to sell your raw talent to earn a lot of money online fast visit Future Starr!" />
	   {{-- Add for blog --}}
	<meta property="article:publisher" content="">
	<meta property="article:section" content="Blogging">
	   {{-- Add for blog --}}

	   {{-- Add new meta tag --}}
	<meta property="al:ios:url" content="{{ Request::url() }}">
	<meta name="apple-mobile-web-app-title" content="Future Starr">
	<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon.ico') }}">
	<link rel="apple-touch-startup-image"  href="{{ asset('favicon.ico') }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	   {{-- Add new meta tag --}}

	<meta name="twitter:card" content="summary_large_image">
	<meta name= "twitter:url" content="{{ Request::url() }}">
	<meta name="twitter:site" content="@FutureStarrcom">
	<meta name="twitter:creator" content="@FutureStarrcom">
	<meta name="twitter:title" content="{{ $metaTags['title'] ?? '' }}">
	<meta name="twitter:label2" content="Time to read">
	
	<meta name="twitter:description" content="Future Starr promotes promising talent from around the world. Our platform helps you in becoming a famous celebrity. Only requirement is; just upload your talent videos on Future Starr and showcase your talent to the world. Sell your Talent Free - Make Sales and Be your Own Boss!">
	<meta name="twitter:image" content="{{ isset($metaTags['og_image']) ? $metaTags['og_image'] : 'https://www.futurestarr.com/assets/images/futurestarrlogo.jpg' }}">
		{{-- Add Twitter player tag --}}
	<meta name="twitter:player" content="{{ isset($metaTags['og_video']) ? $metaTags['og_video'] : 'https://www.futurestarr.com/assets/images/futurestarrlogo.jpg'}}">

		{{-- Add Twitter player tag --}}
	<link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
	<link  href="{{ url('assets/css/et-line-icons.css') }}" rel="stylesheet">
	<link  href="{{ url('assets/css/video_call.css') }}" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<!--<link rel="preload" as="font" href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&display=swap" rel="stylesheet">-->
	
	<link rel="preload" as="font" href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&display=swap">

	<link rel="alternate" type="application/rss+xml" title="Future Starr Feed" href="{{url('/feed')}}" >
	<link rel="alternate" type="application/rss+xml" title="Future Starr Comments Feed" href="{{url('/comments-feed')}}" >
	
	<!--<link rel="preload" as="font" href="https://fonts.googleapis.com/css?family=Overpass:100,100i,200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">-->
	
	<link rel="preload" as="font" href="https://fonts.googleapis.com/css?family=Overpass:100,100i,200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&display=swap">

	<!--<link  href="{{ url('assets/prod/css/main.min.css') }}" rel="stylesheet">-->
	{{-- <link href="https://futurestarr.com/public/assets/prod/css/main.min.css" rel="stylesheet"> --}}
	<link href="http://127.0.0.1:8000/assets/prod/css/main.min.css" rel="stylesheet">

	<script  src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <!--<script  src="https://futurestarr.b-cdn.net/jquery-3.4.1.min.js" ></script>-->

	<!-- <script defer src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5874817565023470" crossorigin="anonymous"></script> -->

	<script defer src="http://127.0.0.1:8000/public/assets/js/popper.min.js"></script>
	<script defer src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
	<script src="http://127.0.0.1:8000/public/assets/js/toastr.min.js"></script>
	<script defer src="{{asset('/js/lightslider.js') }}" ></script>
	<script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
	<script src="http://127.0.0.1:8000/node_modules/axios/dist/axios.min.js"></script>
	<script defer src="https://js.stripe.com/v2/"></script>
	<script  src="https://www.googletagmanager.com/gtag/js?id=UA-39143753-1"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	
	<script >
		var base_url = '//' + window.location.host;
	    var currentHost = window.location.host;
	    var currentPathname = window.location.pathname;
	    var url = 'https://'+currentHost+currentPathname; 

	window.dataLayer = window.dataLayer || [];
		function gtag() 
		{
			dataLayer.push(arguments);
		}
	   gtag('js', new Date());
	   gtag('config', 'UA-39143753-1');

	(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-KM8SJS');

	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-39143753-1');
	</script>
	@yield('front_page_head')
	@yield('head_script')
	
	<style>
  .detail-blog-secss p
  {
    text-align: justify;
  }
  @media(max-width:768px)
  {
	.footer-box ul {
    padding: 9px 0 0;
}
	.navbar-inverse .navbar-toggle {
    border-color: none;
}
    a.navbar-brand 
    {
        top: 23px;
        left: 145px;
        width: 120%;
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
<body class="{{ $bodyClass }}{{ $secondclass }} {{ !empty(Auth::check() ) ? 'is_logged_in': '' }}">
<div>
    <input type="hidden" id="current_user" value="{{ !empty(Auth::check() ) ? Auth::user()->id: '' }}" >
	<input type="hidden" id="pusher_app_key" value="{{ Config::get('constants.pusher.app_key') }}" >
	<input type="hidden" id="pusher_cluster" value="{{ Config::get('constants.pusher.cluster') }}" >
</div>
	{{-- <script >		
		var preload = document.createElement("div");
	  	preload.className = "preloader";
	  	preload.innerHTML =
    	'<p style="margin-top:30px !important;" class="hello"><img fetchpriority="high" rel="preload"  src="{{ asset("assets/images/gif-img/img-5.gif") }}" alt="Preloader Image" class="img-fluid"></p><div id="preloader"><div id="loader"></div></div>';
	  	document.body.appendChild(preload);
	  	window.addEventListener("load", function() 
	  	{
	    //  Uncomment to fade preloader after document load
		    preload.className += " fade";
		    setTimeout(function() 
		    {
		      preload.style.display = "none";
		    }, 1500);
		});
		onlyMessageChatPage = 0
	</script> --}}
	<!-- Google Tag Manager (noscript) -->
	<noscript>
		<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KM8SJS"
		height="0" width="0" class="if324s4"></iframe>
	</noscript>
		<!-- End Google Tag Manager (noscript) -->
		@include('layouts.talent.header')
		@yield('content')
		@include('layouts.talent.footer')
		@yield('javascript')

		@yield('front_page_script')
		<script >
			jQuery(document).ready(function()
			{
				jQuery(".nav.navbar-nav.navbar-right li").each(function( index ) {
					if(jQuery(this).find('a').attr('href') == window.location.href)
					{
						jQuery('.nav.navbar-nav.navbar-right li').removeClass('active');
						jQuery(this).addClass('active');
					}

				});				
			});
		</script>
</body>
</html>
