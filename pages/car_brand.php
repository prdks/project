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

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="pull-left" style="margin-left: -5px;">
                          <a class='btn btn-sm btn-success' role='button' data-toggle="modal" data-target="#Insert_modal">
                          <i class="fa fa-plus" data-toggle='tooltip' data-placement='top' title='เพิ่มข้อมูล'></i>
                          </a>
                        </div>
                        
                        <h3 class="panel-title pull-left" style="padding-top: 7.5px;">
                        &nbsp; ข้อมูลยี่ห้อรถยนต์
                        </h3>
                        
                        <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
                        <div class="btn-group pull-right">
                          ค้นหาข้อมูล :
                          <input name="search_box" type="text" placeholder="พิมพ์ข้อความ" class="custom_input">
                          <button class="btn pull-right btn-default handleSearch" type="submit" style="height: 30px;">
                            <i class="fa fa-search"></i>
                          </button>
                        </div>
                      </form>
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
