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
                        <div class="card-body" style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);  margin-bottom: 30px;">
                            {{-- <div style="color:gray"><b>Search Existing Organiser :</b></div> --}}
                            {{-- <form method="GET" action="{{ url('#') }}"  enctype="multipart/form-data"> --}}
                                <div class="row"style='margin-top:10px'>
                                    <div class="col-sm-8" >
                                        <input type="text" id="organiser_nm" class="register_input" name="organiser_nm"  value="{{ request('organiser_nm') }}"/>
                                        <label for="register_input" placeholder="Enter Organiser Name "></label>
                                    </div>
                                    <div class="col-sm-2" >
                                        <!-- <label>&nbsp;&nbsp;</label> -->
                                        <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-search" style="font-size:20px"></i></button>
                                    </div>
                                    <div class="col-sm-2" style='margin-left:-30px'>
                                        <!-- <label>&nbsp;&nbsp;</label> -->
                                        <a href="{{url('/ad-organiser')}}">
                                            <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                        </a>    
                                    </div>
                                </div>
                            {{-- </form> --}}
                        </div> &nbsp;

                        <div class="card-body" style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);  margin-bottom: 30px;">
                            <form method="POST" action="{{ url('/ad-organiser-save') }}"  enctype="multipart/form-data">
                                @csrf 
                                <div class="row">
                                    <div class="col-sm-8" >
                                        <input type="text" id="" class="register_input" name="organiser_nm" />
                                        <label for="register_input" placeholder="Enter Organiser Name "></label>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type='submit' class='button22' id=""><i class="fa fa-plus" style="font-size:20px"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="card-body" style="margin-top: -40px">
                        @if (session('msg'))
                            <div class="alert  text-success">
                                {{ session('msg') }}
                            </div>
                        @endif
                        {{-- <div style="color:gray"> <b>View Existing Organiser :</b></div> --}}
                            <table   id="customers">
                                <tr >
                                    <th>Organiser Name</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($organi as $orga )
                                    <tr>
                                        <td>{{ $orga->organiser_nm }}</td>
                                        <td>
                                            <a href="delete-organiser/{{ $orga->organiser_id }}">Delete</a>
                                            {{-- <button>Delete</button> --}}
                                        </td>
                                    </tr>
                                @endforeach
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
<script>
    $("#search_tn_1").click(function() { 
   var organiser_nm =  $("#organiser_nm").val();
   window.location.href = "ad-organiser?organiser_nm="+organiser_nm;
   });
</script>
@endpush