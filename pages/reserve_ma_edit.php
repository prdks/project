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
                    SELECT * FROM reservation r
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

                    <form class="form-horizontal">
                      <div class="panel-body">
                        <input type="hidden" name="id" value="<?php echo $row['reservation_id']?>">
                        <!-- ชิ้อผู้ทำรายการ -->
                        <div class="form-group">
                          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                            ชื่อผู้ขออนุมัติ :
                          </label>
                          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <input  type="text"  class="form-control" name="user_name" value="<?php echo $row['title_name'].' '.$row['personnel_name']?>" required readonly/>
                          </div>
                        </div>
                        <!-- ตำแหน่ง -->
                        <div class="form-group">
                          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                            ตำแหน่ง :
                          </label>
                          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <input  type="text"  class="form-control" name="user_position" value="<?php echo $row['position_name']?>" required readonly/>
                          </div>
                        </div>
                        <!-- รายละเอียดความประสงค์ -->
                        <div class="form-group">
                          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                            <span class="requestfield">*</span> ความประสงค์ขอใช้รถยนต์ :
                          </label>
                          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <textarea  rows="5" type="text" class="form-control" name="detail"
                            placeholder="พิมพ์รายละเอียดความประสงค์ขอใช้รถยนต์" required><?php echo $row['requirement_detail']?></textarea>
                          </div>
                        </div>
                        <!-- วันแรกที่จองใช้ -->
                        <div class="form-group">
                          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                            <span class="requestfield">*</span> วันแรกที่ต้องการจอง :
                          </label>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="input-group">
                              <!-- วันที่เริ่ม  -->
                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              <input class="form-control" name="date_start" id="dp-fistdate" type="date" value="<?php echo $row['date_start']?>" required>
                            </div>
                          </div>
                        </div>
                        <!-- วันสุดท้ายที่จองใช้ -->
                        <div class="form-group">
                          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                            <span class="requestfield">*</span> วันสุดท้ายที่ต้องการจอง :
                          </label>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="input-group">
                              <!-- วันที่สิ้นสุด  -->
                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              <input class="form-control" name="date_end" id="dp-lastdate" type="date" value="<?php echo $row['date_end']?>" required>
                            </div>
                          </div>
                        </div>
                        <!-- เวลาที่จองใช้ -->
                        <div class="form-group">
                          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                            <span class="requestfield">*</span> ช่วงเวลาเริ่มต้น :
                          </label>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="input-group">
                              <!-- เวลาเริ่มต้น -->
                              <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                              <input class="form-control" name="time_start" id="dp-timestart" type="time" value="<?php echo $row['reserv_stime']?>" required>
                            </div>
                          </div>
                        </div>
                        <!-- เวลาที่จองใช้ -->
                        <div class="form-group">
                          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                            <span class="requestfield">*</span> ช่วงเวลาสิ้นสุด :
                          </label>
                          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="input-group">
                              <!-- เวลาสิ้นสุด -->
                              <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                              <input class="form-control" name="time_end" id="dp-timeend" type="time" value="<?php echo $row['reserv_etime']?>" required>
                            </div>
                          </div>
                        </div>
                        <!-- สถานที่ต้องการไป -->
                        <div class="form-group">
                          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                            <span class="requestfield">*</span> สถานที่ต้องการไป :
                          </label>
                          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                              <div class="panel panel-default">
                                <div class="panel-heading">รายชื่อสถานที่
                                  <div class="pull-right">
                                    <a href="edit_location.php?id=<?php echo $id;?>">
                                      <span class="fa fa-edit"></span> แก้ไขข้อมูล
                                    </a>
                                  </div>
                                </div>
                                  <?php
                                  $id = $_GET['id'];

                                  $sql = "
                                  SELECT * FROM location l
                                  LEFT JOIN reservation r
                                  ON l.reservation_id = r.reservation_id
                                  WHERE l.reservation_id = ".$id."
                                  ORDER BY l.province ASC";

                                  $result = $conn->query($sql);

                                  ?>
                                  <div class="table-responsive">
                                  <table class="table table-striped table-bordered table-hover">
                                      <thead>
                                          <tr>
                                            <th id="tb_sharp">#</th>
                                            <th>จังหวัด</th>
                                            <th>ชื่อสถานที่</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                        $count = 0;
                                        while($row = $result->fetch_assoc())
                                        {
                                          $count++;
                                          ?>
                                        <tr>
                                          <td class="text-center"><?php echo $count; ?></td>
                                          <td><?php echo $row['province'] ?></td>
                                          <td><?php echo $row['location_name']; ?></td>
                                        </tr>
                                        <?php
                                        }
                                          ?>
                                      </tbody>
                                    </table>
                                  </div>
                              </div>

                          </div>
                        </div>
                        <!-- รายชื่อผู้โดยสาร -->
                        <div class="form-group">
                          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                            <span class="requestfield">*</span> ผู้โดยสาร :
                          </label>
                          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">

                              <div class="panel panel-default">
                                <div class="panel-heading">รายชื่อผู้โดยสาร
                                  <div class="pull-right">
                                    <a href="edit_passenger.php?id=<?php echo $id;?>">
                                      <span class="fa fa-edit"></span> แก้ไขข้อมูล
                                    </a>
                                  </div>
                                </div>
                                  <?php
                                  $id = $_GET['id'];

                                  $sql = "
                                  SELECT * FROM passenger p
                                  LEFT JOIN reservation r
                                  ON p.reservation_id = r.reservation_id
                                  LEFT JOIN department d
                                  ON p.department_id = d.department_id
                                  WHERE p.reservation_id = ".$id."
                                  ";

                                  $result = $conn->query($sql);

                                  ?>
                                  <div class="table-responsive">
                                  <table class="table table-striped table-bordered table-hover">
                                      <thead>
                                          <tr>
                                            <th id="tb_sharp">#</th>
                                            <th>ชื่อผู้โดยสาร</th>
                                            <th>หน่วยงาน</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                        $result_row = mysqli_num_rows($result);
                                        if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
                                        {
                                            $count = 0;
                                            while($row = $result->fetch_assoc())
                                            {
                                              $count++;
                                              ?>
                                            <tr>
                                              <td class="text-center"><?php echo $count; ?></td>
                                              <td><?php echo $row['passenger_name'] ?></td>
                                              <td><?php echo $row['department_name']; ?></td>
                                            </tr>
                                            <?php
                                            }

                                        }
                                        else
                                        {
                                          ?>
                                          <tr>
                                            <td colspan="3" class="text-center">ไม่พบรายชื่อผู้โดยสารเพิ่มเติม</td>
                                          </tr>
                                          <?php
                                        }
                                        ?>
                                      </tbody>
                                    </table>
                                  </div>
                              </div>

                          </div>
                        </div>

                      </div>
                      <div class="panel-footer text-right">
                        <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
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

</body>
</html>
