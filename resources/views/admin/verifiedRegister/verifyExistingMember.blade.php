@extends('admin.layout.appnext')
@section('title')
	Existing Member
@endsection
@section('style')
<style>
   
   
</style>        
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.verifiedRegisterHeader')
        <div class="row">
            <div class="card-body " style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);  margin-bottom: 30px;">
                <div class="row">
                    <div class="col-sm-2" >
                        <select name="state_id" id="state_n" class="form-controls" onChange="dkName()" required>
                            <option value="">Select State</option>
                                @foreach($state_name as $sname)
                                    <option value="{{$sname->state_id}}" {{ request('state_id')== $sname->state_id ? "selected":"" }}>{{$sname->state_nm}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2" >
                        <select name="district" id="dis_n" class="form-controls" onChange="blockName()">
                            <option value="" >Select District</option>
                            
                        </select>
                    </div>
                    <div class="col-sm-2" >
                        <select name="mem_posting_place" id="mem_posting_place" class="form-controls" required>
                            <option value="">Select Posting Place</option>
                            
                        </select>
                    </div>
                    
                   
                    <div class="col-sm-2" >
                        <select name="des_type" id="des_type" class="form-controls" >
                            {{-- <option value="">Select Office</option> --}}
                            <option value="">Select Office</option>
                            <option value="DISTRICT OFFICE">DISTRICT OFFICE</option>
                            <option value="BLOCK OFFICE">BLOCK OFFICE</option>
                         
                        </select>
                    </div>
                    <div class="col-sm-2" >
                        <select name="media_nm" id="media_nm" class="form-controls" required>
                            <option value="">Select Media </option>
                            @foreach($media_na as $mname)
                                <option value="{{$mname->media_nm}}">{{$mname->media_nm}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="col-sm-2" >
                        <input type="text" id="mem_nm" class="register_input" name="mem_nm" value="{{ request('mem_nm') }}" />
                        <label for="register_input" placeholder="Enter Member Name "></label>

                    </div>
                    
                    
                    
                    <div class="col-sm-2" >
                        <input type="text" id="mem_desig" class="register_input" name="mem_desig" value="{{ request('mem_desig') }}" />
                        <label for="register_input" placeholder="Enter Designation "></label>
                    </div>
                    <div class="col-sm-2" >
                        <input type="text" id="guard_nm" class="register_input" name="guard_nm" value="{{ request('guard_nm') }}" />
                        <label for="register_input" placeholder="Enter Guardian Name "></label>
                    </div>
                    <div class="col-sm-1">
                        <button type='submit' class='button22' id="search_member"><i class="fa fa-search" style="font-size:20px"></i></button>
                    </div>
                    <div class="col-sm-1" style="margin-left: -40px">
                        <a href="{{url('verify-search-exis-mem')}}">
                            <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                        </a>    
                    </div>
                    <div class="col-sm-6" style="text-align: right" >
                        {{-- <button class='button22' style="color: green"><b>Download pdf</b></button> --}}
                        <a href="{{route('pdf.verified',['des_type'=>request('des_type'),
                        'district'=>request('district'),'state_id'=>request('state_id'),'mem_nm'=>request('mem_nm'),'mem_posting_place'=>request('mem_posting_place'),'post_applied_for'=>request('post_applied_for'),'mem_desig'=>request('mem_desig'), 'media_nm'=>request('media_nm'),'guard_nm'=>request('guard_nm') ])}}" target="_blank"><button type='button'class='button22'  style="color: green"><b>Download pdf</b></button></a>
                    </div>
                        
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
                    <th >Id</th>
                    <th >Name</th>
                    <th >Guardian</th>
                    <th >Address</th>
                    <th >Birth Date</th>
                    <th >Sex</th>
                    <th >Designation</th>
                    <th >Posting Place</th>
                    <th >State Name</th>
                    <th >Action</th>
                </tr>
                @if ($appli_total > 0)
                @foreach ($applicant as $appli )
                <tr >
                    <td>{{ $appli->kbsk_id }}</td>
                    <td>{{ $appli->mem_nm }}</td>
                    <td>{{ $appli->guard_nm }}</td>
                    <td>{{ $appli->mem_add }}</td>
                    <td>{{ $appli->birth_dt }}</td>
                    <td>{{ $appli->gender }}</td>
                    <td>{{ $appli->mem_desig }}</td>
                    <td>{{ $appli->mem_posting_place }}</td>
                    <td>{{ $appli->state_nm }}</td>
                    <td>
                         <a href="{{ route('verified.edit',[ $appli->kbsk_id  ]) }}">Edit</a>
                    </td>
                    
                </tr>
                @endforeach
                @else 
                <tr>
                    <td colspan="10" style="text-align:center">No data found !!!</td>
                </tr>
                @endif
            </table> 
            {{ $applicant->links() }}
        </div>
    </div>
@endsection
@section('model')

@endsection
@push('scripts')
<script>
    $("#search_member").click(function() { 
   var mem_nm =  $("#mem_nm").val();
   var state_id = $('#state_n').val();
//    var state_id = $('#state_n').val();
   var district = $('#dis_n').val();
   var mem_posting_place = $('#mem_posting_place').val();
   var des_type = $('#des_type').val();
   var mem_desig = $('#mem_desig').val();
   var guard_nm = $('#guard_nm').val();
   var media_nm = $('#media_nm').val();

   window.location.href = "verify-search-exis-mem?mem_nm="+mem_nm+"&state_id="+state_id+"&district="+district+"&mem_posting_place="+mem_posting_place+"&des_type="+des_type+"&mem_desig="+mem_desig+"&guard_nm="+guard_nm+"&media_nm="+media_nm;
   });

   function dkName()
        {
            //  alert('hi');
             var state_id = $('#state_n').val();
            //  var dis = $('#dis_n').val();
            // console.log(state_id);
            
            $.ajax({
            type : 'post',
            url  : "{{ url('/ajax-find-district-name')}}",
            data: {'state_id' : state_id,
                '_token':$('input[name=_token]').val()},   
            datatype : 'html',
            success:function(data)
            {
                 
            var district_nm = '<option value="">Select District</option>';
                $.each( data, function( index, value )
                {
                    // console.log(index); 
                    district_nm += '<option value="'+value.district_nm+'">'+value.district_nm+'</option>';
                    });
            $('#dis_n').html(district_nm);
            //console.log(data)
            } 
        });
        }

        function blockName() {
            //   alert('hi');
            var state_id = $('#state_n').val();
            var district_nm = $('#dis_n').val();
            // alert(district_nm);
            $.ajax({
            type : 'post',
            url  : "{{ url('/ajax-find-block-name')}}",
            data: {'state_id' : state_id,
                    'district_nm' : district_nm,
                '_token':$('input[name=_token]').val()},   
            datatype : 'html',
            success:function(data)
            {
                 
            var block_nm = '<option value="">Select Posting Place</option>';
                $.each( data, function( index, value )
                {
                    // console.log(index); 
                    block_nm += '<option value="'+value.block_nm+'">'+value.block_nm+'</option>';
                    });
            $('#mem_posting_place').html(block_nm);
            //console.log(data)
            } 
        });
        }

</script>


@endpush