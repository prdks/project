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
          <dt>วันที่ใช้รถยนต์ :</dt>
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
<!--************************************************************** Edit Modal **************************************************************-->
<div id="RMA_Edit_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ลบข้อมูลการจองรถยนต์</h4>
      </div>
      <form class="form-horizontal">
      <div class="modal-body">



      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
      </div>
      </form>
    </div>

  </div>
</div>
<!--************************************************************** END Delete Modal **************************************************************-->
