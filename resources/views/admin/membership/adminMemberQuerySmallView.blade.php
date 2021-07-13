<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title> Member view</title>
	<link rel="stylesheet" href="{{ asset('online_user/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
	<link rel="shortcut icon" href="{{ asset('login_css/images/logo-Trans.png') }}">

</head>
<body>
	<div class="container-fluid">
		<div class="card-body">
			<div class="row">
				<div style='width:25%' align="center">
					{{-- <img src="{{ asset('mem_regis_upload/'.$mem_view->profile_pic) }}" width="100" height="100" /><br> --}}

					<img src="{{ asset('photo/'.$mem_details->profile_pic) }}" width="100" height="100" /><br>
					{{  $mem_details->mem_nm }}
				</div>
				<div style='width:5%;'></div>
				<div style='width:70%;'>
					<div class="row">
						<div style='width:40%''>
							Guardian Name : <br>
							Name of the State :	<br>
							Place Of posting :<br>	
							Designation :	<br>
							Date of joining :	<br>
							Memo No : 
						</div>
					
						<div style='width:60%''>
							{{  $mem_details->guard_nm }}<br>
							{{  "State"}}<br>
							{{  $mem_details->mem_posting_place }}<br>
							{{  $mem_details->mem_desig }}<br>
							{{  $mem_details->entry_dt }}<br>
							{{  $mem_details->memo_no }}<br>
						</div>
					</div>
				</div>
			</div>
			<div align="center" style="margin-top: 25px"><input type="button" value="Close" class="button_grey" onClick="window.close()"></div>
		</div>
	</div>
</body>
</html>
