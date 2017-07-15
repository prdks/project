<?php
require '_connect.php';
$i = $_GET['imgindex'];
$id = $_GET['id'];
$att = "picture_".$i;

$sql = "SELECT ".$att." FROM cars WHERE car_id = ".$id;

$result = $conn->query($sql);
$r = $result->fetch_assoc();

echo $r[$att];
?>
