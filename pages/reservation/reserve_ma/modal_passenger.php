<!-- Insert Modal -->
<div id="insert_pasenger_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">เพิ่มข้อมูลผู้โดยสาร</h4>
      </div>

      <div class="modal-body">

          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#fromsystem">เลือกจากรายชื่อในระบบ</a></li>
            <li><a data-toggle="tab" href="#fromkeys">กำหนดเอง</a></li>
          </ul>

          <div class="tab-content">
            <div id="fromsystem" class="tab-pane fade in active">
              <br>
              <div class="panel panel-default">
                <!-- <div class="panel-heading">รายชื่อบุคลากร
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pull-right">
                    <input type="text" class="form-control input-sm" id="search_input2" onkeyup="filtertable2()" placeholder="พิมพ์เพื่อค้นหา">
                  </div> -->

                  <div class="panel-heading clearfix">
                            
                            <h3 class="panel-title pull-left" style="padding-top: 7.5px;">
                            &nbsp; รายชื่อบุคลากร
                            </h3>
                            
                            <form id="search_passenger_add_rma">
                            <div class="btn-group pull-right">
                              ค้นหาข้อมูล :
                              <input id="search_input2" data-id="<?php echo $_GET['id'];?>" placeholder="พิมพ์เพื่อค้นหา" type="text" placeholder="พิมพ์ข้อความ" class="custom_input">
                              <button class="btn pull-right btn-default" type="submit" style="height: 30px;">
                                <i class="fa fa-search"></i>
                              </button>
                            </div>
                          </form>
                        </div>
                <!-- </div> -->

                <div class="table-responsive tspassenger">
                  <table id="PersonnelTableSelect" class="table table-condensed table-bordered table-hover">
                    <thead id="Tb_sPersonnel">
                      <tr>
                        <th id="tb_option">เมนู</th>
                        <th id="tb_detail_main">ชื่อบุคลากร</th>
                        <th id="tb_detail_sub-nd">หน่วยงาน</th>
                      </tr>
                    </thead>
                      <tbody id="add_passenger_tbody">
                      </tbody>
                    </table>
                </div>

              </div>
            </div>
            <div id="fromkeys" class="tab-pane fade">
              <br />
              <div class="panel panel-default">
                <div class="panel-heading">
                  กำหนดเอง
                </div>
                <div class="panel-body">
                  <form id="add_passenger_rma_form" class="form-horizontal">
                    <input type="hidden" name="resid" value="<?php echo $_GET['id'];?>">
                    <!-- คำนำหน้าชื่อ -->
                    <div class="form-group">
                      <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                        <span class="requestfield">*</span> คำนำหน้าชื่อ :
                      </label>
                      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <?php
                        $sql = "select * from title_name ORDER BY title_name ASC";
                        $result = $conn->query($sql);
                        echo "<select class='form-control' name='title' required>";
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
                        <input  type="text"  class="form-control" name="name"
                        placeholder="พิมพ์ชื่อ-นามสกุล"/ required>
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
                        echo "<select class='form-control' id='select_department' name='dep'>";
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


                </div>

                <div class="panel-footer">
                  <div class="row text-right" style="padding-right:15px;">
                    <button class="btn btn-primary" type="submit">เพิ่ม</button>
                  </div>
                </div>
                </form>
            </div>
          </div>

      </div>

    </div>

  </div>
</div>
</div>
<!-- END Insert Modal -->
<!-- Edit Modal -->
<div id="edit_passenger_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">แก้ไขข้อมูลผู้โดยสาร</h4>
      </div>
      <div class="modal-body">

          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#editfromsystem">เลือกจากรายชื่อในระบบ</a></li>
            <li><a data-toggle="tab" href="#editfromkeys">กำหนดเอง</a></li>
          </ul>

          <div class="tab-content">
            <div id="editfromsystem" class="tab-pane fade in active">
              <br>
              <div class="panel panel-default">
                <div class="panel-heading">รายชื่อบุคลากร
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pull-right">
                    <input type="text" class="form-control input-sm" id="search_input3" onkeyup="filtertable3()" placeholder="พิมพ์เพื่อค้นหา">
                  </div>
                </div>

                <div class="table-responsive tspassenger">
                  <table id="PersonnelTableEdit" class="table table-condensed table-bordered table-hover">
                    <thead id="Tb_sPersonnel">
                      <tr>
                        <th id="tb_option">เมนู</th>
                        <th id="tb_detail_main">ชื่อบุคลากร</th>
                        <th id="tb_detail_sub-nd">หน่วยงาน</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "
                      SELECT * FROM personnel p
                      LEFT JOIN title_name t
                      ON p.title_name_id = t.title_name_id
                      LEFT JOIN position po
                      ON p.position_id = po.position_id
                      LEFT JOIN department d
                      ON p.department_id = d.department_id
                      WHERE personnel_name NOT IN
                      (SELECT SUBSTRING_INDEX(passenger_name,' ',-2)
                      FROM passenger WHERE reservation_id = ".$_GET['id'].")
                      AND personnel_id NOT IN
                      (SELECT personnel_id FROM reservation WHERE reservation_id = ".$_GET['id'].")
                      AND position_name <> 'คนขับรถยนต์' AND position_name <> 'เจ้าหน้าที่รักษาความปลอดภัย'
                      ORDER BY department_name ASC
                      ";

                      $result = $conn->query($sql);
                      $result_row = mysqli_num_rows($result);
                      if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
                      {
                        while($row = $result->fetch_assoc())
                        {
                          ?>
                          <tr>
                          <td>
                            <center>
                              <button type="button" class="btn btn-primary btn-xs handleEditSelectPassenger"
                             data-id="<?php echo $row["personnel_id"];?>" data-old=""
                             data-reservekeys="<?php echo $_GET['id']?>">
                             เลือก
                           </button>
                           </center>
                          </td>
                          <td><?php echo $row["title_name"].$row["personnel_name"]; ?></td>
                          <td class="text-center"><?php echo $row["department_name"]; ?></td>
                          </tr>
                          <?php
                        }
                      }else {
                        echo "<tr><td colspan='4' class='text-center'>ไม่มีข้อมูลบุคลากร</td></tr>";
                      }
                      ?>
                      </tbody>
                    </table>
                </div>

              </div>
            </div>
            <div id="editfromkeys" class="tab-pane fade">
              <br />
              <div class="panel panel-default">
                <div class="panel-heading">
                  กำหนดเอง
                </div>
                <div class="panel-body">
                  <form class="form-horizontal" action="reservation/reserve_ma/edit_passenger.php?reserve_id=<?php echo $_GET['id']?>" method="post">
                    <!-- คำนำหน้าชื่อ -->
                    <div class="form-group">
                      <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                        <span class="requestfield">*</span> คำนำหน้าชื่อ :
                      </label>
                      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <?php
                        $sql = "select * from title_name ORDER BY title_name ASC";
                        $result = $conn->query($sql);
                        echo "<select class='form-control' id='edit_title_name' name='title' required>";
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
                        <input  type="text"  class="form-control" id="edit_person_name" name="name"
                        placeholder="พิมพ์ชื่อ-นามสกุล"/ required>
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
                        echo "<select class='form-control' id='edit_department' name='dep'>";
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
                    <input type="hidden" id="edit-data-old" name="old" value="">
                </div>

                <div class="panel-footer">
                  <div class="row text-right" style="padding-right:15px;">
                    <button class="btn btn-primary" type="submit">แก้ไขข้อมูล</button>
                  </div>
                </div>
                </form>

            </div>
          </div>

      </div>

    </div>
    </div>

  </div>
</div>
<!-- END Edit Modal -->
<!-- Delete Modal -->
<div id="delete_passenger_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <form id="delete_title_form" class="form-horizontal" action="reservation/reserve_ma/delete_passenger.php" method="post">
      <div class="modal-body">
        <div class="form-group text-center">
            <br />
            <p>คุณต้องการลบข้อมูลนี้ใช่หรือไม่</p>
            <b><p id="show_delete"></p></b>
            <b><p id="show_delete2"></p></b>
        </div>
        <input type="hidden" id="delete_id" name="id" value="">
        <input type="hidden" id="reserve_id" name="reserve_id" value="">
      </div>
      <div class="modal-footer">
          <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-primary">ลบข้อมูล</button>
      </div>
      </form>
    </div>

  </div>
</div>
<!-- END Delete Modal -->
