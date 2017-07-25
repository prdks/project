<?php
require_once '../_connect.php';
$mode = $_POST['mode'];
// -------------------------------------------------------------
if ($mode === 'insertTitle')
{
  $title_txt = $_POST['title'];

  $sql = "select title_name from title_name where title_name ='".$title_txt."'";
  $result = $conn->query($sql);
  if($result->num_rows === 0)
  {
    $sql = "insert into title_name (title_name) values ('".$title_txt."')
    ON DUPLICATE KEY UPDATE title_name_id = title_name_id";
    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  elseif ($result->num_rows > 0)
  {
    echo json_encode(array('result' => 'error'));
  }
}
elseif ($mode === 'editTitle')
{
  $id = $_POST["new_title"];
  $str = $_POST["id"];

  $sql = "select * from title_name where title_name_id ='".$id."'";
  $result = $conn->query($sql);
  if($result){
    $sql = "update title_name
    set title_name = '".$str."'
    where title_name_id = '".$id."'";

    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  else
  {
    echo json_encode(array('result' => 'error'));
  }
}
?>
