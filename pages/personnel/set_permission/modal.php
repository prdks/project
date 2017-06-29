<!-- Detail Modal -->
<div id="Set_permission_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ข้อมูลบุคลากร</h4>
      </div>
      <form class="form-horizontal" action="personnel/set_permission/edit.php" method="post">
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
          <br />
        </dl>
        <ul class="nav nav-tabs span2 clearfix"></ul>
        <br />
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
            <span class="requestfield">*</span> เลือกประเภทผู้ใช้งาน :
          </label>
          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <select id="show-usertype" name="user_type" class="form-control">
              <?php
              $sql = "
              SELECT t.* from user_type t
              order by user_level ASC ";

              $result = $conn->query($sql);
              while($row = $result->fetch_assoc()){
                ?>
                <option value="<?php echo $row['user_type_name'];?>"><?php echo $row['user_type_name'];?></option>
                <?php
              }
              ?>
            </select>
          </div>
          <input type="hidden" id="show-id" name="id" value="">
        </div>

      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary">บันทึก</button>
      </div>
    </form>

    </div>
  </div>
</div>
<!-- END Detail Modal -->
