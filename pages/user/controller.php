<?php
session_start();
require_once '../_connect.php';
$mode = $_POST['mode'];

if($mode == 'NewUser')
{
  $title = $_POST['title_name'];
  $name = $_POST['user_name'];
  $phone = $_POST['phone_number'];
  $email = $_POST['email'];
  $department = $_POST['department'];
  $position = $_POST['position'];
  $type = $_POST['user_level'];
  
  $sql = "insert into personnel
  (personnel_name,phone_number,email,title_name_id,position_id,department_id,user_type_id)
  values
  ('".$name."','".$phone."','".$email."'
  ,(select title_name_id from title_name where title_name ='".$title."')
  ,(select position_id from position where position_name = '".$position."')
  ,(select department_id from department where department_name = '".$department."')
  ,(select user_type_id from user_type where user_level = '".$type."'))
  ON DUPLICATE KEY UPDATE personnel_id = personnel_id ";
  
  $result = $conn->query($sql);
  if($result === true){
    $sql = "
      SELECT
        personnel_name, email, phone_number, title_name,
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
}
elseif ($mode == 'LoginAuth') 
{
  $email = $_POST['hd_email'];
  $name = $_POST['name'];
  $s = $_POST['pqrcode'];
  
  $sql = "select * from personnel where email ='".$email."'";
  $result = $conn->query($sql);
  if($result->num_rows === 0){
    $_SESSION['email'] = $email;
    $_SESSION['user_name'] = $name;

    echo json_encode(array('result' => '0'));
  
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

      echo json_encode(array('result' => '1','id' => $s));

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

        echo json_encode(array('result' => '2'));
    }
  
  }
}
elseif($mode == "updateProfile")
{
    $title = $_POST['title_name'];
    $name = $_POST['user_name'];
    $phone = $_POST['phone_number'];
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
  
      echo json_encode(array('result' => '1'));
    }
    else
    {
      echo json_encode(array('result' => 'error'));
    }
}
?>
