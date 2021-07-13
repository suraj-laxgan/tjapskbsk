@extends('admin.layout.appnext')
@section('title')
	Add Staff
@endsection
@section('style')
           
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminMasterEntryHeader')
        <div class="col-md-12">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="0%">&nbsp;</td>
                    <td width="100%">
                        <div class="card-body">
                            <form method="POST" action="{{ url('#') }}"  enctype="multipart/form-data">
                                @csrf 
                                <div class="row" >
                                    <div class="col-sm-4" >
                                        <label>First  Name :</label>&nbsp;<font color="#FF0000">*</font>
                                        <input type="text" placeholder="Enter First  Name " id="#" name="#" class="form-controls"  autocomplete="off" required>
                                    </div>
                                    <div class="col-sm-4" >
                                        <label>Middle   Name :</label>&nbsp;<font color="#FF0000">*</font>
                                        <input type="text" placeholder="Enter Middle   Name " id="#" name="#" class="form-controls"  autocomplete="off" required>
                                    </div>
                                    <div class="col-sm-4" >
                                        <label>Last   Name :</label>&nbsp;<font color="#FF0000">*</font>
                                        <input type="text" placeholder="Enter Last   Name " id="#" name="#" class="form-controls"  autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="row" style='margin-top:10px'>
                                    <div class="col-sm-3" >
                                        <label>E-Mail :</label>&nbsp;<font color="#FF0000">*</font>
                                        <input type="text" placeholder="Enter e@mail " id="#" name="#" class="form-controls"  autocomplete="off" required>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Mobile No :</label>&nbsp;<font color="#FF0000">*</font>
                                        <input type="text" placeholder="Enter Mobile No " id="#" name="#" class="form-controls"  autocomplete="off" required>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Other Mobile No :</label>&nbsp;
                                        <input type="text" placeholder="Enter Other Mobile No " id="#" name="#" class="form-controls"  autocomplete="off" required>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Land phone No :</label>&nbsp;
                                        <input type="text" placeholder="Enter Land phone No " id="#" name="#" class="form-controls"  autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="row" style='margin-top:10px'>
                                    <div class="col-sm-4" >
                                        <label> </label>
                                        <textarea rows="5" cols="55" placeholder="Enter Address :" id="#" name="#"style='border-radius: 10px;border: 1px solid #ced4da' ></textarea>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>User ID :</label>&nbsp;<font color="#FF0000">*</font>
                                        <input type="text" placeholder="Enter User ID " id="#" name="#" class="form-controls"  autocomplete="off" required>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Password :</label>&nbsp;<font color="#FF0000">*</font>
                                        <input type="text" placeholder="Enter Password " id="#" name="#" class="form-controls"  autocomplete="off" required>
                                    </div>
                                    <div class="col-sm-2"style='margin-top:25px' >
                                        <input type="submit" value="Create" class="blue_button" >
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body" style='margin-top:-30px'>
                            <div style="color:gray"><b>Search Existing Staffs :</b></div>
                            <form method="GET" action="{{ url('#') }}"  enctype="multipart/form-data">
                                @csrf
                                <div class="row"style='margin-top:10px'>
                                    <div class="col-sm-4" >
                                        <!-- <label> First Name:</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <input type="text" placeholder="Enter First Name  " id="#" name="#" class="form-controls"  autocomplete="off">
                                    </div>
                                    <div class="col-sm-4" >
                                        <!-- <label>  Last Name:</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <input type="text" placeholder="Enter  Last Name  " id="#" name="#" class="form-controls"  autocomplete="off">
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
                            <div style="color:gray"> <b>View Existing Staff :</b></div>
                                <table   id="customers">
                                    <tr >
                                        <th>Staff</th>
                                        <th>Staff ID</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>

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