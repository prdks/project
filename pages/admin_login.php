<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
        // googleAuth.file
        include '_googleauth.php';
      ?>

</head>
<body id="enterkl">
  <div class="container">
    <div class="row">
      <div id="setloginpage" class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
        <form action="admin/login.php" method="post" class="form-horizontal">
          <div class="panel panel-primary">
            <div class="panel-heading">เข้าสู่ระบบ Config Application</div>
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
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
