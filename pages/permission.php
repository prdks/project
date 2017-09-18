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
              include 'personnel/set_permission/foradmin.php';
            }
              break;
            
            case 4:
            {
              include 'personnel/set_permission/foruser.php';
            }
              break;
          }

          include 'personnel/set_permission/modal.php';
          ?>

    </div>
    <!-- /#wrapper -->

</body>
</html>
