@extends('layouts.appnext')
@section('title')
	Show Member
@endsection
<style>

</style>
@section('meta')

@endsection
@section('content')
<div class="container" style="color: #6d6d6d;font-family: roboto,Sans-serif;font-size: 16px;font-weight: 400;">
    @if ( $total_mem > 0)
    @foreach ($mem as $me)
        <h3 style="text-align:center;margin-right:90px"><b>Employee Name : {{ $me->mem_nm}}</b></h3> 
        <div class="row" style="margin-top:30px;text-align:center;">
        
            <div class="col-sm-2" style="margin-top:70px;margin-left:50px">
                <img src="{{ asset('photo/'. $me->profile_pic) }}" width="100" height="100" />
            </div>
            
            <div class="col-sm-2" style="text-align:left">
            <b>
                <p>Guardian Name </p> 
                <p>Date of Birth </p>
                <p>Name of the State</p>
                <p>Name of the District</p>
                <p>Place Of posting</p>
                <p>Designation</p>
                <p>Date of joining</p>
                <p>Memo No</p>
                <p>Address</p>
            </b>
                
            </div>
            <div class="col-sm-2">
                <b>
                    <p> :</p> 
                    <p> :</p>
                    <p> :</p> 
                    <p> :</p>
                    <p> :</p> 
                    <p> :</p>
                    <p> :</p> 
                    <p> :</p>
                    <p> :</p>
                </b>
               
            </div>
            <div class="col-sm-4"style="text-align:left">
                <b>
                    <p> {{ $me->guard_nm  }}</p>
                    <p> {{ $me->birth_dt }} </p> 
                    <p> {{ $me->state_nm }}</p> 
                    <p> {{ $me->district }}</p> 
                    <p>  {{ $me->mem_posting_place }}</p> 
                    <p>  {{ $me->mem_desig }}</p>
                    <p>{{ $me->entry_dt }}</p> 
                    <p> {{ $me->memo_no }}</p> 
                    <p>  {{ $me->mem_add }}</p> 
                </b>
               
            </div>
        </div>
   @endforeach

    @else
        <div style="margin:120px;text-align:center">
           <h4>No data found !!!</h4> 
        </div>
    @endif

</div>
@endsection

@push('scripts')
<script>

</script>
@endpush