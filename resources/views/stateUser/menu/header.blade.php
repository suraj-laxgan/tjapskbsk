@if(Auth::guard('admin')->check())
 <?php
 $css = 'rgb(244,244,244)';
 ?>
 @elseif(Auth::guard('stateUser')->check())
 <?php
 $css = 'rgb(244,244,244)';
 ?>
 @endif
 
<header class="header">
    <nav class="navbar" style="background-color:{{ $css }}">
        <div class="container-fluid" style="padding-left:0px;">
			@if(Auth::guard('stateUser')->check())
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="100%" height="50px">
							<div class="navbar-holder d-flex align-items-center justify-content-between">
								<div class="navbar-header">&nbsp;
									<a id="toggle-btn" href="#" class="web-none"><img src="{{ asset('online_user/img/menu_icon.png') }}" height="35px" width="35px"></a>
									<a href="#" class="navbar-brand">
									<div class="brand-text d-none d-md-inline-block">&nbsp;
									<strong class="text_blue_dash">
										@yield('header_link')
									</strong>
								</div>
								</a>
							</div>
						</td>
						<!-- <td width="0%" align="right">
							
						</td> -->
					</tr>
				</table>
			@endif 
		</div>
    </nav>
</header>