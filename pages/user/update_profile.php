<?php
session_start();
require_once '../_connect.php';

if(isset($_POST['save_btn']))
{
  $title = $_POST['title_name'];
  $name = $_POST['user_name'];
  $phone = $_POST['phonenumber'];
  $department = $_POST['department'];
  $position = $_POST['position'];

  $sql = "update personnel
  set personnel_name = '".$name."'
  ,phone_number = '".$phone."'
  ,title_name_id = (select title_name_id from title_name where title_name = '".$title."')
  ,department_id = (select department_id from department where department_name = '".$department."')
  ,position_id = (select position_id from position where position_name = '".$position."')
  where personnel_name ='".$_SESSION['user_name']."'";
  if($conn->query($sql)===true)
  {
    $_SESSION['user_name'] = $name;
    $_SESSION['phone_number'] = $phone;
    $_SESSION['title_name'] = $title;
    $_SESSION['position'] = $position;
    $_SESSION['department'] = $department;

    echo "
    <!DOCTYPE html>
    <script>

    function redir()
    {
    alert('แก้ไขข้อมูลสำเร็จ');
    window.location.assign('../profile.php');
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
    window.location.assign('../profile.php');
    }
    </script>
    <body onload='redir();'></body>
    ";
  }
}
?>
