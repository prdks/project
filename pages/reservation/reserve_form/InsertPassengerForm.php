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
