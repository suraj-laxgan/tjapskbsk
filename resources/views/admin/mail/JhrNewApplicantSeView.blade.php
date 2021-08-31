@extends('admin.layout.appnext')
@section('title')
    JH Selection
@endsection
@section('style')
<style type="text/css">
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		/*background: url(https://j2n9a3i8.stackpathcdn.com/wp-content/uploads/2014/08/Preloader_11.gif) center no-repeat #fff;rgba(255, 255, 255, 0.9)*/
		background: url({{ asset('loader/loading1.gif') }}) center no-repeat rgba(255, 255, 255, 0.9);
	}
</style>    
@endsection
@section('content')
<div class="container-fluid">
    @include('admin.header.adminMailHeader')
    <div class="col-md-12">
        <div class="card-body"  style="margin-top: -10px">
            <form method="GET" action="{{ url('ad-se-vie-jh') }}"  enctype="multipart/form-data">
                <div class="row" >
                    <h6 style="color: gray">Jharkhand :</h6>

                    <div class="col-sm-2" >
                        <input type="text" value="{{request('application_no')}}" placeholder="Enter Application No " id="application_no" name="application_no" class="form-controls"  autocomplete="off" >
                    </div>
                    <div class="col-sm-2" >
                        <input type="text" value="{{request('mem_nm')}}" placeholder="Enter  Member Name " id="mem_nm" name="mem_nm" class="form-controls"  autocomplete="off" >
                    </div>
                    <div class="col-sm-2" >
                        <!-- <label>Member Name:</label>&nbsp;<font color="#FF0000">*</font> -->
                        <select name="post_applied_for" id="post_applied_for" class="form-controls">
                        
                            <option value="">Select Post Applied For</option>
                            <option value="DISTRICT IN CHARGE" {{ (request("post_applied_for") == "DISTRICT IN CHARGE" ? "selected":"") }}>DISTRICT IN CHARGE</option>
                            <option value="ASSISTANT DISTRICT IN CHARGE" {{ (request("post_applied_for") == "ASSISTANT DISTRICT IN CHARGE" ? "selected":"") }}>ASSISTANT DISTRICT IN CHARGE</option>
                            <option value="BLOCK OFFICER" {{ (request("post_applied_for") == "BLOCK OFFICER" ? "selected":"") }}>BLOCK OFFICER</option>
                            <option value="SEED OFFICER" {{ (request("post_applied_for") == "SEED OFFICER" ? "selected":"") }}>SEED OFFICER</option>
                            <option value="FISHERY OFFICER" {{ (request("post_applied_for") == "FISHERY OFFICER" ? "selected":"") }}>FISHERY OFFICER</option>
                            <option value="CLERK" {{ (request("post_applied_for") == "CLERK" ? "selected":"") }}>CLERK</option>
                            <option value="ASSISTANT CLERK" {{ (request("post_applied_for") == "ASSISTANT CLERK" ? "selected":"") }}>ASSISTANT CLERK</option>
                            <option value="FIELD OFFICER" {{ (request("post_applied_for") == "FIELD OFFICER" ? "selected":"") }}>FIELD OFFICER</option>
                            <option value="OFFICE ASSISTANT" {{ (request("post_applied_for") == "OFFICE ASSISTANT" ? "selected":"") }}>OFFICE ASSISTANT</option>
                            <option value="ACCOUNTANT" {{ (request("post_applied_for") == "ACCOUNTANT" ? "selected":"") }}>ACCOUNTANT</option>
                            <option value="FIELD SUPERVISOR" {{ (request("post_applied_for") == "FIELD SUPERVISOR" ? "selected":"") }}>FIELD SUPERVISOR</option>
                            <option value="MOTIVATOR" {{ (request("post_applied_for") == "MOTIVATOR" ? "selected":"") }}>MOTIVATOR</option>
                            <option value="FIELD SUPPORT" {{ (request("post_applied_for") == "FIELD SUPPORT" ? "selected":"") }}>FIELD SUPPORT</option>
                            <option value="ELECTRICIAN" {{ (request("post_applied_for") == "ELECTRICIAN" ? "selected":"") }}>ELECTRICIAN</option>
                            <option value="OFFICE PEON" {{ (request("post_applied_for") == "OFFICE PEON" ? "selected":"") }}>OFFICE PEON</option>
                        </select>
                    </div>
                    <div class="col-sm-2"style= 'margin-top:-1px'>
                        <!-- <label>&nbsp;&nbsp;</label> -->
                        <!-- <input type="submit" name='action_form'> -->
                        <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-search" style="font-size:20px"></i></button>
                    </div>
                    <div class="col-sm-2" style='margin-left:-130px;margin-top:-1px'>
                        <!-- <label>&nbsp;&nbsp;</label> -->
                        <a href="{{url('ad-se-vie-jh')}}">
                            <button type="button" <i class="fa fa-refresh button22" style="font-size:20px"></i></button>
                        </a>    
                    </div>
                </div>
            </form>
            <!-- <div class="col-sm-1" style='text-align: right'>
                <a href="{{url('#')}}"><button type='button' class='blue_button'>Export To Excel</button></a>
            </div> -->
        </div>

        <div class="card-body" style='margin-top:-55px'>
            <div class="row ">
                <div class="col-sm-6" ></div>
                <div class="col-sm-6" style='text-align: right'>
                    <a href="{{route('excel.jk',['application_no'=>request('application_no'),'mem_nm'=>request('mem_nm'), 'post_applied_for'=>request('post_applied_for')])}}"><button type='button' class='button22'>Export To Excel</button></a>
                </div>
            </div>
        </div>
                   
        <div class="card-body"style='margin-top:-40px'>
            @if (session('msg'))
                <div class="alert alert-danger">
                    {{ session('msg') }}
                </div>
            @endif
            <table  width=100% id="customers">
                <tr >
                    <th width=15%>Application No</th>
                    <th width=15%>Name</th>
                    <th width=13%>Guardian</th>
                    <th width=2%>Caste</th>
                    <th width=10%>Birth Date</th>
                    <th width=18%>Post Applied For</th>
                    <th width=5%>Age</th>
                    <th width=2%>Gender</th>
                    <th width=20%>Action</th>
                </tr>
                @foreach ($jhappli as $jh)
                    <tr >
                        <td>{{ $jh["application_no"]}}</td>
                        <td>{{ $jh["mem_nm"]}}</td>
                        <td>{{ $jh["guard_nm"]}}</td>
                        <td>{{ $jh["mem_cast"]}} </td>
                        <td>{{ $jh["birth_dt"]}}</td>
                        <td>{{ $jh["post_applied_for"]}}</td>
                        <td>{{ $jh["mem_age"]}}</td>
                        <td>{{ $jh["gender"]}}</td>
                        <td>
                            @if($jh["mail_count"] > 0)
                                <a href ="{{url('send-mail-jh/'.$jh['mem_id'])}}"class="button24 button1" style="text-decoration:none;">Resend Mail </a>&nbsp;&nbsp;
                            @else
                                <a href ="{{url('send-mail-jh/'.$jh['mem_id'])}}"class="button24 button1" style="text-decoration:none;">Send Mail </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            @endif
                                <a href ="{{url('pdf/'.$jh['mem_id'])}}"class="button24" style="text-decoration:none;" target="_blank">Print </a>
                        </td>
                    </tr>
                @endforeach
                </table>
                {{$jhappli->links()}}
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	   $(".button1").click(function(){
		$("body").append("<div class='se-pre-con'></div>");
		$(".se-pre-con").fadeIn();
	  });//submit
	});
</script>
@endpush