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
                <h3 class="page-header">แก้ไขข้อมูลส่วนตัว</h3>
              </div>
            </div>
            <!-- /.row -->
            <form id="editprofileform" class="form-horizontal" action="user/update_profile.php" method="post">
              <!-- คำนำหน้าชื่อ -->
              <div class="row" style="margin-left:10px;">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="requestfield">*</span> คำนำหน้าชื่อ: </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  <?php
                  $sql = "select * from title_name Order by title_name_id ASC";
                  $result = $conn->query($sql);
                  echo "<select name='title_name' class='form-control' style='width:100px;' required>";
                  while($row = $result->fetch_array())
                  {
                    if($row['title_name'] === $_SESSION['title_name'])
                    {
                      echo "<option value='".$row['title_name']."' selected>".$row['title_name']."</option> ";
                    }
                    else
                    {
                      echo "<option value='".$row['title_name']."'>".$row['title_name']."</option> ";
                    }

                  }
                  echo "</select>";
                  ?>
                  </div>
                </div>
              </div>
              <!-- ชื่อนามสกุล -->
              <div class="row" style="margin-left:10px;">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="requestfield">*</span> ชื่อ-นามสกุล: </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="user_name" id="user_name"
                  placeholder="ชื่อ-นามสกุล" value="<?php echo $_SESSION['user_name'] ?>" style="width:300px" required>
                  </div>
                </div>
              </div>
              <!-- อีเมลล์ -->
              <div class="row" style="margin-left:10px;">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email: </label>
                  <div class="col-xs-9 col-sm-9 col-xs-12">
                  <input type="email" name="email" class="form-control"
                  value="<?php echo $_SESSION['email'] ?>" style="width: 300px" readonly>
                  </div>
                </div>
              </div>
              <!-- เบอร์โทรศัพท์ -->
              <div class="row" style="margin-left:10px;">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="requestfield">*</span> เบอร์โทรศัพท์: </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="tel" name="phonenumber" class="form-control"
                    value="<?php echo $_SESSION['phone_number'] ?>"
                    maxlength="15" style="width:150px" required>
                  </div>
                </div>
              </div>
              <!-- หน่วยงาน -->
              <div class="row" style="margin-left:10px;">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="requestfield">*</span> หน่วยงาน: </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  <?php
                  $sql = "select * from department Order by department_id ASC";
                  $result = $conn->query($sql);
                  echo "<select name='department' class='form-control' style='width:200px;' required>";
                  while($row = $result->fetch_array())
                  {
                    if($row['department_name'] === $_SESSION['department'])
                    {
                      echo "<option value='".$row['department_name']."' selected>".$row['department_name']."</option> ";
                    }
                    else
                    {
                      echo "<option value='".$row['department_name']."'>".$row['department_name']."</option> ";
                    }

                  }
                  echo "</select>";
                  ?>
                  </div>
                </div>
              </div>
              <!-- ตำแหน่ง -->
              <div class="row" style="margin-left:10px;">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="requestfield">*</span> ตำแหน่ง: </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  <?php
                  $sql = "select * from position  Order by position_id ASC";
                  $result = $conn->query($sql);
                  echo "<select name='position' class='form-control' style='width:200px;' required>";
                  while($row = $result->fetch_array())
                  {
                    if($row['position_name'] === $_SESSION['position'])
                    {
                      echo "<option value='".$row['position_name']."' selected>".$row['position_name']."</option> ";
                    }
                    else
                    {
                      echo "<option value='".$row['position_name']."'>".$row['position_name']."</option> ";
                    }

                  }
                  echo "</select>";
                  ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                  <button type="button" id="cancel_btn" class="btn btn-default">ยกเลิก</button>
                  <button type="submit" class="btn btn-primary" name="save_btn">บันทึก</button>
                </div>
              </div>
            </form>
            </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

</body>
</html>
