@extends('admin.layout.appnext')
@section('title')
	 Insert Data
@endsection
@section('style')
<style>

</style>
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminStateheader')

        <div class="col-md-12" style="margin-top: 10px">
            @if (session('msg'))
                <div class="alert  text-success">
                    {{ session('msg') }}
                </div>
            @endif
            <div class="col-md-3"></div>
            <div class=" col-md-6 row">
                <div class="col-md-3" style="text-align: center">
               
                    <a href="{{ route('insert.data.up') }}"><button class="button22"><b>Import Data Jharkhand</b> </button> </a>
                </div>
                <div class="col-md-3" style="text-align: center">
                    <a href="{{ route('insert.data.up.br') }}"><button class="button22"><b>Import Data Bihar</b> </button></a>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

@endsection
@push('scripts')

@endpush

</div>