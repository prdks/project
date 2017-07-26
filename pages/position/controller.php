<?php
require_once '../_connect.php';
$mode = $_POST['mode'];

if ($mode == 'getDetail')
{
  $id = $_POST['id'];
  $sql = "
    Select * from position where position_id = '".$id."'";

  $result = $conn->query($sql);

  $row = $result->fetch_assoc();
  $arr = array(
            'name' => $row['position_name']
          );
  echo json_encode($arr);
}
elseif ($mode == 'insertPosition')
{
  $position_txt = $_POST['position'];

  $sql = "select position_name from position where position_name ='".$position_txt."'";
  $result = $conn->query($sql);
  if($result->num_rows === 0){

    $sql = "insert into position (position_name) values ('".$position_txt."')
    ON DUPLICATE KEY UPDATE position_id = position_id";

    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  elseif ($result->num_rows > 0)
  {
    echo json_encode(array('result' => 'error'));
  }
}
elseif ($mode == 'editPosition')
{
  $id = $_POST["id"];
  $str = $_POST["position"];

  $sql = "select * from position where position_id ='".$id."'";
  $result = $conn->query($sql);
  if($result){
    $sql = "update position
    set position_name = '".$str."'
    where position_id = '".$id."'";

    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  else
  {
    echo json_encode(array('result' => 'error'));
  }
}
elseif ($mode == 'deletePosition')
{
  $id = $_POST['id'];

  $sql = "
  SELECT COUNT(*) as n FROM position po
  LEFT JOIN personnel p
  ON p.position_id = po.position_id
  WHERE p.position_id = '".$id."'";
  $result = $conn->query($sql);
  $data = $result->fetch_array();

  if($data['n'] == 0){
    $sql = "delete from position
    where position_id = '".$id."'";

    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }else{
    echo json_encode(array('result' => 'error'));
  }
}
?>
