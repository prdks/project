
<!-- เวลารถยนต์ออกจริง -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    บันทึกเวลารถออก :
  </label>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="input-group">
      <span class="input-group-addon">วันที่</span>
      <input class="form-control" id="dp-tout" name="real_date_out" type="date" value="<?php echo $row['dateout'];?>">
      <span class="input-group-addon">เวลา</span>
      <input class="form-control" id="dp-kout" name="real_time_out" type="time" value="<?php echo $row['timeout'];?>">
    </div>
  </div>
</div>
<!-- เวลาเข้าจริง -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    บันทึกเวลารถกลับ :
  </label>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="input-group">
      <span class="input-group-addon">วันที่</span>
      <input class="form-control" id="dp-tin" name="real_date_in" type="date" value="<?php echo $row['datein'];?>">
      <span class="input-group-addon">เวลา</span>
      <input class="form-control" id="dp-kin" name="real_time_in" type="time" value="<?php echo $row['timein'];?>">
    </div>
  </div>
</div>
<!-- ระยะทางออก -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    เลขกิโลเมตรเมื่อออก :
  </label>
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="input-group">
      <input type="number" class="form-control" name="kilometer_out" placeholder="พิมพ์เลขกิโลเมตร" value="<?php echo $row['kilometer_out'];?>">
      <span class="input-group-addon">กิโลเมตร</span>
    </div>
  </div>
</div>
<!-- ระยะทาง้เข้า -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    เลขกิโลเมตรเมื่อกลับ :
  </label>
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="input-group">
      <input type="number" class="form-control" name="kilometer_in" placeholder="พิมพ์เลขกิโลเมตร" value="<?php echo $row['kilometer_in'];?>">
      <span class="input-group-addon">กิโลเมตร</span>
    </div>
  </div>
</div>
<!-- ระยะทางออก -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    รวมระยะทางกิโลเมตร :
  </label>
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class="input-group">
      <input type="number" class="form-control" name="kilometer_total"
      value="<?php echo $row['kilometer_total'];?>" readonly>
      <span class="input-group-addon">กิโลเมตร</span>
    </div>
  </div>
</div>


<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
  การอนุมัติจากบุคคลอื่น :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">

    <p><?php
                    // ลำดับ 1 (เจ้าหน้าที่ดูแลรถยนต์)
                    $sqlNo1 = "SELECT COUNT(personnel_id) as Result FROM personnel p
                    LEFT JOIN user_type u
                    ON p.user_type_id = u.user_type_id
                    WHERE u.user_level = 5";

                    $result1 = $conn->query($sqlNo1);
                    $No1 = $result1->fetch_assoc();

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
                        <?php echo "1. ".$person['title_name'].$person['personnel_name']?>
                        <br>สถานะ :
                        <?php
                        if ($row["fist_approve_status"] == 0) 
                        {
                          ?>
                          <b class="text-primary">รออนุมัติ</b>
                          <?php
                        }
                        elseif ($row["fist_approve_status"] == 1) 
                        {
                          ?>
                          <b class="text-success">อนุมัติ</b>
                          <?php
                        }
                        elseif ($row["fist_approve_status"] == 2) 
                        {
                          ?>
                          <b class="text-danger">ไม่อนุมัติ</b>
                          <br>
                          เหตุผล : <?php echo substr($row['fist_approve_note'], 0, strpos($row['fist_approve_note'], ','));?>
                          <?php
                          $frnote = substr($row['fist_approve_note'], (strpos($row['fist_approve_note'], ',')+1), strlen($row['fist_approve_note']));
                          if(strlen($frnote) != 0)
                          {
                            ?>
                            <br>เพิ่มเติม : <?php echo $frnote;?>
                            <?php
                          }
                        }

                        if($row["fist_approve_status"] != 0)
                        {
                          ?>
                          <br>
                          <button id="delete_other_approve" type="button" class="btn btn-xs btn-danger" data-id="<?php echo $row['reservation_id'];?>" ><span class="fa fa-trash fa-fw"></span>ลบการอนุมัตินี้</button>
                          <?php
                        }
                        
                    }
                        ?>
              </p>
              
              
             </div>
    
  </div>
</div>

<!-- สถานะจอง -->
<input type="hidden" id="hstatus" data-ustatus="<?php echo $row['usage_status'];?>" data-rstatus="<?php echo $row['reservation_status'];?>">
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
   <span class="requestfield">*</span> สถานะการจอง :
  </label>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label class="radio-inline"><input type="radio" name="reservation_status" value="0">รออนุมัติ</label>
    <label class="radio-inline"><input type="radio" name="reservation_status" value="1">อนุมัติ</label>
    <label class="radio-inline"><input type="radio" name="reservation_status" value="2">ไม่อนุมัติ</label>
    <label class="radio-inline"><input type="radio" name="reservation_status" value="3">ยกเลิก</label>
  </div>
</div>
<!-- สถานะใช้ -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> สถานะการใช้ :
  </label>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label class="radio-inline"><input type="radio" name="usage_status" value="0">รออนุมัติ</label>
    <label class="radio-inline"><input type="radio" name="usage_status" value="1">กำลังดำเนินการ</label>
    <label class="radio-inline"><input type="radio" name="usage_status" value="2">ดำเนินการเสร็จสิ้น</label>
    <label class="radio-inline"><input type="radio" name="usage_status" value="3">ยกเลิก</label>
  </div>
</div>
<!-- หมายเหตุไม่อนุมัติ -->
<?php
$note = explode(",",$row['reserve_note']);
?>
<div class="form-group" id="edit_reason">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> เหตุผล :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
    <input type="text" id="edit_reason_area" name="note[]" class="form-control" placeholder="พิมพ์เหตุผลการยกเลิก" value="<?php echo $note[0]; ?>" required>
  </div>
</div>
<!-- เหตุผลเพิ่มเติม -->
<div class="form-group" id="edit_note">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    หมายเหตุเพิ่มเติม :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
      <textarea  rows="3" type="text" class="form-control" id="edit_note_area" name="note[]"
      placeholder="พิมพ์หมายเหตุเพิ่มเติม" style="resize:none;"><?php echo $note[1]; ?></textarea>
  </div>
</div>
