<?php
require_once '../_connect.php';
$mode = $_POST['mode'];

if ($mode == 'getDetail')
{
  $id = $_POST['id'];
  $sql = "
    Select * from car_brand where car_brand_id = '".$id."'";

  $result = $conn->query($sql);

  $row = $result->fetch_assoc();
  $arr = array(
            'name' => $row['car_brand_name']
          );
  echo json_encode($arr);
}
elseif ($mode == 'insertBrand')
{
  $brand_name = $_POST['car_brand'];

  $sql = "select * from car_brand where car_brand_name ='".$brand_name."'";
  $result = $conn->query($sql);
  if($result->num_rows === 0)
  {

    $sql = "insert into car_brand (car_brand_name) values ('".$brand_name."')
    ON DUPLICATE KEY UPDATE car_brand_id = car_brand_id";

    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  elseif ($result->num_rows > 0)
  {
    echo json_encode(array('result' => 'error'));
  }
}
elseif ($mode == 'editBrand')
{
  $id = $_POST["id"];
  $str = $_POST["car_brand"];

  $sql = "select * from car_brand where car_brand_id ='".$id."'";
  $result = $conn->query($sql);
  if($result){
    $sql = "update car_brand
    set car_brand_name = '".$str."'
    where car_brand_id = '".$id."'";

    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  else
  {
    echo json_encode(array('result' => 'error'));
  }
}
elseif ($mode == 'deleteBrand')
{
  $id = $_POST['id'];

  $sql = "
  SELECT COUNT(*) as n FROM car_brand b
  LEFT JOIN cars c
  ON c.car_brand_id = b.car_brand_id
  WHERE c.car_brand_id = '".$id."'";
  $result = $conn->query($sql);
  $data = $result->fetch_array();

  if($data['n'] == 0){
    $sql = "delete from car_brand
    where car_brand_id = '".$id."'";

    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }else{
    echo json_encode(array('result' => 'error'));
  }
}
?>
