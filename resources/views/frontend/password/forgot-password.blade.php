@extends('layouts.talent') 
@section('content')

<style type="text/css">
  i.show-pass-con {
    position: absolute;
    top: 61%;
    right: 15%;
    cursor: pointer;
}

i.show-pass {
    position: absolute;
    top: 37%;
    right: 15%;
    cursor: pointer;
}
</style>

<div class="container-fluid" style="background-image:url({{ asset('assets/images/header-bg.jpg')}});background-size:cover;">
  <div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
      <h3 class="text-center " style="color:#fff;margin-top: 111px;line-height:44px;">Reset your FutureStarr password</h3>
    </div>
    <div class="col-sm-2"></div>
  </div>
  <br><br>
</div>
<div class="container">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
    <div class="well panel panel-danger" style="margin:20px;">
      <h1>Reset Password</h1>
      <div class="panel-body">

        <form method="POST" action="{{route('password.update11')}}">
          @csrf
          <div class="form-group">
            <label for="email">Password</label>
            <input type="password" class="form-control password" name="password" required placeholder="Password">
            <i title="Show Password" class="fa fa-eye-slash show-pass" aria-hidden="true"></i>
            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @else
            <span class="invalid-feedback password_error" role="alert">
                <strong></strong>
            </span>
            @endif
          </div>
          <div class="form-group">
            <label for="pwd">Confirm Password</label>
            <input type="password" class="form-control password_confirmation" name="password_confirmation" required placeholder="Confirm Password">
            <i title="Show Password" class="fa fa-eye-slash show-pass-con" aria-hidden="true"></i>
            <span class="invalid-feedback password_confirmation_error" role="alert">
                <strong></strong>
            </span>
          </div>
          <input type="hidden" name="token" value="{{ Request::segment(2) }}">
          <button type="submit" class="btn btn-danger main-button">Submit</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-sm-3"></div>
</div>

<script type="text/javascript">
      $(".show-pass").on("click", function(){
        if($(this).hasClass("fa-eye-slash"))
        {
            $(this).removeClass("fa-eye-slash");
            $(this).addClass("fa-eye");
            $(this).attr("title", "Hide Password");
            $(".password").attr("type", "text");
        }else{
            $(this).addClass("fa-eye-slash");
            $(this).removeClass("fa-eye");
            $(this).attr("title", "Show Password");
            $(".password").attr("type", "password");
        }
    });

  $(".show-pass-con").on("click", function(){
        if($(this).hasClass("fa-eye-slash"))
        {
            $(this).removeClass("fa-eye-slash");
            $(this).addClass("fa-eye");
            $(this).attr("title", "Hide Password");
            $(".password_confirmation").attr("type", "text");
        }else{
            $(this).addClass("fa-eye-slash");
            $(this).removeClass("fa-eye");
            $(this).attr("title", "Show Password");
            $(".password_confirmation").attr("type", "password");
        }
    });

  $('.password').keyup(function() 
    {
        if($(this).val() == '') 
         {
            $(".password_error strong").text('The password field is required.');

         }
         else
         {
             $(".password_error strong").text('');
             var $th = $(this);
             $th.val( $th.val().replace(/[^a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g, function(str) 
              {
                $(".password_error strong").text('Please use only letters and special characters.');
              }))

             if ($(this).val().indexOf('undefined') !== -1) 
             {
                var newVal = $(this).val().replace('undefined', '');
                $(this).val(newVal);
             }
         }

    });

    $('.password_confirmation').keyup(function() 
    {
        if($(this).val() == '') 
         {
            $(".password_confirmation_error strong").text('The password confirmation field is required.');

         }
         else
         {
             $(".password_confirmation_error strong").text('');
             var $th = $(this);
             $th.val( $th.val().replace(/[^a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g, function(str) 
              {
                $(".password_confirmation_error strong").text('Please use only letters and special characters.');
              }))

             if ($(this).val().indexOf('undefined') !== -1) 
             {
                var newVal = $(this).val().replace('undefined', '');
                $(this).val(newVal);
             }
         }

    });
</script>
@endsection
