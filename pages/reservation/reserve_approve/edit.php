<?php
session_start();
require '../../_connect.php';
date_default_timezone_set("Asia/Bangkok");

$id = $_POST["reserve_id"];
$status = $_POST["status"];
$useStatus;
  if ($status == 0) { $useStatus = 0; }
  elseif ($status == 1 ) { $useStatus = 1; }
  elseif ($status == 2 || $status == 3) { $useStatus = 3; }
  else { $useStatus = 2; }
$note = $_POST['note'];
$timestamp = date("Y-m-d H:i:s");

$sql = "select * from reservation where reservation_id ='".$id."'";
$result = $conn->query($sql);
if($result){
  $sql = "update reservation
  set reservation_status = ".$status."
  , usage_status = ".$useStatus."
  , note = '".$note."'
  , first_approver_id = (select personnel_id from personnel where personnel_name = '".$_SESSION['user_name']."')
  ,update_status_date = '".$timestamp."'
  WHERE reservation_id = '".$id."'";
if($conn->query($sql)===true){
  echo "
  <!DOCTYPE html>
  <script>
  function redir()
  {
  alert('บันทึกข้อมูลสำเร็จ');
  window.location.assign('../../reserve_approve.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}else {
  echo "
  <!DOCTYPE html>
  <script>
  function redir()
  {
  alert('ไม่สามารถเพิ่มข้อมูลได้ กรุณาทำรายการใหม่');
  window.location.assign('../../reserve_approve.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
}else{
  echo "
  <!DOCTYPE html>
  <script>
  function redir()
  {
  alert('ข้อมูลไม่ถูกต้อง ไม่สามารถแก้ไขข้อมูลได้ กรุณาทำรายการใหม่');
  window.location.assign('../../reserve_approve.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
