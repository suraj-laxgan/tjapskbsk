@extends('layouts.appnext')
@section('title')
	Contact Us
@endsection
@section('meta')

@endsection
@section('content')
<div class="container-fluid " style="margin-left:50px">
    <h1 class=""><u style="color:red">Contact Us</u></h1>  
    <div class="row">
        <!-- <div class="col-sm-6" style="border-right-style: solid; border-right-color: rgb(222,222,222);" > -->
        <div class="col-sm-6" style="color: #6d6d6d;font-family: roboto,Sans-serif;font-size: 16px;font-weight: 400; ">

        <h2 class="">Correspondence Office</h2>
            <h3 class="">ADDRESS :</h3>
            <p>Vill : Gentegory</p>
            <p>PO : Palashy</p>
            <p>PS : Dhaniakhali</p>
            <p>Dist : Hooghly</p>
            <p>State : West Bengal</p>
            <p>PIN : 712303</p>
          
            <h3 class="">Email :</h3>
            test@gmail.com
            <h3 class="">CONTACT :</h3>
            +915555555555
           
        </div>

        <div  class="col-sm-6" style="border-left-style: solid; border-left-color: rgb(222,222,222);color: #6d6d6d;font-family: roboto,Sans-serif;font-size: 16px;font-weight: 400;">
            @if (session('msg'))
                <div class="alert  alert-success">
                    {{ session('msg') }}
                </div>
            @endif
        <h2 style="margin:20px">Write to us</h2>
        <form action="{{url('contact-us-msg')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-sm-12">
                <input type="text" name="vst_nm" id="vst_nm"  placeholder=" Your Name*" style='width: 100%;padding:10px;margin:10px' required >
                @if ($errors->has('vst_nm'))
                    <div class="text-danger">
                        {{ $errors->first('vst_nm') }}
                    </div>
                @endif
            </div>
            
           <div class="col-sm-12">
                <input type="email"   name="vst_email" id="vst_email" placeholder=" Youe Email*" style='width: 100%;padding:10px;margin:10px' required>
                @if ($errors->has('vst_email'))
                    <div class="text-danger">
                        {{ $errors->first('vst_email') }}
                    </div>
                @endif
           </div>
          
           <div class="col-sm-12">
                <input type="text"  name="vst_office" id="vst_office" placeholder="Your Office / Company*" style='width: 100%;padding:10px;margin:10px'required>
                @if ($errors->has('vst_office'))
                    <div class="text-danger">
                        {{ $errors->first('vst_office') }}
                    </div>
                @endif
           </div>
          
           <div class="col-sm-12">
                <input type="text"  name="vst_ph_no" id="vst_ph_no" placeholder="Phone*" style='width: 100%;padding:10px;margin:10px' required>
                @if ($errors->has('vst_ph_no'))
                    <div class="text-danger">
                        {{ $errors->first('vst_ph_no') }}
                    </div>
                @endif
           </div>
          
           <div class="col-sm-12">
                <textarea name="vst_msg" id="vst_msg" cols="30" rows="5" placeholder="Message*" style='width: 100%;padding:10px;margin:10px' required></textarea>   
                @if ($errors->has('vst_msg'))
                <div class="text-danger">
                    {{ $errors->first('vst_msg') }}
                </div>
            @endif        
            </div>
           
            <div class="col-sm-12">
                <button type="submit" style="margin:10px;background-color: #4CAF50;border: none;color: white;padding: 15px 32px;
                text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">Submit</button>
            </div>
        </form>
            
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush