<?php
session_start();
require '../_connect.php';

$user = $_POST['username'];
$pass = $_POST['password'];

$sql = "select * from config where username ='".$user."' And password = '".$pass."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($result->num_rows == 1) //รหัสถูก
{
  $_SESSION['config_id'] = $row['id'];
  echo "
  <!DOCTYPE html>
  <script>
  function redir()
  {
  window.location.assign('../page_config.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
elseif ($result->num_rows == 0) //รหัสผิด
{
  echo "
  <!DOCTYPE html>
  <script>
  function redir()
  {
  alert('รหัสไม่ถูกต้อง กรุณาเข้าสู่ระบบใหม่อีกครั้ง');
  window.location.assign('../admin_login.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>