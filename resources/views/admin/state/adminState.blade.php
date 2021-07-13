@extends('admin.layout.appnext')
@section('title')
	Admin State
@endsection
@section('style')
<style>

input:focus ~ .floating-label{
  top: 0px;
  bottom: 0px;
  left: 20px;
  font-size: 11px;
  opacity: 1;
}

.inputText {
    border:none;
    width: 100%;
    /* height: 20%; */
    /* margin: 5px; */
    margin-bottom: 5px;
    padding: 0px 0px 13px 0px;
    border-bottom: 1px solid #bababa;
    background: rgb(253,253,253);
    font-size: 12px;
    resize: none;
    outline: none;
}

.floating-label {
  position: absolute;
  pointer-events: none;
  left: 20px;
  top: 18px;
  transition: 0.2s ease all;
}

</style>
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminStateheader')
			<div class="col-md-12">
                <div class="row">
                    <div style="width: 15%">&nbsp;</div>   
                    <div class="card-body"style="width: 70%;border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);margin-top:5px">
                            @if (session('msg'))
                                <div class="alert  text-success">
                                    {{ session('msg') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ url('/admin-add-state') }}"  enctype="multipart/form-data">
                                @csrf
                                    <div class="col-sm-12">
                                        <input type="text" id="state_nm" class="register_input" required name="state_nm" value="{{ old('state_nm') }}"   autocomplete="disable"/>
                                        <label for="register_input" placeholder="Enter State *"></label>
                                        @if ($errors->has('state_nm'))
                                            <div class="text-danger">
                                                {{ $errors->first('state_nm') }}
                                            </div>
                                        @endif
                                    </div>

                                   {{-- <div  class="col-sm-12">
                                        <input type="text" class="inputText" />
                                        <span class="floating-label">Your Name</span>
                                   </div> --}}

                                    <div class="col-sm-12">
                                        <input type="text" id="state_code" class="register_input" name="state_code" value="{{ old('state_code') }}"  required autocomplete="disable" />
                                        <label for="register_input" placeholder="Enter State Code*"></label>
                                        @if ($errors->has('state_code'))
                                            <div class="text-danger">
                                                {{ $errors->first('state_code') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" id="head_off_nm" class="register_input" name="head_off_nm" value="{{ old('head_off_nm') }}"  required autocomplete="disable"/>
                                        <label for="register_input" placeholder="Enter Head Office *"></label>
                                        @if ($errors->has('head_off_nm'))
                                            <div class="text-danger">
                                                {{ $errors->first('head_off_nm') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" id="contact_no" class="register_input" name="contact_no" value="{{ old('contact_no') }}"  required autocomplete="disable"/>
                                        <label for="register_input" placeholder="Enter Contact No *"></label>
                                        @if ($errors->has('contact_no'))
                                            <div class ='text-danger'>
                                                {{ $errors->first('contact_no') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-12">
                                        {{-- <label>color :</label>&nbsp;<font color="#FF0000">*</font> --}}
                                    <input type="color" placeholder="color" id="color_nm" name="color_nm" class="form-controls"   autocomplete="off">
                                    </div>
                                    <div class="col-sm-12"style='margin-top:5px;'>
                                        {{-- <label>Upload Banner 1:</label>&nbsp;<font color="#FF0000">*</font> --}}
                                        <input type="file" placeholder="Upload Banner 1" id="Banner_one" name="Banner_one" class="form-controls"  required  >
                                        @if ($errors->has('Banner_one'))
                                            <div class ='text-danger'>
                                                {{ $errors->first('Banner_one') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-12"style='margin-top:5px;'>
                                        {{-- <label>Upload Banner 2:</label>&nbsp;<font color="#FF0000">*</font> --}}
                                        <input type="file" placeholder="Upload Banner 2" id="Banner_two" name="Banner_two" class="form-controls" required  >
                                        @if ($errors->has('Banner_two'))
                                            <div class ='text-danger'>
                                                {{ $errors->first('Banner_two') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-12"style='margin-top:5px;'>
                                        {{-- <label>Upload Banner 3:</label>&nbsp;<font color="#FF0000">*</font> --}}
                                        <input type="file" placeholder="Upload Banner 3" id="Banner_three" name="Banner_three" class="form-controls" 
                                        required  >
                                        @if ($errors->has('Banner_three'))
                                            <div class ='text-danger'>
                                                {{ $errors->first('Banner_three') }}
                                            </div>
                                        @endif
                                    </div>
                                <div class="col-sm-12"style='text-align: center;padding:10px' >
                                    <button type='submit' class='button22' id="search_tn_1">
                                        {{-- <i class="fa fa-plus" style="font-size:20px"></i> --}}
                                        Add
                                    </button>
                                </div>
                            </form>
                    </div>
                    <div style="width: 15%">&nbsp;</div>   
                </div>
            </div>
    </div>
@endsection
@push('scripts')

@endpush
