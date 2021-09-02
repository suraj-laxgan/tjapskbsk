@extends('admin.layout.appnext')
@section('title')
	Verified Register
@endsection
@section('style')
<style>
   
   
</style>        
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.verifiedRegisterHeader')
        <div class="row " style='margin-top:50px'>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <img src="{{ asset('images1/logo-Trans.png') }}"style="width:100%" >
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
@endsection
@section('model')

@endsection
@push('scripts')

@endpush