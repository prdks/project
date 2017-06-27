<?php
require_once '../_connect.php';
$mode = $_POST['mode'];

if ($mode == 'getDetail_approve')
{
  $reservation_id = $_POST['id'];

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
  WHERE reservation_id = '".$reservation_id."'";

  $result = $conn->query($sql);

  $row = $result->fetch_assoc();

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
      return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
    }

  $date;
  if ($row['date_start'] === $row['date_end']) {
     $date = DateThai($row['date_start'])." (วันที่ทำรายการ : ".DateTimeThai($row['timestamp'])."น. )";
  }else {
    $date = DateThai($row['date_start'])." ถึง ".DateThai($row['date_end'])." ( วันที่ทำรายการ : ".DateTimeThai($row['timestamp'])."น. )";
  }

  $reserv = array(
            'detail' => $row['requirement_detail'],
            'cars' => $row['car_reg']." / ยี่ห้อ ".$row['car_brand_name']." / รุ่น ".$row['car_kind']." / ".$row['seat'],
            'date' => $date,
            'meet' => $row['appointment_place'],
            'person' => $row['title_name']." ".$row['personnel_name'],
            'phone' => $row['phone_number']
          );

$passenger = array();
$sql_department = "
SELECT d.* FROM department d
LEFT JOIN passenger p
ON p.department_id = d.department_id
WHERE p.reservation_id = '".$reservation_id."'
GROUP BY department_name ORDER BY department_name ASC";
$result = $conn->query($sql_department);
while($r = $result->fetch_assoc()){

  $str = "<b>".$r['department_name']."</b><br />";
  array_push($passenger,$str);

  $sql_passenger ="
  SELECT * FROM passenger p
  LEFT JOIN department d
  ON p.department_id = d.department_id
  LEFT JOIN reservation r
  ON p.reservation_id = r.reservation_id
  WHERE p.department_id = '".$r['department_id']."'
  AND r.reservation_id = ".$reservation_id."
  ORDER BY passenger_name ASC , department_name ASC";
  $res = $conn->query($sql_passenger);
  while($rs = $res->fetch_assoc()){

    $str = $rs['passenger_name']."<br />";
    array_push($passenger,$str);

  }

}

$location = array();
$sql_province = "
SELECT * FROM location l
LEFT JOIN reservation r
ON l.reservation_id = r.reservation_id
WHERE r.reservation_id = ".$reservation_id."
GROUP BY province ORDER BY province ASC";
$result = $conn->query($sql_province);
while($r = $result->fetch_assoc()){

  $str = "<b>จังหวัด".$r['province']."</b><br />";
  array_push($location,$str);

  $sql_location ="
  SELECT * FROM location l
  LEFT JOIN reservation r
  ON l.reservation_id = r.reservation_id
  WHERE r.reservation_id = ".$reservation_id."
  AND l.province = '".$r['province']."'
  ORDER BY location_name ASC";
  $res = $conn->query($sql_location);
  while($rs = $res->fetch_assoc()){

    $str = $rs['location_name']."<br />";
    array_push($location,$str);

  }

}

  $all = array(
              'reserv_detail' => $reserv ,
              'passenger' => $passenger,
              'location' => $location ,
              'status' => $row['reservation_status'],
              'note' => $row['note']
            );
  echo json_encode($all);



}


?>
