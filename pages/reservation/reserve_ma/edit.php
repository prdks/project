<?php
require '../../_connect.php';
session_start();
date_default_timezone_set("Asia/Bangkok");

$id = $_POST['id'];

$detail = $_POST['detail'];
$location = $_POST['location'];
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
$note = $_POST['note'];

  $sql = "update reservation
  set requirement_detail = '".$detail."'
  , location = '".$location."'
  , date_start = '".$date_start."'
  , date_end = '".$date_end."'
  , reserv_stime = '".$time_start."'
  , reserv_etime = '".$time_end."'
  , real_time_out = '".$real_date_out." ".$real_time_out.":00'
  , real_time_in = '".$real_date_in." ".$real_time_in.":00'
  , kilometer_out = '".$kilometer_out."'
  , kilometer_in = '".$kilometer_in."'
  , kilometer_total = '".$kilometer_total."'
  , reservation_status = '".$reservation_status."'
  , usage_status = '".$usage_status."'
  , note = '".$note."'
  , second_approver_id = (SELECT personnel_id FROM personnel WHERE personnel_name = '".$_SESSION['user_name']."')
  , update_status_date = '".date("Y-m-d H:i:s")."'
  where reservation_id = '".$id."'";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    alert('แก้ไขข้อมูลสำเร็จ');
    window.location.assign('../../reserve_ma.php');
    </script>
    ";
  }else {
    echo "
    <!DOCTYPE html>
    <script>
    alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาทำรายการใหม่');
    window.location.assign('../../reserve_ma.php);
    </script>
    ";
  }
?>
