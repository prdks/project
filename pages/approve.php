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
                    <h3 class="page-header">รายการรออนุมัติการจอง</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <ul class="breadcrumb">
              <li><a href="reserve_approve.php">รายการรออนุมัติการจอง</a></li>
              <li class="active">ดำเนินการอนุมัติ</li>
            </ul>

            <div class="row">
                <div class="col-lg-10 col-md-9 col-sm-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            รายละเอียด
                        </div>

                        </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            รายการอนุมัติ
                            <i class="pull-right fa fa-chevron-up"></i>
                        </div>
                        <div class="panel-body">
                            <button class="btn btn-success" type="button" name="button">อนุมัติ</button>
                            <button class="btn btn-danger" type="button" name="button">ไม่อนุมัติ</button>
                            <button class="btn btn-defualt" type="button" name="button">ยกเลิก</button>
                            <br /><br />
                          <ul class="nav nav-tabs span2 clearfix"></ul>
                          <br />
                          <i class="fa fa-bookmark"></i> ลำดับการอนุมัติ
                        </div>

                        </div>
                        <!-- /.panel -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>
</html>
