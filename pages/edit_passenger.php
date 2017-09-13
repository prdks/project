<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
      ?>
      <script src="../dist/js/rma.js"></script>
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
                  <li><a href="reserve_ma_edit.php?id=<?php echo $_GET['id'];?>">แก้ไขข้อมูลการจองและใช้รถยนต์</a></li>
                  <li class="active">แก้ไขข้อมูลผู้โดยสาร</li>
                </ul>
              </div>
            </div>
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-6 col-xs-4">
                <a class='btn btn-success' role='button' data-toggle="modal" data-target="#insert_pasenger_modal">
                  เพิ่มข้อมูล
                </a>
              </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      ข้อมูลผู้โดยสาร
                    </div>
                    <?php
                    if (isset($_GET['id'])) {
                      $id = $_GET['id'];
                      $sql = "
                      SELECT * ,SUBSTRING_INDEX(p.passenger_name,' ',-2) as name
                      , SUBSTRING_INDEX(p.passenger_name,' ',1) as title FROM passenger p
                      LEFT JOIN reservation r
                      ON p.reservation_id = r.reservation_id
                      LEFT JOIN department d
                      ON p.department_id = d.department_id
                      WHERE p.reservation_id = ".$id."
                      ORDER BY department_name ASC
                      , passenger_name ASC";

                      $result = $conn->query($sql);
                      $result_row = mysqli_num_rows($result);
                      ?>
                      <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th id="tb_sharp">#</th>
                              <th id="tb_detail_main">ชื่อผู้โดยสาร</th>
                              <th id="tb_detail_sub-nd">หน่วยงาน</th>
                              <th id="tb_tools">เครื่องมือ</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                          if ($result_row !== 0)
                          {
                            $count = 0;
                            while($row = $result->fetch_assoc())
                            {

                              $count++;
                              ?>
                              <tr>
                                <td class="text-center"><?php echo $count; ?></td>
                                <td><?php echo $row['title'].$row['name']; ?></td>
                                <td>
                                  <?php
                                 if ($row['department_id'] != null) {
                                  echo $row['department_name'];
                                }else {
                                  echo "ไม่ระบุหน่วยงาน";
                                }
                                ?>
                                </td>
                                <td class="text-center">
                                  <button type="button" class="btn btn-warning handleEditPassenger" role="button"
                                  data-toggle="modal" data-target="#edit_passenger_modal" data-id="<?php echo $row["passenger_id"];?>">
                                    <span class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูล"></span>
                                  </button>

                                  <button class="btn btn-danger handleDeletePassenger" role="button"
                                  data-toggle="modal" data-target="#delete_passenger_modal" data-id="<?php echo $row["passenger_id"];?>">
                                    <span class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"></span>
                                  </button>
                                </td>
                              </tr>
                            <?php
                            }
                          }
                          else
                          {
                            ?>
                            <tr>
                              <td colspan="4" class="text-center">ไม่พบรายชื่อผู้โดยสารเพิ่มเติม</td>
                            </tr>
                            <?php
                          }

                              ?>
                          </tbody>
                        </table>
                      </div>
                      <?php
                    }
                    ?>
                      </div>
                  </div>

                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include 'reservation/reserve_ma/modal_passenger.php'; ?>
</body>
</html>
