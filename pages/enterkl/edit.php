<?php
require '../_connect.php';
session_start();
date_default_timezone_set("Asia/Bangkok");

$id = $_POST['id'];
$real_datetime = date("Y-m-d H:i:s");
$type = $_POST['hdtype'];

switch ($type) {
  case '1':
  {
    $kilometer_out = $_POST['kl_out'];
    $sql = "update reservation
    set real_time_out = '".$real_datetime."'
    , kilometer_out = '".$kilometer_out."'
    where reservation_id = '".$id."'";

    if($conn->query($sql)===true){
      echo "
      <!DOCTYPE html>
      <script>
      alert('บันทึกข้อมูลสำเร็จ');
      window.location.assign('../index.php');
      </script>
      ";
    }else {
      echo "
      <!DOCTYPE html>
      <script>
      alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาทำรายการใหม่');
      window.location.assign('../qrcode.php?id=".$id."');
      </script>
      ";
    }
  }
    break;
  case '2':
  {
    $kilometer_in = $_POST['kl_in'];
    $oldkl = $_POST['oldkl'];
    $total = $kilometer_in - $oldkl;

    $sql = "update reservation
    set real_time_in = '".$real_datetime."'
    , kilometer_in = '".$kilometer_in."'
    , kilometer_total = '".$total."'
    where reservation_id = '".$id."'";

    if($conn->query($sql)===true){
      echo "
      <!DOCTYPE html>
      <script>
      alert('บันทึกข้อมูลสำเร็จ');
      window.location.assign('../index.php');
      </script>
      ";
    }else {
      echo "
      <!DOCTYPE html>
      <script>
      alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาทำรายการใหม่');
      window.location.assign('../qrcode.php?id=".$id."');
      </script>
      ";
    }
  }
  break;
}
?>
