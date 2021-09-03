<?php
use App\Http\Controllers\CommonController;
?>
<style type="text/css">
    .dropbtn2 {
    /*background-color: #4CAF50;
    color: white;*/
    width:100%;
    padding: 10px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    }
    .dropdown2 {
    position: relative;
    display: inline-block;
    }

    .dropdown_content2 {
    display: none;
    /*position: absolute;*/
    height:250px;
    background-color: #f9f9f9;/*#f9f9f9*/
    /*min-width: 160px;*/
    width:100%;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    /*z-index: 1;*/
    overflow:auto;
    }

    .dropdown_content2 a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    }

    .left_menu_text
    {
        font-family:Arial, Helvetica, sans-serif;
        color:#FFFFFF;
        font-weight:normal;
        font-size:14px;
    }


    .dropdown_content2 a:hover {background-color: #f1f1f1}

    .dropdown2:hover .dropdown_content2 {
    display: block;
    }
    /*.scroll_view {
    height:500px;
    width:100%;
    overflow:auto;
    }*/
    .ad_text {
        font-size: 12px;
    }
    .ad_left_menu {
        font-family: Arial;
        font-weight: 500;
        font-size: 12px;
        color: white;
        padding: 5px 5px;
        margin: 2px 20px;
        width:87.5%;
        font-weight:600;
    }
    .ad_left_menu:hover {
        color:rgb(250,250,250);
    }
    .ad_active_manu{
        background-color:#e872fe;
        border-bottom-left-radius:5px;
        border-top-left-radius:5px;
        box-shadow:-20px -2px 30px 5px #fdbafb inset;
    }
    .link_head_admin_dash{
        color:#FFFFFF;
        font-size:50px;
        
    }
    .link_head_admin_dash:hover{
        color:#000000;
    }
</style>
@php
    $permisson_link = CommonController::permissonLink();
@endphp
<nav class="side-navbar" style="height:auto;border-right:5px solid #00c0ff; overflow:hidden">
	<div style="border-right:5px solid #FFFFFF;">
        <div class="side-navbar-wrapper">
            <!-- Sidebar Header  (d-flex)  -->
            <div class="sidenav-header d-flex align-items-center justify-content-center">
                <!-- User Info-->
                <div class="sidenav-header-inner text-center">
		            @if(Auth::guard('admin')->check())
                        <img src="{{ asset('images1/logo-Trans.png') }}">
                        {{ Auth::guard('admin')->user()->admin_name }} 
                    @endif
                   

                </div>
            </div>
                <!-- Sidebar Navigation Menus-->
            <div class="main-menu">
                <!-- <h5 class="sidenav-heading">Main</h5> -->
                <ul id="side-main-menu" class="side-menu list-unstyled scroll_view" style="margin-top:-10px">
                                    
                        <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#00c0ff">
                            <tr>
                                <td height="2px" bgcolor="ffffff"></td>
                            </tr>
                            <tr>
                                <td height="5px"></td>
                            </tr>
                            <tr>
                                <td valign="middle">
                                    <a href="{{ route('admin.dashboard') }}" style="text-decoration:none" class="ad_left_menu {{ request()->is('admin/dashboard') ? 'ad_active_manu':'' }}">
                                        <i class="fas fa-home"></i>Main
                                    </a>
                                </td>
                            </tr>
                            @if($permisson_link->state_per == "G")
                            <tr>
                                <td valign="middle">
                                    <a href="{{ route('admin.statemain') }}" style=" text-decoration:none;" class="ad_left_menu {{ request()->is('admin-state-main') || request()->is('admin-state') || request()->is('admin-state-view') || request()->is('ad-cuser-state')  ? 'ad_active_manu':'' }}">
                                        <i class="fas fa-university"></i>State
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @if($permisson_link->membership_per == "G")
                            <tr>
                                <td valign="middle">
                                    <a href="{{ route('ad.adminmembermain') }}" style="text-decoration:none" class="ad_left_menu {{ request()->is('ad-member-main') || request()->is('ad-member') || request()->is('ad-exismember') || request()->is('ad-member-query') || request()->is('ad-expo-member') || request()->is('ad-confi-letter') || request()->is('ad-joining-letter')  || request()->is('ad-repjoining-letter') || request()->is('ad-decal-letter') || request()->is('ad-reprindecal-letter') || request()->is('ad-appointment-letter') || request()->is('ad-rep-appointment-letter')? 'ad_active_manu':'' }}">
                                        <i class="fas fa-users"></i>Membership
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @if($permisson_link->master_per == "G")
                            <tr>
                                <td valign="middle">
                                    <a href="{{ route('ad.mas') }}" style="text-decoration:none" class="ad_left_menu {{ request()->is('ad-mas') || request()->is('ad-designation') || request()->is('ad-organiser') || request()->is('ad-districts')  || request()->is('ad-block') || request()->is('ad-staff') || request()->is('ad-cuser')? 'ad_active_manu':'' }}">
                                        <i class="fas fa-chalkboard-teacher"></i>Master Entry 
                                    </a>
                                </td>
                            </tr>
                            @endif
                            @if($permisson_link->function_per == "G")
                            <tr>
                                
                                    <td valign="middle">
                                        <a href="{{ route('add.function') }}" style="text-decoration:none" class="ad_left_menu {{ request()->is('ad-function') ||  request()->is('ad-mem-authentication') ||  request()->is('ad-gr-office-staff') ||  request()->is('ad-ac-in-mem') ? 'ad_active_manu':'' }}">
                                            <i class="fas fa-user-cog"></i>Function
                                        </a>
                                    </td>
                            </tr>
                            @endif
                            @if($permisson_link->mail_per == "G")
                            <tr>
                                <td valign="middle">
                                    <a href="{{ route('add.allmail') }}" style="text-decoration:none" 
                                        class="ad_left_menu {{ request()->is('ad-all-mail') || request()->is('ad-se-vie-wb') || request()->is('ad-se-vie-br') || request()->is('ad-se-vie-jh') ? 'ad_active_manu':'' }}">
                                        <i class="fas fa-envelope"></i>Mail
                                    </a>
                                </td>
                            </tr>
                            @endif
                            {{-- <tr>
                                <td valign="middle">
                                    <a href="{{ url('#') }}" style=" text-decoration:none;" class="ad_left_menu ">
                                        <i class="fas fa-user"></i>New Application
                                    </a>
                                </td>
                            </tr> --}}
                            <tr>
                                <td valign="middle">
                                    <a href="{{ route('add.allRegis') }}" style="text-decoration:none" 
                                    class="ad_left_menu {{ request()->is('verify-all-regis')||request()->is('verify-register') || request()->is('verify-search-exis-mem') || request()->is('ad-verify-regis-member') ? 'ad_active_manu':'' }}">
                                        <i class="fas fa-registered"></i>Verified Register
                                    </a>
                                </td>
                            </tr>
                            {{-- <tr>
                                <td valign="middle">
                                    <a href="{{ url('#',['menu_status' => 'TES']) }}" style="text-decoration:none" class="ad_left_menu {{ (request('menu_status') == 'TES') ? 'ad_active_manu':'' }}">
                                        <i class="fas fa-book"></i>Test
                                    </a>
                                </td>
                            </tr> --}}
                            <tr>
                                <td>
                                    @if(Auth::guard('admin')->check())
                                    <?php
                                    $css = '#00c0ff';
                                    ?>
                                    @elseif(Auth::guard('state')->check())
                                    <?php
                                    $css = '#FFFFFF';
                                    ?>
                                    @endif
                                    <nav class="navbar" style="background-color:{{ $css }}">
                                        <div class="container-fluid" style="padding-left:0px;">
                                            @if(Auth::guard('admin')->check())
                                            <table width="60%" border="0" cellspacing="0" cellpadding="0" style="padding-left:50px">
                                                <tr>
                                                    <td width="15%" align="middle">
                                                   
                                                        <form id="" action="{{ route('admin.logout') }}" method="POST" >
                                                            @csrf
                                                            <button  type='submit' class="ad_leftmenu" style='background:none;border:none;font-size: 12px;color:white;font-weight: 600;' >&nbsp;
                                                                <i class="fas fa-sign-out-alt"></i>Logout
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </table>
                                            @endif 
                                        </div>
                                    </nav>
                                </td>
                            </tr>
                        </table> 
                        <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#00c0ff">
                            <tr>
                                <td height="20px">&nbsp;</td>
                            </tr>
                            <tr>
                                <td height="2px" bgcolor="ffffff"></td>
                            </tr>
                            <tr>
                                <td height="400px" style="color:#FFFFFF; padding-top:10px;" valign="top">
                                    <a href="{{ url('#',['menu_status' => 'change_pass']) }}" style="text-decoration:none" class="ad_left_menu {{ (request('menu_status') == 'change_pass') ? 'ad_active_manu':'' }}">Change Password</a>
                                </td>
                            </tr>
                        </table>
                      
                </ul>
        
            </div>
        </div>
	</div>
</nav>