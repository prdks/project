<?php
	require_once "../../vendor/mpdf/mpdf.php";
	ob_start();
  session_start();
	include_once "../_connect.php";

//-------------เช็คค่าว่าง --------------------//
$reservation_id = $_SESSION['reservation_id'];
$sql="SELECT * FROM title_name";
$result = $conn->query($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
</head>
<body>

  <table width="704" border="0" align="center">

    <tr>
      <td align="center" colspan="2">
				<span>
					<h3>ใบขออนุมัติใช้รถยนต์<?php echo $_SESSION['department']; ?></h3>
				</span>
		</td>
    </tr>

    <tr>
      <td height="27" align="right" colspan="2">วันที่<?php echo "".DateThai(date("Y-m-d"))."";?></td>
    </tr>
    <tr>
      <td height="25" align="left" style="padding:20px 0;"><span>เรียน คณบดี<?php echo $_SESSION['department']; ?></span></td>
    </tr>

		<tr>
				<td style="padding-left:50px">
					ข้าพเจ้า&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['title_name'].$_SESSION['user_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
				</td>
				<td>
					ตำแหน่ง&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['position']; ?>&nbsp;&nbsp;&nbsp;
				</td>
    </tr>
		<tr>
			<td colspan="2">
				ขออนุญาตใช้รถยนต์<?php echo $_SESSION['department']; ?> พร้อมพนักงานขับรถยนต์
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<?php echo $reservation_id ?>
			</td>
		</tr>

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

function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return " $strDay $strMonthThai $strYear";
	}
?>
<!--ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF/MyPDF.pdf">คลิกที่นี้</a>-->
