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
           
            <div class="row">
                <div class="card-body" style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);  margin-bottom: 30px;">
                    {{-- <div style="color:gray;font-size:12px;margin-top:-20px"><b><u>Search District :</u></b></div> --}}
                
                    {{-- <form method="GET" action="{{ url('#') }}"  enctype="multipart/form-data"> --}}
                        <div class="row"style='margin-top:2px'>
                            <div class="col-sm-4" >
                                <select name="state_nm" id="state_nm" class="form-controls" required>
                                    <option value="">Select State</option>
                                    @foreach($state as $sname)
                                        <option value="{{$sname->state_nm}}" {{ request('state_nm')== $sname->state_nm ? "selected":"" }} >{{$sname->state_nm}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4" >
                                <input type="text" id="district_nm" class="register_input" name="district_nm" value="{{ request('district_nm') }}" />
                                <label for="register_input" placeholder="Enter District Name "></label>
                            </div>
                            <div class="col-sm-2" >
                                <!-- <label>&nbsp;&nbsp;</label> -->
                                <button type='submit' class='button22' id="search_district"><i class="fa fa-search" style="font-size:20px"></i></button>
                            </div>
                            <div class="col-sm-2" style='margin-left:-30px'>
                                <!-- <label>&nbsp;&nbsp;</label> -->
                                <a href="{{url('/ad-districts')}}">
                                    <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                </a>    
                            </div>
                        </div>
                    {{-- </form> --}}
                </div>&nbsp;
                <div class="card-body"style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);  margin-bottom: 30px;">
                    {{-- <div style="color:gray;font-size:12px;margin-top:-20px"><b><u>Add District :</u></b></div> --}}
                    <form method="POST" action="{{ url('/ad-districts-save') }}"  enctype="multipart/form-data">
                        @csrf 
                        <div class="row" style='margin-top:2px'>
                            <div class="col-sm-4" >
                                <select name="state_id" id="state_n" class="form-controls" >
                                    <option value="">Select State</option>
                                    @foreach($state as $sname)
                                        <option value="{{$sname->state_id}}">{{$sname->state_nm}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('state_id'))
                                    <span class="text-danger">
                                        {{ $errors->first('state_id') }}
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-4" >
                                {{-- <label>District Name :</label>&nbsp;<font color="#FF0000">*</font> --}}
                                {{-- <input type="text" placeholder="Enter District Name " id="#" name="#" class="form-controls"  autocomplete="off" required> --}}
                                <input type="text" id="district_nm" class="register_input" name="district_nm" required />
                                    <label for="register_input" placeholder="Enter District Name "></label>
                                    @if ($errors->has('district_nm'))
                                    <span class="text-danger">
                                        {{ $errors->first('district_nm') }}
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <button type='submit' class='button22' id=""><i class="fa fa-plus" style="font-size:20px"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                
                </div>
                    <div class="card-body" style='margin-top:-40px'>
                        {{-- <div style="color:gray"> <b>View Existing District :</b></div> --}}
                            @if (session('msg'))
                                <div class="alert  alert-success">
                                    {{ session('msg') }}
                                </div>
                            @endif
                            <table   id="customers">
                                <tr >
                                    <th>State Name</th>
                                    <th>District Name</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($district as $dist )
                                    <tr>
                                        <td>{{ $dist->state_nm }}</td>
                                        <td>{{ $dist->district_nm }}</td>
                                        <td>
                                            <a href="ad-district-edit/{{ $dist->district_id  }}" style="color: green">Edit</a>&nbsp;
                                            <a href="delete-district/{{ $dist->district_id  }}" style="color: red">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>  
                            {{ $district->links() }} 
                        </div>
                    </div>
                </div> 
            </div>
        </div>

@endsection
@push('scripts')
<script>
    $("#search_district").click(function() { 
   var district_nm =  $("#district_nm").val();
   var state_nm = $('#state_nm').val();
   window.location.href = "ad-districts?district_nm="+district_nm+"&state_nm="+state_nm;
   });
</script>
@endpush