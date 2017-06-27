<?php
require_once '../_connect.php';
$mode = $_POST['mode'];

if ($mode == 'getDetail')
{
    $id = $_POST['id'];

    $sql = "SELECT c.* , b.* , p.* , t.* , d.* from cars c
    LEFT OUTER JOIN car_brand b
    ON c.car_brand_id = b.car_brand_id
    LEFT OUTER JOIN personnel p
    ON c.personnel_id = p.personnel_id
    LEFT OUTER JOIN title_name t
    ON p.title_name_id = t.title_name_id
    LEFT OUTER JOIN department d
    ON p.department_id = d.department_id
    WHERE car_id = '".$id."'";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    $arr = array(
              'reg' => $row['car_reg'],
              'brand' => $row['car_brand_name'],
              'kind' => $row['car_kind'],
              'detail' => $row['car_detail'],
              'seat' => $row['seat'],
              'driver' => $row['personnel_name'],
              'department' => $row['department_name'],
              'status' => $row['status'],
              'note' => $row['note']
            );
    echo json_encode($arr);

}
elseif ($mode == 'getEdit')
{
  $id = $_POST['id'];

  $sql = "SELECT c.* , b.* , p.* , t.* , d.* from cars c
  LEFT OUTER JOIN car_brand b
  ON c.car_brand_id = b.car_brand_id
  LEFT OUTER JOIN personnel p
  ON c.personnel_id = p.personnel_id
  LEFT OUTER JOIN title_name t
  ON p.title_name_id = t.title_name_id
  LEFT OUTER JOIN department d
  ON p.department_id = d.department_id
  WHERE car_id = '".$id."'";



  $result = $conn->query($sql);

  $row = $result->fetch_assoc();

    $car_reg = $row['car_reg'];
    $reg = substr($car_reg,0,strpos($car_reg,' '));
    $province = substr($car_reg,strpos($car_reg,' ')+1,strlen($car_reg));


    $arr = array(
              'reg' => $reg,
              'province' => $province,
              'brand' => $row['car_brand_name'],
              'kind' => $row['car_kind'],
              'detail' => $row['car_detail'],
              'seat' => $row['seat'],
              'driver' => $row['personnel_name'],
              'department' => $row['department_name'],
              'status' => $row['status'],
              'note' => $row['note'],
              'id' => $row['car_id']
            );
    echo json_encode($arr);
}
elseif ($mode == 'getDelete')
{
    $id = $_POST['id'];

    $sql = "SELECT c.* from cars c
    WHERE car_id = '".$id."'";

    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $arr = array(
              'reg' => $row['car_reg'],
              'id' => $row['car_id']
            );
    echo json_encode($arr);

}
?>
