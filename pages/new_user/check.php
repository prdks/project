<?php
session_start();
require '../_connect.php';

$email = $_POST['hd_email'];
$name = $_POST['name'];
$s = $_POST['pqrcode'];

$sql = "select * from personnel where email ='".$email."'";
$result = $conn->query($sql);
if($result->num_rows === 0){
  $_SESSION['email'] = $email;
  $_SESSION['user_name'] = $name;
  echo "
  <!DOCTYPE html>
  <script>
  function redir()
  {
  window.location.assign('../new_user.php');
  }
  </script>
  <body onload='redir();'></body>
  ";

}elseif ($result->num_rows > 0) {
  if ($s != null) { // ถ้าล้อคอินจากหน้าที่แสกน qrcode
    $sql = "
      SELECT
        personnel_name, email,phone_number, title_name,
        position_name , department_name,user_level
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
        $_SESSION['user_type'] = $row['user_level'];
    }
    $_SESSION['loggedin'] = true;
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    window.location.assign('../qrcode.php?id=".$s."');
    }
    </script>
    <body onload='redir();'></body>
    ";
  }else {
      $sql = "
        SELECT
          personnel_name, email,phone_number, title_name,
          position_name , department_name,user_level
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
  }

}
?>
