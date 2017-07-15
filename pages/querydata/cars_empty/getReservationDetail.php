<?php
require '../../_connect.php';
$reservation_id = $_POST['reservation_id'];

$sql = "
SELECT * FROM reservation r
LEFT JOIN cars c
ON r.car_id = c.car_id
LEFT JOIN car_brand b
ON c.car_brand_id = b.car_brand_id
LEFT JOIN personnel p
ON r.personnel_id = p.personnel_id
LEFT JOIN title_name t
ON p.title_name_id = t.title_name_id
WHERE reservation_id = '".$reservation_id."'
ORDER BY date_start ASC , reserv_stime ASC";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
  echo "
  <table id='reservdetailtable' class='table table-bordered'>
    <!-- จองใช้เพื่อ -->
    <tr>
    <td class='col-lg-2 col-md-2 col-sm-2 col-xs-2 topic'>จองใช้เพื่อ :</td>
    <td>".$row['requirement_detail']."</td>
    </tr>
    <!-- รถยนต์ที่จอง -->
    <tr>
    <td class='field-label col-xs-3 topic'>รถยนต์ที่จอง :</td>
    <td>".$row['car_reg']." / ยี่ห้อ ".$row['car_brand_name']." / รุ่น ".$row['car_kind']." / ".$row['seat']." ที่นั่ง </td>
    </tr>
    <!-- วันที่ใช้รถยนต์ -->
    <tr>
    <td class='field-label col-xs-3 topic'>วันที่ใช้รถยนต์ :</td>
    <td>";
    if ($row['date_start'] === $row['date_end']) {
      echo DateThai($row['date_start'])." (วันที่ทำรายการ : ".DateTimeThai($row['timestamp'])."น. )";
    }else {
      echo DateThai($row['date_start'])." ถึง ".DateThai($row['date_end'])." ( วันที่ทำรายการ : ".DateTimeThai($row['timestamp'])."น. )";
    }
echo"</td>
    </tr>
    <!-- รายชื่อผู้โดยสาร -->
    <tr>
    <td class='field-label col-xs-3 topic'>รายชื่อผู้โดยสาร :</td>
    <td>";
    $sql_department = "
    SELECT d.* FROM department d
    LEFT JOIN passenger p
    ON p.department_id = d.department_id
    WHERE p.reservation_id = '".$row['reservation_id']."'
    GROUP BY department_name ORDER BY department_name ASC";
    $result = $conn->query($sql_department);
    while($r = $result->fetch_assoc()){
      echo "<b>".$r['department_name']."</b><br />";

      $sql_passenger ="
      SELECT * FROM passenger p
      LEFT JOIN department d
      ON p.department_id = d.department_id
      LEFT JOIN reservation r
      ON p.reservation_id = r.reservation_id
      WHERE p.department_id = '".$r['department_id']."'
      AND r.reservation_id = ".$row['reservation_id']."
      ORDER BY passenger_name ASC , department_name ASC";
      $res = $conn->query($sql_passenger);
      while($rs = $res->fetch_assoc()){
        echo "&nbsp;&nbsp;&nbsp;".$rs['passenger_name']."<br />";
      }

    }
echo"</td>
    </tr>
    <!-- สถานที่จะไป -->
    <tr>
    <td class='col-lg-2 col-md-2 col-sm-2 col-xs-2 topic'>สถานที่จะไป :</td>
    <td>";
    $sql_province = "
    SELECT * FROM location l
    LEFT JOIN reservation r
    ON l.reservation_id = r.reservation_id
    WHERE r.reservation_id = ".$row['reservation_id']."
    GROUP BY province ORDER BY province ASC";
    $result = $conn->query($sql_province);
    while($r = $result->fetch_assoc()){
      echo "จังหวัด".$r['province']."<br />";

      $sql_location ="
      SELECT * FROM location l
      LEFT JOIN reservation r
      ON l.reservation_id = r.reservation_id
      WHERE r.reservation_id = ".$row['reservation_id']."
      AND l.province = '".$r['province']."'
      ORDER BY location_name ASC";
      $res = $conn->query($sql_location);
      while($rs = $res->fetch_assoc()){
        echo "&nbsp;&nbsp;&nbsp;".$rs['location_name']."<br />";
      }

    }
echo"</td>
    </tr>
    <!-- ให้รถไปรับที่ -->
    <tr>
    <td class='col-lg-2 col-md-2 col-sm-2 col-xs-2 topic'>ให้รถไปรับที่ :</td>
    <td>";
    if($row['appointment_place'] == null){
      echo "ยังไม่กำหนด";
    }else {
      echo $row['appointment_place'];
    }
echo"</td>
    </tr>
    <!-- ผู้ติดต่อ -->
    <tr>
    <td class='col-lg-2 col-md-2 col-sm-2 col-xs-2 topic'>ผู้ติดต่อ :</td>
    <td>".$row['title_name'].$row['personnel_name']." &nbsp;&nbsp;&nbsp;<b>เบอร์โทรศัพท์</b> ".$row['phone_number']."</td>
    </tr>
    <!-- empty -->
    <tr>
    <td class='col-lg-2 col-md-2 col-sm-2 col-xs-2 topic' colspan='2'></td>
    </tr>
    <!-- ผลการจอง -->
    <tr>
    <td class='col-lg-2 col-md-2 col-sm-2 col-xs-2 topic'>ผลการจอง :</td>
    <td>";
    if ($row['reservation_status'] === 'รออนุมัติ') {
      echo "<span class='label label-primary'>รออนุมัติ</span>";
    }elseif ($row['reservation_status'] === 'อนุมัติ') {
      echo "<span class='label label-success'>อนุมัติ</span>";
    }elseif ($row['reservation_status'] === 'ยกเลิก') {
      echo "<span class='label label-danger'>ยกเลิก</span>";
    }
echo" &nbsp;&nbsp;&nbsp;<b>บันทึกโดย</b> ";
    if($row['first_approver_id'] == null){
      echo "-";
    }else {
      $sql_province = "
      SELECT * FROM personnel p
      LEFT JOIN reservation r
      ON r.first_approver_id = p.personnel_id
      LEFT JOIN title_name t
      ON p.title_name_id = t.title_name_id
      WHERE r.first_approver_id = '".$row['first_approver_id']."'";
      $result = $conn->query($sql_province);
      while($r = $result->fetch_assoc()){
        echo $r['title_name'].$r['personnel_name'];
      }
    }
echo" &nbsp;&nbsp;&nbsp;<b>วันที่บันทึกผล</b> ";
  if ($row['update_status_date'] == null) {
    echo "-";
  }else {
    echo $row['update_status_date'];
  }
echo"
    </td>
    </tr>
    <!-- พนักงานขับรถยนต์ -->
    <tr>
    <td class='col-lg-2 col-md-2 col-sm-2 col-xs-2 topic'>พนักงานขับรถยนต์ :</td>
    <td>";
    $sql_province = "
    SELECT * FROM cars c
    LEFT JOIN personnel p
    ON c.personnel_id = p.personnel_id
    LEFT JOIN title_name t
    ON p.title_name_id = t.title_name_id
    WHERE c.car_id = '".$row['car_id']."'";
    $result = $conn->query($sql_province);
    while($r = $result->fetch_assoc()){
      echo $r['title_name'].$r['personnel_name']." &nbsp;&nbsp;&nbsp;<b>เบอร์โทรศัพท์</b> ".$r['phone_number'];
    }
echo"</td>
    </tr>
  </table>";
}

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

  function DateTimeThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, เวลา : $strHour:$strMinute";
	}
?>
