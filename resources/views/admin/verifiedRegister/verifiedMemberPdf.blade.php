<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
  
	#customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    margin-left: -5px;
    font-size: 11px;

    }

    #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 1px;
    
    }

    #customers tr:nth-child(even){background-color: #e6e6e6;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
    padding-top: 1px;
    padding-bottom: 1px;
    text-align: center;
    background-color: #00c0ff;
    color: white;
    width: 100%
    }
	
    </style>
</head>
<body>
    {{-- <div class="container-fluid" style="padding:40px;margin-top:-50px;"> --}}
        {{-- <div class="row" style="margin-bottom:10px;"> --}}
            {{-- <div class="col-sm-12" > --}}
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="5%"></td>

                        <td width="15%" valign="middle"><img src="https://tjapskbsk.in/office/images/mail.png" width="100%"></td>

                        <td width="75%" align="center" valign="top" style="padding-top:10px;">
                          <div style="color:rgb(0,32,96); font-size:18px; font-weight:700;">TAPSIL JATI ADIBASI PRAKTAN SAINIK</div>
                          <div style="color:rgb(0,32,96); font-size:25px; font-weight:700;">KRISHI BIKASH SHILPA KENDRA</div>
                          <div style="color:rgb(0,32,96); font-size:16px; font-weight:700;">Implementation of New 20 Points Programmes</div>
                          <div style="color:rgb(0,0,0); font-size:13px; font-weight:700;">Gentegory, Palashy, Dhaniakhali, Hooghly, 712303 (W.B.).</div>
                          <div style="color:rgb(0,0,0); font-size:13px; font-weight:700;"><span style="float:left">&nbsp;&nbsp;&nbsp;&nbsp;Email ID: kbskdmt.hr@gmail.com.</span><span style="float:right">Website: www.tjapskbsk.in.</span><br>
                          <span>Phone No: 033 2680 8089 / 033 2530 0557</span>
                          </div>
                      </td>
                      
                      <td width="5%"></td>
                    </tr>
                  </table>
            {{-- </div> --}}
        {{-- </div> --}}
        <div style="text-align: center">
            @if($state_name!='')
                 Existing Members of  {{ request('des_type') }} --{{ request('district') }} --{{ request('mem_posting_place') }} --{{ $state_name }}
            @else
                Existing Members
            @endif
        </div>
        
        {{-- <div class="card-body" > --}}
            <table id="customers" width="100%" border="1" cellspacing="0" cellpadding="0" >
                
                <tr >
                    <th style="width:1%;">Sl</th>
                    <th style="width:4%;" >Designation</th>
                    <th  style="width:5%;">Name, Guardian Name</th>
                    <th  style="width:3%;">Birth Date</th>
                    <th  style="width:2%;" >Sex</th>
                    {{-- <th  style="width:5%;">Name</th> --}}
                    <th  style="width:3%;">Material Status</th>
                    <th  style="width:5%;">Dependents</th>
                    <th style="width:5%;" >Bank Name A/C NO IFSC CODE</th>
                    <th  style="width:5%;">IDENTIFICATION MARK</th>
                    <th  style="width:5%;">SINCE WHEN WORK WITH THE ORGANIZATION</th>
                    <th  style="width:5%;">ADHAR NO, EPIC NO</th>
                    <th  style="width:3%;">EXPERIENCE</th>
                    <th  style="width:2%;">CATEGORY</th>
                    <th  style="width:5%;">Picture</th>
                </tr>
                @foreach ($query as $members)
                <tr >
                    <td> {{$loop->iteration}}</td>
                    <td>{{ $members->mem_desig}}</td>
                    <td>
                        {{ $members->mem_nm}},
                    C/O -{{ $members->guard_nm}}
                    </td>
                    <td>{{ $members->birth_dt}}</td>
                    <td>{{ $members->gender}}</td>
                    {{-- <td></td> --}}
                    <td>{{ $members->marital_status}}</td>
                    <td>{{ $members->sl_no}}</td>
                    <td>
                        {{ $members->mem_bank_nm}},
                        {{ $members->bank_acount_no}},
                        {{ $members->bnk_ifsc_code}}
                    </td>
                    <td>{{ $members->identity_mark}}</td>
                    <td>{{ $members->organisation_exp}}</td>
                    <td>
                        {{ $members->mem_aadhar_no}},
                        {{ $members->mem_voterid_no}}

                    </td>
                    <td>{{ $members->work_exp}}</td>
                    <td>{{ $members->mem_cast}}</td>
                    <td>
                        @if ($members->profile_pic != "")
                            <img src="{{ public_path('photo_kbsk_new/'.$members->profile_pic) }}" width="50" height="50" />
                        @endif
                    </td>
                   

                    </td>
                </tr>
                @endforeach
                
                    
            </table>
        {{-- </div> --}}
    {{-- </div> --}}
   
</body>
</html>