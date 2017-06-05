<?php
require '../_connect.php';

$brand_name = $_POST['car_brand_name'];

$sql = "select * from car_brand where car_brand_name ='".$brand_name."'";
$result = $conn->query($sql);
if($result->num_rows === 0)
{

  $sql = "insert into car_brand (car_brand_name) values ('".$brand_name."')
  ON DUPLICATE KEY UPDATE car_brand_id = car_brand_id";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('เพิ่มข้อมูลสำเร็จ');
    window.location.assign('../car_brand.php');
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
    window.location.assign('../car_brand.php');
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
  window.location.assign('../car_brand.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
