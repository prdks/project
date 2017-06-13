<?php
$type = $_SESSION['user_type'];
// ----------------------------------------------------------------
$sql = "
SELECT COUNT(reservation_id) as reservecout
FROM reservation
WHERE reservation_status = 'รออนุมัติ'
";
$result = $conn->query($sql);
$row = $result->fetch_array();
$num_approve = $row['reservecout'];
// ----------------------------------------------------------------

switch ($type) {
  case 'เจ้าหน้าที่ดูแลระบบ':
    {
      echo "
      <li><a href='index.php'><i class='fa fa-calendar fa-fw'></i> ปฏิทินการจองใช้รถยนต์</a></li>
      <li><a href='reservation.php'><i class='fa fa-edit fa-fw'></i> การจองรถยนต์</a></li>
      <li>
          <a href='#'><i class='fa fa-search fa-fw'></i> ค้นหาข้อมูล<span class='fa arrow'></span></a>
          <ul class='nav nav-second-level'>
          <li><a href='cars_empty.php'>สอบถามรถยนต์ว่าง</a></li>
          <li><a href='cars_detail.php'>ดูรายละเอียดรถยนต์</a></li>
          <li><a href='reserve_list.php'>รายการจองและใช้รถยนต์</a></li>
          </ul>
      </li>
      <li>
          <a href='#'><i class='fa fa-star fa-fw'></i> ประจำวัน<span class='fa arrow'></span></a>
          <ul class='nav nav-second-level'>
          <li><a href='reserve_approve.php'>รายการรออนุมัติการจอง <span class='badge pull-right'>".$num_approve."</span></a></li>
          </ul>
      </li>
      <li>
          <a href='#'><i class='fa fa-folder fa-fw'></i> การจัดการข้อมูล<span class='fa arrow'></span></a>
          <ul class='nav nav-second-level'>
          <li><a href='personnel.php'>ข้อมูลบุคลากร</a></li>
          <li><a href='cars.php'>ข้อมูลรถยนต์</a></li>
          <li><a href='reserve_ma.php'>ข้อมูลการจองและการใช้รถยนต์</a></li>
          </ul>
      </li>
      <li>
          <a href='#'><i class='fa fa-database fa-fw'></i> การจัดการข้อมูลพื้นฐาน<span class='fa arrow'></span></a>
          <ul class='nav nav-second-level'>
            <li><a href='title_name.php'>ข้อมูลคำนำหน้าชื่อ</a></li>
            <li><a href='position.php'>ข้อมูลตำแหน่ง</a></li>
            <li><a href='department.php'>ข้อมูลหน่วยงาน</a></li>
            <li><a href='user_type.php'>ข้อมูลประเภทผู้ใช้งาน</a></li>
            <li><a href='car_brand.php'>ข้อมูลยี่ห้อรถยนต์</a></li>
          </ul>
      </li>
        ";
    }
    break;
  case 'ผู้ใช้งานทั่วไป':
    {
      echo "
      <li><a href='index.php'><i class='fa fa-calendar fa-fw'></i> ปฏิทินการจองใช้รถยนต์</a></li>
      <li><a href='reservation.php'><i class='fa fa-edit fa-fw'></i> การจองรถยนต์</a></li>
      <li>
      <a href='#'><i class='fa fa-search fa-fw'></i> ค้นหาข้อมูล<span class='fa arrow'></span></a>
      <ul class='nav nav-second-level'>
      <li><a href='cars_empty.php'>สอบถามรถยนต์ว่าง</a></li>
      <li><a href='cars_detail.php'>ดูรายละเอียดรถยนต์</a></li>
      <li><a href='reserve_list.php'>รายการจองและใช้รถยนต์</a></li>
      </ul>
      </li>
      ";
    }
    break;
  case 'พนักงานขับรถยนต์':
    {
      echo "
      <li><a href='index.php'><i class='fa fa-calendar fa-fw'></i> ปฏิทินการจองใช้รถยนต์</a></li>
      <li><a href='reservation.php'><i class='fa fa-edit fa-fw'></i> การจองรถยนต์</a></li>
      <li>
          <a href='#'><i class='fa fa-search fa-fw'></i> ค้นหาข้อมูล<span class='fa arrow'></span></a>
          <ul class='nav nav-second-level'>
            <li><a href='cars_empty.php'>สอบถามรถยนต์ว่าง</a></li>
            <li><a href='cars_detail.php'>ดูรายละเอียดรถยนต์</a></li>
            <li><a href='reserve_list.php'>รายการจองและใช้รถยนต์</a></li>
          </ul>
      </li>
      ";
    }
    break;
  case 'พนักงานรักษาความปลอดภัย':
    {
      echo "
      <li><a href='index.php'><i class='fa fa-calendar fa-fw'></i> ปฏิทินการจองใช้รถยนต์</a></li>
      <li><a href='reservation.php'><i class='fa fa-edit fa-fw'></i> การจองรถยนต์</a></li>
      <li>
        <a href='#'><i class='fa fa-search fa-fw'></i> ค้นหาข้อมูล<span class='fa arrow'></span></a>
        <ul class='nav nav-second-level'>
          <li><a href='cars_empty.php'>สอบถามรถยนต์ว่าง</a></li>
          <li><a href='cars_detail.php'>ดูรายละเอียดรถยนต์</a></li>
          <li><a href='reserve_list.php'>รายการจองและใช้รถยนต์</a></li>
        </ul>
      </li>
      ";
    }
    break;
  case strpos($type, 'ผู้อนุมัติประจำหน่วยงาน'):
    {
      $sql = "
      SELECT user_type_name
      FROM user_type
      WHERE user_type_name LIKE 'ผู้อนุมัติประจำหน่วยงาน%'
      ORDER BY user_type_name ASC
      ";
      $result = $conn->query($sql);
      $result_row = mysqli_num_rows($result);

      $arr_approve = array();
      $i = 0;

      while($row = $result->fetch_array()){
        $arr_approve[$i] = $row['user_type_name'];
        $i++;
      }

      $arrlength = count($arr_approve);

      for($x = 0; $x < $arrlength; $x++) {
        if ($type === $arr_approve[$x]) {
          echo "
          <li><a href='index.php'><i class='fa fa-calendar fa-fw'></i> ปฏิทินการจองใช้รถยนต์</a></li>
          <li><a href='reservation.php'><i class='fa fa-edit fa-fw'></i> การจองรถยนต์</a></li>
          <li>
              <a href='#'><i class='fa fa-search fa-fw'></i> ค้นหาข้อมูล<span class='fa arrow'></span></a>
              <ul class='nav nav-second-level'>
              <li><a href='cars_empty.php'>สอบถามรถยนต์ว่าง</a></li>
              <li><a href='cars_detail.php'>ดูรายละเอียดรถยนต์</a></li>
              <li><a href='reserve_list.php'>รายการจองและใช้รถยนต์</a></li>
              </ul>
          </li>
          <li>
              <a href='#'><i class='fa fa-folder fa-fw'></i> การจัดการข้อมูล<span class='fa arrow'></span></a>
              <ul class='nav nav-second-level'>
                <li><a href='personnel.php'>ข้อมูลบุคลากร</a></li>
                <li><a href='cars.php'>ข้อมูลรถยนต์</a></li>
                <li><a href='reserve_ma.php'>ข้อมูลการจองและการใช้รถยนต์</a></li>
              </ul>
          </li>
            ";
        }
      }
    }
    break;
  default:
    {
      echo "
      <!DOCTYPE html>
      <script>
      function redir()
      {
      alert('เข้าสู่ระบบไม่ถูกต้อง');
      sessionStorage.clear();
      window.location.assign('index.php');
      }
      </script>
      <body onload='redir();'></body>
      ";
    }
    break;
}
?>
