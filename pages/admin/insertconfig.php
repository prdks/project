<?php
require '../_connect.php';

$username = $_POST['username'];
$password = $_POST['confirm_password'];
$name = $_POST['name'];
$domain_name = $_POST['domain_name'];
$url = $_POST['url'];
$url_sheet = $_POST['url_sheet'];

if($_FILES["logo"]["name"] != "")
{
  //*** Read file BINARY ***'
  $fp = fopen($_FILES["logo"]["tmp_name"],"r");
  $ReadBinary = fread($fp,filesize($_FILES["logo"]["tmp_name"]));
  fclose($fp);
  $FileData = addslashes($ReadBinary);
}

if ($url !== "" && $url_sheet !== "") //มีรูป มีurl
{
  $sql = "INSERT INTO config (username,password,name,domain_name,logo,url,url_sheet)
  values ('".$username."','".$password."','".$faculty_name."','".$domain_name."','".$FileData."','".$url."','".$url_sheet."')
  ON DUPLICATE KEY UPDATE id = id";
}
elseif ($url === "" && $url_sheet !== "")
{
  $sql = "INSERT INTO config (username,password,name,domain_name,logo,url_sheet)
  values ('".$username."','".$password."','".$faculty_name."','".$domain_name."','".$FileData."','".$url_sheet."')
  ON DUPLICATE KEY UPDATE id = id";
}
elseif ($url !== "" && $url_sheet === "") 
{
  $sql = "INSERT INTO config (username,password,name,domain_name,logo,url)
  values ('".$username."','".$password."','".$faculty_name."','".$domain_name."','".$FileData."','".$url."')
  ON DUPLICATE KEY UPDATE id = id";
}
else
{
  $sql = "INSERT INTO config (username,password,name,domain_name,logo)
  values ('".$username."','".$password."','".$name."','".$domain_name."','".$FileData."')
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
