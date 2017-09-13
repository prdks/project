<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
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
            'location' => $row['location'],
            'cars' => $row['car_reg']." / ยี่ห้อ ".$row['car_brand_name']." / รุ่น ".$row['car_kind']." / ".$row['seat'] ." ที่นั่ง",
            'date' => $date,
            'meet' => $row['appointment_place'],
            'person' => $row['title_name'].$row['personnel_name'],
            'phone' => $row['phone_number'],
            'first_app' => $row['first_approver_id'],
            'first_status' => $row['fist_approve_status'],
            'first_reason' => substr($row['fist_approve_note'], 0, strpos($row['fist_approve_note'], ',')),
            'first_note' => substr($row['fist_approve_note'], (strpos($row['fist_approve_note'], ',')+1), strlen($row['fist_approve_note'])),
            'second_app' => $row['second_approver_id']
          );

$passenger = array();
$sql_department = "
SELECT d.* FROM department d
LEFT JOIN passenger p
ON p.department_id = d.department_id
WHERE p.reservation_id = '".$reservation_id."'
GROUP BY department_name ORDER BY department_name ASC";
$result = $conn->query($sql_department);
$result_row = mysqli_num_rows($result);
if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
{
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
  $all = array(
              'reserv_detail' => $reserv ,
              'passenger' => $passenger,
              'status' => $row['reservation_status'],
              'note' => $row['reserve_note']
            );
}
else
{
  $all = array(
              'reserv_detail' => $reserv ,
              'passenger' => '',
              'status' => $row['reservation_status'],
              'note' => $row['reserve_note']
            );
}



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
    WHERE 
      ((date_start BETWEEN '".$date_start."' AND '".$date_end."')
      OR 
      (date_end BETWEEN '".$date_start."' AND '".$date_end."')
      OR 
       ('".$date_start."' BETWEEN date_start  AND date_end)
      OR 
       ('".$date_end."' BETWEEN  date_start  AND date_end ))
      AND 
      ((reserv_stime BETWEEN '".$time_start."' AND '".$time_end."')
      OR 
      (reserv_etime BETWEEN '".$time_start."' AND '".$time_end."')
      OR 
       ('".$time_start."' BETWEEN reserv_stime  AND reserv_etime)
      OR 
       ('".$time_end."' BETWEEN  reserv_stime  AND reserv_etime ))
    )
  AND c.status <> 'งดจอง'
  GROUP BY car_reg
  ORDER BY car_reg";

  $result = $conn->query($sql);
  $result_row = mysqli_num_rows($result);
  $data = array();
  if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
  {
    while ($row = $result->fetch_assoc())
    {
      $all = array(
                  'id' => $row['car_id'],
                  'reg' => $row['car_reg'],
                  'brand' => $row['car_brand_name'],
                  'kind' => $row['car_kind'],
                  'seat' => $row['seat'],
                  'driver' => $row['title_name'].$row['personnel_name'],
                  'department' => $row['department_name']
                );
      array_push($data,$all);
    }

  }
  else
  {
    array_push($data,array('id' => false));

  }
  echo json_encode($data);
}
elseif ($mode == 'getPersonnel_For_AddPassenger')
{
  $user = $_POST['user_name'];


  if (!isset($_POST['passenger_name']))
  {
    $sql = "
    SELECT t.*, p.*, po.* , d.* FROM personnel p
    LEFT OUTER JOIN user_type us
    ON p.user_type_id = us.user_type_id
    LEFT JOIN title_name t
    ON p.title_name_id = t.title_name_id
    LEFT JOIN position po
    ON p.position_id = po.position_id
    LEFT JOIN department d
    ON p.department_id = d.department_id
    WHERE personnel_name <> '".$user."'
    AND us.user_level <> 2
    ORDER BY department_name ASC";
  }
  else
  {
    $passenger = $_POST['passenger_name'];
    $n = sizeof($passenger);

    if ($n == 1)
    {
      $sql = "
      SELECT t.*, p.*, po.* , d.* FROM personnel p
      LEFT JOIN title_name t
      ON p.title_name_id = t.title_name_id
      LEFT JOIN position po
      ON p.position_id = po.position_id
      LEFT JOIN department d
      ON p.department_id = d.department_id
      WHERE personnel_name <> '".$user."'
      AND
      personnel_id NOT IN (
        SELECT personnel_id FROM personnel
        WHERE personnel_name LIKE '%".$passenger[0]['Name']."%'
        )
      ORDER BY department_name ASC";

    }
    if ($n > 1)
    {
      $sql = "
      SELECT t.*, p.*, po.* , d.* FROM personnel p
      LEFT JOIN title_name t
      ON p.title_name_id = t.title_name_id
      LEFT JOIN position po
      ON p.position_id = po.position_id
      LEFT JOIN department d
      ON p.department_id = d.department_id
      WHERE personnel_name <> '".$user."'
      AND
      personnel_id NOT IN (
        SELECT personnel_id FROM personnel
        WHERE personnel_name LIKE '%".$passenger[0]['Name']."%'";
        $str = '';
        for ($i=1; $i < $n; $i++) {
          $str .= " OR personnel_name LIKE '%".$passenger[$i]['Name']."%'";
        }
      $sql .= $str;
      $sql .= ")ORDER BY department_name ASC";
    }
  }

  $result = $conn->query($sql);
  $result_row = mysqli_num_rows($result);
  $data = array();
  if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
  {
    while ($row = $result->fetch_assoc())
    {
      $all = array(
                  'id' => $row['personnel_id'],
                  'title' => $row['title_name'],
                  'name' => $row['personnel_name'],
                  'department' => $row['department_name']
                );
      array_push($data,$all);
    }

  }
  else
  {
    array_push($data,array('id' => false));

  }
  echo json_encode($data);
}
elseif ($mode == 'getDetail_For_Submit')
{

  $user_name = $_POST['user_name'];
  $user_position = $_POST['user_position'];
  $detail = $_POST['detail'];

  $appointment = $_POST['appoinment'];
  $date_start = $_POST['date_start'];
  $date_end = $_POST['date_end'];
  $time_start = $_POST['time_start'];
  $time_end = $_POST['time_end'];
  $user_department = $_POST['user_department'];

  $car_id = $_POST['Car_id'];

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
  WHERE c.car_id ='".$car_id."'";

  $result = $conn->query($sql);
  $result_row = mysqli_num_rows($result);
  if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
  {
    $row = $result->fetch_assoc();
    $cars = "<p>".$row['car_reg']." / ยี่ห้อ ".$row['car_brand_name']." / รุ่น ".$row['car_kind']." / ".$row['seat']." ที่นั่ง</p>";
  }

  if ($date_start !== $date_end)
  {
    $date = DateThai($date_start)." ถึง ".DateThai($date_end);
  }
  else
  {
    $date = DateThai($date_start);
  }

  $location_name = $_POST['location'];
  $location = "";
  $countlocation = sizeof($location_name);
  for ($i=0; $i < $countlocation ; $i++)
  {
    if($countlocation == 1)
    {
      $str = $location_name[$i];
      $location .= $str;
    }
    else
    {
      $str = ($i+1).". ".$location_name[$i]."<br />";
      $location .= $str;
    }
    
  }


  $allPassenger = "";
  if(!isset($_POST['passenger_name']))
  {
    $allPassenger = "ไม่มีผู้โดยสารเพิ่มเติม";
  }
  else 
  {
    $passener_name = $_POST['passenger_name'];
    $passenger_department = $_POST['passenger_department'];

    $coutPassenger = sizeof($passener_name);
    $allPassenger = array();
    $arrDepartment = array();
    $arrName = array();
    $onePassenger = array();
    $passenger = "";

    for ($i=0; $i < $coutPassenger ; $i++)
    {
      $arrDepartment[$i] = "<b>".$passenger_department[$i]."</b><br>";
      $arrName[$i] = $passener_name[$i]."<br />";
    }

    $coutInDepartment = array_count_values(array_values($arrDepartment));
    $nameDepartment = array_values(array_unique($arrDepartment));

    sort($nameDepartment);

    $count = 0;

    for ($a=0; $a < sizeof($nameDepartment); $a++) 
    { 
      $name = $nameDepartment[$a];
      $n = $coutInDepartment[$name];
      array_push($allPassenger, $name);

      $person = array();
      for ($b=0; $b < $n ; $b++) 
      { 
        array_push($person, $arrName[$count]);
        $count++;
      }
      sort($person);

      for ($c=0; $c < sizeof($person); $c++) 
      { 
        array_push($allPassenger, $person[$c]);
      }

    }

  }

  $arr = array(
        'user' => $user_name,
        'position' => $user_position,
        'detail' => $detail,
        'date' => $date,
        'time' => "ตั้งแต่เวลา ".$time_start." น. ถึง ".$time_end." น.",
        'cars' => $cars,
        'location' => $location,
        'appointment' => $appointment,
        'passenger' => $allPassenger,
        'department' => $user_department
      );

  echo json_encode($arr);
}
elseif ($mode == 'insertReservation')
{

  $reserv_status = '0';
  $usage_status = '0';
  $timestamp = date("Y-m-d H:i:s");
  // -----------------------------------------------
  $user_name = $_POST['user_name'];
  $user_position = $_POST['user_position'];
  $detail = $_POST['detail'];
  $appointment = $_POST['appoinment'];
  $date_start = $_POST['date_start'];
  $date_end = $_POST['date_end'];
  $time_start = $_POST['time_start'];
  $time_end = $_POST['time_end'];
  $user_department = $_POST['user_department'];
  $car_id = $_POST['Car_id'];

  $location_name = $_POST['location'];
  $location = implode(",",$location_name);

  if (isset($_POST['passenger_name']))
  {
    // INSERT RESERVAION detail
    $sql_reserv = "
    INSERT INTO reservation (requirement_detail,date_start,date_end,reserv_stime,reserv_etime
    ,passenger_total,reservation_status,usage_status,timestamp,personnel_id,car_id,location,appointment_place,fist_approve_status)
    VALUES('".$detail."','".$date_start."','".$date_end."','".$time_start."','".$time_end."'
    ,".sizeof($_POST['passenger_name']).",'".$reserv_status."','".$usage_status."','".$timestamp."'
    ,(SELECT personnel_id FROM personnel WHERE personnel_name ='".$_SESSION['user_name']."')
    ,'".$car_id."','".$location."','".$appointment."',0) ON DUPLICATE KEY UPDATE reservation_id = reservation_id";
  }
  else
  {
    // INSERT RESERVAION detail
    $sql_reserv = "
    INSERT INTO reservation (requirement_detail,date_start,date_end,reserv_stime,reserv_etime
    ,passenger_total,reservation_status,usage_status,timestamp,personnel_id,car_id,location,appointment_place,fist_approve_status)
    VALUES('".$detail."','".$date_start."','".$date_end."','".$time_start."','".$time_end."'
    ,0,'".$reserv_status."','".$usage_status."','".$timestamp."'
    ,(SELECT personnel_id FROM personnel WHERE personnel_name ='".$_SESSION['user_name']."')
    ,'".$car_id."','".$location."','".$appointment."',0) ON DUPLICATE KEY UPDATE reservation_id = reservation_id";
  }



  if($conn->query($sql_reserv)===true)
  {

    if (isset($_POST['passenger_name']))
    {
      $passener_name = $_POST['passenger_name'];
      $passenger_department = $_POST['passenger_department'];
        // INSERT PASSENGER
        for ($i=0; $i < sizeof($passener_name); $i++)
        {
          $sql_passenger = "
          INSERT INTO passenger (passenger_name,department_id,reservation_id)
          VALUES('".$passener_name[$i]."'
          ,(SELECT department_id FROM department WHERE department_name = '".$passenger_department[$i]."')
          ,(SELECT reservation_id FROM reservation WHERE timestamp = '".$timestamp."'))
          ON DUPLICATE KEY UPDATE passenger_id = passenger_id
          ";
          $result = $conn->query($sql_passenger);
      }
      echo json_encode(array('result' => '1'));
    }
    else
    {
      echo json_encode(array('result' => '1'));
    }

  }
  else {echo json_encode(array('result' => '0'));}

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
            'user' => $row['title_name'].$row['personnel_name'],
            'position' => $row['position_name'],
            'detail' => $row['requirement_detail'],
            'fistdate' => $row['date_start'],
            'lastdate' => $row['date_end'],
            'timestart' => $row['reserv_stime'],
            'timeend' => $row['reserv_etime']
          );

  echo json_encode($reserv);
}
elseif ($mode == 'insertSelectPassenger')
{
  $person_id = $_POST['person_id'];
  $reserve_id = $_POST['reserve_id'];

  $sql = "insert into passenger (passenger_name,department_id,reservation_id) values
  ((SELECT CONCAT(t.title_name, ' ', p.personnel_name) as passenger_name FROM personnel p
    LEFT JOIN title_name t
    ON p.title_name_id = t.title_name_id
    WHERE p.personnel_id = ".$person_id.")
  ,(SELECT d.department_id FROM personnel p
    LEFT JOIN department d
    ON p.department_id = d.department_id
    WHERE p.personnel_id = ".$person_id.")
  ,".$reserve_id.")
  ON DUPLICATE KEY UPDATE passenger_id = passenger_id";

  if($conn->query($sql)===true){
    $sql = "SELECT COUNT(passenger_id) as total FROM passenger WHERE reservation_id = '".$reserve_id."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $sql = "
    update reservation
    set passenger_total = '".$row['total']."'
    where reservation_id = '".$reserve_id."'";
    $conn->query($sql);

    echo json_encode(array('result' => '1'));
  }
  else {echo json_encode(array('result' => '0'));}

}
elseif ($mode == 'get_passenger')
{
  $id = $_POST['id'];

  $sql = "
  SELECT *, SUBSTRING_INDEX(passenger_name,' ',-2) as name
  , SUBSTRING_INDEX(passenger_name,' ',1) as title FROM passenger p
  LEFT JOIN department d
  ON p.department_id = d.department_id
  WHERE passenger_id = ".$id;

  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  $arr = array(
            'reserve_id' => $row['reservation_id'],
            'id' => $row['passenger_id'],
            'title' => $row['title'],
            'name' => $row['name'],
            'department' => $row['department_name']
          );

  echo json_encode($arr);
}
elseif ($mode == 'editSelectPassenger')
{
  $old = $_POST['old'];
  $person_id = $_POST['person_id'];
  $reserve_id = $_POST['reserve_id'];

  $sql = "update passenger
  set
  passenger_name =
  (SELECT CONCAT(t.title_name, ' ', p.personnel_name) as passenger_name FROM personnel p
    LEFT JOIN title_name t
    ON p.title_name_id = t.title_name_id
    WHERE p.personnel_id = ".$person_id.")
  ,department_id =
  (SELECT d.department_id FROM personnel p
    LEFT JOIN department d
    ON p.department_id = d.department_id
    WHERE p.personnel_id = ".$person_id.")
  ,reservation_id = '".$reserve_id."'
  where passenger_id = '".$old."'";

  if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
  else {echo json_encode(array('result' => '0'));}

}
elseif ($mode == 'getCars_For_Edit')
{
  $id = $_POST['car_id'];
  $reserve_id = $_POST['reserve_id'];
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
    WHERE 
    ((date_start BETWEEN '".$date_start."' AND '".$date_end."')
    OR 
    (date_end BETWEEN '".$date_start."' AND '".$date_end."')
    OR 
     ('".$date_start."' BETWEEN date_start  AND date_end)
    OR 
     ('".$date_end."' BETWEEN  date_start  AND date_end ))
    AND 
    ((reserv_stime BETWEEN '".$time_start."' AND '".$time_end."')
    OR 
    (reserv_etime BETWEEN '".$time_start."' AND '".$time_end."')
    OR 
     ('".$time_start."' BETWEEN reserv_stime  AND reserv_etime)
    OR 
     ('".$time_end."' BETWEEN  reserv_stime  AND reserv_etime ))
    )
    AND department_name =
    (Select d.department_name from department d
    LEFT JOIN personnel p
    ON p.department_id = d.department_id
    LEFT JOIN cars c
    ON c.personnel_id = p.personnel_id
    WHERE c.car_id = ".$id.")
    AND c.status <> 'งดจอง'
    AND c.car_id <> '".$id."'
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
      <button data-id=".$reserve_id." data-carid=".$row['car_id']." class='btn btn-primary btn-xs handleChangeCars' type='button'>เลือก</button>
      </center>
      </td>
      <td class='text-center'>".$row['car_reg']."</td>
      <td class='text-left'>".$row['car_brand_name']."</td>
      <td class='text-left'>".$row['car_kind']."</td>
      <td class='text-center'>".$row['seat']."</td>
      <td class='text-left'>".$row['title_name'].$row['personnel_name']."</td>
      </tr>
      ";
    }
  }else {
    echo "<tr><td colspan='6' class='text-center'>ไม่มีข้อมูลรถยนต์ว่าง</td></tr>";
  }

  }
  elseif ($mode == 'approve_reservation') 
  {
    $id = $_POST["reserve_id"];
    $status = $_POST["status"];
    $useStatus;
      if ($status == 0) { $useStatus = 0; $note = '';}
      elseif ($status == 1 ) { $useStatus = 1; $note = '';}
      elseif ($status == 2 || $status == 3) { $useStatus = 3; $note = $_POST['reason'].",".$_POST['note'];}
      else { $useStatus = 2; $note = $_POST['reason'].",".$_POST['note'];}
    $timestamp = date("Y-m-d H:i:s");

    $sql = "select * from reservation where reservation_id ='".$id."'";
    $result = $conn->query($sql);
    if($result){

      $person = "SELECT p.personnel_id as id , u.user_level as num_approve FROM personnel p
      LEFT JOIN user_type u
      ON p.user_type_id = u.user_type_id
      WHERE p.personnel_name = '".$_SESSION['user_name']."'";
      $result = $conn->query($person);
      $person = $result->fetch_assoc();

      if($person['num_approve'] == 4) //เจ้าหน้าที่
      {
        $sql = "update reservation
        set reservation_status = ".$status."
        , usage_status = ".$useStatus."
        , reserve_note = '".$note."'
        , second_approver_id = '".$person['id']."'
        ,update_status_date = '".$timestamp."'
        WHERE reservation_id = '".$id."'";
      }
      elseif ($person['num_approve'] == 5) 
      {
        $sql = "update reservation
        set fist_approve_status = ".$status."
        ,fist_approve_note = '".$note."'
        , first_approver_id = '".$person['id']."'
        ,fist_approve_date = '".$timestamp."'
        WHERE reservation_id = '".$id."'";
      }
      else
      {
        $sql = "update reservation
        set reservation_status = ".$status."
        , usage_status = ".$useStatus."
        , reserve_note = '".$note."'
        , second_approver_id = '".$person['id']."'
        ,update_status_date = '".$timestamp."'
        WHERE reservation_id = '".$id."'";
      }
      
      $result = $conn->query($sql);
      if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
      else {echo json_encode(array('result' => '0'));}
    }
    else
    {
      echo json_encode(array('result' => 'error'));
    }
  }
  elseif($mode == 'getTableDetail')
  {
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
    WHERE r.reservation_id = '".$_POST['id']."'";

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
      if ($row['reserve_note'] != '' || $row['reserve_note'] != NULL) {$note = str_replace(","," ",$row['reserve_note']);}
      elseif($row['reserve_note'] == '' || $row['reserve_note'] == NULL) {$note = "-";}
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
      $passener_name = array();
      $passenger_department = array();

      $sql_passenger ="
      SELECT passenger_name , department_id as department FROM passenger
      WHERE reservation_id = ".$row['reservation_id'];
      $c = $conn->query($sql_passenger);
      while($d = $c->fetch_assoc()){
        array_push($passener_name,$d['passenger_name']);
        array_push($passenger_department,$d['department']);
      }

      $allPassenger = "";
      if(!isset($passener_name))
      {
        $allPassenger = "ไม่มีผู้โดยสารเพิ่มเติม";
      }
      else 
      {

        $coutPassenger = sizeof($passener_name);
        $allPassenger = array();
        $arrDepartment = array();
        $arrName = array();
        $onePassenger = array();
        $passenger = "";
    
        for ($i=0; $i < $coutPassenger ; $i++)
        {
          if($passenger_department[$i] !== NULL)
          {
            $sql_department = "
            SELECT department_name FROM department
            WHERE department_id = ".$passenger_department[$i];
            $a = $conn->query($sql_department);
            $b = $a->fetch_assoc();

            $arrDepartment[$i] = "<b>".$b['department_name']."</b><br>";
            $arrName[$i] = $passener_name[$i]."<br />";
          }
          else {
            $arrDepartment[$i] = "<b>ไม่ระบุหน่วยงาน</b><br>";
            $arrName[$i] = $passener_name[$i]."<br />";
          }
          
        }
    
        $coutInDepartment = array_count_values(array_values($arrDepartment));
        $nameDepartment = array_values(array_unique($arrDepartment));
    
        sort($nameDepartment);
    
        $count = 0;
    
        for ($a=0; $a < sizeof($nameDepartment); $a++) 
        { 
          $name = $nameDepartment[$a];
          $n = $coutInDepartment[$name];
          array_push($allPassenger, $name);
    
          $passenger = array();
          for ($b=0; $b < $n ; $b++) 
          { 
            array_push($passenger, $arrName[$count]);
            $count++;
          }
          sort($passenger);
    
          for ($c=0; $c < sizeof($passenger); $c++) 
          { 
            array_push($allPassenger, $passenger[$c]);
          }
    
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

    ?>
    <table class="table table-bordered">
    <!-- ผู้ติดต่อ -->
    <tr>
    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">ผู้ติดต่อ :</td>
    <td><?php echo $person; ?>&nbsp;&nbsp;&nbsp;<b>โทรศัพท์</b> <?php echo $tel; ?></td>
    </tr>
    <!-- วันที่ใช้รถยนต์ -->
    <tr>
    <td class="field-label col-xs-3 topic">วันที่ใช้รถยนต์ :</td>
    <td><?php echo $reservation_date; ?></td>
    </tr>
    <!-- จองใช้เพื่อ -->
    <tr>
    <td class="col-lg-3 col-md-3 col-sm-3 col-xs-3 topic">จองใช้เพื่อ :</td>
    <td class="detail_colum_indetail"><?php echo $detail;?></td>
    </tr>
    <!-- สถานที่จะไป -->
    <tr>
    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">สถานที่จะไป :</td>
    <td>
      <?php
      $arrLocation = explode(",", $location);
      foreach ($arrLocation as $key => $value) 
      {
        echo ($key+1).". ".$value."<br>";
      }
       ?>
    </td>
    </tr>
    <!-- รายชื่อผู้โดยสาร -->
    <tr>
    <td class="field-label col-xs-3 topic">รายชื่อผู้โดยสาร :</td>
    <td><dl><?php 
    foreach ($allPassenger as $key => $value) 
    {
      echo  $value;
    }
    ?></dl></td>
    </tr>
    <!-- ให้รถไปรับที่ -->
    <tr>
    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">ให้รถไปรับที่ :</td>
    <td><?php echo $appointment; ?></td>
    </tr>
    <!-- รถยนต์ที่จอง -->
    <tr>
    <td class="field-label col-xs-3 topic">รถยนต์ที่จอง :</td>
    <td><?php echo $car_reg; ?>/ ยี่ห้อ <?php echo $car_brand; ?> / รุ่น <?php echo $car_kind; ?> / <?php echo $seat; ?> ที่นั่ง </td>
    </tr>
    <!-- พนักงานขับรถยนต์ -->
    <tr>
    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">พนักงานขับรถ :</td>
    <td><?php echo $name_driver; ?>&nbsp;&nbsp;&nbsp;<b>โทรศัพท์</b> <?php echo $tel_driver; ?></td>
    </tr>
    <!-- วันที่ทำรายการ -->
    <tr>
    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">วันที่ทำรายการ :</td>
    <td><?php echo $timestamp; ?></td>
    </tr>
    <!-- empty -->
    <tr>
    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic" colspan="2"></td>
    </tr>
    <!-- ผลการจอง -->
    <tr>
    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">ผลการจอง :</td>
    <td><?php echo $rstatus; ?>&nbsp;&nbsp;&nbsp;<b>บันทึกโดย</b> <?php echo $person_approve; ?>&nbsp;&nbsp;&nbsp;<b>โทรศัพท์</b> <?php echo $tel_approve; ?></td>
    </tr>
    <!-- เหตุผล -->
    <tr>
    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">เพิ่มเติม :</td>
    <td><?php echo $note; ?></td>
    </tr>
    <!-- วันที่แก้ไขสถานะล่าสุด -->
    <tr>
    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">วันที่บันทึกผล :</td>
    <td><?php echo $updateStatus; ?></td>
    </tr>
  </table>
    <?php
    }
  }
  elseif ($mode == 'deleteReservation') 
  {
    $delete_id = $_POST['id'];
    
    $sql = "select * from reservation where reservation_id ='".$delete_id."'";
    $result = $conn->query($sql);
    if($result){
      $sql = "delete from reservation
      where reservation_id = '".$delete_id."'";
    
      if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
      else {echo json_encode(array('result' => '0'));}
    }else{
      echo json_encode(array('result' => 'error'));
    }
  }
  elseif ($mode == 'editReservation') 
  {
    $id = $_POST['id'];
    
    $detail = $_POST['detail'];
    $location = implode(",",$_POST['location']);
    $date_start = $_POST['date_start'];
    $date_end = $_POST['date_end'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $real_date_out = $_POST['real_date_out'];
    $real_time_out = $_POST['real_time_out'];
    $real_date_in = $_POST['real_date_in'];
    $real_time_in = $_POST['real_time_in'];
    $kilometer_out = $_POST['kilometer_out'];
    $kilometer_in = $_POST['kilometer_in'];
    $kilometer_total = $_POST['kilometer_total'];
    $reservation_status = $_POST['reservation_status'];
    $usage_status = $_POST['usage_status'];
    

    if($usage_status == 3)
    {
      $txt = implode(",",$_POST['note']);
      $note = ", reserve_note = '".$txt."'";
      
    }
    else
    {
      $note = ", reserve_note = NULL";
    } 

    if($reservation_status == 0)
    {
      $sql = "update reservation
      set requirement_detail = '".$detail."'
      , location = '".$location."'
      , date_start = '".$date_start."'
      , date_end = '".$date_end."'
      , reserv_stime = '".$time_start."'
      , reserv_etime = '".$time_end."'
      , passenger_total = (SELECT COUNT(passenger_id) FROM passenger WHERE reservation_id = '".$id."')
      , real_time_out = '0000-00-00 00:00:00'
      , real_time_in = '0000-00-00 00:00:00'
      , kilometer_out = '0'
      , kilometer_in = '0'
      , kilometer_total = '0'
      , reservation_status = '".$reservation_status."'
      , usage_status = '".$usage_status."'";
      $sql .= $note;
      $sql .= ", second_approver_id = NULL
      , update_status_date = '".date("Y-m-d H:i:s")."'
      where reservation_id = '".$id."'";
    }
    else 
    {
      $sql = "update reservation
      set requirement_detail = '".$detail."'
      , location = '".$location."'
      , date_start = '".$date_start."'
      , date_end = '".$date_end."'
      , reserv_stime = '".$time_start."'
      , reserv_etime = '".$time_end."'
      , passenger_total = (SELECT COUNT(passenger_id) FROM passenger WHERE reservation_id = '".$id."')
      , real_time_out = '".$real_date_out." ".$real_time_out.":00'
      , real_time_in = '".$real_date_in." ".$real_time_in.":00'
      , kilometer_out = '".$kilometer_out."'
      , kilometer_in = '".$kilometer_in."'
      , kilometer_total = '".$kilometer_total."'
      , reservation_status = '".$reservation_status."'
      , usage_status = '".$usage_status."'";
      $sql .= $note;
      $sql .= ", second_approver_id = (SELECT personnel_id FROM personnel WHERE personnel_name = '".$_SESSION['user_name']."')
      , update_status_date = '".date("Y-m-d H:i:s")."'
      where reservation_id = '".$id."'";
    }
      
      if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
      else {echo json_encode(array('result' => 'error'));}

  }
  elseif ($mode == 'editCarInRMA') 
  {
    $reserve_id = $_POST['id'];
    $id = $_POST["carid"];
    
    $sql = "select * from cars where car_id ='".$id."'";
    $result = $conn->query($sql);
    if($result){
      $sql = "update reservation
      set car_id = '".$id."'
      where reservation_id = '".$reserve_id."'";
    
      if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
      else {echo json_encode(array('result' => '0'));}
    }
    else
    {
      echo json_encode(array('result' => 'error'));
    }
  }
  elseif ($mode == 'deleteOtherApprove') 
  {
    $id = $_POST["id"];
    
      $sql = "update reservation
      set fist_approve_status	= 0
      , fist_approve_note = NULL
      , first_approver_id = NULL
      , fist_approve_date = NULL
      where reservation_id = '".$id."'";
    
      if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
      else {echo json_encode(array('result' => '0'));}

  }
?>
