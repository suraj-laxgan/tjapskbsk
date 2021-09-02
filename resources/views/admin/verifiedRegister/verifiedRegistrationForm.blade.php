@extends('admin.layout.appnext')
@section('title')
	Add Verify Register Member 
@endsection
@section('style')
<style>
   
   
</style>        
@endsection
@section('content')
<div class="container-fluid">
    @include('admin.header.verifiedRegisterHeader')
    <div class="col-md-12">
        <div class="card-body">
            @if (session('msg'))
                <div class="alert alert-danger">
                    {{ session('msg') }}
                </div>
            @endif
            <form method="POST" action="{{ url('/ad-verify-member-regis') }}"  enctype="multipart/form-data" >
                @csrf
                <div class='row'>
                    <div class="card-body"style='border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);'>
                        {{-- <div class="" id="mem_dist_show" > --}}
                            <div class="col-sm-12" >
                                    <select name="state_id" id="state_n" class="form-controls" onChange="dkName()">
                                        <option value="">Select State *</option>
                                        @foreach($state_name as $sname)
                                            <option value="{{$sname->state_id}}">{{$sname->state_nm}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('state_nm'))
                                    <div class="text-danger">
                                        {{ $errors->first('state_nm') }}
                                    </div>
                                    @endif
                            </div>
                        {{-- </div> --}}
                        
                        <div class="col-sm-12" style="margin-top: 5px" > 
                            <input type="text" id="mem_nm" class="register_input" name="mem_nm" autocomplete="disable" />
                            <label for="register_input" placeholder="Enter Members Name  *"></label>
                            @if ($errors->has('mem_nm'))
                            <div class="text-danger">
                                {{ $errors->first('mem_nm') }}
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-12">
                            <input type="text" id="media_nm" class="register_input" name="media_nm"   autocomplete="disable"  />
                            <label for="register_input" placeholder="Enter Media Name  *"></label>
                            @if ($errors->has('media_nm'))
                                <div class="text-danger">
                                    {{ $errors->first('media_nm') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12">
                            <input type="text" placeholder="Enter Members From" id="entry_dt" name="entry_dt" class="register_input{{ $errors->has('entry_dt') ? ' is-invalid' : '' }}" autocomplete="disable" readonly="true" style="background-color: #ffffff;" >
                            @if ($errors->has('entry_dt'))
                                <div class="text-danger">
                                    {{ $errors->first('entry_dt') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12" style="padding-top: 5px">
                            <input type="text" id="contact_no" class="register_input" name="contact_no"  autocomplete="disable"  />
                            <label for="register_input" placeholder="Enter Contact No  *"></label>
                            @if ($errors->has('contact_no'))
                                <div class="text-danger">
                                    {{ $errors->first('contact_no') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12">
                            <input type="email" id="mem_email" class="register_input" name="mem_email" autocomplete="off" />
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
                                <input type="text" id="guard_nm" class="register_input" name="guard_nm"  autocomplete="disable"  />
                                <label for="register_input" placeholder="Enter Guardian Name *"></label>
                                @if ($errors->has('guard_nm'))
                                    <div class="text-danger">
                                        {{ $errors->first('guard_nm') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-12" >
                                <select name="gender" id="gender" class="form-controls">
                                    <option value="">Select Gender</option>
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                            <div class="col-sm-12" style='margin-top:5px' >
                                <input type="text" id="mem_cast" class="register_input" name="mem_cast" value="{{ old('mem_cast') }}"  autocomplete="off" />
                                <label for="register_input" placeholder="Enter Cast "></label>
                            </div>
                            <div class="col-sm-12" >
                                {{-- <input type="date" placeholder="Enter Date of Birth " id="birth_dt" name="birth_dt" class="form-controls"  autocomplete="off" > --}}

                                <input type="text" placeholder="Enter Date of Birth" id="birth_dt" name="birth_dt" class="register_input{{ $errors->has('birth_dt') ? ' is-invalid' : '' }}" value="" autocomplete="off" readonly="true" style="background-color: #ffffff;" >
                                @if ($errors->has('birth_dt'))
                                    <div class="text-danger">
                                        {{ $errors->first('birth_dt') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-12" style='margin-top:5px' >
                                <input type="text" id="mem_quali" class="register_input" name="mem_quali" value="{{ old('mem_quali') }}"  autocomplete="off" />
                                <label for="register_input" placeholder="Enter Qualification "></label>
                            </div>
                            <div class="col-sm-12">
                                <textarea name="mem_add" id="mem_add" placeholder="Enter Address "cols="" rows="" class="register_textarea"></textarea>
                                @if ($errors->has('mem_add'))
                                    <div class="text-danger">
                                        {{ $errors->first('mem_add') }}
                                    </div>
                                @endif
                            </div> 
                    </div>&nbsp;
                    <div class="card-body"style='border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);'>
                        <div class="col-sm-12" >
                            <input type="text" id="mem_aadhar_no" class="register_input" name="mem_aadhar_no" value="{{ old('mem_aadhar_no') }}"  autocomplete="off" />
                            <label for="register_input" placeholder="Enter Adhar No*"></label>
                            @if ($errors->has('mem_aadhar_no'))
                                <div class="text-danger">
                                    {{ $errors->first('mem_aadhar_no') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="mem_pan_no" class="register_input" name="mem_pan_no" value="{{ old('mem_pan_no') }}"  autocomplete="off" />
                            <label for="register_input" placeholder="Enter Pan No *"></label>
                                @if ($errors->has('mem_pan_no'))
                                    <div class="text-danger">
                                        {{ $errors->first('mem_pan_no') }}
                                    </div>
                                @endif
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="mem_voterid_no" class="register_input" name="mem_voterid_no" value="{{ old('mem_voterid_no') }}"  autocomplete="off" />
                            <label for="register_input" placeholder="Enter Voter Id No *"></label>
                                @if ($errors->has('mem_voterid_no'))
                                    <div class="text-danger">
                                        {{ $errors->first('mem_voterid_no') }}
                                    </div>
                                @endif
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="bank_acount_no" class="register_input" name="bank_acount_no" value="{{ old('bank_acount_no') }}"  autocomplete="off" />
                            <label for="register_input" placeholder="Enter Bank Account No *"></label>
                            @if ($errors->has('bank_acount_no'))
                                <div class="text-danger">
                                    {{ $errors->first('bank_acount_no') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="mem_bank_nm" class="register_input" name="mem_bank_nm" value="{{ old('mem_bank_nm') }}"  autocomplete="off" />
                            <label for="register_input" placeholder="Enter Bank Name *"></label>
                            @if ($errors->has('mem_bank_nm'))
                                <div class="text-danger">
                                    {{ $errors->first('mem_bank_nm') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="bnk_ifsc_code" class="register_input" name="bnk_ifsc_code" value="{{ old('bnk_ifsc_code') }}"  autocomplete="off" />
                            <label for="register_input" placeholder="Enter Bank IFSC Code *"></label>
                            @if ($errors->has('bnk_ifsc_code'))
                                <div class="text-danger">
                                    {{ $errors->first('bnk_ifsc_code') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12" >
                            <select name="des_type" id="des_type" class="form-controls" onChange="findDesignationName()">
                                {{-- <option value="">Select Office</option> --}}
                                <option value="">Select Office *</option>
                                <option value="HEAD OFFICE">HEAD OFFICE</option>
                                <option value="DISTRICT OFFICE">DISTRICT OFFICE</option>
                                <option value="BLOCK OFFICE">BLOCK OFFICE</option>
                                <option value="NO OFFICE">NO OFFICE</option>
                            </select>
                            @if ($errors->has('des_type'))
                                <div class="text-danger">
                                    {{ $errors->first('des_type') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12" style="padding-top: 5px">
                            <select name="mem_desig" id="des_nm" class="form-controls">
                                <option value="">Select Designation *</option>
                            </select>
                            @if ($errors->has('mem_desig'))
                                <div class="text-danger">
                                    {{ $errors->first('mem_desig') }}
                                </div>
                            @endif
                        </div>
                        <div class="" id="mem_dist_show" style="display:none ;padding-top: 5px">
                            <div class="col-sm-12">
                                <select name="district_nm" id="dis_n" class="form-controls" onChange="blockName()" >
                                    <option value="">Select District</option>
                                    
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
                            @if ($errors->has('profile_pic'))
                                <div class="text-danger">
                                    {{ $errors->first('profile_pic') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group" style='text-align: center;padding-top:15px;margin-left:-50px'>       
                    <input type="submit" value="Verified Register" class="blue_button" >
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('model')

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
            var state_id = $('#state_n').val();
            // var mem_dist = $('#mem_dist').val();
            // alert(state_id);
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
            url  : "{{ url('/verify-designation-name')}}",
            data: {'des_type' : des_type,
                'state_id' : state_id,
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
            } 
        });
        }
       
        function dkName()
        {
            //  alert('hi');
             var state_id = $('#state_n').val();
            //  var dis = $('#dis_n').val();
            // console.log(state_id);
            
            $.ajax({
            type : 'post',
            url  : "{{ url('/ajax-find-district-name')}}",
            data: {'state_id' : state_id,
                '_token':$('input[name=_token]').val()},   
            datatype : 'html',
            success:function(data)
            {
                 
            var district_nm = '<option value="">Select District</option>';
                $.each( data, function( index, value )
                {
                    // console.log(index); 
                    district_nm += '<option value="'+value.district_nm+'">'+value.district_nm+'</option>';
                    });
            $('#dis_n').html(district_nm);
            //console.log(data)
            } 
        });
        }

        function blockName() {
            //   alert('hi');
            var state_id = $('#state_n').val();
            var district_nm = $('#dis_n').val();
            // alert(district_nm);
            $.ajax({
            type : 'post',
            url  : "{{ url('/ajax-find-block-name')}}",
            data: {'state_id' : state_id,
                    'district_nm' : district_nm,
                '_token':$('input[name=_token]').val()},   
            datatype : 'html',
            success:function(data)
            {
                 
            var block_nm = '<option value="">Select Posting Place</option>';
                $.each( data, function( index, value )
                {
                    // console.log(index); 
                    block_nm += '<option value="'+value.block_nm+'">'+value.block_nm+'</option>';
                    });
            $('#place_of_post').html(block_nm);
            //console.log(data)
            } 
        });
        }

        
    </script>
@endpush