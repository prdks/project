<?php
require '../_connect.php';

$id = $_POST['id'];

$sql = "
SELECT COUNT(*) as n FROM user_type t
LEFT JOIN personnel p
ON p.user_type_id = t.user_type_id
WHERE p.user_type_id = '".$id."'";
$result = $conn->query($sql);
$data = $result->fetch_array();

if($data['n'] == 0){
  $sql = "delete from user_type
  where user_type_id = '".$id."'";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('ลบข้อมูลสำเร็จ');
    window.location.assign('../user_type.php');
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
    window.location.assign('../user_type.php');
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
  window.location.assign('../user_type.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
