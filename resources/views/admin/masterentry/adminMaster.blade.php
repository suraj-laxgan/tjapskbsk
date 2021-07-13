@extends('admin.layout.appnext')
@section('title')
	 Master
@endsection
@section('style')
<style>
.form-controls {
    height: calc(2.4rem + 2px);
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    width: 100%;
    padding: 0.45rem 0.75rem;
    font-size: 12px;
    line-height: 1.5;
    color: #495057;
    display: block;
    border-radius: 10px;
    border: 1px solid #ced4da;
    outline: none;
}
.body_link_text {
    position: absolute;
    top: 5px;
    left: 30px;
    font-size: 12px;
    font-weight: 500;
    color: rgb(100,100,100);
    
}

}
</style>
@endsection
@section('content')
    <div class="container-fluid">
    @include('admin.header.adminMasterEntryHeader')
        <div class="row " style='margin-top:50px'>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <img src="{{ asset('images1/logo-Trans.png') }}"style="width:100%" >
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

@endsection
@push('scripts')

@endpush
