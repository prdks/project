<?php
include '../vendor/phpqrcode/qrlib.php';
// SVG file format support
// outputs image directly into browser, as PNG stream
   QRcode::png('PHP QR Code :)');
?>
