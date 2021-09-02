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
        <div class="row">
            <div class="card-body col-sm-6" style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);  margin-bottom: 30px;">
                <div class="row">
                    <div class="col-sm-4" >
                        <select name="state_id" id="state_id" class="form-controls" required>
                            <option value="">Select State</option>
                            @foreach($state_name as $sname)
                                <option value="{{$sname->state_id}}" {{ request('state_id')== $sname->state_id ? "selected":"" }} >{{$sname->state_nm}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4" >
                        <input type="text" id="mem_nm" class="register_input" name="mem_nm" value="{{ request('mem_nm') }}" />
                        <label for="register_input" placeholder="Enter Member Name "></label>
                    </div>
                    <div class="col-sm-1">
                        <button type='submit' class='button22' id="search_member"><i class="fa fa-search" style="font-size:20px"></i></button>
                    </div>
                    <div class="col-sm-1">
                        <a href="{{url('/verify-register')}}">
                            <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                        </a>    
                    </div>
                </div>

            </div>
            <div class="card-body col-sm-6"style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);  margin-bottom: 30px;">
                <div class="col-sm-12" style="text-align: right;">
                    <a href="{{ url('ad-verify-regis-member') }}"> <b>+ Add Member </b></a>
                </div>
               
            </div>
        </div>
        <div class="card-body" style='margin-top:-40px'>
            <table width=100% id="customers">
                @if (session('msg'))
                <div class="alert alert-danger">
                    {{ session('msg') }}
                </div>
                @endif
                <tr >
                    <th width=5%>Id</th>
                    <th width=5%>Memo No</th>
                    <th width=11%>State Name</th>
                    <th width=15%>Name</th>
                    <th width=15%>Guardian</th>
                    <th width=5%>Qualification</th>
                    <th width=11%>Birth Date</th>
                    <th width=20%>Action</th>
                </tr>
                @if ($appli_total > 0)
                    @foreach ($applicant as $wb)
                    <tr >
                        <td>{{ $wb["mem_id"]}}</td>
                        <td>{{ $wb["memo_no"]}}</td>
                        <td>{{ $wb["state_nm"]}}</td>
                        <td>{{ $wb["mem_nm"]}}</td>
                        <td>{{ $wb["guard_nm"]}}</td>
                        <td>{{ $wb["mem_quali"]}} </td>
                        <td>{{ $wb["birth_dt"]}} </td>
                        <td style="text-align: center">
                            @if ($wb->trans_stat=='C')
                                <p style="color: green"><b> Complete</b></p>
                            @else
                            <a href ="{{url('verify-mem-edit/' .$wb['mem_id'].'?mem_id='.request('mem_id'))}}"class="">Edit
                                {{-- <i class="fa fa-edit" style="font-size:16px;padding-left:15px"></i> --}}
                            @endif
                               
                        </td>
                    </tr>
                    @endforeach
                @else 
                    <tr>
                        <td colspan="10" style="text-align:center">No data found !!!</td>
                    </tr>
                @endif
            </table> 
            {{$applicant->links()}}  
        </div>
    </div>
@endsection
@section('model')

@endsection
@push('scripts')
<script>
    $("#search_member").click(function() { 
   var mem_nm =  $("#mem_nm").val();
   var state_id = $('#state_id').val();
   window.location.href = "verify-register?mem_nm="+mem_nm+"&state_id="+state_id;
   });
</script>
@endpush