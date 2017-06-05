<!-- Insert Modal -->
<div id="Insert_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">เพิ่มข้อมูลหน่วยงาน</h4>
      </div>
      <form id="insert_department_form" class="form-horizontal" action="department/insert.php" method="post">
      <div class="modal-body">
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
            <span class="requestfield">*</span> ชื่อหน่วยงาน :
          </label>
          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <input type="text" class="form-control" id="department_name"
            name="department_name" placeholder="พิมพ์ข้อมูลหน่วยงาน" required>
          </div>
        </div>
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

<!-- Edit Modal -->
<div id="Edit_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">แก้ไขข้อมูลหน่วยงาน</h4>
      </div>
      <form id="edit_department_form" class="form-horizontal" action="department/edit.php" method="post">
      <div class="modal-body">
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
            <span class="requestfield">*</span> ชื่อหน่วยงาน :
          </label>
          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <input type="text" class="form-control" id="show_update"
            name="str" placeholder="พิมพ์ข้อมูลหน่วยงาน" required>
            <input type="hidden" id="update_id" name="id"/>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
      </div>
      </form>
    </div>

  </div>
</div>
<!-- END Edit Modal -->

<!-- Delete Modal -->
<div id="Delete_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <form id="delete_department_form" class="form-horizontal" action="department/delete.php" method="post">
        <div class="modal-body">
          <div class="form-group text-center">
              <br />
              <p>คุณต้องการลบข้อมูลนี้ใช่หรือไม่</p>
              <b><p id="show_delete"></p></b>
          </div>
          <input type="hidden" id="delete_id" name="id" value="">
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
