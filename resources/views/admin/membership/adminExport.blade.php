@extends('admin.layout.appnext')
@section('title')
	 Export Member 
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
                            <form method="GET" action="{{ url('/') }}"  enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-2" >
                                            <input type="text" id="memo_no" class="register_input" value= "{{ $mem_export->memo_no }}" name="memo_no" readonly />
                                            {{-- <label for="register_input" placeholder="Enter Memo No "></label> --}}
                                            {{-- {{ $mem_export->memo_no }} --}}
                                        </div>
                                        <div class="col-sm-2" >
                                            <input type="text" id="mem_nm" class="register_input" name="mem_nm" value= "{{ $mem_export->mem_nm }}" readonly/>
                                            {{-- <label for="register_input" placeholder="Enter Member Name "></label> --}}
                                        </div>
                                        <div class="col-sm-2" >
                                            <input type="text" id="mem_posting_place" class="register_input" name="mem_posting_place" value= "{{ $mem_export->mem_posting_place }}" readonly />
                                            {{-- <label for="register_input" placeholder="Enter Posting place "></label> --}}
                                        </div>
                                        <div class="col-sm-2" >
                                            <input type="text" id="mem_desig" class="register_input" name="mem_desig" value= "{{ $mem_export->mem_desig }}"readonly />
                                            {{-- <label for="register_input" placeholder="Enter Designation "></label> --}}
                                        </div>
                                        <div class="col-sm-2" >
                                            <!-- <label> Media Name:</label> -->
                                            <select name="media_nm" id="media_nm" class="form-controls">
                                                    <option value="{{$mem_export->media_nm}}">{{$mem_export->media_nm}}</option>
                                            </select>
                                        </div>
                                        {{-- <div class="col-sm-1">
                                            <button type='submit' class='button22'><i class="fa fa-search" style="font-size:20px"></i></button>
                                        </div> --}}
                                        {{-- <div class="col-sm-1" style='margin-left:-40px'>
                                            <a href="{{url('/ad-expo-member')}}">
                                                <button class='button22'> <i class="fa fa-refresh" style="font-size:20px"></i></button>
                                            </a>    
                                        </div> --}}
                                    </div>
                            </form>
                        </div>
                        <div>&nbsp;</div>	
                        <div class="card-body" style='margin-top:-70px'>
                            <!-- <div style="text-align:center;color:gray"> <h6>View Export Member :</h6></div> -->
                                <div>&nbsp;</div>	
                                <table   id="customers">
                                    <tr >
                                        <th>Memo No</th>
                                        <th>Name</th>
                                        <th>Guardian</th>
                                        <th>Qualification</th>
                                        <th>Birth Date</th>
                                        <th>Media Name</th>
                                        <th>Designation</th>
                                        <th>Posting Place</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $mem_export->memo_no }}</td>
                                        <td>{{ $mem_export->mem_nm }}</td>
                                        <td>{{ $mem_export->guard_nm }}</td>
                                        <td>{{ $mem_export->mem_quali }}</td>
                                        <td>{{ $mem_export->birth_dt }}</td>

                                        <td>{{ $mem_export->media_nm }}</td>
                                        <td>{{ $mem_export->mem_desig }}</td>
                                        <td>{{ $mem_export->mem_posting_place }}</td>
                                         <td>
                                             {{-- <a href="{{url('ad-mem-export/' .$mem['mem_id'].'?mem_id='.request('mem_id'))}}" class=""><button type='button' class='button22' >Export</button></a> --}}
                                           
                                                {{-- <form method="POST" action="{{ url('/ad-mem-export/'.$mem['mem_id'].'?mem_id='.request('mem_id')
                                                ) }}"  enctype="multipart/form-data">
                                                @csrf
                                                <button type='submit' class='button22' id="search">Export</button>
                                             </form> --}}
                                             {{-- <a href="{{ url('ad-expo-member-update') }}
                                             "><button>Export</button></a> --}}
                                             <form action="{{ url('ad-expo-member-update')}}" method ="POST"  enctype="multipart/form-data"}}
                                             ">
                                             <input type="hidden" id="mem_id" class="register_input" name="mem_id" value= "{{ $mem_export->mem_id }}" readonly />
                                             <button type='submit' class='button22' id="search">Export</button>
                                             </form>
                                         </td>
                                    </tr>
                                </table>  
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

@endpush