@extends('admin.layout.appnext')
@section('title')
	Declaration Letter
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
                        {{-- <form method="GET" action="{{ url('#') }}"  enctype="multipart/form-data"> --}}
                                <div class="row">
                                    <div class="col-sm-3" >
                                        <select name="state_id" id="state_n" class="form-controls" onChange="dkName()" >
                                            <option value="">Select State</option>
                                                @foreach($state_name as $sname)
                                                    <option value="{{$sname->state_id}}" {{ request('state_id')== $sname->state_id ? "selected":"" }}>{{$sname->state_nm}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <input type="text" id="memo_no" class="register_input" name="memo_no" value="{{ request('memo_no') }}" />
                                        <label for="register_input" placeholder="Enter Memo No *"></label>
                                    </div>
                                    <div class="col-sm-3" >
                                        <input type="text" id="mem_nm" class="register_input" name="mem_nm" value="{{ request('mem_nm') }}" />
                                        <label for="register_input" placeholder="Enter Name *"></label>
                                    </div>
                                    <div class="col-sm-1" >
                                        <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-search" style="font-size:20px"></i></button>
                                    </div>
                                    <div class="col-sm-2" style='margin-left:-40px'  >
                                        <!-- <label>&nbsp;&nbsp;</label> -->
                                        <a href="{{url('ad-decal-letter')}}">
                                            <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                        </a>    
                                    </div>
                                </div>
                        {{-- </form >  --}}
                    </div>
                    <div class="card-body" style='margin-top:-30px'>
                        <!-- <div style="text-align:center;color:gray"> <h6>View Declaration Letter :</h6></div> -->
                            <table   id="customers">
                                <tr >
                                    <th>Memo No</th>
                                    <th>Name</th>
                                    <th>Guardian name</th>
                                    <th>Media Name</th>
                                    <th>Declaration Letter</th>
                                </tr>
                                @if ( $dec_lt_total > 0)
                                    @foreach ($dec_ltr as $dltr )
                                    <tr>
                                        <td>{{  $dltr->memo_no  }}</td>
                                        <td>{{  $dltr->mem_nm  }}</td>
                                        <td>{{  $dltr->guard_nm  }}</td>
                                        <td>{{  $dltr->media_nm  }}</td>
                                        <td>
                                            @if($dltr["dec_memo_id"]  != '')
                                                <button type='button' class='button22'style='color:green'>Done</button>
                                            @else
                                                <button class="dec_print button22"
                                                id="{{ $dltr["mem_id"]}}">Print</button>
                                            @endif
                                        </td>
                                        {{-- <td> 
                                            <button class="dec_print button22"
                                            id="{{ $dltr["mem_id"]}}">Print</button>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" style="text-align:center">No data found !!!</td>
                                    </tr>
                                @endif
                               
                            </table>  
                            {{$dec_ltr->links()}}   
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
    var state_n =  $("#state_n").val();

    window.location.href = "ad-decal-letter?memo_no="+memo_no+"&mem_nm="+mem_nm+"&state_n="+state_n;
 });
 $(".dec_print").click(function() {
       var mem_id =  $(this).attr('id');
       console.log(mem_id);
       window.open("ad-decal-ltr/"+mem_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=250,width=900,height=600");
    });
</script>
  
@endpush