<?php
require '../../_connect.php';
$location_name = $_POST['location_name'];
$province = $_POST['province'];
$reserve_id = $_POST['reserve_id'];

$sql = "select * from location where location_name ='".$location_name."'
AND province = '".$province."' AND reservation_id = ".$reserve_id." ";
$result = $conn->query($sql);
if($result->num_rows === 0){

  $sql = "insert into location (location_name,province,reservation_id)
  values ('".$location_name."'
  ,'".$province."'
  ,(select reservation_id from reservation where reservation_id = ".$reserve_id."))
  ON DUPLICATE KEY UPDATE location_id = location_id";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('เพิ่มข้อมูลสำเร็จ');
    window.location.assign('../../edit_location.php?id=".$reserve_id."');
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
    window.location.assign('../../edit_location.php?id=".$reserve_id."');
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
  window.location.assign('../../edit_location.php?id=".$reserve_id."');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
