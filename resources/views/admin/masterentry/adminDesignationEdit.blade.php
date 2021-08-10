@extends('admin.layout.appnext')
@section('title')
	Designation Place Edit
@endsection
@section('style')
<style>


</style>
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminMasterEntryHeader')
{{-- <input type="text" value="{{  $desig_edit->des_type }}"> --}}
    <div class="col-md-12">
        <div class="card-body"style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);">
            <form method="POST" action="{{ url('/ad-desig-edit-upload') }}"  enctype="multipart/form-data">
                @csrf 
                {{-- <div class="row"> --}}
                    <div class="col-sm-12" >
                        <input type="hidden" name='des_id' value="{{ ($desig_edit->des_id) }}">
                        {{-- <select name="des_type" id="des_type" class="form-controls" >
                            <option value="">Select Type</option>
                            <option value="HEAD OFFICE" {{ ($desig_edit->des_type == 'HEAD OFFICE')? 'selected':'' }}>HEAD OFFICE</option>

                            <option value="DISTRICT OFFICE" {{ ($desig_edit->des_type == 'DISTRICT OFFICE')? 'selected':'' }}>DISTRICT OFFICE</option>

                            <option value="BLOCK OFFICE" {{ ($desig_edit->des_type == 'BLOCK OFFICE')? 'selected':'' }}>BLOCK OFFICE</option>
                        </select> --}}
                        {{-- @if ($errors->has('des_type'))
                            <span class="text-danger">
                                {{ $errors->first('des_type') }}
                            </span>
                        @endif --}}
                    </div>
                    <div class="col-sm-12" style="margin-top:5px">
                        {{-- <input type="text" id="sl_no" class="register_input" name="sl_no" value="{{$desig_edit->sl_no }}"/> --}}
                        <label for="register_input" placeholder="Enter Sl No "></label>
                        {{-- @if ($errors->has('sl_no'))
                            <span class="text-danger">
                                {{ $errors->first('sl_no') }}
                            </span>
                        @endif --}}
                    </div>
                    <div class="col-sm-12" >
                        {{-- <input type="text" id="des_nm" class="register_input" name="des_nm"   value="{{ $desig_edit->des_nm }}"/>
                        <label for="register_input" placeholder="Enter Designation Name "></label> --}}
                        {{-- @if ($errors->has('des_nm'))
                            <span class="text-danger">
                                {{ $errors->first('des_nm') }}
                            </span>
                        @endif --}}
                    </div>
                    <div class="col-sm-12" >
                        <input type="text" id="des_no_post" class="register_input" name="des_no_post"  value="{{ $desig_edit->des_no_post }}"/>
                        <label for="register_input" placeholder="Enter No of Post "></label>
                            {{-- @if ($errors->has('des_no_post'))
                                <span class="text-danger">
                                    {{ $errors->first('des_no_post') }}
                                </span>
                            @endif --}}
                        
                    </div>
                    <div class="col-sm-12" style="text-align: center" >
                    <button type='submit' class='button22' >Update
                        {{-- <i class="fa fa-plus" style="font-size:20px"></i> --}}
                    </button>
                    </div>
                {{-- </div>     --}}
            </form>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
<script>
    
</script>
@endpush