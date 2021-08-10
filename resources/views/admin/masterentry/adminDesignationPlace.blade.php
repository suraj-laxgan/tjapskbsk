@extends('admin.layout.appnext')
@section('title')
	Designation Place
@endsection
@section('style')
<style>


</style>
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminMasterEntryHeader')
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5">
                    <div class="card-body"style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);">
                            <div class="row">
                                <div class="col-sm-3" >
                                    <!-- <label>Select Type :</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <select name="state_nm" id="state_nm" class="form-controls" >
                                            <option value="">Select State</option>
                                            @foreach($state as $sname)
                                            <option value="{{$sname->state_nm}}"{{ request('state_nm')== $sname->state_nm ? "selected":"" }}>{{$sname->state_nm}}</option>
                                        @endforeach
                                        </select>
                                </div>
                                <div class="col-sm-3" >
                                    <!-- <label>Select Type :</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <select name="des_type" id="des_type" class="form-controls" >
                                            <option value="">Select Type</option>
                                            <option value="HEAD OFFICE"{{ request('des_type')=='HEAD OFFICE' ? "selected":"" }}>HEAD OFFICE</option>

                                            <option value="DISTRICT OFFICE"{{ request('des_type')=="DISTRICT OFFICE" ? "selected":"" }}>DISTRICT OFFICE</option>

                                            <option value="BLOCK OFFICE"{{ request('des_type')=="BLOCK OFFICE" ? "selected":"" }}>BLOCK OFFICE</option>
                                        </select>
                                </div>
                                <div class="col-sm-3" >
                                    <input type="text" id="des_nm" class="register_input" name="des_nm" value="{{ request('des_nm') }}"  autocomplete="off"/>
                                    <label for="register_input" placeholder="Enter Designation "></label>
                                </div>
                                <div class="col-sm-2" >
                                    <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-search" style="font-size:20px"></i></button>
                                </div>
                                <div class="col-sm-1" style='margin-left:-30px'>
                                    <!-- <label>&nbsp;&nbsp;</label> -->
                                    <a href="{{url('/ad-designation')}}">
                                        <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                    </a>    
                                </div>

                            </div>
                    </div>
                </div>
                <div class="col-md-7" style="margin-left: -25px">
                    <div class="card-body"style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);">
                        <form method="POST" action="{{ url('/ad-desig') }}"  enctype="multipart/form-data">
                            @csrf 
                            <div class="row">
                                
                                <div class="col-sm-2" >
                                    <select name="state_id" id="state_n" class="form-controls" required>
                                        <option value="">Select State</option>
                                        @foreach($state as $sname)
                                            <option value="{{$sname->state_id}}">{{$sname->state_nm}}</option>
                                           
                                        @endforeach
                                    </select>
                                   
                                    @if ($errors->has('state_nm'))
                                    <div class="text-danger">
                                        {{ $errors->first('state_nm') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-sm-2" >
                                    <select name="des_type" id="des_type" class="form-controls" required>
                                        <option value="">Select Type</option>
                                        <option value="HEAD OFFICE">HEAD OFFICE</option>
                                        <option value="DISTRICT OFFICE">DISTRICT OFFICE</option>
                                        <option value="BLOCK OFFICE">BLOCK OFFICE</option>
                                    </select>
                                    @if ($errors->has('des_type'))
                                        <span class="text-danger">
                                            {{ $errors->first('des_type') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-2" >
                                    <input type="text" id="sl_no" class="register_input" name="sl_no" required  autocomplete="off"/>
                                    <label for="register_input" placeholder="Enter SL No "></label>
                                    @if ($errors->has('sl_no'))
                                        <span class="text-danger">
                                            {{ $errors->first('sl_no') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-3" >
                                    <input type="text" id="des_nm" class="register_input" name="des_nm"  autocomplete="off" required/>
                                    <label for="register_input" placeholder="Designation Name "></label>
                                    @if ($errors->has('des_nm'))
                                        <span class="text-danger">
                                            {{ $errors->first('des_nm') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-2" >
                                    <input type="text" id="des_no_post" class="register_input" name="des_no_post"  autocomplete="off" required/>
                                    <label for="register_input" placeholder="No of Post "></label>
                                        @if ($errors->has('des_no_post'))
                                            <span class="text-danger">
                                                {{ $errors->first('des_no_post') }}
                                            </span>
                                        @endif
                                    
                                </div>
                                <div class="col-sm-1" >
                                <button type='submit' class='button22'><i class="fa fa-plus" style="font-size:20px"></i></button>
                                </div>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body" >
                @if (session('msg'))
                    <div class="alert  alert-success">
                        {{ session('msg') }}
                    </div>
                @endif
                {{-- <div style="color:gray"> <b>View Existing Designation :</b></div> --}}
                    <table   id="customers">
                        <tr >
                            <th>Type of place</th>
                            <th>Serial no</th>
                            <th>Designation</th>
                            <th>No of post</th>
                            <th>State Name</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($desig as $des)
                            <tr>
                                <td>{{ $des->des_type }}</td>
                                <td>{{ $des->sl_no }}</td>
                                <td>{{ $des->des_nm }}</td>
                                <td>{{ $des->des_no_post }}</td>
                                <td>{{ $des->state_nm }}</td>
                                <td>
                                    <a href="ad-desig-edit/{{ $des->des_id }}" style="color:green">Edit</a>&nbsp;&nbsp;
                                    <a href="delete-desig/{{ $des->des_id }}" style="color:red">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>  
                    {{ $desig->links() }} 
                </div>
            </div>
        </div>
    <div> 
@endsection
@push('scripts')
<script>
     $("#search_tn_1").click(function() { 
    var des_type =  $("#des_type").val();
    var des_nm =  $("#des_nm").val();
    var state_nm = $('#state_nm').val();
    window.location.href = "ad-designation?des_type="+des_type+"&des_nm="+des_nm+"&state_nm="+state_nm;
    });
</script>
@endpush