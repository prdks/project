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
                  <h3 class="page-header">กำหนดสิทธิ์การใช้งาน</h3>
              </div>
          </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            ข้อมูลบุคลากร
                        </div>
                        <!-- /.panel-heading -->
                        <div class='table-responsive'>
                        <?php include 'personnel/set_permission/table.php';?>
                        </div>
                        <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>
</html>
