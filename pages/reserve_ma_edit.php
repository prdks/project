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
                    <h3 class="page-header">แก้ไขข้อมูลการจองและใช้รถยนต์</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
              <div class="col-lg-12">
                <ul class="breadcrumb">
                  <li><a href="reserve_ma.php">การจัดการข้อมูลการจองและใช้รถยนต์</a></li>
                  <li class="active">แก้ไขข้อมูลการจองและใช้รถยนต์</li>
                </ul>
              </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      รายละเอียดข้อมูลการจองและใช้รถยนต์
                    </div>

                    <?php
                    $id = $_GET['id'];
                    $sql = "
                    SELECT SUBSTRING_INDEX(`real_time_out`,' ',-1) AS timeout,
                    SUBSTRING_INDEX(`real_time_out`,' ',1) AS dateout,
                    SUBSTRING_INDEX(`real_time_in`,' ',-1) AS timein,
                    SUBSTRING_INDEX(`real_time_in`,' ',1) AS datein ,
                    r.* , p.* , po.* , t.*  FROM reservation r
                    LEFT JOIN personnel p
                    ON r.personnel_id = p.personnel_id
                    LEFT JOIN position po
                    ON p.position_id = po.position_id
                    LEFT JOIN title_name t
                    ON p.title_name_id = t.title_name_id
                    WHERE reservation_id = '".$id."'";

                    $result = $conn->query($sql);

                    $row = $result->fetch_assoc();
                    ?>

                    <form class="form-horizontal" action="reservation/reserve_ma/edit.php" method="post">
                      <div class="panel-body">

                        <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#home">ข้อมูลการจอง</a></li>
                          <li><a data-toggle="tab" href="#cars">ข้อมูลรถยนต์</a></li>
                          <li><a data-toggle="tab" href="#passenger">ข้อมูลผู้โดยสาร</a></li>
                          <li><a data-toggle="tab" href="#record">บันทึกเวลาและสถานะ</a></li>
                        </ul>

                        <div class="tab-content">
                          <div id="home" class="tab-pane fade in active">
                            <br>
                            <input type="hidden" name="id" value="<?php echo $row['reservation_id']?>">
                            <div class="pull-right text-danger">
                              (วันที่ทำรายการ : <?php echo DateTimeThai($row['timestamp']); ?>)
                            </div>
                            <br />
                            <?php
                            if ($row['update_status_date'] !== null) {
                            ?>
                            <div class="pull-right" style="color:#777777;">
                              แก้ไขล่าสุด : <?php echo DateTimeThai($row['update_status_date']); ?>
                            </div>
                            <?php
                            }
                            ?>
                            <?php include 'reservation/reserve_ma/detail.php'; ?>
                          </div>
                          <div id="cars" class="tab-pane fade">
                            <br>
                            <?php include 'reservation/reserve_ma/cars.php'; ?>
                          </div>

                          <div id="passenger" class="tab-pane fade">
                            <br>
                            <?php include 'reservation/reserve_ma/passenger.php'; ?>
                          </div>

                          <div id="record" class="tab-pane fade">
                            <br>
                            <?php include 'reservation/reserve_ma/record.php'; ?>
                          </div>
                        </div>



                      </div>
                      <div class="panel-footer text-right">
                        <a href="reserve_ma.php" class="btn btn-default">ยกเลิก</a>
                        <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
<?php include 'reservation/reserve_ma/modal_cars.php'; ?>
</body>
</html>
