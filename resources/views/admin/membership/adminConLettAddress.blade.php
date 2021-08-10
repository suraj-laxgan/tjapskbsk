<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Address</title>
</head>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">
    <form method="post" name="default_emplate" id="default_emplate" enctype="multipart/form-data">
      <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
        <tr>
          <td valign="top" align="center">
          <table width="70%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" class="text_2"><b>To</b></td>
              </tr>
              <tr>
                <td align="left" class="text_2"><b>{{ $ma_print[0]->mem_nm }}</b></td>
              </tr>
              <tr>
                <td align="left" class="text_2"><b>{{ $ma_print[0]->guard_nm }}</b></td>
              </tr>
              <tr>
                <td align="left" class="text_2"><b>{{ $ma_print[0]->mem_add }}</b><br></td>
              </tr>
              <tr>
                <td align="center">
                  {!! DNS1D::getBarcodeHTML($ma_print[0]->rand_no, 'C39') !!}
                </td>
              </tr>
              <tr>
              <td align="center" class="text_2">{{ $ma_print[0]->memo_id }}</td>
              </tr>
              </table>
            </td>
        </tr>
      </table>
    </form>
  </body>
</html>