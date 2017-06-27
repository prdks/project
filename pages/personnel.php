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
                    <h3 class="page-header">การจัดการข้อมูลบุคลากร</h3>
                </div>
            </div>

            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a class="btn btn-success" id="btn_insert_modal" data-toggle="modal" data-target="#Insert_modal">
                  เพิ่มข้อมูล
                </a>
                <a class="btn btn-danger" id="btn_delet_modal" data-toggle="modal" data-target="#Delete_modal">
                  ลบข้อมูล
                </a>
                <a class="btn btn-info" href="permission.php">
                  กำหนดสิทธิ์
                </a>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
                  <div class="input-group">
                    <input name="search_box" type="text" class="form-control" placeholder="พิมพ์เพื่อค้นหา">
                    <div class="input-group-btn">
                      <button class="btn btn-default" name="handleSearch" type="submit">
                        <i class="glyphicon glyphicon-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
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
                        <?php include 'personnel/table.php';?>
                        </div>
                        <?php include 'personnel/modal.php'; ?>
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
