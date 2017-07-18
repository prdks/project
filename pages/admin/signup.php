<?php
session_start();
require '../_connect.php';

$email = $_POST['email'];
$name = $_POST['name'];
$type = $_POST['user_level'];

$sql = "insert into personnel
(personnel_name,email,user_type_id)
values
('".$name."','".$email."'
,(select user_type_id from user_type where user_level = '".$type."'))
ON DUPLICATE KEY UPDATE personnel_id = personnel_id ";

$result = $conn->query($sql);
if($result === true){
  $sql = "
    SELECT
      personnel_name, email, user_level
    FROM personnel psn
    LEFT OUTER JOIN  user_type type
      ON psn.user_type_id = type.user_type_id
    WHERE email = '".$email."'";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()){
    $_SESSION['user_name'] = $row['personnel_name'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['user_type'] = $row['user_level'];
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
  window.location.assign('../signup_app.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
?>
