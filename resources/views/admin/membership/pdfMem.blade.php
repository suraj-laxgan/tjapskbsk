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
    <div class="container-fluid" style="padding:40px;margin-top:-50px;">
        <div class="row" style="margin-bottom:10px;">
            <div class="col-sm-12" >
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
            </div>
        </div>
        {{-- <div class="row">
			<div class="col-sm-12" style="border-bottom:2px solid black;"></div>
		</div> --}}
        <div class="row">
			<div class="col-sm-12 ">
                <table id="customers" width="100%" border="0" >
                    
                    <tr >
                        <th >Id</th>
                        <th  >Memo No</th>
                        <th  >Name</th>
                        <th  >Guardian</th>
                        <th  >Qualification</th>
                        <th  >Birth Date</th>
                        <th  >Media</th>
                        <th  >Designation</th>
                        <th  >Posting Place</th>
                        <th >Picture</th>
                    </tr>
                    {{-- @if ($wbappli_total > 0) --}}
                        @foreach ($query as $members)
                        <tr >
                            <td>{{ $members["mem_id"]}}</td>
                            <td>{{ $members["memo_no"]}}</td>
                            <td>{{ $members["mem_nm"]}}</td>
                            <td>{{ $members["guard_nm"]}}</td>
                            <td>{{ $members["mem_quali"]}} </td>
                            <td>{{ $members["birth_dt"]}}</td>
                            <td>{{ $members["media_nm"]}}</td>
                            <td>{{ $members["mem_desig"]}}</td>
                            <td >{{ $members["mem_posting_place"]}}</td>
                            <td>
                                <img src="{{ asset('mem_regis_upload/'.$members->profile_pic) }}" width="50" height="50" />

                            </td>
                        </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
   
</body>
</html>