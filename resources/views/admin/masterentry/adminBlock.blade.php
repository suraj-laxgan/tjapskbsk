@extends('admin.layout.appnext')
@section('title')
	Block
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
                        <div class="row">
                            <div class="card-body"style='border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);'>
                                {{-- <div style="color:gray"><b>Search Existing Block :</b></div> --}}
                                <form method="GET" action="{{ url('#') }}"  enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4" >
                                            <!-- <label>District Name :</label>&nbsp;<font color="#FF0000">*</font> -->
                                                <select name="#" id="#" class="form-controls" >
                                                    <option value="">Select District Name</option>
                                                </select>
                                        </div>
                                        <div class="col-sm-4" >
                                            <input type="text" id="#" class="register_input" name="#" value="{{ old('#') }}" required autocomplete="off"/>
                                            <label for="register_input" placeholder="Enter Block Name  "></label>
                                        </div>
                                        <div class="col-sm-1" >
                                            <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-search" style="font-size:20px"></i></button>
                                        </div>
                                        <div class="col-sm-2" >
                                            <!-- <label>&nbsp;&nbsp;</label> -->
                                            <a href="{{url('#')}}">
                                                <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                            </a>    
                                        </div>
                                    </div>
                                </form>
                            </div>&nbsp;
                            <div class="card-body"style='border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);'>
                                <form method="POST" action="{{ url('#') }}"  enctype="multipart/form-data">
                                    @csrf 
                                    <div class="row">
                                        <div class="col-sm-4" >
                                            {{-- <label>District Name :</label>&nbsp;<font color="#FF0000">*</font> --}}
                                                <select name="#" id="#" class="form-controls" required>
                                                    <option value="">Select District Name</option>
                                                </select>
                                        </div>
                                        <div class="col-sm-4" >
                                            <input type="text" id="#" class="register_input" name="#" value="{{ old('#') }}" required autocomplete="off"/>
                                            <label for="register_input" placeholder="Enter Block Name  "></label>
                                        </div>
                                        <div class="col-sm-4" >
                                            <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-plus" style="font-size:20px"></i></button>

                                            {{-- <input type="submit" value="Create" class="blue_button" > --}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                        <div class="card-body" style="margin-top: -10px">
                            {{-- <div style="color:gray"> <b>View Existing Block :</b></div> --}}
                                <table   id="customers">
                                    <tr >
                                        <th>Block Name</th>
                                        <th>District Name</th>
                                        <th>Action</th>
                                    </tr>
                                </table>   
                            {{-- </div> --}}
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