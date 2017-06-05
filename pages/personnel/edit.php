<?php
require '../_connect.php';

$id = $_POST['id'];
$name = $_POST['user_name'];
$email = $_POST['email'];
$phone = $_POST['phonenumber'];

$title = $_POST['title_name'];
$department = $_POST['department'];
$position = $_POST['position'];
$user_type = $_POST['user_type'];

$sql = "select * from personnel where personnel_name ='".$name."'";
$result = $conn->query($sql);
if($result)
{
  $sql = "update personnel
  set personnel_name = '".$name."'
  ,email = '".$email."'
  ,phone_number = '".$phone."'
  ,title_name_id = '".$title."'
  ,department_id = '".$department."'
  ,position_id = '".$position."'
  ,user_type_id = '".$user_type."'
  where personnel_id= '".$id."'";

  if($conn->query($sql)===true)
  {
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('แก้ไขข้อมูลสำเร็จ');
    window.location.assign('../personnel.php');
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
    alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาทำรายการใหม่');
    window.location.assign('../personnel.php');
    }
    </script>
    <body onload='redir();'></body>
    ";
  }
}
else
{
  echo "
  <!DOCTYPE html>
  <script>
  function redir()
  {
  alert('ข้อมูลไม่ถูกต้อง ไม่สามารถแก้ไขข้อมูลได้ กรุณาทำรายการใหม่');
  window.location.assign('../personnel.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
