<?php
  session_start();
	include_once "_connect.php";
	date_default_timezone_set("Asia/Bangkok");

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
	    <td width="100%" height="50">
	      <div align="center"><h3>ใบขออนุมัติใช้รถยนต์<?php echo $_SESSION['system_name'];?></h3></div>
	    </td>
	  	</tr>
	</tbody>
</table>

<table width="100%" border="0" align="center" cellpadding="0">
<tbody>
	<tr>
  <td width="100%" align="right">วันที่ .................................</td>
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
		<td colspan="10">ข้าพเจ้า ..................................................................</td>
		<td colspan="8">ตำแหน่ง ..................................................</td>
	</tr>
	<!-- ประโยคต้นคำร้อง -->
	<tr>
		<td colspan="20">
            ขออนุญาตใช้รถยนต์<?php echo $_SESSION['system_name']; ?> พร้อมพนักงานขับรถยนต์
		</td>
    </tr>
    <tr>
		<td colspan="20">
		สำหรับปฏิบัติราชการ...................................................................................................................................
		</td>
    </tr>
    <tr>
        <td colspan="20" style="text-align: justify;">
        เพื่อเดินทางไปที่ ........................................................................................................................................
        </td>
    </tr>
	<!-- รายชื่อคนไป -->
	<tr>
            <td colspan="4" style="vertical-align: text-top;">มีคนนั่ง ....... คน ดังนี้&nbsp;&nbsp;</td>
            <td colspan="8" style="vertical-align: text-top;">
                <?php
                for ($i=0; $i < 5; $i++) 
                { 
                   echo ($i+1).". .......................................................... <br>";
                }
                ?>
            </td>
            <td colspan="8" style="vertical-align: text-top;" align="right">
                <?php
                for ($i=5; $i < 10; $i++) 
                { 
                   echo ($i+1).". ........................................................ <br>";
                }
                ?>
            </td>
    </tr>
</tbody>
</table>

<table width="100%" border="0" align="center" cellpadding="0">
<tbody>
	<tr>
    <td colspan="20">
        ในวันที่ ..................................................................................... เวลา ........................................................
    </td>
    </tr>
    <tr>
    <td colspan="20">
        ถึงวันที่ ..................................................................................... เวลา ........................................................
    </td>
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
		<td width="93%"><p>............................</p></td>
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

<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<td width="100%">รถยนต์ หมายเลขทะเบียน ...........................................</td>
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

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td width="85%" align="right">
			(........................................)
		</td>
		<td width="5%"></td>
	</tr>
</tbody>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td width="85%" align="right">พนักงานขับรถยนต์&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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