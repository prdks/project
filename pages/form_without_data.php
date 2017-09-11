<?php
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

if (isset($_GET['id']))
{
	$id = $_GET['id']; // id reservation
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
	WHERE r.reservation_id = ".$id."
	GROUP BY r.reservation_id";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
	<title>ฟอร์มขออนุมัติใช้รถยนต์<?php echo $_SESSION['system_name'];?></title>

	<style type="text/css">
	FONT,td { font-family: MS Sans Serif; font-size: 12pt; }
	BODY { font-size: 12pt; font-family: MS Sans Serif; }
	body { margin: 0px 0px; padding: 0px 0px}
	</style>
</head>
<body>
	<table width="80%" border="0" align="center" height="50">
	  <tbody>
			<tr>
	    <td width="12%" height="50" align="center"><img src="viewqrcode.php?id=<?php echo $id;?>" width="65" height="65"></td>
	    <td width="68%" height="50">
	      <div align="center"><h3>ใบขออนุมัติใช้รถยนต์<?php echo $_SESSION['system_name'];?></h3></div>
	    </td>
	  	</tr>
	</tbody>
</table>

<table width="100%" border="0" align="center" cellpadding="0">
<tbody>
	<tr>
  <td width="100%" align="right"><?php echo FullDateThai(date("Y-m-d")); ?></td>
	</tr>
</tbody>
</table>

<table width="100%" border="0" align="center" cellpadding="0">
<tbody>
	<tr>
    <td colspan="2" height="30">&nbsp;</td>
    </tr>
</tbody>
</table>

<table width="100%" border="0" align="center" cellpadding="0">
<tbody>
	<tr>
    <td width="7%">เรียน</td>
		<td width="93%">คณบดี<?php echo $_SESSION['system_name'];?></td>
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

<table width="100%" border="0" cellpadding="0" style="line-height: 1.6;">
<tbody>
	<tr>
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
	<!-- ขื่อ นามสกุลคนทำเรื่อง -->
	<tr>
		<td colspan="2"></td>
		<td colspan="10">ข้าพเจ้า <?php echo $row['title_name'].$row['personnel_name']; ?></td>
		<td colspan="8">ตำแหน่ง <?php echo $row['position_name']; ?></td>
	</tr>
	<!-- ประโยคต้นคำร้อง -->
	<tr>
		<td colspan="20" style="text-align: justify;">ขออนุญาตใช้รถยนต์<?php echo $_SESSION['system_name']; ?> พร้อมพนักงานขับรถยนต์
			&nbsp;เพื่อเดินทางไปที่ <?php 
			$location = $row['location']; 
			$numlocation = substr_count($location,",");
			echo str_replace(",",", ",$location);
			?>
			&nbsp;สำหรับปฏิบัติราชการ <?php echo $row['requirement_detail']; ?>
			<?php
			if ($row['date_start'] === $row['date_end']) //ถ้าไปวันเดียว
			{
				?>ในวันที่ <?php echo DateThai($row['date_start']); ?>
				ตั้งแต่เวลา <?php echo TimeThai($row['reserv_stime'])." ถึง ".TimeThai($row['reserv_etime']); ?>
				<?php
			}
			else //หลายวัน
			{
				?>ในวันที่ <?php echo DateThai($row['date_start']); ?>
				เวลา <?php echo TimeThai($row['reserv_stime']); ?>
				ถึงวันที่ <?php echo DateThai($row['date_end']); ?>
				เวลา <?php echo TimeThai($row['reserv_etime']); ?>
				<?php
			}
			?>
		</td>
	</tr>
	<!-- รายชื่อคนไป -->
	<?php
	if ($row['passenger_total'] != 0)
	{
		?>
		<tr>
			<td colspan="4" style="vertical-align: text-top;">มีคนนั่ง <?php echo $row['passenger_total']; ?> คน ดังนี้&nbsp;&nbsp;</td>
			<?php
			if($row['passenger_total'] <= 6){
				?>
				<td colspan="16" style="vertical-align: text-top;">
				<?php
				$sql2 = "
				SELECT p.* ,SUBSTRING_INDEX(p.passenger_name,' ',-2) as name
		 		 , SUBSTRING_INDEX(p.passenger_name,' ',1) as title FROM passenger p
				LEFT JOIN department d
				ON p.department_id = d.department_id
				LEFT JOIN reservation r
				ON p.reservation_id = r.reservation_id
				WHERE p.reservation_id = '".$row['reservation_id']."'
				ORDER BY p.passenger_name ASC";
				$a = $conn->query($sql2);
				$count = 0;
				?>
				<?php while ($b = $a->fetch_assoc()) 
					{
						$count++;
						echo $count.". ".$b['title'].$b['name']." <br>";
					}
			?>
			</td>
		  <?php
			}
			else if ($row['passenger_total'] > 6) {
				?>
				<td colspan="8" style="vertical-align: text-top;">
				<?php
				$sql2 = "
				SELECT p.* ,SUBSTRING_INDEX(p.passenger_name,' ',-2) as name
		 		 , SUBSTRING_INDEX(p.passenger_name,' ',1) as title FROM passenger p
				LEFT JOIN department d
				ON p.department_id = d.department_id
				LEFT JOIN reservation r
				ON p.reservation_id = r.reservation_id
				WHERE p.reservation_id = '".$row['reservation_id']."'
				ORDER BY p.passenger_name ASC";
				$a = $conn->query($sql2);
				$count = 0;
				?>
				<?php while ($b = $a->fetch_assoc()) 
					{
						$count++;
						if($count <= 6 ){
							echo $count.". ".$b['title'].$b['name']." <br>";
							if($count == 6){ echo "</td>";}
						}
						if($count == 7)
						{
						?>
						<td colspan="8" style="vertical-align: text-top;">
						<?php
						}
						if($count > 6 ){echo $count.". ".$b['title'].$b['name']." <br>";}
					}
				?>
				</td>
				<?php
			}
			
        
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

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td width="100%" align="right">
			ลงชื่อ
			&nbsp;&nbsp;
			.......................................
			&nbsp;&nbsp;
			ผู้ขออนุมัติ
		</td>
	</tr>
</tbody>
</table>

<table width="100%" border="0" align="center" cellpadding="0">
<tbody>
	<tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td width="40%" align="right">
			(..........................................)&nbsp;
		</td>
		<td width="4%"></td>
	</tr>
</tbody>
</table>

<table width="100%" border="0" align="center" cellpadding="0">
<tbody>
	<tr>
    <td colspan="2" height="30">&nbsp;</td>
    </tr>
</tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td width="7%">เรียน</td>
		<td width="20%">คณบดี</td>
		<td width="57%" align="right">คำสั่ง</td>
		<td width="16%"></td>
	</tr>
</tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td width="7%"></td>
		<td width="57%">เพื่อโปรดพิจารณาอนุมัติรถยนต์หมายเลขทะเบียน</td>
		<td width="15%" align="right">
                &#9723; อนุมัติ
		</td>
		<td width="15%" align="right">
		        &#9723; ไม่อนุมัติ
		</td>
		<td width="17%"></td>
	</tr>
</tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td width="7%"></td>
		<td width="93%"><b><?php echo $row['car_reg']; ?></b></td>
	</tr>
</tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td width="70%"></td>
			<td width="24%" align="right">
			.......................................
			</td>
			<td width="16%"></td>
		</tr>
	</tbody>
	</table>



<table width="100%" border="0" align="center" cellpadding="0">
<tbody>
	<tr>
    <td colspan="2" height="10">&nbsp;</td>
  </tr>
</tbody>
</table>

<table width="100%" border="0" align="center" cellpadding="0">
<tbody>
	<tr>
		<td width="7%"></td>
		<td width="63%">.......................................</td>
		<td width="24%" align="right">.......................................</td>
		<td width="16%"></td>
  </tr>
</tbody>
</table>

<table width="100%" border="0" align="center" cellpadding="5">
<tbody>
	<tr>
		<td width="6%"></td>
		<td width="64%">(.....................................)</td>
		<td width="25%" align="right">(.....................................)</td>
		<td width="15%"></td>
  </tr>
</tbody>
</table>

<table width="100%" border="0" align="center" cellpadding="0">
<tbody>
	<tr>
		<td width="7%"></td>
		<td width="43%">ตำแหน่ง หัวหน้าสำนักคณบดี</td>
		<td width="50%" align="right">ตำแหน่ง คณบดี/รองคณบดีปฏิบัติราชการแทนคณบดี</td>
  </tr>
</tbody>
</table>

<table width="100%" border="0" align="center" cellpadding="5">
<tbody>
	<tr><td></td></tr>
</tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td width="95%" align="right">วันที่.......................................</td>
		<td width="5%"></td>
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

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td width="100%" align="center"><h4>บันทึกพนักงานขับรถยนต์และยามรักษาการณ์</h4></td>
	</tr>
</tbody>
</table>

<?php
if ($row['date_start'] === $row['date_end']) //ถ้าไปวันเดียว
{
	?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td width="50%">รถยนต์ หมายเลขทะเบียน <?php echo $row['car_reg']; ?></td>
		<td width="45%" align="right">วันที่ ......................................</td>
		<td width="5%"></td>
	</tr>
</tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td width="50%">เวลาออก ........................................................... น.</td>
		<td width="45%" align="right">เลขกิโลเมตรเมื่อออก .....................................</td>
		<td width="5%"></td>
	</tr>
</tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td width="50%">เวลากลับ ........................................................... น.</td>
		<td width="45%" align="right">เลขกิโลเมตรเมื่อกลับ .....................................</td>
		<td width="5%"></td>
	</tr>
</tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td width="100%">รวมระยะทางกิโลเมตร .............................................</td>
	</tr>
</tbody>
</table>

<?php
}
else
{ //หลายวัน
	?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td width="100%">รถยนต์ หมายเลขทะเบียน <?php echo $row['car_reg']; ?></td>
		</tr>
	</tbody>
	</table>

	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td width="25%">วันที่ ................................</td>
			<td width="25%">เวลาออก ..................... น.</td>
			<td width="45%" align="right">เลขกิโลเมตรเมื่อออก .....................................</td>
			<td width="5%"></td>
		</tr>
	</tbody>
	</table>

	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td width="25%">วันที่ ................................</td>
			<td width="25%">เวลากลับ ..................... น.</td>
			<td width="45%" align="right">เลขกิโลเมตรเมื่อกลับ .....................................</td>
			<td width="5%"></td>
		</tr>
	</tbody>
	</table>

	<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td width="100%">รวมระยะทางกิโลเมตร ...............................................</td>
		</tr>
	</tbody>
	</table>

	<?php
}
?>
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
		<td width="50%"></td>
		<td width="45%" align="right">(ลายมือชื่อ).......................................</td>
		<td width="5%"></td>
  </tr>
</tbody>
</table>
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

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td width="85%" align="right">
			(<?php echo $e['title_name'].$e['personnel_name']; ?>)
		</td>
		<td width="5%"></td>
	</tr>
</tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td width="85%" align="right">พนักงานขับรถยนต์</td>
		<td width="5%"></td>
	</tr>
</tbody>
</table>

<script type="text/javascript">
setTimeout(function(){window.print();}, 1000);
setTimeout(function(){window.close();}, 1000);
</script>
</body>
</html>
<?php
}
else
{
	echo "
	<!DOCTYPE html>
	<script>
	alert('ERROR');
	window.location.assign('index.php');
	</script>
	";
}
