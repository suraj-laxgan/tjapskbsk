@extends('admin.layout.appnext')
@section('title')
	Admin State View
@endsection
@section('style')
<style>
    
    
</style>  
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminStateheader')
        <div class="card-body" style="margin-top: -15px">
            
            <form method="GET" action="{{ url('/admin-state-view') }}"enctype="multipart/form-data" >
                <div class='row'>
                    <div class="col-sm-4" >
                        <input type="text" id="state_id" class="register_input" 
                        name="state_id" value="{{ request('state_id') }}" 
                         autocomplete="off"/>
                        <label for="register_input" placeholder="Enter State Id "></label>
                            {{-- <input type="text" placeholder="State Id" id="state_id"
                            name="state_id" class="form-controls"
                                value="{{request('state_id')}}"
                            autocomplete="off"> --}}
                    </div>
                    <div class="col-sm-4">
                        <input type="text" id="state_nm" class="register_input"
                        name="state_nm" value="{{ request('state_nm') }}" 
                         autocomplete="off"/>
                    <label for="register_input" placeholder="Enter State Name "></label>
                            {{-- <input type="text" placeholder="State Name" id="state_nm"
                                name="state_nm" class="form-controls"
                                value="{{request('state_nm')}}"
                            autocomplete="off"> --}}
                    </div>
                    <div class="col-sm-1" >
                        <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-search" style="font-size:20px"></i></button>
                    </div>
                    <div class="col-sm-1" style='margin-left:-50px'>
                        <a href="{{url('/admin-state-view')}}">
                            <button type="button" class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                        </a>    
                    </div>
                </div>
            </form> 
        </div>
        <div class="card-body"style='margin-top:-35px'>
            @if (session('msg'))
                <div class="alert alert-danger">
                    {{ session('msg') }}
                </div>
            @endif
                <table   id="customers">
                    <tr >
                        <th>Id</th>
                        <th>Name</th>
                        <th>Head Office</th>
                        <th>Contact No</th>
                        <th>Color Name</th>
                        <th>Banner One</th>
                        <th>Banner Two</th>
                        <th>Banner Three</th>
                        <th>Action</th>
                    </tr>
                    @if ($state_total >0)
                        @foreach ($stateview as $state)
                        <tr>
                            <td>{{ $state["state_id"]}}</td>
                            <td>{{ $state["state_nm"]}}</td>
                            <td>{{ $state["head_off_nm"]}}</td>
                            <td>{{ $state["contact_no"]}}</td>
                            <td style='background-color:{{ $state["color_nm"] }}'></td>
                            <td>
                                <img src="{{ asset('admin_state_upload_one/'.$state["Banner_one"]) }}" width="50" height="50" />
                            </td>
                            <td>
                                <img src="{{ asset('admin_state_upload_two/'.$state["Banner_two"]) }}" width="50" height="50" />
                            </td>
                            <td>
                                <img src="{{ asset('admin_state_upload_three/'.$state["Banner_three"]) }}" width="50" height="50" />
                            </td>
                            <td>
                                <a href ="{{url('admin-state-edit/' .$state['state_id'].'?state_id='.request('state_id'))}}"class="">
                                <i class="fa fa-edit" style="font-size:16px;padding-left:15px"></i>
                                    </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan='8' style="text-align: center">No data found !!!</td>
                        </tr>
                    @endif
                </table>
        </div>
    </div>

@endsection
@push('scripts')

@endpush