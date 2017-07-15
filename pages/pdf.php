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
$id = $_GET['id'];
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
WHERE r.reservation_id = 5
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
		<!-- วันที่ขวา -->
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
		<!-- เรียน ... -->
		<tr>
			<td>เรียน</td>
			<td colspan="19">หฟกฟหกฟหก</td>
		</tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- ขื่อ นามสกุลคนทำเรื่อง -->
		<tr>
			<td colspan="3"></td>
			<td colspan="9">ข้าพเจ้า <?php echo $row['title_name'].$row['personnel_name']; ?></td>
			<td colspan="8">ตำแหน่ง <?php echo $row['position_name']; ?></td>
		</tr>
		<!-- ประโยคต้นคำร้อง -->
		<tr>
			<td colspan="20">ขออนุญาตใช้รถยนต์<?php echo $row['department_name']; ?> พร้อมพนักงานขับรถยนต์</td>
		</tr>
		<!-- สถานที่ -->
		<tr>
			<td colspan="3">เพื่อเดินทางไปที่</td>
			<td colspan="17"><?php echo $row['location']; ?></td>
		</tr>
		<!-- รายละเอียด -->
		<tr>
			<td colspan="20" style="text-align: justify;">สำหรับปฏิบัติราชการ <?php echo $row['requirement_detail']; ?></td>
		</tr>
		<!-- รายชื่อคนไป -->
		<?php
		if ($row['passenger_total'] != 0)
		{
			?>
			<tr>
				<td colspan="3">มีคนนั่ง <?php echo $row['passenger_total']; ?> คน</td>
				<td colspan="2">ดังนี้</td>
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
		}
		?>


		<?php
		if ($row['date_start'] === $row['date_end']) //ถ้าไปวันเดียว
		{
			?>
			<tr>
				<td colspan="6">
					ในวันที่ <?php echo DateThai($row['date_start']); ?>
				</td>
				<td colspan="14">
					ตั้งแต่เวลา <?php echo TimeThai($row['reserv_stime'])." ถึง ".TimeThai($row['reserv_etime']); ?></td>
			</tr>
			<?php
		}
		else //หลายวัน
		{
			?>
			<tr>
				<td colspan="6">ในวันที่ <?php echo DateThai($row['date_start']); ?></td>
				<td colspan="3">เวลา <?php echo TimeThai($row['reserv_stime']); ?></td>
				<td colspan="6">&nbsp;&nbsp;ถึงวันที่ <?php echo DateThai($row['date_end']); ?></td>
				<td colspan="5">เวลา <?php echo TimeThai($row['reserv_etime']); ?></td>
			</tr>
			<?php
		}
		?>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- ลงชื่อคนทำเรื่อง ขวา -->
		<tr>
			<td colspan="12"></td>
			<td colspan="8" align="center">
				ลงชื่อ
				&nbsp;&nbsp;&nbsp;
				<?php echo $row['personnel_name']; ?>
				&nbsp;&nbsp;&nbsp;
				ผู้ขออนุมัติ
			</td>
		</tr>
		<!-- วงเล็บคนทำเรื่อง ขวา -->
		<tr>
			<td colspan="12"></td>
			<td colspan="8" align="center">
				(<?php echo $row['title_name'].$row['personnel_name'];?>)
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
		<tr height="30px"></tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- เรียน คณบดี ซ้าย -->
		<tr>
			<td>เรียน</td>
			<td colspan="11">คณบดี</td>
			<!-- คำสั่ง ขวา -->
			<td colspan="7" align="center">คำสั่ง&nbsp;</td>
			<td></td>
		</tr>
		<!-- โปร.. ทะเบียน ซ้าย -->
		<tr>
			<td></td>
			<td colspan="11">เพื่อโปรดพิจารณาอนุมัติรถยนต์หมายเลขทะเบียน</td>
			<!-- checkbox ขวา -->
			<td colspan="3" align="center">
				<?php if ($row['reservation_status'] == 1) {
					?><input type="checkbox" checked="true"><?php
				}else {
					?><input type="checkbox"><?php
				} ?>
				อนุมัติ
			</td>
			<td colspan="4" align="center">
				<?php if ($row['reservation_status'] == 2 || $row['reservation_status'] == 3) {
					?><input type="checkbox" checked="true"><?php
				}else {
					?><input type="checkbox" ><?php
				} ?>
				ไม่อนุมัติ
			</td>
			<td></td>
		</tr>
		<tr height="20px"></tr>
		<!-- ทะเบียนรถ -->
		<tr>
			<td></td>
			<td colspan="11"><?php echo $row['car_reg']; ?></td>
		<!-- ช่องว่างใส่หมายเหตุอนุมัติ -->
			<td colspan="7">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<u>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;
				</u>
			</td>
			<td></td>
		</tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- ช่องเซ็น -->
		<tr>
			<!-- ซ้าย -->
			<td colspan="1"></td>
			<td colspan="1"></td>
			<td colspan="6">
				&nbsp;<u>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;
				</u>
			</td>
			<td colspan="3"></td>
			<!-- ขวา -->
			<td colspan="1">ลงชื่อ</td>
			<td colspan="7" >
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<u>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;
				</u>
		</td>
			<td colspan="1"></td>
		</tr>
		<!-- ช่องวงเล็บ -->
		<tr>
			<!-- ซ้าย -->
			<td colspan="2"></td>
			<td colspan="6">
				&nbsp;(
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				)
			</td>
			<td colspan="3"></td>
			<!-- ขวา -->
			<td colspan="1"></td>
			<td colspan="7">
				&nbsp;&nbsp;&nbsp;
				(&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				)</td>
			<td colspan="1"></td>
		</tr>
		<!-- บอกตำแหน่งผู้เซ็น -->
		<tr>
			<!-- ซ้าย -->
			<td colspan="2"></td>
			<td colspan="6" align="center">ตำแหน่ง หัวหน้าสำนักคณบดี</td>
			<!-- ขวา -->
			<td colspan="2"></td>
			<td colspan="10" align="center">ตำแหน่ง คณบดี/รองคณบดีปฏิบัติราชการแทนคณบดี</td>
		</tr>
		<!-- วันที่เซ็น ขวา -->
		<tr>
			<td colspan="13"></td>
			<td colspan="7">วันที่ ......................................</td>
		</tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- สำหรับช่องระหว่างบรรทัด --><tr><td></td></tr>
		<!-- Head บันทึกเวลา -->
		<tr>
			<td colspan="20" align="center"><h4>บันทึกพนักงานขับรถยนต์และยามรักษาการณ์</h4></td>
		</tr>
		<?php
		if ($row['date_start'] === $row['date_end']) //ถ้าไปวันเดียว
		{
			?>
			<!-- ทะเบียนรถยนต์ -->
			<tr>
				<td colspan="13">รถยนต์ หมายเลขทะเบียน <?php echo $row['car_reg']; ?></td>
				<td colspan="7">วันที่ ......................................</td>
			</tr>
			<!-- บันทึกเวลาออกจากม. -->
			<tr>
				<td colspan="9">เวลาออก ...........................................................</td>
				<td>น.</td>
				<td colspan="1"></td>
				<td colspan="8">เลขกิโลเมตรเมื่อออก .................................</td>
				<td></td>
			</tr>
			<!-- บันทึกเวลากลับม. -->
			<tr>
				<td colspan="9">เวลากลับ ...........................................................</td>
				<td>น.</td>
				<td colspan="1"></td>
				<td colspan="8">เลขกิโลเมตรเมื่อกลับ .................................</td>
				<td></td>
			</tr>
			<!-- ระยะทางรวม -->
			<tr>
				<td colspan="10">รวมระยะทางกิโลเมตร .............................................</td>
				<td colspan="10"></td>
			</tr>
			<?php
		}
		else { //หลายวัน
			?>
			<!-- ทะเบียนรถยนต์ -->
			<tr>
				<td colspan="20">รถยนต์ หมายเลขทะเบียน <?php echo $row['car_reg']; ?></td>
			</tr>
			<!-- บันทึกเวลาออกจากม. -->
			<tr>
				<td colspan="5">วันที่ ................................</td>
				<td colspan="4">เวลาออก ................</td>
				<td>น.</td>
				<td colspan="1"></td>
				<td colspan="8">เลขกิโลเมตรเมื่อออก .................................</td>
				<td></td>
			</tr>
			<!-- บันทึกเวลากลับม. -->
			<tr>
				<td colspan="5">วันที่ ................................</td>
				<td colspan="4">เวลากลับ ................</td>
				<td>น.</td>
				<td colspan="1"></td>
				<td colspan="8">เลขกิโลเมตรเมื่อกลับ .................................</td>
				<td></td>
			</tr>
			<!-- ระยะทางรวม -->
			<tr>
				<td colspan="10">รวมระยะทางกิโลเมตร .............................................</td>
				<td colspan="10"></td>
			</tr>
			<?php
		}
		?>
		<!-- คนขับเซ็น -->
		<tr>
			<td colspan="9"></td>
			<td colspan="3" align="right">(ลายมือชื่อ)</td>
			<td colspan="7">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<u>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;
				</u>
			</td>
			<td></td>
		</tr>
		<!-- วงเล็บ -->
		<?php
		$sql_driver = "
		Select * from personnel p
		LEFT JOIN cars c
		ON c.personnel_id = p.personnel_id
		LEFT JOIN title_name t
		ON p.title_name_id = t.title_name_id
		WHERE c.car_id = '".$row['car_id']."'
		";
		$d = $conn->query($sql_driver);
		$e = $d->fetch_assoc();
		?>
		<tr>
			<td colspan="11"></td>
			<td colspan="1"></td>
			<td colspan="7" align="center">(<?php echo $e['title_name'].$e['personnel_name']; ?>)</td>
			<td></td>
		</tr>
		<!-- ตำแหน่งขับรถ -->
		<tr>
			<td colspan="12"></td>
			<td colspan="7" align="center">พนักงานขับรถยนต์</td>
			<td></td>
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
