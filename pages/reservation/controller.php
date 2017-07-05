<?php
require_once '../_connect.php';
$mode = $_POST['mode'];
// -------------------------------------------------------------
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
// -------------------------------------------------------------

if ($mode == 'getDetail')
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

  $date;
  if ($row['date_start'] === $row['date_end']) {
     $date = DateThai($row['date_start'])." (วันที่ทำรายการ : ".DateTimeThai($row['timestamp'])."น. )";
  }else {
    $date = DateThai($row['date_start'])." ถึง ".DateThai($row['date_end'])." ( วันที่ทำรายการ : ".DateTimeThai($row['timestamp'])."น. )";
  }

  $reserv = array(
            'detail' => $row['requirement_detail'],
            'cars' => $row['car_reg']." / ยี่ห้อ ".$row['car_brand_name']." / รุ่น ".$row['car_kind']." / ".$row['seat'] ." ที่นั่ง",
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
elseif ($mode == 'getDelete')
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

  $date;
  if ($row['date_start'] === $row['date_end']) {
     $date = DateThai($row['date_start']);
  }else {
    $date = DateThai($row['date_start'])." ถึง ".DateThai($row['date_end']);
  }

  $str = 'รายการจองใช้รถยนต์ ทะเบียน: '.$row['car_reg'].' <br />วันที่ '.$date;

  $all = array(
              'id' => $row['reservation_id'] ,
              'detail' => $str
            );
  echo json_encode($all);



}
elseif ($mode == 'getCars_For_Select')
{
  $department = $_POST['user_department'];
  $date_start = $_POST['date_start'];
  $date_end = $_POST['date_end'];
  $time_start = $_POST['time_start'];
  $time_end = $_POST['time_end'];

  $sql = "
  SELECT c.* , b.* , p.* , t.* , d.* FROM cars c
  LEFT JOIN reservation r
  ON r.car_id = c.car_id
  LEFT OUTER JOIN car_brand b
  ON c.car_brand_id = b.car_brand_id
  LEFT OUTER JOIN personnel p
  ON c.personnel_id = p.personnel_id
  LEFT OUTER JOIN title_name t
  ON p.title_name_id = t.title_name_id
  LEFT OUTER JOIN department d
  ON p.department_id = d.department_id
  WHERE c.car_id NOT IN (
     SELECT car_id FROM reservation r
    WHERE (date_start BETWEEN '".$date_start."' AND '".$date_end."')
    OR (date_end BETWEEN '".$date_start."' AND '".$date_end."')
    OR ((reserv_stime BETWEEN '".strtotime ($time_start)."' AND '".strtotime ($time_end)."')
    OR (reserv_etime BETWEEN '".strtotime ($time_start)."' AND '".strtotime ($time_end)."'))
    )
    AND department_name = '".$department."'
    AND c.status <> 'งดจอง'
  GROUP BY car_reg";

  $result = $conn->query($sql);
  $result_row = mysqli_num_rows($result);
  if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
  {
    while($row = $result->fetch_assoc())
    {
      echo "
      <tr>
      <td>
      <center>
      <input type='radio' id='selecter_cars' name='selecter_cars'
      class='selecter_cars' value='".$row['car_id']."'/>
      </center>
      </td>
      <td class='text-center'>".$row['car_reg']."</td>
      <td class='text-left'>".$row['car_brand_name']."</td>
      <td class='text-left'>".$row['car_kind']."</td>
      <td class='text-center'>".$row['seat']."</td>
      <td class='text-left'>".$row['title_name']." ".$row['personnel_name']."</td>
      <td class='text-left'>".$row['department_name']."</td>
      </tr>
      ";
    }
  }else {
    echo "<tr><td colspan='7'>ไม่มีข้อมูลรถยนต์ว่าง</td></tr>";
  }

  }
  elseif ($mode == 'getDetail_For_Submit')
  {
  $data = $_POST['data'];
  $selecter_cars = $_POST['checked'];
  $LocationData = $_POST['LocationData'];

  $sql="SELECT c.* , b.* , p.* , t.* FROM cars c
  LEFT JOIN reservation r
  ON r.car_id = c.car_id
  LEFT OUTER JOIN car_brand b
  ON c.car_brand_id = b.car_brand_id
  LEFT OUTER JOIN personnel p
  ON c.personnel_id = p.personnel_id
  LEFT OUTER JOIN title_name t
  ON p.title_name_id = t.title_name_id
  LEFT OUTER JOIN department d
  ON p.department_id = d.department_id
  WHERE c.car_id ='".$selecter_cars[0]['Car_id']."'";

  $result = $conn->query($sql);
  $result_row = mysqli_num_rows($result);
  if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
  {
    $row = $result->fetch_assoc();
    $cars = "<p>".$row['car_reg']." / ยี่ห้อ ".$row['car_brand_name']." / รุ่น ".$row['car_kind']." / ".$row['seat']." ที่นั่ง</p>";
  }


  $location = array();
  for ($i=0; $i < sizeof($LocationData); $i++)
  {
      if ($i != 0) {
          if ($LocationData[$i]['Province'] === $LocationData[$i-1]['Province'])
          {
              $str = $LocationData[$i]['LocationName']."<br />";
              array_push($location,$str);
          }
          else
          {
              $str = "<b>".$LocationData[$i]['Province']."</b><br />";
              array_push($location,$str);
              $str = $LocationData[$i]['LocationName']."<br />";
              array_push($location,$str);
          }
      }
      else
      {
          $str = "<b>".$LocationData[$i]['Province']."</b><br />";
          array_push($location,$str);
          $str = $LocationData[$i]['LocationName']."<br />";
          array_push($location,$str);
      }

  }

  $passenger = array();
  if(!isset($_POST['PassengerData'])){
    array_push($passenger,"ไม่มีผู้โดยสารเพิ่มเติม");
  }else {
    $PassengerData = $_POST['PassengerData'];
    for ($i=0; $i < sizeof($PassengerData); $i++)
    {
        if ($i != 0) {

            if ($PassengerData[$i]['Department'] === $PassengerData[$i-1]['Department'])
            {
                $str = $PassengerData[$i]['Name']."<br />";
                array_push($passenger,$str);
            }
            else
            {
                $str = "<b>".$PassengerData[$i]['Department']."</b><br />";
                array_push($passenger,$str);
                $str = $PassengerData[$i]['Name']."<br />";
                array_push($passenger,$str);
            }

        }
        else
        {
            $str = "<b>".$PassengerData[$i]['Department']."</b><br />";
            array_push($passenger,$str);
            $str = $PassengerData[$i]['Name']."<br />";
            array_push($passenger,$str);
        }
    }
  }

  $arr = array(
        'user' => $data[0]['value'],
        'position' => $data[1]['value'],
        'detail' => $data[2]['value'],
        'fistdate' => DateThai($data[3]['value']),
        'lastdate' => DateThai($data[4]['value']),
        'time' => "ตั้งแต่เวลา ".$data[5]['value']." น. ถึง ".$data[6]['value']." น.",
        'cars' => $cars,
        'location' => $location,
        'passenger' => $passenger,
        'department' => $data[7]['value']
      );

  echo json_encode($arr);
}
elseif ($mode == 'getEdit')
{
  $reservation_id = $_POST['id'];

  $sql = "
  SELECT * FROM reservation r
  LEFT JOIN personnel p
  ON r.personnel_id = p.personnel_id
  LEFT JOIN position po
  ON p.position_id = po.position_id
  LEFT JOIN title_name t
  ON p.title_name_id = t.title_name_id
  WHERE reservation_id = '".$reservation_id."'";

  $result = $conn->query($sql);

  $row = $result->fetch_assoc();

  $reserv = array(
            'id' => $row['reservation_id'],
            'user' => $row['title_name'].' '.$row['personnel_name'],
            'position' => $row['position_name'],
            'detail' => $row['requirement_detail'],
            'fistdate' => $row['date_start'],
            'lastdate' => $row['date_end'],
            'timestart' => $row['reserv_stime'],
            'timeend' => $row['reserv_etime']
          );

  echo json_encode($reserv);
}
elseif ($mode == 'get_location')
{
  $id = $_POST['id'];

  $sql = "
  SELECT * FROM location
  WHERE location_id = ".$id;

  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  $arr = array(
            'reserve_id' => $row['reservation_id'],
            'id' => $row['location_id'],
            'province' => $row['province'],
            'location_name' => $row['location_name']
          );

  echo json_encode($arr);

}
?>
