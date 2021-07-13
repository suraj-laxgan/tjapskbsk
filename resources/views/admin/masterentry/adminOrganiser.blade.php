@extends('admin.layout.appnext')
@section('title')
	Organiser
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

                        <div class="card-body" style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);">
                            <form method="POST" action="{{ url('#') }}"  enctype="multipart/form-data">
                                @csrf 
                                <div class="row">
                                    <div class="col-sm-4" >
                                        <input type="text" id="" class="register_input" name=""  />
                                        <label for="register_input" placeholder="Enter Organiser Name "></label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="submit" value="Create" class="button22" >
                                    </div>
                                </div>
                            </form>
                        </div>&nbsp;
                        
                        <div class="card-body" style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);">
                            {{-- <div style="color:gray"><b>Search Existing Organiser :</b></div> --}}
                            <form method="GET" action="{{ url('#') }}"  enctype="multipart/form-data">
                                @csrf
                                <div class="row"style='margin-top:10px'>
                                    <div class="col-sm-4" >
                                        <input type="text" id="" class="register_input" name=""  />
                                        <label for="register_input" placeholder="Enter Organiser Name "></label>
                                    </div>
                                    <div class="col-sm-4" >
                                        <!-- <label>&nbsp;&nbsp;</label> -->
                                        <input type="submit" name='action_form' value="Search" class="button22">
                                    </div>
                                    <div class="col-sm-4" style='margin-left:-30px'>
                                        <!-- <label>&nbsp;&nbsp;</label> -->
                                        <a href="{{url('#')}}">
                                            <button type="button" class="button22" >Refresh</button>
                                        </a>    
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="card-body" >
                        {{-- <div style="color:gray"> <b>View Existing Organiser :</b></div> --}}
                            <table   id="customers">
                                <tr >
                                    <th>Organiser Name</th>
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