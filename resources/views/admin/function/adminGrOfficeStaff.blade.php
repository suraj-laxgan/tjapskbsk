@extends('admin.layout.appnext')
@section('title')
	Grant Revoke Office Staff
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
                            {{-- <form method="GET" action="{{ url('#') }}"  enctype="multipart/form-data"> --}}
                                <div class="row" >
                                    <div class="col-sm-10" >
                                        <!-- <label>User ID :</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <input type="text" placeholder="Enter User ID " id="userid1" name="userid" class="form-controls" value="{{ request('userid1') }}" autocomplete="off" >
                                    </div>
                                   
                                    <div class="col-sm-1" >
                                        <!-- <label>&nbsp;&nbsp;</label> -->
                                        <button type='submit' class='button22' id="search_gro"><i class="fa fa-search" style="font-size:20px"></i></button>
                                    </div>
                                    <div class="col-sm-1" style='margin-left:-30px'>
                                        <!-- <label>&nbsp;&nbsp;</label> -->
                                        <a href="{{url('ad-gr-office-staff')}}">
                                            <button type="button" class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                        </a>     
                                    </div>
                                </div>
                            {{-- </form> --}}
                        </div>
                        <div class="card-body" style='margin-top:-30px'>
                            {{-- <div style="color:gray"> <b> Control Users Permission :</b></div> --}}
                                <table   id="customers">
                                    <tr >
                                        <th>User ID</th>
                                        <th>Password</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        {{-- <th>Remarks</th> --}}
                                    </tr>
                                    @foreach ($grstaff as $grs )
                                        <tr>
                                            <td>{{ $grs->userid }}</td>
                                            <td>{{ $grs->password }}</td>

                                            @if(  $grs->status != 'T' )
                                                <td style="color:red"><b>Inactive</b></td>
                                            @else
                                                <td style="color:green"><b>Active</b></td>
                                            @endif

                                            <td >
                                                <form method="POST" action="{{ url('ad-gan-rvoff-staff') }}"  enctype="multipart/form-data">
                                                    @csrf 
                                                    <input type="hidden" value="{{ $grs->userid }}" name='userid'>
                                                    @if($grs->status != 'T')
                                                        <button style="color:green" name="status" class="button22" value="T">Grant</button>
                                                    @else
                                                        <button style="color:red" name="status" class="button22" value="F">Revoke</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
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
<script>
    $('#search_gro').click(function(){
    var userid1 = $('#userid1').val();
    window.location.href="ad-gr-office-staff?userid1="+userid1;
    });
</script>
@endpush