<!DOCTYPE html>
<html lang="en">

<head>
        <?php
        include '_head.php';
        ?>
      <script src="../dist/js/approve.js"></script>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                    <div class="panel-heading clearfix">
                    
                    <h3 class="panel-title pull-left" style="padding-top: 7.5px;">
                    รายการรออนุมัติ
                    </h3>

                </div>
                <div class="panel-body bodysearch clearfix">
                    <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST" class="form-inline">

                        <div class="input-group pull-left">
                            <span class="input-group-addon">วันที่จอง</span>
                            <input type="date" name="search_sdate" class="form-control">
                            <span class="input-group-addon">ถึง</span>
                            <input type="date" name="search_ldate" class="form-control">
                        </div>
                        <div class="btn-group pull-right">
                            ค้นหาข้อมูล :
                            <input name="search_box" type="text" placeholder="พิมพ์ข้อความ" class="form-control">
                                <button class="btn pull-right btn-default handleSearch" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                 <?php
                 switch ($_SESSION['user_type']) {
                    case 0:
                    {
                      include 'reservation/reserve_approve/table-0.php';
                    }
                      break;
                    
                    case 4:
                    {
                      include 'reservation/reserve_approve/table-4.php';
                    }
                      break;
                    case 5:
                    {
                      include 'reservation/reserve_approve/table-5-6.php';
                    }
                      break;
                    case 6:
                    {
                      include 'reservation/reserve_approve/table-5-6.php';
                    }
                      break;
                  }
                 ?>
                 </div>

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
                                    $linkURL = "reserve_ma.php?page=".($page-1);
                                    if(isset($_POST['search_box'])){$linkURL .= "&word=".$_POST['search_box'];}
                                    if(isset($_POST['search_sdate'])){$linkURL .= "&sdate=".$_POST['search_sdate'];}
                                    if(isset($_POST['search_ldate'])){$linkURL .= "&ldate=".$_POST['search_ldate'];}
                                }
                                ?>
                                <a href="<?php echo $linkURL;?>">&laquo;</a>
                            </li>
                            <?php
                        }

                        for ($i=1; $i <= $total_page ; $i++)
                        {
                            $linkURL = "reserve_approve.php?page=".$i;
                            if(isset($_POST['search_box'])){$linkURL .= "&word=".$_POST['search_box'];}
                            if(isset($_POST['search_sdate'])){$linkURL .= "&sdate=".$_POST['search_sdate'];}
                            if(isset($_POST['search_ldate'])){$linkURL .= "&ldate=".$_POST['search_ldate'];}
                            ?>
                            <li <?php if($page==$i){echo 'class=active';}?> ><a href="<?php echo $linkURL; ?>"><?php echo $i; ?></a></li>
                            <?php
                        }


                        if($total_page > 1)
                        {
                            ?>
                            <li <?php if($page==$total_page){echo 'disabled';}?>>
                                <?php if($page == $total_page){ $linkURL = "";}
                                else{
                                    $linkURL = "reserve_approve.php?page=".($page+1);
                                    if(isset($_POST['search_box'])){$linkURL .= "&word=".$_POST['search_box'];}
                                    if(isset($_POST['search_sdate'])){$linkURL .= "&sdate=".$_POST['search_sdate'];}
                                    if(isset($_POST['search_ldate'])){$linkURL .= "&ldate=".$_POST['search_ldate'];}
                                } ?>
                                <a href="<?php echo $linkURL;?>">&raquo;</a>
                            </li>
                            <?php
                        }
                        ?>
                        
                    </ul>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include 'reservation/reserve_approve/modal.php';?>
</body>
</html>
