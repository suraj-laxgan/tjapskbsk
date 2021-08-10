<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Staff View</title>
</head>
<body>
    <div class="container-fluid">
		<div class="col-sm-12">
            <div style="text-align: center"><b >Staff Details :</b></div><br>
            <div style="text-align: center">Name : {{ $staff_view->f_nm }}</div>
            <div style="text-align: center">Address : {{ $staff_view->staff_add}}</div>
            <div style="text-align: center">Email : {{ $staff_view->staff_e_mail }}</div>	
            <div style="text-align: center">Mobile No : {{ $staff_view->staff_mob_1 }}</div>
            <div style="text-align: center">Land phone no : {{ $staff_view->staff_land_no }}</div>
        </div>
			<div align="center" style="margin-top: 25px"><input type="button" value="Close" class="button_grey" onClick="window.close()"></div>
		</div>
	</div>
</body>
</html>