@extends('stateUser.layout.appnext')
@section('title')
	State User Existing Member
@endsection
@section('style')
<style>
   
   
</style>        
@endsection
@section('content')
    <div class="container-fluid">
        @section('header_link')
         <h6 style="margin-left:35px">
            <u>Existing Member for : {{ Auth::guard('stateUser')->user()->state_nm }}</u>  
        </h6>
        @endsection 
        @include('stateUser.header.stateUserMembershipHeader')
        <div class="col-md-12" style="margin-top: -15px">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="0%">&nbsp;</td>
                    <td width="100%">
                        <div class="card-body">
                            @if (session('msg'))
                                <div class="alert alert-success">
                                    {{ session('msg') }}
                                </div>
                            @endif
                            <form method="GET" action="{{ url('/state-exismember') }}"  enctype="multipart/form-data">
                               
                                <div class="row">
                                    <div class="col-sm-2" >
                                        <!-- <label>Select Type :</label>&nbsp; -->
                                        <select name="des_type" id="des_type" class="form-controls" onChange="findDesignationName()">
                                            <option value="">Select Office</option>
                                            <option value="HEAD OFFICE">HEAD OFFICE</option>
                                            <option value="DISTRICT OFFICE">DISTRICT OFFICE</option>
                                            <option value="BLOCK OFFICE">BLOCK OFFICE</option>
                                            <option value="NO OFFICE">NO OFFICE</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2" >
                                        <select name="district" id="district" class="form-controls">
                                            <option value="">Select District</option>
                                            @foreach($mem_dist as $dist)
                                                <option value="{{$dist->district_nm}}">{{$dist->district_nm}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-2" >
                                        <input type="text" id="memo_no" class="register_input" name="memo_no" autocomplete="off" />
                                        <label for="register_input" placeholder="Enter Memo No *"></label>
                                    </div>
                                    <div class="col-sm-2" >
                                        <input type="text" id="mem_nm" class="register_input" name="mem_nm" value="{{ old('mem_nm') }}" autocomplete="off" />
                                        <label for="register_input" placeholder="Enter Member Name *"></label>
                                    </div>
                                    <div class="col-sm-2" >
                                        <select name="mem_posting_place" id="mem_posting_place" class="form-controls">
                                            <option value="">Select Posting place</option>
                                            @foreach($block_name as $posting)
                                                <option value="{{$posting->block_nm}}">{{$posting->block_nm}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-2" >
                                        <input type="text" id="mem_desig" class="register_input" name="mem_desig" value="{{ old('mem_desig') }}" autocomplete="off" />
                                        <label for="register_input" placeholder="Enter Designation *"></label>
                                    </div>
                                </div>
                                <div class="row" style='margin-top:2px'>
                                    <div class="col-sm-2" >
                                        <select name="media_nm" id="media_nm" class="form-controls">
                                            <option value="">Select Media Name</option>
                                            @foreach($media_na as $media)
                                                <option value="{{$media->media_nm}}">{{$media->media_nm}}</option>
                                            @endforeach
                                        </select>
                                        <!-- <label>Media Name :</label>&nbsp; -->
                                            {{-- <select name="#" id="#" class="form-controls">
                                                <option value="">Select Media Name</option>
                                            </select> --}}
                                    </div>
                                    <div class="col-sm-2" >
                                        <input type="text" id="guard_nm" class="register_input" name="guard_nm" value="{{ old('guard_nm') }}" autocomplete="off" />
                                        <label for="register_input" placeholder="Enter Guardian name *"></label>
                                    </div>
                                    <div class="col-sm-2" >
                                        <input type="text" id="#" class="register_input" name="#" value="{{ old('#') }}" />
                                        <label for="register_input" placeholder="Enter Barcode No"></label>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-search" style="font-size:20px"></i></button>
                                    </div>
                                    <div class="col-sm-1" style='margin-left:-40px'>
                                        <a href="{{url('/state-exismember')}}">
                                            <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                        </a>    
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body" style='margin-top:-60px'>
                            <div class="row ">
                                <div class="col-sm-6" ></div>
                                <div class="col-sm-6" style='text-align: right'>
                                    <a href="{{route('pdf.generatestate',['des_type'=>request('des_type'),
                                        'district'=>request('district'),'memo_no'=>request('memo_no'),'mem_nm'=>request('mem_nm'),'mem_posting_place'=>request('mem_posting_place'),'post_applied_for'=>request('post_applied_for'),'mem_desig'=>request('mem_desig'), 'media_nm'=>request('media_nm'),'guard_nm'=>request('guard_nm') ])}}" target="_blank"><button type='button'  class='button22'>Export To Pdf</button></a>

                                    <a href="{{route('memexcel.state',['des_type'=>request('des_type'),
                                    'district'=>request('district'),'memo_no'=>request('memo_no'),'mem_nm'=>request('mem_nm'),'mem_posting_place'=>request('mem_posting_place'),'post_applied_for'=>request('post_applied_for'),'mem_desig'=>request('mem_desig'), 'media_nm'=>request('media_nm'),'guard_nm'=>request('guard_nm') ])}}"><button type='button' class='button22'>Export To Excel</button></a>

                                </div>
                            </div>
                        </div>
                        <div class="card-body" style='margin-top:-55px'>
                            <!-- <div style="color:gray;margin-top:10px"> <b>View Existing Member :</b></div> -->
                            <div>&nbsp;</div>	
                            <table width=100% id="customers">
                                <tr >
                                    <th width=5%>Id</th>
                                    <th width=5%>Memo No</th>
                                    <th width=15%>Name</th>
                                    <th width=15%>Guardian</th>
                                    <th width=5%>Qualification</th>
                                    <th width=11%>Birth Date</th>
                                    <th width=5%>Media</th>
                                    <th width=10%>Designation</th>
                                    <th width=14%>Posting Place</th>
                                    <th width=15%>Action</th>
                                </tr>
                                @if ($wbappli_total > 0)
                                    @foreach ($wbappli as $wb)
                                    <tr >
                                        <td>{{ $wb["mem_id"]}}</td>
                                        <td>{{ $wb["memo_no"]}}</td>
                                        <td>{{ $wb["mem_nm"]}}</td>
                                        <td>{{ $wb["guard_nm"]}}</td>
                                        <td>{{ $wb["mem_quali"]}} </td>
                                        <td>{{ $wb["birth_dt"]}}</td>
                                        <td>{{ $wb["media_nm"]}}</td>
                                        <td>{{ $wb["mem_desig"]}}</td>
                                        <td>{{ $wb["mem_posting_place"]}}</td>
                                        <td>
                                            <button class="btn_view button22" id="{{ $wb["mem_id"]}}">View</button>
                                          
                                            <a href ="{{url('state-mem-edit/' .$wb['mem_id'].'?mem_id='.request('mem_id'))}}"class="">
                                            <i class="fa fa-edit" style="font-size:16px;padding-left:15px"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else 
                                    <tr>
                                        <td colspan="10" style="text-align:center">No data found !!!</td>
                                    </tr>
                                @endif
                            </table> 
                            {{$wbappli->links()}}  
                        </div>

                    
                    </td>
                    <td width="0%">&nbsp;</td>

                </tr>
            </table>
        
        </div>

        
    <div> 

@endsection
@section('model')
<!-- Modal -->
{{-- <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog"> --}}

        <!-- Modal content-->
        {{-- <div class="modal-content"> --}}
            {{-- <div class="modal-header"> --}}
                {{-- <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4> --}}
            {{-- </div> --}}
            {{-- <div class="modal-body" sty>
                <p>Some text in the modal.</p>
               
            </div> --}}
            {{-- <div class="modal-footer" >
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> --}}
        {{-- </div> --}}
    {{-- </div> --}}
{{-- </div> --}}

@endsection
@push('scripts')
<script>

$(".btn_view").click(function() {
   var mem_id =  $(this).attr('id');
   console.log(mem_id);
   window.open("state-mem-view/"+mem_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=150,left=350,width=700,height=250");
//    window.open("admin-mem-view?mem_id="+mem_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
});

</script>
@endpush