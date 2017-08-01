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
            <!-- searchbox -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                            เรียกดูรายงานการจองรถยนต์ <i class="fa fa-search fa-fw"></i>
                      </div>

                      <form action="<?=$_SERVER['PHP_SELF'];?>" class="form-horizontal" method="POST">
                        <div class="panel-body">
                          <!-- วันแรกที่จองใช้ -->
                          <div class="form-group">
                            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                              วันแรกที่จอง :
                            </label>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                              <div class="input-group">
                                <!-- วันที่เริ่ม  -->
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                <input class="form-control" name="date_start" id="report_date_start" type="date">
                              </div>
                            </div>
                          </div>
                          <!-- วันสุดท้ายที่จองใช้ -->
                          <div class="form-group">
                            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                              วันสุดท้ายที่จอง :
                            </label>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                              <div class="input-group">
                                <!-- วันที่สิ้นสุด  -->
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                <input class="form-control" name="date_end" id="report_date_end" type="date">
                              </div>
                            </div>
                          </div>

                          <div class="text-right" style="margin-top:10px;">
                              <button name="query_report_booking" type="submit" class="btn btn-success"><i class="fa fa-search"></i> แสดงผลลัพธ์</button>
                          </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php include 'querydata/reportbooking/table.php';  ?>

        </div>
        <!-- /#page-wrapper -->

    </div>

    <!-- /#wrapper -->
</body>
</html>
