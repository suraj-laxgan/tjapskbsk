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
                <tr>
                    <td colspan="3" class="text_black_1" align="center"><b>JOINING LETTER</b></td>
                 </tr>
                <tr>
                    <td valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="53%" align="center" valign="top"><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=TJAPSKBSK,Gentegory,Palashy,Dhaniakhali,Hooghly,712303, {{ $join_print->memo_no }},{{ $join_print->mem_nm }},C/O -{{ $join_print->guard_nm }},{{ $join_print->birth_dt }}&choe=UTF-8"></td>
                                <td width="47%" align="center" valign="middle">
                                  {{-- <img src="barcode.php?text="><br>&nbsp;&nbsp;  --}}
                                  {{-- {!! DNS1D::getBarcodeHTML($join_print->rand_no, 'C39') !!}<br> --}}
                                  {!! DNS1D::getBarcodeHTML('TJAPSKBSK', 'C39') !!}<br>

                                  {{ $join_print->joi_memo_id }}
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
                           <td width="53%" align="left" class="text_black_1">Dear,</td>
                           <td width="47%" align="center" class="text_2"></td>
                         </tr>
                       </table>
                    </td>
                </tr>
                <tr>
                    <td class="text_black_1" align="justify">
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;It gives me immense pleasure to inform you that your request for joining this emenent organisation has been accepted. I convey the acceptance and wish to further add that you have been included in the contingent of dedicated social activists to carry forward the policies and programmes of the organisation. <br>
                                <br>
                        &nbsp;I hope you would work in mission mode to realize the vision of holistic development of society as cherished by this	organisation	since its inception. </p>
                      <p>With congratulation and best wishes of a splendid co operation. </p>
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
                            <td width="50%" class="text_2">{{substr($join_print->memo_no,3,5)  }} </td>
				            <td width="50%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="50%" class="text_2"></td>
                            <td width="50%" class="text_black_1" align="center">(Soumen Koley)</td>
                          </tr>
                        <tr>
                            <td width="50%" align="left" class="text_black_1">To,<br>
                            Shri/Smt.&nbsp; {{ $join_print->mem_nm }}<br>
                            'C/O '. {{ $join_print->guard_nm }}<br>
                                {{ $join_print->mem_add }}
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
                        <td>
                            <input type="date" value="<?= date('Y-m-d', time()); ?>" id="print_dt">
                            {{-- <input name="Print" value="Print" type="submit"> --}}

                            {{-- {{ $print->print_id }} --}}
                            {{-- @if({{  $join_print->joi_memo_id ,''}}) --}}
                              <button id="print_11">Print</button>
                             
                            {{-- @else
                                <button type='button' class='button22'style='color:red'>Done</button>
                            @endif --}}
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
        var memo_id =  "{{ $join_print['memo_id'] }}";
        var print_dt =  $("#print_dt").val();
        window.location.href = "{{ asset('ad-join-print-com/'.$join_print['mem_id'])}}?memo_id="+memo_id+"&print_dt="+print_dt;
    }); 
</script>  
</body>
</html>