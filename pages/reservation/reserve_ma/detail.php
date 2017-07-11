<!-- ชิ้อผู้ทำรายการ -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    ชื่อผู้ขออนุมัติ :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
    <input  type="text"  class="form-control" name="user_name" value="<?php echo $row['title_name'].' '.$row['personnel_name']?>" required readonly/>
  </div>
</div>
<!-- ตำแหน่ง -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    ตำแหน่ง :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
    <input  type="text"  class="form-control" name="user_position" value="<?php echo $row['position_name']?>" required readonly/>
  </div>
</div>
<!-- รายละเอียดความประสงค์ -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> ความประสงค์ขอใช้รถยนต์ :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
    <textarea  rows="5" type="text" class="form-control" name="detail"
    placeholder="พิมพ์รายละเอียดความประสงค์ขอใช้รถยนต์" required><?php echo $row['requirement_detail']?></textarea>
  </div>
</div>
<!-- สถานที่ต้องการไป -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> สถานที่ต้องการไป :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
      <textarea  rows="5" type="text" class="form-control" name="location"
      placeholder="พิมพ์ชื่อสถานที่ต้องการไป" required></textarea>
  </div>
</div>
<!-- วันแรกที่จองใช้ -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> วันแรกที่ต้องการใช้รถยนต์ :
  </label>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="input-group">
      <!-- วันที่เริ่ม  -->
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
      <input class="form-control" name="date_start" id="dp-fistdate" type="date" value="<?php echo $row['date_start']?>" required>
    </div>
  </div>
</div>
<!-- วันสุดท้ายที่จองใช้ -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> วันสุดท้ายที่ต้องการใช้รถยนต์ :
  </label>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="input-group">
      <!-- วันที่สิ้นสุด  -->
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
      <input class="form-control" name="date_end" id="dp-lastdate" type="date" value="<?php echo $row['date_end']?>" required>
    </div>
  </div>
</div>
<!-- เวลาที่จองใช้ -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> ช่วงเวลาเริ่มต้น :
  </label>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="input-group">
      <!-- เวลาเริ่มต้น -->
      <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
      <input class="form-control" name="time_start" id="dp-timestart" type="time" value="<?php echo $row['reserv_stime']?>" required>
    </div>
  </div>
</div>
<!-- เวลาที่จองใช้ -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> ช่วงเวลาสิ้นสุด :
  </label>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="input-group">
      <!-- เวลาสิ้นสุด -->
      <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
      <input class="form-control" name="time_end" id="dp-timeend" type="time" value="<?php echo $row['reserv_etime']?>" required>
    </div>
  </div>
</div>
<!-- เวลารถยนต์ออกจริง -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> บันทึกเวลารถออก :
  </label>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    -
  </div>
</div>
<!-- ระยะทางเข้า -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> เลขกิโลเมตรเมื่อออก :
  </label>
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
    <input type="number" class="form-control" name="kilometer_out" value="">
  </div>
</div>
<!-- เวลาเข้าจริง -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> บันทึกเวลารถเข้า :
  </label>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    -
  </div>
</div>
<!-- ระยะทางออก -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> เลขกิโลเมตรเมื่อเข้า :
  </label>
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
    <input type="number" class="form-control" name="kilometer_in" value="">
  </div>
</div>
<!-- ระยะทางออก -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    รวมระยะทางกิโลเมตร :
  </label>
  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
    <input type="number" class="form-control" name="kilometer_total" value="<?php echo ($row['kilometer_in']-$row['kilometer_out']);?>" readonly>
  </div>
</div>
<!-- สถานะจอง -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
   สถานะการจอง :
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
    สถานะการใช้ :
  </label>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <label class="radio-inline"><input type="radio" name="usage_status" value="0">รออนุมัติ</label>
    <label class="radio-inline"><input type="radio" name="usage_status" value="1">กำลังดำเนินการ</label>
    <label class="radio-inline"><input type="radio" name="usage_status" value="2">ดำเนินการเสร็จสิ้น</label>
    <label class="radio-inline"><input type="radio" name="usage_status" value="3">ยกเลิก</label>
  </div>
</div>
<!-- หมายเหตุไม่อนุมัติ -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> หมายเหตุการไม่อนุมัติ :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
      <textarea  rows="3" type="text" class="form-control" id="note_area" name="note"
      placeholder="พิมพ์หมายเหตุการไม่อนุมัติ" style="resize:none;"></textarea>
  </div>
</div>
