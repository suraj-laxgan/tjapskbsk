@extends('admin.layout.appnext')
@section('title')
	Add Staff
@endsection
@section('style')
           
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminMasterEntryHeader')
        <div class="col-md-12">
            <form method="POST" action="{{ url('/ad-staff-up') }}"  enctype="multipart/form-data">
                @csrf 
                <div class="row">
                    <div class="card-body" style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);">
                        <input type="hidden" name="staff_id" value="{{ $staff_edit->staff_id }}">
                        <div class="col-sm-12" >
                            <input type="text" id="f_nm" class="register_input" name="f_nm" value="{{ $staff_edit->f_nm }}"/>
                            <label for="register_input" placeholder="Enter First Name " ></label>
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="m_nm" class="register_input" name="m_nm" value="{{ $staff_edit->m_nm }}" />
                            <label for="register_input" placeholder="Enter Middle Name "></label>
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="l_nm" class="register_input" name="l_nm" value="{{ $staff_edit->l_nm }}" />
                            <label for="register_input" placeholder="Enter Last Name "></label>
                        </div>
                        <div class="col-sm-12" >
                            <input type="email" id="staff_e_mail" class="register_input" name="staff_e_mail" value="{{ $staff_edit->staff_e_mail }}" />
                            <label for="register_input" placeholder="Enter e@mail"></label>
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="staff_mob_1" class="register_input" name="staff_mob_1" value="{{ $staff_edit->staff_mob_1 }}" />
                            <label for="register_input" placeholder="Enter Mobile No  "></label>
                        </div>
                    </div>&nbsp;
                    <div class="card-body"style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);" >
                        <div class="col-sm-12" >
                            <input type="text" id="staff_land_no" class="register_input" name="staff_land_no" value="{{  $staff_edit->staff_land_no}}" />
                            <label for="register_input" placeholder="Enter Land phone No   "></label>
                        </div>
                      
                        <div class="col-sm-12" >
                           
                            <textarea name="staff_add" id="staff_add"  rows="2" class="register_textarea">{{ $staff_edit->staff_add }}</textarea>
                        </div>
                    
                    </div>
                </div>
                {{-- <div class="row" style='margin-top:10px'> --}}
                    
                <div class="col-sm-12" style="text-align: center;margin-top:5px">
                    <button type='submit' class='button22' >
                        {{-- <i class="fa fa-plus" style="font-size:20px"></i> --}}
                        Update Staff
                    </button>
                </div>
                {{-- </div> --}}
            </form>
        </div>
    </div>
@endsection
@push('scripts')

@endpush