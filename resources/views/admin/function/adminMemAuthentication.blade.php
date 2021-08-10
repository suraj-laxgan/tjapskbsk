@extends('admin.layout.appnext')
@section('title')
	Member Authentication
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
                            <form method="GET" action="{{ url('#') }}"  enctype="multipart/form-data">
                                <div class="row" >
                                    <div class="col-sm-4" >
                                        <!-- <label>Memo No :</label>&nbsp;<font color="#FF0000">*</font> -->
                                        <input type="text" placeholder="Enter Memo No " id="#" name="#" class="form-controls"  autocomplete="off" >
                                    </div>
                                    <div class="col-sm-4" >
                                        <!-- <label>Member Name  :</label>&nbsp; -->
                                        <input type="text" placeholder="Enter Member Name " id="#" name="#" class="form-controls"  autocomplete="off" >
                                    </div>
                                    <div class="col-sm-1" >
                                        <!-- <label>&nbsp;&nbsp;</label> -->
                                        <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-search" style="font-size:20px"></i></button>
                                    </div>
                                    <div class="col-sm-2" style='margin-left:-30px'>
                                        <!-- <label>&nbsp;&nbsp;</label> -->
                                        <a href="{{url('ad-decal-letter')}}">
                                            <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                        </a>    
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body" style='margin-top:-30px'>
                            {{-- <div style="color:gray"> <b>View Members Authentication :</b></div> --}}
                                <table   id="customers">
                                    <tr >
                                        <th>Name</th>
                                        <th>Memo No</th>
                                        <th>Member Since</th>
                                    </tr>
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

@endpush