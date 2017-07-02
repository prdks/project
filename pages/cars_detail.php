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
      <?php include '_navbar.php'; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">รายละเอียดรถยนต์</h3>
                </div>
            </div>

            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pull-right">
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

            <br />

            <div class="row">
                <div class="col-lg-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        ข้อมูลบุคลากร
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class='table-responsive'>
                                    <?php include 'querydata/cars_detail/table.php';  ?>
                                    </div>
                                    <?php include 'querydata/cars_detail/modal.php';  ?>
                                </div>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>





        </div>
    </div>
</body>
</html>
