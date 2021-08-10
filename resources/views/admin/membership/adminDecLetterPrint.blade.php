<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Declaration Letter</title>
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
                    <td colspan="3" class="text_black_1" align="center"><b>DECLARATION LETTER</b></td>
                 </tr>
                <tr>
                    <td valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="53%" align="center" valign="top"><img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=TJAPSKBSK,Gentegory,Palashy,Dhaniakhali,Hooghly,712303, {{ $dec_print->memo_no }},{{ $dec_print->mem_nm }},C/O -{{ $dec_print->guard_nm }},{{ $dec_print->birth_dt }}&choe=UTF-8"></td>
                                <td width="47%" align="center" valign="middle">
                                  {{-- <img src="barcode.php?text="><br>&nbsp;&nbsp;  --}}
                                  {!! DNS1D::getBarcodeHTML( $dec_print->dec_rand_no  , 'C39') !!}<br>
                                  {{ $dec_print->dec_memo_id }}
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
                        {{ $dec_print->mem_nm }}<br> C/O - {{ $dec_print->guard_nm }}<br> {{ $dec_print->mem_add }}<br><br>
                        <p>Sir/Madam,</p>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;It is with great pleasure I  like to communicate that, after the long and honest struggle of you all people,  that our organisation has been considered by Govt. of West Bengal to work under the norms of Govt. We have received of letter from the Secretary of P.B.S.S.D., Govt of West Bengal with <strong>Memo No. Estt/ Undertaking/ 2020-21/ 37(A)</strong> dated 18/01/2021 whereby a team of Senior Officers will visit our offices. Soon after we will  receive the approval by the Govt. and our organisation will structurally roll-on  hand to hand with Govt. of West Bengal.<br></p>
                        <p>Wishing you a happy and bright future.</p>	 
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
                          <td width="50%" class="text_black_1"></td>
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
                          <td width="50%" class="text_2">{{substr($dec_print->memo_no,3,5)  }} </td>
                          <td width="50%" class="text_black_1" align="right">(Soumen Koley)</td>
                        </tr>
                        {{-- <tr>
                            <td width="50%" class="text_2"></td>
                            <td width="50%" align="right" class="text_black_1" valign="top">Secretary</td>
                          </tr> --}}
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
                            <input type="date" value="<?= date('Y-m-d', time()); ?>" id="print_dt">

                           {{-- <a href="{{ url('ad-decal-ltr-com/'.$dec_print['mem_id'].'?mem_id='.request('mem_id')) }}"><button>Print</button></a> 
                            &nbsp;&nbsp;
                            <input name="Mail" value="Mail" type="submit"> --}}

                            <button id="print_11">Print</button>
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
            var memo_id =  "{{ $dec_print['memo_id'] }}";
            var print_dt =  $("#print_dt").val();
            window.location.href = "{{ asset('ad-decal-ltr-com/'.$dec_print['mem_id'])}}?memo_id="+memo_id+"&print_dt="+print_dt;
        }); 
    </script>
</body>
</html>