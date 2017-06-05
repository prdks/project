<?php
require '../_connect.php';

$id = $_POST['id'];

$sql = "
SELECT COUNT(*) as n FROM car_brand b
LEFT JOIN cars c
ON c.car_brand_id = b.car_brand_id
WHERE c.car_brand_id = '".$id."'";
$result = $conn->query($sql);
$data = $result->fetch_array();

if($data['n'] == 0){
  $sql = "delete from car_brand
  where car_brand_id = '".$id."'";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('ลบข้อมูลสำเร็จ');
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
    alert('ไม่สามารถลบข้อมูลได้ กรุณาทำรายการใหม่');
    window.location.assign('../car_brand.php');
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
  alert('ไม่สามารถลบข้อมูลได้ เนื่องจากมีการใช้งานอยู่');
  window.location.assign('../car_brand.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
