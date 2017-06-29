<?php
require '../../_connect.php';

$id = $_POST['id'];
$type = $_POST['user_type'];

$sql = "select * from personnel where personnel_id ='".$id."'";
$result = $conn->query($sql);
if($result)
{
  $sql = "update personnel
  set user_type_id = (select user_type_id from user_type where user_type_name = '".$type."')
  where personnel_id= '".$id."'";

  if($conn->query($sql)===true)
  {
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('แก้ไขข้อมูลสำเร็จ');
    window.location.assign('../../permission.php');
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
    window.location.assign('../../permission.php');
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
  window.location.assign('../../permission.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
