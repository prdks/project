<!-- Modal -->
<div id="RMA_detail_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">รายละเอียดการจองรถยนต์</h4>
      </div>
      <div  id="body_modal_detail" class="modal-body">
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
