<?php
require '../../_connect.php';

$reserve_id = $_POST['reserve_id'];
$id = $_POST["id"];
$str = $_POST["str"];
$province = $_POST['province'];

$sql = "select * from location where location_id ='".$id."'";
$result = $conn->query($sql);
if($result){
  $sql = "update location
  set location_name = '".$str."'
  , province = '".$province."'
  where location_id = '".$id."'";

  if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('แก้ไขข้อมูลสำเร็จ');
    window.location.assign('../../edit_location.php?id=".$reserve_id."');
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
    alert('ไม่สามารถแก้ไขข้อมูลได้ กรุณาทำรายการใหม่');
    window.location.assign('../../edit_location.php?id=".$reserve_id."');
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
  alert('ข้อมูลไม่ถูกต้อง ไม่สามารถแก้ไขข้อมูลได้ กรุณาทำรายการใหม่');
  window.location.assign('../../edit_location.php?id=".$reserve_id."');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
