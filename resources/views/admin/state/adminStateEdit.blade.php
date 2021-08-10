@extends('admin.layout.appnext')
@section('title')
	Admin State Edit
@endsection
@section('style')
<style>
	
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
                    <div class="alert alert-danger">
                        {{ session('msg') }}
                    </div>
                @endif
                <form method="POST" action="{{ url('/admin-state-edit-upload') }}"  enctype="multipart/form-data">
                    @csrf
                    <div>
                        <input type="hidden"  name="state_id" value="{{ $stateedit->state_id }}" >
                        
                        <input type="hidden" name="state_id1" value="{{ $state_id }}" >
                        <input type="hidden" name="state_nm1" value="{{ $state_nm }}" >
                        <input type="hidden" name="head_off_nm1" value="{{ $head_off_nm }}" >
                        <input type="hidden" name="contact_no1" value="{{ $contact_no }}" >
                        <input type="hidden" name="color_nm1" value="{{ $color_nm }}" >
                    </div>
                    {{-- <div class='row'> --}}
                        <div class="col-sm-12">
                            {{-- <label>State :</label>&nbsp;<font color="#FF0000">*</font> --}}
                            {{-- <input type="text"  value="{{ $stateedit->state_nm }}"id="state_nm" name="state_nm" class="form-controls"  > --}}
                        </div>
                        <div class="col-sm-12" style="margin-top: 5px">
                            {{-- <label>Head Office :</label>&nbsp;<font color="#FF0000">*</font> --}}
                            <input type="text"  value="{{ $stateedit->head_off_nm }}" id="head_off_nm" name="head_off_nm" class="form-controls"  >
                        </div>
                        <div class="col-sm-12" style="margin-top: 5px">
                            {{-- <label>Contact No :</label>&nbsp;<font color="#FF0000">*</font> --}}
                            <input type="text" value="{{ $stateedit->contact_no }}" id="contact_no" name="contact_no" class="form-controls"  >
                        </div>
                        <div class="col-sm-12" style="margin-top: 5px">
                            {{-- <label>color :</label>&nbsp;<font color="#FF0000">*</font> --}}
                        <input type="color" value="{{ $stateedit->color_nm }}"id="color_nm" name="color_nm" class="form-controls"  >
                        </div>
                    {{-- </div>   --}}
                    <div class='' style='margin-top:10px'> 
                        <div class="col-sm-12">
                            {{-- <label>Upload Banner 1:</label>&nbsp;<font color="#FF0000">*</font> --}}
                            
                            <input type="file" id="Banner_one" name="Banner_one" class="form-controls">
                            <img src="{{ asset('admin_state_upload_one/'.$stateedit["Banner_one"]) }}" height="auto" width="10%" />       
                        </div>
                        <div class="col-sm-12">
                            {{-- <label>Upload Banner 2:</label>&nbsp;<font color="#FF0000">*</font> --}}
                            <input type="file" placeholder="Upload Banner 2" id="Banner_two" name="Banner_two" class="form-controls"  autocomplete="off" >
                            <img src="{{ asset('admin_state_upload_two/'.$stateedit->Banner_two) }}" height="auto" width="10%" />       

                        </div>
                        <div class="col-sm-12">
                            {{-- <label>Upload Banner 3:</label>&nbsp;<font color="#FF0000">*</font> --}}
                            <input type="file"  id="Banner_three" name="Banner_three" class="form-controls"  autocomplete="off" >
                            <img src="{{ asset('admin_state_upload_three/'.$stateedit["Banner_three"]) }}" height="auto" width="10%" />       

                        </div>
                    </div>
                    <div class="col-sm-12"style='text-align: center;padding:10px' >
                        <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-plus" style="font-size:20px"></i></button>
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
