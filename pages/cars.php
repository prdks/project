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

                        <!-- /.panel-heading -->
                              <!-- /.panel-body -->

                                    <?php include 'cars/table.php'; ?>

                                <!-- /.table-responsive -->
                                <?php include 'cars/modal.php'; ?>
                            <!-- /.panel-body -->

                        <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<script>
$(document).ready(function(){

    // Send data to modal_delete
    $('.handleDelete').click(function() {
      $.post("cars/modal_delete.php" ,
        {car_id: $(this).attr('id')} ,
        function(data) {
          $('#body_Delete').html(data);
        }
      );
    });

    // send data to modal detail
    $('.handleDetail').click(function() {
      $.post("cars/modal_detail.php"
      ,{car_id : $(this).attr('id')}
      ,function(data){
        $('#body_modal').html(data);
      });
    });
    //send data to modal Edit
    $('.handleEdit').click(function() {
      $.post("cars/modal_edit.php"
      ,{car_id : $(this).attr('id')}
      ,function(data){
        $('#body_Edit').html(data);
      });
    });

    

});
</script>
</body>
</html>
