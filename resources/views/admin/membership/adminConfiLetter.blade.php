@extends('admin.layout.appnext')
@section('title')
	Confirmation Letter
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
                    <td width="0%">&nbsp;</td>
                    <td width="100%">
                        <div class="card-body">
                            <form method="GET" action="{{ url('ad-confi-letter') }}"  enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-3" >
                                        <input type="text" id="memo_no" class="register_input" name="memo_no" value="{{ request('memo_no') }}"  />
                                        <label for="register_input" placeholder="Enter Memo No *"></label>
                                    </div>
                                    <div class="col-sm-3" >
                                       
                                        <!-- <label>Print status :</label>&nbsp; -->
                                            <select name="memo_stat" id="memo_stat" class="form-controls">
                                                <option value="">Select Print status</option>
                                              
                                                {{-- <option value="P">Printed</option>
                                                <option value="NP">Not Printed</option> --}}
                                              
                                                <option value="P" {{ (request("memo_stat") == "P" ? "selected":"") }}>Printed</option>
                                                <option value="NP" {{ (request("memo_stat") == "NP" ? "selected":"") }}>Not Printed</option>
                                               
                                            </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <input type="text" id="memo_id" class="register_input" name="memo_id" value="{{ request('memo_id') }}" />
                                        <label for="register_input" placeholder="Enter Confirmation ID *"></label>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-search" style="font-size:20px"></i></button>
                                    </div>
                                    <div class="col-sm-1" style='margin-left:-40px'>
                                        <a href="{{url('ad-confi-letter')}}">
                                            <button type='button' class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                        </a>    
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body" style='margin-top:-60px'>
                            <div class="row ">
                                <div class="col-sm-6" style='text-align: right'>
                                    <!-- <a href="{{url('#')}}"><button type='button' class='blue_button'>Export To Excel</button></a> -->
                                </div>
                                <div class="col-sm-6" style='text-align: right'>
                                    <a href="{{url('/con-let-excel')}}"><button type='button' class='button22'>Export To Excel</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style='margin-top:-35px'>
                            <!-- <div style="text-align:center;color:gray"> <h6>View Confirmation Letter :</h6></div> -->
                               
                                <table   id="customers">
                                    <tr >
                                        <th>Memo No</th>
                                        <th>Name</th>
                                        <th>Guardian Name</th>
                                        <th>Media Name</th>
                                        <th>Action</th>
                                    </tr>
                                    @if ($mem_query_total > 0)
                                    @foreach ($mem_query as $mem)
                                    <tr>
                                        <td>{{ $mem->memo_no }}</td>
                                        <td>{{ $mem->mem_nm }}</td>
                                        <td>{{ $mem->guard_nm }}</td>
                                        <td>{{ $mem->media_nm }}</td>
                                         <td>
                                            @if($mem->memo_id != '')
                                               
                                                <button class="btn_reprint button22"style="color:red" 
                                                id="{{ $mem["mem_id"]}}">Reprint</button>
                                            @else
                                              {{-- <a href="{{ url('ad-ma-print/'.$mem['mem_id'].'?mem_id='.request('mem_id')) }}" class=""><button type='button' class='button22 ' >Mail/Print</button></a> --}}

                                              <button class="btn_view button22"
                                                id="{{ $mem["mem_id"]}}">Mail/Print</button>
                                            @endif

                                             {{-- <a href="" class=""><button type='button' class='button22'>Print Address</button></a> --}}

                                             <button class="btn_address button22"
                                             id="{{ $mem["mem_id"]}}">Print Address</button>
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
            <table>
        </div>
        
    <div> 

@endsection
@push('scripts')
<script>

    $(".btn_view").click(function() {
       var mem_id =  $(this).attr('id');
       console.log(mem_id);
       window.open("ad-ma-print/"+mem_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=250,width=900,height=600");
    //    window.open("admin-mem-query-view?mem_id="+mem_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
    });
    
    $(".btn_reprint").click(function() {
       var mem_id =  $(this).attr('id');
       console.log(mem_id);
       window.open("ad-ma-reprint/"+mem_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=250,width=900,height=600");
    //    window.open("admin-mem-query-view?mem_id="+mem_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
    });

    $(".btn_address").click(function() {
       var mem_id =  $(this).attr('id');
       console.log(mem_id);
       window.open("ad-ma-adress/"+mem_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=250,width=900,height=600");
    });
</script>
@endpush