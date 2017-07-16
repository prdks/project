<?php
include '../vendor/phpqrcode/qrlib.php';


$url= "https://".$_SERVER['SERVER_NAME']."/qrcode.php?id=".$_GET['id'];
   QRcode::png($url);
?>
