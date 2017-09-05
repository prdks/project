<!--************************************************************** Insert Modal **************************************************************-->
<div id="Insert_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">เพิ่มข้อมูลรถยนต์</h4>
      </div>
      <form id="insert_cars_form" class="form-horizontal">
      <div class="modal-body">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#data">ข้อมูลรถยนต์</a></li>
          <li><a data-toggle="tab" href="#picture">เพิ่มรูปภาพ</a></li>
        </ul>

        <div class="tab-content">
          <div id="data" class="tab-pane fade in active">
            <br>
            <!-- เลขทะเบียน -->
            <div class="form-group">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                <span class="requestfield">*</span> ทะเบียนรถยนต์ :
              </label>
              <div class="col-md-4 col-sm-4 col-xs-6">
              <input type="text" class="form-control" name="car_reg" id="car_reg" value="" placeholder="พิมพ์เลขทะเบียน" required>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-6">
              <select class="form-control" id="province" name="province"></select>
              </div>
            </div>
            <!-- ยี่ห้อ -->
            <div class="form-group">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                <span class="requestfield">*</span> เลือกยี่ห้อ :
              </label>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
            <!-- รุ่น -->
            <div class="form-group">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                <span class="requestfield">*</span> รุ่น :
              </label>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control" name="car_kind"
                id="car_kind" value="" placeholder="พิมพ์รุ่นของรถยนต์" required>
              </div>
            </div>
            <!-- รายละเอียด -->
            <div class="form-group">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                รายละเอียด :
              </label>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <textarea  rows="3" type="text" class="form-control" id="car_detail" name="car_detail"
                placeholder="พิมพ์รายละเอียดของรถยนต์" style="resize:none;"></textarea>
              </div>
            </div>
            <!-- จำนวนที่นั่ง -->
            <div class="form-group">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                <span class="requestfield">*</span> จำนวนที่นั่ง :
              </label>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <input class="form-control" type="number"
                name="seat" min="1" max="50" placeholder="0" required>
              </div>
            </div>
            <!-- คนขับรถยนต์ -->
            <div class="form-group">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                <span class="requestfield">*</span> เลือกคนขับ :
              </label>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php
                switch ($_SESSION['user_type']) {
                  case 0:
                  $sql = "
                    SELECT
                      psn.* , t.* , p.* , d.*
                    FROM personnel psn
                    LEFT OUTER JOIN user_type us
                    ON psn.user_type_id = us.user_type_id
                    LEFT OUTER JOIN title_name t
                      ON psn.title_name_id = t.title_name_id
                    LEFT OUTER JOIN  position p
                      ON psn.position_id = p.position_id
                    LEFT OUTER JOIN  department  d
                      ON psn.department_id = d.department_id
                    WHERE user_level = 2
                    ORDER BY department_name ASC";
                    $result = $conn->query($sql);
                    if(mysqli_num_rows($result) !== 0)
                    {
                      echo "
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
                              LEFT OUTER JOIN user_type us
                              ON psn.user_type_id = us.user_type_id
                              LEFT OUTER JOIN title_name t
                                ON psn.title_name_id = t.title_name_id
                              LEFT OUTER JOIN  position p
                                ON psn.position_id = p.position_id
                              LEFT OUTER JOIN  department  d
                                ON psn.department_id = d.department_id
                              WHERE user_level = 2
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
                                  ".$row['title_name'].$row['personnel_name']."
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
                      <select name='driver' class='form-control' readonly disable >
                      <option value=null>ไม่พบข้อมูลคนขับรถยนต์</option>";
                    }
                    echo "
                    </select>";
                    break;
                  case 4:
                  $sql = "
                    SELECT
                      psn.* , t.* , p.* , d.*
                    FROM personnel psn
                    LEFT OUTER JOIN user_type us
                    ON psn.user_type_id = us.user_type_id
                    LEFT OUTER JOIN title_name t
                      ON psn.title_name_id = t.title_name_id
                    LEFT OUTER JOIN  position p
                      ON psn.position_id = p.position_id
                    LEFT OUTER JOIN  department  d
                      ON psn.department_id = d.department_id
                    HERE user_level = 2
                    AND department_name = '".$_SESSION['department']."'
                    ORDER BY personnel_name ASC";
                    $result = $conn->query($sql);
                    if(mysqli_num_rows($result) !== 0)
                    {
                      echo "
                      <select name='driver' class='form-control'>";
                      while ($row = $result->fetch_assoc())
                      {
                        echo "
                        <option value='".$row['personnel_name']."'>
                        ".$row['title_name'].$row['personnel_name']."
                        </option>";
                      }
                    }
                    else
                    {
                      echo "
                      <select name='driver' class='form-control' readonly disable>";
                      echo "<option value=null>ไม่พบข้อมูลคนขับรถยนต์</option>";
                    }
                    echo "
                    </select>";
                    break;
                }
                ?>
              </div>
            </div>
            <!-- สถานะ -->
            <div class="form-group">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                สถานะรถยนต์ :
              </label>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <select id="status" name="status" class="form-control">
                  <option value="จองได้" selected>จองได้</option>
                  <option value="งดจอง">งดจอง</option>
                </select>
              </div>
            </div>
            <!-- ถ้้าสถานะงดจอง -->
            <div class="form-group" id="note">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                <span class="requestfield">*</span> หมายเหตุ :
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea  rows="3" type="text" class="form-control" id="note_area" name="note"
                placeholder="พิมพ์หมายเหตุที่งดจองรถยนต์" style="resize:none;"></textarea>
              </div>
            </div>

          </div>

          <div id="picture" class="tab-pane fade">
            <br>
            <!-- เพิ่มรูป -->
            <?php for($i = 0 ; $i < 4 ; $i++){?>
            <div class="form-group">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
              รูปที่ <?php echo $i+1; ?> :
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" class="form-control" name="filUpload<?php echo $i;?>">
              </div>
            </div>
            <?php } ?>
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
<div id="Detail_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

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
          <dt id="dt-show-picture">รูปภาพ :</dt>
          <dd id="show-picture"></dd>
          <br />
        </dl>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>

  </div>
</div>
<!--************************************************************** END Detail Modal **************************************************************-->

<!--************************************************************** Edit Modal **************************************************************-->
<div id="Edit_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">แก้ไขข้อมูลรถยนต์</h4>
      </div>
      <form id="edit_cars_form" class="form-horizontal">
      <div class="modal-body">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#data_edit">ข้อมูลรถยนต์</a></li>
          <li><a data-toggle="tab" href="#picture_edit">แก้ไขรูปภาพ</a></li>
        </ul>

        <div class="tab-content">
          <div id="data_edit" class="tab-pane fade in active">
            <br>
            <!-- ทะเบียนรถยนต์ -->
            <div class="form-group">
            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
              <span class="requestfield">*</span> ทะเบียนรถยนต์ :
            </label>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
            <input type="text" class="form-control" name="car_reg"
            id="display-reg" value="" placeholder="พิมพ์เลขทะเบียน" required>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
            <select class="form-control" id="display-province" name="province"></select>
            </div>
            </div>
            <!-- ยี่ห้อ -->
            <div class="form-group">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                <span class="requestfield">*</span> เลือกยี่ห้อ :
              </label>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <select id="display-brand" name="car_brand" class="form-control" required>"
                  <?php
                  $sql = "Select * from car_brand order by car_brand_name ASC";
                  $result = $conn->query($sql);
                  if(mysqli_num_rows($result) !== 0)
                  {
                    while ($r= $result->fetch_assoc())
                    {
                        ?>
                        <option value="<?php echo $r["car_brand_name"];?>"><?php echo $r["car_brand_name"];?></option>
                        <?php
                    }
                  }
                  else
                  {
                      ?>
                      <option value=null>ไม่พบข้อมูลยี่ห้อรถยนต์</option>
                      <?php
                  }
                  ?>
              </select>
              </div>
            </div>
            <!-- รุ่น -->
            <div class="form-group">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                <span class="requestfield">*</span> รุ่น :
              </label>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control" name="car_kind" id="display-kind" value="" placeholder="พิมพ์รุ่นของรถยนต์" required>
              </div>
            </div>
            <!-- รายละเอียด -->
            <div class="form-group">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                รายละเอียด :
              </label>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <textarea  rows="3" type="text" class="form-control" id="display-detail" name="car_detail"
                placeholder="พิมพ์รายละเอียดของรถยนต์" style="resize:none;"></textarea>
              </div>
            </div>
            <!-- จำนวนที่นั่ง -->
            <div class="form-group">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                <span class="requestfield">*</span> จำนวนที่นั่ง :
              </label>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <input class="form-control" type="number" name="seat" min="1" max="50" id="display-seat" placeholder="0" required value="">
              </div>
            </div>
            <!-- คนขับรถยนต์ -->
            <div class="form-group">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                <span class="requestfield">*</span> เลือกคนขับ :
              </label>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <?php
                switch ($_SESSION['user_type']) {
                  case 0:
                  $sql = "
                  SELECT
                    psn.* , t.* , p.* , d.*
                  FROM personnel psn
                  LEFT OUTER JOIN user_type us
                  ON psn.user_type_id = us.user_type_id
                  LEFT OUTER JOIN title_name t
                    ON psn.title_name_id = t.title_name_id
                  LEFT OUTER JOIN  position p
                    ON psn.position_id = p.position_id
                  LEFT OUTER JOIN  department  d
                    ON psn.department_id = d.department_id
                  WHERE user_level = 2
                  ORDER BY department_name ASC";
                    $result = $conn->query($sql);
                    if(mysqli_num_rows($result) !== 0)
                    {
                      ?>
                      <select id="display-driver" name='driver' class='form-control' required>
                      <?php
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
                              LEFT OUTER JOIN user_type us
                              ON psn.user_type_id = us.user_type_id
                              LEFT OUTER JOIN title_name t
                                ON psn.title_name_id = t.title_name_id
                              LEFT OUTER JOIN  position p
                                ON psn.position_id = p.position_id
                              LEFT OUTER JOIN  department  d
                                ON psn.department_id = d.department_id
                              WHERE user_level = 2
                              AND department_name = '".$r['department_name']."'
                              ORDER BY department_name ASC";
                            $result = $conn->query($sql);
                            if(mysqli_num_rows($result) !== 0)
                            {
                              ?>
                              <optgroup label="<?php echo $r['department_name'];?>">
                              <?php
                              while ($r = $result->fetch_assoc())
                              {
                                ?>
                                <option value="<?php echo $r['personnel_name'];?>" selected>
                                <?php echo $r['title_name'].$r['personnel_name']; ?>
                                </option>
                                <?php
                              }
                            }else {
                              ?>
                              <optgroup label="<?php echo $r['department_name'];?>" disabled style='color:#cccccc;'>
                                <option value=null style="color:#dfdfdf;" disabled>ไม่พบข้อมูลคนขับรถยนต์</option>
                              <?php
                            }

                      }
                    }
                    else
                    {
                      ?>
                      <select id="display-driver" name="driver" class="form-control" readonly disable >
                      <option value=null>ไม่พบข้อมูลคนขับรถยนต์</option>
                      <?php
                    }
                    ?>
                    </select>
                    <?php
                    break;
                  case 4:
                  $sql = "
                    SELECT
                      psn.* , t.* , p.* , d.*
                    FROM personnel psn
                    LEFT OUTER JOIN user_type us
                    ON psn.user_type_id = us.user_type_id
                    LEFT OUTER JOIN title_name t
                      ON psn.title_name_id = t.title_name_id
                    LEFT OUTER JOIN  position p
                      ON psn.position_id = p.position_id
                    LEFT OUTER JOIN  department  d
                      ON psn.department_id = d.department_id
                      WHERE user_level = 2
                    AND department_name = '".$_SESSION['department']."'";
                    $result = $conn->query($sql);
                    if(mysqli_num_rows($result) !== 0)
                    {
                      ?>
                      <select id="display-driver" name='driver' class='form-control' required>
                      <?php
                      while ($r = $result->fetch_assoc())
                      {
                        ?>
                        <option value="<?php echo $r['personnel_name'];?>" selected>
                        <?php echo $r['title_name'].$r['personnel_name']; ?>
                        </option>
                        <?php
                      }
                    }
                    else
                    {
                      ?>
                      <select id="display-driver" name="driver" class="form-control" readonly disable >
                      <option value=null>ไม่พบข้อมูลคนขับรถยนต์</option>
                      <?php
                    }
                    ?>
                    </select>
                    <?php
                    break;
                }
                ?>
              </div>
            </div>
            <!-- สถานะ -->
            <div class="form-group">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                สถานะรถยนต์ :
              </label>
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                <select id="display-status" name="status" class="form-control">
                  <option value="จองได้" selected>จองได้</option>
                  <option value="งดจอง">งดจอง</option>
                </select>
              </div>
            </div>
            <!-- ถ้้าสถานะงดจอง -->
            <div class="form-group" id="display-note-area">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                <span class="requestfield">*</span> หมายเหตุ :
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea  rows="3" type="text" class="form-control" id="display-note" name="note"
                placeholder="พิมพ์หมายเหตุที่งดจองรถยนต์" style="resize:none;"></textarea>
              </div>
            </div>
            <input type="hidden" id="display-id" name="car_id" value=""/>
          </div>

          <div id="picture_edit" class="tab-pane fade">
            <br>
            <!-- เพิ่มรูป -->
            <?php for($i = 0 ; $i < 4 ; $i++){?>
            <div class="form-group">
              <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
              รูปที่ <?php echo ($i+1); ?> :
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div id="show-picture_edit_<?php echo ($i+1); ?>"></div>
                <div id="show-button_edit_<?php echo ($i+1); ?>"></div>

              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
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
<div id="Delete_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ลบข้อมูลรถยนต์</h4>
      </div>
      <form id="delete_cars_form" class="form-horizontal">
      <div class="modal-body">

        <div class="form-group">
          <center>
            <label class="control-label">ข้อมูลที่ต้องการลบคือ</label>
            <label id="show-delete-label" class="control-label"></label>
          </center>
          <input type="hidden" id="show-delete-id" name="car_id" value=""/>
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
