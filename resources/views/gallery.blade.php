@extends('layouts.appnext')
@section('title')
	tjapkbsk
@endsection
<style>

</style>
@section('meta')

@endsection
@section('content')
<div class="container">
    <!-- Images used to open the lightbox -->
    <h4 style="text-align:center">Photo Gallery</h4>
    <hr>
    <!-- <div class="row">
        <div style="text-align:center;padding:5px" >
            <img src="{{ asset('gallery_photo/photo1.jpg') }}" width="20%" height="auto">
            <img src="{{ asset('gallery_photo/p2.jpg') }}"width="23%" height="auto" >
            <img src="{{ asset('gallery_photo/p3.jpg') }}"width="20%" height="auto" >
            <img src="{{ asset('gallery_photo/p4.jpg') }}"width="20%" height="auto" >

        </div>
        <div  style="text-align:center;padding:5px">
            <img src="{{ asset('images1/kp.jpg') }}" width="20%" height="auto">
            <img src="{{ asset('images1/kp.jpg') }}"width="20%" height="auto" >
            <img src="{{ asset('images1/kp.jpg') }}"width="20%" height="auto" >
            <img src="{{ asset('images1/kp.jpg') }}"width="20%" height="auto" >

        </div>
        <div  style="text-align:center;padding:5px">
            <img src="{{ asset('images1/kp.jpg') }}" width="20%" height="auto">
            <img src="{{ asset('images1/kp.jpg') }}"width="20%" height="auto" >
            <img src="{{ asset('images1/kp.jpg') }}"width="20%" height="auto" >
            <img src="{{ asset('images1/kp.jpg') }}"width="20%" height="auto" >

        </div>
        <div  style="text-align:center;padding:5px">
            <img src="{{ asset('images1/kp.jpg') }}" width="20%" height="auto">
            <img src="{{ asset('images1/kp.jpg') }}"width="20%" height="auto" >
            <img src="{{ asset('images1/kp.jpg') }}"width="20%" height="auto" >
            <img src="{{ asset('images1/kp.jpg') }}"width="20%" height="auto" >

        </div>
    
    </div> -->
<!--   
        <table>
            <tr>
                <td>
                @foreach ($gallery as $gall)
                    <img src="{{ asset('gallery_photo/'.$gall->img_path) }}" width=20%" height="20%" />
                @endforeach
                </td>
               
            </tr>
        </table> -->
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