<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
	<style>
		.mail_bg{
			background-image:url('https://tjapskbsk.in/office1/images/logomark7.jpg');
			opacity: 0.3;
		    background-color: white;
		    background-position: center;
		    background-repeat: no-repeat;
		    background-size: cover;
		    position: relative;
		}
	</style>
</head>
<body>
    <div class="container-fluid" style="padding:40px;">
		<div class="row" style="margin-bottom:10px;">
			<div class="col-sm-12">
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
		<div class="row">
			<div class="col-sm-12" style="border-bottom:2px solid black;"></div>
		</div>
		<div class="row">
			<div class="col-sm-12 mail_bg">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
				  	<td width="5%"></td>
					<td width="90%" valign="top">

						<div style="padding:20px 0px;">
						<span style="font-size:14px; font-weight:700;">No. WB/{{ $mail_down->application_no }}</span>
						<span style="font-size:14px; font-weight:700; float:right;">Date : {{ date('d-m-Y')}}</span>
						</div>
						<div style="font-size:14px; font-weight:700">To,</div>
						<div style="font-size:14px; font-weight:700">{{ $mail_down->mem_nm }}</div>
						<div style="font-size:14px; font-weight:700">{{ $mail_down->add_city }},{{ $mail_down->add_postofc }}</div>
						<div style="font-size:14px; font-weight:700">{{ $mail_down->add_ps }},{{ $mail_down->add_dist }}.</div>
						<div style="height:48px"></div>
						<div style="font-size:14px; font-weight:700;text-decoration:underline;" align="center" >Sub: E Verification.</div>
						<div style="height:10px"></div>
						<div style="font-size:14px;text-indent: 5%; text-align: justify; font-weight:500;">{{ $mail_down->mem_nm }} is requested to upload the scanned copy of your qualifications & experience in our site.
						</div>
						<div style="font-size:14px;text-indent: 5%; text-align: justify; font-weight:500; margin-top:5px;">A certificate issued by government group A Officer or Head Master of School/ Panchayat Pradhan/ Municipality Chairman/ M.L.A./ M.P./ Sabhapati/ Sabhadhipati in the following proforma is also to be uploaded.
  						</div>
						  <div style="font-size:16px; font-weight:700; text-decoration:underline; margin-top:10px;" align="center">PROFORMA</div>
						<div style="font-size:14px; text-decoration:underline; margin-top:10px;" align="center">Certificate</div>
						<div style="font-size:14px;text-indent: 5%; text-align: justify;  margin-top:20px;">This is to certify that I ............................................................. ......... .......... ........... ...........
						</div>
						<div style="font-size:14px;text-indent: 5%; text-align: justify;"><p>I personally know Mr./ Mrs.................................................................... .......... .......... ......... for</p><p> the last .......... .............years. He/ She bears a good moral character. He/ She addressed at</p>
						</div>
						<div>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td width="33%">Vill - .................................,</td>
								<td width="34%" align="center">P.O. - .................................,</td>
								<td width="33%" align="right">P.S. - .................................,</td>
								
							  </tr>
							  <tr><td>&nbsp;</td></tr>
							  <tr>
								<td width="33%">Dist - .................................,</td>
								<td width="34%">Pin - ..................................,</td>
								<td width="33%">State - ................................,</td>
								
							  </tr>
							</table>
						</div>
						<div style="margin-top:20px">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
								<td width="50%"></td>
								<td width="50%" style="padding:2px 0px">Signature-</td>
							  </tr>
							  <tr>
								<td></td>
								<td style="padding:2px 0px">Designation -</td>
							  </tr>
							  <tr>
								<td width="50%">Date-</td>
								<td width="50%" style="padding:2px 0px">Telephone No -</td>
							  </tr>
							  <tr>
								<td>Place -</td>
								<td style="padding:2px 0px">Seal -</td>
							  </tr>
							</table>
						</div>
						<div style="font-size:14px;text-indent: 5%; font-weight:500; margin-top:20px;margin-left:-25px">Requested to submit within 15 working days.</div>
						<div style="margin-top:10px">
							<table width="100%" border="0" cellspacing="0" cellpadding="0"  style='margin-top:20px'>
								
							  <tr>
								<td width="50%"></td>
								<td width="50%"style='margin-top:50px'>-Soumen Koley (Secretary)</td>
							  </tr>
							</table>
						</div>
						<div style="font-size:14px;text-indent: 1%; text-align: justify; margin-top:10px;"><li>Send all of your documents in <b>PDF Format</b> to <b>kbskdmt.hr@gmail.com.</b></li>
							<li>Letter issued by mail does not requires signature.</li>
					</td>
					<td width="5%"></td>
				  </tr>

				</table>

			</div>
		</div>
	</div>
</body>
</html>