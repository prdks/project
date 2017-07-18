<?php
session_start();
require '../_connect.php';

$user = $_POST['username'];
$pass = $_POST['password'];

$sql = "select * from config where username ='".$user."' And password = '".$pass."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($result->num_rows == 0)
{
  if ($user !== 'admin' || $pass !== 'admin') //Login เข้าครั้งแรก
  {
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง กรุณาเข้าสู่ระบบใหม่อีกครั้ง');
    window.location.assign('../admin_login.php');
    }
    </script>
    <body onload='redir();'></body>
    ";
  }
  else
  {
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

}
elseif ($result->num_rows == 1)
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
?>
