<!-- Modal -->
<div id="reserv_approve_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-file-text fa-fw"></i>รายละเอียดการจองรถยนต์</h4>
      </div>

      <form id="approve_form" class="form-horizontal">
      <div class="modal-body">
        <div id="detail_area_for_approve"></div>
        <div class="row">
          
        <?php
        // ลำดับ 1 (เจ้าหน้าที่ดูแลรถยนต์)
        $sqlNo1 = "SELECT COUNT(personnel_id) as Result FROM personnel p
        LEFT JOIN user_type u
        ON p.user_type_id = u.user_type_id
        WHERE u.user_level = 5";

        // ลำดับ 3
        $sqlNo3 = "SELECT COUNT(personnel_id) as Result FROM personnel p
        LEFT JOIN user_type u
        ON p.user_type_id = u.user_type_id
        WHERE u.user_level = 4";

        $result1 = $conn->query($sqlNo1);
        $No1 = $result1->fetch_assoc();

        
        $result3 = $conn->query($sqlNo3);
        $No3 = $result3->fetch_assoc();

        ?>   
          <div class="col-lg-8">   
              <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title">อนุมัติการจอง</h3>
                  </div>
                  <div class="panel-body">
                    <!-- ผลการจอง -->
                <div class="form-group">
                  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                    <span class="requestfield">*</span> เลือกผลการจอง :
                  </label>
                  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <button class="btn btn-sm btn-defualt" type="button" name="approve_btn" value="1">
                      <span class="glyphicon glyphicon-ok"></span> อนุมัติ
                    </button>
                    <button class="btn btn-sm btn-defualt" type="button" name="approve_btn" value="2">
                      <span class="glyphicon glyphicon-remove"></span> ไม่อนุมัติ
                    </button>
                    <button class="btn btn-sm btn-defualt" type="button" name="approve_btn" value="3">
                      <span class="glyphicon glyphicon-ban-circle"></span> ยกเลิกการจอง
                    </button>
                  </div>
                </div>
                <input type="hidden" id="show-status" name="status" value="">
                       <!-- หมายเหตุ -->
                      <div class="form-group" id="note_approve" hidden>
                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                          <span class="requestfield">*</span> เหตุผล :
                        </label>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                          <input class="form-control" type="text" name="reason" id="reason" placeholder="พิมพ์เหตุผลการยกเลิก">
                        </div>
                      </div>
                       <!-- หมายเหตุ -->
                       <div class="form-group" id="note_more_approve" hidden>
                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                          หมายเหตุเพิ่มเติม :
                        </label>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <textarea  rows="3" type="text" class="form-control" id="note_area" name="note"
                        placeholder="พิมพ์หมายเหตุการยกเลิก" style="resize:none;"></textarea>
                        </div>
                      </div>
                  </div>
              </div>

          </div>

          <?php
          if(($No1['Result']+$No3['Result']) == 0)
          {
            echo "EMPTY";
          }
          ?>
            <div class="col-lg-4 container-fluid">
              <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title">ลำดับการอนุมัติ</h3>
                  </div>
                  <div class="panel-body">
                    <?php
                    if($No1['Result'] != 0 && $No3['Result'] != 0){ $num1 = 1; $num3 = 2; }
                    elseif ($No1['Result'] == 0 && $No3['Result'] != 0) {$num1 = 0; $num3 = 1;}
                    elseif ($No1['Result'] != 0 && $No3['Result'] == 0) {$num1 = 1; $num3 = 0;}

                    if($No1['Result'] != 0)
                    {
                      $sql = "SELECT p.* ,  t.*  FROM personnel p
                      LEFT JOIN department d
                      ON p.department_id = d.department_id
                      LEFT JOIN title_name t
                      ON p.title_name_id = t.title_name_id
                      LEFT JOIN user_type u
                      ON p.user_type_id = u.user_type_id
                      WHERE d.department_name = '".$_SESSION['department']."'
                      AND u.user_level = 5";

                      $result = $conn->query($sql);
                      $person = $result->fetch_assoc();
                      ?>
                      <div>
                        <b><?php echo $num1.". ".$person['title_name'].$person['personnel_name']?></b>
                        <br><b>สถานะ : </b><span id="show-ap-1"></span>
                        <span id="reason-1"></span>
                      </div>
                      <br>
                      <?php
                    }
                    if($No3['Result'] != 0)
                    {
                      $sql = "SELECT p.* ,  t.*  FROM personnel p
                        LEFT JOIN department d
                        ON p.department_id = d.department_id
                        LEFT JOIN title_name t
                        ON p.title_name_id = t.title_name_id
                        LEFT JOIN user_type u
                        ON p.user_type_id = u.user_type_id
                        WHERE d.department_name = '".$_SESSION['department']."'
                        AND u.user_level = 4";

                        $result = $conn->query($sql);
                        $person = $result->fetch_assoc();
                        ?>
                        <div>
                          <b><?php echo $num3.". ".$person['title_name'].$person['personnel_name']?></b>
                          <br><b>สถานะ : </b><span id="show-ap-3"></span>
                        </div>
                        <br>
                      <?php
                    }
                        ?>
                  </div>
              </div>
            </div> 
          
          
          
          
        </div>
        
            

        <input type="hidden" id="reserve_id" name="reserve_id" value="">

      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">ออก</button>
        <button type="submit" class="btn btn-primary">บันทึกผลอนุมัติ</button>
      </div>
      </form>
    </div>

  </div>
</div>
