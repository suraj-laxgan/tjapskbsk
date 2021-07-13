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

      /******************** adaptive placeholder input ********************/
      .register_input[type="text"],
      .register_input[type="email"],
      .register_input[type="password"]{
      /*box-sizing: border-box;*/
      border:none;
      width: 100%;
      /* height: calc(2.3em + 2px); */
      margin: 0 0 0em;
      padding: 0px 0px;
      border-bottom: 1px solid #bababa;
      /*border-radius: 6px;*/
      /*background: #F0F3F5;*/
      background: rgb(253,253,253);
      font-size: 12px;
      resize: none;
      outline: none;
      }
      .register_input[type="text"]:focus,
      .register_input[type="email"]:focus,
      .register_input[type="password"]:focus {
      /*border-color: #00bafa;*/
      border-color: #7d7d7d;
      }
      .register_input[type="text"]:focus + label[placeholder]:before,
      .register_input[type="email"]:focus + label[placeholder]:before,
      .register_input[type="password"]:focus + label[placeholder]:before {
      /*color: #0091da;*/
      color: #7d7d7d;
      }
      .register_input[type="text"]:focus + label[placeholder]:before,
      .register_input[type="text"]:valid + label[placeholder]:before,
      .register_input[type="email"]:focus + label[placeholder]:before,
      .register_input[type="email"]:valid + label[placeholder]:before,
      .register_input[type="password"]:focus + label[placeholder]:before,
      .register_input[type="password"]:valid + label[placeholder]:before {
      transition-duration: .2s;
      transform: translate(-1em, -1em) scale(0.7, 0.7);  
        font-weight: bold;
      }
      .register_input[type="text"]:valid,
      .register_input[type="email"]:valid,
      .register_input[type="password"]:valid {
        border-color: rgb(235,235,235);
      }
      .register_input[type="text"]:valid + label[placeholder]:before,
      .register_input[type="email"]:valid + label[placeholder]:before,
      .register_input[type="password"]:valid + label[placeholder]:before {
        color: rgb(200,200,200);
      }

      .register_input[type="text"]:invalid + label[placeholder][alt]:before,
      .register_input[type="email"]:invalid + label[placeholder][alt]:before,
      .register_input[type="password"]:invalid + label[placeholder][alt]:before {
      content: attr(alt);
      }
      .register_input[type="text"] + label[placeholder],
      .register_input[type="email"] + label[placeholder],
      .register_input[type="password"] + label[placeholder] {
      display: block;
      pointer-events: none;
      line-height: 1.25em;
      margin-top: calc(-1.8em - 2px);
      margin-bottom: calc((2em - 1em) + 2px);
      }
      .register_input[type="text"] + label[placeholder]:before,
      .register_input[type="email"] + label[placeholder]:before,
      .register_input[type="password"] + label[placeholder]:before {
      content: attr(placeholder);
      display: inline-block;
      margin: 0 calc(0em + 0px);
      padding: 0 0px;
      color: #7d7d7d;
      white-space: nowrap;
      transition: 0.3s ease-in-out;
      /*background-image: linear-gradient(to bottom, #ffffff, #ffffff);*/
      background-size: 100% 5px;
      background-repeat: no-repeat;
      background-position: center;
      }
      /******************** end adaptive placeholder input ********************/
      /********************* adaptive placeholder textarea *********************/
      .register_textarea {
      box-sizing: border-box;
      width: 100%;
      background: #fff;
      height: calc(10em + 2px);
      padding: 6px;
      font-size: 16px;
      border: 1px solid #bababa;
      transition: all 0.2s ease-out;
      border-radius: 6px;
      resize: none;
      outline: none;
      }
      .register_textarea:hover {
      border: 1px solid #bababa;
      }
      .register_textarea:focus, .register_textarea:active {
      border: 1px solid #00bafa;
      }
      .register_textarea:focus + label:before, .register_textarea:active + label:before {
      color: #0091da;
      }

      .register_textarea + label {
      display: block;
      font-size: 16px;
      height: calc(10em + 2px);
      line-height: 1;
      padding-top: calc(1em + 1px);
      margin-top: calc(-10em - 2px);
      margin-bottom: calc((1.1em - 1em) + 2px);
      pointer-events: none;

      }
      .register_textarea + label:before {
      content: attr(placeholder);
      display: inline-block;
      color: #999999;
      margin: 0 calc(1em + 2px);
      white-space: nowrap;
      transition-property: color, -webkit-transform;
      transition-property: transform, color;
      transition-property: transform, color, -webkit-transform;
      transition-duration: 0.2s;
      transition-delay: 0;
      transition-timing-function: ease-out;
      -webkit-transform-origin: left center;
      transform-origin: left center;
      }
      .register_textarea:focus + label:before, .register_textarea.active + label:before,
      .register_textarea:valid + label:before {
      background: white;
      line-height: 1.25em;
      padding: 0 2px;
      font-size: 20px;
      font-weight: bold;
      -webkit-transform: translateY(calc((-1em - 0.5em) - 0.5px)) scale(0.8, 0.8);
      transform: translateY(calc((-1em - 0.5em) - 0.5px)) scale(0.8, 0.8);
      }
      .register_textarea:valid {
      border-color: green;
      }
      .register_textarea:valid + label:before {
      content: attr(alt);
      color: green;
      }
      /******************** end adaptive placeholder textarea ********************/
    </style>
    @stack('head-script')
  </head>
  <body>
    <!-- Side Navbar -->
    @include('admin.menu.leftmainmenu')
    <div class="page bg_color_outside" style=" background-color:rgb(244,244,244); margin-top:3px;">
        <!-- Counts Section -->
        
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