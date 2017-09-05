<?php
include '../vendor/phpqrcode/qrlib.php';


$url= "https://".$_SERVER['SERVER_NAME'];
$url .= str_replace("viewqrcode.php", "qrcode.php?id=", $_SERVER['PHP_SELF']).$_GET['id'];
   QRcode::png($url);
?>
