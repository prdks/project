<?php
require_once '../_connect.php';
$mode = $_POST['mode'];

if ($mode == 'getDetail')
{
  $id = $_POST['id'];
  $sql = "
    Select * from department where department_id = '".$id."'";

  $result = $conn->query($sql);

  $row = $result->fetch_assoc();
  $arr = array(
            'name' => $row['department_name']
          );
  echo json_encode($arr);
}
elseif ($mode == 'insertDepartment')
{
  $department_txt = $_POST['department'];

  $sql = "select department_name from department where department_name ='".$department_txt."'";
  $result = $conn->query($sql);
  if($result->num_rows === 0){

    $sql = "insert into department (department_name) values ('".$department_txt."')
    ON DUPLICATE KEY UPDATE department_id = department_id";

    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  elseif ($result->num_rows > 0)
  {
    echo json_encode(array('result' => 'error'));
  }
}
elseif ($mode == 'editDepartment')
{
  $id = $_POST["id"];
  $str = $_POST["department"];

  $sql = "select * from department where department_id ='".$id."'";
  $result = $conn->query($sql);
  if($result){
    $sql = "update department
    set department_name = '".$str."'
    where department_id = '".$id."'";

    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  else
  {
    echo json_encode(array('result' => 'error'));
  }
}
elseif ($mode == 'deleteDepartment')
{
  $id = $_POST['id'];

  $sql = "
  SELECT COUNT(*) as n FROM department d
  LEFT JOIN personnel p
  ON p.department_id = d.department_id
  WHERE p.department_id = '".$id."'";
  $result = $conn->query($sql);
  $data = $result->fetch_array();

  if($data['n'] == 0){
    $sql = "delete from department
    where department_id = '".$id."'";

    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }else{
    echo json_encode(array('result' => 'error'));
  }
}
?>
