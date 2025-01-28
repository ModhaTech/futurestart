@extends('layouts.talent') @section('content')
<!-- banner start -->
<section class="wow fadeIn contact-sec-n cover-background background-position-top" style="background-image:url({{ asset('assets/images/homepage-5-slider-img-2.jpg')}});">
  <div class="opacity-medium bg-extra-dark-gray"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
        <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">
          <!-- start page title -->
          <h1 class="alt-font text-white font-weight-600 mb-2">Contact Page- Questions Form</h1>
          <!-- end page title -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End banner  -->
<!-- start contact section -->
@php $site_config = site_config() @endphp
<section class="no-padding bg-extra-dark-gray search-content-sec">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 col-lg-6 col p-0 cover-background wow fadeInLeft" style="background-image:url({{ asset('assets/images/contact-img2.jpg')}});"></div>
      <div class="col-md-4 col-lg-6 col p-0 wow fadeInRight text-center">
        <div class="row no-gutters">
          <!-- start contact item -->
          <div class="col-lg-6 bg-extra-dark-gray p-5 p-md-4 p-lg-5">
            <i class="icon-map text-deep-pink icon-medium margin-25px-bottom"></i>
            <div class="text-white text-uppercase alt-font font-weight-600 margin-5px-bottom">Contact Address</div>
            <p class="text-medium mb-0">{!!  strip_tags($site_config->address) !!}</p>
          </div>
          <!-- end contact item -->
          <!-- start contact item -->
          <div class="col-lg-6 bg-black p-5 p-md-4 p-lg-5">
            <i class="icon-chat text-deep-pink icon-medium margin-25px-bottom"></i>
            <div class="text-white text-uppercase alt-font font-weight-600 margin-5px-bottom">Let's Talk</div>
            <p class="text-medium m-0">Phone: <a href="tel:{{ $site_config->contact_number }}">{{ $site_config->contact_number }}</a></p>
          </div>
          <!-- end contact item -->
          <!-- start contact item -->
          <!-- <div class="col-lg-6 bg-black p-5 p-md-4 p-lg-5">
            <i class="icon-envelope text-deep-pink icon-medium margin-25px-bottom"></i>
            <div class="text-white text-uppercase alt-font font-weight-600 margin-5px-bottom">Email Us</div>
            <p class="text-medium mb-0"><a href="mailto:{{ $site_config->email }}">{{ $site_config->email }}</a></p>
          </div> -->
          <!-- end contact item -->
          <!-- start contact item -->
          <div class="col-lg-12 bg-extra-dark-gray p-5 p-md-4 p-lg-5">
            <i class="icon-clock text-deep-pink icon-medium margin-25px-bottom"></i>
            <div class="text-white text-uppercase alt-font font-weight-600 margin-5px-bottom">Working Hours</div>
            <p class="text-medium m-0" style="text-align: center!important;">{{ $site_config->work_hours_weekdays }}</p>
            <p class="text-medium mb-0" style="text-align: center!important;">{{ $site_config->work_hours_weekends }}</p>
          </div>
          <!-- end contact item -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end contact section -->

<!-- start form section -->
<section class="wow fadeIn" id="start-your-project">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-10 col-lg-8 text-center mb-4">
              <h5 class="alt-font font-weight-700 text-extra-dark-gray text-uppercase">tell us about your project</h5>
              <p>Our friendly team can be reached Monday through Friday, from 9 am to 6 pm, Eastern time, Just fill out the contact form and click the button 
below to contact us.</p><br>
              <h5 class="alt-font font-weight-700 text-extra-dark-gray text-uppercase">Make Money from Your Hobby with Future Starr | Contact Page</h5>
              <p>If you have ever thought of making money from your hobby, you can do it by contacting FutureStarr.com!</p><br>
              <h5 class="alt-font font-weight-700 text-extra-dark-gray text-uppercase">Online platform</h5>
              <p>This online platform allows you to sell your digital products or show off your talent. It is an easy and convenient way to showcase your talents and earn money. If you have any questions, contact the company through our customer support. They will respond to your inquiry as soon as possible. </p><br>
            <h5 class="alt-font font-weight-700 text-extra-dark-gray text-uppercase">Contact</h5>
            <p>You can also contact the company via home page by using their live chat help section. Our friendly team can be reached Monday through Friday, from 9 am to 6 pm, Eastern time. Fill out the contact page – questions form and click the button below to contact us.</p><br>
          </div>  
      </div>
      <form id="project-contact-form" method="POST" action="{{route('contact-us.store')}}" name="myForm" onsubmit="return validateForm()">
        @csrf
          <div class="row">
               <div class="col-md-12">
                  <div id="success-project-contact-form" class="no-margin-lr"></div>
              </div>
              <div class="col-md-4">
                  <input type="text" name="name" id="name" required pattern="[a-zA-Z ]*" placeholder="Name *" class="big-input @error('name') is-invalid @enderror">
                   @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    <span class="invalid-feedback name_error" role="alert">
                        <strong></strong>
                    </span>
              </div>
              <div class="col-md-4">
                  <input type="text" name="phone" id="phone" placeholder="Phone *" pattern="^[0-9]*$" class="big-input @error('phone') is-invalid @enderror" required>
                   @error('phone')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                   @enderror 
                   <span class="invalid-feedback phone_error" role="alert">
                        <strong></strong>
                    </span>

              </div>
              <div class="col-md-4">
                  <input type="text" name="email" id="email" required pattern="([a-zA-Z0-9\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA])+$" placeholder="E-mail *" class="big-input @error('email') is-invalid @enderror">
                   @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    <span class="invalid-feedback email_error" role="alert">
                        <strong></strong>
                    </span>
              </div>
              <div class="col-md-12">
                  <textarea name="message" id="message" placeholder="Describe your project *" rows="6" class="big-textarea @error('message') is-invalid @enderror" required></textarea>
                   @error('message')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    <span class="invalid-feedback message_error" role="alert">
                        <strong></strong>
                    </span>
              </div>
              <div>
                <span id="email-error"></span>
              </div>
              <div class="col-sm-offset-4 col-sm-4 col-xs-12">
                    <input type="hidden" name="mng-cap" class="captcha-recall-assign" value="iWaIHO">
                    <div class="form-group cap-box">
                    <p class="cap-text-string"></p>
                    <input class="form-control captcha-recall" placeholder="Write Captcha" name="cap" type="text">
                    </div>
                    <span id="error"></span>
                </div>             
              <div class="col-md-12 text-center">
                  <button id="project-contact-us-button" type="submit" class="btn btn-transparent-dark-gray btn-large margin-20px-top">send message</button>
              </div>
          </div>
      </form><br/><br/><br/><br/>

      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3312.5531132979972!2d-84.38015228530566!3d33.87540613447669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88f50f16871a7025%3A0xa40666ac7a7007bf!2s285%20W%20Wieuca%20Rd%20NE%2C%20Atlanta%2C%20GA%2030342%2C%20USA!5e0!3m2!1sen!2sin!4v1623160637798!5m2!1sen!2sin" height="400" width="100%" style="border:0;" allowfullscreen="" ></iframe>

	  
  </div>
</section>

<!-- end form section -->
<section class="wow fadeIn bg-light-gray">
  <div class="container">
      <div class="row">
          <div class="col-md-12 text-center social-style-4">
              <span class="text-medium font-weight-600 text-uppercase display-block alt-font text-extra-dark-gray margin-30px-bottom">On social networks</span>
              <div class="social-icon-style-4">
                  <ul class="margin-30px-top large-icon">
                      <li><a class="facebook" href="https://www.facebook.com/FutureStarrcom/" target="_blank"><i class="fa fa-facebook"></i><span></span></a></li>
                      <li><a class="twitter" href="https://twitter.com/futurestarrcom?lang=en/" target="_blank"><i class="fa fa-twitter"></i><span></span></a></li>
                      <!-- <li><a class="google" href="javascript:void(0);"><i class="fa fa-google"></i><span></span></a></li> -->
                      <li><a class="instagram" href="https://www.instagram.com/futurestarrmediallc" target="_blank"><i class="fa fa-instagram"></i><span></span></a></li>
                      <li><a class="linkedin" href="https://www.linkedin.com/in/futurestarr/" target="_blank"><i class="fa fa-linkedin "></i><span></span></a></li>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>  
<a class="scroll-top-arrow" href="javascript:void(0);" style="display: inline;"><i  class="ti-arrow-up"></i></a>
@endsection
@section('javascript')
<script type="text/javascript">
  $('input[name="phone"]').keyup(function(e) {
  if (/\D/g.test(this.value)) {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
    toastr.error('','Only digit values are allowed in phone field.');
  }
});

// function validateForm() {
//   if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myForm.email.value))
//   {
//   }else{
//     // var erroremail = document.getElementById("email-error");
//     // erroremail.textContent = "You have entered an invalid email address"
//     // erroremail.style.color = "red"
//     toastr.error('','You have entered an invalid email address');
//     // setTimeout(function(){
//     //   erroremail.remove();
//     // }, 5000);
//     return false;
//   }
//   let x = document.forms["myForm"]["mng-cap"].value;
//   let y = document.forms["myForm"]["cap"].value;
//   if (x !== y) {
//     // var error = document.getElementById("error");
//     // error.textContent = "Please enter a valid captcha"
//     // error.style.color = "red"
//     toastr.error('','Please enter a valid captcha');
//     return false;
//   }
// }

// $('#name').keyup(function() 
//     {
//         if($(this).val() == '') 
//          {
//             $(".name_error strong").text('The name field is required.');

//          }
//          else
//          {
//              $(".name_error strong").text('');
//              var $th = $(this);
//              $th.val( $th.val().replace(/[^a-zA-Z0-9]/g, function(str) 
//               {
                
//               }))

//              if ($(this).val().indexOf('undefined') == 0) 
//              {
//                 var newVal = $(this).val().replace('undefined', '');
//                 $(this).val(newVal);
//                 $(".name_error strong").text("Please don't start with blank space and special characters.");
//              }else{
//                 var newVal = $(this).val().replaceAll('undefined', ' ');
//                 $(this).val(newVal);
//              }
//          }

//     });

// $('#phone').keyup(function() 
//     {
//         if($(this).val() == '') 
//          {
//             $(".phone_error strong").text('The phone field is required.');

//          }
//          else
//          {
//              $(".phone_error strong").text('');
//              var $th = $(this);
//              $th.val( $th.val().replace(/[^a-zA-Z0-9]/g, function(str) 
//               {
//                 $(".phone_error strong").text('Please use only letters.');
//               }))

//              if ($(this).val().indexOf('undefined') !== -1) 
//              {
//                 var newVal = $(this).val().replace('undefined', '');
//                 $(this).val(newVal);
//              }
//          }

//     });

// $('#message').keyup(function() 
//     {
//         if($(this).val() == '') 
//          {
//             $(".message_error strong").text('The message field is required.');

//          }
//          else
//          {
//              $(".message_error strong").text('');
//              var $th = $(this);
//              $th.val( $th.val().replace(/[^a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g, function(str) 
//               {
                
//               }))
             
//              if ($(this).val().indexOf('undefined') == 0) 
//              {
//                 var newVal = $(this).val().replace('undefined', '');
//                 $(this).val(newVal);
//                 $(".message_error strong").text("Please don't start with blank space.");
//              }else{
//                 var newVal = $(this).val().replaceAll('undefined', ' ');
//                 $(this).val(newVal);
//              }
//          }

//     });

</script>
@stop