@extends('admin.layout.appnext')
@section('title')
	Add Staff
@endsection
@section('style')
           
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminMasterEntryHeader')
        <div class="col-md-12">
            <form method="POST" action="{{ url('/ad-staff-save') }}"  enctype="multipart/form-data">
                @csrf 
                <div class="row">
                    <div class="card-body" style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);">
                        <div class="col-sm-12" >
                            <input type="text" id="f_nm" class="register_input" name="f_nm"  required/>
                            <label for="register_input" placeholder="Enter First Name " ></label>
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="m_nm" class="register_input" name="m_nm"  />
                            <label for="register_input" placeholder="Enter Middle Name "></label>
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="l_nm" class="register_input" name="l_nm"  />
                            <label for="register_input" placeholder="Enter Last Name "></label>
                        </div>
                        <div class="col-sm-12" >
                            <input type="email" id="staff_e_mail" class="register_input" name="staff_e_mail"  />
                            <label for="register_input" placeholder="Enter  e@mail  "></label>
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="staff_mob_1" class="register_input" name="staff_mob_1"  />
                            <label for="register_input" placeholder="Enter Mobile No  "></label>
                        </div>
                    </div>&nbsp;
                    <div class="card-body"style="border: 1px solid rgb(200,200,200);box-shadow: 0px 0px 5px 0px rgb(200 200 200);" >
                        <div class="col-sm-12" >
                            <input type="text" id="staff_land_no" class="register_input" name="staff_land_no"  />
                            <label for="register_input" placeholder="Enter Land phone No   "></label>
                        </div>
                      
                        <div class="col-sm-12" >
                           
                            <textarea name="staff_add" id="staff_add" placeholder="Enter Address" rows="2" class="register_textarea"></textarea>
                        </div>
                        <div class="col-sm-12" >
                            <input type="text" id="" class="register_input" name=""  />
                            <label for="register_input" placeholder="Enter User ID "></label>
                        </div>
                        <div class="col-sm-12" >
                            <input type="password" id="" class="register_input" name=""  />
                            <label for="register_input" placeholder="Enter Password   "></label>
                        </div>
                    </div>
                </div>
                {{-- <div class="row" style='margin-top:10px'> --}}
                    
                <div class="col-sm-12" style="text-align: center;margin-top:5px">
                    <button type='submit' class='button22' id="">
                        {{-- <i class="fa fa-plus" style="font-size:20px"></i> --}}
                        Create Staff
                    </button>
                </div>
                {{-- </div> --}}
            </form>
            <div class="card-body" style='margin-top:-25px'>
                {{-- <div style="color:gray"><b>Search Existing Staffs :</b></div> --}}
                    <div class="row"style='margin-top:10px'>
                        <div class="col-sm-4" >
                            <input type="text" id="f_nm_1" class="register_input" name="f_nm" value="{{request('f_nm')}}" >
                            <label for="register_input" placeholder="Enter First Name "></label>
                        </div>
                        <div class="col-sm-4" >
                            <input type="text" id="l_nm_1" class="register_input" name="l_nm" 
                            value="{{request('l_nm')}}">
                            <label for="register_input" placeholder="Enter Last Name  "></label>
                        </div>
                        <div class="col-sm-1" >
                            <!-- <label>&nbsp;&nbsp;</label> -->
                            <button type='submit' class='button22' id="search_staff"><i class="fa fa-search" style="font-size:20px"></i></button>                        </div>
                        <div class="col-sm-2" style='margin-left:-30px'>
                            <!-- <label>&nbsp;&nbsp;</label> -->
                            <a href="{{url('/ad-staff')}}">
                                <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                            </a>    
                        </div>
                        
                    </div>
            </div>
            <div class="card-body" style='margin-top:-30px'>
                {{-- <div style="color:gray"> <b>View Existing Staff :</b></div> --}}
                @if (session('msg'))
                    <div class="alert  text-success">
                        {{ session('msg') }}
                    </div>
                @endif
                <table   id="customers">
                    <tr >
                        <th>Staff</th>
                        <th>Staff ID</th>
                        <th>Action</th>
                    </tr>
                    @if($total_staff>0)
                        @foreach ($staff as $staf)
                            <tr>
                                <td>{{ $staf->f_nm }}</td>
                                <td>{{  $staf->staff_id  }}</td>
                                <td> 
                                    <button class="view_staff button22"
                                    id="{{ $staf->staff_id}}">View</button>

                                    <a href="ad-staff-edit/{{  $staf->staff_id  }}" ><button class="button22" style="color: green">Edit</button> </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="3" style="text-align:center">No data found !!!</td>
                    </tr>    
                    @endif
                </table>   
            </div>
        </div>
    <div> 

@endsection
@push('scripts')
<script>
    $('#search_staff').click(function(){
    var f_nm = $('#f_nm_1').val();
    var l_nm = $('#l_nm_1').val();
    window.location.href = "ad-staff?f_nm="+f_nm+"&l_nm="+l_nm;
    });

    $(".view_staff").click(function() {
       var staff_id =  $(this).attr('id');
       console.log(staff_id);
       window.open("ad-staff-view/"+staff_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=400,width=500,height=200");
    });
</script>
@endpush