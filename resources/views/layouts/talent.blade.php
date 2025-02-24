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
	<meta name="title" content="Sign Up: Earn Income | Buy or Sell Talent From Home">
	<meta name="description" content="Sign up today! Earn income from your home. Receive high commission pay deposited into your Stripe's merchant account from selling your Talent.">
	<meta name="keywords" content="Register, sign up, earn income, how to make money on the side, make money collecting, hobbies that make money, commission pay,">
	<meta charset="utf-8" name="google-site-verification" content="oyw7CbWFqAYVXogBH2hIOFvTZD58CIU3xqatT70VVe0">
	<meta name="seobility" content="525cf60fddc61098d6209176d70a48ce">
	@elseif($registerRoute =='about-us')
	<meta name="title" content="The Road to Success | Future Starr">
	<meta name="description" content="To be successful: The road to success does not happen overnight! You must be passionate and ready to make sacrifices to achieve what you want.">
	<meta name="keywords" content="road to success, secret of my success, standard for success, about us, about Future Starr, critical factor success, success of the new deal, success by health, symbol of success, key success factors, connections to success,">
	@elseif($registerRoute =='term-conditions')
	<meta name="title" content="Terms and Conditions | Future Starr">
	<meta name="description" content="At Future Starr, we collect and manage user data according to the following Privacy Policy, with the goal of incorporating our company values.">
	<meta name="keywords" content="Terms and conditions, terms and conditions at Future Starr, terms and conditions on website, terms and conditions definition, terms and conditions may apply summary,">
	@elseif($registerRoute =='refund-policy')
	<meta name="title" content="Refund Policy | Future Starr">
	<meta name="description" content="Welcome to Future Starr's refund policy section. Our mission at FutureStarr is to ensure you are completely satisfied. Read more about our refund policy.">
	<meta name="keywords" content="refund policy of Future Starr, refund policy at Future Starr, refund policy, customer service, satisfaction, quality service, happy customers. satisfied customers,">
	@elseif($registerRoute =='privacy-policy')
	<meta name="title" content="Privacy Policy | Future Starr">
	<meta name="description" content="Read our privacy policy online. This Privacy Policy explains how Future Starr collects, uses, stores, and discloses information.">
	<meta name="keywords" content="privacy policy, privacy policy at Future Starr, Future Starr privacy policy, privacy policy update,">
	@elseif($registerRoute == 'talent.index')
	<meta name="title" content="Talent Mall | Return on Sales | Ideas For Talent Show">
	<meta name="description" content="Future Starr online Talent Mall was discovered in Atlanta! Browse and Purchase some of the hottest undiscovered talents across the globe.">
	<meta name="keywords" content="biggest malls in america, largest malls in the world, largest malls in us, star shopping, where can I purchase, define purchase, underground rapper, atlanta underground mall, underground tattooing, hiphop undergound, undiscovered,">
	@elseif(Request::is('social-buzz/*'))
	@php
	$social_desc = [
	1 => "Book Authors: Unleash the full potential of drawing an audience of buyers who is ready to purchase on Future Starr's social buzz page.",
	2 => "Are you in search of new entertainers asking them to entertain me? Future Starr's unique social buzz outlet help to connect with passionate entertainers.",
	4 => "Global Music Promotion: To underground artist trying to get their music out. Future Starr social buzz page has a community of music riders ready.",
	5 => "Future Starr has a place for photographers from across the globe who has a database full of professional photography for sale globally.",
	6 => "Comedy for sale: Locate the best undiscovered comedy videos here on Future Starr. Use our social buzz to begin promoting and selling your comedy talent.",
	7 => "Casting call for premier model entrepreneurs: Chocolate models, Asian models, hot bikini models, Japanese models, etc. Utilize Social Buzz to network.",
	8 => "Fitness Gurus: Do Fitness your way. Establish a new realm of riders ready to ride with you and support your fitness achievements by joining Future Starr.",
	9 => "Future Starr social buzz is the new hot zone for the national geographic society to promote and sell their knowledge and expertise. Start up a discussion about your national geographic photo of the day. ",
	10 => "Science includes fair ideas for local schools and colleges. Future Starr social buzz page provides an outlet for science geniuses.",
	11 => "Future Starr has an online community of buyers that's ready to support and purchase your food expertise. Start socializing on Future Starr today!",
	12 => "Future Starr Social buzz page gives nutritionists a way to discuss and sell on topics on nutrition. Nutrition should be a habit in our daily lives.",
	13 => "Mathematic jobs are the past, present, and future.The Social Buzz platform allows math teachers to become entrepreneurs by selling their math online.",
	14 => "Global cosmetic interns and professionals: Create a new fan base stream through Future Starr social buzz page to promote or sell to cosmetics consumers.",
	15 => "The next American fashion designer star may not get discovered on Facebook, Instagram, or YouTube. The next star will appear right on Future Starr.",
	16 => "Tattoos and Tattoo's ideas are a true representation of a person's artistic side. Why not see if you can sell your tattoo ideas to our community?"
	]
	@endphp
	@php
	$social_keyword = [
	1 => "how to promote book, promote myself published book, how to promote book on social media, promote book, sell books comparison site, site book, sell books online, advertise a book poster,",
	2 => "entertainment promotion, entertainment marketing, are you not entertained, entertain me, entertain persuade inform, entertain an idea,",
	4 => "now that's what I call music, rate your music, new music releases, music promotion, music riders,",
	5 => "photography for sale, photography promotion, photography promotion ideas, props for photography for sale, photography ideas, best camera for professional photography,",
	6 => "salesman comedy, comedy for sale, comedy zone, comedy videos, comedy catch, comedy open mic, comedy jokes, comedy unleashed,",
	7 => "price is right models, chocolate models, asian models, Japanese models, blackmale models, micro bikini models, underwear models, hot bikini models, plus size lingerie models,",
	8 => "fitness trainers near me, types of fitness trainers, fitness singles, fitness pal, fitness motivation, fitness your way, fitness evolution, fitness goals, ",
	9 => "national geographic photographer,national geographic society, national geographic  your shot, national geographic  hot zone, national geographic  photo of the day,",
	10 => "science revolution, science fair ideas, science experiments for kids, science jokes, science words, science variables, science fiction books,",
	11 => "food high in protein,  food high in potassium,  food in spanish,  food open,  food high in magnesium,  food network shows,  food recipes,  food and wine",
	12 => "mushroom nutrition, black beans  nutrition, brussel sprouts  nutrition, salmon  nutrition, green bean  nutrition, shrimp  nutrition, pinto beans  nutrition, oat milk  nutrition, ",
	13 => "mathematics vision project,  mathematic range, mathematics clipart, mathematic quizzes, mathematics properties, mathematics jobs,",
	14 => "cosmetic brands,  cosmetics market, it  cosmetics, mented  cosmetics, mac  cosmetics, profussion  cosmetics, fashion fair  cosmetics, jaclyn hill  cosmetics, give me glow  cosmetics, ",
	15 => "college fashion designer, fashion designer course, fashion designer software, italian fashion designer, new york fashion designer,american fashion designer, fashion designer portfolios,",
	16 => "Tattoos, Tattoos ideas, Tattoos roses, Tattoos for women, Tattoos for men, Tattoos sleeves, Tattoos on high,"
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
