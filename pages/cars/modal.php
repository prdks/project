<!--************************************************************** Insert Modal **************************************************************-->
<div id="Insert_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">เพิ่มข้อมูลรถยนต์</h4>
      </div>
      <form class="form-horizontal" action="cars/insert.php" method="post">
      <div class="modal-body">
        <!-- เลขทะเบียน -->
        <div class="row" style="margin-left:10px;margin-right:10px;">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="requestfield">*</span> ทะเบียนรถยนต์ : </label>
            <div class="col-md-4 col-sm-4 col-xs-6">
            <input type="text" class="form-control" name="car_reg" id="car_reg" value="" placeholder="พิมพ์เลขทะเบียน" required>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
            <select class="form-control" id="province" name="province"></select>
            </div>
          </div>
        </div>
        <!-- ยี่ห้อ -->
        <div class="row" style="margin-left:10px;margin-right:10px;">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="requestfield">*</span> เลือกยี่ห้อ : </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select name="car_brand" class="form-control" required="">
                <?php
                $sql = "Select * from car_brand order by  car_brand_name ASC";
                $result = $conn->query($sql);
                if(mysqli_num_rows($result) !== 0)
                {
                  while ($row = $result->fetch_assoc())
                  {
                    echo "
                    <option value='".$row['car_brand_name']."'>
                    ".$row['car_brand_name']."
                    </option>";
                  }
                }
                else
                {
                  echo "<option value=null>ไม่พบข้อมูลยี่ห้อรถยนต์</option>";
                }
                ?>
              </select>
            </div>
          </div>
        </div>
        <!-- รุ่น -->
        <div class="row" style="margin-left:10px;margin-right:10px;">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="car_kind"><span class="requestfield">*</span> รุ่น : </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" class="form-control" name="car_kind" id="car_kind" value="" placeholder="พิมพ์รุ่นของรถยนต์" required>
            </div>
          </div>
        </div>
        <!-- รายละเอียด -->
        <div class="row" style="margin-left:10px;margin-right:10px;">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">รายละเอียด : </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea  rows="3" type="text" class="form-control" id="car_detail" name="car_detail"
              placeholder="พิมพ์รายละเอียดของรถยนต์" style="resize:none;"></textarea>
            </div>
          </div>
        </div>
        <!-- จำนวนที่นั่ง -->
        <div class="row" style="margin-left:10px;margin-right:10px;">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="requestfield">*</span> จำนวนที่นั่ง : </label>
            <div class="col-md-2 col-sm-2 col-xs-4">
              <input class="form-control" type="number" name="seat" min="1" max="50" placeholder="0" required>
            </div>
          </div>
        </div>
        <!-- คนขับรถยนต์ -->
        <div class="row" style="margin-left:10px;margin-right:10px;">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="requestfield">*</span> เลือกคนขับ : </label>
                <?php
                switch ($_SESSION['user_type']) {
                  case 'เจ้าหน้าที่ดูแลระบบ':
                  $sql = "
                    SELECT
                      psn.* , t.* , p.* , d.*
                    FROM personnel psn
                    LEFT OUTER JOIN title_name t
                      ON psn.title_name_id = t.title_name_id
                    LEFT OUTER JOIN  position p
                      ON psn.position_id = p.position_id
                    LEFT OUTER JOIN  department  d
                      ON psn.department_id = d.department_id
                    WHERE position_name = 'คนขับรถยนต์'
                    ORDER BY department_name ASC";
                    $result = $conn->query($sql);
                    if(mysqli_num_rows($result) !== 0)
                    {
                      echo "
                      <div class='col-md-6 col-sm-6 col-xs-12'>
                      <select name='driver' class='form-control' required>
                      ";
                      $sql2 = "SELECT d.*FROM department d
                      LEFT OUTER JOIN personnel p
                      ON p.department_id= d.department_id
                      LEFT OUTER JOIN cars c
                      ON c.personnel_id = p.personnel_id
                      GROUP BY department_name
                      ORDER BY COUNT(car_reg) DESC
                      , department_name ASC";
                      $result2 = $conn->query($sql2);
                      while ($r = $result2->fetch_assoc())
                      {
                            $sql = "
                              SELECT
                                psn.* , t.* , p.* , d.*
                              FROM personnel psn
                              LEFT OUTER JOIN title_name t
                                ON psn.title_name_id = t.title_name_id
                              LEFT OUTER JOIN  position p
                                ON psn.position_id = p.position_id
                              LEFT OUTER JOIN  department  d
                                ON psn.department_id = d.department_id
                              WHERE position_name = 'คนขับรถยนต์'
                              AND department_name = '".$r['department_name']."'
                              ORDER BY personnel_name ASC";
                            $result = $conn->query($sql);
                            if(mysqli_num_rows($result) !== 0)
                            {
                              echo "<optgroup label='".$r['department_name']."'>";
                              while ($row = $result->fetch_assoc())
                              {
                                  echo "
                                  <option value='".$row['personnel_name']."'>
                                  ".$row['title_name']." ".$row['personnel_name']."
                                  </option>";
                              }
                            }else {
                              echo "<optgroup label='".$r['department_name']."' disabled style='color:#cccccc;'>";
                              echo "<option value=null style='color:#dfdfdf;' disabled>ไม่พบข้อมูลคนขับรถยนต์</option>";
                            }

                      }
                    }
                    else
                    {
                      echo "
                      <div class='col-md-5 col-sm-5 col-xs-6'>
                      <select name='driver' class='form-control' readonly disable >
                      <option value=null>ไม่พบข้อมูลคนขับรถยนต์</option>";
                    }
                    echo "
                    </select>
                    </div>";
                    break;
                  case 'ผู้อนุมัติประจำหน่วยงาน ลำดับที่ 1':
                  $sql = "
                    SELECT
                      psn.* , t.* , p.* , d.*
                    FROM personnel psn
                    LEFT OUTER JOIN title_name t
                      ON psn.title_name_id = t.title_name_id
                    LEFT OUTER JOIN  position p
                      ON psn.position_id = p.position_id
                    LEFT OUTER JOIN  department  d
                      ON psn.department_id = d.department_id
                    WHERE position_name = 'คนขับรถยนต์'
                    AND department_name = '".$_SESSION['department']."'
                    ORDER BY personnel_name ASC";
                    $result = $conn->query($sql);
                    if(mysqli_num_rows($result) !== 0)
                    {
                      echo "
                      <div class='col-md-6 col-sm-6 col-xs-12'>
                      <select name='driver' class='form-control'>";
                      while ($row = $result->fetch_assoc())
                      {
                        echo "
                        <option value='".$row['personnel_name']."'>
                        ".$row['title_name']." ".$row['personnel_name']."
                        </option>";
                      }
                    }
                    else
                    {
                      echo "
                      <div class='col-md-5 col-sm-5 col-xs-6'>
                      <select name='driver' class='form-control' readonly disable>";
                      echo "<option value=null>ไม่พบข้อมูลคนขับรถยนต์</option>";
                    }
                    echo "
                    </select>
                    </div>";
                    break;
                }
                ?>
          </div>
        </div>
        <!-- สถานะ -->
        <div class="row" style="margin-left:10px;margin-right:10px;">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">สถานะรถยนต์ : </label>
            <div class="col-md-3 col-sm-3 col-xs-6">
              <select id="status" name="status" class="form-control">
                <option value="จองได้" selected>จองได้</option>
                <option value="งดจอง">งดจอง</option>
              </select>
            </div>
          </div>
        </div>
        <!-- ถ้้าสถานะงดจอง -->
        <div class="row" style="margin-left:10px;margin-right:10px;" id="note">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="requestfield">*</span> หมายเหตุ : </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea  rows="3" type="text" class="form-control" id="note_area" name="note"
              placeholder="พิมพ์หมายเหตุที่งดจองรถยนต์" style="resize:none;"></textarea>
            </div>
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
<!--************************************************************** END Insert Modal **************************************************************-->

<!--************************************************************** Detail Modal **************************************************************-->
<div id="Detail_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ข้อมูลรถยนต์</h4>
      </div>
      <div class="modal-body" id="body_modal">
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>

  </div>
</div>
<!--************************************************************** END Detail Modal **************************************************************-->

<!--************************************************************** Edit Modal **************************************************************-->
<div id="Edit_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">แก้ไขข้อมูลรถยนต์</h4>
      </div>
      <form class="form-horizontal" action="cars/edit.php" method="post">
        <div class="modal-body" id="body_Edit"></div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="submit" class="btn btn-primary">แก้ไขข้อมูล</button>
      </div>
      </form>
    </div>

  </div>
</div>
<!--************************************************************** END Edit Modal **************************************************************-->

<!--************************************************************** Delete Modal **************************************************************-->
<div id="Delete_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ลบข้อมูลรถยนต์</h4>
      </div>
      <form class="form-horizontal" action="cars/delete.php" method="post">
      <div class="modal-body" id="body_Delete">
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
