<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
        // googleAuth.file
        include '_googleauth.php';
      ?>
</head>

<body>

    <div id="wrapper">
      <!-- Navigation -->
      <?php include '_navbar.php'; ?>
      <!-- ./Navigation -->
        <div id="page-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <h3 class="page-header">เพิ่มข้อมูลใหม่</h3>
              </div>
            </div>
            <!-- /.row -->
            <form id="new_user_form" class="form-horizontal" action="new_user/insert.php" method="post">
              <!-- คำนำหน้าชื่อ -->
              <div class="form-group">
                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                  <span class="requestfield">*</span> คำนำหน้าชื่อ :
                </label>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <?php
                  $sql = "select * from title_name Order by title_name_id ASC";
                  $result = $conn->query($sql);
                  echo "<select name='title_name' class='form-control' required>";
                  while($row = $result->fetch_array())
                  {
                    echo "<option value='".$row['title_name']."'>
                    ".$row['title_name']."
                    </option> ";
                  }
                  echo "</select>";
                  ?>
                </div>
              </div>
              <!-- ชื่อนามสกุล -->
              <div class="form-group">
                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                  <span class="requestfield">*</span> ชื่อ-นามสกุล :
                </label>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                  <input type="text" class="form-control" name="user_name" id="user_name"
                  placeholder="ชื่อ-นามสกุล" value="<?php echo $_SESSION['user_name'] ?>" required>
                </div>
              </div>
              <!-- อีเมลล์ -->
              <div class="form-group">
                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                  อีเมลล์ :
                </label>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                  <input type="email" name="email" class="form-control"
                  value="<?php echo $_SESSION['email'] ?>" readonly>
                </div>
              </div>
              <!-- เบอร์โทรศัพท์ -->
              <div class="form-group">
                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                  <span class="requestfield">*</span> เบอร์โทรศัพท์ :
                </label>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                  <input type="tel" name="phone_number" class="form-control"
                  value="<?php echo $_SESSION['phone_number'] ?>"
                  maxlength="15" required>
                </div>
              </div>
              <!-- หน่วยงาน -->
              <div class="form-group">
                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                <span class="requestfield">*</span> หน่วยงาน :
                </label>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                  <?php
                  $sql = "select * from department Order by department_id ASC";
                  $result = $conn->query($sql);
                  echo "<select name='department' class='form-control' required>";
                  while($row = $result->fetch_array())
                  {
                    if($row['department_name'] === $_SESSION['department']){
                      echo "<option value='".$row['department_name']."' selected>".$row['department_name']."</option> ";
                    }else {
                      echo "<option value='".$row['department_name']."'>".$row['department_name']."</option> ";
                    }

                  }
                  echo "</select>";
                  ?>
                </div>
              </div>
              <!-- ตำแหน่ง -->
              <div class="form-group">
                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                <span class="requestfield">*</span> ตำแหน่ง :
                </label>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                  <?php
                  $sql = "select * from position  Order by position_id ASC";
                  $result = $conn->query($sql);
                  echo "<select name='position' class='form-control' required>";
                  while($row = $result->fetch_array())
                  {
                    echo "<option value='".$row['position_name']."'>".$row['position_name']."</option> ";
                  }
                  echo "</select>";
                  ?>
                </div>
              </div>
              <input type="hidden" name="user_type_basic" value="ผู้ใช้งานทั่วไป">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                  <button href="index.php" onclick="deletesession()" type="reset" id="cancel_btn" class="btn btn-default">ยกเลิก</button>
                  <button type="submit" class="btn btn-primary">ตกลง</button>
                </div>
              </div>
            </form>
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <?php
    function deletesession()
    {
      session_destroy();
    }
    ?>

</body>
</html>
