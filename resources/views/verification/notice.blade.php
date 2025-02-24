@extends('layouts.talent')



@section('content')



<!-- banner start -->

<section class="wow fadeIn cover-background background-position-top top-space talent-mall" style="background-image:url({{ asset('assets/images/talent-mall.png')}});">

  <div class="opacity-medium bg-extra-dark-gray"></div>

  <div class="container">

    <div class="row">

      <div class="col-md-12 col-sm-12 col-xs-12 display-table page-title-large">

        <div class="display-table-cell vertical-align-middle text-center padding-30px-tb">

          <!-- start page title -->

          <h1 class="alt-font text-white font-weight-600 mb-2">Email Verification Mail</h1>

          <!-- end page title -->

          <!-- start sub title -->

          <span class="display-block text-white opacity6 alt-font">

          Please verify your email with below link:</span>

          <!-- end sub title -->

        </div>

      </div>

    </div>

  </div>

</section>

<!-- End banner  -->

<!-- Start Content  -->

    <div class="bg-light p-5 rounded">

        

        @if (session('resent'))

            <div style="text-align:center;background-color:#00800038;    font-size: 16px;padding:8px;" class="alert alert-success" role="alert">

                A fresh verification link has been sent to your email address.

            </div>

        @endif

        

        <h5 style="text-align:center;font-size:20px;padding-top:80px;" class="alt-font font-weight-700 text-extra-dark-gray">Before proceeding, please check your email for a verification link. If you did not receive the email,</h5>

        

        <form style="text-align:center;margin-bottom:80px;" action="{{ route('verification.resend') }}" method="POST" class="d-inline">

            @csrf

            <button style="font-size:12px; color:#223887; border-bottom:1px solid #223887;" type="submit" class="d-inline btn btn-link p-0">

                click here to request another

            </button>.

        </form>

    </div>

@endsection