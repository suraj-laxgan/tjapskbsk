@extends('admin.layout.appnext')
@section('title')
	Existing Member
@endsection
@section('style')
<style>
   
   
</style>        
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminMembershipHeader')
        <div class="col-md-12" style="margin-top: -15px">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="0%">&nbsp;</td>
                    <td width="100%">
                        <div class="card-body">
                           
                            <form method="GET" action="{{ url('/ad-exismember') }}"  enctype="multipart/form-data">
                               
                                <div class="row">
                                    <div class="col-sm-2" >
                                        <select name="state_id" id="state_n" class="form-controls" onChange="dkName()" >
                                            <option value="">Select State</option>
                                                @foreach($state_name as $sname)
                                                    <option value="{{$sname->state_id}}" {{ request('state_id')== $sname->state_id ? "selected":"" }}>{{$sname->state_nm}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-2" >
                                        <select name="district" id="dis_n" class="form-controls" onChange="blockName()">
                                            <option value="" >Select District</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-2" >
                                        <select name="mem_posting_place" id="mem_posting_place" class="form-controls" >
                                            <option value="">Select Posting Place</option>
                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-2" >
                                        <!-- <label>Select Type :</label>&nbsp; -->
                                        <select name="des_type" id="des_type" class="form-controls">
                                            <option value="">Select Office</option>
                                            <option value="HEAD OFFICE" {{ (request("des_type") == "HEAD OFFICE" ? "selected":"") }}>HEAD OFFICE</option>

                                            <option value="DISTRICT OFFICE" {{ (request("des_type") == "DISTRICT OFFICE" ? "selected":"") }}>DISTRICT OFFICE</option>

                                            <option value="BLOCK OFFICE" {{ (request("des_type") == "BLOCK OFFICE" ? "selected":"") }}>BLOCK OFFICE</option>

                                            <option value="NO OFFICE" {{ (request("des_type") == "NO OFFICE" ? "selected":"") }}>NO OFFICE</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2" >
                                        <select name="media_nm" id="media_nm" class="form-controls">
                                            <option value="">Select Media Name</option>
                                            @foreach($media_na as $media)
                                                <option value="{{$media->media_nm}}" {{ (request("media_nm") == $media->media_nm? "selected":"") }}>{{$media->media_nm}}</option>
                                            @endforeach
                                        </select>
                                        <!-- <label>Media Name :</label>&nbsp; -->
                                            {{-- <select name="#" id="#" class="form-controls">
                                                <option value="">Select Media Name</option>
                                            </select> --}}
                                    </div>
                                    
                                    <div class="col-sm-2" >
                                        <input type="text" id="memo_no" class="register_input" name="memo_no" value="{{request('memo_no')}}"autocomplete="off" />
                                        <label for="register_input" placeholder="Enter Memo No *"></label>
                                    </div>
                                </div>
                                <div class="row" style='margin-top:2px'>
                                    <div class="col-sm-2" >
                                        <input type="text" id="mem_nm" class="register_input" name="mem_nm" value="{{ request('mem_nm') }}" autocomplete="off" />
                                        <label for="register_input" placeholder="Enter Member Name *"></label>
                                    </div>
                                    <div class="col-sm-2" >
                                        <input type="text" id="mem_desig" class="register_input" name="mem_desig" value="{{ request('mem_desig') }}" autocomplete="off" />
                                        <label for="register_input" placeholder="Enter Designation *"></label>
                                    </div>
                                    
                                    <div class="col-sm-2" >
                                        <input type="text" id="guard_nm" class="register_input" name="guard_nm" value="{{ request('guard_nm') }}" autocomplete="off" />
                                        <label for="register_input" placeholder="Enter Guardian name *"></label>
                                    </div>
                                    <div class="col-sm-2" >
                                        <input type="text" id="rand_no" class="register_input" name="rand_no" value="{{ request('rand_no') }}" />
                                        <label for="register_input" placeholder="Enter Barcode No"></label>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-search" style="font-size:20px"></i></button>
                                    </div>
                                    <div class="col-sm-1" style='margin-left:-40px'>
                                            <button type="button" class='button22' onclick="window.location.href='{{url('ad-exismember')}}'"> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body" style='margin-top:-60px'>
                            <div class="row ">
                                <div class="col-sm-6" ></div>
                                <div class="col-sm-6" style='text-align: right'>
                                <a href="{{route('pdf.generatemem',['des_type'=>request('des_type'),
                                        'district'=>request('district'),'memo_no'=>request('memo_no'),'mem_nm'=>request('mem_nm'),'mem_posting_place'=>request('mem_posting_place'),'post_applied_for'=>request('post_applied_for'),'mem_desig'=>request('mem_desig'), 'media_nm'=>request('media_nm'),'guard_nm'=>request('guard_nm') ])}}" target="_blank"><button type='button'  class='button22'>Export To Pdf</button></a>

                                   <a href="{{route('memexcel',['des_type'=>request('des_type'),
                                    'district'=>request('district'),'memo_no'=>request('memo_no'),'mem_nm'=>request('mem_nm'),'mem_posting_place'=>request('mem_posting_place'),'post_applied_for'=>request('post_applied_for'),'mem_desig'=>request('mem_desig'), 'media_nm'=>request('media_nm'),'guard_nm'=>request('guard_nm') ])}}"><button type='button' class='button22'>Export To Excel</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style='margin-top:-55px'>
                            <!-- <div style="color:gray;margin-top:10px"> <b>View Existing Member :</b></div> -->
                            <div>&nbsp;</div>	
                            <table width=100% id="customers">
                                @if (session('msg'))
                                <div class="alert alert-danger">
                                    {{ session('msg') }}
                                </div>
                                @endif
                                <tr >
                                    <th width=5%>Id</th>
                                    <th width=5%>Memo No</th>
                                    <th width=15%>Name</th>
                                    <th width=15%>Guardian</th>
                                    <th width=5%>Qualification</th>
                                    <th width=11%>Birth Date</th>
                                    <th width=5%>Media</th>
                                    <th width=5%>Designation</th>
                                    <th width=14%>Posting Place</th>
                                    <th width=20%>Action</th>
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
                                            
                                           

                                            <a href ="{{url('admin-mem-edit/' .$wb['mem_id'].'?mem_id='.request('mem_id'))}}"class="">
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
   window.open("admin-mem-view/"+mem_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=150,left=350,width=700,height=250");
//    window.open("admin-mem-view?mem_id="+mem_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
});

function dkName()
        {
            //  alert('hi');
             var state_id = $('#state_n').val();
            //  var dis = $('#dis_n').val();
            // console.log(state_id);
            
            $.ajax({
            type : 'post',
            url  : "{{ url('/ajax-find-district-name')}}",
            data: {'state_id' : state_id,
                '_token':$('input[name=_token]').val()},   
            datatype : 'html',
            success:function(data)
            {
                 
            var district_nm = '<option value="">Select District</option>';
                $.each( data, function( index, value )
                {
                    // console.log(index); 
                    district_nm += '<option value="'+value.district_nm+'">'+value.district_nm+'</option>';
                    });
            $('#dis_n').html(district_nm);
            //console.log(data)
            } 
        });
        }

        function blockName() {
            //   alert('hi');
            var state_id = $('#state_n').val();
            var district_nm = $('#dis_n').val();
            // alert(district_nm);
            $.ajax({
            type : 'post',
            url  : "{{ url('/ajax-find-block-name')}}",
            data: {'state_id' : state_id,
                    'district_nm' : district_nm,
                '_token':$('input[name=_token]').val()},   
            datatype : 'html',
            success:function(data)
            {
                 
            var block_nm = '<option value="">Select Posting Place</option>';
                $.each( data, function( index, value )
                {
                    // console.log(index); 
                    block_nm += '<option value="'+value.block_nm+'">'+value.block_nm+'</option>';
                    });
            $('#mem_posting_place').html(block_nm);
            //console.log(data)
            } 
        });
        }
</script>
@endpush