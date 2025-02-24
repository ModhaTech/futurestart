@extends('layouts.talent') @section('content')
<!-- banner start -->
<section class="wow fadeIn cover-background buyer-banner-sec socail-buzz background-position-top top-space" style="background-image:url({{ asset('assets/images/buyer/buyer-banner.png')}});">
 <div class="bg-extra-dark-gray"></div>
 <div class="container">
  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">
    <div class="display-table-cell vertical-align-middle banner-heading text-center padding-30px-tb">
     <!--start page title -->
      <h2 class="text-white">Seller</h2> 
        <span class="display-block text-white opacity6 alt-font">
              Change Password</span>
              <!-- end sub title -->
          </div>
      </div>
  </div>
</div>
</section>

<!--SideBar-Start---->
  <section class="buyer-con-section">
  <div class="container">
     <div class="row">
         <div class="col-md-6">
          
        </div>
        <div class="col-md-6">
          <a href="{{route('seller.index')}}" class="pull-right back-btn seller-graph-back-btn"  title="Go Back"><i class="ti-arrow-left" aria-hidden="true"></i></a>
        </div>
   </div>
    <div class="row">
    @include('frontend.sidebar.seller')
      <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="myElem"></div>
        <div class="buyer-form">
          <h4>Change Password</h4>
          <form>
            @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-sec">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <h3>Current Password:</h3>
                    <div class="form-group">
                      <input required="" id="current_password" type="password" class="form-control" name="current_password">
                      <span>
                        <strong></strong>
                      </span>
                      @if ($errors->has('current_password'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('current_password') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>

                   <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <h3>Password:</h3>
                    <div class="form-group">
                      <input required="" id="new_password" type="password" class="form-control" placeholder="" name="new_password">
                      @if ($errors->has('new_password'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('new_password') }}</strong>
                          </span>
                      @endif
                       <span>
                        <strong></strong>
                      </span>
                    </div>
                  </div>

                   <div class="col-md-12 col-sm-12 col-xs-12 form-list">
                    <h3>Password Confirm:</h3>
                    <div class="form-group">
                      <input required="" id="password_confirmation" type="password" class="form-control" placeholder="" name="password_confirmation">
                      @if ($errors->has('password_confirmation'))
                         <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                          </span>
                      @endif
                       <span>
                        <strong></strong>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="sec-btn">
            <button class="btn-submit" type="submit">Save</button>
            <a href="{{ route('seller.index')}}">Cancel</a>
          </div>
        </form>
        </div>
      </div>
    </div>
</section>

<style type="text/css">
  .myElem .change_password_div
  {
    padding: 20px;
    background: #dc3545!important;
    position: absolute;
    z-index: 100000;
    position: fixed;
    top: 72px;
    width: 300px;
    right: 10px;
    border-radius: 10px;
    opacity:0.8;
  }
  .myElem .change_password_div p
  {
    color: white!important;
    font-size: 16px!important;
    font-weight: 700!important;
  }
</style>
@include('frontend.talent.login')
<a class="scroll-top-arrow" href="javascript:void(0);" style="display:none;"><i  class="ti-arrow-up"></i></a>

<script type="text/javascript">

    $(".btn-submit").click(function(e)
    {

      e.preventDefault();
      var current_password = $("#current_password").val();
      var new_password = $("#new_password").val();
      var password_confirmation = $("#password_confirmation").val();
      if ($('#current_password').val() === '') {
            $(".myElem").show();
            $(".myElem").html("<div class='change_password_div' style='background: #dc3545!important;'><p>Current Password field is required.</p><div/>")
            setTimeout(function() { $(".myElem").hide(); }, 10000);
            return;
        }
      if ($('#new_password').val() === '') {
            $(".myElem").show();
            $(".myElem").html("<div class='change_password_div' style='background: #dc3545!important;'><p>New Password field is required.</p><div/>")
            setTimeout(function() { $(".myElem").hide(); }, 10000);
            return;
        }
        if ($('#password_confirmation').val() === '') {
            $(".myElem").show();
            $(".myElem").html("<div class='change_password_div' style='background: #dc3545!important;'><p>Password Confirmation field is required.</p><div/>")
            setTimeout(function() { $(".myElem").hide(); }, 10000);
            return;
        }
      else
      {
        if (new_password != password_confirmation) 
        {
              $(".myElem").show();
              $(".myElem").html("<div class='change_password_div' style='background: #dc3545!important;'><p>Passwords does not match</p><div/>")
            setTimeout(function() { $(".myElem").hide(); }, 10000);
            return;
        }
        else
        {
         $.ajax({
                url: '{!! route('seller.setPassword') !!}',
                type: 'POST',
                data: {
                        "_token": "{{ csrf_token() }}",
                        "current_password": current_password,
                        "new_password": new_password,
                        "password_confirmation":password_confirmation
                       },
                     success: function(response) 
                     {
                      if (response.status == 201) 
                      {
                        
                        $(".myElem").html("<div class='change_password_div' style='background: #cc3300!important;'><p>"+response.message+"</p><div/>")
                      }
                      else if(response.status == 202)
                      {
                        
                        $(".myElem").html("<div class='change_password_div' style='background: #dc3545!important;'><p>"+response.message+"</p><div/>")
                        
                      }
                      else if(response.status == 200)
                      {
                       
                        $(".myElem").html("<div class='change_password_div' style='background: #28a745!important;'><p>"+response.message+"</p><div/>")
                       
                      }
                        $(".myElem").show();
                        setTimeout(function() { $(".myElem").hide(); }, 10000);
                        console.log('Change Password',response);
                     },
                     error:function(error) 
                     {
                        console.log('error', error);
                     }
          });
        }
      }
    });
</script>
@endsection
  
  
  <!--SideBar-End---->