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
        <div class="col-sm-6"  >
            <h2 style="margin:20px">Write to us</h2>
            <div class="col-sm-12">
                <input type="text" name="" id="" placeholder=" Your Name*" style='width: 100%;padding:10px;margin:10px' >
            </div>
           <div class="col-sm-12">
                <input type="email"   name="" id="" placeholder=" Youe Email*" style='width: 100%;padding:10px;margin:10px'>
           </div>
           <div class="col-sm-12">
                <input type="text"  name="" id="" placeholder="Phone*" style='width: 100%;padding:10px;margin:10px'>
           </div>
           <div class="col-sm-12">
                <textarea name="" id="" cols="30" rows="5" placeholder="Message*" style='width: 100%;padding:10px;margin:10px'></textarea>           
            </div>
            <div class="col-sm-12">
                <button type="submit" style="margin:10px;background-color: #4CAF50;border: none;color: white;padding: 15px 32px;
                text-align: center;text-decoration: none;display: inline-block;font-size: 16px;">Submit</button>
            </div>
        </div>

        <div  class="col-sm-6" style=" border-left-style: solid;border-left-color: 	rgb(222, 222, 222);">
            <h1 class="">Head Office</h1>
            <h2 class="">ADDRESS :</h2>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero sint, suscipit ducimus architecto asperiores quibusdam commodi hic fugit reprehenderit ipsum modi et repellendus omnis error laudantium rerum officiis quasi voluptate?
            <h2 class="">Email :</h2>
            test@gmail.com
            <h2 class="">CONTACT :</h2>
            7459854698

            <h1 class="">Corporate Office</h1>
            <h2 class="">ADDRESS :</h2>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero sint, suscipit ducimus architecto asperiores quibusdam commodi hic fugit reprehenderit ipsum modi et repellendus omnis error laudantium rerum officiis quasi voluptate?
            <h2 class="">Email :</h2>
            test@gmail.com
            <h2 class="">CONTACT :</h2>
            7459854698    
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush