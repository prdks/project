<div class="row" style="padding:4px;">
  <!-- ใส่ข้อมูลสถานที่ -->
  <div class="col-lg-6">
    <div class="panel panel-default">
      <div class="panel-heading">เพิ่มสถานที่</div>
      <div class="panel-body">

        <div class="row" style="padding:4px;">
          <div class="form-group">
            <label class="control-label col-lg-12">ชื่อสถานที่</label>
            <div class="col-lg-12">
              <input type="text" id="location_name" class="form-control" placeholder="พิมพ์ชื่อสถานที่ต้องการไป" />
            </div>
          </div>
        </div>

        <div class="row" style="padding:4px;">
          <div class="form-group">
            <label class="control-label col-lg-12">จังหวัด</label>
            <div class="col-lg-12">
              <select class="form-control" id="province"></select>
            </div>
          </div>
        </div>

      </div>
      <div class="panel-footer">
        <div class="row text-right" style="padding-right:15px;">
          <button class="btn btn-success handleInsertLocation" id="insertList">เพิ่ม</button>
        </div>
      </div>
    </div>
  </div>

  <!-- ตารางสถานที่ -->
  <div class="col-lg-6">
    <div class="panel panel-primary">
      <div class="panel-heading">รายชื่อสถานที่</div>

      <div id="EmptyLocation">
        <br />
        <p class="text-center">ไม่มีข้อมูลรายชื่อสถานที่</p>
        <br />
      </div>

      <div id="Table_Loaction" class="table-responsive">
          <table id="LocationListTable" class="table table-condensed table-striped table-bordered table-hover">
            <thead id="Tb_Location">
              <tr>
                <th id="tb_option">ลบ</th>
                <th id="tb_detail_main">ชื่อสถานที่</th>
                <th id="tb_detail_main">จังหวัด</th>
              </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
          </table>
      </div>

    </div>
  </div>
</div>
