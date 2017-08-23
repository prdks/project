<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
      ?>
<link href="../dist/css/configp.css" rel="stylesheet">
<script src="../dist/js/configp.js"></script>
</head>
<body id="enterkl">
  <div class="container">
    <div class="row">
      <div id="setloginpage" class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
        <form id="adminsignup_form" class="form-horizontal">
          <div class="panel panel-primary">
            <div class="panel-heading">ลงทะเบียน Admin ภายในระบบ</div>
            <div class="panel-body">
              <div class="form-group">
                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                  <span class="requestfield">*</span> อีเมลล์ :
                </label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                  <input type="text" class="form-control" name="email" placeholder="พิมพ์ข้อมูลคำนำหน้าชื่อ" value="<?php echo $_POST['hd_email'];?>" readonly required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                  <span class="requestfield">*</span> ชื่อนามสกุล :
                </label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                  <input type="text" class="form-control" name="name" placeholder="พิมพ์ข้อมูลคำนำหน้าชื่อ" value="<?php echo $_POST['name'];?>" required>
                </div>
              </div>
              <br>
              <input type="hidden" name="user_level" value="0">
              <sup class="pull-right text-danger">* สามารถแก้ไขข้อมูลส่วนตัวได้อีกหลังจากเปิดใช้ระบบ</sup>

            </div>
            <div class="panel-footer text-right">
              <input class="btn btn-md btn-default" type="reset" value="ยกเลิก">
              <input class="btn btn-md btn-success" type="submit" value="ลงทะเบียน">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
