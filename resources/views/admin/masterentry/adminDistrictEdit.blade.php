@extends('admin.layout.appnext')
@section('title')
	District Edit
@endsection
@section('style')
           
@endsection
@section('content')
   
    <div class="container-fluid">
        @include('admin.header.adminMasterEntryHeader')
        <div class="col-md-12">
            <form method="POST" action="{{ url('/ad-district-up') }}"  enctype="multipart/form-data">
                @csrf 
                <input type="hidden" name ="district_id" value="{{ $dis_edit->district_id }}">
               <div class="card-body" style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);  margin-bottom: 30px;">
                    <div class="col-sm-12" >
                        <input type="text" id="district_nm" class="register_input" name="district_nm"
                        value="{{ $dis_edit->district_nm }}"  />
                        <label for="register_input" placeholder="Enter District Name "></label>
                    </div>
                    <div class="col-sm-12" style="text-align: center">
                        <button type='submit' class='button22' id="">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')

@endpush