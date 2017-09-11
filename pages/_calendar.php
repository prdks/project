<?php
require("_connect.php");

// --------------------------------------------------------------------------
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
      $strYear = date("Y",strtotime($strDate))+543;
      $strMonth= date("n",strtotime($strDate));
      $strDay= date("j",strtotime($strDate));
      $strHour= date("H",strtotime($strDate));
      $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
      $strMonthThai=$strMonthCut[$strMonth];
      return "วันที่ $strDay $strMonthThai พ.ศ. $strYear";
  }
  function DateTimeThai($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, เวลา : $strHour:$strMinute"."น.";
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
    return "$strHour:$strMinute"."น.";
  }
// --------------------------------------------------------------------------

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
    WHERE date_start >= '".$_GET['start']."'
    AND date_end <= '".$_GET['end']."'
    ORDER BY reservation_id";

    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc())
    {
      $id = $row['reservation_id']; //ไอดีการจอง
      $title = TimeThai($row['reserv_stime'])."(".$row['car_brand_name']." ".$row['seat']." ที่นั่ง) - ".$row['requirement_detail']; //title
      $detail = $row['requirement_detail']; //รายละเอียดการจอง
      $location = $row['location']; //สถานที่

      /*การจัดการวันที่จอง*/
      $start = $row['date_start']; //วันแรกที่จองใช้รถ
      $end = $row['date_end']; //วันสุดท้ายที่จองใช้รถ
      $timestart = $row['reserv_stime']; //ช่วงเวลาเริ่ม
      $timeend = $row['reserv_etime']; //ช่วงเวลาสิ้นสุด
      if ($row['date_start'] === $row['date_end']) {
        $reservation_date = DateThai($row['date_start'])." เวลา ".TimeThai($row['reserv_stime'])." - ".TimeThai($row['reserv_etime']);
      }else {
        $reservation_date = DateThai($row['date_start'])."เวลา ".TimeThai($row['reserv_stime'])." ถึง ".DateThai($row['date_end'])." เวลา ".TimeThai($row['reserv_etime']);
      }
      if ($start !== $end) {$allday = true;}
      else {$allday = false;}

      /*สถานที่นัดหมาย*/
      if ($row['appointment_place'] == null) {$appointment = 'ยังไม่กำหนด';}
      else {$appointment = $row['appointment_place'];}

      /*สถานะการจอง*/
      if ($row['reservation_status'] == 0) {$rstatus = '<span class="label label-md label-primary">รออนุมัติ</span>'; $colorRStatus = '#428bca';}
      elseif ($row['reservation_status'] == 1) {$rstatus = '<span class="label label-md label-success">อนุมัติ</span>'; $colorRStatus = '#5cb85c';}
      elseif ($row['reservation_status'] == 2) {$rstatus = '<span class="label label-md label-danger">ไม่อนุมัติ</span>'; $colorRStatus = '#d9534f';}
      elseif ($row['reservation_status'] == 3) {$rstatus = '<span class="label label-md label-danger">ยกเลิก</span>'; $colorRStatus = '#d9534f';}

      /*สถานะการใช้*/
      if ($row['usage_status'] == 0) {$ustatus = 'รออนุมัติ';}
      elseif ($row['usage_status'] == 1) {$ustatus = 'กำลังดำเนินการ';}
      elseif ($row['usage_status'] == 2) {$ustatus = 'ดำเนินการเสร็จสิ้น';}
      elseif ($row['usage_status'] == 3) {$ustatus = 'ยกเลิก'; $colorRStatus = '#d9534f';}

      /*่หมายเหตุการยกเลิก*/
      if ($row['reserve_note'] !== '') {$note = str_replace(",",", ",$row['reserve_note']);}
      else {$note = '-';}
      $timestamp = DateTimeThai($row['timestamp']); //วันที่ทำรายการ

      /*ข้อมูลคนทำรายการ*/
      $person = $row['title_name'].$row['personnel_name']; //ชื่อคนทำรายการ
      $tel = $row['phone_number']; //เบอร์โทรศัพท์


      /*ข้อมูลรถยนต์ที่จอง*/
      $car_reg = $row['car_reg']; //เลขทะเบียน
      $car_brand = $row['car_brand_name']; //ยี่ห้อรถยนต์
      $car_kind = $row['car_kind']; //รุ่นรถยนต์
      $seat = $row['seat']; //จำนวนที่นั่ง

      /*ผู้โดยสาร*/
      $passenger = array();
      $sql_department = "
      SELECT d.* FROM department d
      LEFT JOIN passenger p
      ON p.department_id = d.department_id
      WHERE p.reservation_id = '".$row['reservation_id']."'
      GROUP BY department_name ORDER BY department_name ASC";
      $a = $conn->query($sql_department);
      while($b = $a->fetch_assoc()){
        $str = "<dt><b>".$b['department_name']."</b></dt>";
        array_push($passenger,$str);

        $sql_passenger ="
        SELECT * FROM passenger p
        LEFT JOIN department d
        ON p.department_id = d.department_id
        LEFT JOIN reservation r
        ON p.reservation_id = r.reservation_id
        WHERE p.department_id = '".$b['department_id']."'
        AND r.reservation_id = ".$row['reservation_id']."
        ORDER BY passenger_name ASC , department_name ASC";
        $c = $conn->query($sql_passenger);
        while($d = $c->fetch_assoc()){
          $str = "<dd>".$d['passenger_name']."</dd>";
          array_push($passenger,$str);
        }
      }

      /*คนอนุมัติคนสุดท้าย(จนท.ดูแลรถยนต์)*/
      if ($row['second_approver_id'] != null)
      {
          $sql_approve = "
          SELECT * FROM personnel p
          LEFT JOIN reservation r
          ON r.second_approver_id = p.personnel_id
          LEFT JOIN title_name t
          ON p.title_name_id = t.title_name_id
          WHERE r.second_approver_id = '".$row['second_approver_id']."'";
          $e = $conn->query($sql_approve);
          $g = $e->fetch_assoc();
          $person_approve = $g['title_name'].$g['personnel_name'];
          $tel_approve = $g['phone_number'];
          $updateStatus = DateThai($row['update_status_date']); //วันที่แก้ไขล่าสุด

      }else {$person_approve = '-'; $tel_approve = '-'; $updateStatus = '-';}


      /*คนขับรถยนต์*/
      $sql_driver = "
      SELECT * FROM cars c
      LEFT JOIN personnel p
      ON c.personnel_id = p.personnel_id
      LEFT JOIN title_name t
      ON p.title_name_id = t.title_name_id
      WHERE c.car_id =".$row['car_id'];
      $res = $conn->query($sql_driver);
      $r = $res->fetch_assoc();
      $name_driver = $r['title_name'].$r['personnel_name'];
      $tel_driver = $r['phone_number'];

      $json_data[] = array(
              'title'=> $title,
              'start'=> $start." ".$timestart,
              'end'=> $end." ".$timeend,
              'textColor' => '#fff',
              'color' => $colorRStatus,
              'className' => 'ch-font',
              'allDay' => false,

              'detail' => $detail,
              'car_reg' => $car_reg,
              'car_brand' => $car_brand,
              'car_kind' => $car_kind,
              'seat' => $seat,
              'reservation_date' => $reservation_date,
              'time_start' => $timestart,
              'time_end' => $timeend,
              'timestamp' => $timestamp,
              'passenger' => $passenger,
              'location' => $location,
              'appointment' => $appointment,
              'person' => $person,
              'tel' => $tel,
              'rstatus' => $rstatus,
              'person_approve' => $person_approve,
              'tel_approve' => $tel_approve,
              'reserve_note' => $note,
              'updateStatus' => $updateStatus,
              'name_driver' => $name_driver,
              'tel_driver' => $tel_driver,
      );

    }

$json= json_encode($json_data);
if(isset($_GET['callback']) && $_GET['callback']!=""){
echo $_GET['callback']."(".$json.");";
}else{
echo $json;
}
?>
