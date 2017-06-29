<?php include '_connect.php'; ?>
<!-- Insert Modal -->
<div id="Insert_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">เพิ่มข้อมูลบุคลากร</h4>
      </div>
      <form class="form-horizontal" action="personnel/insert.php" method="post">
      <div class="modal-body">
          <!-- คำนำหน้าชื่อ -->
          <div class="form-group">
            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
              <span class="requestfield">*</span> คำนำหน้าชื่อ :
            </label>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <?php
              $sql = "select * from title_name ORDER BY title_name ASC";
              $result = $conn->query($sql);
              echo "<select class='form-control' name='title_name'>";
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
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
              <input type="text" class="form-control" id="user_name" name="user_name"
               value="" placeholder="พิมพ์ชื่อ-นามสกุล" required>
            </div>
          </div>
          <!-- อีเมลล์ -->
          <div class="form-group">
            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
              <span class="requestfield">*</span> อีเมลล์ :
            </label>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
              <input type="email" name="email" class="form-control"
              value="" placeholder="พิมพ์อีเมลล์" required>
            </div>
          </div>
          <!-- เบอร์โทรศัพท์ -->
          <div class="form-group">
            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
              <span class="requestfield">*</span> เบอร์โทรศัพท์ :
            </label>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <input type="tel" name="phone_number" class="form-control" value=""
              maxlength="15" placeholder="พิมพ์เบอร์โทรศัพท์" required>
            </div>
          </div>
          <!-- หน่วยงาน -->
          <?php
          switch ($_SESSION['user_type']) {
            case 'เจ้าหน้าที่ดูแลระบบ':
              echo "
              <div class='form-group'>
                <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
                  <span class='requestfield'>*</span> หน่วยงาน :
                </label>
                <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>";
                $sql = "select * from department ORDER BY department_name ASC";
                $result = $conn->query($sql);
                echo "<select class='form-control' name='department'>";
                while ($row=$result->fetch_assoc())
                {
                  echo "<option values='".$row['department_name']."'>
                  ".$row['department_name']."
                  </option>";
                }
                echo "</select>
                </div>
              </div>";
              break;
            case 'ผู้อนุมัติประจำหน่วยงาน ลำดับที่ 1':
              echo "<input type='hidden' name='department' value='".$_SESSION['department']."' />";
              break;
          }
          ?>
          <!-- ตำแหน่ง -->
          <div class="form-group">
            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
              <span class="requestfield">*</span> ตำแหน่ง :
            </label>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
              <?php
              $sql = "select * from position ORDER BY position_name ASC";
              $result = $conn->query($sql);
              echo "<select class='form-control'name='position'>";
              while ($row=$result->fetch_assoc()) {
                echo "<option values='".$row['position_name']."'>
                ".$row['position_name']."
                </option>";
              }
              echo "</select>";
              ?>
            </div>
          </div>
          <input type="hidden" name="user_type_basic" value="ผู้ใช้งานทั่วไป">
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary" name="insertBTN">เพิ่มข้อมูล</button>
      </div>
      </form>
    </div>

  </div>
</div>
<!-- END Insert Modal -->

<!-- Detail Modal -->
<div id="Detail_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ข้อมูลบุคลากร</h4>
      </div>
      <div class="modal-body">
        <dl class="dl-horizontal">
          <dt>ชื่อ-นามสกุล :</dt>
          <dd id="show-name"></dd>
          <br />
          <dt>อีเมลล์ :</dt>
          <dd id="show-email"></dd>
          <br />
          <dt>เบอร์โทรศัพท์ :</dt>
          <dd id="show-phone"></dd>
          <br />
          <dt>หน่วยงาน :</dt>
          <dd id="show-department"></dd>
          <br />
          <dt>ตำแหน่ง :</dt>
          <dd id="show-position"></dd>
        </dl>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- END Detail Modal -->

<!-- Edit Modal -->
<div id="Edit_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form class="form-horizontal" action="personnel/edit.php" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">แก้ไขข้อมูลบุคลากร</h4>
      </div>
      <div class="modal-body">
        <!-- คำนำหน้าชื่อ -->
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
            <span class="requestfield">*</span> คำนำหน้าชื่อ :
          </label>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <select class="form-control" id="display-title" name="title_name">
              <?php
              $sql = "select * from title_name ORDER BY title_name ASC";
              $result = $conn->query($sql);
              while($row = $result->fetch_array())
              {
              ?>
              <option value="<?php echo $row['title_name'];?>"><?php echo $row['title_name']; ?></option>
              <?php
              } //end title loop
              ?>
            </select>
          </div>
        </div>
        <!-- ชื่อนามสกุล -->
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
            <span class="requestfield">*</span> ชื่อ-นามสกุล :
          </label>
          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <input type="text" class="form-control" id="display-name" name="user_name"
            placeholder="พิมพ์ชื่อ-นามสกุล" value="">
          </div>
        </div>
        <!-- อีเมลล์ -->
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
            <span class="requestfield">*</span> อีเมลล์ :
          </label>
          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <input type="email" id="display-email" name="email" class="form-control"
            placeholder="พิมพ์อีเมลล์" value="">
          </div>
        </div>
        <!-- เบอร์โทรศัพท์ -->
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
            <span class="requestfield">*</span> เบอร์โทรศัพท์ :
          </label>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <input type="tel" id="display-phone" name="phone_number" class="form-control"
            value="" maxlength="15" placeholder="พิมพ์เบอร์โทรศัพท์">
          </div>
        </div>
        <!-- หน่วยงาน -->
        <?php
        switch ($_SESSION['user_type']) {
          case 'เจ้าหน้าที่ดูแลระบบ':
        ?>
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
            <span class="requestfield">*</span> หน่วยงาน :
          </label>
          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <select class="form-control" id="display-department" name="department">
              <?php
              $sql = "select * from department ORDER BY department_name ASC";
              $result = $conn->query($sql);
              while($row = $result->fetch_array())
              {
              ?>
              <option value="<?php echo $row['department_name'];?>"><?php echo $row['department_name']; ?></option>
              <?php
              } //end department loop
              ?>
            </select>
          </div>
        </div>
        <?php
            break;
        }
        ?>
        <!-- ตำแหน่ง -->
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
            <span class="requestfield">*</span> ตำแหน่ง :
          </label>
          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <select class="form-control" id="display-position" name="position">
              <?php
              $sql = "select * from position ORDER BY position_name ASC";
              $result = $conn->query($sql);
              while($row = $result->fetch_array())
              {
              ?>
              <option value="<?php echo $row['position_name'];?>"><?php echo $row['position_name']; ?></option>
              <?php
              } //end position loop
              ?>
            </select>
          </div>
        </div>
        <input type="hidden" id="display-id" name="id" value="" />
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary" id="edit-btn">แก้ไขข้อมูล</button>
      </div>
    </div>
  </form>
  </div>
</div>
<!-- END Edit Modal -->

<!-- Delete Modal -->
<div id="Delete_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <form id="delete_form" action="personnel/delete.php" method="post">
    <div class="modal-content">
        <div class="modal-body">
        <div class="form-group">
          <p id="respone" name="respone"></p>
        </div>
        </div>
        <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary" id="delete-btn" name="delete-btn">ลบข้อมูล</button>
      </div>
    </div>
    </form>
  </div>
</div>
<!-- END Delete Modal -->
