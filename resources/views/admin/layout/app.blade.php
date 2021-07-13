<?php
$curtimestamp = time();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('online_user/vendor/bootstrap/css/bootstrap.min.css') }}">
	  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="{{ asset('online_user/css/fontastic.css') }}">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <!-- Custom Scrollbar-->
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('online_user/css/style.default.css?v=0.001') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('online_user/css/custom.css?v='.$curtimestamp) }}">
    <!-- Favicon-->
	  <link rel="shortcut icon" href="{{ asset('login_css/images/logo-Trans.png') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	  <script src="{{ asset('online_user/vendor/jquery/jquery.min.js') }}"></script>
	 <script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
	  <!--datepicker-->
    <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
	  <script src="https://cdn.tiny.cloud/1/patx6fdnaeffifo547sxdfgc436d33k76vgbw3v9mzozyuxx/tinymce/5/tinymce.min.js"></script>
	  @yield('style')
    <style type="text/css">
      #bloc1,#bloc2,#bloc3
      {
        display:inline;
      }
        .pointer_events_none {
        pointer-events: none;
      }
        .header_link_style_1{
        border:none;
        background:none;
        font-weight:600;
        font-size:12px;
      }
      .header_link_style_1:hover{
        color:#7E7E7E;
      }
      .header_link_style_1:focus{
        outline:none;
      }
      .text_blue_dash{
        color:#00c0ff;
        font-size:12px;
      }
      .dash_body_box_11{
        width:29.7%;
        height:210px;
        border-radius:15px;
        margin:0px 10px;
        box-shadow:-30px -30px 100px 10px #d2f4ff inset;
      }
      .dash_body_box_12{
        width:29.7%;
        height:210px;
        border-radius:15px;
        margin:0px 10px;
        box-shadow:-30px -30px 100px 10px #feedfe inset;
      }
      .dash_body_box_13{
        width:29.7%;
        height:210px;
        border-radius:15px;
        margin:0px 10px;
        box-shadow:-30px -30px 100px 10px #f2ecf4 inset;
      }
      .dash_body_box_2{
        width:100%;
        height:575px;
        border-radius:15px;
      }
      .dash_body_text_1{
        color:#00c0ff;
        font-weight:600;
        font-size:14px;
        margin-bottom:10px;
      }
      h4, .h4 {
        font-size: 12px;
      }
      .text_14 {
          font-family: Arial, Verdana, Helvetica, sans-serif;
          font-size: 10px;
          font-weight: normal;
          color: #000000;
          text-decoration: none;
      }
      label {
          display: inline-block;
          margin-bottom: .5rem;
          font-size:12px;
      }
      .form-control {
          height: calc(2.4rem + 2px);
          padding: 0.45rem 0.75rem;
          font-size: 12px;
          line-height: 1.5;
          color: #495057;
          border-radius: 0;
      }
    </style>
    @stack('head-script')
  </head>
  <body>
    <!-- Side Navbar -->
    @include('admin.menu.leftmainmenu')
    <div class="page bg_color_outside" style=" background-color:rgb(244,244,244); margin-top:3px;">
        <!-- Counts Section -->
        @include('admin.menu.header')
	    <section class="dashboard-counts section-padding" style="margin-top:5px;">
        @yield('content')
      </section>
    </div>
    @yield('model')
    <!-- JavaScript files-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    
    @stack('scripts')
  
  </body>
</html>