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

    <?php
    if (!isset($_GET['callback']))
    {
    ?>
    <div id="setloginpage" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
      <form id="admininsert_form" class="form-horizontal" enctype="multipart/form-data">
        <div class="panel panel-primary">
          <div class="panel-heading">การตั้งค่าระบบ</div>
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
                <p class="hidden-xs hidden-sm">เพิ่ม<br>รูปโลโก้คณะ</p>
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
                    <input name="name" maxlength="200" type="text" class="form-control" placeholder="พิมพ์ชื่อคณะ เช่น ''คณะอุตสาหกรรมเกษตร'' เป็นต้น "  required/>
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
                    <label class="control-label"><span class="requestfield">*</span> รูปโลโก้</label>
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
  ?>
  <div id="setloginpage" class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
    <div class="panel with-nav-tabs panel-primary">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#home_edit" data-toggle="tab" id="hometab">แก้ไขการตั้งค่าระบบ</a></li>
                  <li class="dropdown pull-right">
                      <a href="#" data-toggle="dropdown"><i class="fa fa-gear fa-fw"></i>เลือกการแก้ไข <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                          <li><a id="link_editUserpass" href="#edit_userpass" data-toggle="tab">แก้ไขรหัสผ่าน</a></li>
                          <li><a id="link_editInfo" href="#edit_info" data-toggle="tab">แก้ไขข้อมูลคณะ</a></li>
                          <li><a id="link_editLogo" href="#edit_logo" data-toggle="tab">แก้ไขรูปโลโก้คณะ</a></li>
                      </ul>
                  </li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                  <!-- First -->
                    <div class="tab-pane active" id="home_edit">
                      <center>
                        <br><br><br>
                        <h3>กรุณาเลือกเมนูการแก้ไขที่ต้องการในแท็บด้านขวา</h3>
                        <br><br><br>
                        <?php
                        $sql = "SELECT count(personnel_id) as Result FROM personnel p
                        LEFT OUTER JOIN user_type u
                        ON u.user_type_id = p.user_type_id
                        WHERE u.user_level = 0";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                        if($row['Result'] > 0) $status = 1;
                        else $status = 0;
                        ?>
                        <div class="pull-left">
                          <a id="delete_data_btn" class="btn btn-danger btn-md" data-status="<?php echo $status;?>" type="button"><i class="fa fa-trash-o fa-fw"></i>ลบการตั้งค่าระบบ</a>
                        </div>
                        <div class="pull-right">
                          <a class="btn btn-default btn-md" href="admin_login.php" type="button">ออกจากระบบ</a>
                        </div>
                      </center>
                    </div>
                    <!-- Edit User Pass -->
                    <div class="tab-pane fade" id="edit_userpass">
                      <form id="edit_pass_form" class="form-horizontal">
                        <legend>การแก้ไขรหัสผ่าน <i class="fa fa-key"></i></legend>
                        <div class="col-md-12">
                          <input class="callback_v" type="hidden" value="<?php echo $_GET['callback'];?>">
                          <div class="form-group">
                            <label class="control-label"><span class="requestfield">*</span> ชื่อผู้ใช้งาน (Username)</label>
                            <input name="username" type="text" class="form-control" placeholder="พิมพ์ชื่อผู้ใช้งาน" required/>
                          </div>
                          <div class="form-group">
                            <label class="control-label"><span class="requestfield">*</span> รหัสผ่านเดิม (Old-Password)</label>
                            <input name="old_password" type="password" class="form-control" pattern=".{6,12}" title="พิมพ์รหัสผ่าน 6 ถึง 12 ตัวอักษร" placeholder="พิมพ์รหัสผ่าน 6 ถึง 12 ตัวอักษร" required/>
                          </div>
                          <div class="form-group">
                            <label class="control-label"><span class="requestfield">*</span> รหัสผ่านใหม่ (New-Password)</label>
                            <input name="new_password" type="password" class="form-control" pattern=".{6,12}" title="พิมพ์รหัสผ่าน 6 ถึง 12 ตัวอักษร" placeholder="พิมพ์รหัสผ่าน 6 ถึง 12 ตัวอักษร" required/>
                          </div>
                          <div class="form-group">
                            <label class="control-label"><span class="requestfield">*</span> ยืนยันรหัสผ่านใหม่ (Confirm New-Password)</label>
                            <input name="confirm_new_password" type="password" pattern=".{6,12}" class="form-control" title="พิมพ์รหัสผ่าน 6 ถึง 12 ตัวอักษร" placeholder="พิมพ์รหัสผ่านใหม่อีกครั้ง" required/>
                          </div>

                          <div class="pull-right">
                            <a class="back_home btn btn-default btn-md"type="button">ยกเลิก</a>
                            <button id="save_editUserPass" class="btn btn-primary btn-md" type="submit">บันทึกข้อมูล</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- Edit Data -->
                    <div class="tab-pane fade" id="edit_info">
                      <form id="edit_data_form" class="form-horizontal">
                        <legend>การแก้ไขข้อมูลคณะ <i class="fa fa-file-o"></i></legend>
                        <div class="col-md-12">
                        <input class="callback_v" type="hidden" value="<?php echo $_GET['callback'];?>">
                          <div class="form-group">
                            <label class="control-label"><span class="requestfield">*</span> ชื่อของคณะ/สำนักงาน</label>
                            <input name="name" maxlength="200" type="text" class="form-control" placeholder="พิมพ์ชื่อคณะ เช่น ''คณะอุตสาหกรรมเกษตร'' เป็นต้น " required/>
                          </div>
                          <div class="form-group">
                            <label class="control-label"><span class="requestfield">*</span> Email Domain Name</label>
                            <input name="domain_name" maxlength="200" type="text" class="form-control" placeholder="พิมพ์ชื่อโดเมน เช่น ''agro.kmutnb.ac.th'' เป็นต้น " required/>
                          </div>
                          <div class="form-group">
                            <label class="control-label">URL เว็บประเมินการจองและการใช้ (Google Forms)</label>
                            <input name="url" type="text" class="form-control" placeholder="พิมพ์ url ของ เว็บประเมินการจองและการใช้รถยนต์"/>
                          </div>
                          <div class="pull-right">
                            <a class="back_home btn btn-default btn-md"type="button">ยกเลิก</a>
                            <button class="btn btn-primary btn-md" type="submit">บันทึกข้อมูล</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- Edit Logo -->
                    <div class="tab-pane fade" id="edit_logo">
                      <form id="edit_logo_form" class="form-horizontal">
                        <legend>การแก้ไขรูปโลโก้คณะ <i class="fa fa-image"></i></legend>
                        <div class="col-md-12">
                          <div class="col-md-12">
                          <input class="callback_v" type="hidden" value="<?php echo $_GET['callback'];?>">
                            <br />
                            <div class="form-group">
                              <center>
                                <section class="contain">
                                  <img src="viewimg.php?mode=logo">
                                </section>
                                <h4>รูปภาพโลโก้ปัจจุบัน</h4>
                              </center>
                            </div>
                            <div class="form-group">
                              <label class="control-label"><span class="requestfield">*</span> รูป Logo</label>
                              <input type="file" class="form-control" accept="image/png, image/jpeg, image/gif" name="logo" required/>
                              <br>
                            </div>
                          <div class="pull-right">
                            <a class="back_home btn btn-default btn-md"type="button">ยกเลิก</a>
                            <button class="btn btn-primary btn-md" type="submit">บันทึกข้อมูล</button>
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
  </div>

  <?php
  }
    ?>

</div>
</div>

</body>
</html>
