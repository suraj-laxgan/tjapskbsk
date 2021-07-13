@extends('admin.layout.appnext')
@section('title')
	Admin Registration
@endsection
@section('style')
<style>

</style> 
@endsection
@section('content')
<div class="container-fluid">
    @include('admin.header.adminMembershipHeader')
    <div class="col-md-12">
        <div class="card-body">
            @if (session('msg'))
                <div class="alert alert-danger">
                    {{ session('msg') }}
                </div>
            @endif
            <form method="POST" action="{{ url('/ad-member-regis') }}"  enctype="multipart/form-data" >
                @csrf
                <div class='row'>
                    <div class="card-body"style='border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);'>
                        {{-- <div class="" id="mem_dist_show" > --}}
                            <div class="col-sm-12" >
                                    <select name="state_nm" id="state_n" class="form-controls"         onChange="findStateName()">
                                        <option value="">Select State</option>
                                        @foreach($state_name as $sname)
                                            <option value="{{$sname->state_code}}">{{$sname->state_nm}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('state_nm'))
                                    <div class="text-danger">
                                        {{ $errors->first('state_nm') }}
                                    </div>
                                    @endif
                            </div>
                        {{-- </div> --}}
                        {{-- <div class="col-sm-12" style="margin-top: 5px" >
                            <select name="state_code" id="state_code" class="form-controls">
                                <option value="">Select State Code</option>
                                @foreach($state_name as $code)
                                    <option value="{{$code->state_code}}">{{$code->state_code}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="col-sm-12" style="margin-top: 5px"> 
                            <input type="text" id="mem_nm" class="register_input" name="mem_nm" autocomplete="disable"/>
                            <label for="register_input" placeholder="Enter Members Name  *"></label>
                            @if ($errors->has('mem_nm'))
                            <div class="text-danger">
                                {{ $errors->first('mem_nm') }}
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-12">
                            <input type="text" id="media_nm" class="register_input" name="media_nm"   autocomplete="disable"/>
                            <label for="register_input" placeholder="Enter Media Name  *"></label>
                            @if ($errors->has('media_nm'))
                                <div class="text-danger">
                                    {{ $errors->first('media_nm') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12">
                            <input type="text" placeholder="Enter Members From" id="entry_dt" name="entry_dt" class="register_input{{ $errors->has('entry_dt') ? ' is-invalid' : '' }}" autocomplete="disable" readonly="true" style="background-color: #ffffff;">
                            @if ($errors->has('entry_dt'))
                                <div class="text-danger">
                                    {{ $errors->first('entry_dt') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12" style="padding-top: 5px">
                            <input type="text" id="contact_no" class="register_input" name="contact_no"  autocomplete="disable"/>
                            <label for="register_input" placeholder="Enter Contact No  *"></label>
                            @if ($errors->has('contact_no'))
                                <div class="text-danger">
                                    {{ $errors->first('contact_no') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12">
                            <input type="email" id="mem_email" class="register_input" name="mem_email" autocomplete="off"/>
                            <label for="register_input" placeholder="Enter Email Address  *"></label>
                            @if ($errors->has('mem_email'))
                                <div class="text-danger">
                                    {{ $errors->first('mem_email') }}
                                </div>
                            @endif
                        </div>
                            <div class="col-sm-12 " >
                                    <select name="guard_relatiion" id="guard_relatiion" class="form-controls">
                                        <option value="">Select Relation</option>
                                        <option value="FATHER">S/O</option>
                                        <option value="FATHER">D/O</option>
                                        <option value="WIFE">W/O</option>
                                        <option value="HUSBAND">H/O</option>
                                    </select>
                            </div>
                            <div class="col-sm-12" style="padding-top: 5px" >
                                <input type="text" id="guard_nm" class="register_input" name="guard_nm"  autocomplete="disable" />
                                <label for="register_input" placeholder="Enter Guardian Name"></label>
                            </div>
                            <div class="col-sm-12" >
                                <select name="gender" id="gender" class="form-controls">
                                    <option value="">Select Gender</option>
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                            <div class="col-sm-12" style='margin-top:5px' >
                                <input type="text" id="mem_cast" class="register_input" name="mem_cast" value="{{ old('mem_cast') }}"  autocomplete="off"/>
                                <label for="register_input" placeholder="Enter Cast "></label>
                            </div>
                            <div class="col-sm-12" >
                                {{-- <input type="date" placeholder="Enter Date of Birth " id="birth_dt" name="birth_dt" class="form-controls"  autocomplete="off" > --}}

                                <input type="text" placeholder="Enter Date of Birth" id="birth_dt" name="birth_dt" class="register_input{{ $errors->has('birth_dt') ? ' is-invalid' : '' }}" value="" autocomplete="off" readonly="true" style="background-color: #ffffff;">
                            </div>
                            <div class="col-sm-12" style='margin-top:5px' >
                                <input type="text" id="mem_quali" class="register_input" name="mem_quali" value="{{ old('mem_quali') }}"  autocomplete="off"/>
                                <label for="register_input" placeholder="Enter Qualification "></label>
                            </div>
                            <div class="col-sm-12">
                                <textarea name="mem_add" id="mem_add" placeholder="Enter Address "cols="" rows="" class="register_textarea"></textarea>
                            </div> 
                    </div>&nbsp;
                    <div class="card-body"style='border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);'>
                        <div class="col-sm-12" >
                            <input type="text" id="mem_aadhar_no" class="register_input" name="mem_aadhar_no" value="{{ old('mem_aadhar_no') }}"  autocomplete="off"/>
                            <label for="register_input" placeholder="Enter Adhar No*"></label>
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="mem_pan_no" class="register_input" name="mem_pan_no" value="{{ old('mem_pan_no') }}"  autocomplete="off"/>
                            <label for="register_input" placeholder="Enter Pan No *"></label>
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="mem_voterid_no" class="register_input" name="mem_voterid_no" value="{{ old('mem_voterid_no') }}"  autocomplete="off"/>
                            <label for="register_input" placeholder="Enter Voter Id No *"></label>
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="bank_acount_no" class="register_input" name="bank_acount_no" value="{{ old('bank_acount_no') }}"  autocomplete="off"/>
                            <label for="register_input" placeholder="Enter Bank Account No *"></label>
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="mem_bank_nm" class="register_input" name="mem_bank_nm" value="{{ old('mem_bank_nm') }}"  autocomplete="off"/>
                            <label for="register_input" placeholder="Enter Bank Name *"></label>
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="bnk_ifsc_code" class="register_input" name="bnk_ifsc_code" value="{{ old('bnk_ifsc_code') }}"  autocomplete="off"/>
                            <label for="register_input" placeholder="Enter Bank IFSC Code *"></label>
                        </div>
                        <div class="col-sm-12" >
                            <select name="des_type" id="des_type" class="form-controls" onChange="findDesignationName()">
                                <option value="">Select Office</option>
                                <option value="HEAD OFFICE">HEAD OFFICE</option>
                                <option value="DISTRICT OFFICE">DISTRICT OFFICE</option>
                                <option value="BLOCK OFFICE">BLOCK OFFICE</option>
                                <option value="NO OFFICE">NO OFFICE</option>
                            </select>
                        </div>
                        <div class="col-sm-12" style="padding-top: 5px">
                            <select name="mem_desig" id="des_nm" class="form-controls">
                                <option value="">Select Designation</option>
                            </select>
                        </div>
                        <div class="" id="mem_dist_show" style="display:none ;padding-top: 5px">
                            <div class="col-sm-12" >
                                    <select name="district" id="mem_dist" class="form-controls" onChange="findDisName()">
                                        <option value="">Select District</option>
                                        @foreach($mem_dist as $dist)
                                            <option value="{{$dist->district_nm}}">{{$dist->district_nm}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="" style="display:none;padding-top: 5px" id="place_of_post_show">
                            <div class="col-sm-12" >
                                    <select name="mem_posting_place" id="place_of_post" class="form-controls">
                                        <option value="">Select Posting Place</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-sm-12" style="padding-top: 5px">
                            <input type="file" id="profile_pic" name="profile_pic" class="form-controls"  autocomplete="off" >
                        </div>
                    </div>
                </div>
                <div class="form-group" style='text-align: center;padding-top:15px;margin-left:-50px'>       
                    <input type="submit" value="Register" class="blue_button" >
                </div>
            </form>
        </div>
    </div>   
</div>
@endsection
@push('scripts')
<!--datepicker-->
<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <script>

    $('#entry_dt').datepicker({
            uiLibrary: 'bootstrap4',
			/*dateFormat: "dd-mm-yy"*/
			format: 'dd-mm-yyyy',
        });
        
        $('#birth_dt').datepicker({
            uiLibrary: 'bootstrap4',
			/*dateFormat: "dd-mm-yy"*/
			format: 'dd-mm-yyyy'
        });

        function findDesignationName()
        {
            // alert('hi');
            var des_type = $('#des_type').val();
    //alert(des_type);
            $('#mem_dist_show').hide();
            $('#place_of_post_show').hide();
            if(des_type == "DISTRICT OFFICE" || des_type == "BLOCK OFFICE"){
                $('#mem_dist_show').show();
            }
            if(des_type == "BLOCK OFFICE"){
                $('#place_of_post_show').show();
            }
            $.ajax({
            type : 'post',
            url  : "{{ url('/find_designation_name')}}",
            data: {'des_type' : des_type,
                '_token':$('input[name=_token]').val()},   
            datatype : 'html',
            success:function(data)
            {
            var des_j = '<option value="">Select Designation </option>';
                        $.each( data, function( index, value )
                        {
                            //console.log(index);
                            des_j += '<option value="'+value.des_nm+'">'+value.des_nm+'</option>';
                            });
            $('#des_nm').html(des_j);
            /*var place_of_post = '<option value="">Select </option>';
                        $.each( data, function( index, value )
                        {
                            // console.log(value);
                            place_of_post += '<option value="'+value.des_nm+'">'+value.des_nm+'</option>';
                            });
            $('#place_of_post').html(place_of_post);*/
            /*var mem_dist = '<option value="">Select </option>';
                        $.each( data, function( index, value )
                        {
                            // console.log(value);
                            mem_dist += '<option value="'+value.des_nm+'">'+value.des_nm+'</option>';
                            });
            $('#mem_dist').html(mem_dist);*/
            //place_of_post
            //console.log(data)
            } 
        });
        }
        function findDisName()
        {
            // alert('hi');
            var mem_dist = $('#mem_dist').val();
    //alert(des_type);
            
            $.ajax({
            type : 'post',
            url  : "{{ url('/find_dis_name')}}",
            data: {'mem_dist' : mem_dist,
                '_token':$('input[name=_token]').val()},   
            datatype : 'html',
            success:function(data)
            {
            var place_of_post = '<option value="">Select</option>';
                        $.each( data, function( index, value )
                        {
                            //console.log(index);
                            place_of_post += '<option value="'+value.block_nm+'">'+value.block_nm+'</option>';
                            });
            $('#place_of_post').html(place_of_post);
            
            //console.log(data)
            } 
        });
        }

        function findStateName()
        {
            //  alert('hi');
             var state = $('#state_n').val();
            $.ajax({
            type : 'post',
            url  : "{{ url('/find-state-name')}}",
            data: {'state' : state,
                '_token':$('input[name=_token]').val()},   
            datatype : 'html',
            success:function(data)
            {
            var state = '<option value="">Select </option>';
                        $.each( data, function( index, value )
                        {
                            //console.log(index);
                            state += '<option value="'+value.state_nm+'">'+value.state_nm+'</option>';
                            });
            $('#state_nm').html(state_nm);
            //console.log(data)
            } 
        });
        
        }
    </script>
@endpush