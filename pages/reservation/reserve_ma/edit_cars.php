<?php
require '../../_connect.php';

$reserve_id = $_GET['id'];
$id = $_GET["carid"];

$sql = "select * from cars where car_id ='".$id."'";
$result = $conn->query($sql);
if($result){
  $sql = "update reservation
  set car_id = '".$id."'
  where reservation_id = '".$reserve_id."'";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('แก้ไขข้อมูลสำเร็จ');
    window.location.assign('../../reserve_ma_edit.php?id=".$reserve_id."');
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
    window.location.assign('../../reserve_ma_edit.php?id=".$reserve_id."');
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
  window.location.assign('../../reserve_ma_edit.php?id=".$reserve_id."');

  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
