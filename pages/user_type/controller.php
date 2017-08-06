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
            'user_level' => $row['user_level']
          );
  echo json_encode($arr);
}
elseif ($mode == 'insertUserType')
{
  $user_type__txt = $_POST['user_type_name'];
  $level = $_POST['level'];

  $sql = "select * from user_type where user_type_name ='".$user_type__txt."' OR user_level = ".$level;
  $result = $conn->query($sql);
  if($result->num_rows === 0){

    $sql = "insert into user_type (user_type_name,user_level) values ('".$user_type__txt."',".$level.")
    ON DUPLICATE KEY UPDATE user_type_id = user_type_id";

    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  elseif ($result->num_rows > 0)
  {
    echo json_encode(array('result' => 'error'));
  }
}
elseif ($mode == 'editUserType')
{
  $id = $_POST["id"];
  $str = $_POST["user_type"];
  $level = $_POST["level"];

  $sql = "select * from user_type where user_type_id ='".$id."'";
  $result = $conn->query($sql);
  if($result){
    $sql = "update user_type
    set user_type_name = '".$str."'
    , user_level = ".$level."
    where user_type_id = '".$id."'";

    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  else
  {
    echo json_encode(array('result' => 'error'));
  }
}
elseif ($mode == 'deleteUserType')
{
  $id = $_POST['id'];

  $sql = "
  SELECT COUNT(*) as n FROM user_type t
  LEFT JOIN personnel p
  ON p.user_type_id = t.user_type_id
  WHERE p.user_type_id = '".$id."'";
  $result = $conn->query($sql);
  $data = $result->fetch_array();

  if($data['n'] == 0){
    $sql = "delete from user_type
    where user_type_id = '".$id."'";

    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }else{
    echo json_encode(array('result' => 'error'));
  }
}
?>
