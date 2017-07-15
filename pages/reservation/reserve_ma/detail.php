<!-- ชิ้อผู้ทำรายการ -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    ชื่อผู้ขออนุมัติ :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
    <input  type="text"  class="form-control" name="user_name" value="<?php echo $row['title_name'].$row['personnel_name'];?>" required readonly/>
  </div>
</div>
<!-- ตำแหน่ง -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    ตำแหน่ง :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
    <input  type="text"  class="form-control" name="user_position" value="<?php echo $row['position_name'];?>" required readonly/>
  </div>
</div>
<!-- รายละเอียดความประสงค์ -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> ความประสงค์ขอใช้รถยนต์ :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
    <textarea  rows="5" type="text" class="form-control" name="detail"
    placeholder="พิมพ์รายละเอียดความประสงค์ขอใช้รถยนต์" required><?php echo $row['requirement_detail'];?></textarea>
  </div>
</div>
<!-- สถานที่ต้องการไป -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> สถานที่ต้องการไป :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
      <textarea  rows="5" type="text" class="form-control" name="location"
      placeholder="พิมพ์ชื่อสถานที่ต้องการไป" required><?php echo $row['location'];?></textarea>
  </div>
</div>
<!-- วันแรกที่จองใช้ -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> วันแรกที่ต้องการใช้รถยนต์ :
  </label>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="input-group">
      <span class="input-group-addon">วันที่</span>
      <input class="form-control" name="date_start" id="dp-fistdate" type="date" value="<?php echo $row['date_start'];?>" required>
      <span class="input-group-addon">เวลา</span>
      <input class="form-control" name="time_start" id="dp-timestart" type="time" value="<?php echo $row['reserv_stime'];?>" required>
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
      <span class="input-group-addon">วันที่</span>
      <input class="form-control" name="date_end" id="dp-lastdate" type="date" value="<?php echo $row['date_end'];?>" required>
      <span class="input-group-addon">เวลา</span>
      <input class="form-control" name="time_end" id="dp-timeend" type="time" value="<?php echo $row['reserv_etime'];?>" required>
    </div>
  </div>
</div>
