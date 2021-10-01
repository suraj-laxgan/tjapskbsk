@extends('layouts.appnext')
@section('title')
	Video Gallery
@endsection
<style>

</style>
@section('meta')

@endsection
@section('content')
<div class="container">
   <div style="text-align:center">
      <h3><b><u>Video Gallery</u></b></h3> 
      <div>
          <span>
          <video width="300"  height="300" controls>
            <source src="video/video1.mp4" type="video/mp4">
          </video>
          </span>
        <span style="padding:20px">
        <video width="300"  height="300" controls>
            <source src="video/video2.mp4" type="video/mp4">
          </video>
        </span>
         
      </div>
   </div>
</div>
@endsection

@push('scripts')
<script>

</script>
@endpush