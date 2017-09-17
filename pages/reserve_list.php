<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
      ?>
      <script src="../dist/js/querydata.js"></script>
</head>

<body>

    <div id="wrapper">
      <!-- Navigation -->
      <?php include '_navbar.php'; ?>
      <!-- ./Navigation -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">ข้อมูลการจองรถยนต์</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left" style="padding-top: 7.5px;">
                        รายการจองใช้รถยนต์
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
                                    <?php include 'reservation/reserve_list/table.php';?>
                                <!-- /.table-responsive -->
                                    <?php include 'reservation/reserve_list/modal.php';?>
                            <!-- /.panel-body -->
                        </div>
                        <span class="pull-left">
                            <?php 
                            if($total_data != 0){ $start_count++; }
                            else { $start_count= 0; }

                            echo "แสดง ".$start_count." ถึง ".$count." จากทั้งหมด ".$total_data." รายการ"; 
                            ?>
                        </span>
                        <ul class="pagination pagination-md pull-right" style="margin:0px;">
                        <?php
                        if($total_page > 1)
                        {
                            ?>
                            <li <?php if($page==1){echo 'disabled';}?>>
                                <?php
                                if($page == 1){ $linkURL = "";}
                                else{ 
                                    if(isset($_POST['search_box'])){$linkURL = "reserve_ma.php?page=".($page-1)."&word=".$_POST['search_box'];}
                                    else{$linkURL = "reserve_ma.php?page=".($page-1);}
                                }
                                ?>
                                <a href="<?php echo $linkURL;?>">&laquo;</a>
                            </li>
                            <?php
                        }

                        if(isset($_POST['search_box']))
                        {
                            for ($i=1; $i <= $total_page ; $i++)
                            {
                                ?>
                                <li <?php if($page==$i){echo 'class=active';}?> ><a href="reserve_ma.php?page=<?php echo $i.'&word='.$_POST['search_box']; ?>"><?php echo $i; ?></a></li>
                                <?php
                            }
                        }
                        else 
                        {
                            for ($i=1; $i <= $total_page ; $i++)
                            {
                                ?>
                                <li <?php if($page==$i){echo 'class=active';}?> ><a href="reserve_ma.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php
                            }
                        }
                        

                        if($total_page > 1)
                        {
                            ?>
                            <li <?php if($page==$total_page){echo 'disabled';}?>>
                                <?php if($page == $total_page){ $linkURL = "";}
                                else{
                                    if(isset($_POST['search_box'])){$linkURL = "reserve_ma.php?page=".($page+1)."&word=".$_POST['search_box'];}
                                    else{$linkURL = "reserve_ma.php?page=".($page+1);}
                                } ?>
                                <a href="<?php echo $linkURL;?>">&raquo;</a>
                            </li>
                            <?php
                        }
                        ?>
                        
                    </ul>
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
