<?php
	require_once "../vendor/mpdf/mpdf.php";
	ob_start();
  session_start();
	include_once "_connect.php";

//-------------เช็คค่าว่าง --------------------//
$sql="SELECT * FROM title_name";
$result = $conn->query($sql);
$result_row = mysqli_num_rows($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<script type="text/javascript" src="../vendor/qrcode/qrcode.js"></script>
<script type="text/javascript" src="../vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../vendor/jquery/jquery.maskedinput.js"></script>
<script type="text/javascript" src="../vendor/jquery-ui/jquery-ui.js"></script>
<script src="../dist/js/app.js"></script>
</head>
<body>

  <table width="200" border="0" align="center">
    <tbody>
      <tr>
				<td>
					test

				</td>
      </tr>
    </tbody>
  </table>

</body>
</html>


<?Php
$html = ob_get_contents();
ob_end_clean();
$pdf = new mPDF('th', 'A4', '0', 'THSaraban');
$pdf->SetAutoFont();
$pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html, 2);
$pdf->Output();         // เก็บไฟล์ html ที่แปลงแล้วไว้ใน MyPDF/MyPDF.pdf ถ้าต้องการให้แสดง
?>
<!--ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF/MyPDF.pdf">คลิกที่นี้</a>-->
