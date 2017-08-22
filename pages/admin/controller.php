<?php
require_once '../_connect.php';
session_start();

$mode = $_POST['mode'];

if ($mode == 'login')
{
  $user = $_POST['username'];
  $pass = $_POST['password'];

  $sql = "select count(id) as id from config";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  if($row['id'] == 1)
  {
    $sql = "select * from config where id = 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['username'] === $user)
    {
      if (password_verify($pass, $row['password']))
      {
        echo json_encode(array('result' => '1' , 'id' => $row['id']));
      }
      else
      {
        echo json_encode(array('result' => 'error'));
      }
    }
    else
    {
      echo json_encode(array('result' => 'error'));
    }
  }
  elseif ($row['id'] == 0)
  {
    $sql = "ALTER TABLE config AUTO_INCREMENT = 1";
    $conn->query($sql);
    if ($user !== 'admin' || $pass !== 'admin') //Login เข้าครั้งแรก
    {
      echo json_encode(array('result' => 'error'));
    }
    else
    {
      echo json_encode(array('result' => '2' , 'id' => ''));
    }

  }
}
elseif ($mode == 'insertdata')
{
  $username = $_POST['username'];
  $password = $_POST['confirm_password'];
  $faculty_name = $_POST['name'];
  $domain_name = $_POST['domain_name'];
  $url = $_POST['url'];

  if($_FILES["logo"]["name"] != "")
  {
    //*** Read file BINARY ***'
    $fp = fopen($_FILES["logo"]["tmp_name"],"r");
    $ReadBinary = fread($fp,filesize($_FILES["logo"]["tmp_name"]));
    fclose($fp);
    $FileData = addslashes($ReadBinary);
  }

  if ($url !== "")
  {
    $sql = "INSERT INTO config (username,password,name,domain_name,logo,url)
    values ('".$username."','".password_hash($password, PASSWORD_DEFAULT)."','".$faculty_name."','".$domain_name."','".$FileData."','".$url."')
    ON DUPLICATE KEY UPDATE id = id";
  }
  else
  {
    $sql = "INSERT INTO config (username,password,name,domain_name,logo)
    values ('".$username."','".password_hash($password, PASSWORD_DEFAULT)."','".$faculty_name."','".$domain_name."','".$FileData."')
    ON DUPLICATE KEY UPDATE id = id";
  }

  if($conn->query($sql)===true){
    echo json_encode(array('result' => '1'));
  }else {
    echo json_encode(array('result' => '0'));
  }
}
elseif ($mode == 'getData')
{
  $id = $_POST['id'];

  $sql = "SELECT * FROM config WHERE id = ".$id;
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  $data = array('id' => $id
              , 'username' => $row['username']
              , 'password' => $row['password']
              , 'name' => $row['name']
              , 'domain' => $row['domain_name']
              , 'url' => $row['url']
            );

  echo json_encode($data);
}
elseif ($mode == 'updateUserPass')
{
  $id = $_POST['id'];
  $username = $_POST['username'];
  $old_password = $_POST['old_password'];
  $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
  $confirm = $_POST['confirm_new_password'];

  $sql = "SELECT password FROM config WHERE id = '".$id."'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  if(password_verify($old_password, $row['password'])) //ถ้ารหัสเก่าถูก
  {
    $sql = "UPDATE config SET
     username = '".$username."'
    ,password = '".$new_password."'
    WHERE id = '".$id."'";

    if($conn->query($sql)===true){
      echo json_encode(array('result' => '1')); //แก้ไขได้
    }else {
      echo json_encode(array('result' => '0')); // แก้ไขไม่ได้
    }
  }
  else
  {
      echo json_encode(array('result' => 'error')); // รหัสเก่าผิด
  }

}
elseif ($mode == 'updateData')
{
  $id = $_POST['id'];
  $faculty_name = $_POST['name'];
  $domain_name = $_POST['domain_name'];
  $url = $_POST['url'];

  $sql = "UPDATE config SET
  name = '".$faculty_name."'
 ,domain_name = '".$domain_name."'
 ,url = '".$url."'
 WHERE id = '".$id."'";

  if($conn->query($sql)===true){
    echo json_encode(array('result' => '1'));
  }else {
    echo json_encode(array('result' => '0'));
  }
}
elseif ($mode == 'updateLogo')
{
  $id = $_POST['id'];

  if($_FILES["logo"]["name"] != "")
  {
    //*** Read file BINARY ***'
    $fp = fopen($_FILES["logo"]["tmp_name"],"r");
    $ReadBinary = fread($fp,filesize($_FILES["logo"]["tmp_name"]));
    fclose($fp);
    $FileData = addslashes($ReadBinary);
  }

  $sql = "UPDATE config SET
  logo = '".$FileData."'
  WHERE id = '".$id."'";

  if($conn->query($sql)===true){
    echo json_encode(array('result' => '1'));
  }else {
    echo json_encode(array('result' => '0'));
  }
}
?>
