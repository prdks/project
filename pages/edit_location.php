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
                  <li><a href="reserve_ma_edit.php?id=<?php echo $_GET['id'];?>">แก้ไขข้อมูลการจองและใช้รถยนต์</a></li>
                  <li class="active">แก้ไขข้อมูลสถานที่ต้องการไป</li>
                </ul>
              </div>
            </div>
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-6 col-xs-4">
                <a class='btn btn-success handleAddLocation' role='button' data-toggle="modal" data-target="#Insert_modal" data-id="<?php echo $_GET['id'];?>">
                  เพิ่มข้อมูล
                </a>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
                  <div class="input-group">
                    <input name="search_box" type="text" class="form-control" placeholder="พิมพ์เพื่อค้นหา">
                    <div class="input-group-btn">
                      <button class="btn btn-default handleSearch" name="handleSearch" type="submit">
                        <i class="glyphicon glyphicon-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      ข้อมูลสถานที่ต้องการไป
                    </div>
                    <?php
                    if (isset($_GET['id'])) {
                      $id = $_GET['id'];

                      $sql = "
                      SELECT * FROM location l
                      LEFT JOIN reservation r
                      ON l.reservation_id = r.reservation_id
                      WHERE l.reservation_id = ".$id."
                      ORDER BY l.province ASC";

                      $result = $conn->query($sql);
                      $result_row = mysqli_num_rows($result);
                      ?>
                      <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover">
                          <thead>
                              <tr>
                                <th id="tb_sharp">#</th>
                                <th id="tb_detail_main">จังหวัด</th>
                                <th id="tb_detail_main">ชื่อสถานที่</th>
                                <th id="tb_tools">เครื่องมือ</th>
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
                              <td class="text-center">
                                <button type="button" class="btn btn-warning handleEditLocation" role="button"
                                data-toggle="modal" data-target="#Edit_location_modal" data-id="<?php echo $row["location_id"];?>">
                                  <span class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูล"></span>
                                </button>
                            <?php if ($result_row == 1)
                              {
                                ?>
                                <button class="btn btn-danger handleDeleteLocation" role="button"
                                data-toggle="modal" data-target="#Delete_modal" data-id="<?php echo $row["location_id"];?>" disabled>
                                  <span class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"></span>
                                </button>
                                <?php
                              }
                              else
                              {
                                ?>
                                <button class="btn btn-danger handleDeleteLocation" role="button"
                                data-toggle="modal" data-target="#Delete_modal" data-id="<?php echo $row["location_id"];?>">
                                  <span class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"></span>
                                </button>
                                <?php
                              } ?>

                              </td>
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
                      <p class="text-danger">* หมายเหตุ : ต้องมีข้อมูลสถานที่อย่างน้อย 1 สถานที่</p>
                  </div>

                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include 'reservation/reserve_ma/modal_location.php'; ?>
</body>
</html>
