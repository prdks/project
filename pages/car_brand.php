<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
      ?>
      <script src="../dist/js/car_brand.js"></script>
</head>

<body>
    <div id="wrapper">
      <!-- Navigation -->
      <?php include '_navbar.php'; ?>
      <!-- ./Navigation -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">การจัดการข้อมูลยี่ห้อรถยนต์</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-6 col-xs-4">
                <a class='btn btn-success' role='button' data-toggle="modal" data-target="#Insert_modal">
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ข้อมูลยี่ห้อรถยนต์
                        </div>
                        <!-- /.panel-heading -->
                              <!-- /.panel-body -->
                                <div class="table-responsive">
                                    <?php include 'car_brand/table.php'; ?>
                                </div>
                                <!-- /.table-responsive -->
                                <?php include 'car_brand/modal.php'; ?>
                            <!-- /.panel-body -->
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
