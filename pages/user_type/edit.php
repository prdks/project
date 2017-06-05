<?php
require '../_connect.php';

$id = $_POST["id"];
$str = $_POST["str"];

$sql = "select * from user_type where user_type_id ='".$id."'";
$result = $conn->query($sql);
if($result){
  $sql = "update user_type
  set user_type_name = '".$str."'
  where user_type_id = '".$id."'";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('แก้ไขข้อมูลสำเร็จ');
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
    alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาทำรายการใหม่');
    window.location.assign('../user_type.php');
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
  window.location.assign('../user_type.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
