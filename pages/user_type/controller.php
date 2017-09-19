<?php
require_once '../_connect.php';
$mode = $_POST['mode'];

if ($mode == 'getDetail')
{
  $id = $_POST['id'];
  $sql = "
    Select * from user_type where user_type_id = '".$id."'";

  $result = $conn->query($sql);

  $row = $result->fetch_assoc();
  $arr = array(
            'name' => $row['user_type_name'],
          );
  echo json_encode($arr);
}
elseif ($mode == 'editUserType')
{
  $id = $_POST["id"];
  $str = $_POST["user_type"];

  $sql = "select * from user_type where user_type_id ='".$id."'";
  $result = $conn->query($sql);
  if($result){
    $sql = "update user_type
    set user_type_name = '".$str."'
    where user_type_id = '".$id."'";

    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  else
  {
    echo json_encode(array('result' => 'error'));
  }
}
?>
