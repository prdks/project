<?php
require '../_connect.php';

$username = $_POST['username'];
$password = $_POST['confirm_password'];
$faculty_name = $_POST['faculty_name'];
$url = $_POST['url'];

if($_FILES["logo"]["name"] != "")
{
  //*** Read file BINARY ***'
  $fp = fopen($_FILES["logo"]["tmp_name"],"r");
  $ReadBinary = fread($fp,filesize($_FILES["logo"]["tmp_name"]));
  fclose($fp);
  $FileData = addslashes($ReadBinary);
}

if ($url !== "") //มีรูป มีurl
{
  $sql = "INSERT INTO config (username,password,faculty_name,logo,url)
  values ('".$username."','".$password."','".$faculty_name."','".$FileData."','".$url."')
  ON DUPLICATE KEY UPDATE id = id";
}
else
{
  $sql = "INSERT INTO config (username,password,faculty_name,logo)
  values ('".$username."','".$password."','".$faculty_name."','".$FileData."')
  ON DUPLICATE KEY UPDATE id = id";
}

if($conn->query($sql)===true){
    echo "
    <!DOCTYPE html>
    <script>
    function redir()
    {
    alert('ตั้งค่าเสร็จสิ้น');

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
    }
    </script>
    <body onload='redir();'></body>
    ";
}

?>
