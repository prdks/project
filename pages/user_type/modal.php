<!-- Insert Modal -->
<div id="Insert_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">เพิ่มข้อมูลประเภทผู้ใช้งาน</h4>
      </div>
      <form id="form_insert_usertype" class="form-horizontal">
      <div class="modal-body">
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
            <span class="requestfield">*</span> ประเภทผู้ใช้งาน :
          </label>
          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <input type="text" class="form-control" id="user_type_name"
            name="user_type_name" placeholder="พิมพ์ข้อมูลประเภทผู้ใช้งาน" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
            <span class="requestfield">*</span> ระดับผู้ใช้งาน :
          </label>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <input type="number" class="form-control" id="user_level"
            name="level" min="-1" max="50" placeholder="0" required>
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
<div id="Edit_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">แก้ไขข้อมูลประเภทผู้ใช้งาน</h4>
      </div>
      <form id="form_edit_usertype" class="form-horizontal">
      <div class="modal-body">
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
            <span class="requestfield">*</span> ประเภทผู้ใช้งาน :
          </label>
          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <input type="text" class="form-control" id="show_update"
            name="txt_update" placeholder="พิมพ์ข้อมูลประเภทผู้ใช้งาน" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
            <span class="requestfield">*</span> ระดับผู้ใช้งาน :
          </label>
          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <input type="number" class="form-control" id="show_level"
            name="txt_level" min="-1" max="50" placeholder="0" required>
          </div>
        </div>
        <input type="hidden" id="update_id" name="update_id" value="">
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
<div id="Delete_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <form id="form_delete_usertype" class="form-horizontal">
        <div class="modal-body">
          <div class="form-group text-center">
              <br />
              <p>คุณต้องการลบข้อมูลนี้ใช่หรือไม่</p>
              <b><p id="show_delete"></p></b>
          </div>
          <input type="hidden" id="delete_id" name="delete_id" value="">
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
