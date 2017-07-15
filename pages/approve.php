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
                    <h3 class="page-header">รายการรออนุมัติการจอง</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <ul class="breadcrumb">
              <li><a href="reserve_approve.php">รายการรออนุมัติการจอง</a></li>
              <li class="active">ดำเนินการอนุมัติ</li>
            </ul>

            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            รายละเอียดการจอง
                        </div>
                        <div class="panel-body">
                          <?php
                          $id = $_GET['id'];
                          $sql = "
                          SELECT * FROM reservation r
                          LEFT JOIN cars c
                          ON r.car_id = c.car_id
                          LEFT JOIN car_brand b
                          ON c.car_brand_id = b.car_brand_id
                          LEFT JOIN personnel p
                          ON r.personnel_id = p.personnel_id
                          LEFT JOIN title_name t
                          ON p.title_name_id = t.title_name_id
                          WHERE reservation_id = '".$id."'";

                          $result = $conn->query($sql);

                          $row = $result->fetch_assoc();
                          ?>
                          <dl class="dl-horizontal">
                            <dt>จองใช้เพื่อ :</dt>
                            <dd id="show-detail">
                              <?php echo $row['requirement_detail']; ?>
                            </dd>
                            <br />
                            <dt>รถยนต์ที่จอง :</dt>
                            <dd id="show-cars">
                              <?php
                              echo $row['car_reg']." / ยี่ห้อ ".$row['car_brand_name']." / รุ่น ".$row['car_kind']." / ".$row['seat']." ที่นั่ง";
                              ?>
                            </dd>
                            <br />
                            <dt>วันที่ใช้รถยนต์ :</dt>
                            <dd id="show-date">
                              <?php
                              if ($row['date_start'] === $row['date_end']) {
                                 $date = DateThai($row['date_start'])." (วันที่ทำรายการ : ".DateTimeThai($row['timestamp'])."น. )";
                              }else {
                                $date = DateThai($row['date_start'])." ถึง ".DateThai($row['date_end'])." ( วันที่ทำรายการ : ".DateTimeThai($row['timestamp'])."น. )";
                              }
                              echo $date;
                              ?>
                            </dd>
                            <br />
                            <dt>รายชื่อผู้โดยสาร :</dt>
                            <dd id="show-passenger">
                              <?php
                              $sql_department = "
                              SELECT d.* FROM department d
                              LEFT JOIN passenger p
                              ON p.department_id = d.department_id
                              WHERE p.reservation_id = '".$id."'
                              GROUP BY department_name ORDER BY department_name ASC";
                              $result = $conn->query($sql_department);
                              while($r = $result->fetch_assoc()){

                                echo "<b>".$r['department_name']."</b><br />";

                                $sql_passenger ="
                                SELECT * FROM passenger p
                                LEFT JOIN department d
                                ON p.department_id = d.department_id
                                LEFT JOIN reservation r
                                ON p.reservation_id = r.reservation_id
                                WHERE p.department_id = '".$r['department_id']."'
                                AND r.reservation_id = ".$id."
                                ORDER BY passenger_name ASC , department_name ASC";
                                $res = $conn->query($sql_passenger);
                                while($rs = $res->fetch_assoc()){
                                  echo  $rs['passenger_name']."<br />";
                                }

                              }
                              ?>
                            </dd>
                            <br />
                            <dt>สถานที่จะไป :</dt>
                            <dd id="show-location">
                              <?php
                              $sql_province = "
                              SELECT * FROM location l
                              LEFT JOIN reservation r
                              ON l.reservation_id = r.reservation_id
                              WHERE r.reservation_id = ".$id."
                              GROUP BY province ORDER BY province ASC";
                              $result = $conn->query($sql_province);
                              while($r = $result->fetch_assoc()){

                                echo "<b>จังหวัด".$r['province']."</b><br />";

                                $sql_location ="
                                SELECT * FROM location l
                                LEFT JOIN reservation r
                                ON l.reservation_id = r.reservation_id
                                WHERE r.reservation_id = ".$id."
                                AND l.province = '".$r['province']."'
                                ORDER BY location_name ASC";
                                $res = $conn->query($sql_location);
                                while($rs = $res->fetch_assoc()){
                                  echo $rs['location_name']."<br />";
                                }
                              }
                              ?>
                            </dd>
                            <br />
                            <dt>จุดนัดพบ :</dt>
                            <dd id="show-meet">
                              <?php
                              if ($row['appointment_place'] == null) {
                                echo "ยังไม่กำหนด";
                              }else {
                                echo $row['appointment_place'];
                              }
                              ?>
                            </dd>
                            <br />
                            <dt>ผู้ติดต่อ :</dt>
                            <dd id="show-person">
                              <?php echo $row['title_name'].$row['personnel_name']; ?>
                            </dd>
                            <br />
                            <dt>เบอร์โทรศัพท์ :</dt>
                            <dd id="show-phone">
                              <?php echo $row['phone_number']; ?>
                            </dd>
                          </dl>
                        </div>

                </div>
              </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            รายการอนุมัติ
                            <i class="pull-right fa fa-chevron-up"></i>
                        </div>
                        <div class="panel-body">
                          <center>
                            <button class="btn btn-sm btn-success" type="button">อนุมัติ</button>
                            <button class="btn btn-sm btn-danger" type="button">ไม่อนุมัติ</button>
                            <button class="btn btn-sm btn-defualt" type="button">ยกเลิก</button>
                          </center>
                          <br>
                          <ul class="nav nav-tabs span2 clearfix"></ul>
                          <br />

                          <p><i class="fa fa-bookmark"></i> ลำดับการอนุมัติ</p>
                          <?php
                          switch ($_SESSION['user_type']) {
                            case 0:
                            {

                            }
                              break;
                          }
                          ?>
                          <ol>
                            <li>Coffee</li>
                            <li>Coffee</li>
                            <li>Coffee</li>
                          </ol>
                        </div>

                        </div>
                        <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>

</body>
</html>
