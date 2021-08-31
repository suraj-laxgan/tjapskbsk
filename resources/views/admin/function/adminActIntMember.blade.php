@extends('admin.layout.appnext')
@section('title')
	Active / Inactive Member
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
                        <div class="card-body" style="margin-top: -15px">
                                <div class="row" >
                                    <div class="col-sm-2" >
                                        <!-- <label>Memo No  :</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <input type="text" placeholder="Enter Memo No " id="memo_no_1" name="memo_no_1" class="form-controls" value="{{ request('memo_no_1') }}" autocomplete="off" >
                                    </div>
                                    <div class="col-sm-2" >
                                        <!-- <label>Member Name:</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <input type="text" placeholder="Enter Member Name" id="mem_nm_1" name="mem_nm_1" class="form-controls"  autocomplete="off" value="{{ request('mem_nm_1') }}">
                                    </div>
                                    <div class="col-sm-2" >
                                        <!-- <label>Member Name:</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <select name="media_nm_1" id="media_nm_1" class="form-controls">
                                            <option value="">Select Media Name</option>
                                            @foreach($media_na as $media)
                                                <option value="{{$media->media_nm}}">{{$media->media_nm}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-2" >
                                        <!-- <label>Member Name:</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <select name="mem_stat_1" id="mem_stat_1" class="form-controls">
                                            <option value="">Select Member status</option>
                                            <option value="A" {{ request('mem_stat_1')=='A'?"selected":"" }}>Active</option>
                                            <option value="D">In Active</option>

                                        </select>
                                    </div>
                                    <div class="col-sm-1" >
                                        <!-- <label>&nbsp;&nbsp;</label> -->
                                        <button type="button" class='button22' id="search_mem"><i class="fa fa-search" style="font-size:20px"></i></button>
                                    </div>
                                    <div class="col-sm-2" style='margin-left:-30px'>
                                        <!-- <label>&nbsp;&nbsp;</label> -->
                                        <a href="{{url('/ad-ac-in-mem')}}">
                                            <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                        </a>       
                                    </div>
                                </div>
                         
                        </div>
                        <div class="card-body" style='margin-top:-45px'>
                            <div class="row ">
                                <div class="col-sm-6" style='text-align: right'>
                                    <!-- <a href="{{url('#')}}"><button type='button' class='blue_button'>Export To Excel</button></a> -->
                                </div>
                                <div class="col-sm-6" style='text-align: right'>
                                    <a href="{{route('activeInactiveExcel',['memo_no_1'=>request('memo_no_1'),'mem_nm_1'=>request('mem_nm_1'),'media_nm_1'=>request('media_nm_1'),'mem_stat_1'=>request('mem_stat_1')])}}"><button type='button' class='button22'>Export To Excel</button></a>

                                    <a href="{{route('pdf.activeInactive',['memo_no_1'=>request('memo_no_1'),'mem_nm_1'=>request('mem_nm_1'),'media_nm_1'=>request('media_nm_1'),'mem_stat_1'=>request('mem_stat_1')])}}" target="blank"><button type='button' class='button22'>Export To Pdf</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style='margin-top:-35px'>
                            {{-- <div style="color:gray"> <b> Active/Inactive Members :</b></div> --}}
                                <table   id="customers">
                                    <tr >
                                        <th>Name</th>
                                        <th>Guardian</th>
                                        <th>Memo No</th>
                                        <th>Media</th>
                                        <th>Birth Date</th>
                                        <th>Posting Place</th>
                                        <th>Designation</th>
                                        <th>Member since</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($acintive as $act )
                                        <tr>
                                            <td>{{ $act->mem_nm }}</td>
                                            <td>{{ $act->guard_nm }}</td>
                                            <td>{{ $act->memo_no }}</td>
                                            <td>{{ $act->media_nm }}</td>
                                            <td>{{ $act->birth_dt }}</td>
                                            <td>{{ $act->mem_posting_place }}</td>
                                            <td>{{ $act->mem_desig }}</td>
                                            <td>{{ $act->entry_dt }}</td>
                                                @if($act->mem_stat != 'A')
                                                    <td style="color:red"> <b>Inactive</b></td>
                                                @else
                                                    <td style="color:green"><b>Active</b></td>
                                                @endif
                                            
                                            <td >
                                                <form method="POST" action="{{ url('ad-revoke-mem-up') }}"  enctype="multipart/form-data">
                                                    @csrf 
                                                    <input type="hidden" value="{{  $act->mem_id }}" name='mem_id'>
                                                    @if($act->mem_stat != 'A')
                                                        <button style="color:green" name="mem_stat" class="button22" value="A">Grant</button>
                                                    @else
                                                        <button style="color:red" name="mem_stat" class="button22" value="D">Revoke</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>  
                                {{ $acintive->links() }} 
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
<script>
    $('#search_mem').click(function(){
        var memo_no_1 = $('#memo_no_1').val();
        var mem_nm_1 = $('#mem_nm_1').val();
        var media_nm_1 = $('#media_nm_1').val();
        var mem_stat_1 = $('#mem_stat_1').val();
        window.location.href = "ad-ac-in-mem?memo_no_1="+memo_no_1+"&mem_nm_1="+mem_nm_1+"&media_nm_1="+media_nm_1+"&mem_stat_1="+mem_stat_1;
    });
</script>
@endpush