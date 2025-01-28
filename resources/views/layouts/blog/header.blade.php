<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Future Starr Admin | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="site-url" content="{{ url('/') }}">
  <!-- Font Awesome -->
  <!-- Font Awesome -->

  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Overpass" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jsgrid/jsgrid.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jsgrid/jsgrid-theme.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/croppie.css')}}">
  <style type="text/css">

    .invalid-feedback {
       display: block !important;
    }

    .active{
      margin-top:0px !important;
    }

  </style>
  <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">
  @yield('admin_page_head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <!-- <div id="preloader"></div> -->
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

      </li>
      <li class="nav-item">
         <div class="header-icon he-ic">
                 @if(!empty(Auth::user()->profile_pic) && file_exists(Auth::user()->profile_pic))
                 <span style="color:white;">{{ Auth::user()->username}}</span>&nbsp;&nbsp;
                 <img class="fa-icon-font" src="{{asset(Auth::user()->profile_pic)}}" alt="star icon" style="border-radius: 50%; height: 45px; padding: 0px 0px 0px 0;object-fit: cover;">
                 @else
                 <img class="fa-icon-font" src="{{asset('assets/images/home/starr_s.png')}}" alt="starsearch icon">
                 @endif
               </div>
        <!-- <a class="nav-link"  href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
          {{Auth::user()->username}} &nbsp;&nbsp; <img src="{{ asset(Auth::user()->profile_pic) }}" alt="Admin Logo">
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
           @csrf
         </form>
       </a> -->
     </li>
   </ul>
 </nav>
 <!-- /.navbar -->

 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link logo">
    <img src="{{ asset('assets/admin/dist/img/futurelogo.png') }}" alt="Admin Logo" class="img-responsive center-block">
    <span class=""></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      
    </nav>
      <!-- /.sidebar-menu -->
  </div>
    <!-- /.sidebar -->
  </aside>
