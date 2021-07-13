@extends('admin.layout.appnext')
@section('title')
	 Member Query
@endsection
@section('style')
<style>
   
    #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #e6e6e6;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #6666ff;
    color: white;
    }
</style>             
@endsection
@section('content')
    <div class="container-fluid">
        @include('admin.header.adminMembershipHeader')
        <div class="col-md-12">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="00%">&nbsp;</td>
                    <td width="100%">
                        <div class="card-body">
                            @if (session('msg'))
                                <div class="alert alert-danger">
                                    {{ session('msg') }}
                                </div>
                            @endif
                            <form method="GET" action="{{ url('/ad-member-query') }}"  enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-4" >
                                            {{-- {{ $mem_que->mem_stat }} --}}
                                          
                                            <!-- <label>Status  :</label>&nbsp; -->
                                                <select name="mem_stat" id="mem_stat" class="form-controls">
                                                    <option value="">Select Status</option>
                                                    <option value="A">Active</option>
                                                    {{-- <option value="D">Inactive</option> --}}
                                                </select>
                                        </div>
                                        <div class="col-sm-4" >
                                            <!-- <label>Activitis Missing  :</label>&nbsp; -->
                                                <select name="memo_no" id="memo_no" class="form-controls">
                                                    <option value="">Select Activitis Missing</option>
                                                    <option value="M">Memo No</option>
                                                    <option value="P">Photo</option>
                                                    <option value="D">Designation</option>
                                                    <option value="POP">Place Of Posting</option>
                                                    <option value="DOB">D.O.B</option>

                                                </select>
                                        </div>
                                        <div class="col-sm-1" >
                                            <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-search" style="font-size:20px"></i></button>
                                        </div>
                                        <div class="col-sm-3" style='margin-left:-30px'  >
                                            <!-- <label>&nbsp;&nbsp;</label> -->
                                            <a href="{{url('/ad-member-query')}}">
                                                <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                            </a>    
                                        </div>
                                    </div>

                            </form>
                        </div>
                        <div class="card-body" style='margin-top:-50px'>
                            <div class="row ">
                                <div class="col-sm-6" ></div>
                                <div class="col-sm-6" style='text-align: right'>
                                    <a href="{{url('/mem-query-excel')}}"><button type='button' class='button22'>Export To Excel</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style='margin-top:-55px'>
                            <!-- <div style="text-align:center;color:gray"> <h6>View Member Query:</h6></div> -->
                                <div>&nbsp;</div>	
                                <table   id="customers">
                                    <tr >
                                        <th>Name</th>
                                        <th>Memo No</th>
                                        <th>Branch</th>
                                        <th>Designation</th>
                                        <th>Birth Date</th>
                                        <th>Media Name</th>
                                        <th>Action</th>
                                    </tr>
                                    @if ($mem_query_total > 0)
                                       @foreach ($mem_query as $mem)
                                       <tr>
                                           <td>{{ $mem->mem_nm }}</td>
                                           <td>{{ $mem->memo_no }}</td>
                                           <td>{{ $mem->mem_posting_place }}</td>
                                           <td>{{ $mem->mem_desig }}</td>
                                           <td>{{ $mem->birth_dt }}</td>
                                           <td>{{ $mem->media_nm }}</td>
                                            <td>
                                                <button class="btn_view button22" style="color:red"
                                                id="{{ $mem["mem_id"]}}">Detail</button>

                                                {{-- <a href =""class="">
                                                    <i class="fa fa-edit" style="font-size:16px;padding-left:15px"></i>
                                                    </a> --}}

                                                <a href="{{url('admin-mem-query-edit/' .$mem['mem_id'].'?mem_id='.request('mem_id'))}}" class=""><button type='button' class='button22' style="color:red">Edit</button></a>
                                            </td>
                                       </tr>
                                           
                                       @endforeach
                                    @else 
                                       <tr>
                                           <td colspan="7" style="text-align:center">No data found !!!</td>
                                       </tr>
                                   @endif
                                   
                                </table> 
                                {{$mem_query->links()}}   
                            </div>
                        </div>
                    </td>
                    <td width="0%">&nbsp;</td>
                </tr>
            </table>
        </div>
    <div> 

@endsection
@push('scripts')
<script>

    $(".btn_view").click(function() {
       var mem_id =  $(this).attr('id');
       console.log(mem_id);
       window.open("admin-mem-query-view/"+mem_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=150,left=350,width=700,height=250");
    //    window.open("admin-mem-query-view?mem_id="+mem_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
    });
</script>
    
@endpush