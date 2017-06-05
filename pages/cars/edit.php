<?php
require '../_connect.php';
$id = $_POST['car_id'];
$reg = $_POST['car_reg'];
$brand = $_POST['car_brand'];
$kind = $_POST['car_kind'];
$detail = $_POST['car_detail'];
$seat = $_POST['seat'];
$driver = $_POST['driver'];
$status = $_POST['status'];

$sql = "select * from cars where car_id ='".$id."'";
$result = $conn->query($sql);
if($result){
  $sql = "update cars
  set car_reg = '".$reg."'
  , car_brand = '".$brand."'
  , car_kind = '".$kind."'
  , car_detail = '".$detail."'
  , seat = ".$seat."
  , status = '".$status."'
  , personnel_id =
  (SELECT personnel_id FROM personnel WHERE personnel_name = '".$driver."')
  where car_id = '".$id."'";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('แก้ไขข้อมูลสำเร็จ');
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
    alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาทำรายการใหม่');
    window.location.assign('../cars.php');
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
  window.location.assign('../cars.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
