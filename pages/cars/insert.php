<?php
require '../_connect.php';

$reg = $_POST['car_reg'].' '.$_POST['province'];
$brand = $_POST['car_brand'];
$kind = $_POST['car_kind'];
$detail = $_POST['car_detail'];
$seat = $_POST['seat'];
$driver = $_POST['driver'];
$status = $_POST['status'];
$note = $_POST['note'];

$sql = "select * from cars where car_reg ='".$reg."'";
$result = $conn->query($sql);
if($result->num_rows === 0){

  $sql = "
  INSERT INTO cars
  (car_reg , car_brand_id , car_kind , car_detail , seat , status ,note , personnel_id)
  VALUES
  ('".$reg."'
  ,(Select car_brand_id from car_brand where car_brand_name = '".$brand."')
  ,'".$kind."'
  ,'".$detail."'
  ,".$seat."
  ,'".$status."'
  ,'".$note."'
  ,(select personnel_id from personnel where personnel_name = '".$driver."'))
  ON DUPLICATE KEY UPDATE car_id = car_id";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('เพิ่มข้อมูลสำเร็จ');
    window.location.assign('../cars.php');
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
    window.location.assign('../cars.php');
    }
    </script>
    <body onload='redir();'></body>
    ";
  }
}elseif ($result->num_rows > 0) {
  echo "
  <!DOCTYPE html>
  <script>
  function redir()
  {
  alert('ข้อมูลนี้มีอยู่แล้ว กรุณาทำรายการใหม่');
  window.location.assign('../cars.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
