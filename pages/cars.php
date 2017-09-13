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

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                                <div class="panel panel-primary">
                                <div class="panel-heading clearfix">
                                  <div class="pull-left" style="margin-left: -5px;">
                                    <a class='btn btn-sm btn-success' role='button' data-toggle="modal" data-target="#Insert_modal">
                                    <i class="fa fa-plus" data-toggle='tooltip' data-placement='top' title='เพิ่มข้อมูล'></i>
                                    </a>
                                  </div>
                                  
                                  <h3 class="panel-title pull-left" style="padding-top: 7.5px;">
                                  &nbsp; ข้อมูลรถยนต์
                                  </h3>
                                  
                                  <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST">
                                  <div class="btn-group pull-right">
                                    ค้นหาข้อมูล :
                                    <input name="search_box" type="text" placeholder="พิมพ์ข้อความ" class="custom_input">
                                    <button class="btn pull-right btn-default handleSearch" name="handleSearch" type="submit" style="height: 30px;">
                                      <i class="fa fa-search"></i>
                                    </button>
                                  </div>
                                </form>
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
