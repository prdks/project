<?php
	require_once "../vendor/mpdf/mpdf.php";
	ob_start();
  session_start();
	date_default_timezone_set("Asia/Bangkok");
	include_once "_connect.php";
// -----------------------------------------//
function FullDateThai($strDate)
  {
      $strYear = date("Y",strtotime($strDate))+543;
      $strMonth= date("n",strtotime($strDate));
      $strDay= date("j",strtotime($strDate));
      $strHour= date("H",strtotime($strDate));
      $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
      $strMonthThai=$strMonthCut[$strMonth];
      return "วันที่ $strDay $strMonthThai พ.ศ. $strYear";
  }
	function ShortDateThai($strDate)
	  {
	    $strYear = date("Y",strtotime($strDate))+543;
	    $strMonth= date("n",strtotime($strDate));
	    $strDay= date("j",strtotime($strDate));
	    $strHour= date("H",strtotime($strDate));
	    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	    $strMonthThai=$strMonthCut[$strMonth];
	    return "$strDay $strMonthThai $strYear";
	  }
//-------------เช็คค่าว่าง --------------------//
$date_start = $_GET['start'];
$date_end = $_GET['end'];

$sql = "
SELECT * FROM reservation r
LEFT JOIN cars c
ON r.car_id = c.car_id
LEFT JOIN car_brand b
ON c.car_brand_id = b.car_brand_id
LEFT JOIN personnel p
ON r.personnel_id = p.personnel_id
LEFT JOIN department d
ON p.department_id = d.department_id
LEFT JOIN title_name t
ON p.title_name_id = t.title_name_id
WHERE date_start >= '".$date_start."'
AND date_end <= '".$date_end."'
AND reservation_status = 1
ORDER BY date_start ASC";
$result = $conn->query($sql);
$result_row = mysqli_num_rows($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
	<title>วันที่ออกรายงาน <?php echo ShortDateThai(date("Y-m-d")); ?></title>
</head>
<body>
	<table width="100%" border="0" align="center" height="50">
	  <tbody>
			<tr>
	    <td width="100%"  align="center"><h3>รายงานการจองรถยนต์</h3></td>
	  	</tr>
	</tbody>
	</table>
	<body>
		<table width="100%" border="0" align="center" height="50">
		  <tbody>
				<tr>
		    <td width="100%" align="center"><h3><?php echo $_SESSION['system_name'];?></h3></td>
		  	</tr>
		</tbody>
		</table>

	<table width="100%" border="0" align="center">
	  <tbody>
			<tr>
			<?php
			if ($date_start !== $date_end)
			{
			?>
			<td width="100%" align="center"><h4>ระหว่างวันที่ <?php echo ShortDateThai($date_start).' ถึง '.ShortDateThai($date_end); ?></h4></td>
			<?php
			}
			else
			{
			?>
			<td width="100%" align="center"><h4>วันที่<?php echo ShortDateThai($date_start); ?></h4></td>
			<?php
			}
			?>
	  	</tr>
		</tbody>
	</table>

	<table width="100%" border="0" align="center" cellpadding="0">
	<tbody>
		<tr>
	    <td colspan="2" height="20">&nbsp;</td>
	    </tr>
	</tbody>
	</table>

	<!-- ตาราง -->
	<table width="100%" style="border:1px solid black;border-collapse:collapse;" cellpadding="10" align="center">
			<thead>
					<tr height="50">
						<th style="border:1px solid black;" width="15%">ทะเบียนรถยนต์</th>
						<th style="border:1px solid black;" width="25%">วันที่ใช้รถยนต์</th>
						<th style="border:1px solid black;" width="30%">จองใช้เพื่อ</th>
						<th style="border:1px solid black;" width="30%">สถานที่ไป</th>
						<th style="border:1px solid black; " width="20%">หน่วยงาน</th>
					</tr>
			</thead>
			<tbody>
			<?php
	    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
	    {
					$cout = 0;
					while ($row = $result->fetch_assoc())
					{ $count++;
					?>
					<tr>
						<td align="center" style="border:1px solid black;"><?php echo $row["car_reg"]; ?></td>
						<td style="border:1px solid black;">
							<?php echo ShortDateThai($row["date_start"]).' '.date("H:i",strtotime($row["reserv_stime"])).'น.'; ?><br />
							<?php echo ShortDateThai($row["date_end"]).' '.date("H:i",strtotime($row["reserv_etime"])).'น.'; ?>
						</td>
						<td style="border:1px solid black; white-space: pre-line;"><?php echo $row["requirement_detail"]; ?></td>
						<td style="border:1px solid black; white-space: pre-line;"><?php echo $row["location"]; ?></td>
						<td style="border:1px solid black; white-space: pre-line;" width="5%"><?php echo $row["department_name"]; ?></td>
					</tr>
					<?php
					}
			 ?>
					 <tr>
					 	<td colspan="4" align="center"><b>รวมทั้งหมด <?php echo $count; ?> รายการ</b></td>
					 </tr>
			<?php
			}
			else
			{
				?>
 					 <tr>
 					 	<td colspan="4" align="center"><b>** ไม่พบข้อมูลตามเงื่อนไข **</b></td>
 					 </tr>
 			<?php
			}
			?>
			</tbody>
</table>

<table width="100%" border="0" align="center" cellpadding="0">
<tbody>
	<tr>
		<td colspan="2" height="20">&nbsp;</td>
		</tr>
</tbody>
</table>

<table width="100%" border="0" align="center" cellpadding="0">
<tbody>
	<tr>
		<td width="100%"><b>หมายเหตุ : </b>แสดงเฉพาะรายการที่อนุมัติ</td>
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
