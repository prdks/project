<?php
switch ($_SESSION['user_type']) {
  case 0:
  {
    include 'reservation/reserve_approve/table-0.php';
  }
    break;
  
  case 4:
  {
    include 'reservation/reserve_approve/table-4.php';
  }
    break;
  case 5:
  {
    include 'reservation/reserve_approve/table-5-6.php';
  }
    break;
  case 6:
  {
    include 'reservation/reserve_approve/table-5-6.php';
  }
    break;
}
?>
