<?php
require '../_connect.php';

if(isset($_POST['checked_id']))
{
  $idArr = $_POST['checked_id'];
  foreach($idArr as $id)
  {
    $sql = "delete from personnel where personnel_id = '".$id."'";
    $result =$conn->query($sql);
  }
}
echo "
<!DOCTYPE html>
<script>
function redir()
{
alert('ลบข้อมูลสำเร็จ');
window.location.assign('../personnel.php');
}
</script>
<body onload='redir();'></body>
";
?>
