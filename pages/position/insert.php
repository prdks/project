<?php
require '../_connect.php';

$position_txt = $_POST['position'];

$sql = "select position_name from position where position_name ='".$position_txt."'";
$result = $conn->query($sql);
if($result->num_rows === 0){

  $sql = "insert into position (position_name) values ('".$position_txt."')
  ON DUPLICATE KEY UPDATE position_id = position_id";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('เพิ่มข้อมูลสำเร็จ');
    window.location.assign('../position.php');
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
    window.location.assign('../position.php');
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
  window.location.assign('../position.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
