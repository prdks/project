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

    if($row['picture_1'] !== null){$pic1 = 1;}else{$pic1 = 0;}
    if($row['picture_2'] !== null){$pic2 = 1;}else{$pic2 = 0;}
    if($row['picture_3'] !== null){$pic3 = 1;}else{$pic3 = 0;}
    if($row['picture_4'] !== null){$pic4 = 1;}else{$pic4 = 0;}

    $arr = array(
              'reg' => $row['car_reg'],
              'brand' => $row['car_brand_name'],
              'kind' => $row['car_kind'],
              'detail' => $row['car_detail'],
              'seat' => $row['seat'],
              'driver' => $row['personnel_name'],
              'department' => $row['department_name'],
              'status' => $row['status'],
              'pic1' => $pic1,
              'pic2' => $pic2,
              'pic3' => $pic3,
              'pic4' => $pic4,
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

    if($row['picture_1'] !== null){$pic1 = 1;}else{$pic1 = 0;}
    if($row['picture_2'] !== null){$pic2 = 1;}else{$pic2 = 0;}
    if($row['picture_3'] !== null){$pic3 = 1;}else{$pic3 = 0;}
    if($row['picture_4'] !== null){$pic4 = 1;}else{$pic4 = 0;}

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
              'pic1' => $pic1,
              'pic2' => $pic2,
              'pic3' => $pic3,
              'pic4' => $pic4,
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
elseif ($mode == 'insertCars')
{
  $reg = $_POST['car_reg'].' '.$_POST['province'];
  $brand = $_POST['car_brand'];
  $kind = $_POST['car_kind'];
  $detail = $_POST['car_detail'];
  $seat = $_POST['seat'];
  $driver = $_POST['driver'];
  $status = $_POST['status'];
  $note = $_POST['note'];
  $picture_name = '';
  $picture_data = '';
  for($i = 0 ; $i < 4 ; $i++){
    if($_FILES["filUpload".$i]["name"] != "")
    {
      //*** Read file BINARY ***'
      $fp = fopen($_FILES["filUpload".$i]["tmp_name"],"r");
      $ReadBinary = fread($fp,filesize($_FILES["filUpload".$i]["tmp_name"]));
      fclose($fp);
      $picture_name .= ',picture_'.($i+1);
      $FileData[$i] = addslashes($ReadBinary);
      $picture_data .= ",".$FileData[$i];
    }
  }
  
  $sql = "select * from cars where car_reg ='".$reg."'";
  $result = $conn->query($sql);
  if($result->num_rows === 0){
  
    $sql = "
    INSERT INTO cars
    (car_reg , car_brand_id , car_kind , car_detail , seat , status ,note , personnel_id";
    
    if($picture_name != ''){ $sql .= $picture_name;}

    $sql .= ")
    VALUES
    ('".$reg."'
    ,(Select car_brand_id from car_brand where car_brand_name = '".$brand."')
    ,'".$kind."'
    ,'".$detail."'
    ,".$seat."
    ,'".$status."'
    ,'".$note."'
    ,(select personnel_id from personnel where personnel_name = '".$driver."')";

    if($picture_name != ''){ $sql .= "'".$picture_data."'";}
    
    $sql .= ") ON DUPLICATE KEY UPDATE car_id = car_id";
  
    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  else
  {
    echo json_encode(array('result' => 'error'));
  }
}
elseif ($mode == 'editCars')
{
  $id = $_POST['car_id'];
  $reg = $_POST['car_reg'].' '.$_POST['province'];
  $brand = $_POST['car_brand'];
  $kind = $_POST['car_kind'];
  $detail = $_POST['car_detail'];
  $seat = $_POST['seat'];
  $driver = $_POST['driver'];
  $status = $_POST['status'];
  $note = $_POST['note'];
  $picture_data = '';
  for($i = 0 ; $i < 4 ; $i++){
    if($_FILES["filUpload".$i]["name"] != "")
    {
      //*** Read file BINARY ***'
      $fp = fopen($_FILES["filUpload".$i]["tmp_name"],"r");
      $ReadBinary = fread($fp,filesize($_FILES["filUpload".$i]["tmp_name"]));
      fclose($fp);
      $FileData[$i] = addslashes($ReadBinary);
      $picture_data .= ",picture_".($i+1)." = '".$FileData[$i]."'";
    }
  }

  $sql = "select * from cars where car_id ='".$id."'";
  $result = $conn->query($sql);
  if($result){
    $sql = "update cars
    set car_reg = '".$reg."'
    , car_brand_id = (Select car_brand_id from car_brand where car_brand_name = '".$brand."')
    , car_kind = '".$kind."'
    , car_detail = '".$detail."'
    , seat = ".$seat."
    , status = '".$status."'
    , note = '".$note."'
    , personnel_id = (SELECT personnel_id FROM personnel WHERE personnel_name = '".$driver."')
    ".$picture_data." where car_id = '".$id."'";
  
  
    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  else
  {
    echo json_encode(array('result' => 'error'));
  }
}
elseif ($mode == 'deleteCars')
{
  $delete_id = $_POST['car_id'];
  
  $sql = "select * from cars where car_id ='".$delete_id."'";
  $result = $conn->query($sql);
  if($result){
    $sql = "delete from cars
    where car_id = '".$delete_id."'";
  
    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  else
  {
    echo json_encode(array('result' => 'error'));
  }
}
elseif ($mode == 'deletePicture') 
{
  $id = $_POST['id'];
  $num = $_POST['pic_num'];
  
  $sql = "select * from cars where car_id ='".$id."'";
  $result = $conn->query($sql);
  if($result){
    $sql = "update cars
    set picture_".$num." = NULL
    WHERE car_id = ".$id;
  
    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  else
  {
    echo json_encode(array('result' => 'error'));
  }
}
?>
