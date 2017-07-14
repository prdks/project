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
    <!-- จองใช้เพื่อ -->
    <div class='form-group'>
      <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
        จองใช้เพื่อ :
      </label>
      <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
        <p>".$row['requirement_detail']."</p>
      </div>
    </div>
    <!-- รถยนต์ที่จอง -->
    <div class='form-group'>
      <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
        รถยนต์ที่จอง :
      </label>
      <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
        <p>".$row['car_reg']." / ยี่ห้อ ".$row['car_brand_name']." / รุ่น ".$row['car_kind']." / ".$row['seat']." ที่นั่ง</p>
      </div>
    </div>
    <!-- วันที่ใช้รถยนต์ -->
    <div class='form-group'>
      <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
        วันที่ใช้รถยนต์ :
      </label>
      <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
        <p>";
        if ($row['date_start'] === $row['date_end']) {
          echo DateThai($row['date_start'])." (วันที่ทำรายการ : ".DateTimeThai($row['timestamp'])."น. )";
        }else {
          echo DateThai($row['date_start'])." ถึง ".DateThai($row['date_end'])." ( วันที่ทำรายการ : ".DateTimeThai($row['timestamp'])."น. )";
        }
    echo"</p>
      </div>
    </div>
    <!-- รายชื่อผู้โดยสาร -->
    <div class='form-group'>
      <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
        รายชื่อผู้โดยสาร :
      </label>
      <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
      ";
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
          echo $rs['passenger_name']."<br />";
        }

      }
  echo"
      </div>
    </div>
    <!-- สถานที่จะไป -->
    <div class='form-group'>
      <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
        สถานที่จะไป :
      </label>
      <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
      ";
      $sql_province = "
      SELECT * FROM location l
      LEFT JOIN reservation r
      ON l.reservation_id = r.reservation_id
      WHERE r.reservation_id = ".$row['reservation_id']."
      GROUP BY province ORDER BY province ASC";
      $result = $conn->query($sql_province);
      while($r = $result->fetch_assoc()){
        echo "<b>จังหวัด".$r['province']."</b><br />";

        $sql_location ="
        SELECT * FROM location l
        LEFT JOIN reservation r
        ON l.reservation_id = r.reservation_id
        WHERE r.reservation_id = ".$row['reservation_id']."
        AND l.province = '".$r['province']."'
        ORDER BY location_name ASC";
        $res = $conn->query($sql_location);
        while($rs = $res->fetch_assoc()){
          echo "<p>".$rs['location_name']."</p>";
        }

      }
  echo"</div>
    </div>
    <!-- ให้รถไปรับที่ -->
    <div class='form-group'>
      <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
        จุดนัดพบ :
      </label>
      <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
      <p>".$row['appointment_place']."</p>
      </div>
    </div>
    <!-- ผู้ติดต่อ -->
    <div class='form-group'>
      <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
        ผู้ติดต่อ :
      </label>
      <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
        <p>".$row['title_name']." ".$row['personnel_name']."</p>
      </div>
    </div>
    <!-- เบอร์โทรศัพท์ -->
    <div class='form-group'>
      <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
        เบอร์โทรศัพท์ :
      </label>
      <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
        <p>".$row['phone_number']."</p>
      </div>
    </div>

    <ul class='nav nav-tabs span2 clearfix'></ul>
    <br />

    <!-- ผลการจอง -->
    <div class='form-group'>
      <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
        <span class='requestfield'>*</span> ผลการจอง :
      </label>
      <div class='col-lg-3 col-md-3 col-sm-3 col-xs-12'>
        <select name='status' class='form-control'>
          <option value='รออนุมัติ' selected>รออนุมัติ</option>
          <option value='อนุมัติ'>อนุมัติ</option>
          <option value='ไม่อนุมัติ'>ไม่อนุมัติ</option>
          <option value='ยกเลิก'>ยกเลิก</option>
        </select>
      </div>
    </div>
    <!-- หมายเหตุ -->
    <div class='form-group'>
      <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
        <span class='requestfield'>*</span> หมายเหตุการยกเลิก :
      </label>
      <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
      <textarea  rows='3' type='text' class='form-control' id='note_area' name='note'
      placeholder='พิมพ์หมายเหตุการยกเลิก' style='resize:none;'></textarea>
      </div>
    </div>
    ";
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
