<?php
require '../../_connect.php';
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
if($result->num_rows === 0){

  $sql = "insert into passenger (passenger_name,department_id,reservation_id) values
  ('".$name."'
  ,(SELECT department_id FROM department WHERE department_name = '".$dep."')
  ,".$reserve_id.")
  ON DUPLICATE KEY UPDATE passenger_id = passenger_id";

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
    alert('เพิ่มข้อมูลสำเร็จ');
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
    alert('ไม่สามารถเพิ่มข้อมูลได้ กรุณาทำรายการใหม่');
    window.location.assign('../../edit_passenger.php?id=".$reserve_id."');
    }
    </script>
    <body onload='redir();'></body>
    ";
  }
}elseif ($result->num_rows > 0) {
  echo "
  <!DOCTYPE html>
  <script>
  function redir()
  {
  alert('ข้อมูลนี้มีอยู่แล้ว กรุณาทำรายการใหม่');
  window.location.assign('../../edit_passenger.php?id=".$reserve_id."');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
