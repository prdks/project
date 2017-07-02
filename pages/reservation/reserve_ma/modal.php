<!-- Modal -->
<div id="RMA_detail_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">รายละเอียดการจองรถยนต์</h4>
      </div>
      <div class="modal-body">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>

  </div>
</div>

<!-- Edit -->
<div id="RMA_edit_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">แก้ไขรายละเอียดการจองรถยนต์</h4>
      </div>
      <form class="form-horizontal">
        <div class="modal-body">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#detail">รายละเอียดการขออนุมัติ</a></li>
              <li><a data-toggle="tab" href="#cars">รถยนต์</a></li>
              <li><a data-toggle="tab" href="#location">สถานที่</a></li>
              <li><a data-toggle="tab" href="#passenger">ผู้โดยสาร</a></li>
            </ul>

            <div class="tab-content">
              <div id="detail" class="tab-pane fade in active">
                <br />
                <!-- ชิ้อผู้ทำรายการ -->
                <div class="form-group">
                  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                    ชื่อผู้ขออนุมัติ :
                  </label>
                  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <input  type="text"  class="form-control" name="user_name" required readonly/>
                  </div>
                </div>
                <!-- ตำแหน่ง -->
                <div class="form-group">
                  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                    ตำแหน่ง :
                  </label>
                  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <input  type="text"  class="form-control" name="user_position" required readonly/>
                  </div>
                </div>
                <!-- รายละเอียดความประสงค์ -->
                <div class="form-group">
                  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                    <span class="requestfield">*</span> ความประสงค์ขอใช้รถยนต์ :
                  </label>
                  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <textarea  rows="5" type="text" class="form-control" id="detail" name="detail"
                    placeholder="พิมพ์รายละเอียดความประสงค์ขอใช้รถยนต์" required></textarea>
                  </div>
                </div>
                <!-- วันแรกที่จองใช้ -->
                <div class="form-group">
                  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                    <span class="requestfield">*</span> วันแรกที่ต้องการจอง :
                  </label>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="input-group">
                      <!-- วันที่เริ่ม  -->
                      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                      <input class="form-control" name="date_start" id="date_start" type="date" required>
                    </div>
                  </div>
                </div>
                <!-- วันสุดท้ายที่จองใช้ -->
                <div class="form-group">
                  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                    <span class="requestfield">*</span> วันสุดท้ายที่ต้องการจอง :
                  </label>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="input-group">
                      <!-- วันที่สิ้นสุด  -->
                      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                      <input class="form-control" name="date_end" id="date_end" type="date" required>
                    </div>
                  </div>
                </div>
                <!-- เวลาที่จองใช้ -->
                <div class="form-group">
                  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                    <span class="requestfield">*</span> ช่วงเวลาเริ่มต้น :
                  </label>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="input-group">
                      <!-- เวลาเริ่มต้น -->
                      <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                      <input class="form-control" name="time_start" id="time_start" type="time" required>
                    </div>
                  </div>
                </div>
                <!-- เวลาที่จองใช้ -->
                <div class="form-group">
                  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                    <span class="requestfield">*</span> ช่วงเวลาสิ้นสุด :
                  </label>
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="input-group">
                      <!-- เวลาสิ้นสุด -->
                      <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                      <input class="form-control" name="time_end" id="time_end" type="time" required>
                    </div>
                  </div>
                </div>

              </div>
              <div id="cars" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Some content in menu 1.</p>
              </div>
              <div id="location" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Some content in menu 1.</p>
              </div>
              <div id="passenger" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Some content in menu 2.</p>
              </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
        </div>
      </form>

    </div>

  </div>
</div>

<!--************************************************************** Delete Modal **************************************************************-->
<div id="RMA_delete_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ลบข้อมูลการจองรถยนต์</h4>
      </div>
      <form class="form-horizontal" action="reservation/reserve_ma/delete.php" method="post">
      <div class="modal-body">

        <div class="form-group">
          <center>
            <label class="control-label">ข้อมูลที่ต้องการลบคือ</label>
            <p id="show-delete-label"></p>
          </center>
          <input type="hidden" id="show-delete-id" name="id" value=""/>
        </div>

      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary">ลบข้อมูล</button>
      </div>
      </form>
    </div>

  </div>
</div>
<!--************************************************************** END Delete Modal **************************************************************-->
