<?php
require '../../_connect.php';
$old = $_POST['old'];
$reserve_id = $_GET['reserve_id'];
$name = $_POST['title'].' '.$_POST['name'];
$dep = $_POST['dep'];

if ($dep !== "ไม่ระบุ") {
  $sql = "select * from passenger where passenger_name ='".$name."'
  AND reservation_id = ".$reserve_id."
  AND department_id = (select department_id from department where department_name = '".$dep."')";
}
else {
  $sql = "select * from passenger where passenger_name ='".$name."'
  AND reservation_id = ".$reserve_id."";
}

$result = $conn->query($sql);
if($result){
  $sql = "update passenger
  set passenger_name = '".$name."'
  ,department_id = (SELECT department_id FROM department WHERE department_name = '".$dep."')
  ,reservation_id = '".$reserve_id."'
  where passenger_id = '".$old."'";

  if($conn->query($sql)===true){
    $sql = "SELECT COUNT(passenger_id) as total FROM passenger WHERE reservation_id = '".$reserve_id."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $sql = "
    update reservation
    set passenger_total = '".$row['total']."'
    where reservation_id = '".$reserve_id."'";
    $conn->query($sql);

    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('แก้ไขข้อมูลสำเร็จ');
    window.location.assign('../../edit_passenger.php?id=".$reserve_id."');
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
    window.location.assign('../../edit_passenger.php?id=".$reserve_id."');
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
  window.location.assign('../../edit_passenger.php?id=".$reserve_id."');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
