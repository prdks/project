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
      <?php include '_navbar.php'; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">สอบถามรถยนต์ว่าง</h3>
                </div>
            </div>
            <!-- searchbox -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                            ค้นหารถยนต์ <i class="fa fa-search fa-fw"></i>
                      </div>

                      <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
                        <div class="panel-body">
                          <!-- วันแรกที่จองใช้ -->
                          <div class="row" style="padding:4px;">
                            <div class="form-group">
                              <label class="control-label col-lg-3 col-md-3 col-sm-4 text-right" style="margin-top:6px;">
                                วันแรกที่จอง :
                              </label>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                  <div class="input-group">
                                    <!-- วันที่เริ่ม  -->
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    <input class="form-control" name="date_start" id="date_start" type="date">
                                  </div>

                              </div>
                            </div>
                          </div>
                          <!-- วันสุดท้ายที่จองใช้ -->
                          <div class="row" style="padding:4px;">
                            <div class="form-group">
                              <label class="control-label col-lg-3 col-md-3 col-sm-4 text-right" style="margin-top:6px;">
                                วันสุดท้ายที่จอง :
                              </label>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                  <div class="input-group">
                                    <!-- วันที่สิ้นสุด  -->
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    <input class="form-control" name="date_end" id="date_end" type="date">
                                  </div>
                              </div>
                            </div>
                          </div>
                          <!-- เวลาที่จองใช้ -->
                          <div class="row" style="padding:4px;">
                            <div class="form-group">
                              <label class="control-label col-lg-3 col-md-3 col-sm-4 text-right" style="margin-top:6px;">
                                ช่วงเวลาเริ่มต้น :
                              </label>
                              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <div class="input-group">
                                    <!-- เวลาเริ่มต้น -->
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                    <input class="form-control" name="time_start" id="time_start" type="time">
                                  </div>
                              </div>
                            </div>
                          </div>
                          <!-- เวลาที่จองใช้ -->
                          <div class="row" style="padding:4px;">
                            <div class="form-group">
                              <label class="control-label col-lg-3 col-md-3 col-sm-4 text-right" style="margin-top:6px;">
                                ช่วงเวลาสิ้นสุด :
                              </label>
                              <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                    <input class="form-control" name="time_end" id="time_end" type="time">
                                  </div>
                              </div>
                            </div>
                          </div>

                          <div class="text-right" style="margin-top:10px;">
                              <button name="query_cars_empty" type="submit" class="btn btn-success"><i class="fa fa-search"></i> แสดงรถยนต์ว่าง</button>
                          </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

              <?php include 'querydata/cars_empty/table.php';  ?>

        </div>
    </div>
</body>
</html>
