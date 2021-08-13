@extends('admin.layout.appnext')
@section('title')
	Create User
@endsection
@section('style')
           
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminMasterEntryHeader')
        <div class="col-md-12">
            <div class="row">       
                <div style="width: 15%">&nbsp;</div>     
                        <div class="card-body" style="width: 70%;border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);">
                            @if (session('msg'))
                                <div class="alert  text-success">
                                    {{ session('msg') }}
                                </div>
                            @endif
                            <div style="text-align: center;color:gray;font-size:15px;margin-top:-15px"><b><u>CREATE USER</u></b></div>
                            <form method="POST" action="{{ url('ad-cuser') }}"  enctype="multipart/form-data">
                                @csrf 
                                    <div class="col-sm-12" >
                                        <select name="state_nm" id="state_nm" class="form-controls"  >
                                            <option value="">Select State</option>
                                            @foreach ($all_state as $state)
                                            <option value="{{$state->state_nm}}">{{$state->state_nm}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('state_nm'))
                                            <div class="text-danger">
                                                {{ $errors->first('state_nm') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 5px">
                                        <select name="state_code" id="state_code" class="form-controls"  >
                                            <option value="">Select State Code</option>
                                            @foreach ($all_state as $state)
                                            <option value="{{$state->state_code}}">{{$state->state_code}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('state_code'))
                                            <div class="text-danger">
                                                {{ $errors->first('state_code') }}
                                            </div>
                                        @endif
                                    </div>
                                   
                                    <div class="col-sm-12" style="margin-top: 5px">
                                            <select name="user_group" id="user_group" class="form-controls"  >
                                                <option value="">Select User Group</option>
                                                {{-- <option value="SU">Admin</option> --}}
                                                <option value="US">User</option>
                                            </select>
                                            @if ($errors->has('user_group'))
                                                <div class="text-danger">
                                                    {{ $errors->first('user_group') }}
                                                </div>
                                            @endif
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 5px">
                                        <input type="text" id="user_id" class="register_input" name="user_id" required  autocomplete="off"/>
                                        <label for="register_input" placeholder="Enter User Id "></label>
                                        @if ($errors->has('user_id'))
                                            <div class="text-danger">
                                                {{ $errors->first('user_id') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-12" >
                                        <input type="email" id="email" class="register_input" name="email"  required autocomplete="off"/>
                                        <label for="register_input" placeholder="Enter e@mail"></label>
                                        @if ($errors->has('email'))
                                            <div class="text-danger">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                
                                    <div class="col-sm-12" >
                                        <input type="password" id="password" class="register_input" name="password" required autocomplete="off"/>
                                        <label for="register_input" placeholder="Enter Password"></label>
                                        @if ($errors->has('password'))
                                            <div class="text-danger">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>
                                    {{-- <div class="col-sm-12" >
                                        <input type="password" id="plain_password" class="register_input" name="plain_password"  autocomplete="off"/>
                                        <label for="register_input" placeholder="Retype Password"></label>
                                        @if ($errors->has('plain_password'))
                                            <div class="text-danger">
                                                {{ $errors->first('plain_password') }}
                                            </div>
                                        @endif
                                    </div> --}}
                                    <div class="col-sm-12"style='text-align: center;padding:10px' >
                                        <button type='submit' class='button22' id="search_tn_1">
                                           Add {{-- <i class="fa fa-plus" style="font-size:20px"></i> --}}
                                        </button>
                                    </div>
                            </form>
                        </div>
                <div style="width: 15%">&nbsp;</div>
            </div>
        </div>
    <div> 

@endsection
@push('scripts')

@endpush