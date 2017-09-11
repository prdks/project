
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
<div class="form-group" id="edit_note">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> หมายเหตุการยกเลิก :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
      <textarea  rows="3" type="text" class="form-control" id="edit_note_area" name="note"
      placeholder="พิมพ์หมายเหตุการยกเลิก" style="resize:none;"><?php echo $row['reserve_note']; ?></textarea>
  </div>
</div>
