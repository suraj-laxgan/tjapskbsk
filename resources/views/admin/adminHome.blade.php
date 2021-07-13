@extends('admin.layout.app')
@section('title')
	Admin Dashboard
@endsection
@section('style')
<style>
	.body_circle_icon{
		width:26px; 
		height:26px; 
		border-radius:50%; 
		background-color:#00c0ff;
		text-align:center;
		vertical-align:middle;
		padding-top:5px;
		color:#FFFFFF;
	}
	.body_line_icon{
		width:4px; 
		height:20px; 
		background-color:#00c0ff; 
		margin-left:11px;
	}
	.body_link_text{
		position:absolute; 
		top:5px; left:30px; 
		font-size:12px;
		font-weight:500;
		color:rgb(100,100,100);
	}
	.body_link_text:hover{
		color:rgb(50,50,50);
	}
	.icon_dash_1{
		font-size:32px;
		color:#FFFFFF;
		margin-top:20px;
		margin-bottom:20px;
	}
	.text_dash_1{
		font-size:32px;
		color:#FFFFFF;
		margin-bottom:10px;
	}
	.text_dash_2{
		font-size:12px;
		font-weight:600;
		color:#FFFFFF;
		margin-bottom:10px;
	}
	
</style>
@endsection
@section('content')
	<div class="container-fluid">
					@section('header_link')
				Welcome {{ Auth::guard('admin')->user()->admin_user_id }}
			@endsection
				<div class="row" style="margin-top:25px;">
					<div class="col-md-7">
						<div class="container">
							<div class="row">
								<div class="col-md-12 dash_body_text_1">Analytics
								</div>
							</div>
							<div class="row">
								<div class="dash_body_box_11" style="background-color:#00e6e6;" align="center">
									<i class="fas fa-dollar-sign icon_dash_1"></i>
									<div class="text_dash_1">10</div>
									<div class="text_dash_2">LOREM IPSUM</div>
								</div>
								<div class="dash_body_box_12" style="background-color:#00cccc;" align="center">
									<i class="fas fa-book icon_dash_1"></i>
									<div class="text_dash_1">75</div>
									<div class="text_dash_2">LOREM IPSUM</div>
								</div>
								<div class="dash_body_box_13" style="background-color:#009999;" align="center">
									<i class="fas fa-clock icon_dash_1"></i>
									<div class="text_dash_1">20</div>
									<div class="text_dash_2">LOREM IPSUM</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 dash_body_text_1" style="margin-top:20px; margin-bottom:10px;">Graphical Reports
								</div>
							</div>
							<div class="row" style=" padding:10px;">
								<div class="col-md-12" style="background-color:#FFFFFF; border-radius:15px;">
									<canvas id="myChart"></canvas>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-5" style="padding-right:60px;">
						<div class="row">
							<div class="col-md-12 dash_body_text_1">Reports
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 dash_body_box_2" style="background-color:#ffffff;" align="center">
								<div style="color:#00c0ff; font-size:16px; margin-top:15px; margin-bottom:10px;">LOREM IPSUM</div>
								<div style="color:rgb(180,180,180); font-size:14px; margin-bottom:40px;">Lorem ipsum dolor sit amet,<br/> consectetur adipiscing.</div>
								<div class="flex-wrapper">
									<div class="single-chart">
										<svg viewbox="0 0 36 36" class="circular-chart orange">
											<path class="circle-bg"
												d="M18 2.0845
												a 15.9155 15.9155 0 0 1 0 31.831
												a 15.9155 15.9155 0 0 1 0 -31.831"
											/>
											<path class="circle"
												stroke-dasharray="75, 100"
												d="M18 2.0845
												a 15.9155 15.9155 0 0 1 0 31.831
												a 15.9155 15.9155 0 0 1 0 -31.831"
											/>
											<text x="18" y="20.35" class="percentage">75%</text>
										</svg>
									</div>
								</div>
								<!-- end percentage -->
							</div>
						</div>
					</div>
				</div>
	</div>
@endsection
@push('scripts')
    <!-- JavaScript files-->
    <script src="{{ asset('online_user/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('online_user/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('online_user/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('online_user/js/grasp_mobile_progress_circle-1.0.0.min.js') }}"></script>
    <script src="{{ asset('online_user/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('online_user/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('online_user/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
     <!-- Main File-->
    <script src="{{ asset('online_user/js/front.js') }}"></script>
	
	<script type="text/javascript">

		function redirect()
		{
		if (confirm('Are you sure you want to free cart?'))
		{
			//alert(url);
			//window.location.href=url;
			window.location="{{ url('#') }}";
		}
		return false;
		}	
		// chart
		var ctx = document.getElementById('myChart');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
				datasets: [{
					label: '# of Votes',
					data: [12, 19, 3, 5, 2, 3],
					backgroundColor: [
						'rgba(255, 99, 132, 0.2)',
						'rgba(54, 162, 235, 0.2)',
						'rgba(255, 206, 86, 0.2)',
						'rgba(75, 192, 192, 0.2)',
						'rgba(153, 102, 255, 0.2)',
						'rgba(255, 159, 64, 0.2)'
					],
					borderColor: [
						'rgba(255, 99, 132, 1)',
						'rgba(54, 162, 235, 1)',
						'rgba(255, 206, 86, 1)',
						'rgba(75, 192, 192, 1)',
						'rgba(153, 102, 255, 1)',
						'rgba(255, 159, 64, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				}
			}
		});
	</script>
@endpush


