<?php
require '../_connect.php';

$department_txt = $_POST['department_name'];

$sql = "select department_name from department where department_name ='".$department_txt."'";
$result = $conn->query($sql);
if($result->num_rows === 0){

  $sql = "insert into department (department_name) values ('".$department_txt."')
  ON DUPLICATE KEY UPDATE department_id = department_id";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('เพิ่มข้อมูลสำเร็จ');
    window.location.assign('../department.php');
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
    window.location.assign('../department.php');
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
  window.location.assign('../department.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
