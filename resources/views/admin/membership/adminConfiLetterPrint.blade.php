<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmation Letter</title>
    <script src="{{ asset('online_user/vendor/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
</head>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
        <tr>
          <td valign="top" align="center">
            {{-- <form method="" action = "{{ url('#') }}" enctype="multipart/form-data"> --}}

            <table width="80%" border="0" cellspacing="0" cellpadding="0">
                {{-- <tr>
                  <td height="210px">&nbsp;</td>
                </tr> --}}
                <tr>
                    <td valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="53%" align="center" valign="top"><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=TJAPSKBSK,Gentegory,Palashy,Dhaniakhali,Hooghly,712303, {{ $ma_print->memo_no }},{{ $ma_print->mem_nm }},C/O -{{ $ma_print->guard_nm }},{{ $ma_print->birth_dt }}&choe=UTF-8"></td>
                                <td width="47%" align="center" valign="middle">
                                  {{-- <img src="barcode.php?text="><br>&nbsp;&nbsp;  --}}
                                  {!! DNS1D::getBarcodeHTML($ma_print->rand_no, 'C39') !!}<br>
                                  {{ $ma_print->memo_id }}
                                <br>{{ date('d-m-Y') }}
                              </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                         <tr>
                           <td width="53%" align="left" class="text_black_1">To</td>
                           <td width="47%" align="center" class="text_2"></td>
                         </tr>
                       </table>
                    </td>
                </tr>
                <tr>
                    <td class="text_black_1" align="justify">
                        {{ $ma_print->mem_nm }}<br> C/O - {{ $ma_print->guard_nm }}<br> {{ $ma_print->mem_add }}<br><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I appreciate your dedication and devotion to the cause of societal development and upliftment  of the needy and deprived sections of society, In our society many people have lagged/behind and they required committed people with positive mindset  to bring them at par with others. your long association with this dedicated organisation is a testimony of your devotion to the social cause that is a cherished vision of this organisation. I actually solicit your co-operation in the future activities of the organisation for the upliftment and development of different segments of society.
                        <br>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I assured  and confirm you that your valuable service will be utilised in the future activities of the organisation that are likely to increase manifold in the recent times. I look forward to your fullest support in implementation of the poor and people oriented policies and programs of this organisation.		 
                    </td>
                   </tr>
                   <tr>
                    <td valign="top">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                          <td width="50%">&nbsp;</td>
                          <td width="50%">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="50%" class="text_black_1">With  best wishes.</td>
                          <td width="50%" class="text_black_1" align="right" valign="top">Your  sincerely,</td>
                        </tr>
                        <tr>
                          <td width="50%" class="text_black_1"></td>
                          <td width="50%">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="50%">&nbsp;</td>
                          <td width="50%">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="50%" class="text_2">{{substr($ma_print->memo_no,3,5)  }} </td>
                          <td width="50%" class="text_black_1" align="right">(Soumen Koley)</td>
                        </tr>
                      </table>		  
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                   </tr>
                   <tr>
                     <td><textarea name="comm_dtl" id="comm_dtl" rows="5" cols="30" placeholder='Enter comments here'></textarea></td>
                   </tr>
                   <tr>
                    <td>&nbsp;</td>
                   </tr>
                   <tr>
                        <td>
                            <input type="date" value="{{ date('Y-m-d', time()) }}" name ='print_dt'>
                            {{-- <input name="Print" value="Print" type="submit"> --}}

                           {{-- <a href="{{ url('ad-printletter/'.$ma_print->mem_id.'?mem_id='.request('mem_id')) }}"><button>Print</button></a>  --}}

                           <button id="print_11">Print </button>
                            &nbsp;&nbsp;
                            {{-- <input name="Mail" value="Mail" type="submit"> --}}
                        </td>
                    </tr>
                    <tr>
                        <td height="10px">&nbsp;</td>
                    </tr>
            </table>
            {{-- </form> --}}
          </td>
        </tr>
    </table>
   <script>
        $("#print_11").click(function() { 
            var memo_id =  "{{ $ma_print['memo_id'] }}";
            var print_dt =  $("#print_dt").val();
            window.location.href = "{{ asset('ad-printletter/'.$ma_print['mem_id'])}}?memo_id="+memo_id+"&print_dt="+print_dt;
        }); 
    </script>
</body>
</html>