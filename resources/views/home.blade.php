@extends('layouts.talent')
@section('content')
<style>
    .hpfs01
    {
        width: 100%;
        height: 360px;
        position: relative;
    }
    #home-slider { margin: auto; display: block; position: absolute;}
    #videoMessage { position: absolute !important; top: 30%; left: 0%;
        right: 0%;
        display: flex;
        flex-direction: column; 
        justify-content: center;
        align-items: center; 
        width: 100%;
        height: 100%;}
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
    @media only screen and (max-width: 600px) {
        #videoMessage { 
            position: absolute !important; 
            top: 13%; 
            left: 2%;
            display: flex;
            flex-direction: column; 
            justify-content: center;
            align-items: center; 
            width: 98%;
            height: 70%;
        }
        .home .slider-text-middle h1 {
            font-size: 20px!important;
            line-height: 12px!important;
        }
        .home .slider-text-middle h4 {
            font-size: 14px;
            line-height: 16px;
        }
        .home .slider-text-middle span {
            font-size: 8px;
            margin-bottom: 0 !important;
        }
        .hpfs01{
            margin-top: 35px;
            height: 255px;
        }
        .mrgn{
            margin-top: 0px !important;
            padding: 0 !important;
        }
        input#search {
            height: 25px;
            font-size: 12px;
        }
        .p-1 label {
            top: 1px;
        }
    }
    @media only screen and (max-width: 370px) {
        .hpfs01{
            margin-top: 25px;
        }
        #videoMessage { 
            top: 15%; 
        }
        .home .slider-text-middle h1 {
            font-size: 18px!important;
            line-height: 12px!important;
        }
        .home .slider-text-middle h4 {
            font-size: 10px;
            line-height: 10px;
        }
        .home .slider-text-middle span {
            font-size: 6px;
            margin-bottom: 0 !important;
        }
        input#search {
            height: 25px;
            font-size: 12px;
        }
        .p-1 label {
            top: 1px;
        }
    }
    .hpfs07{
        background-image: url('{{ asset("assets/images/parallax-bg2.jpg") }}');
    }
</style>
<div class="home">
    <section class="s1 p-0 parallax mobile-height wow fadeIn hpfs01" data-stellar-background-ratio="0.5">
        <video preload="" id="home-slider" muted loop autoplay playsinline >
          <source  src="{{ asset('assets/images/homepage-5-slider-img-1.mp4') }}" type="video/mp4">
          <source  src="{{ asset('assets/images/homepage-5-slider-img-1.mp4') }}" type="video/ogg">
          Your browser does not support the video.
        </video>
        <div id="videoMessage" class="container position-relative">
            <div class="slider-typography text-center">
                <div class="slider-text-middle-main">
                    <div class="slider-text-middle">
                        <h1 class="alt-font text-uppercase text-white font-weight-700 mb-2">FUTURE STARR</h1>
                        <h4 class="alt-font text-uppercase text-white font-weight-700 mb-2"> THE OFFICIAL <b>TALENT</b> MARKET PLACE</h4>

                        <span class="text-large text-very-light-gray font-weight-400 d-block mb-4">@lang('home.BANNERSUBTITLE')</span>
                        <div class="row justify-content-center">
                            <div class="col-8">
                                <div class="bg-search-theme p-1">
                                    <div class="row justify-content-center">
                                        <div class="col">
                                         <label >
                                            <i class="fa fa-search" aria-hidden="true">
                                            </i>
                                                <span class="sr-only">Search icons</span>
                                            </label>
                                              <input class="mb-0 bg-search-theme-light" name="name" id="search" placeholder="Search Talent" type="text" autocomplete="off">
                                               <ul class="search-results">

                                               </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="margin-top:150px" class="mrgn wow fadeIn bg-light-gray bg-light-cream">
        <div class="container">
            <div class="text-center mb-3 mb-sm-5">
                <p class="alt-font text-medium-gray margin-5px-bottom text-uppercase text-small">FEATURES</p>
                <h2 class="text-uppercase alt-font text-extra-dark-gray margin-20px-bottom font-weight-700 sm-width-100 xs-width-100 extras">@lang('home.WHOCHOOSE')</h2><span class="d-block separator-line-horrizontal-medium-light2 bg-deep-pink mx-auto width-100px"></span></div>
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
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
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
                    <div class="p-4 h-100 bg-white box-shadow-m text-center">
                        <div>
                            <video muted loop autoplay >
                              <source  src="{{ asset('/assets/home_gifs/post289_1.mp4') }}" type="video/mp4">
                              <source  src="{{ asset('/assets/home_gifs/post289_1.mp4') }}" type="video/ogg">
                              Your browser does not support the video tag.
                            </video>
                        </div>
                        <span class="alt-font text-extra-dark-gray font-weight-600 display-block mb-2 text-medium">@lang('home.EXPLORETALENT')</span>
                        <p class="mb-0 text-red">@lang('home.EXPLORETALENTDESCRIPTION')</p>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4 mb-lg-0">
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
                <div class="col-sm-6 col-lg-3 mb-sm-4 mb-lg-0">
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
    <section class="no-padding wow fadeIn bg-extra-dark-gray hpfs02" id="services">
        <div class="container-fluid no-padding">
            <div class="row equalize sm-equalize-auto no-margin n-dark-sec">
                <div onclick="window.open('https://play.google.com/store/apps/details?id=com.futurestarrmarketplace&pli=1', '_blank')" class="col-md-6 position-relative sm-height-auto xs-height-350px wow slideInLeft hpfs03 image-blur" data--duration="900ms">
                    <video style="border: none !important;" muted loop autoplay>
                      <source src="{{ asset('assets/images/post342.mp4') }}" type="video/mp4">
                      Your browser does not support the video tag.
                    </video>
                </div>
                <div class="col-md-6 wow slideInRight hpfs04" data--duration="900ms">
                    <div class="text-center text-md-left py-4 py-sm-5 px-md-4 p-lg-5 m-lg-5">
                        <div class="mb-3 mb-sm-5">
                            <p class="alt-font text-medium-gray margin-5px-bottom text-uppercase text-small">@lang('home.DISCOVER')</p>
                             <h2 class="text-uppercase alt-font text-light-gray margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Future Starr</h2><span class="d-block separator-line-horrizontal-medium-light2 bg-deep-pink mx-auto width-100px mr-md-auto ml-md-0"></span>
                         </div>
                            @lang('home.DISCOVERDESCRIPTION')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class=" wow fadeIn hpfs02">
        <div class="container">
            <div class="row">
                <div class="d-md-none d-lg-block col-md-5 pr-sm-5 pr-lg-0 text-center  wow fadeIn hpfs02">
                    <div class="display-table-cell vertical-align-middle"><img alt="LET'S GET STARTED!" title="LET'S GET STARTED!" class="img-fluid" src="{{asset('assets/images/image-3.png') }}"></div>
                </div>
                <div class="pl-lg-5 col-md-12 col-lg-7  wow fadeIn hpfs06" data--delay="0.4s">
                    <div class="mb-3 mt-5 mt-md-0 mb-sm-5 text-center">
                      
                         <h2 class="text-uppercase alt-font text-extra-dark-gray margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">@lang('home.LETSTART')</h2><span class="separator-line-horrizontal-medium-light2 bg-deep-pink d-block mx-auto width-100px"></span></div>
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
                      <div class="text-center"><a class="btn btn-small btn-dark-gray" href="{{ route('seller.index') }}">Click here to create page</a></div>
                     @elseif(Auth::check() && Auth::user()->role_id =='3')
                      <div class="text-center"><a class="btn btn-small btn-dark-gray" href="javascript:void(0);" data-toggle="modal" data-target="#information_modal">Click here to create page</a></div>
                    @else
                    <div class="text-center"><a class="btn btn-small btn-dark-gray" href="javascript:void(0);" data-toggle="modal" data-target="#register_my_model">Click here to create page</a></div>
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
                <div class="col-md-6 col-lg-4 col-xl-3 bg-white text-center text-md-left px-md-4 px-lg-5">
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
    <section class="bg-extra-dark-gray  wow fadeIn hpfs02">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12 n-dark-sec">
                    <p class="alt-font margin-5px-bottom text-uppercase text-small text-medium-gray">EXPLORE</p>
                    <h2 class="text-uppercase alt-font text-white margin-10px-top margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">@lang('home.MARKETPLACE')</h2><span class="separator-line-horrizontal-medium-light2 bg-deep-pink d-block mx-auto width-100px mb-sm-5"></span>
                    <p class="mt-3 mb-sm-5">@lang('home.MARKETPLACEDESCRIPTION')</p>
                </div>
            </div>
            <div class="row">
                @if(!empty($catagories))
                  @foreach($catagories as $category)
                <div class="col-sm-6 col-md-4 col-xl-3 mb-4 wow fadeInUp  last-paragraph-no-margin">
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
        </div>
    </section>
    <section class=" wow fadeIn hover-option4 blog-post-style3">
        <div class="container">
            <div class="text-center mb-5">
                <p class="alt-font margin-5px-bottom text-uppercase text-small text-medium-gray">NEWS</p>
             
                <h2 class="text-uppercase alt-font text-extra-dark-gray margin-10px-top margin-20px-bottom font-weight-700 sm-width-100 xs-width-100">Latest Blogs</h2><span class="separator-line-horrizontal-medium-light2 bg-deep-pink display-table margin-auto width-100px"></span></div>
            <div class="row">
            @if($blogs)
                @foreach($blogs as $blog)
                @php $slug = $blog->id.'/'.Str::slug($blog->title,'-'); @endphp
                <div class="grid-item col-md-4 margin-30px-bottom xs-text-center   wow fadeInUp">
                    <div class="blog-post bg-light-gray inner-match-height">
                        <div class="blog-post-images overflow-hidden position-relative">
                            <!--<a href="{{ route('blog.detailed',[$blog->getBlogCatagories['slug'], $blog->slug]) }}" href="javascript:void(0);">-->
                            <a href="{{ route('blog.detailed',[$blog->getBlogCatagories['slug'], $blog->slug]) }}">
                              <img src="{{asset( !empty($blog->blog_img) ? $blog->blog_img:'assets/images/default-ad-banner.png')}}" alt="Blog Media" title="{{$blog->title}}" data-mm="{{ asset($blog->blog_img) }}" loading="lazy">
                                <div class="blog-hover-icon"><span class="text-extra-large font-weight-300">+</span></div>
                            </a>
                        </div>
                        <div class="post-details padding-40px-all sm-padding-20px-all" style="padding: 25px;"><a class="ovpasstitle alt-font post-title text-medium text-extra-dark-gray width-100 display-block md-width-100 margin-15px-bottom" href="{{ route('blog.detailed',[$blog->getBlogCatagories['slug'], $blog->slug]) }}"> {{ $blog->title }}...</a>
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
            <p class="head">Congrats Seller! Let's Get Started</p>
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
            <p class="head">Congrats Buyer! Let's Get Started</p>
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
@endsection


