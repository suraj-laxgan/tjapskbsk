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
                        <div class="card-body">
                            <form method="GET" action="{{ url('#') }}"  enctype="multipart/form-data">
                                @csrf 
                                <div class="row" >
                                    <div class="col-sm-4" >
                                        <!-- <label>User ID :</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <input type="text" placeholder="Enter User ID " id="#" name="#" class="form-controls"  autocomplete="off" >
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
                            <div style="color:gray"> <b> Control Users Permission :</b></div>
                                <table   id="customers">
                                    <tr >
                                        <th>User ID</th>
                                        <th>Password</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Remarks</th>

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