@extends('admin.layout.appnext')
@section('title')
	Reprint Appointment Letter
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
                            {{-- @csrf  --}}
                                <div class="row">
                                    <div class="col-sm-4" >
                                        <input type="text" id="memo_no" class="register_input" name="memo_no" value="{{ request('memo_no') }}" />
                                        <label for="register_input" placeholder="Enter Memo No *"></label>
                                    </div>
                                    <div class="col-sm-4" >
                                        <input type="text" id="mem_nm" class="register_input" name="mem_nm" value="{{  request('mem_nm') }}" />
                                        <label for="register_input" placeholder="Enter Name *"></label>
                                    </div>
                                    <div class="col-sm-1" >
                                        <button type='submit' class='button22' id="search_tn_1"><i class="fa fa-search" style="font-size:20px"></i></button>
                                    </div>
                                    <div class="col-sm-3" style='margin-left:-40px'  >
                                        <a href="{{url('ad-rep-appointment-letter')}}">
                                            <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                        </a>    
                                    </div>
                                </div>
                        {{-- </form >  --}}
                    </div>
                    <div class="card-body" style='margin-top:-30px'>
                        <!-- <div style="text-align:center;color:gray"> <h6>View Reprint Appointmemt Letter :</h6></div> -->
                            <table   id="customers">
                                <tr >
                                    <th>Memo No</th>
                                    <th>Name</th>
                                    <th>Guardian name</th>
                                    <th>Media Name</th>
                                    <th>Joining Letter</th>
                                </tr>
                                @foreach ($app_ltr as $app)
                                    <tr>
                                        <td>{{ $app->memo_no }}</td>
                                        <td>{{ $app->mem_nm }}</td>
                                        <td>{{ $app->guard_nm }}</td>
                                        <td>{{ $app->media_nm }}</td>
                                        <td>
                                            <button class="app_print button22"
                                            id="{{ $app["mem_id"]}}">Reprint</button>
                                        </td>

                                    </tr>
                                @endforeach
                            </table>   
                            {{ $app_ltr->links() }}
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
        window.location.href = "ad-rep-appointment-letter?memo_no="+memo_no+"&mem_nm="+mem_nm;
     }); 

     $(".app_print").click(function() {
      var mem_id =  $(this).attr('id');
      console.log(mem_id);
      window.open("ad-reappointment-com/"+mem_id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=250,width=900,height=600");
   });
</script>
@endpush