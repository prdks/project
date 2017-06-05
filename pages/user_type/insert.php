<?php
require '../_connect.php';

$user_type__txt = $_POST['user_type_name'];

$sql = "select * from user_type where user_type_name ='".$user_type__txt."'";
$result = $conn->query($sql);
if($result->num_rows === 0){

  $sql = "insert into user_type (user_type_name) values ('".$user_type__txt."')
  ON DUPLICATE KEY UPDATE user_type_id = user_type_id";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('เพิ่มข้อมูลสำเร็จ');
    window.location.assign('../user_type.php');
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
    window.location.assign('../user_type.php');
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
  window.location.assign('../user_type.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
