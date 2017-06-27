<?php
require '../_connect.php';

$id = $_POST['id'];
$name = $_POST['user_name'];
$email = $_POST['email'];
$phone = $_POST['phone_number'];

$title = $_POST['title_name'];
$department = $_POST['department'];
$position = $_POST['position'];

$sql = "select * from personnel where personnel_name ='".$name."'";
$result = $conn->query($sql);
if($result)
{
  $sql = "update personnel
  set personnel_name = '".$name."'
  ,email = '".$email."'
  ,phone_number = '".$phone."'
  ,title_name_id = (select title_name_id from title_name where title_name = '".$title."')
  ,department_id = (select department_id from department where department_name = '".$department."')
  ,position_id = (select position_id from position where position_name = '".$position."')
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
