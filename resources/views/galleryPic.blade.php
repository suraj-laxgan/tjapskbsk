@extends('layouts.appnext')
@section('title')
	gallery
@endsection
<style>

</style>
@section('meta')

@endsection
@section('content')
<div class="container">
    <h4 style="text-align:center">Photo Gallery</h4>
    <hr>
        <div style='text-align:center;border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);padding-top:30px'>
            @foreach ($gallery as $gall)
            <!-- <a href="{{url('#')}}"> -->
                <img src="{{ asset('gallery_photo/'.$gall->img_path) }}" width=30%" height="30%" style="padding:5px;border: 2px solid #ccffff;border-radius: 25px;" />
            <!-- </a> -->
            @endforeach
        </div>
</div>


 
@endsection

@push('scripts')
<script>

</script>
@endpush