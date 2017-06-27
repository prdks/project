<!-- Modal -->
<div id="reserv_approve_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">รายละเอียดการจองรถยนต์</h4>
      </div>
<<<<<<< HEAD
      <form class="form-horizontal" action="reservation/reserve_approve/edit.php" method="post">
      <div class="modal-body">
        <div id="show_reservation_approve"></div>

        <dl class="dl-horizontal">
          <dt>จองใช้เพื่อ :</dt>
          <dd id="show-detail"></dd>
          <br />
          <dt>รถยนต์ที่จอง :</dt>
          <dd id="show-cars"></dd>
          <br />
          <dt>วันที่จอง :</dt>
          <dd id="show-date"></dd>
          <br />
          <dt>รายชื่อผู้โดยสาร :</dt>
          <dd id="show-passenger"></dd>
          <br />
          <dt>สถานที่จะไป :</dt>
          <dd id="show-location"></dd>
          <br />
          <dt>จุดนัดพบ :</dt>
          <dd id="show-meet"></dd>
          <br />
          <dt>ผู้ติดต่อ :</dt>
          <dd id="show-person"></dd>
          <br />
          <dt>เบอร์โทรศัพท์ :</dt>
          <dd id="show-phone"></dd>
        </dl>
        <ul class="nav nav-tabs span2 clearfix"></ul>
        <br />

        <!-- ผลการจอง -->
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
            <span class="requestfield">*</span> ผลการจอง :
          </label>
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <select id="show-status" name="status" class="form-control">
              <option value="รออนุมัติ" selected>รออนุมัติ</option>
              <option value="อนุมัติ">อนุมัติ</option>
              <option value="ไม่อนุมัติ">ไม่อนุมัติ</option>
              <option value="ยกเลิก">ยกเลิก</option>
            </select>
          </div>
        </div>
        <!-- หมายเหตุ -->
        <div class="form-group">
          <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
            <span class="requestfield">*</span> หมายเหตุการอนุมัติ :
          </label>
          <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
          <textarea  rows="3" type="text" class="form-control" id="note_area" name="note"
          placeholder="พิมพ์หมายเหตุการอนุมัติ" style="resize:none;"></textarea>
          </div>
        </div>
        <input type="hidden" id="reserve_id" name="reserve_id" value="">
=======
      <form class="form-horizontal" action="index.html" method="post">
      <div class="modal-body">
        <div id="show_reservation_approve"></div>


>>>>>>> 99f409bad9fca3eecbbcd3c5aa6dd66e21f751f6
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary">บันทึก</button>
      </div>
      </form>
    </div>

  </div>
</div>
