<?php
session_start();
require '../_connect.php';

$user = $_POST['username'];
$pass = $_POST['password'];

$sql = "select count(id) as id from config";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($row['id'] == 1)
{
  $sql = "select * from config where id = 1";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  if ($row['username'] === $user && $row['password'] === $pass)
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
  else
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



}
elseif ($row['id'] == 0)
{
  $sql = "ALTER TABLE config AUTO_INCREMENT = 1";
  $conn->query($sql);
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
?>
