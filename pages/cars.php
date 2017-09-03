<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
      ?>
      <script src="../dist/js/cars.js"></script>
</head>

<body>

    <div id="wrapper">
      <!-- Navigation -->
      <?php include '_navbar.php'; ?>
      <!-- ./Navigation -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">การจัดการข้อมูลรถยนต์</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-6 col-md-6  col-sm-6 col-xs-6">
                <a class='btn btn-success' id="btn_insert_modal" data-toggle="modal" data-target="#Insert_modal">
                  เพิ่มข้อมูล
                </a>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
                  <div class="input-group">
                    <input name="search_box" type="text" class="form-control" placeholder="พิมพ์เพื่อค้นหา">
                    <div class="input-group-btn">
                      <button class="btn btn-default handleSearch" name="handleSearch" type="submit">
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
                                    <?php include 'cars/table.php';?>
                                    </div>
                                    <?php include 'cars/modal.php'; ?>
                                </div>

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
