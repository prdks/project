<!--************************************************************** Detail Modal **************************************************************-->
<div id="Detail_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ข้อมูลรถยนต์</h4>
      </div>
      <div class="modal-body">
        <dl class="dl-horizontal">
          <dt>ทะเบียนรถยนต์ :</dt>
          <dd id="show-reg"></dd>
          <br />
          <dt>ยี่ห้อ :</dt>
          <dd id="show-brand"></dd>
          <br />
          <dt>รุ่น :</dt>
          <dd id="show-kind"></dd>
          <br />
          <dt>รายละเอียด :</dt>
          <dd id="show-detail"></dd>
          <br />
          <dt>จำนวนที่นั่ง :</dt>
          <dd id="show-seat"></dd>
          <br />
          <dt>คนขับรถยนต์ :</dt>
          <dd id="show-driver"></dd>
          <br />
          <?php
          switch ($_SESSION['user_type'])
          {
            case 0:
              ?>
              <dt>สังกัด :</dt>
              <dd id="show-department"></dd>
              <br />
              <?php
              break;
          }
          ?>
          <dt>สถานะรถยนต์ :</dt>
          <dd id="show-status"></dd>
          <br />
          <div id="status_note" hidden>
            <dt class="text-danger">หมายเหตุ :</dt>
            <dd id="show-note" class="text-danger"></dd>
          </div>
        </dl>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>

  </div>
</div>
<!--************************************************************** END Detail Modal **************************************************************-->
