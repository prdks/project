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
                <h3 class="page-header">บันทึกขออนุมัติใช้รถยนยนต์</h3>
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
                                        <a data-toggle="tooltip" title="เพิ่มสถานที่">
                                            <span class="round-tab">
                                                <i class="fa fa-map"></i>
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
                                  <form id="formdetail">
                                    <!-- ชิ้อผู้ทำรายการ -->
                                    <div class="row" style="padding:4px;">
                                      <div class="form-group">
                                        <label class="control-label col-lg-3 col-md-3 col-sm-4 text-right" style="margin-top:6px;">
                                          ชื่อผู้ขออนุมัติ :
                                        </label>
                                        <div class="col-lg-4 col-md-4 col-sm-6 ">
                                          <input  type="text"  class="form-control" name="user_name"
                                          value="<?php echo $_SESSION['title_name']." ".$_SESSION['user_name'] ;?>"
                                          required readonly/>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- ตำแหน่ง -->
                                    <div class="row" style="padding:4px;">
                                      <div class="form-group">
                                        <label class="control-label col-lg-3 col-md-3 col-sm-4 text-right" style="margin-top:6px;">
                                          ตำแหน่ง :
                                        </label>
                                        <div class="col-lg-4 col-md-4 col-sm-6 ">
                                          <input  type="text"  class="form-control" name="user_position"
                                          value="<?php echo $_SESSION['position'] ;?>"
                                          required readonly/>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- รายละเอียดความประสงค์ -->
                                    <div class="row" style="padding:4px;">
                                      <div class="form-group">
                                        <label class="control-label col-lg-3 col-md-3 col-sm-4 text-right" style="margin-top:6px;">
                                          <span class="text-danger">*</span> ความประสงค์ขอใช้รถยนต์ :
                                        </label>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                          <textarea  rows="5" type="text" class="form-control" id="detail" name="detail"
                                          placeholder="พิมพ์รายละเอียดความประสงค์ขอใช้รถยนต์" required></textarea>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- วันแรกที่จองใช้ -->
                                    <div class="row" style="padding:4px;">
                                      <div class="form-group">
                                        <label class="control-label col-lg-3 col-md-3 col-sm-4 text-right" style="margin-top:6px;">
                                          <span class="text-danger">*</span> วันแรกที่ต้องการจอง :
                                        </label>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="input-group">
                                              <!-- วันที่เริ่ม  -->
                                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                              <input class="form-control" name="date_start" id="date_start" type="date" required>
                                            </div>

                                        </div>
                                      </div>
                                    </div>
                                    <!-- วันสุดท้ายที่จองใช้ -->
                                    <div class="row" style="padding:4px;">
                                      <div class="form-group">
                                        <label class="control-label col-lg-3 col-md-3 col-sm-4 text-right" style="margin-top:6px;">
                                          <span class="text-danger">*</span> วันสุดท้ายที่ต้องการจอง :
                                        </label>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="input-group">
                                              <!-- วันที่สิ้นสุด  -->
                                              <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                              <input class="form-control" name="date_end" id="date_end" type="date" required>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- เวลาที่จองใช้ -->
                                    <div class="row" style="padding:4px;">
                                      <div class="form-group">
                                        <label class="control-label col-lg-3 col-md-3 col-sm-4 text-right" style="margin-top:6px;">
                                          <span class="text-danger">*</span> ช่วงเวลาเริ่มต้น :
                                        </label>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                            <div class="input-group">
                                              <!-- เวลาเริ่มต้น -->
                                              <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                              <input class="form-control" name="time_start" id="time_start" type="time" required>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- เวลาที่จองใช้ -->
                                    <div class="row" style="padding:4px;">
                                      <div class="form-group">
                                        <label class="control-label col-lg-3 col-md-3 col-sm-4 text-right" style="margin-top:6px;">
                                          <span class="text-danger">*</span> ช่วงเวลาสิ้นสุด :
                                        </label>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                            <div class="input-group">
                                              <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                              <input class="form-control" name="time_end" id="time_end" type="time" required>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                    <input type="hidden" id="user_department" name="user_department" value="<?php echo $_SESSION['department']?>">
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
                                    <form id="forminsertlocation">
                                      <div class="row" style="padding:4px;">
                                        <!-- ใส่ข้อมูลสถานที่ -->
                                        <div class="col-lg-6">
                                          <div class="panel panel-default">
                                            <div class="panel-heading">เพิ่มสถานที่</div>
                                            <div class="panel-body">

                                              <div class="row" style="padding:4px;">
                                                <div class="form-group">
                                                  <label class="control-label col-lg-12">ชื่อสถานที่</label>
                                                  <div class="col-lg-12">
                                                    <input type="text" id="location_name" class="form-control" placeholder="พิมพ์ชื่อสถานที่ต้องการไป" />
                                                  </div>
                                                </div>
                                              </div>

                                              <div class="row" style="padding:4px;">
                                                <div class="form-group">
                                                  <label class="control-label col-lg-12">จังหวัด</label>
                                                  <div class="col-lg-12">
                                                    <select class="form-control" id="province"></select>
                                                  </div>
                                                </div>
                                              </div>

                                            </div>
                                            <div class="panel-footer">
                                              <div class="row text-right" style="padding-right:15px;">
                                                <button class="btn btn-success handleInsertLocation" id="insertList">เพิ่ม</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        <!-- ตารางสถานที่ -->
                                        <div class="col-lg-6">
                                          <div class="panel panel-primary">
                                            <div class="panel-heading">รายชื่อสถานที่</div>

                                            <div id="EmptyLocation">
                                              <br />
                                              <p class="text-center">ไม่มีข้อมูลรายชื่อสถานที่</p>
                                              <br />
                                            </div>

                                            <div id="Table_Loaction" class="table-responsive">
                                                <table id="LocationListTable" class="table table-condensed table-striped table-bordered table-hover">
                                                  <thead id="Tb_Location">
                                                    <tr>
                                                      <th id="tb_option">ลบ</th>
                                                      <th id="tb_detail_main">ชื่อสถานที่</th>
                                                      <th id="tb_detail_main">จังหวัด</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody class="text-center">
                                                  </tbody>
                                                </table>
                                            </div>

                                          </div>
                                        </div>
                                      </div>
                                      <ul class="list-inline pull-right">
                                          <li><button id="btnInsertLocation" type="button" class="btn btn-default prev-step">ย้อนกลับ</button></li>
                                          <li><button id="btnInsertLocation" type="button" class="btn btn-primary next-step">ถัดไป</button></li>
                                      </ul>
                                    </form>
                                  </div>
                                  <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxx STEP 4 xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->
                                  <div class="tab-pane" role="tabpanel" id="step4">
                                    <div class="row" style="padding:4px;">
                                      <!-- ใส่ข้อมูลค้นหาบุคลากร -->
                                      <div class="col-lg-6">
                                        <label for="email">เพิ่มผู้โดยสาร:</label>
                                        <label class="radio-inline"><input type="radio" name="select_mode" value=1>เลือกจากรายชื่อในระบบ</label>
                                        <label class="radio-inline"><input type="radio" name="select_mode" value=2>กำหนดรายชื่อเอง</label>
                                      </div>

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
                                                    <td>".$row['title_name']." ".$row['personnel_name']."</td>
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

                                            <!-- คำนำหน้าชื่อ -->
                                            <div class="row" style="padding:4px;">
                                              <div class="form-group">
                                                <label class="control-label col-lg-3 col-md-3 col-sm-4 text-right" style="margin-top:6px;">
                                                  คำนำหน้าชื่อ :
                                                </label>
                                                <div class="col-lg-4 col-md-4 col-sm-6 ">
                                                  <?php
                                                  $sql = "select * from title_name ORDER BY title_name ASC";
                                                  $result = $conn->query($sql);
                                                  echo "<select class='form-control' id='select_title_name' style='width:100px;'>";
                                                  while ($row=$result->fetch_assoc()) {
                                                    echo "<option values='".$row['title_name']."'>
                                                    ".$row['title_name']."
                                                    </option>";
                                                  }
                                                  echo "</select>";
                                                  ?>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- ชื่อนามสกุล -->
                                            <div class="row" style="padding:4px;">
                                              <div class="form-group">
                                                <label class="control-label col-lg-3 col-md-3 col-sm-4 text-right" style="margin-top:6px;">
                                                  ชื่อ-นามสกุล :
                                                </label>
                                                <div class="col-lg-4 col-md-4 col-sm-6 ">
                                                  <input  type="text"  class="form-control" id="person_name"  placeholder="พิมพ์ชื่อ-นามสกุล" required/>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- หน่วยงาน -->
                                            <div class="row" style="padding:4px;">
                                              <div class="form-group">
                                                <label class="control-label col-lg-3 col-md-3 col-sm-4 text-right" style="margin-top:6px;">
                                                  ชื่อ-นามสกุล :
                                                </label>
                                                <div class="col-lg-4 col-md-4 col-sm-6 ">
                                                  <?php
                                                  $sql = "select * from department ORDER BY department_name ASC";
                                                  $result = $conn->query($sql);
                                                  echo "<select class='form-control' id='select_department'>";
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
                                            </div>

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
                                      <div id="divCompletePage">
                                      </div>
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
