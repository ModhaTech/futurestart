@php $site_config = site_config() @endphp
<style>
    .btn-customm {
      margin-top: 5px !important;
      /* margin-right: 10px !important; */
        display: inline-block;
        padding: 10px 15px !important;
        color: white;
        background-color: transparent;
        border: 2px solid white;
        border-radius: 10px !important;
        text-align: center;
        text-decoration: none;
        font-size: 12px !important;
        font-weight: bold;
        transition: all 0.3s ease;
        line-height: 13px !important;
    }

    .btn-customm:hover {
        background-color: white;
        color: #007bff; /* Adjust hover text color */
        text-decoration: none;
    }

    .btn-customm .header-icon {
        margin-right: 8px;
        display: inline-block;
        vertical-align: middle;
    }
</style>




{{-- <nav class="navbar navbar-expand-lg navbar-inverse fixed-top navhide nmbar navbar-bottom">
  <div class="container-fluid">
      <div class="row w-100 d-flex align-items-center">
        <div class="col-md-4">
          <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                      <a class="nav-link" href="{{URL::to('/')}}">HOME</a>
                  </li>
                  <li class="nav-item {{ Route::currentRouteName() == 'search.index' ? 'active' : '' }}">
                      <a class="nav-link" href="{{ route('search.index')}}">STARR SEARCH</a>
                  </li>
                  <li class="nav-item {{ Route::currentRouteName() == 'talent.index' ? 'active' : '' }}">
                      <a class="nav-link" href="{{ route('talent.index')}}">TALENT MALL</a>
                  </li>
                  <li class="nav-item {{ Route::currentRouteName() == 'blog.index' ? 'active' : '' }}">
                      <a class="nav-link" href="{{ route('blog.index')}}">BLOG</a>
                  </li>

              </ul>
          </div>
      </div>
        
          <div class="col-md-4 d-flex justify-content-center">
              <a class="navbar-brand" href="/" title="Future Starr">
                  <img loading="lazy" decoding="async" class="img-responsive sm-logo" alt="futurestarr logo" 
                      src="{{ asset('assets/images/futurelogo.png')}}" style="max-height: 50px;">
              </a>
          </div>
          <div class="col-md-4 d-flex justify-content-start">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
                  <span class="navbar-toggler-icon"></span>
              </button>
         
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
      </div>
  </div>
</nav> --}}



<nav class="navbar navbar-inverse fixed-top navhide nmbar navbar-bottom">

<div class="container-fluid h-font nmbar">
<div class="navbar-header">
 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
   <span class="icon-bar"></span>
   <span class="icon-bar"></span>
   <span class="icon-bar"></span>
 </button>
 @if(Auth::check()==true)
 @php $className ='navbar-brand header-login-sec'; @endphp
 @else
 @php $className = 'navbar-brand'; @endphp
 @endif

 <a class="{{$className}}" href="/" title="Future Starr" style="z-index: 9999;">
  <img loading="lazy" decoding="async" class="img-responsive sm-logo" alt="futurestarr logo" 
      src="{{ asset('assets/images/futurelogo.png')}}"
      style="@if (Auth::guest())margin: -24px !important; margin-left: 49px !important; @else margin: 3px !important; ; @endif">
</a>

</div>
<div class="collapse navbar-collapse" id="myNavbar">
<div class="search-box-div">
  <form class="search-box">

    <input type="text" class="text search-input" placeholder="Type here to search..." >
  </form>
  <div class="search-re"></div>
</div>
 <ul class="nav navbar-nav navbar-right" style="padding: 5px; align-items: center;">
  <li class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
   <a href="{{URL::to('/')}}" title="Entertainment Career, community">
    <div class="header-icon">
    
    </div>
    HOME
    </a>
  </li>
               @if (!Auth::guest())
               @if(auth::user()->role_id =='3')
               @php $route = route('buyer.dashboard') @endphp
               @endif
               @if(auth::user()->role_id =='4')
               @php $route = route('seller.index') @endphp
               @endif
               @if(auth::user()->role_id =='1')
               @php $route = route('admin.dashboard') @endphp
               @endif
               <li class="{{ Route::currentRouteName() == $route  ? 'active' : '' }}">
                 <a href="{{$route}}">
                  <div class="header-icon">
                    @if(!empty($user_chat_message)) <span class="fa-icon-font msg-count-out" style="background: #ff503f;padding: 5px;border-radius: 50%;">
                      <span class="msg-count">{{$user_chat_message}}</span></span>@endif
                  </div>
                  DASHBOARD
                 </a>
              </li>
              @endif
              <li class="{{ Route::currentRouteName() == 'search.index'  ? 'active' : '' }}">
               <a href="{{ route('search.index')}}" title="Future Starr, Tattoo Artists">
                <div class="header-icon">
                  
                </div>STARR SEARCHQQ
               </a>
              </li>
              <li class="{{ Route::currentRouteName() == 'talent.index'  ? 'active' : '' }}">
               <a href="{{ route('talent.index')}}" title="Sign up, Future Starr, model photos, music songs, educational courses, fitness tips">
                <div class="header-icon"></div>TALENT MALLFFF</a>
              </li>
              <li class="{{ Route::currentRouteName() == 'social-buzz.index'  ? 'active' : '' }}">
               <a href="{{ route('social-buzz.index')}}" >
                <div class="header-icon">
                  <!--<img loading="lazy" decoding="async" class="fa-icon-font" alt="social icon" src="{{ asset('assets/images/home/social_b.png') }}" alt="Social buzz icon">-->                    
                </div>SOCIAL BUZZ
               </a>
              </li>
              <li class="{{ Route::currentRouteName() == 'blog.index'  ? 'active' : '' }} || {{ Route::currentRouteName() == 'blog.detailed'  ? 'active' : '' }}">
               <a href="{{ route('blog.index')}}" >
                <div class="header-icon"></div>BLOG
               </a>
              </li>          
             <!-- <li class="{{ Route::currentRouteName() == 'contact-us.index'  ? 'active' : '' }}">
               <a href="{{ route('contact-us.index')}}">
                <div class="header-icon">
                 
                </div>  888-704-0504
               </a>
              </li>-->
      
              @if(Route::currentRouteName() != 'home')
              <li>
                <a href="javascript:void(0)" id="search-toggle">
                  <div class="header-icon">
                   
                  </div>Search
                </a>
              </li>
              @endif

         
           

@if(Auth::check()==true && Auth::user()->role_id =='3')
           <li>
             
               <a  href="{{ route('blog.post') }}" style="width: 103px;">
            Guest Blog
               </a>
             
           </li>
           @endif

           @if (!Auth::guest() && Auth()->user()->role_id !='1')
           <li class="dropdown" style="display: inline-block;">
             <a class="dropdown-margin" role="button" data-toggle="dropdown">
              <div class="header-icon he-ic">
               @if(!empty(Auth::user()->profile_pic) && file_exists(Auth::user()->profile_pic))
               <input class="auth_user_profilepic" type="hidden" value="{{Auth::user()->profile_pic}}" name="">
               <input class="auth_user_username" type="hidden" name="" value="{{Auth::user()->username}}">
               @else
               @endif
             </div>
             my Account
             <span class="caret"></span>
             <ul class="dropdown-menu seller-menu">

               @if(Auth::user()->role_id == '4')
               @php $manage_profile_link =  route('seller.public.profile') @endphp
               @else
               @php $manage_profile_link =  route('buyer.public.profile') @endphp
               @endif

               <li data-toggle="collapse" data-target="#myNavbar">
                <a role="button" href="{{ $manage_profile_link }}">Manage Public Profile</a>
              </li>

              <li data-toggle="collapse" data-target="#myNavbar">
               <a role="button" href="{{route('user.delete-account')}}">Delete Account</a>
             </li>
             @if(Auth::user()->role_id =='3')
             <li data-toggle="collapse" data-target="#myNavbar">
               <a role="button" href="{{ route('buyer.edit')}}">Account Info</a>
             </li>
             <li data-toggle="collapse" data-target="#myNavbar">
               <a role="button" href="{{ route('buyer.billing.account')}}">Billing Account</a>
             </li>
             <li data-toggle="collapse" data-target="#myNavbar">
               <a role="button" href="{{route('buyer.changePassword')}}">Security</a>
             </li>
             <li data-toggle="collapse" data-target="#myNavbar">
               <a role="button" href="{{route('buyer.t-shirt')}}">T-Shirt</a>
             </li>
             <li data-toggle="collapse" data-target="#myNavbar">
               <a role="button" href="{{route('buyer.checkout.show')}}">T-Shirt-Checkout</a>
             </li>
             @else
             <li data-toggle="collapse" data-target="#myNavbar">
               <a role="button" href="{{ route('seller.edit')}}">Account Info</a>
             </li> 

             <li data-toggle="collapse" data-target="#myNavbar">
               <a role="button" href="{{route('seller.changePassword')}}">Security</a>
             </li>
             @endif

             @if(!Auth::guest())
             <li>
               <a href="{{ route('logout') }}"  onclick="event.preventDefault();  document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
            @endif

          </ul>
                 
        </li>

        @if(Auth::check()==true && Auth::user()->role_id =='3')
           {{-- <li>
             <span>
               <a data-toggle="tooltip" title="Shopping Cart"  class="btn btn-danger btn-sm b-btn cart-btn" href="{{ route('cart.index')}}" style="margin-top: 10px !important;width: 53px; margin-right: 13px;">
                 <span class="cart-count">{{ cartCount(Auth::user()->id) }}</span>
                 <span class="fa fa-shopping-cart"></span>
               </a>
             </span>
           </li> --}}

           <li>
              <span>
                  <a data-toggle="tooltip" title="Shopping Cart" 
                    class="btn btn-danger btn-sm b-btn cart-btn cart-align" 
                    href="{{ route('cart.index')}}">
                      
                      <!-- Cart Count Badge -->
                      <span class="cart-count">
                          {{ cartCount(Auth::user()->id) }}
                      </span>
          <div class="set_middle"> <!-- Shopping Cart Icon -->
            <span class="fa fa-shopping-cart"></span></div>
                     
                  </a>
              </span>
          </li>
           @endif
        @endif

         <li class="{{ Route::currentRouteName() == 'contact-us.index' ? 'active' : '' }}">
  <a href="{{ route('contact-us.index') }}" class="btn-customm">
      <div class="header-icon">
          <!-- Add a phone icon -->
          <i class="fas fa-phone"></i>
      </div>
      888-704-0504
  </a>
</li>
      </ul>
    </div>
  </div>
</nav>


{{-- <nav class="navbar navbar-expand-lg navbar-inverse fixed-top navhide nmbar navbar-bottom">
    <div class="container-fluid">
        <div class="row w-100 d-flex align-items-center">
          <div class="col-md-4">
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                        <a class="nav-link" href="{{URL::to('/')}}">HOME</a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteName() == 'search.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('search.index')}}">STARR SEARCH</a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteName() == 'talent.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('talent.index')}}">TALENT MALL</a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteName() == 'blog.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('blog.index')}}">BLOG</a>
                    </li>

                </ul>
            </div>
        </div>
          
            <div class="col-md-4 d-flex justify-content-center">
                <a class="navbar-brand" href="/" title="Future Starr">
                    <img loading="lazy" decoding="async" class="img-responsive sm-logo" alt="futurestarr logo" 
                        src="{{ asset('assets/images/futurelogo.png')}}" style="max-height: 50px;">
                </a>
            </div>
            <div class="col-md-4 d-flex justify-content-start">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
           
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
                  <span class="navbar-toggler-icon"></span>
              </button>
          </div>
        </div>
    </div>
</nav> --}}



{{-- <nav class="navbar navbar-inverse fixed-top navhide nmbar navbar-bottom">

  <div class="container-fluid h-font nmbar">
  <div class="navbar-header">
   <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
   </button>
   @if(Auth::check()==true)
   @php $className ='navbar-brand header-login-sec'; @endphp
   @else
   @php $className = 'navbar-brand'; @endphp
   @endif

   <a class="{{$className}}" href="/" title="Future Starr" style="z-index: 9999;">
    <img loading="lazy" decoding="async" class="img-responsive sm-logo" alt="futurestarr logo" 
        src="{{ asset('assets/images/futurelogo.png')}}"
        style="@if (Auth::guest())margin: -25px !important; margin-left: 8px !important; @else margin: 3px !important; @endif">
</a>

 </div>
 <div class="collapse navbar-collapse" id="myNavbar">
  <div class="search-box-div">
    <form class="search-box">

      <input type="text" class="text search-input" placeholder="Type here to search..." >
    </form>
    <div class="search-re"></div>
  </div>
   <ul class="nav navbar-nav navbar-right" style="padding: 5px; align-items: center;">
    <li class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
     <a href="{{URL::to('/')}}" title="Entertainment Career, community">
      <div class="header-icon">
      
     </div>
     HOME
   </a>
  </li>
                 @if (!Auth::guest())
                 @if(auth::user()->role_id =='3')
                 @php $route = route('buyer.dashboard') @endphp
                 @endif
                 @if(auth::user()->role_id =='4')
                 @php $route = route('seller.index') @endphp
                 @endif
                 @if(auth::user()->role_id =='1')
                 @php $route = route('admin.dashboard') @endphp
                 @endif
                 <li class="{{ Route::currentRouteName() == $route  ? 'active' : '' }}">
                   <a href="{{$route}}">
                    <div class="header-icon">
                      @if(!empty($user_chat_message)) <span class="fa-icon-font msg-count-out" style="background: #ff503f;padding: 5px;border-radius: 50%;">
                        <span class="msg-count">{{$user_chat_message}}</span></span>@endif
                    </div>
                    DASHBOARD
                   </a>
                </li>
                @endif
                <li class="{{ Route::currentRouteName() == 'search.index'  ? 'active' : '' }}">
                 <a href="{{ route('search.index')}}" title="Future Starr, Tattoo Artists">
                  <div class="header-icon">
                    
                  </div>STARR SEARCHQQ
                 </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'talent.index'  ? 'active' : '' }}">
                 <a href="{{ route('talent.index')}}" title="Sign up, Future Starr, model photos, music songs, educational courses, fitness tips">
                  <div class="header-icon"></div>TALENT MALLFFF</a>
                </li>
                <li class="{{ Route::currentRouteName() == 'social-buzz.index'  ? 'active' : '' }}">
                 <a href="{{ route('social-buzz.index')}}" >
                  <div class="header-icon">
                    <!--<img loading="lazy" decoding="async" class="fa-icon-font" alt="social icon" src="{{ asset('assets/images/home/social_b.png') }}" alt="Social buzz icon">-->                    
                  </div>SOCIAL BUZZ
                 </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'blog.index'  ? 'active' : '' }} || {{ Route::currentRouteName() == 'blog.detailed'  ? 'active' : '' }}">
                 <a href="{{ route('blog.index')}}" >
                  <div class="header-icon"></div>BLOG
                 </a>
                </li>          
               <!-- <li class="{{ Route::currentRouteName() == 'contact-us.index'  ? 'active' : '' }}">
                 <a href="{{ route('contact-us.index')}}">
                  <div class="header-icon">
                   
                  </div>  888-704-0504
                 </a>
                </li>-->
        
                @if(Route::currentRouteName() != 'home')
                <li>
                  <a href="javascript:void(0)" id="search-toggle">
                    <div class="header-icon">
                     
                    </div>Search
                  </a>
                </li>
                @endif

           
             @if(Auth::check()==true && Auth::user()->role_id =='3')
             <li>
               <span>
                 <a data-toggle="tooltip" title="Shopping Cart"  class="btn btn-danger btn-sm b-btn cart-btn" href="{{ route('cart.index')}}" style="margin-top: 8px !important;width: 53px;">
                   <span class="cart-count">{{ cartCount(Auth::user()->id) }}</span>
                   <span class="fa fa-shopping-cart"></span>
                 </a>
               </span>
             </li>
             @endif

@if(Auth::check()==true && Auth::user()->role_id =='3')
             <li>
               
                 <a  href="{{ route('blog.post') }}" style="width: 103px;">
              Guest Blog
                 </a>
               
             </li>
             @endif

             @if (!Auth::guest() && Auth()->user()->role_id !='1')
             <li class="dropdown" style="display: inline-block;">
               <a class="dropdown-margin" role="button" data-toggle="dropdown">
                <div class="header-icon he-ic">
                 @if(!empty(Auth::user()->profile_pic) && file_exists(Auth::user()->profile_pic))
                 <input class="auth_user_profilepic" type="hidden" value="{{Auth::user()->profile_pic}}" name="">
                 <input class="auth_user_username" type="hidden" name="" value="{{Auth::user()->username}}">
                 @else
                 @endif
               </div>
               my Account
               <span class="caret"></span>
               <ul class="dropdown-menu seller-menu">

                 @if(Auth::user()->role_id == '4')
                 @php $manage_profile_link =  route('seller.public.profile') @endphp
                 @else
                 @php $manage_profile_link =  route('buyer.public.profile') @endphp
                 @endif

                 <li data-toggle="collapse" data-target="#myNavbar">
                  <a role="button" href="{{ $manage_profile_link }}">Manage Public Profile</a>
                </li>

                <li data-toggle="collapse" data-target="#myNavbar">
                 <a role="button" href="{{route('user.delete-account')}}">Delete Account</a>
               </li>
               @if(Auth::user()->role_id =='3')
               <li data-toggle="collapse" data-target="#myNavbar">
                 <a role="button" href="{{ route('buyer.edit')}}">Account Info</a>
               </li>
               <li data-toggle="collapse" data-target="#myNavbar">
                 <a role="button" href="{{ route('buyer.billing.account')}}">Billing Account</a>
               </li>
               <li data-toggle="collapse" data-target="#myNavbar">
                 <a role="button" href="{{route('buyer.changePassword')}}">Security</a>
               </li>
               <li data-toggle="collapse" data-target="#myNavbar">
                 <a role="button" href="{{route('buyer.t-shirt')}}">T-Shirt</a>
               </li>
               <li data-toggle="collapse" data-target="#myNavbar">
                 <a role="button" href="{{route('buyer.checkout.show')}}">T-Shirt-Checkout</a>
               </li>
               @else
               <li data-toggle="collapse" data-target="#myNavbar">
                 <a role="button" href="{{ route('seller.edit')}}">Account Info</a>
               </li> 

               <li data-toggle="collapse" data-target="#myNavbar">
                 <a role="button" href="{{route('seller.changePassword')}}">Security</a>
               </li>
               @endif

               @if(!Auth::guest())
               <li>
                 <a href="{{ route('logout') }}"  onclick="event.preventDefault();  document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
              @endif

            </ul>
                   
          </li>
          @endif

           <li class="{{ Route::currentRouteName() == 'contact-us.index' ? 'active' : '' }}">
    <a href="{{ route('contact-us.index') }}" class="btn-customm">
        <div class="header-icon">
            <!-- Add a phone icon -->
            <i class="fas fa-phone"></i>
        </div>
        888-704-0504
    </a>
</li>
        </ul>
      </div>
    </div>
  </nav> --}}
  
  <!-- login User Modal Start-->

  <div class="modal fade report-user" id="login" role="dialog" data-keyboard="false" data-backdrop="static">
   <div class="modal-dialog login-model-sec">
    <form class="login-mobile" method="post" onsubmit="LoginUser(event)">
     <!-- Modal content-->
     <div class="modal-content">
      <div class="modal-header clo">
       <button type="button" class="close" data-dismiss="modal">X</button>
       <p class="modal-title" >Login</p>
     </div>
     <div class="modal-body lmsbo">
       <div class="">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 login-back">
         <p class="register-panel text-center mb-2" style="color:#fff; font-size: 22px !important;font-weight: 900 !important;"> Login </p>
         <span id="cred_error"></span>
         
          <input type="hidden" name="role_id" value="3">
          <div class="input-group" style="margin-bottom:8px;">
            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
            {!! Form::text('email', old('email') , ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),'placeholder'=>'User name OR Email', 'style'=>'border-radius: 0px 5px 5px 0px;' ]) !!}
            <span class="invalid-feedback" id="log-in-email" role="alert"></span>
          </div>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
            <input type="password" class="form-control password" name="password" required placeholder="Password" style="border-radius: 0px 5px 5px 0px;">
            <i title="Show Password" class="fa fa-eye-slash show-pass" aria-hidden="true"></i>
            <span class="invalid-feedback" id="password" role="alert"></span>
          </div>
          <div class="row">
            <div class="col-sm-7 col-md-7 col-xs-7 no-padding-right">
              <div class="fom-inline">
                <div class="checkbox">
                  <label style="font-size:12px;">
                    {!! Form::checkbox('remember', old('remember') , ['class' => 'form-check-input' ]) !!} Remember Password</label>
                  </div>
                </div>
              </div>
              <div class="col-sm-5 col-md-5 col-xs-5 no-padding">
                <div class="fom-inline">
                  <div class="checkbox">
                    <a class="fgpass" href="javascript:void(0)" onclick="openForgetPasswordModal();">
                      {{ __('Forgot Password?') }}
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div  class="col-sm-12">
                <div class="midle_button">
                  <button class="btn btn-danger  login-button" type="submit" id="login-button" style="width: 100%;">LOG IN</button>
                </div>
       
              </div>
              <div class="col-sm-12" id='loader' style='display: none;'>
                <button  class="btn btn-primary" type="button" disabled >
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  Just a sec
                </button>
              </div>
            </div>
            <div class="">
              <p class="text-center  btn-sm" style="color:#151829;">Sign In with</p>
              <div class="col-sm-12">
                <div class="facebook_icon">
                  <div class="social_links">
                    <a href="{{ url('login/linkedin') }}" >
                    <i class="fa fa-linkedin" aria-hidden="true"></i></a>
                  </div>
                  <div class="social_links">
                    <a href="{{ url('login/facebook') }}">
                    <i class="fa fa-facebook" aria-hidden="true"></i></a>
                  </div>
                  
               
                </div>
              </div>
            
            </div>
            
          </div>

          <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center" style="  background-image: url('assets/images/news-21.png');
          z-index: inherit;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            width: 100%;
            height: 60vh;">

            <button  class="close desk-cls" data-dismiss="modal" type="button">X</button>
     <!-- login-back-img1-->
  </div>
</div>
</div>
</div>
</form>
</div>
</div>


<div id="forgotPasswordModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
 <div class="modal-dialog modal-forgot">
  <!-- Modal content-->
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">X</button>
    <p class="modal-title fgpass-tit">Forgot password</p>
  </div>
  <div class="modal-body">
    <div class="well">
     <form>
      <div class="form-group">
       <label class="control-label col-sm-2 offset-2">Email:</label>
       <div class="col-sm-7">
        <input type="email" class="form-control" id="forget_email" name="email" placeholder="enter email address">
      </div>
    </div>
    <div class="text-center">
     <button type="button" class="btn btn-danger" onclick="forgotPassword();">Submit</button>
   </div>
 </form>
 <br>
</div>
</div>
</div>
</div>
</div>
@if(!empty(Auth::check()))
<div id="profile-imageModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p class="modal-title">Change Profile Picture</p>
      </div>
      <div class="modal-body">

       @if(Auth::user()->profile_pic !='' && file_exists(Auth::user()->profile_pic))
       @php $profileImage = Auth::user()->profile_pic @endphp
       @else
       @php $profileImage = 'assets/images/seller/b-acount.png' @endphp
       @endif

       <img  loading="lazy" decoding="async" id="profile-image" src="{{asset($profileImage)}}" alt="profile image">
       <span id="image-error" class="text-danger"></span>
       <form method="post" id="upload_form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
         <label>Upload Profile Picture <i class="text-p"><span class="text-danger">(jpeg,jpg,png)</span></i></label>
         <div class="file-upload">
          <div class="file-select">
           <div class="file-select-button" id="fileName2">Browse</div>
           <div class="file-select-name" id="noFile2">No file selected</div>
           {!! Form::file('profile_pic', ['id' => 'profile_pic']) !!}
         </div>
       </div>
       {!! $errors->first('profile_pic', '<span class="alert alert-danger" role="alert">:message</span>') !!}
     </div>
     <input type="submit" name="submit" value="save" class="pi-btn">
   </form>
 </div>
</div>
</div>
</div>
@endif
@php $routeSegment= Request::segment(1); @endphp

@if(!empty(Auth::check()) && $routeSegment =='buyer')
<div class="modal fade trophy-mod myModal-share" id="account_change_modal" role="dialog" data-keyboard="false" data-backdrop="static">
 <div class="modal-dialog">
  <div class="modal-content buyer-form">
   <div class="modal-header">

    <p class="modal-title">FutureStarr - Account Confirmation</p>
  </div>
  <div class="modal-body">
    All the information related to buyer and seller account.
  </div>
  <div class="modal-footer sec-btn">
   <a href="javascript:void(0)" onclick="openNextTab()">Next</a>
 </div>
</div>

</div>
</div>

<div class="modal fade trophy-mod myModal-share" id="account_change_modal1" role="dialog" data-keyboard="false" data-backdrop="static">
 <div class="modal-dialog">
  <div class="modal-content buyer-form">
   <div class="modal-header">
    <p class="modal-title">FutureStarr - Account Confirmation</p>
  </div>
  <div class="modal-body">
    Would you like to continue with buyer account or seller?
    Please check an account to continue the service with FutureStarr.
    <div class="share-link-modal">
     <ul>
      <li>
       <a data-id="3" data-name="buyer" class="change_account"><i class="fa fa-user" aria-hidden="true"></i> Buyer</a>
     </li>
     <li>
       <a data-id="4" data-name="seller" class="change_account"><i class="fa fa-address-book" aria-hidden="true"></i> Seller</a>
     </li>
   </ul>
 </div>
</div>
<div class="modal-footer sec-btn">
 <a href="javascript:void(0)" onclick="openPrevousTab()">Prevous</a>
 <a href="{{route('home')}}">Explore Futurestarr</a>
</div>
</div>

</div>
</div>
@endif
<div class="modal fade trophy-mod myModal-share" id="information_modal" role="dialog" data-keyboard="false" data-backdrop="static">
 <div class="modal-dialog">
   <div class="modal-content buyer-form">
     <div class="modal-header">

      <p class="modal-title">Create Page Information</p>
    </div>
    <div class="modal-body">
      <p><strong style="font-size:20px !important;"> To use this feature please register as Seller.</strong></p>
      <p>Already have seller account.Login using seller details.</p>
    </div>
    <div class="modal-footer sec-btn">
      <a href="javascript:void(0)" data-dismiss="modal">Cancel</a>
    </div>
  </div>

</div>
</div>

<div class="container">
 <!-- Modal -->
 <div id="register_my_model" class="modal  modal-m pop" role="dialog">
  <div class="modal-dialog">
   <!-- Modal content-->
   <div class="modal-content">
    <div class="modal-header mob-cls">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body">
     <div class="row">
      <div class="col-sm-5 text-center login-back">
       <p class="mo-sign-awe">
        Awe, looks like you have not
      </p><br>
      <p class="mo-sign-fr">signed up for Future Starr.</p>
      <p class="mo-now"><b>No worries, click the Register</b></p>
      <p class="mo-now-fr"><b>button and sign up now for FREE!</b></p>

      <a href="{{route('register')}}" class="btn btn-danger reg-mod" >Register</a>
      <div class="text-center aha">
        <span> Already have account? <a href="javascript:void(0)" class="cursor-pointer lohere" onclick="openLoginModal();" >login here</a>
        </span>
      </div>
    </div>
    <!--login-back-img-->
    <div class="col-sm-7 text-center"   style=" background-image: url('images/new_pop_up.jpg?378eebde1ad57f35063a5341b5456ae4');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 394px; 
    width: 100%; ">
     <button type="button" class="close desk-cls" data-dismiss="modal">&times;</button>
     <br><br><br><br><br><br>
     <p class="closer-dataa"></p>
     
     <p class="closer-datac"></p>
     <br><br>  <br><br><br><br><br>
   </div>
 </div>
</div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="seller-dashboard-award-modal" role="dialog" data-keyboard="false" data-backdrop="static">
 <div class="modal-dialog">
  @php $userId = !empty(Auth::user()->id)?Auth::user()->id:''; @endphp
  <div class="modal-content buyer-form">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <p class="pull-right">
      <i class="fa fa-trophy bftro"></i>
      <span>({{getSellerTalentAward($userId) }})</span>&nbsp;Awards
    </p>
    <p class="modal-title">Awards</p>
  </div>
  <div class="modal-body bfmb">
   @php $awards = getSellerTalentAwardPopUpModal($userId) @endphp
   @if(!empty($awards))
   @foreach($awards as $value)
   <div class="pop-content">
    @if(!empty($value->getUsers['profile_pic']) && file_exists($value->getUsers['profile_pic']))
      <img  loading="lazy" decoding="async" class="circular img-40" src="{{ asset($value->getUsers['profile_pic'])}}" alt="profile pic">
      <div class="content-sec-pop">
      <p>{{$value->getUsers['username']}}</p>
      </div>
     @elseif(empty($value->getUsers['profile_pic']))
      <img  loading="lazy" decoding="async" class="circular img-40" src="{{asset('assets/images/profile.png')}}" alt="profile image">
      <div class="content-sec-pop">
        <p> {{Auth::user()->first_name}}&nbsp;{{Auth::user()->last_name}}</p>
        </div>
     @endif

    
   
   
   </div>
   @endforeach
  @else

 <p>No awards yet!</p>

 @endif
</div>

</div>

</div>
</div>

@include('layouts.talent.video_audio_callingview')



   

