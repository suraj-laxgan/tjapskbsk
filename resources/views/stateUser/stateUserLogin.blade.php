<!DOCTYPE html>
<html lang="en">
<head>
  <title>State User Login Form</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://tjapskbsk.in/tjapskbsk/public/login_css/css/main.css">
  <link rel="shortcut icon" href="{{ asset('login_css/images/logo-Trans.png') }}">

  <!-- <link rel="stylesheet" type="text/css" href="{{ asset('login_css/css/main.css') }}"> -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <style>
    .login100-form-title1 {
      background: #003366; #FFCC00
      text-align: left;
      width: 100%;
      position: relative;
      z-index: 1;
      display: flex;
      flex-wrap: wrap;
      flex-direction: column;
      align-items: center;
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      padding: 15px;
  }
  </style>
</head>

<body>
  <div class="limitt">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-form-title1">
        <img src="https://tjapskbsk.in/tjapskbsk/public/login_css/images/logo-Trans.png" width="100" height="100">  
        <!-- <img src="{{ asset('login_css/images/logo-Trans.png') }}" width="100" height="100">   -->
        <span class="login100-form-title-1">State User Login</span>
        </div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('errmsg'))
    <div class="alert alert-danger">
        {{ session('errmsg') }}
    </div>
@endif
        <form class="login100-form validate-form" method="post" action="{{ url('/state-login') }}" id="form" autocomplete="off">
          @csrf
          <div class="wrap-input100 validate-input m-b-26">
            <span class="label-input100">User Email :*</span>
              <input class="input100" id="email" type="text" name="email" placeholder="User Email" value="{{ old('email')  }}" autocomplete="false" >
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input m-b-18">
            <span class="label-input100">Password :*</span>
            <input class="input100" id="password" type="password" name="password" placeholder="Enter password"><span toggle="#password-field"  style="color:#CCCCCC" class="fa fa-lg fa-eye-slash field-icon toggle-password" ></span>
            <span class="focus-input100"></span>
                        
          </div>
		  
		    <div class="m-b-18">
            <span class="label-input100">&nbsp;</span>
            <div class="g-recaptcha" data-sitekey="6LcT1ZwUAAAAADPxv5Q6gUt6rDNjClF5FPbsbVDO"></div>
          </div>

         
			<div class="flex-sb-m w-full p-b-30">
              <div>
                
              </div>
            </div>
         <?php /*echo date('h:i:s');?>
		 <?php echo date('h:i:s',strtotime(date('h:i:s') . ' +1 minutes'));*/?>
			<div class="m-b-18">
            <span class="label-input100">&nbsp;</span>
				
				@if (session('success'))
				<div class="alert alert-success">
					<i class="fa fa-check" aria-hidden="true"></i>&nbsp;{{ session('success') }}
				</div>
				@endif
            
                        
          </div>
		  
          <div class="container-login100-form-btn">
            <button class="login100-form-btn" type="submit">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>


</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$(function(){
		//$('#trial_dt').datepick({dateFormat: 'dd-mm-yyyy'});
		$('#form').submit(function(event){
		  
			var varified = grecaptcha.getResponse();
			if(varified.length === 0)
			{
				alert('Please fill captcha');
				event.preventDefault();
			}
		
		});
	});

$(document).on('click', '.toggle-password', function() {
$(this).toggleClass("fa-eye fa-eye-slash");
var input = $("#password");
input.attr('type') === 'password' ?
input.attr('type','text') : input.attr('type','password')
});

</script>
