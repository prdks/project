<?php
	require_once "../vendor/mpdf/mpdf.php";
	ob_start();
  session_start();
	include_once "_connect.php";

	date_default_timezone_set("Asia/Bangkok");

	function DateThai($strDate)
	  {
	    $strYear = date("Y",strtotime($strDate))+543;
	    $strMonth= date("n",strtotime($strDate));
	    $strDay= date("j",strtotime($strDate));
	    $strHour= date("H",strtotime($strDate));
	    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	    $strMonthThai=$strMonthCut[$strMonth];
	    return "$strDay $strMonthThai $strYear";
	  }
	function FullDateThai($strDate)
	  {
	      $strYear = date("y",strtotime($strDate))+43;
	      $strMonth= date("n",strtotime($strDate));
	      $strDay= date("j",strtotime($strDate));
	      $strHour= date("H",strtotime($strDate));
				$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	      $strMonthThai=$strMonthCut[$strMonth];
	      return "วันที่ $strDay $strMonthThai $strYear";
	  }
	  function TimeThai($strDate)
	  {
	    $strYear = date("Y",strtotime($strDate))+543;
	    $strMonth= date("n",strtotime($strDate));
	    $strDay= date("j",strtotime($strDate));
	    $strHour= date("H",strtotime($strDate));
	    $strMinute= date("i",strtotime($strDate));
	    $strSeconds= date("s",strtotime($strDate));
	    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	    $strMonthThai=$strMonthCut[$strMonth];
	    return "$strHour:$strMinute"." น.";
	  }

//-------------เช็คค่าว่าง --------------------//
$sql="SELECT  * FROM reservation r
LEFT JOIN cars c
ON r.car_id = c.car_id
LEFT JOIN car_brand cb
ON c.car_brand_id = cb.car_brand_id
LEFT JOIN personnel p
ON r.personnel_id = p.personnel_id
LEFT JOIN title_name t
ON p.title_name_id = t.title_name_id
LEFT JOIN position po
ON p.position_id = po.position_id
LEFT JOIN department d
ON p.department_id = p.department_id
WHERE r.reservation_id = 4
GROUP BY r.reservation_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
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

	<h3 style="text-align:center;">ใบขออนุมัติใช้รถยนต์คณะอุตสาหกรรมเกษตร</h3>
	<table width="100%" border="1">
		<tr heigth="0px">
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
			<td width="5%"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td colspan="4"><?php echo FullDateThai(date("Y-m-d")); ?></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>เรียน</td>
			<td colspan="19">หฟกฟหกฟหก</td>
		</tr>
		<tr height="10px">
			<td colspan="20">&nbsp;</td>
		</tr>
		<tr height="10px"></tr>
		<tr>
			<td colspan="3"></td>
			<td colspan="9">ข้าพเจ้า <?php echo $row['title_name'].$row['personnel_name']; ?></td>
			<td colspan="8">ตำแหน่ง <?php echo $row['position_name']; ?></td>
		</tr>
		<tr>
			<td colspan="20">ขออนุญาตใช้รถยนต์<?php echo $row['department_name']; ?> พร้อมพนักงานขับรถยนต์</td>
		</tr>
		<tr>
			<td colspan="4">เพื่อเดินทางไปที่</td>
			<td colspan="16"><?php echo $row['location']; ?></td>
		</tr>
		<tr>
			<td colspan="20" style="text-align: justify;">สำหรับปฏิบัติราชการ <?php echo $row['requirement_detail']; ?></td>
		</tr>
		<tr>
			<td colspan="2">มีคนนั่ง</td>
			<td colspan="1"><?php echo $row['passenger_total']; ?></td>
			<td colspan="1">คน</td>
			<td colspan="1"></td>
			<?php
			$sql2 = "
			SELECT p.* FROM passenger p
			LEFT JOIN department d
			ON p.department_id = d.department_id
			LEFT JOIN reservation r
			ON p.reservation_id = r.reservation_id
			WHERE p.reservation_id = '".$row['reservation_id']."'
			ORDER BY p.passenger_name ASC";
			$a = $conn->query($sql2);
			$count = 0;
			?>
			<?php while ($b = $a->fetch_assoc()) {
					$count++;
						if ($count == 1)
						{
							?>
							<td colspan="15"><?php echo $count.". ".$b['passenger_name']; ?></td>
						</tr>
							<?php
						}
						else
						{
							?>
							<tr>
								<td colspan="5"></td>
								<td colspan="15"><?php echo $count.". ".$b['passenger_name']; ?></td>
							</tr>
							<?php
						}
			}
		?>

		<?php
		if ($row['date_start'] === $row['date_end'])
		{
			?>
			<tr>
				<td colspan="6">ในวันที่</td>
				<td colspan="8"><?php echo DateThai($row['date_start']); ?></td>
				<td colspan="1">เวลา</td>
				<td colspan="6"><?php echo TimeThai($row['reserv_stime'])." ถึง ".TimeThai($row['reserv_stime']); ?></td>
			</tr>
			<?php
		}
		else
		{
			?>
			<tr>
				<td colspan="6">ในวันที่</td>
				<td colspan="8"><?php echo DateThai($row['date_start']); ?></td>
				<td colspan="1">เวลา</td>
				<td colspan="4"><?php echo TimeThai($row['reserv_stime']); ?></td>
			</tr>
			<tr>
				<td colspan="6">ถึงวันที่</td>
				<td colspan="8"><?php echo DateThai($row['date_end']); ?></td>
				<td colspan="1">เวลา</td>
				<td colspan="4"><?php echo TimeThai($row['reserv_etime']); ?></td>
			</tr>
			<?php
		}
		?>

		<tr height="20px"></tr>
		<tr>
			<td colspan="12"></td>
			<td colspan="8" align="center">
				ลงชื่อ
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo $row['personnel_name']; ?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				ผู้ขออนุมัติ
			</td>

		</tr>
		<tr>
			<td colspan="12"></td>
			<td colspan="8" align="center">
				(
				&nbsp;
				<?php echo $row['title_name'].$row['personnel_name'];?>
				&nbsp;
				)
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
		<tr height="30px"></tr>
		<tr>
			<td>เรียน</td>
			<td colspan="11">คณบดี</td>
			<td colspan="8" align="center">คำสั่ง</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="11">เพื่อโปรดพิจารณาอนุมัติรถยนต์หมายเลขทะเบียน</td>
			<td></td>
			<td colspan="2">อนุมัติ</td>
			<td></td>
			<td colspan="2">ไม่อนุมัติ</td>
		</tr>
		<tr height="20px"></tr>
		<tr>
			<td></td>
			<td colspan="19"><?php echo $row['car_reg']; ?></td>
		</tr>
		<tr height="30px"></tr>
		<tr>
			<td colspan="2"></td>
			<td colspan="5" align="center">ลายเซน</td>
			<td colspan="5"></td>
			<td colspan="1">ลงชื่อ</td>
			<td colspan="7"></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td colspan="5" align="center">(นาง เสาวนี หกฟหก)</td>
			<td colspan="6"></td>
			<td colspan="1">(</td>
			<td colspan="3"></td>
			<td colspan="3">)</td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td colspan="5" align="center">ตำแหน่ง หัวหน้าสำนักคณบดี</td>
			<td colspan="5"></td>
			<td colspan="7" align="center">ตำแหน่ง คณบดี/รองคณบดี/ปฏิบัติราชการแทนคณบดี</td>
		</tr>
		<tr>
			<td colspan="12"></td>
			<td colspan="7" align="center">วันที่ 1 / ก.ย. / 2560</td>
		</tr>
		<tr height="30px"></tr>
		<tr>
			<td colspan="20" align="center"><h4>บันทึกพนักงานขับรถยนต์และยามรักษาการณ์</h4></td>
		</tr>
		<tr>
			<td colspan="5">รถตู้ หมายเลขทะเบียน</td>
			<td colspan="5" align="center">นช 4609 ปราจีนบุรี</td>
			<td colspan="2"></td>
			<td colspan="2">วันที่</td>
			<td colspan="3" align="center">1 / ก.ย./ 2560</td>
		</tr>
		<tr>
			<td colspan="4">เวลาออก</td>
			<td colspan="6" align="center">16.00 น.</td>
			<td colspan="1"></td>
			<td colspan="4">เลขกิโลเมตรที่ออก</td>
			<td colspan="2" align="center">10000</td>
		</tr>
		<tr>
			<td colspan="4">เวลากลับ</td>
			<td colspan="6" align="center">16.00 น.</td>
			<td colspan="1"></td>
			<td colspan="4">เลขกิโลเมตรที่กลับ</td>
			<td colspan="2" align="center">20000</td>
		</tr>
		<tr>
			<td colspan="6">รวมระยะทางกิโลเมตร</td>
			<td colspan="2" align="center">10000</td>
		</tr>
		<tr>
			<td colspan="12"></td>
			<td colspan="1">ลงชื่อ</td>
			<td colspan="7"></td>
		</tr>
		<tr>
			<td colspan="13"></td>
			<td colspan="1">(</td>
			<td colspan="3"></td>
			<td colspan="3">)</td>
		</tr>
		<tr>
			<td colspan="14"></td>
			<td colspan="6">พนักงานขับรถ</td>
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
?>
<!--ดาวโหลดรายงานในรูปแบบ PDF <a href="MyPDF/MyPDF.pdf">คลิกที่นี้</a>-->
