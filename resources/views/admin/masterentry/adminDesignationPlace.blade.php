@extends('admin.layout.appnext')
@section('title')
	Designation Place
@endsection
@section('style')
<style>


</style>
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminMasterEntryHeader')
        <div class="col-md-12">
            <div class="row">
                <div class="card-body"style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);">
                    {{-- <div style="color:gray"><b>Existing Designation :</b></div> --}}
                    <form method="GET" action="{{ url('#') }}"  enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4" >
                                <!-- <label>Select Type :</label>&nbsp;<font color="#FF0000">*</font> -->
                                    <select name="#" id="#" class="form-controls" >
                                        <option value="">Select Type </option>
                                    </select>
                            </div>
                            <div class="col-sm-4" >
                                <input type="text" id="#" class="register_input" name="#" value="{{ old('#') }}" required autocomplete="off"/>
                                <label for="register_input" placeholder="Enter Designation "></label>
                            </div>
                            <div class="col-sm-2" >
                                <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-search" style="font-size:20px"></i></button>
                            </div>
                            <div class="col-sm-2" style='margin-left:-30px'>
                                <!-- <label>&nbsp;&nbsp;</label> -->
                                <a href="{{url('#')}}">
                                    <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                </a>    
                            </div>
                        </div>
                    </form>
                </div>&nbsp;
                <div class="card-body"style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);">
                    <form method="POST" action="{{ url('#') }}"  enctype="multipart/form-data">
                        @csrf 
                        <div class="row">
                            <div class="col-sm-3" >
                                    <select name="#" id="#" class="form-controls" required>
                                        <option value="">Select Type</option>
                                    </select>
                            </div>
                            <div class="col-sm-3" >
                                <input type="text" id="#" class="register_input" name="#" value="{{ old('#') }}" required autocomplete="off"/>
                                <label for="register_input" placeholder="Enter Sl No "></label>
                            </div>
                            <div class="col-sm-3" >
                                <input type="text" id="#" class="register_input" name="#" value="{{ old('#') }}" required autocomplete="off"/>
                                <label for="register_input" placeholder="Enter Designation Name "></label>
                            </div>
                            <div class="col-sm-3" >
                                <input type="text" id="#" class="register_input" name="#" value="{{ old('#') }}" required autocomplete="off"/>
                                <label for="register_input" placeholder="Enter No of Post "></label>
                            </div>
                        </div>    
                            <div class="col-sm-12" >
                                <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-plus" style="font-size:20px"></i></button>
                            </div>
                    </form>
                </div>
            </div>
            <div class="card-body" >
                {{-- <div style="color:gray"> <b>View Existing Designation :</b></div> --}}
                    <table   id="customers">
                        <tr >
                            <th>Type of place</th>
                            <th>Serial no</th>
                            <th>Designation</th>
                            <th>No of post</th>
                            <th>Action</th>
                        </tr>
                    </table>   
                </div>
            </div>
        </div>
    <div> 
@endsection
@push('scripts')

@endpush