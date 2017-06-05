<?php include '_connect.php'; ?>
<!-- Insert Modal -->
<div id="Insert_modal" class="modal fade" role="dialog">
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
          <div class="row" style="margin-left:10px;margin-right:10px;">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class='requestfield'>*</span> คำนำหน้าชื่อ : </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
              <?php
              $sql = "select * from title_name ORDER BY title_name ASC";
              $result = $conn->query($sql);
              echo "<select class='form-control' name='title_name' style='width:100px;'>";
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
          <div class="row" style="margin-left:10px;margin-right:10px;">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="requestfield">*</span> ชื่อ-นามสกุล : </label>
              <div class="col-md-7 col-sm-6 col-xs-10">
              <input type="text" class="form-control" name="user_name" id="user_name" value="" required>
              </div>
            </div>
          </div>
          <!-- อีเมลล์ -->
          <div class="row" style="margin-left:10px;margin-right:10px;">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email"><span class="requestfield">*</span> อีเมลล์ : </label>
              <div class="col-md-7 col-sm-6 col-xs-10">
              <input type="email" name="email" class="form-control" value="" required>
              </div>
            </div>
          </div>
          <!-- เบอร์โทรศัพท์ -->
          <div class="row" style="margin-left:10px;margin-right:10px;">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="requestfield">*</span> เบอร์โทรศัพท์ : </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="tel" name="phonenumber" class="form-control" value="" maxlength="15" style="width:150px" required>
              </div>
            </div>
          </div>
          <!-- หน่วยงาน -->
          <?php
          switch ($_SESSION['user_type']) {
            case 'เจ้าหน้าที่ดูแลระบบ':
              echo "
              <div class='row' style='margin-left:10px;margin-right:10px;'>
                <div class='form-group'>
                  <label class='control-label col-md-3 col-sm-3 col-xs-12'><span class='requestfield'>*</span> หน่วยงาน : </label>
                  <div class='col-md-9 col-sm-9 col-xs-12'>";

                  $sql = "select * from department ORDER BY department_name ASC";
                  $result = $conn->query($sql);
                  echo "<select class='form-control' name='department' style='width:200px;'>";
                  while ($row=$result->fetch_assoc())
                  {
                    echo "<option values='".$row['department_name']."'>
                    ".$row['department_name']."
                    </option>";
                  }
                  echo "</select>";
              echo "
                  </div>
                </div>
              </div>
              ";
              break;
            case 'ผู้อนุมัติประจำหน่วยงาน ลำดับที่ 1':
              echo "<input type='hidden' name='department' value='".$_SESSION['department']."' />";
              break;
          }
          ?>
          <!-- ตำแหน่ง -->
          <div class="row" style="margin-left:10px;margin-right:10px;">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="requestfield">*</span> ตำแหน่ง : </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
              <?php
              $sql = "select * from position ORDER BY position_name ASC";
              $result = $conn->query($sql);
              echo "<select class='form-control'name='position' style='width:200px;'>";
              while ($row=$result->fetch_assoc()) {
                echo "<option values='".$row['position_name']."'>
                ".$row['position_name']."
                </option>";
              }
              echo "</select>";
              ?>
              </div>
            </div>
          </div>
          <input type="hidden" name="user_type_basic" value="User">
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
<div id="Detail_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ข้อมูลบุคลากร</h4>
      </div>
      <div class="modal-body" id="body_modal">
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>

  </div>
</div>
<!-- END Detail Modal -->

<!-- Edit Modal -->
<div id="Edit_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form class="form-horizontal" action="personnel/edit.php" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">แก้ไขข้อมูลบุคลากร</h4>
      </div>
      <div class="modal-body" id="body_Edit">
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
<div id="Delete_modal" class="modal fade" role="dialog">
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
