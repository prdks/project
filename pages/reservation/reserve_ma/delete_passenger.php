<?php
require '../../_connect.php';

$delete_id = $_POST['id'];
$reserve_id = $_POST['reserve_id'];

$sql = "select * from passenger where passenger_id ='".$delete_id."'";
$result = $conn->query($sql);
if($result){
  $sql = "delete from passenger
  where passenger_id = '".$delete_id."'";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('ลบข้อมูลสำเร็จ');
    window.location.assign('../../edit_passenger.php?id=".$reserve_id."');
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
    window.location.assign('../../edit_passenger.php?id=".$reserve_id."');
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
  window.location.assign('../../edit_passenger.php?id=".$reserve_id."');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
