<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
      ?>
      <script src="../dist/js/user.js"></script>
</head>

<body>

    <div id="wrapper">
      <!-- Navigation -->
      <?php include '_navbar.php'; ?>
      <!-- ./Navigation -->
        <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">ข้อมูลการจองรถยนต์ของผู้ใช้งาน</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                    <div class="panel-heading clearfix">
                    
                    <h3 class="panel-title pull-left" style="padding-top: 7.5px;">
                    รายการจองใช้รถยนต์ส่วนตัว
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
                    

                    <div class="btn-group pull-left">
                    &nbsp;สถานะ :
                    
                    <select name="status" class="form-control" required="required">
                        <option value="all">แสดงทุกสถานะ</option>
                        <option value="0">รอยืนยัน</option>
                        <option value="1">จองสำเร็จ</option>
                        <option value="2">จองไม่สำเร็จ</option>
                        <option value="3">ยกเลิก</option>
                    </select>
                    
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
                                <?php include 'user/table.php';?>
                                <?php include 'user/modal.php';?>
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
                                $linkURL = "user_list.php?page=".($page-1);
                                if(isset($_POST['search_box'])){$linkURL .= "&word=".$_POST['search_box'];}
                                if(isset($_POST['search_sdate'])){$linkURL .= "&sdate=".$_POST['search_sdate'];}
                                if(isset($_POST['search_ldate'])){$linkURL .= "&ldate=".$_POST['search_ldate'];}
                                if(isset($_POST['status'])){$linkURL .= "&status=".$_POST['status'];}
                            }
                            ?>
                            <a href="<?php echo $linkURL;?>">&laquo;</a>
                        </li>
                        <?php
                    }

                    for ($i=1; $i <= $total_page ; $i++)
                    {
                        $linkURL = "user_list.php?page=".$i;
                        if(isset($_POST['search_box'])){$linkURL .= "&word=".$_POST['search_box'];}
                        if(isset($_POST['search_sdate'])){$linkURL .= "&sdate=".$_POST['search_sdate'];}
                        if(isset($_POST['search_ldate'])){$linkURL .= "&ldate=".$_POST['search_ldate'];}
                        if(isset($_POST['status'])){$linkURL .= "&status=".$_POST['status'];}
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
                                $linkURL = "user_list.php?page=".($page+1);
                                if(isset($_POST['search_box'])){$linkURL .= "&word=".$_POST['search_box'];}
                                if(isset($_POST['search_sdate'])){$linkURL .= "&sdate=".$_POST['search_sdate'];}
                                if(isset($_POST['search_ldate'])){$linkURL .= "&ldate=".$_POST['search_ldate'];}
                                if(isset($_POST['status'])){$linkURL .= "&status=".$_POST['status'];}
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
