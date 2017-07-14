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
          <br />
              <div class="row">
                <div class="col-sm-12 col-xs-12">
                  <i class="fa fa-square fa-fw c-ap"></i> : รอนุมัติ /
                  <i class="fa fa-square fa-fw c-suc"></i> : อนุมัติแล้ว /
                  <i class="fa fa-square fa-fw c-cancel"></i> : จองไม่สำเร็จ,ยกเลิก
                </div>
              </div>
          <br />
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>
</html>
