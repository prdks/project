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
                <h3 class="page-header">บันทึกขออนุมัติใช้รถยนต์</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                    <section>
                        <div class="wizard">
                            <div class="wizard-inner">
                                <div class="connecting-line"></div>
                                <ul class="nav nav-tabs" role="tablist">

                                    <li role="presentation" class="active">
                                        <a data-toggle="tooltip" title="รายละเอียดการขออนุมัติ">
                                            <span class="round-tab">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li role="presentation" class="disabled">
                                        <a data-toggle="tooltip" title="เลือกรถยนต์">
                                            <span class="round-tab">
                                                <i class="fa fa-car"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li role="presentation" class="disabled">
                                        <a data-toggle="tooltip" title="เพิ่มผู้โดยสาร">
                                            <span class="round-tab">
                                                <i class="fa fa-users"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li role="presentation" class="disabled">
                                        <a data-toggle="tooltip" title="เสร็จสิ้น">
                                            <span class="round-tab">
                                                <i class="glyphicon glyphicon-ok"></i>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                              <div class="tab-content">
                                <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxx STEP 1 xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                  <form id="formdetail" class="form-horizontal">
                                    <?php include 'reservation/reserve_form/DetailForm.php' ?>
                                  <ul class="list-inline pull-right">
                                      <li><button id="btnDetail" type="button" class="btn btn-primary next-step">ถัดไป</button></li>
                                  </ul>
                                  </form>
                                </div>
                                <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxx STEP 2 xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
                                  <div class="tab-pane" role="tabpanel" id="step2">
                                    <form id="formselectcars">
                                      <div class="row" style="padding:4px;">
                                        <div class="col-lg-12">
                                          <div class="panel panel-primary">
                                            <div class="panel-heading">เลือกรถยนต์ที่ต้องการจองใช้</div>
                                              <div class="table-responsive">
                                                  <table id="Table_Cars" class="table table-condensed table-striped table-bordered table-hover">
                                                    <thead id="Tb_Cars">
                                                      <tr>
                                                        <th id="tb_option">เลือก</th>
                                                        <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
                                                        <th id="tb_detail_sub-six">ยี่ห้อรถยนต์</th>
                                                        <th id="tb_detail_sub-six">รุ่นรถยนต์</th>
                                                        <th id="tb_detail_sub-six" class="text-center">จำนวนที่นั่ง</th>
                                                        <th id="tb_detail_main">ผู้ดูแล</th>
                                                        <th id="tb_detail_main">หน่วยงาน</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody id="tbody_cars">
                                                    </tbody>
                                                  </table>
                                              </div>

                                          </div>
                                        </div>
                                      </div>
                                      <ul class="list-inline pull-right">
                                          <li><button id="btnSelectCars" type="button" class="btn btn-default prev-step" href="#step1">ย้อนกลับ</button></li>
                                          <li><button id="btnSelectCars" type="button" class="btn btn-primary next-step">ถัดไป</button></li>
                                      </ul>
                                    </form>
                                  </div>
                                  <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxx STEP 3 xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
                                  <div class="tab-pane" role="tabpanel" id="step3">
                                    <div class="row">
                                      <!-- ใส่ข้อมูลค้นหาบุคลากร -->
                                      <form class="form-inline col-lg-12">
                                        <div class="form-group">
                                          <label for="email">เพิ่มผู้โดยสาร : </label>
                                        </div>
                                        <div class="form-group">
                                          <label class="radio-inline">
                                            <input type="radio" name="select_mode" value=1>
                                            เลือกจากรายชื่อในระบบ
                                          </label>
                                        </div>
                                        <div class="form-group">
                                          <label class="radio-inline">
                                            <input type="radio" name="select_mode" value=2>
                                            กำหนดรายชื่อเอง
                                          </label>
                                        </div>

                                      </form>

                                      <div id="getPersonFromDB" class="col-lg-12">
                                        <div class="panel panel-default">
                                          <div class="panel-heading">
                                            รายชื่อบุคลากร
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pull-right">
                                              <input type="text" class="form-control input-sm" id="search_input" onkeyup="filtertable()" placeholder="พิมพ์เพื่อค้นหา">
                                            </div>
                                          </div>

                                            <div id="Table_sPersonnel" class="table-responsive">
                                              <table id="TablePersonnelList" class="table table-condensed table-bordered table-hover">
                                                <thead id="Tb_sPersonnel">
                                                  <tr>
                                                    <th id="tb_option">เพิ่ม</th>
                                                    <th id="tb_detail_main">ชื่อบุคลากร</th>
                                                    <th id="tb_detail_sub-nd">หน่วยงาน</th>
                                                  </tr>
                                                </thead>
                                                <tbody id="tbody_sPersonnel">
                                                <?php
                                                $sql = "
                                                SELECT t.*, p.*, po.* , d.* FROM personnel p
                                                LEFT JOIN title_name t
                                                ON p.title_name_id = t.title_name_id
                                                LEFT JOIN position po
                                                ON p.position_id = po.position_id
                                                LEFT JOIN department d
                                                ON p.department_id = d.department_id
                                                WHERE position_name <> 'คนขับรถยนต์' AND position_name <> 'เจ้าหน้าที่รักษาความปลอดภัย'
                                                AND personnel_name <> '".$_SESSION['user_name']."'
                                                ORDER BY department_name ASC
                                                ";
                                                $result = $conn->query($sql);
                                                $result_row = mysqli_num_rows($result);
                                                if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
                                                {
                                                  while($row = $result->fetch_assoc())
                                                  {
                                                    echo "
                                                    <tr>
                                                    <td>
                                                    <center><button id='BTNInsertPassenger' type='button' class='btn btn-primary btn-xs'
                                                    name='btn[]' value='".$row['personnel_name']."'>เพิ่ม</button></center>
                                                    </td>
                                                    <td>".$row['title_name'].$row['personnel_name']."</td>
                                                    <td class='text-center'>".$row['department_name']."</td>
                                                    </tr>
                                                    ";
                                                  }
                                                }else {
                                                  echo "<tr><td colspan='4'>ไม่มีข้อมูลบุคลากร</td></tr>";
                                                }
                                                ?>
                                                </tbody>
                                              </table>
                                            </div>
                                        </div>
                                      </div>

                                      <div id="InsetPerson" class="col-lg-12">
                                        <div class="panel panel-default">
                                          <div class="panel-heading">
                                            เพิ่มรายชื่อกำหนดเอง
                                          </div>
                                          <div class="panel-body">
                                            <form class="form-horizontal">
                                              <!-- คำนำหน้าชื่อ -->
                                              <div class="form-group">
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                                                  <span class="requestfield">*</span> คำนำหน้าชื่อ :
                                                </label>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                  <?php
                                                  $sql = "select * from title_name ORDER BY title_name ASC";
                                                  $result = $conn->query($sql);
                                                  echo "<select class='form-control' id='select_title_name'>";
                                                  while ($row=$result->fetch_assoc()) {
                                                    echo "<option values='".$row['title_name']."'>
                                                    ".$row['title_name']."
                                                    </option>";
                                                  }
                                                  echo "</select>";
                                                  ?>
                                                </div>
                                              </div>
                                              <!-- ชื่อนามสกุล -->
                                              <div class="form-group">
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                                                  <span class="requestfield">*</span> ชื่อ-นามสกุล :
                                                </label>
                                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                  <input  type="text"  class="form-control" id="person_name"
                                                  placeholder="พิมพ์ชื่อ-นามสกุล" required/>
                                                </div>
                                              </div>
                                              <!-- หน่วยงาน -->
                                              <div class="form-group">
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                                                  หน่วยงาน :
                                                </label>
                                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                                  <?php
                                                  $sql = "select * from department ORDER BY department_name ASC";
                                                  $result = $conn->query($sql);
                                                  echo "<select class='form-control' id='select_department'>";
                                                  echo "<option values='0' selected>ไม่ระบุ</option>";
                                                  while ($row=$result->fetch_assoc())
                                                  {
                                                    echo "<option values='".$row['department_name']."'>
                                                    ".$row['department_name']."
                                                    </option>";
                                                  }
                                                  echo "</select>";
                                                  ?>
                                                </div>
                                              </div>
                                            </form>

                                          </div>
                                          <div class="panel-footer">
                                            <div class="row text-right" style="padding-right:15px;">
                                              <button class="btn btn-success" id="insertPassengerList">เพิ่ม</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                      <!-- ตารางผู้โดยสารที่โดนเลือก -->
                                      <div class="col-lg-12">
                                        <div class="panel panel-primary">
                                          <div class="panel-heading">รายชื่อผู้โดยสาร</div>

                                            <div id="EmptyPassenger">
                                              <br />
                                              <p class="text-center">ไม่มีข้อมูลผู้โดยสารที่เลือก</p>
                                              <br />
                                            </div>

                                            <div id="Table_Passenger" class="table-responsive">
                                                <table id="PassengerListTable" class="table table-condensed table-striped table-bordered table-hover">
                                                  <thead id="Tb_Passenger">
                                                    <tr>
                                                      <th id="tb_option">ลบ</th>
                                                      <th id="tb_detail_main">ชื่อบุคลากร</th>
                                                      <th id="tb_detail_sub-nd">หน่วยงาน</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody id="tbody_Passenger">
                                                  </tbody>
                                                </table>
                                            </div>

                                        </div>
                                      </div>
                                    <!-- #Row -->
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button id="btnInsertPassenger" type="button" class="btn btn-default prev-step">ย้อนกลับ</button></li>
                                        <li><button id="btnInsertPassenger" type="button" class="btn btn-primary next-step">ถัดไป</button></li>
                                    </ul>
                                  </div>
                                  <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxx Complete Preview xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
                                  <div class="tab-pane" role="tabpanel" id="complete">
                                    <form action="reserve_list.php" onsubmit="insertReservation();" method="post">
                                      <?php include 'reservation/reserve_form/completeForm.php'; ?>
                                      <!-- <div id="divCompletePage">
                                      </div> -->
                                      <br />
                                      <br />
                                      <ul class="list-inline pull-right">
                                          <li><button id="btnComplet" type="button" class="btn btn-default prev-step">ย้อนกลับ</button></li>
                                          <li><button id="completed" type="submit" class="btn btn-success">บันทึกการจอง</button></li>
                                      </ul>
                                    </form>
                                  </div>
                                  <div class="clearfix"></div>
                              </div>
                        </div>
                    </section>
              </div>
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

</body>
</html>
