@extends('admin.layout.appnext')
@section('title')
	Reprint Joining Letter
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
                        <div class="card-body" >
                            {{-- <form method="GET" action="{{ url('#') }}"  enctype="multipart/form-data"> --}}
                                <div class="row">
                                    <div class="col-sm-3" >
                                        <input type="text" id="memo_no" class="register_input" name="memo_no"  value="{{ request('memo_no') }}" />
                                        <label for="register_input" placeholder="Enter Memo No *"></label>
                                    </div>
                                    <div class="col-sm-3" >
                                        <input type="text" id="mem_nm" class="register_input" name="mem_nm"  value="{{ request('mem_nm') }}" />
                                        <label for="register_input" placeholder="Enter Name *"></label>
                                    </div>
                                   
                                    <div class="col-sm-3" >
                                        <input type="text" id="joi_memo_id" class="register_input" name="joi_memo_id"  value="{{ request('joi_memo_id') }}" />
                                        <label for="register_input" placeholder="Enter joining Id *"></label>
                                    </div>
                                   
                                    <div class="col-sm-1" >
                                        <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-search" style="font-size:20px"></i></button>
                                    </div>
                                    <div class="col-sm-2" style='margin-left:-40px'  >
                                        <a href="{{url('ad-repjoining-letter')}}">
                                            <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                        </a>    
                                    </div>
                                   
                                    
                                </div>
                            {{-- </form> --}}
                        </div>
                        <div class="card-body" style='margin-top:-60px'>
                            <div class="row ">
                                <div class="col-sm-6" ></div>
                                <div class="col-sm-6" style='text-align: right'>
                                    <a href="{{url('#')}}"><button type='button' class='button22'>Export To Excel</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" style='margin-top:-35px'>
                            <!-- <div style="text-align:center;color:gray"> <h6>View Reprint Joining Letter:</h6></div> -->
                                
                                <table   id="customers">
                                    <tr >
                                        <th>Memo No</th>
                                        <th>Name</th>
                                        <th>Guardian name</th>
                                        <th>Media Name</th>
                                        <th>Joining Letter</th>
                                    </tr>
                                    @if ($re_join_lt_total > 0)
                                    @foreach ($re_print_join as $join)
                                    <tr >
                                        <td>{{ $join->memo_no }}</td>
                                        <td>{{ $join->mem_nm }}</td>
                                        <td>{{ $join->guard_nm }}</td>
                                        <td>{{ $join->media_nm }}</td>
                                        <td>
                                            <button class="join_print button22"
                                            id="{{ $join["mem_id"]}}">Reprint</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else 
                                    <tr>
                                        <td colspan="5" style="text-align:center">No data found !!!</td>
                                    </tr>
                                @endif
                                </table>  
                                {{$re_print_join->links()}}     
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
    $("#search_tn_1").click(function() { 
       var memo_no =  $("#memo_no").val();
       var mem_nm =  $("#mem_nm").val();
       var joi_memo_id = $("#joi_memo_id").val();
       window.location.href = "ad-repjoining-letter?memo_no="+memo_no+"&mem_nm="+mem_nm+"&joi_memo_id="+joi_memo_id;
    });  
    
    $(".join_print").click(function() {
      var mem_id =  $(this).attr('id');
      console.log(mem_id);
      window.open("ad-join-reprint-com/"+mem_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=250,width=900,height=600");
   });
</script>
@endpush