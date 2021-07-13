@extends('admin.layout.appnext')
@section('title')
	Appointment Letter
@endsection
@section('style')
<style>
    
    
</style>        
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminMembershipHeader')
        <div class="col-md-12">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="0%">&nbsp;</td>
                    <td width="100%">
                    <div class="card-body">
                        <form method="GET" action="{{ url('#') }}"  enctype="multipart/form-data">
                            @csrf 
                                <div class="row">
                                    <div class="col-sm-4" >
                                        <input type="text" id="#" class="register_input" name="#" value="{{ old('#') }}" required/>
                                        <label for="register_input" placeholder="Enter Memo No *"></label>
                                    </div>
                                    <div class="col-sm-4" >
                                        <input type="text" id="#" class="register_input" name="#" value="{{ old('#') }}" required/>
                                        <label for="register_input" placeholder="Enter Name *"></label>
                                    </div>
                                    <div class="col-sm-1" >
                                        <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-search" style="font-size:20px"></i></button>
                                    </div>
                                    <div class="col-sm-3" style='margin-left:-40px'  >
                                        <a href="{{url('#')}}">
                                            <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                        </a>    
                                    </div>
                                </div>
                        </form > 
                    </div>
                    <div class="card-body" style='margin-top:-30px'>
                        <!-- <div style="text-align:center;color:gray"> <h6>View Appointmemt Letter :</h6></div> -->
                            <table   id="customers">
                                <tr >
                                    <th>Memo No</th>
                                    <th>Name</th>
                                    <th>Guardian name</th>
                                    <th>Media Name</th>
                                    <th>Joining Letter</th>
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