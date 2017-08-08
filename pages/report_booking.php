<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
        // googleAuth.file
        include '_googleauth.php';
      ?>
</head>

<body>
    <div id="wrapper">
      <!-- Navigation -->
      <?php include '_navbar.php'; ?>
      <!-- ./Navigation -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">ออกรายการงานการจองรถยนต์</h3>
                </div>
            </div>
            <?php
            if (!isset($_GET['menu']))
            {
            ?>
            <div class="panel panel-default">
              <div class="panel-heading">เมนูออกรายงานการจองรถยนต์</div>
              <div class="panel-body">
                <a href="report_booking.php?menu=all"><i class="fa fa-tag fa-fw"></i> รายงานจองใช้รถ</a><br>
                <a href="report_booking.php?menu=department"><i class="fa fa-tag fa-fw"></i> รายงานจองใช้รถยนต์-ตามหน่วยงาน</a><br>
                <a href="report_booking.php?menu=reg"><i class="fa fa-tag fa-fw"></i> รายงานจองใช้รถยนต์-ตามเลขทะเบียนรถยนต์</a><br>
                <a href="report_booking.php?menu=driver"><i class="fa fa-tag fa-fw"></i> รายงานจองใช้รถยนต์-ตามพนักงานขับรถ</a>
              </div>
            </div>
            <?php
            }
            else
            {
                switch ($_GET['menu'])
                {
                  case 'all':
                          include 'querydata/reportbooking/report_booking_all.php';
                    break;

                  case 'department':
                          include 'querydata/reportbooking/report_booking_department.php';
                    break;
                  case 'reg':
                          include 'querydata/reportbooking/report_booking_all.php';
                    break;
                  case 'driver':
                          include 'querydata/reportbooking/report_booking_all.php';
                    break;
                }
            }
            ?>
        </div>
        <!-- /#page-wrapper -->

    </div>

    <!-- /#wrapper -->
</body>
</html>