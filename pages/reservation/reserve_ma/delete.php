<?php
require '../../_connect.php';

$delete_id = $_POST['id'];

$sql = "select * from reservation where reservation_id ='".$delete_id."'";
$result = $conn->query($sql);
if($result){
  $sql = "delete from reservation
  where reservation_id = '".$delete_id."'";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('ลบข้อมูลสำเร็จ');
    window.location.assign('../../reserve_ma.php');
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
    window.location.assign('../../reserve_ma.php');
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
  window.location.assign('../../reserve_ma.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
