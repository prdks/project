<?php
require '../_connect.php';

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
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('ตั้งค่าเสร็จสิ้น');
    window.location.assign('../signup_app.php');
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
    alert('การตั้งค่าผิดพลาด กรุณาทำรายการใหม่);
    window.location.assign('../page_config.php');
    }
    </script>
    <body onload='redir();'></body>
    ";
}

?>