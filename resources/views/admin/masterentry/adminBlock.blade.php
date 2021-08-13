@extends('admin.layout.appnext')
@section('title')
	Block
@endsection
@section('style')
           
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminMasterEntryHeader')
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6" style="margin-left: 12px">
                <div class="card-body"style='border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);'>
                    {{-- <div style="color:gray"><b>Search Existing Block :</b></div> --}}
                        <div class="row">
                            <div class="col-sm-3" >
                                <select name="state_id" id="state_id_22" class="form-controls" onChange="searDisName()">
                                    <option value="">Select State</option>
                                    @foreach($state as $sname)
                                        <option value="{{$sname->state_id}}" {{ request('state_id')== $sname->state_id ? "selected":"" }} >{{$sname->state_nm}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3" >
                                <!-- <label>District Name :</label>&nbsp;<font color="#FF0000">*</font> -->
                                    <select name="district_nm" id="district_nm_22" class="form-controls" >
                                        <option value="">Select District</option>
                                    </select>
                            </div>
                            <div class="col-sm-3" >
                                <input type="text" id="block_nm" class="register_input" name="block_nm" value="{{ request('block_nm') }}"autocomplete="off"/>
                                <label for="register_input" placeholder="Enter Block Name  "></label>
                            </div>
                            <div class="col-sm-1" >
                                <button type='submit' class='button22' id="search_block"><i class="fa fa-search" style="font-size:20px"></i></button>
                            </div>
                            <div class="col-sm-1" >
                                <!-- <label>&nbsp;&nbsp;</label> -->
                                <a href="{{url('/ad-block')}}">
                                    <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                </a>    
                            </div>
                        </div>
                </div>
                </div>
                <div class="col-md-6" style="margin-left: -25px">
                <div class="card-body"style='border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);'>
                    <form method="POST" action="{{ url('/ad-block-save') }}"  enctype="multipart/form-data">
                        @csrf 
                        <div class="row">
                            <div class="col-sm-3" >
                                <select name="state_id" id="state_id_1" class="form-controls" onChange="findDisName()" required>
                                    <option value="">Select State</option>
                                    @foreach($state as $sname)
                                        <option value="{{$sname->state_id}}">{{$sname->state_nm}}</option>
                                    @endforeach
                                  </select>
                                @if ($errors->has('state_id'))
                                    <span class="text-danger">
                                        {{ $errors->first('state_id') }}
                                    </span>
                                @endif
                            </div>
                            <div class="col-sm-3" >
                                <select name="district_nm" id="district_nm_1" class="form-controls" required>
                                    <option value="">Select District Name</option>
                                </select>
                            </div>
                            <div class="col-sm-3" >
                                <input type="text" id="block_nm" class="register_input" name="block_nm" autocomplete="off" required/>
                                <label for="register_input" placeholder="Enter Block Name  "></label>
                            </div>
                            <div class="col-sm-3" >
                                <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-plus" style="font-size:20px"></i></button>

                                {{-- <input type="submit" value="Create" class="blue_button" > --}}
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            <div class="card-body" style="margin-top: -10px">
                {{-- <div style="color:gray"> <b>View Existing Block :</b></div> --}}
                @if (session('msg'))
                    <div class="alert  alert-success">
                        {{ session('msg') }}
                    </div>
                @endif
                    <table   id="customers">
                        <tr >
                            <th>State Name</th>
                            <th>District Name</th>
                            <th>Block Name</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($block as $blo )
                            <tr>
                                <td>{{ $blo->state_nm }}</td>
                                <td>{{ $blo->district_nm }}</td>
                                <td>{{ $blo->block_nm }}</td>
                                <td>
                                    <a href="ad-block-edit/{{ $blo->block_id }}" style="color: green">Edit</a>&nbsp;

                                    <a href="delete-block/{{ $blo->block_id }}" style="color: red">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>   
                    {{ $block->links() }}
                {{-- </div> --}}
            </div>
        </div>
    <div> 

@endsection
@push('scripts')

<script>
    $('#search_block').click(function(){
        var district_nm = $('#district_nm_22').val();
        var block_nm = $('#block_nm').val();
        var state_id = $('#state_id_22').val();
        window.location.href = "ad-block?district_nm="+district_nm+"&block_nm="+block_nm+"&state_id="+state_id;
    });

    function findDisName()
        {
            // alert('hi');
            var state_id_1 = $('#state_id_1').val();
    // alert(state_id_1);
            
            $.ajax({
            type : 'post',
            url  : "{{ url('/find-district-name')}}",
            data: {'state_id_1' : state_id_1,
                '_token':$('input[name=_token]').val()},   
            datatype : 'html',
            success:function(data)
            {
            var district_nm_1 = '<option value="">Select District</option>';
                        $.each( data, function( index, value )
                        {
                            // console.log(index);
                            district_nm_1 += '<option value="'+value.district_nm+'">'+value.district_nm+'</option>';
                            });
            $('#district_nm_1').html(district_nm_1);
            
            // console.log(data)
            } 
        });
        }

        function searDisName()
        {
            // alert('hi');
            var state_id_22 = $('#state_id_22').val();
    // alert(state_id_22);
            
            $.ajax({
            type : 'post',
            url  : "{{ url('/search-district-name')}}",
            data: {'state_id_22' : state_id_22,
                '_token':$('input[name=_token]').val()},   
            datatype : 'html',
            success:function(data)
            {
            var district_nm_22 = '<option value="">Select District</option>';
                        $.each( data, function( index, value )
                        {
                            // console.log(index);
                            district_nm_22 += '<option value="'+value.district_nm+'">'+value.district_nm+'</option>';
                            });
            $('#district_nm_22').html(district_nm_22);
            
            // console.log(data)
            } 
        });
        }


       
  
</script>
@endpush