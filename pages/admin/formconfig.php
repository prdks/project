<br>
<div class="stepwizard col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-3">
<div class="stepwizard-row setup-panel">
  <div class="stepwizard-step">
    <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
    <p class="hidden-xs hidden-sm">ตั้งค่า<br>รหัสผ่านใหม่</p>
  </div>
  <div class="stepwizard-step">
    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
    <p class="hidden-xs hidden-sm">เพิ่ม<br>ข้อมูลคณะ</p>
  </div>
  <div class="stepwizard-step">
    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
    <p class="hidden-xs hidden-sm">เพิ่ม<br>Logoคณะ</p>
  </div>
</div>
</div>

<div class="row setup-content" id="step-1">
  <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
    <div class="col-md-12">
      <div class="hidden-lg hidden-md"><br /></div>
      <div class="form-group">
        <label class="control-label"><span class="requestfield">*</span> ชื่อผู้ใช้งาน (Username)</label>
        <input name="username" type="text" class="form-control" placeholder="พิมพ์ชื่อผู้ใช้งาน"  required />
      </div>
      <div class="form-group">
        <label class="control-label"><span class="requestfield">*</span> รหัสผ่านใหม่ (Password)</label>
        <input name="password" type="password" class="form-control" placeholder="พิมพ์รหัสผ่านใหม่" required/>
      </div>
      <div class="form-group">
        <label class="control-label"><span class="requestfield">*</span> ยืนยันรหัสผ่าน (Confirm Password)</label>
        <input name="confirm_password" type="password" class="form-control" placeholder="พิมพ์รหัสผ่านใหม่อีกครั้ง" required/>
      </div>
      <div class="pull-right">
        <button class="btn btn-primary nextBtn btn-md" type="button" >ถัดไป</button>
      </div>
    </div>
  </div>
</div>
<div class="row setup-content" id="step-2">
  <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
    <div class="col-md-12">
      <div class="hidden-lg hidden-md"><br /></div>
      <div class="form-group">
        <label class="control-label"><span class="requestfield">*</span> ชื่อคณะ</label>
        <input name="faculty_name" maxlength="200" type="text" class="form-control" placeholder="พิมพ์ชื่อคณะ เช่น ''อุตสาหกรรมการเกษตร'' "  required/>
      </div>
      <div class="form-group">
        <label class="control-label">URL เว็บประเมินการจองและการใช้</label>
        <input name="url" maxlength="200" type="text" class="form-control" placeholder="พิมพ์ url ของ เว็บประเมินการจองและการใช้รถยนต์"/>
      </div>
      <div class="pull-right">
        <button class="btn btn-default PreBtn2 btn-md" type="button">ย้อนกลับ</button>
        <button class="btn btn-primary nextBtn btn-md" type="button">ถัดไป</button>
      </div>
    </div>
  </div>
</div>
<div class="row setup-content" id="step-3">
  <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
    <div class="col-md-12">
      <div class="hidden-lg hidden-md"><br /></div>
      <div class="form-group">
        <label class="control-label"><span class="requestfield">*</span> รูป Logo</label>
            <input type="file" class="form-control" accept="image/png, image/jpeg, image/gif" name="logo" required/>
            <br>
      </div>
      <div class="pull-right">
        <button class="btn btn-default PreBtn3 btn-md" type="button">ย้อนกลับ</button>
        <button class="btn btn-success btn-md" type="submit">เสร็จสิ้น</button>
      </div>

    </div>
  </div>
</div>
