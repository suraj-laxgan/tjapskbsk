<!DOCTYPE html>
<html lang="en" data-scroll="640">
<head>
	<title>@yield('title')</title>
    <meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@yield('meta')
	<link media="screen, projection"  href="{{asset("css/custom.css")}}" rel="stylesheet" type="text/css"/>
	<link media="screen, projection"  href="{{asset("css/master.css")}}" rel="stylesheet" type="text/css"/>
	<link media="screen, projection"  href="{{asset("bootstrap_css/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css"/> 
	{{-- <script src="{{asset('bootstrap_css/js/bootstrap.min.js')}}"></script> --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('custom/custom.css') }}">
	@yield('style')
<style>
/* web version */
@media only screen and (min-width: 992px) {
	.sign_up{
	background-color:white;
	color:#f2c515;
	font-size:16px;
	padding:6px 20px;
	border:none;
	border-radius:20px;
	margin-top:-10px;
	border: 1px solid #f2c515;
	}
	.sign_in{
	background-color:#f2c515;
	color:white;
	font-size:16px;
	padding:6px 20px;
	border:none;
	border-radius:20px;
	margin-top:-10px;
	}
	.baner_text{
		font-size: 60px;
		font-weight: 700;
		line-height: 69px;
		letter-spacing: -1.8px;
		font-family: nunito;
	}
	.link_text_button{
		background-color:#f2c515;
		color:white;
		padding:12px 50px;
		border-radius:30px;
		border:none;
		cursor: pointer;
	}
	.link_text_button2{
		/*background-color:#fea000;
		color:white;*/
		padding:12px 50px;
		border-radius:30px;
		border:1px solid #323fff;
		text-decoration:none;
		background:none;
		cursor: pointer;
	}
	.baner_text_footer{
		font-size: 60px;
		font-weight: 700;
		line-height: 69px;
		letter-spacing: -1.8px;
		font-family: nunito;
		color:white;
		padding:80px 0px;
	}
	.fotter_button_p{
		padding:150px 40px;
	}
	.hr_line{
		height:2px; 
		background-color:#293246;
	}
	.link_pl{
		padding-left:20px;
	}
	.link_pr{
		padding-right:20px;
	}
	.footer_text_22{
		float:right;
	}
	.footer_web_p{
	 	padding:40px 0px;
	}
}
@media only screen and (max-width: 992px) {
	.baner_text{
		font-size: 40px;
		font-weight: 700;
		line-height: 49px;
		letter-spacing: -1.8px;
		font-family: nunito;
	}
	.link_text_button{
		background-color:#f2c515;
		color:white;
		padding:6px 15px;
		border-radius:20px;
		border:none;
		cursor: pointer;
	}
	.link_text_button2{
		/*background-color:#fea000;
		color:white;*/
		padding:6px 15px;
		border-radius:20px;
		border:1px solid #323fff;
		text-decoration:none;
		background:none;
		cursor: pointer;
	}
	.baner_text_footer{
		font-size: 40px;
		font-weight: 700;
		line-height: 49px;
		letter-spacing: -1.8px;
		font-family: nunito;
		color:white;
		padding:20px 0px;
		text-align:center;
	}
	.fotter_button_p{
		text-align:center;
	}
	.hr_line{
		height:2px; 
		background-color:#293246;
		margin-top:30px;
	}
	.mob_footer_center{
		text-align:center;
	}
	.link_pl{
		padding-left:5px;
	}
	.link_pr{
		padding-right:5px;
	}
	.footer_web_p{
		padding-bottom:20px;
	}
}
button:focus, .link_text_button:focus, .link_text_button2:focus{
	outline: none;
}
.card_text_1{
	font-size: 20px;
    font-weight: 600;
    line-height: 34px;
    letter-spacing: -.75px;
    margin: 15px 0 23px;
}
.card_box_1{
	border-radius:30px;
}
.card_box_1:hover{
	box-shadow: 0px 0px 25px 5px rgb(220,220,220);
}
.card_box_2{
	border-radius:30px;
}
.card_box_2:hover{
	box-shadow: 0px 0px 35px 5px rgb(220,220,220);
}
.card_box_3{
	background-color:rgb(254,254,254);
	border-radius:20px;
}
.animation_banner_l{
	position: relative;
	animation: banner_left 2s;
	animation-fill-mode: forwards;
}
@keyframes banner_left {
	from {top: 50px; opacity: 0;}
	to {top: 0px;}
}

.animation_banner_r{
	position: relative;
	animation: banner_right 4s;
	animation-fill-mode: forwards;
}
@keyframes banner_right {
	from {left: 50px; opacity: 0.5;}
	to {left: 0px;}
}

.animation_card{
	position: relative;
	animation: card 5s;
	animation-fill-mode: forwards;
}
@keyframes card {
	from {right: 100px; opacity: 0;}
	to {right: 0px;}
}
.animation_text{
	position: relative;
	animation: animation_text 3s;
	animation-fill-mode: forwards;
}
@keyframes animation_text {
	from {right: 50px; opacity: 0;}
	to {right: 0px;}
}
.animation_banner_l2{
	position: relative;
	animation: banner_left2 5s;
	animation-fill-mode: forwards;
}
@keyframes banner_left2 {
	from {left: 100px; opacity: 0;}
	to {left: 0px;}
}

.animation_banner_r2{
	position: relative;
	animation: banner_right2 5s;
	animation-fill-mode: forwards;
}
@keyframes banner_right2 {
	from {top: 100px; opacity: 0;}
	to {top: 0px;}
}
.animation_text_2{
	position: relative;
	animation: animation_text_2 5s;
	animation-fill-mode: forwards;
}
@keyframes animation_text_2 {
	from {left: 50px; opacity: 0;}
	to {left: 0px;}
}
.animation_card_2{
	position: relative;
	animation: card_2 5s;
	animation-fill-mode: forwards;
}
@keyframes card_2 {
	from {top: 50px; opacity: 0;}
	to {top: 0px;}
}
.animation_text_3{
	position: relative;
	animation: animation_text_3 5s;
	animation-fill-mode: forwards;
}
@keyframes animation_text_3 {
	from {left: 50px; opacity: 0;}
	to {left: 0px;}
}
.animation_card_3{
	position: relative;
	animation: animation_card_3 5s;
	animation-fill-mode: forwards;
}
@keyframes animation_card_3 {
	from {top: 50px; opacity: 0;}
	to {top: 0px;}
}

.animation_footer_text{
	position: relative;
	animation: animation_footer_text 5s;
	animation-fill-mode: forwards;
}
@keyframes animation_footer_text {
	from {left: 100px; opacity: 0;}
	to {left: 0px;}
}

</style>
</head>
<body >
	<!-- header -->
	@include('layouts.headerWeb')
	<!-- end header -->
	<!-- body -->
	@yield('content')
	<!-- end body -->
	<!-- footer -->
	@include('layouts.footerWeb')
	<!-- end footer -->
	@yield('model')
	@stack('scripts')
</body>
</html>