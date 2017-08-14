<?php
require '_connect.php';
$mode = $_GET['mode'];
if ($mode == 'car')
{
  $i = $_GET['imgindex'];
  $id = $_GET['id'];
  $att = "picture_".$i;

  $sql = "SELECT ".$att." FROM cars WHERE car_id = ".$id;

  $result = $conn->query($sql);
  $r = $result->fetch_assoc();

  echo $r[$att];
}
elseif ($mode == 'logo')
{
  $sql = "SELECT logo FROM config WHERE id = 1";

  $result = $conn->query($sql);
  $r = $result->fetch_assoc();

  echo $r['logo'];
}

?>
