<?php
require '../_connect.php';

$title_txt = $_POST['title_name'];

$sql = "select title_name from title_name where title_name ='".$title_txt."'";
$result = $conn->query($sql);
if($result->num_rows === 0){

  $sql = "insert into title_name (title_name) values ('".$title_txt."')
  ON DUPLICATE KEY UPDATE title_name_id = title_name_id";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('เพิ่มข้อมูลสำเร็จ');
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
    alert('ไม่สามารถเพิ่มข้อมูลได้ กรุณาทำรายการใหม่');
    window.location.assign('../title_name.php');
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
  window.location.assign('../title_name.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
