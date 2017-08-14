<?php
$type = $_SESSION['user_type'];
// ----------------------------------------------------------------
$sql = "
SELECT COUNT(reservation_id) as reservecout
FROM reservation
WHERE reservation_status = 0
";
$result = $conn->query($sql);
$row = $result->fetch_array();
$num_approve = $row['reservecout'];
// ----------------------------------------------------------------

switch ($type) {
  case 0:
    {
      ?>
      <li><a href="index.php"><i class="fa fa-calendar fa-fw"></i> ปฏิทินการจองใช้รถยนต์</a></li>
      <li><a href="reservation.php"><i class="fa fa-edit fa-fw"></i> การจองรถยนต์</a></li>
      <li>
          <a href="#"><i class="fa fa-search fa-fw"></i> ค้นหาข้อมูล<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
          <li><a href="cars_empty.php">สอบถามรถยนต์ว่าง</a></li>
          <li><a href="cars_detail.php">ดูรายละเอียดรถยนต์</a></li>
          <li><a href="reserve_list.php">รายการจองและใช้รถยนต์</a></li>
          </ul>
      </li>
      <li>
            <a href="#"><i class="fa fa-star fa-fw"></i> ประจำวัน<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">

            <li><a href="reserve_approve.php">รายการรออนุมัติการจอง
              <?php
              if ($num_approve != 0)
              {
                ?>
              <span class="badge badge-danger pull-right"><?php echo $num_approve; ?></span>
              <?php
              }
              ?>
            </a></li>
            </ul>
      </li>
      <li>
          <a href="#"><i class="fa fa-file-o fa-fw"></i> การออกรายงาน<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
          <li><a href="report_booking.php">รายงานการจอง</a></li>
          <li><a href="report_usage.php">รายงานการใช้</a></li>
          </ul>
      </li>
      <li>
          <a href="#"><i class="fa fa-folder fa-fw"></i> การจัดการข้อมูล<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
          <li><a href="personnel.php">ข้อมูลบุคลากร</a></li>
          <li><a href="cars.php">ข้อมูลรถยนต์</a></li>
          <li><a href="reserve_ma.php">ข้อมูลการจองและการใช้รถยนต์</a></li>
          </ul>
      </li>
      <li>
          <a href="#"><i class="fa fa-database fa-fw"></i> การจัดการข้อมูลพื้นฐาน<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href="title_name.php">ข้อมูลคำนำหน้าชื่อ</a></li>
            <li><a href="position.php">ข้อมูลตำแหน่ง</a></li>
            <li><a href="department.php">ข้อมูลหน่วยงาน</a></li>
            <li><a href="user_type.php">ข้อมูลประเภทผู้ใช้งาน</a></li>
            <li><a href="car_brand.php">ข้อมูลยี่ห้อรถยนต์</a></li>
          </ul>
      </li>
      <?php
      if ($_SESSION['url_googleform'] != "")
      {
      ?>
      <li class="text-center"><a href="<?php echo $_SESSION['url_googleform'];?>" target="_blank"><i class="fa fa-comments fa-fw"></i> แบบประเมินการปฏิบัติงานของพนักงานขับรถยนต์</a></li>
      <?php
      }
      else
      {
        ?>
        <li class="text-center" >
          <a class="disabled" href="<?php echo $_SESSION['url_googleform'];?>" target="_blank"><i class="fa fa-comments fa-fw"></i> แบบประเมินการปฏิบัติงานของพนักงานขับรถยนต์
          </a>
        </li>
        <?php
      }
    }
    break;
  case 1:
    {
      ?>
      <li><a href="index.php"><i class="fa fa-calendar fa-fw"></i> ปฏิทินการจองใช้รถยนต์</a></li>
      <li><a href="reservation.php"><i class="fa fa-edit fa-fw"></i> การจองรถยนต์</a></li>
      <li>
      <a href="#"><i class="fa fa-search fa-fw"></i> ค้นหาข้อมูล<span class="fa arrow"></span></a>
      <ul class="nav nav-second-level">
      <li><a href="cars_empty.php">สอบถามรถยนต์ว่าง</a></li>
      <li><a href="cars_detail.php">ดูรายละเอียดรถยนต์</a></li>
      <li><a href="reserve_list.php">รายการจองและใช้รถยนต์</a></li>
      </ul>
      </li>
      <?php
      if ($_SESSION['url_googleform'] != "")
      {
      ?>
      <li class="text-center"><a href="<?php echo $_SESSION['url_googleform'];?>" target="_blank"><i class="fa fa-comments fa-fw"></i> แบบประเมินการปฏิบัติงานของพนักงานขับรถยนต์</a></li>
      <?php
      }
    }
    break;
  case 2:
    {
      ?>
      <li><a href="index.php"><i class="fa fa-calendar fa-fw"></i> ปฏิทินการจองใช้รถยนต์</a></li>
      <li><a href="reservation.php"><i class="fa fa-edit fa-fw"></i> การจองรถยนต์</a></li>
      <li>
          <a href="#"><i class="fa fa-search fa-fw"></i> ค้นหาข้อมูล<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href="cars_empty.php">สอบถามรถยนต์ว่าง</a></li>
            <li><a href="cars_detail.php">ดูรายละเอียดรถยนต์</a></li>
            <li><a href="reserve_list.php">รายการจองและใช้รถยนต์</a></li>
          </ul>
      </li>
      <?php
      if ($_SESSION['url_googleform'] != "")
      {
      ?>
      <li class="text-center"><a href="<?php echo $_SESSION['url_googleform'];?>" target="_blank"><i class="fa fa-comments fa-fw"></i> แบบประเมินการปฏิบัติงานของพนักงานขับรถยนต์</a></li>
      <?php
      }
      else
      {
        ?>
        <li class="text-center" >
          <a class="disabled" href="<?php echo $_SESSION['url_googleform'];?>" target="_blank"><i class="fa fa-comments fa-fw"></i> แบบประเมินการปฏิบัติงานของพนักงานขับรถยนต์
          </a>
        </li>
        <?php
      }
    }
    break;
  case 3:
    {
      ?>
      <li><a href="index.php"><i class="fa fa-calendar fa-fw"></i> ปฏิทินการจองใช้รถยนต์</a></li>
      <li><a href="reservation.php"><i class="fa fa-edit fa-fw"></i> การจองรถยนต์</a></li>
      <li>
        <a href="#"><i class="fa fa-search fa-fw"></i> ค้นหาข้อมูล<span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
          <li><a href="cars_empty.php">สอบถามรถยนต์ว่าง</a></li>
          <li><a href="cars_detail.php">ดูรายละเอียดรถยนต์</a></li>
          <li><a href="reserve_list.php">รายการจองและใช้รถยนต์</a></li>
        </ul>
      </li>
      <?php
      if ($_SESSION['url_googleform'] != "")
      {
      ?>
      <li class="text-center"><a href="<?php echo $_SESSION['url_googleform'];?>" target="_blank"><i class="fa fa-comments fa-fw"></i> แบบประเมินการปฏิบัติงานของพนักงานขับรถยนต์</a></li>
      <?php
      }
      else
      {
        ?>
        <li class="text-center" >
          <a class="disabled" href="<?php echo $_SESSION['url_googleform'];?>" target="_blank"><i class="fa fa-comments fa-fw"></i> แบบประเมินการปฏิบัติงานของพนักงานขับรถยนต์
          </a>
        </li>
        <?php
      }
    }
    break;
  case 4:
    {
      ?>
      <li><a href="index.php"><i class="fa fa-calendar fa-fw"></i> ปฏิทินการจองใช้รถยนต์</a></li>
      <li><a href="reservation.php"><i class="fa fa-edit fa-fw"></i> การจองรถยนต์</a></li>
      <li>
          <a href="#"><i class="fa fa-search fa-fw"></i> ค้นหาข้อมูล<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
          <li><a href="cars_empty.php">สอบถามรถยนต์ว่าง</a></li>
          <li><a href="cars_detail.php">ดูรายละเอียดรถยนต์</a></li>
          <li><a href="reserve_list.php">รายการจองและใช้รถยนต์</a></li>
          </ul>
      </li>
      <li>
            <a href="#"><i class="fa fa-star fa-fw"></i> ประจำวัน<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">

            <li><a href="reserve_approve.php">รายการรออนุมัติการจอง
              <?php
              if ($num_approve != 0)
              {
                ?>
              <span class="badge badge-danger pull-right"><?php echo $num_approve; ?></span>
              <?php
              }
              ?>
            </a></li>
            </ul>
      </li>
      <li>
          <a href="#"><i class="fa fa-file-o fa-fw"></i> การออกรายงาน<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
          <li><a href="report_booking.php">รายงานการจอง</a></li>
          <li><a href="report_usage.php">รายงานการใช้</a></li>
          </ul>
      </li>
      <li>
          <a href="#"><i class="fa fa-folder fa-fw"></i> การจัดการข้อมูล<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li><a href="personnel.php">ข้อมูลบุคลากร</a></li>
            <li><a href="cars.php">ข้อมูลรถยนต์</a></li>
            <li><a href="reserve_ma.php">ข้อมูลการจองและการใช้รถยนต์</a></li>
          </ul>
      </li>
      <?php
      if ($_SESSION['url_googleform'] != "")
      {
      ?>
      <li class="text-center"><a href="<?php echo $_SESSION['url_googleform'];?>" target="_blank"><i class="fa fa-comments fa-fw"></i> แบบประเมินการปฏิบัติงานของพนักงานขับรถยนต์</a></li>
      <?php
      }
      else
      {
        ?>
        <li class="text-center" >
          <a class="disabled" href="<?php echo $_SESSION['url_googleform'];?>" target="_blank"><i class="fa fa-comments fa-fw"></i> แบบประเมินการปฏิบัติงานของพนักงานขับรถยนต์
          </a>
        </li>
        <?php
      }
    }
    break;
    case 5:
      {
        ?>
        <li><a href="index.php"><i class="fa fa-calendar fa-fw"></i> ปฏิทินการจองใช้รถยนต์</a></li>
        <li><a href="reservation.php"><i class="fa fa-edit fa-fw"></i> การจองรถยนต์</a></li>
        <li>
            <a href="#"><i class="fa fa-search fa-fw"></i> ค้นหาข้อมูล<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
            <li><a href="cars_empty.php">สอบถามรถยนต์ว่าง</a></li>
            <li><a href="cars_detail.php">ดูรายละเอียดรถยนต์</a></li>
            <li><a href="reserve_list.php">รายการจองและใช้รถยนต์</a></li>
            </ul>
        </li>
        <li>
              <a href="#"><i class="fa fa-star fa-fw"></i> ประจำวัน<span class="fa arrow"></span></a>
              <ul class="nav nav-second-level">

              <li><a href="reserve_approve.php">รายการรออนุมัติการจอง
                <?php
                if ($num_approve != 0)
                {
                  ?>
                <span class="badge badge-danger pull-right"><?php echo $num_approve; ?></span>
                <?php
                }
                ?>
              </a></li>
              </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-file-o fa-fw"></i> การออกรายงาน<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
            <li><a href="report_booking.php">รายงานการจอง</a></li>
            <li><a href="report_usage.php">รายงานการใช้</a></li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-folder fa-fw"></i> การจัดการข้อมูล<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li><a href="personnel.php">ข้อมูลบุคลากร</a></li>
              <li><a href="cars.php">ข้อมูลรถยนต์</a></li>
              <li><a href="reserve_ma.php">ข้อมูลการจองและการใช้รถยนต์</a></li>
            </ul>
        </li>
        <?php
        if ($_SESSION['url_googleform'] != "")
        {
        ?>
        <li class="text-center"><a href="<?php echo $_SESSION['url_googleform'];?>" target="_blank"><i class="fa fa-comments fa-fw"></i> แบบประเมินการปฏิบัติงานของพนักงานขับรถยนต์</a></li>
        <?php
        }
        else
        {
          ?>
          <li class="text-center" >
            <a class="disabled" href="<?php echo $_SESSION['url_googleform'];?>" target="_blank"><i class="fa fa-comments fa-fw"></i> แบบประเมินการปฏิบัติงานของพนักงานขับรถยนต์
            </a>
          </li>
          <?php
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
