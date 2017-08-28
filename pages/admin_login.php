<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
        // googleAuth.file
        include '_googleauth.php';
      ?>
<script src="../dist/js/configp.js"></script>
</head>
<body id="enterkl">
  <div class="container">
    <div class="row">
      <div id="setloginpage" class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
        <form id="adminlogin_form" class="form-horizontal">
          <div class="panel panel-primary">
            <div class="panel-heading">
              เข้าสู่การตั้งค่าระบบ
              <?php
              $sql = "select count(id) as id from config";
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();
              if ($row['id'] != 0)
              {
              ?>
              <span class="pull-right">
                <a class="btn btn-xs btn-primary" href="_logout.php" data-toggle="tooltip" data-placement="top" data-original-title="กลับหน้าหลัก">
                  <i class="fa fa-times"></i>
                </a>
              </span>
              <?php
              }
              ?>
            </div>
            <div class="panel-body">

              <div class="form-group">
                <div class="col-lg-12">
                  <input class="form-control" type="text" placeholder="ชื่อผู้ใช้งาน (Username)" id="username" name="username">
                </div>
              </div>
              <div class="form-group">
                <div class="col-lg-12">
                  <input class="form-control" type="password" placeholder="รหัสผ่าน (Password)" id="password" name="password">
                </div>
              </div>
              <center>
                <input class="btn btn-md btn-block btn-success" type="submit" value="เข้าสู่ระบบ">
              </center>
            </div>
            <?php
            if ($row['id'] == 0)
            {
            ?>
            <!-- รายละเอียดข้อมูลรหัส -->
            <span class="pull-left text-danger">
              <h5>หมายเหตุ : กรุณาเข้าสู่ระบบด้วยชื่อและรหัสผู้ใช้งานที่อยู่ในคู่มือการใช้งาน</h5>
            </span>
            <?php
            }
            ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
