<?php
require '../_connect.php';

$name = $_POST['user_name'];
$email = $_POST['email'];
$phone = $_POST['phonenumber'];

$title = $_POST['title_name'];
$department = $_POST['department'];
$position = $_POST['position'];
$user_type = $_POST['user_type_basic'];


$sql = "select * from personnel where personnel_name ='".$name."'";
$result = $conn->query($sql);
if($result->num_rows === 0)
{

  $sql = "insert into personnel
  (personnel_name,email,phone_number,title_name_id,position_id,department_id,user_type_id)
  values
  ('".$name."','".$email."','".$phone."'
  ,(select title_name_id from title_name where title_name = '".$title."')
  ,(select position_id from position where position_name = '".$position."')
  ,(select department_id from department where department_name = '".$department."')
  ,(select user_type_id from user_type where user_type_name = '".$user_type."'))
  ON DUPLICATE KEY UPDATE personnel_id = personnel_id";

  if($conn->query($sql)===true)
  {
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('เพิ่มข้อมูลสำเร็จ');
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
    alert('ไม่สามารถเพิ่มข้อมูลได้ กรุณาทำรายการใหม่');
    window.location.assign('../personnel.php');
    }
    </script>
    <body onload='redir();'></body>
    ";
  }
}
elseif ($result->num_rows > 0)
{
  echo "
  <!DOCTYPE html>
  <script>
  function redir()
  {
  alert('ข้อมูลนี้มีอยู่แล้ว กรุณาทำรายการใหม่');
  window.location.assign('../personnel.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
