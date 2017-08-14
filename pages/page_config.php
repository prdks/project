<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
        // googleAuth.file
        include '_googleauth.php';
      ?>
<link href="../dist/css/configp.css" rel="stylesheet">
<script src="../dist/js/configp.js"></script>
</head>
<body id="enterkl">

<div class="container">
  <div class="row">

    <?php
    if (!isset($_SESSION['config_id']))
    {
    ?>
    <div id="setloginpage" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
      <form action="admin/insertconfig.php" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="panel panel-primary">
          <div class="panel-heading">Config Application</div>
          <div class="panel-body">

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
                    <input name="password" type="password" class="form-control" pattern=".{6,12}" title="พิมพ์รหัสผ่าน 6 ถึง 12 ตัวอักษร" placeholder="พิมพ์รหัสผ่าน 6 ถึง 12 ตัวอักษร" required/>
                  </div>
                  <div class="form-group">
                    <label class="control-label"><span class="requestfield">*</span> ยืนยันรหัสผ่าน (Confirm Password)</label>
                    <input name="confirm_password" type="password" pattern=".{6,12}" class="form-control" title="พิมพ์รหัสผ่าน 6 ถึง 12 ตัวอักษร" placeholder="พิมพ์รหัสผ่านใหม่อีกครั้ง" required/>
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
                    <label class="control-label"><span class="requestfield">*</span> ชื่อของคณะ/สำนักงาน</label>
                    <input name="name" maxlength="200" type="text" class="form-control" placeholder="พิมพ์ชื่อคณะ เช่น ''คณะอุตสาหกรรมการเกษตร'' เป็นต้น "  required/>
                  </div>
                  <div class="form-group">
                    <label class="control-label"><span class="requestfield">*</span> Email Domain Name</label>
                    <input name="domain_name" maxlength="200" type="text" class="form-control" placeholder="พิมพ์ชื่อโดเมน เช่น ''agro.kmutnb.ac.th'' เป็นต้น "  required/>
                  </div>
                  <div class="form-group">
                    <label class="control-label">URL เว็บประเมินการจองและการใช้ (Google Forms)</label>
                    <input name="url" type="text" class="form-control" placeholder="พิมพ์ url ของ เว็บประเมินการจองและการใช้รถยนต์"/>
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


          </div>
        </div>
      </form>
    </div>

    <?php
  }
  else
  {
    $sql = "select * from config where id = '".$_SESSION['config_id']."'";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
  ?>
  <div id="setloginpage" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
        <form action="admin/updateconfig.php" method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="panel panel-primary">
            <div class="panel-heading">Config Application</div>
            <div class="panel-body">

              <br>
              <div class="stepwizard col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-3">
              <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                  <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                  <p class="hidden-xs hidden-sm">แก้ไข<br>รหัสผ่าน</p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                  <p class="hidden-xs hidden-sm">แก้ไข<br>ข้อมูลคณะ</p>
                </div>
                <div class="stepwizard-step">
                  <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                  <p class="hidden-xs hidden-sm">แก้ไข<br>Logoคณะ</p>
                </div>
              </div>
              </div>

              <div class="row setup-content" id="step-1">
                <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                  <div class="col-md-12">
                    <div class="hidden-lg hidden-md"><br /></div>
                    <div class="form-group">
                      <label class="control-label"> ชื่อผู้ใช้งาน (Username)</label>
                      <input name="username" type="text" class="form-control" placeholder="พิมพ์ชื่อผู้ใช้งาน" value="<?php echo $row['username']?>" required />
                    </div>
                    <div class="form-group">
                      <label class="control-label">รหัสผ่านใหม่ (Password)</label>
                      <input name="new_password" type="password" class="form-control" pattern=".{6,12}" title="พิมพ์รหัสผ่าน 6 ถึง 12 ตัวอักษร" placeholder="พิมพ์รหัสผ่าน 6 ถึง 12 ตัวอักษร" required/>
                    </div>
                    <div class="form-group">
                      <label class="control-label">ยืนยันรหัสผ่าน (Confirm Password)</label>
                      <input name="confirm_new_password" type="password" pattern=".{6,12}" class="form-control" title="พิมพ์รหัสผ่าน 6 ถึง 12 ตัวอักษร" placeholder="พิมพ์รหัสผ่านใหม่อีกครั้ง" required/>
                    </div>

                    <div class="pull-right">
                      <a class="btn btn-default btn-md" href="_logout.php" type="button">ยกเลิก</a>
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
                      <label class="control-label"> ชื่อของคณะ/สำนักงาน</label>
                      <input name="name" maxlength="200" type="text" class="form-control" placeholder="พิมพ์ชื่อคณะ เช่น ''คณะอุตสาหกรรมการเกษตร'' เป็นต้น " value="<?php echo $row['name']?>" required/>
                    </div>
                    <div class="form-group">
                      <label class="control-label"> Email Domain Name</label>
                      <input name="domain_name" maxlength="200" type="text" class="form-control" placeholder="พิมพ์ชื่อโดเมน เช่น ''agro.kmutnb.ac.th'' เป็นต้น " value="<?php echo $row['domain_name']?>" required/>
                    </div>
                    <div class="form-group">
                      <label class="control-label">URL เว็บประเมินการจองและการใช้ (Google Forms)</label>
                      <input name="url" type="text" class="form-control" placeholder="พิมพ์ url ของ เว็บประเมินการจองและการใช้รถยนต์" value="<?php echo $row['url']?>"/>
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
                    <br />
                    <div class="form-group">
                      <center>
                        <section class="contain">
                          <img src="viewimg.php?mode=logo">
                        </section>
                      </center>
                    </div>
                    <div class="form-group">
                      <label class="control-label"> รูป Logo</label>
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
              </div>


            </div>
          </div>
        </form>
      </div>

  <?php
  }
    ?>

</div>
</div>

</body>
</html>
