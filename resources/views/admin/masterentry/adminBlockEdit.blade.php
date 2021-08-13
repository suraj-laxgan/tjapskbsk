@extends('admin.layout.appnext')
@section('title')
	Block Edit
@endsection
@section('style')
           
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminMasterEntryHeader')
        <div class="col-md-12">
            <div class="card-body"style='border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);'>
                <form method="POST" action="{{ url('/ad-block-up') }}"  enctype="multipart/form-data">
                    @csrf 
                    <div class="col-sm-12" >
                        <input type="hidden" value="{{ $block_edit->block_id  }}" name ='block_id'>
                        {{-- <label>District Name :</label>&nbsp;<font color="#FF0000">*</font> --}}
                            {{-- <select name="district_nm" id="district_nm" class="form-controls" required>
                                <option value="">Select District Name</option>
                                    @foreach($distric as $dis)
                                    <option value="{{$dis->district_nm}}" {{ ($block_edit->district_nm == $dis->district_nm)? 'selected':'' }}>{{$dis->district_nm}}</option>
                                @endforeach
                            </select> --}}
                    </div>
                    <div class="col-sm-12" style="margin-top: 5px">
                        <input type="text" id="block_nm" class="register_input" name="block_nm" value="{{ $block_edit->block_nm }}"/>
                        <label for="register_input" placeholder="Enter Block Name  "></label>
                    </div>
                    <div class="col-sm-12" style="text-align: center">
                        <button type='submit' class='button22' id="search_tn_1">
                            Update
                        </button>

                        {{-- <input type="submit" value="Create" class="blue_button" > --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
   
</script>
@endpush    