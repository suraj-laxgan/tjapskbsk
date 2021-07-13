@extends('admin.layout.appnext')
@section('title')
	District
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
                                <div class="row">
                                    <div class="col-sm-4" >
                                        <label>District Name :</label>&nbsp;<font color="#FF0000">*</font>
                                        <input type="text" placeholder="Enter District Name " id="#" name="#" class="form-controls"  autocomplete="off" required>
                                    </div>
                                    <div class="col-sm-6"style='margin-top:25px' >
                                        <input type="submit" value="Create" class="blue_button" >
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body" style='margin-top:-30px'>
                            <div style="color:gray"><b>Search Existing District :</b></div>
                            <form method="GET" action="{{ url('#') }}"  enctype="multipart/form-data">
                                @csrf
                                <div class="row"style='margin-top:10px'>
                                    <div class="col-sm-4" >
                                        <!-- <label>District Name:</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <input type="text" placeholder="Enter District Name  " id="#" name="#" class="form-controls"  autocomplete="off">
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
                            <div style="color:gray"> <b>View Existing District :</b></div>
                                <table   id="customers">
                                    <tr >
                                        <th>District Name</th>
                                        <th>Action</th>
                                    </tr>
                                </table>   
                            </div>
                        </div>
                    
                    </td>
                    <td width="0%">&nbsp;</td>
                
                </tr>
            
            </table>
        
        </div>
    
    <div> 
     

@endsection
@push('scripts')

@endpush