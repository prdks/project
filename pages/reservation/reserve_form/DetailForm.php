<input  type="hidden" id="person_username" value="<?php echo $_SESSION['user_name'] ;?>"/>
<!-- ชิ้อผู้ทำรายการ -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    ชื่อผู้ขออนุมัติ :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
    <input  type="text"  class="form-control" name="user_name"
    value="<?php echo $_SESSION['title_name'].$_SESSION['user_name'] ;?>"
    required readonly/>
  </div>
</div>
<!-- ตำแหน่ง -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    ตำแหน่ง :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
    <input  type="text"  class="form-control" name="user_position"
    value="<?php echo $_SESSION['position'] ;?>"
    required readonly/>
  </div>
</div>
<!-- รายละเอียดความประสงค์ -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> ความประสงค์ขอใช้รถยนต์ :
  </label>
  <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
    <textarea  rows="5" type="text" class="form-control" id="detail" name="detail"
    placeholder="พิมพ์รายละเอียดความประสงค์ขอใช้รถยนต์" required></textarea>
  </div>
</div>
<!-- สถานที่ต้องการไป -->
<div class="location_field">

  <div class="form-group">
    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
      <span class="requestfield">*</span> สถานที่ต้องการไป :
    </label>
    <div  class="col-lg-4 col-md-4 col-sm-4 col-xs-9">
      <input type="text" class="form-control" name="location[]" placeholder="พิมพ์ชื่อสถานที่ต้องการไป" required>
    </div>
    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
      <button class="btn btn-primary" type="button" id="addfield_location">เพิ่ม</button>
    </div>
  </div>

</div>
<!-- สถานที่ต้องการไป -->
<div class="form-group">
  <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
    <span class="requestfield">*</span> สถานที่นัดหมาย :
  </label>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <input type="text" class="form-control" id="appoinment" name="appoinment" placeholder="พิมพ์ชื่อสถานที่นัดหมายเมื่อถึงวันเดินทาง" value="">
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
      <span class="input-group-addon">วันที่</span>
      <input class="form-control" name="date_start" id="date_start" type="date" required>
      <span class="input-group-addon">เวลา</span>
      <input class="form-control" name="time_start" id="time_start" type="time" required>
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
      <span class="input-group-addon">วันที่</span>
      <input class="form-control" name="date_end" id="date_end" type="date" required>
      <span class="input-group-addon">เวลา</span>
      <input class="form-control" name="time_end" id="time_end" type="time" required>
    </div>
  </div>
</div>
<input type="hidden" id="user_department" name="user_department" value="<?php echo $_SESSION['department']?>">
