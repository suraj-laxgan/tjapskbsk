<?php
use App\Http\Controllers\CommonController;
?>
@extends('admin.layout.appnext')
@section('title')
	Grant Revoke Office Staff
@endsection
@section('style')
           
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminFunctionHeader')
        <div class="col-md-12">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="0%">&nbsp;</td>
                    <td width="100%">
                        <div class="card-body" style="margin-top: -15px">
                            {{-- <form method="GET" action="{{ url('#') }}"  enctype="multipart/form-data"> --}}
                                <div class="row" >
                                    <div class="col-sm-10" >
                                        <!-- <label>User ID :</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <input type="text" placeholder="Enter User ID " id="userid1" name="admin_user_id" class="form-controls" value="{{ request('userid1') }}" autocomplete="off" >
                                    </div>
                                   
                                    <div class="col-sm-1" >
                                        <!-- <label>&nbsp;&nbsp;</label> -->
                                        <button type='submit' class='button22' id="search_gro"><i class="fa fa-search" style="font-size:20px"></i></button>
                                    </div>
                                    <div class="col-sm-1" style='margin-left:-30px'>
                                        <!-- <label>&nbsp;&nbsp;</label> -->
                                        <a href="{{url('ad-gr-office-staff')}}">
                                            <button type="button" class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                        </a>     
                                    </div>
                                </div>
                            {{-- </form> --}}
                        </div>
                        <div class="card-body" style='margin-top:-30px'>
                            {{-- <div style="color:gray"> <b> Control Users Permission :</b></div> --}}
                                <table   id="customers">
                                    <tr >
                                        <th>User ID</th>
                                        <th>Password</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Remarks</th>
                                    </tr>
                                    @foreach ($grstaff as $grs )
                                    @php
                                        $permision_link = CommonController::permissonLink_2($grs->admin_id,$grs->user_group);
                                    @endphp
                                        <tr>
                                            {{-- <td>{{ $grs->userid }}</td> --}}
                                            <td>{{ $grs->admin_user_id }}</td>
                                            <td>{{ $grs->plan_password }}</td>

                                            {{-- @if(  $grs->status != 'T' ) --}}
                                            @if(  $grs->admin_status != 'T' )
                                                <td style="color:red"><b>Inactive</b></td>
                                            @else
                                                <td style="color:green"><b>Active</b></td>
                                            @endif

                                            <td >
                                                <form method="POST" action="{{ url('ad-gan-rvoff-staff') }}"  enctype="multipart/form-data">
                                                    @csrf 
                                                    {{-- <input type="hidden" value="{{ $grs->userid }}" name='userid'> --}}
                                                    <input type="hidden" value="{{ $grs->admin_user_id }}" name='userid'>
                                                    {{-- @if($grs->status != 'T') --}}
                                                    @if(  $grs->admin_status != 'T' )
                                                        <button style="color:green" name="status" class="button22" value="T">Grant</button>
                                                    @else
                                                        <button style="color:red" name="status" class="button22" value="F">Revoke</button>
                                                    @endif
                                                </form>
                                            </td>
                                            <td>
                                                @if(  $grs->user_group != 'SU' )

                                                <button class="identifyingClass button22" data-id="{{ $grs->admin_id }}" style="color:green">Permission</button>
                                                @else
                                                    <button class="button22"  style="color:red">No Access</button>
                                                @endif
                                                
                                            </td>
                                        </tr>
                                        
                                        <input type="hidden" id="state_per{{ $grs->admin_id }}" value="{{ $permision_link->state_per }}">
                                        <input type="hidden" id="membership_per{{ $grs->admin_id }}" value="{{ $permision_link->membership_per }}">
                                        <input type="hidden" id="master_per{{ $grs->admin_id }}" value="{{ $permision_link->master_per }}">
                                        <input type="hidden" id="mail_per{{ $grs->admin_id }}" value="{{ $permision_link->mail_per }}">
                                        <input type="hidden" id="function_per{{ $grs->admin_id }}" value="{{ $permision_link->function_per }}">
                                    @endforeach
                                </table>
                               
         
                            </div>
                        </div>
                    </td>
                    <td width="0%">&nbsp;</td>
                <tr>
            </table>
        </div>

        <div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="my_modalLabel">
            <div class="modal-dialog "  role="dialog">
                <div class="modal-content" ">
                    <form action="{{ url('update-permission') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Admin User Permission</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        {{-- <input type="text" id="admin_id" name="admin_id" value="{{ $permision_link->admin_id }}"> --}}
                        <div id="modal_data"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
            </div>
    <div> 

@endsection
@push('scripts')
<script>
    $('#search_gro').click(function(){
    var userid1 = $('#userid1').val();
    window.location.href="ad-gr-office-staff?userid1="+userid1;
    });

    $(".identifyingClass").click(function () {
        var admin_id = $(this).attr('data-id');
        var state_per = $("#state_per"+admin_id).val();
        var membership_per = $("#membership_per"+admin_id).val();
        var master_per = $("#master_per"+admin_id).val();
        var mail_per = $("#mail_per"+admin_id).val();
        var function_per = $("#function_per"+admin_id).val();

        var arr = [{'nm':'State','per':state_per},{'nm':'Membership','per':membership_per},{'nm':'Master','per':master_per},{'nm':'Mail','per':mail_per},{'nm':'Function','per':function_per}];
        console.log(arr);
        var data = '';
        $.each(arr , function (index, value) {
            data += '<b>'+value['nm']+'</b>';
            if (value['per'] != "") {
                data += '<input name="'+value['nm']+'" type="checkbox" value="'+value['per']+'" checked>';
            }
            else{
                data += '<input name="'+value['nm']+'" type="checkbox" value="G">';
            }
        });
        data += '<input name="admin_id" type="hidden" value="'+admin_id+'">';
        $("#modal_data").html(data);
        $('#my_modal').modal('show');
        // var data = 'state';
        // if (state_per != "") {
        //     data += '<input type="checkbox" value="'+state_per+'" checked>';
        // }
        // else{
        //     data += '<input type="checkbox" value="'+state_per+'">';
        // }
        // data += 'membership';
        // if (membership_per != "") {
        //     data += '<input type="checkbox" value="'+membership_per+'" checked>';
        // }
        // else{
        //     data += '<input type="checkbox" value="'+membership_per+'">';
        // }
        // data += 'master';
        // if (master_per != "") {
        //     data += '<input type="checkbox" value="'+master_per+'" checked>';
        // }
        // else{
        //     data += '<input type="checkbox" value="'+master_per+'">';
        // }  
        // data += 'mail'; 
        // if (mail_per != "") {
        //     data += '<input type="checkbox" value="'+mail_per+'" checked>';
        // }
        // else{
        //     data += '<input type="checkbox" value="'+mail_per+'">';
        // } 
        // data += 'function';
        // if (function_per != "") {
        //     data += '<input type="checkbox" value="'+function_per+'" checked>';
        // }
        // else{
        //     data += '<input type="checkbox" value="'+function_per+'">';
        // }     
        
        // $(".modal-body #hiddenValue").val(my_id_value);
    });
</script>
@endpush