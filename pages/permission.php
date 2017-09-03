<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
      ?>
      <script src="../dist/js/personnel.js"></script>
</head>

<body>

    <div id="wrapper">
      <!-- Navigation -->
      <?php include '_navbar.php'; ?>
      <!-- ./Navigation -->
        <div id="page-wrapper">
          <div class="row">
              <div class="col-lg-12">
                  <h3 class="page-header">กำหนดสิทธิ์การใช้งาน</h3>
              </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <ul class="breadcrumb">
                <li><a href="personnel.php">การจัดการข้อมูลบุคลากร</a></li>
                <li class="active">กำหนดสิทธิ์การใช้งาน</li>
              </ul>
            </div>
          </div>
          <?php
          switch ($_SESSION['user_type']) {
            case 0:
            {
              ?>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                      <label for="sel1">เรียกดูตามหน่วยงาน : </label>
                      <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">เลือกหน่วยงานที่ต้องการ
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">

                        <?php
                        $sql = "Select * from department Order by department_name ASC";
                        $result = $conn->query($sql);
                        $result_row = mysqli_num_rows($result);
                        if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
                        {
                          while($row = $result->fetch_assoc())
                          {
                            ?>
                            <li><a href="?id=<?php echo $row['department_id']?>"><?php echo $row['department_name']; ?></a></li>
                            <?php
                          }
                        }
                        else
                        {
                          ?>
                          <li>ไม่มีข้อมูลหน่วยงาน</li>
                          <?php
                        }
                        ?>
                        </ul>
                        </div>
                    </div>
                </div>
              </div>
              <?php
              if (isset($_GET['id'])) {
                $sql = "SELECT department_name FROM department WHERE department_id = ".$_GET['id'];
                $result = $conn->query($sql);
                $col = $result->fetch_assoc()
                ?>
                <div class="row">
                  <div class="col-lg-12">
                   <h4>หน่วยงาน : <?php echo $col['department_name'];?></h4>
                  </div>
                </div>
                <?php

                include 'personnel/set_permission/table.php';
                include 'personnel/set_permission/modal.php';
    
              }
              else
              {
                ?>
                <br />
                <h4 class="text-center">---- กรุณาเลือกหน่วยงาน ----</h4>
                <br />
                <?php
              }
            }
              break;
            case 4:
            {
              ?>
              <div class="row">
                <div class="col-lg-12">
                 <h4>หน่วยงาน : <?php echo $_SESSION['department'];?></h4>
                </div>
              </div>
              <?php
              include 'personnel/set_permission/table.php';
              include 'personnel/set_permission/modal.php';
            }
              break;

          }

          ?>

    </div>
    <!-- /#wrapper -->

</body>
</html>
