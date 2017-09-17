<!-- Modal -->
<div id="RMA_detail_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-file-text fa-fw"></i>รายละเอียดการจองรถยนต์</h4>
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
      <form id="RMA_delete_form" class="form-horizontal">
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
<!--************************************************************** Print Modal **************************************************************-->
<div class="modal fade" id="modal-print-form">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">เลือกรูปแบบการพิมพ์</h4>
      </div>
      <div class="modal-body">

      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <select id="mode_for_print"class="form-control" required="required">
                  <option value="0">[+QRCode] ใบขออนุมัติพร้อมข้อมูลการจอง</option>
                  <option value="1">[+QRCode] ใบขออนุมัติพร้อมข้อมูลการจอง และข้อมูลการบันทึกผล</option>
                  <option value="2">ใบขออนุมัติพร้อมข้อมูลการจอง</option>
                  <option value="3">ใบขออนุมัติพร้อมข้อมูลการจอง และข้อมูลการบันทึกผล</option>
                </select>
        </div>
      </div>

      <input type="hidden" id="hidden_id_for_print">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <a id="linktoprint" class="btn btn-primary"><i class="fa fa-print"></i> พิมพ์ใบขออนุมัติ</a>
      </div>
    </div>
  </div>
</div>
