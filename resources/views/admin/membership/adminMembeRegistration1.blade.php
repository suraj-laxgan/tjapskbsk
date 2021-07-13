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
            <!-- @section('header_link')
                <button onClick="window.location.href='{{ url('#') }}'" class="header_link_style_1"></button> MEMBERSHIP
            @endsection -->
    
        @include('admin.header.adminMembershipHeader')
            <div class="col-md-12">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="0%">&nbsp;</td>
                        <td width="100%">
                            <div class="col-lg-12">
                                @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ url('/ad-member-regis') }}"  enctype="multipart/form-data">
                                    @csrf
                                        <div class='row'>
                                            <div class="col-sm-6">
                                                <label>Members Name :</label>&nbsp;<font color="#FF0000">*</font>
                                                <input type="text" placeholder="Enter Members Name " id="mem_nm" name="mem_nm" class="form-controls"  autocomplete="off" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Media Name :</label>&nbsp;<font color="#FF0000">*</font>
                                                <input type="text" placeholder="Enter Media Name" id="media_nm" name="media_nm" class="form-controls"  autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class='row' style='margin-top:10px'>
                                            <div class="col-sm-4">
                                                <label>Members From :</label>&nbsp;<font color="#FF0000">*</font>
                                                <input type="date" placeholder="Enter Members From" id="entry_dt" name="entry_dt" class="form-controls"  autocomplete="off" >
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Contact No :</label>&nbsp;<font color="#FF0000">*</font>
                                                <input type="text" placeholder="Enter Contact No" id="contact_no" name="contact_no" class="form-controls"  autocomplete="off" >
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Email Address :</label>&nbsp;<font color="#FF0000">*</font>
                                                <input type="text" placeholder="Enter Email Address" id="mem_email" name="mem_email" class="form-controls"  autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="row" style='margin-top:10px'>
                                            <div class="col-sm-2" >
                                                <label>Guardian Name :</label>&nbsp;<font color="#FF0000">*</font>
                                                    <select name="guard_relatiion" id="guard_relatiion" class="form-controls">
                                                        <option value="">Select</option>
                                                        <option value="FATHER">S/O</option>
                                                        <option value="FATHER">D/O</option>
                                                        <option value="WIFE">W/O</option>
                                                        <option value="HUSBAND">H/O</option>
                                                    </select>
                                            </div>
                                            <div class="col-sm-10" >
                                                <label>&nbsp;</label>&nbsp;
                                                <input type="text" placeholder="Enter Guardian Name " id="guard_nm" name="guard_nm" class="form-controls"  autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2" ><br>
                                                <label>Gender :</label>&nbsp;<font color="#FF0000">*</font>
                                                    <select name="gender" id="gender" class="form-controls">
                                                        <option value="">Select</option>
                                                        <option value="M">M</option>
                                                        <option value="F">F</option>
                                                    </select>
                                            </div>
                                            <div class="col-sm-3" style='margin-top:17px' >
                                                <label>Cast</label>&nbsp;
                                                <input type="text" placeholder="Enter Cast " id="mem_cast" name="mem_cast" class="form-controls"  autocomplete="off" >
                                            </div>
                                            <div class="col-sm-3" style='margin-top:17px' >
                                                <label>Date of Birth</label>&nbsp;
                                                <input type="date" placeholder="Enter Date of Birth " id="birth_dt" name="birth_dt" class="form-controls"  autocomplete="off" >
                                            </div>
                                            <div class="col-sm-4" style='margin-top:17px' >
                                                <label>Qualification</label>&nbsp;
                                                <input type="text" placeholder="Enter Qualification " id="mem_quali" name="mem_quali" class="form-controls"  autocomplete="off" >
                                            </div>
                                        </div><br>
                                        <div class="col-sm-12">
                                            <!-- <label>Address :</label>&nbsp;<font color="#FF0000">*</font> -->
                                            <textarea  rows="5" cols="100" placeholder="Enter Address" id="mem_add" name="mem_add"style='border-radius: 10px;border: 1px solid #ced4da;margin-left:-15px;margin-right:-15px'  autocomplete="off" ></textarea>
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-4" >
                                                <label>Adhar No :</label>&nbsp;
                                                <input type="text" placeholder="Enter Adhar No" id="mem_aadhar_no" name="mem_aadhar_no" class="form-controls"  autocomplete="off" >
                                            </div>
                                            <div class="col-sm-4" >
                                                <label>Pan No :</label>&nbsp;
                                                <input type="text" placeholder="Enter Pan No" id="mem_pan_no" name="mem_pan_no" class="form-controls"  autocomplete="off" >
                                            </div>
                                            <div class="col-sm-4" >
                                                <label>Voter Id No :</label>&nbsp;
                                                <input type="text" placeholder="Enter Voter Id No" id="mem_voterid_no" name="mem_voterid_no" class="form-controls"  autocomplete="off" >
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-sm-4" >
                                                <label>Bank Account No :</label>&nbsp;
                                                <input type="text" placeholder="Enter Bank Account No" id="bank_acount_no" name="bank_acount_no" class="form-controls"  autocomplete="off" >
                                            </div>
                                            <div class="col-sm-4" >
                                                <label>Bank Name :</label>&nbsp;
                                                <input type="text" placeholder="Enter Bank Name" id="mem_bank_nm" name="mem_bank_nm" class="form-controls"  autocomplete="off" >
                                            </div>
                                            <div class="col-sm-4" >
                                                <label>Bank IFSC Code :</label>&nbsp;
                                                <input type="text" placeholder="Enter Bank IFSC Code" id="bnk_ifsc_code" name="bnk_ifsc_code" class="form-controls"  autocomplete="off" >
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-sm-4" >
                                                <label>Select type :</label>&nbsp;<font color="#FF0000">*</font>
                                                    <select name="des_type" id="des_type" class="form-controls" onChange="findDesignationName()">
                                                        <option value="">Select</option>
                                                        <option value="HEAD OFFICE">HEAD OFFICE</option>
                                                        <option value="DISTRICT OFFICE">DISTRICT OFFICE</option>
                                                        <option value="BLOCK OFFICE">BLOCK OFFICE</option>
                                                        <option value="NO OFFICE">NO OFFICE</option>
                                                    </select>
                                             </div>
                                           
                                            <div class="col-sm-4" >
                                                <label>Designation :</label>&nbsp;<font color="#FF0000">*</font>
                                                    <select name="mem_desig" id="des_nm" class="form-controls">
                                                        <option value="">Select</option>
                                                    </select>
                                            </div>
                                          
                                            <div class="col-sm-4" >
                                                <label>Upload your profile picture :</label>&nbsp;<font color="#FF0000">*</font> 
                                                <input type="file" id="profile_pic" name="profile_pic" class="form-controls"  autocomplete="off" required>
                                            </div>
                                        </div>
										<div class="row" id="mem_dist_show" style="display:none">
                                            <div class="col-sm-4" >
                                             </div>
                                            <div class="col-sm-4" >
                                                <label>District Name :</label>&nbsp;<font color="#FF0000">*</font>
                                                    <select name="district" id="mem_dist" class="form-controls" onChange="findDisName()">
                                                        <option value="">Select</option>
														@foreach($mem_dist as $dist)
															<option value="{{$dist->district_nm}}">{{$dist->district_nm}}</option>
														@endforeach
                                                    </select>
                                            </div>
                                            <div class="col-sm-4" >
                                            </div>
                                        </div>
										<div class="row" style="display:none" id="place_of_post_show">
                                            <div class="col-sm-4" >
                                             </div>
                                            <div class="col-sm-4" >
                                                <label>Place of Posting :</label>&nbsp;<font color="#FF0000">*</font>
                                                    <select name="mem_posting_place" id="place_of_post" class="form-controls">
                                                        <option value="">Select</option>
                                                    </select>
                                            </div>
                                            <div class="col-sm-4" >
                                            </div>
                                        </div>
										<br>
                                        <div class="form-group" style='text-align: center;'>       
                                            <input type="submit" value="Register" class="blue_button" >
                                        </div>

                                        
                                </form>
                            </div>

                        </td>
                        <td width="0%">&nbsp;</td>

                    </tr>

                </table>
                
            </div>

    
</div>   
@endsection
@push('scripts')
    <script>
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
            var des_j = '<option value="">Select </option>';
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
            var place_of_post = '<option value="">Select </option>';
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
    </script>
@endpush