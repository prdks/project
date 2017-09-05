<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
      ?>
      <script src="../dist/js/report.js"></script>
</head>

<body>
    <div id="wrapper">
      <!-- Navigation -->
      <?php include '_navbar.php'; ?>
      <!-- ./Navigation -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">
                      ออกรายการงานการใช้รถยนต์
                      <?php
                      if (isset($_GET['menu']))
                      {
                        switch ($_GET['menu']) {
                          case 'department':
                            echo "- ตามหน่วยงาน";
                            break;
                          case 'reg':
                            echo "- ตามเลขทะเบียนรถยนต์";
                            break;
                        }
                      }
                      ?>
                    </h3>
                </div>
            </div>
            <?php
            if (!isset($_GET['menu']))
            {
            ?>
            <div class="panel panel-default">
              <div class="panel-heading">เมนูออกรายงานการใช้รถยนต์</div>
              <div class="panel-body">
                <a href="report_usage.php?menu=all"><i class="fa fa-tag fa-fw"></i> รายงานใช้รถ</a><br>
                <a href="report_usage.php?menu=department"><i class="fa fa-tag fa-fw"></i> รายงานใช้รถยนต์-ตามหน่วยงาน</a><br>
                <a href="report_usage.php?menu=reg"><i class="fa fa-tag fa-fw"></i> รายงานใช้รถยนต์-ตามเลขทะเบียนรถยนต์</a><br>
              </div>
            </div>
            <?php
            }
            else
            {
                switch ($_GET['menu'])
                {
                  case 'all':
                          include 'querydata/reportusage/report_usage_all.php';
                    break;

                  case 'department':
                          include 'querydata/reportusage/report_usage_department.php';
                    break;
                  case 'reg':
                          include 'querydata/reportusage/report_usage_reg.php';
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
