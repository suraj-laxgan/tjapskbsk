<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointment Letter</title>
    <script src="{{ asset('online_user/vendor/jquery/jquery.min.js') }}"></script>
	 <script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
</head>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
        <tr>
          <td valign="top" align="center">
            {{-- <form method="" action = "{{ url('#') }}" enctype="multipart/form-data"> --}}

            <table width="80%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="3" class="text_black_1" align="center"><b>APPOINTMENT LETTER</b></td>
                 </tr>
                <tr>
                    <td valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="53%" align="center" valign="top"><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=TJAPSKBSK,Gentegory,Palashy,Dhaniakhali,Hooghly,712303, {{ $app_print->memo_no }},{{ $app_print->mem_nm }},C/O -{{ $app_print->guard_nm }},{{ $app_print->birth_dt }}&choe=UTF-8"></td>
                                <td width="47%" align="center" valign="middle">
                                  {{-- <img src="barcode.php?text="><br>&nbsp;&nbsp;  --}}
                                  {{-- {!! DNS1D::getBarcodeHTML($app_print->rand_no, 'C39') !!}<br> --}}
                                  {!! DNS1D::getBarcodeHTML('TJAPSKBSK', 'C39') !!}<br>

                                  {{ $app_print->app_memo_id }}
                                <br> 
                                {{ ($print_letter_dtl != "") ? $print_letter_dtl : date('d-m-Y') }}
                              </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        
                         <tr>
                           {{-- <td width="53%" align="left" class="text_black_1">To,</td>
                           <td width="47%" align="center" class="text_2"></td> --}}
                           <td width="50%" align="left" class="text_black_1">To,<br>
                            Shri/Smt.&nbsp; {{ $app_print->mem_nm }}<br>
                            C/O . {{ $app_print->guard_nm }}<br>
                                {{ $app_print->mem_add }}
                            </td>
                         </tr>
                       </table>
                    </td>
                </tr>
                <tr>
                    <td class="text_black_1" align="justify">
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $app_print->mem_nm }} is hereby appointed as {{ $app_print->mem_desig }} in {{ $app_print->district }} District at  {{ $app_print->mem_posting_place }} Office. You are requested to join within the fortnight of the  receipt of this letter.</p>
                      <p>&nbsp;</p>
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
                            <td width="50%" height="30px" class="text_black_1">&nbsp;</td>
                            <td width="50%" class="text_black_1" align="center" valign="top">Your  sincerely,</td>
                        </tr>
                        <tr>
                          <td width="50%" class="text_black_1"></td>
                          <td width="50%">&nbsp;</td>
                        </tr>
                        {{-- <tr>
                          <td width="50%">&nbsp;</td>
                          <td width="50%">&nbsp;</td>
                        </tr> --}}
                        <tr>
                            <td width="50%" class="text_2">{{substr($app_print->memo_no,3,5)  }} </td>
				            <td width="50%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="50%" class="text_2"></td>
                            <td width="50%" class="text_black_1" align="center">(Soumen Koley)</td>
                          </tr>
                        <tr>
                            <td width="50%" align="left" class="text_black_1">
                            
                            </td>
                            <td width="50%" class="text_black_1" align="center"valign="top">Secretary</td>
                          </tr>
                      </table>		  
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                   </tr>
                  
                   <tr>
                    <td>&nbsp;</td>
                   </tr>
                   
                    <tr>
                        <td height="10px">&nbsp;</td>
                    </tr>
            </table>
            {{-- </form> --}}
          </td>
        </tr>
    </table>

</body>
</html>