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
    if ($row['username'] === $user && $row['password'] === $pass)
    {
      $_SESSION['config_id'] = $row['id'];
      echo json_encode(array('result' => '1'));
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
      echo json_encode(array('result' => '2'));
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
    values ('".$username."','".$password."','".$faculty_name."','".$domain_name."','".$FileData."','".$url."')
    ON DUPLICATE KEY UPDATE id = id";
  }
  else
  {
    $sql = "INSERT INTO config (username,password,name,domain_name,logo)
    values ('".$username."','".$password."','".$faculty_name."','".$domain_name."','".$FileData."')
    ON DUPLICATE KEY UPDATE id = id";
  }

  if($conn->query($sql)===true){
    echo json_encode(array('result' => '1'));
  }else {
    echo json_encode(array('result' => '0'));
  }
}
elseif ($mode == 'editdata')
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
  else
  {
    # code...
  }

  if ($url !== "")
  {
    $sql = "INSERT INTO config (username,password,name,domain_name,logo,url)
    values ('".$username."','".$password."','".$faculty_name."','".$domain_name."','".$FileData."','".$url."')
    ON DUPLICATE KEY UPDATE id = id";
  }
  else
  {
    $sql = "INSERT INTO config (username,password,name,domain_name,logo)
    values ('".$username."','".$password."','".$faculty_name."','".$domain_name."','".$FileData."')
    ON DUPLICATE KEY UPDATE id = id";
  }

  if($conn->query($sql)===true){
    echo json_encode(array('result' => '1'));
  }else {
    echo json_encode(array('result' => '0'));
  }
}
?>
