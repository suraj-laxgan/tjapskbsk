<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
	<style>
      
	</style>
</head>

<body>
    <table width="100%" border="0">    
        <tr>
            <td width="10%">&nbsp;</td>
            <td width="80%" >
                <table width="100%" border="0">
                    <tr>
                        <td width="5%" valign="bottom" style='padding-left:80px;'><img src="{{ asset('login_css/images/logo-Trans.png') }}" width="100" height="100"></td>
                        <td width="80%" class="small_head" valign="middle">
                            <font style="font-size: 23px;font-weight: normal;text-align: left ;text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9, 0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15);" color="#0000C1">Tapsil Jati Adibasi Praktan Sainik </font>
                            <font style="font-size: 40px;font-weight: normal; text-align: left; text-decoration: none;text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9, 0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15);" color="#0000C1">Krishi Bikash Shilpa Kendra <br></font>
                        </td>
                        <td width="15%">&nbsp;</td>
                    
                    </tr>
                    <tr>
                        <td width="25%"></td>
                        <td width="75%" style='font-size: 15px;font-weight: 700; color: #0000FF;text-align: left; text-decoration: none;' valign="top"> Correspondence Office: Vill - Gentegory, P.O. - Palashy, P.S. - Dhaniakhali, Dist - Hooghly, PIN - 712303, West Bengal.</td>
                        
                    </tr>
                </table>
                <hr >
                <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
                    <tr> 
                        <td width="5%">&nbsp;</td>
                        <td width="90%">
                            <form method="get" name="default_emplate" id="default_emplate" enctype="multipart/form-data">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style=' font-weight: bold;font-size:18px; color: #0A0D7A; text-decoration: none;' align="center"> 
                                            APPLICATION FORM
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style=' font-weight: bold;font-size:18px; color: #0A0D7A; text-decoration: none;' align="center"> 
                                            Application No - {{  $mail_preview->application_no}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <table width="95%" border="0" cellspacing="0" cellpadding="0">
                                                <tr> 
                                                    <td class="midbody_lebel"></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="midbody_lebel" height="35px">&nbsp;</td>
                                                    <?php /*?><td><img src="photo/<?php echo $rec_sel['profile_pic']; ?>"  width="100" height="100"></td><?php */?>
                                                </tr>
                                                <tr> 
                                                    <td class="midbody_lebel" width="24%">Post Applied For :</td>
                                                    <td width="24%">{{ $mail_preview->post_applied_for }}</td>
                                                    <td width="24%"></td>
                                                    <td class="midbody_lebel" height="35px">&nbsp;</td>
                                                    <td width="24%"></td>
                                                </tr>
                                                <tr> 
                                                    <td width="24%" class="midbody_lebel" height="35px"> Name of The Canditate:</td>
                                                    <td width="25%">{{  $mail_preview->mem_nm }}</td>
                                                    <td width="2%"> </td>
                                                    <td width="24%" class="midbody_lebel" height="35px"></td>
                                                    <td width="25%"></td>
                                                </tr>
                                                <tr> 
                                                    <td class="midbody_lebel" height="35px"> 
                                                    Guardian Name :</td>
                                                    <td >{{  $mail_preview->guard_nm }}</td>
                                                    <td></td>
                                                    <td class="midbody_lebel" height="35px"></td>
                                                    <td ></td>
                                                </tr>
                                                <tr> 
                                                    <td class="midbody_lebel">  Gender :</td>
                                                    <td >{{ $mail_preview->gender }}</td>
                                                    <td> </td>
                                                    <td height="35px" align="center"><span class="midbody_lebel"> Caste :</span> </td>
                                                    <td >{{ $mail_preview->mem_cast }}</td>
                                                </tr>
                                                <tr> 
                                                    <td class="midbody_lebel" height="35px"> Date of Birth :</td> 
                                                    <td>{{ $mail_preview->birth_dt }}</td>
                                                    <td> </td>
                                                    <td height="35px" class="midbody_lebel" align="center">Age as on 01/04/2021:</td>
                                                    <td>{{ $mail_preview->mem_age }}</td>
                                                </tr>
                                                <tr> 
                                                    <td colspan="5"class="midbody_lebel">Qualification : </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">
                                                        <table width="100%" border="1">
                                                            <tr>
                                                                <td>Sl No</td>
                                                                <td>Name of the Exam/Class</td>
                                                                <td>Name of the Board</td>
                                                                <td>Year of Passing</td>
                                                                <td>Div/Class</td>
                                                                <td> Percentage (%)</td>
                                                            </tr>
                                                            <tr>
                                                                <td>1.</td>
                                                                <td>{{ $mail_preview->mem_exam_1 }}</td>
                                                                <td>{{ $mail_preview->name_of_the_board_1 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_pass_1 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_div_1 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_percent_1 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>2.</td>
                                                                <td>{{ $mail_preview->mem_exam_2 }}</td>
                                                                <td>{{ $mail_preview->name_of_the_board_2 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_pass_2 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_div_2 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_percent_2 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>3.</td>
                                                                <td>{{ $mail_preview->mem_exam_3 }}</td>
                                                                <td>{{ $mail_preview->name_of_the_board_3 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_pass_3 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_div_3 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_percent_3 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>4.</td>
                                                                <td>{{ $mail_preview->mem_exam_4 }}</td>
                                                                <td>{{ $mail_preview->name_of_the_board_4 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_pass_4 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_div_4 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_percent_4 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>5.</td>
                                                                <td>{{ $mail_preview->mem_exam_5 }}</td>
                                                                <td>{{ $mail_preview->name_of_the_board_5 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_pass_5 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_div_5 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_percent_5 }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>6.</td>
                                                                <td>{{ $mail_preview->mem_exam_6 }}</td>
                                                                <td>{{ $mail_preview->name_of_the_board_6 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_pass_6 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_div_6 }}</td>
                                                                <td>{{ $mail_preview->mem_exam_percent_6 }}</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr> 
                                                    <td class="midbody_lebel">For Driver post :</td>
                                                    <td>{{ $mail_preview->driver_post }}</td>
                                                    <td> </td>
                                                    <td height="35px" align="center">&nbsp;</td>
                                                    <td ></td>
                                                </tr>
                                                <tr> 
                                                    <td width="24%" class="midbody_lebel" height="35px"> 
                                                    Driving Licence No  :</td>
                                                    <td>{{ $mail_preview->driver_licence_no }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                    
                                                <tr> 
                                                    <td width="24%" class="midbody_lebel" height="35px"> 
                                                    Driving Licence Category  :</td>
                                                    <td>{{ $mail_preview->driver_licence_cat }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr> 
                                                    <td width="24%" class="midbody_lebel" height="35px"> 
                                                    Driving Experience :</td>
                                                    <td>{{ $mail_preview->driver_exp }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr> 
                                                    <td width="24%" class="midbody_lebel" height="35px"> 
                                                    Computer Qualification :</td>
                                                    <td width="25%">{{ $mail_preview->comp_quali }}</td>
                                                    <td width="2%"> </td>
                                                    <td width="24%" class="midbody_lebel" height="35px"></td>
                                                    <td width="25%"></td>
                                                </tr>
                                                <tr> 
                                                    <td width="24%" class="midbody_lebel" height="35px"> 
                                                    Language Known :</td>
                                                    <td width="25%"> {{ $mail_preview->lang_known }}</td>
                                                    <td width="2%"> </td>
                                                    <td width="24%" class="midbody_lebel" height="35px">  </td>
                                                    <td width="25%"></td>
                                                </tr>
                                                <tr> 
                                                    <td width="24%" class="midbody_lebel" height="35px"> 
                                                    Experience :</td>
                                                    <td width="25%"> {{ $mail_preview->mem_exp }}</td>
                                                    <td width="2%"> </td>
                                                    <td width="24%" class="midbody_lebel" height="35px"> </td>
                                                    <td width="25%"></td>
                                                </tr>

                                                <tr> 
                                                    <td class="midbody_lebel" height="35px"> 
                                                    Parmanatn Address :</td>
                                                    <td >                                    </td>
                                                    <td> </td>
                                                    <td  class="midbody_lebel"  height="35px">Present Address</td>
                                                    <td >
                                                    </td>
                                                </tr>
                                                <tr> 
                                                    <td class="midbody_lebel" height="35px"> 
                                                    Lane/Road :</td>
                                                    <td>  {{ $mail_preview->add_lane }}</td>
                                                    <td> </td>
                                                    <td class="midbody_lebel" height="35px">Lane/Road : </td>
                                                    <td > {{ $mail_preview->pre_add_lane }}</td>
                                                </tr>
                                                <tr> 
                                                    <td class="midbody_lebel" height="35px">City/Village :</td>
                                                    <td>{{ $mail_preview->add_city }} </td>
                                                    <td></td>
                                                    <td><span class="midbody_lebel">City/Village :</span></td>
                                                    <td>{{ $mail_preview->pre_add_city }}</td>
                                                </tr>
                                                <tr> 
                                                    <td class="midbody_lebel" height="35px">Post Office :</td>
                                                    <td>{{ $mail_preview->add_postofc }}</td> 
                                                    <td></td>
                                                    <td><span class="midbody_lebel">Post Office :</span></td>
                                                    <td>{{ $mail_preview->pre_add_postofc }}</td>
                                                </tr>
                                                <tr> 
                                                    <td class="midbody_lebel" height="35px">Police Station :</td>
                                                    <td >{{ $mail_preview->add_ps }}</td>
                                                    <td></td>
                                                    <td><span class="midbody_lebel">Police Station :</span></td>
                                                    <td>{{ $mail_preview->pre_add_ps }}</td>
                                                </tr>
                                                <tr> 
                                                    <td class="midbody_lebel" height="35px">District :</td>
                                                    <td>{{ $mail_preview->add_dist }}</td>
                                                <td></td>
                                                <td><span class="midbody_lebel">District :</span></td>
                                                <td>{{ $mail_preview->pre_add_dist }}</td>
                                                </tr>
                                                <tr> 
                                                    <td class="midbody_lebel" height="35px">Pin Code :</td>
                                                    <td>{{ $mail_preview->add_pin }}</td>
                                                    <td></td>
                                                    <td><span class="midbody_lebel">Pin Code :</span></td>
                                                    <td>{{ $mail_preview->pre_add_pin }}</td>
                                                </tr>
                                    
                                                <tr> 
                                                    <td width="372" class="midbody_lebel" height="35px"> 
                                                    Contact No :</td>
                                                    <td width="367">{{ $mail_preview->contact_no }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr> 
                                                    <td  class="midbody_lebel" height="35px"> 
                                                    Email Address :</td>
                                                    <td >{{ $mail_preview->mem_email }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                    
                                                <tr> 
                                                    <td class="midbody_lebel" height="35px">Aadhaar No :</td>
                                                    <td>{{ $mail_preview->mem_aadhar_no }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr> 
                                                    <td  class="midbody_lebel" height="35px">PAN No :</td> 
                                                    <td > {{ $mail_preview->mem_pan_no }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr> 
                                                    <td  class="midbody_lebel" height="35px">Voter Id No :</td>
                                                    <td>{{ $mail_preview->mem_voterid_no }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                    
                                                <tr> 
                                                    <td class="midbody_lebel" height="35px">&nbsp;</td>
                                                    <td></td>
                                                    <td></td>
                                                    <!--<td><span class="midbody_lebel">Signature :</span></td>-->
                                                    <td><?php /*?><img src="signature/<?php echo $rec_sel['sign_image']; ?>"  width="100" height="auto"><?php */?></td>
                                                </tr>
                                                <tr><td></td></tr>
                                                <tr><td colspan="7" style='font-size: 15px;font-weight: 700; color: #0000FF;text-align: left; text-decoration: none;'>DECLARATION: I am willing to work in any part of the Country.</td></tr>
                                                <tr><td height="10px"></td></tr>
                                    
                                                <tr>
                                                    <td width="100%" class="title20" align="center" colspan="5"></td>
                                                </tr>
                                
                                                <tr>
                                                    <td colspan="7" align="right">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="7" align="right">&nbsp;</td>
                                                </tr>

                                                
                                            </table>
                                        </td>
                                    </tr>
                                    <tr> 
                                        <td> </td>
                                        <td><input type="submit" id="printpagebutton" value="Print" class="button_grey" onClick="window.print()"></td>
                                    </tr>
                                </table>
                            </form>
                        </td>
                        <td width="5%">&nbsp;</td>
                    </tr>
                </table>
            </td>
            <td width="10%">&nbsp;</td>
        </tr>
    </table>
</body>

</html>

