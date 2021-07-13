@extends('admin.layout.appnext')
@section('title')
	Joining Letter
@endsection
@section('style')
<style>
   
    #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #e6e6e6;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #6666ff;
    color: white;
    }
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
                                        <div class="col-sm-3" style='margin-left:-30px'  >
                                            <!-- <label>&nbsp;&nbsp;</label> -->
                                            <a href="{{url('#')}}">
                                                <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                            </a>    
                                        </div>
                                    </div>
                            </form>
                        </div>
                        <div>&nbsp;</div>	
                        <div class="card-body" style='margin-top:-50px'>
                            <!-- <div style="text-align:center;color:gray"> <h6>View Joining Letter:</h6></div> -->
                                <table id="customers">
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