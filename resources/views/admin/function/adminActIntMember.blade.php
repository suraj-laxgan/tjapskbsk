@extends('admin.layout.appnext')
@section('title')
	Active / Inactive Member
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
                        <div class="card-body">
                            <form method="GET" action="{{ url('#') }}"  enctype="multipart/form-data">
                                @csrf 
                                <div class="row" >
                                    <div class="col-sm-2" >
                                        <!-- <label>Memo No  :</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <input type="text" placeholder="Enter Memo No " id="#" name="#" class="form-controls"  autocomplete="off" >
                                    </div>
                                    <div class="col-sm-2" >
                                        <!-- <label>Member Name:</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <input type="text" placeholder="Enter Member Name" id="#" name="#" class="form-controls"  autocomplete="off" >
                                    </div>
                                    <div class="col-sm-2" >
                                        <!-- <label>Member Name:</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <select name="#" id="#" class="form-controls">
                                            <option value="">Select Media Name</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2" >
                                        <!-- <label>Member Name:</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <select name="#" id="#" class="form-controls">
                                            <option value="">Select Member status</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-1" >
                                        <!-- <label>&nbsp;&nbsp;</label> -->
                                        <input type="submit" name='action_form' value="Search" class="blue_button">
                                    </div>
                                    <div class="col-sm-2" style='margin-left:-30px'>
                                        <!-- <label>&nbsp;&nbsp;</label> -->
                                        <a href="{{url('#')}}">
                                            <button type="button" class="blue_button" >Refresh</button>
                                        </a>    
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body" style='margin-top:-30px'>
                            <div class="row ">
                                <div class="col-sm-6" style='text-align: right'>
                                    <!-- <a href="{{url('#')}}"><button type='button' class='blue_button'>Export To Excel</button></a> -->
                                </div>
                                <div class="col-sm-6" style='text-align: right'>
                                    <a href="{{url('#')}}"><button type='button' class='blue_button'>Export To Excel</button></a>
                                    <a href="{{url('#')}}"><button type='button' class='blue_button'>Export To Pdf</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style='margin-top:-50px'>
                            <div style="color:gray"> <b> Active/Inactive Members :</b></div>
                                <table   id="customers">
                                    <tr >
                                        <th>Name</th>
                                        <th>Guardian</th>
                                        <th>Memo No</th>
                                        <th>Media</th>
                                        <th>Birth Date</th>
                                        <th>Posting Place</th>
                                        <th>Designation</th>
                                        <th>Member since</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </table>   
                            </div>
                        </div>
                    </td>
                    <td width="0%">&nbsp;</td>
                <tr>
            </table>
        </div>
    <div> 

@endsection
@push('scripts')

@endpush