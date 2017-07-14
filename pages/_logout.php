<?php
if ($_GET['key'] === 'enterkl') {
  session_start();
  session_destroy();
  header('Location: qrcode.php');
  exit;
}else {
  session_start();
  session_destroy();
  header('Location: index.php');
  exit;
}
?>
