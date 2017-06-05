<?php
require '../_connect.php';

$id = $_POST['id'];

$sql = "
SELECT COUNT(*) as n FROM department d
LEFT JOIN personnel p
ON p.department_id = d.department_id
WHERE p.department_id = '".$id."'";
$result = $conn->query($sql);
$data = $result->fetch_array();

if($data['n'] == 0){
  $sql = "delete from department
  where department_id = '".$id."'";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('ลบข้อมูลสำเร็จ');
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
    alert('ไม่สามารถลบข้อมูลได้ กรุณาทำรายการใหม่');
    window.location.assign('../department.php');
    }
    </script>
    <body onload='redir();'></body>
    ";
  }
}else{
  echo "
  <!DOCTYPE html>
  <script>
  function redir()
  {
  alert('ไม่สามารถลบข้อมูลได้ เนื่องจากมีการใช้งานอยู่');
  window.location.assign('../department.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
