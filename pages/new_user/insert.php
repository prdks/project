<?php
session_start();
require '../_connect.php';
$title = $_POST['title_name'];
$name = $_POST['user_name'];
$phone = $_POST['phone_number'];
$email = $_POST['email'];
$department = $_POST['department'];
$position = $_POST['position'];
$type = $_POST['user_type_basic'];

$sql = "insert into personnel
(personnel_name,phone_number,email,title_name_id,position_id,department_id,user_type_id)
values
('".$name."','".$phone."','".$email."'
,(select title_name_id from title_name where title_name ='".$title."')
,(select position_id from position where position_name = '".$position."')
,(select department_id from department where department_name = '".$department."')
,(select user_type_id from user_type where user_type_name = '".$type."'))
ON DUPLICATE KEY UPDATE personnel_id = personnel_id ";

$result = $conn->query($sql);
if($result === true){
  $sql = "
    SELECT
      personnel_name, email, phone_number, title_name,
      position_name , department_name,user_type_name
    FROM personnel psn
    LEFT OUTER JOIN title_name t
      ON psn.title_name_id = t.title_name_id
    LEFT OUTER JOIN  position p
      ON psn.position_id = p.position_id
    LEFT OUTER JOIN  department  d
      ON psn.department_id = d.department_id
    LEFT OUTER JOIN  user_type type
      ON psn.user_type_id = type.user_type_id
    WHERE email = '".$email."'";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()){
    $_SESSION['user_name'] = $row['personnel_name'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['phone_number'] = $row['phone_number'];
    $_SESSION['title_name'] = $row['title_name'];
    $_SESSION['position'] = $row['position_name'];
    $_SESSION['department'] = $row['department_name'];
    $_SESSION['user_type'] = $row['user_type_name'];
  }
    $_SESSION['loggedin'] = true;

    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    window.location.assign('../index.php');
    }
    </script>
    <body onload='redir();'></body>
    ";
}else{
  session_destroy();
  echo "
  <!DOCTYPE html>
  <script>
  function redir()
  {
  alert('ผิดพลาด กรุณาทำรายการใหม่');
  window.location.assign('../index.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
