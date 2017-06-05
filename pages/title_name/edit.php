<?php
require '../_connect.php';

$id = $_POST["id"];
$str = $_POST["str"];

$sql = "select * from title_name where title_name_id ='".$id."'";
$result = $conn->query($sql);
if($result){
  $sql = "update title_name
  set title_name = '".$str."'
  where title_name_id = '".$id."'";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('แก้ไขข้อมูลสำเร็จ');
    window.location.assign('../title_name.php');
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
    window.location.assign('../title_name.php');
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
  window.location.assign('../title_name.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
