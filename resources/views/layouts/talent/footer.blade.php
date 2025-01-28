<!--chat-module-->
@if(!empty(Auth::check()) && Auth::user()->role_id != '1')

<div style="display:block;" style="" class="round hollow text-center" id="open-chat-window">
   <a href="javascript:void(0);"> 
      <img loading="lazy" decoding="async" alt="profileImage" src="{{ !empty(Auth::user()->profile_pic) && file_exists(Auth::user()->profile_pic) ? asset(Auth::user()->profile_pic): asset('assets/images/star-logo.png') }}">
      <span>
        <i class="fa fa-star text-success" aria-hidden="true"></i>
      </span>
   </a>
</div>

@include('chat-module')

@include('chat-box')

@endif
<!-- chat box code-->

<!--footer-->
<footer style="background-color:#151829;">
  <div class=" container footer-s">
    <div class="row footer foot">

      <div class="col-sm-3">
        <h4 class="footer-s">Quick Links</h4>
        <p><a href="/">Home</a></p>
        <p><a href="{{ route('about-us') }}">About Us</a></p>
        <p><a href="{{ route('search.index') }}">Starr Search</a></p>
        <p><a href="{{ route('talent.index') }}">Talent Mall</a></p>
        <p><a href="{{ route('blog.index') }}">Blog</a></p>
        <p><a href="{{ route('contact-us.index') }}" style="color:#777;font-size:13px;">Contact Us</a></p>
      </div>

      <div class="col-sm-3">
        <h4 class="footer-s">Terms & Privacy</h4>
        <p><a href="{{ route('privacy-policy') }}">Privacy Policy</a></p>
        <p><a href="{{ route('term-conditions') }}">Terms and Conditions</a></p>
        <p><a href="{{ route('refund-policy') }}">Refund Policy</a></p>
      </div>

      <div class="footer-s col-sm-3">
        <h4>Contact us</h4>
          @php $site_config = site_config(); @endphp
           <p class="text-medium m-0">Phone: <a href="tel:{{ $site_config->contact_number }}">{{ $site_config->contact_number }}</a></p>
          <p>{!!  $site_config->address !!}</p>
      </div>

      <div class="col-sm-3">
        <h4 class="footer-s">Connect with Us</h4>
        <div class="footer-box">
          <ul class="social-icon">
            <li>
              <a data-toggle="tooltip" title="Facebook" href="{{ $site_config->facebook }}" target="_blank"><i
                  class="fa fa-facebook"></i></a>
            </li>
            <li>
              <a data-toggle="tooltip" title="Twitter" href="{{ $site_config->twitter }}" target="_blank"><i
                  class="fa fa-twitter"></i></a>
              </li>
            <li>
              <a data-toggle="tooltip" title="LinkedIn" href="{{ $site_config->linkedin }}" target="_blank"><i
                  class="fa fa-linkedin"></i></a>
            </li>
            <li>
              <a data-toggle="tooltip" title="News Feeds" href="https://feeds.feedburner.com/futurestarr/KCicQxJTEqv" target="_blank"><i
                  class="fa fa-rss"></i></a>
            </li>
            <li><a href="https://play.google.com/store/apps/details?id=com.futurestarrmarketplace&pli=1" target="_blank"><img loading="lazy" decoding="async"  alt="FutureStarr App" title="FutureStarr App" style="width: 70%;margin-top: 20px;" src="{{ asset ('assets/footer/google-play.png') }}" ></a></li>
          </ul>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-12 footer-m">
        <p style="">© {{date('Y')}}, Future Starr Media LLC, All Rights Reserved</p>
      </div>
    </div>
  </div>
</footer>

<script>
   <?php if(Session::has('success')) { ?>
     toastr.success("<?php echo Session::get('success') ?>","");
   <?php } else if(Session::has('error')) { ?>
     toastr.error("<?php echo Session::get('error') ?>");
   <?php } else if(Session::has('warning')) { ?>
     toastr.warning("<?php echo Session::get('warning') ?>");
   <?php } else if(Session::has('info')) { ?>
     toastr.info("<?php echo Session::get('info') ?>");
   <?php }?>
</script> 




@if(Auth::user() && Auth::user()->role_id =='3')
<script>
  jQuery(document).ready(function()
 {
      var url = '{!! route('buyer.checkUserlogin') !!}';
      jQuery.ajax({
        type: "GET",
        url: url,
        data: { "_token": "{{ csrf_token() }}" },
        success: function(response)
        {
          
          if(response.checkUserlogin != null) 
          {
            jQuery("#account_change_modal").modal('show');
          }
        },
        error: function(data)
        {
          if(data) 
          {
            toastr.error('Bad Request.');
          }
        }
      });
  });

</script>
@endif


<script defer  src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script defer  src="{{ asset('assets/js/wow.min.js')}}" ></script>
<!--<script defer  src="https://futurestarr.b-cdn.net/wow.min.js" ></script>-->
<script defer  src="{{ asset('assets/js/owl.carousel.min.js')}}"></script>
<script defer  src="{{ asset('assets/lightbox.js')}}"></script>
<script defer  src="{{ asset('assets/prod/js/main.min.js')}}"></script>
<!--<script defer  src="https://futurestarr.b-cdn.net/main.min.js"></script>-->
<script defer  src="{{ asset('assets/js/more_scripts.js')}}"></script>
<!--<script defer  src="https://futurestarr.b-cdn.net/more_scripts.js"></script>-->




