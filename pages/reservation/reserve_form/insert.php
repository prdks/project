<?php
require '../../_connect.php';
session_start();
date_default_timezone_set("Asia/Bangkok");

$require_detail = $_POST['require_detail'];
$date_start = $_POST['date_start'];
$date_end = $_POST['date_end'];
$time_start = $_POST['time_start'];
$time_end = $_POST['time_end'];
$selecter_cars = $_POST['checked'];
$Location = $_POST['location'];
$appointment_place = $_POST['appointment_place'];
$PassengerData = $_POST['PassengerData'];
$reserv_status = '0';
$usage_status = '0';
$timestamp = date("Y-m-d H:i:s");

// INSERT RESERVAION detail
$sql_reserv = "
INSERT INTO reservation (requirement_detail,date_start,date_end,reserv_stime,reserv_etime
,passenger_total,reservation_status,usage_status,timestamp,personnel_id,car_id,location,appointment_place)
VALUES('".$require_detail."','".$date_start."','".$date_end."','".$time_start."','".$time_end."'
,".sizeof($PassengerData).",'".$reserv_status."','".$usage_status."','".$timestamp."'
,(SELECT personnel_id FROM personnel WHERE personnel_name ='".$_SESSION['user_name']."')
,'".$selecter_cars[0]['Car_id']."'
,'".$Location."'
,'".$appointment_place."') ON DUPLICATE KEY UPDATE reservation_id = reservation_id";

if($conn->query($sql_reserv)===true)
{

  // INSERT PASSENGER
  $PassengerData = $_POST['PassengerData'];
  for ($i=0; $i < sizeof($PassengerData); $i++)
  {
    $sql_passenger = "
    INSERT INTO passenger (passenger_name,department_id,reservation_id)
    VALUES('".$PassengerData[$i]['Name']."'
    ,(SELECT department_id FROM department WHERE department_name = '".$PassengerData[$i]['Department']."')
    ,(SELECT reservation_id FROM reservation WHERE timestamp = '".$timestamp."'))
    ON DUPLICATE KEY UPDATE passenger_id = passenger_id
    ";
    $result = $conn->query($sql_passenger);
  }

}

?>
