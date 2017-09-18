<?php
 $rows = 10;

if(isset($_GET['d']))
{
    $sql = "
    SELECT
        psn.* , t.* , p.* , d.* , type.*
    FROM personnel psn
    LEFT OUTER JOIN title_name t
        ON psn.title_name_id = t.title_name_id
    LEFT OUTER JOIN  position p
        ON psn.position_id = p.position_id
    LEFT OUTER JOIN  department  d
        ON psn.department_id = d.department_id
    LEFT OUTER JOIN  user_type type
        ON psn.user_type_id = type.user_type_id
    WHERE type.user_type_id = ".$_GET['t']."
    AND d.department_id = '".$_GET['d']."'
    ORDER BY psn.personnel_name ASC";
    
    $total_data = mysqli_num_rows($conn->query($sql));
    $total_page = ceil($total_data/$rows);
    if(isset($_GET['page'])){$page = $_GET['page'];}
    else{$page = '';}
    if($page==""){ $page = 1;}
    $start =  ($page-1) * $rows;
    if($page != 1){$count = ($page*$rows)-$rows; $start_count = $count;}
    else{$count = 0; $start_count = $count;}
  
    $sql .= " Limit $start,$rows";
    $result = $conn->query($sql);
    $result_row = mysqli_num_rows($result);

    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
    {
        $a = $conn->query("select department_name from department where department_id = ".$_GET['d']);
        $a = $a->fetch_assoc();
        $b = $conn->query("select user_type_name from user_type where user_type_id = ".$_GET['t']);
        $b = $b->fetch_assoc();
        ?>
        <div class="row">
            <div class="col-lg-12">
            <p>
                <i class="fa fa-search fa-fw"></i>
                ผลการค้นหา : <?php echo $a['department_name'];?>,
                ประเภท<?php echo $b['user_type_name'];?>
                <a href="permission.php" class="text-danger"><i class="fa fa-times" data-toggle="tooltip" title="ลบการค้นหา"></i></a>
            </p>
          <div class="panel panel-primary">
              <div class="panel-heading">ข้อมูลบุคลากร</div>
              <div class='table-responsive'>
              <table id="myTable" class="table table-striped table-bordered table-hover">
                  <thead id="Table_Default">
                      <tr>
                          <th id="tb_sharp">ลำดับ</th>
                          <th id="tb_detail_main">ชื่อบุคลากร</th>
                          <th id="tb_detail_sub-nd">ตำแหน่ง</th>
                          <th id="tb_tools_ismore">เครื่องมือ</th>
                      </tr>
                  </thead>
                  <tbody>
        <?php
      while($row = $result->fetch_assoc())
      {
        $count += 1;
        ?>
              <tr>
              <td class="text-center"><?php echo $count ?></td>
              <td><?php echo $row["title_name"].$row["personnel_name"]; ?></td>
              <td><?php echo $row["position_name"]; ?></td>

              <td class="text-center">
              <button type="submit" class="btn btn-primary handlePermission" role="button"
              data-toggle="modal" data-target="#Set_permission_modal" data-id="<?php echo $row["personnel_id"];?>">
                  <span class="fa fa-gear"></span> กำหนดสิทธิ์
              </button>
              </td>
              </tr>

        <?php
      }
      
    ?>
            </tbody>
            </table>
            </div>
            </div>
        </div>
    </div>
    <span class="pull-left"><?php if($total_data != 0){ $start_count++; } else { $start_count= 0; } echo "แสดง ".$start_count." ถึง ".$count." จากทั้งหมด ".$total_data." รายการ"; ?></span>
    <ul class="pagination pagination-md pull-right" style="margin:0px;">
        <?php
        if($total_page > 1)
        {
            ?>
            <li <?php if($page==1){echo 'disabled';}?>>
                <?php
                if($page == 1){ $linkURL = "";}
                else{ 
                    if(isset($_GET['d'])){$linkURL = "permission.php?page=".($page-1)."&d=".$_GET['d']."&t=".$_GET['t'];}
                    else{$linkURL = "permission.php?page=".($page-1);}
                }
                ?>
                <a href="<?php echo $linkURL;?>">&laquo;</a>
            </li>
            <?php
        }

        if(isset($_GET['d']))
        {
            for ($i=1; $i <= $total_page ; $i++)
            {
                ?>
                <li <?php if($page==$i){echo 'class=active';}?> ><a href="permission.php?page=<?php echo $i."&d=".$_GET['d']."&t=".$_GET['t']?>"><?php echo $i; ?></a></li>
                <?php
            }
        }
        else 
        {
            for ($i=1; $i <= $total_page ; $i++)
            {
                ?>
                <li <?php if($page==$i){echo 'class=active';}?> ><a href="permission.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php
            }
        }
        

        if($total_page > 1)
        {
            ?>
            <li <?php if($page==$total_page){echo 'disabled';}?>>
                <?php if($page == $total_page){ $linkURL = "";}
                else{
                    if(isset($_GET['d'])){$linkURL = "permission.php?page=".($page+1)."&d=".$_GET['d']."&t=".$_GET['t'];}
                    else{$linkURL = "permission.php?page=".($page+1);}
                } ?>
                <a href="<?php echo $linkURL;?>">&raquo;</a>
            </li>
            <?php
        }
        ?>
        
    </ul>
    <?php
    }
    else 
    {   
        $a = $conn->query("select department_name from department where department_id = ".$_GET['d']);
        $a = $a->fetch_assoc();
        $b = $conn->query("select user_type_name from user_type where user_type_id = ".$_GET['t']);
        $b = $b->fetch_assoc();
        ?>
        <div class="row">
            <div class="col-lg-12">
            <p>
                <i class="fa fa-search fa-fw"></i>
                ผลการค้นหา : <?php echo $a['department_name'];?>,
                ประเภท<?php echo $b['user_type_name'];?>
                <a href="permission.php" class="text-danger"><i class="fa fa-times" data-toggle="tooltip" title="ลบการค้นหา"></i></a>
            </p>
          <div class="panel panel-primary">
              <div class="panel-heading">ข้อมูลบุคลากร</div>
              <div class='table-responsive'>
              <table id="myTable" class="table table-striped table-bordered table-hover">
                  <thead id="Table_Default">
                      <tr>
                          <th id="tb_sharp">ลำดับ</th>
                          <th id="tb_detail_main">ชื่อบุคลากร</th>
                          <th id="tb_detail_sub-nd">ตำแหน่ง</th>
                          <th id="tb_tools_ismore">เครื่องมือ</th>
                      </tr>
                  </thead>
                  <tbody>
                  <tr><td colspan="4" class="text-center"><br><p>ไม่มีข้อมูลบุคลากร</p><br></td></tr>
                  </tbody>
                  </table>
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
}
elseif (isset($_GET['p'])) 
{
    $sql = "
    SELECT
        psn.* , t.* , p.* , d.* , type.*
    FROM personnel psn
    LEFT OUTER JOIN title_name t
        ON psn.title_name_id = t.title_name_id
    LEFT OUTER JOIN  position p
        ON psn.position_id = p.position_id
    LEFT OUTER JOIN  department  d
        ON psn.department_id = d.department_id
    LEFT OUTER JOIN  user_type type
        ON psn.user_type_id = type.user_type_id
    WHERE psn.personnel_name LIKE '%".$_GET['p']."%'
    ORDER BY psn.personnel_name ASC";
    
    $total_data = mysqli_num_rows($conn->query($sql));
    $total_page = ceil($total_data/$rows);
    if(isset($_GET['page'])){$page = $_GET['page'];}
    else{$page = '';}
    if($page==""){ $page = 1;}
    $start =  ($page-1) * $rows;
    if($page != 1){$count = ($page*$rows)-$rows; $start_count = $count;}
    else{$count = 0; $start_count = $count;}
  
    $sql .= " Limit $start,$rows";
    $result = $conn->query($sql);
    $result_row = mysqli_num_rows($result);

    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
    {
        ?>
        <div class="row">
            <div class="col-lg-12">
            <p>
                <i class="fa fa-search fa-fw"></i>
                ผลการค้นหา : <?php echo $_GET['p'];?>
                <a href="permission.php" class="text-danger"><i class="fa fa-times" data-toggle="tooltip" title="ลบการค้นหา"></i></a>
            </p>
          <div class="panel panel-primary">
              <div class="panel-heading">ข้อมูลบุคลากร</div>
              <div class='table-responsive'>
              <table id="myTable" class="table table-striped table-bordered table-hover">
                  <thead id="Table_Default">
                      <tr>
                          <th id="tb_sharp">ลำดับ</th>
                          <th id="tb_detail_main">ชื่อบุคลากร</th>
                          <th id="tb_detail_sub-nd">ประเภทผู้ใช้งาน</th>
                          <th id="tb_tools_ismore">เครื่องมือ</th>
                      </tr>
                  </thead>
                  <tbody>
        <?php
      while($row = $result->fetch_assoc())
      {
        $count += 1;
        ?>
              <tr>
              <td class="text-center"><?php echo $count ?></td>
              <td><?php echo $row["title_name"].$row["personnel_name"]; ?></td>
              <td><?php echo $row['user_type_name']; ?></td>
              <td class="text-center">
              <button type="submit" class="btn btn-primary handlePermission" role="button"
              data-toggle="modal" data-target="#Set_permission_modal" data-id="<?php echo $row["personnel_id"];?>">
                  <span class="fa fa-gear"></span> กำหนดสิทธิ์
              </button>
              </td>
              </tr>

        <?php
      }
      
    ?>
            </tbody>
            </table>
            </div>
            </div>
        </div>
    </div>
    <span class="pull-left"><?php if($total_data != 0){ $start_count++; } else { $start_count= 0; } echo "แสดง ".$start_count." ถึง ".$count." จากทั้งหมด ".$total_data." รายการ"; ?></span>
    <ul class="pagination pagination-md pull-right" style="margin:0px;">
        <?php
        if($total_page > 1)
        {
            ?>
            <li <?php if($page==1){echo 'disabled';}?>>
                <?php
                if($page == 1){ $linkURL = "";}
                else{ 
                    if(isset($_GET['p'])){$linkURL = "permission.php?page=".($page-1)."&p=".$_GET['p'];}
                    else{$linkURL = "permission.php?page=".($page-1);}
                }
                ?>
                <a href="<?php echo $linkURL;?>">&laquo;</a>
            </li>
            <?php
        }

        if(isset($_GET['p']))
        {
            for ($i=1; $i <= $total_page ; $i++)
            {
                ?>
                <li <?php if($page==$i){echo 'class=active';}?> ><a href="permission.php?page=<?php echo $i."&p=".$_GET['p']?>"><?php echo $i; ?></a></li>
                <?php
            }
        }
        else 
        {
            for ($i=1; $i <= $total_page ; $i++)
            {
                ?>
                <li <?php if($page==$i){echo 'class=active';}?> ><a href="permission.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php
            }
        }
        

        if($total_page > 1)
        {
            ?>
            <li <?php if($page==$total_page){echo 'disabled';}?>>
                <?php if($page == $total_page){ $linkURL = "";}
                else{
                    if(isset($_GET['d'])){$linkURL = "permission.php?page=".($page+1)."&p=".$_GET['p'];}
                    else{$linkURL = "permission.php?page=".($page+1);}
                } ?>
                <a href="<?php echo $linkURL;?>">&raquo;</a>
            </li>
            <?php
        }
        ?>
        
    </ul>
    <?php
    }
    else 
    {   
        ?>
        <div class="row">
            <div class="col-lg-12">
            <p>
                <i class="fa fa-search fa-fw"></i>
                ผลการค้นหา : <?php echo $_GET['p'];?>
                <a href="permission.php" class="text-danger"><i class="fa fa-times" data-toggle="tooltip" title="ลบการค้นหา"></i></a>
            </p>
          <div class="panel panel-primary">
              <div class="panel-heading">ข้อมูลบุคลากร</div>
              <div class='table-responsive'>
              <table id="myTable" class="table table-striped table-bordered table-hover">
                  <thead id="Table_Default">
                      <tr>
                          <th id="tb_sharp">ลำดับ</th>
                          <th id="tb_detail_main">ชื่อบุคลากร</th>
                          <th id="tb_detail_sub-nd">ประเภทผู้ใช้งาน</th>
                          <th id="tb_tools_ismore">เครื่องมือ</th>
                      </tr>
                  </thead>
                  <tbody>
                  <tr><td colspan="4" class="text-center"><br><p>ไม่มีข้อมูลบุคลากร</p><br></td></tr>
                  </tbody>
                  </table>
                  </div>
                  </div>
              </div>
          </div>
        <?php
    }
}
else 
{
?>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">ดูข้อมูลตามหน่วยงานและประเภท</h3>
            </div>
            <div class="panel-body">
            <form action="<?= $_SERVER['PHP_SELF']?>" method="get" class="form-horizontal">

                <div class="form-group">
                <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">
                หน่วยงาน :
                </label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <select name="d" class="form-control">
                    <?php
                    $sql = "Select * from department Order by department_name ASC";
                    $result = $conn->query($sql);
                    $result_row = mysqli_num_rows($result);
                    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
                    {
                    while($row = $result->fetch_assoc())
                    {
                        ?>
                        <option value="<?php echo $row['department_id'];?>"><?php echo $row['department_name'];?></option>
                        <?php
                    }
                    }
                    else
                    {
                    ?>
                    <option value="NULL">ไม่มีข้อมูลหน่วยงาน</option>
                    <?php
                    }
                    ?>
                    </select>
                </div>
                </div>
            
                <div class="form-group">
                <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">
                ประเภทผู้ใช้งาน :
                </label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <select name="t" class="form-control">
                    <?php
                    $sql = "Select * from user_type Order by user_level ASC";
                    $result = $conn->query($sql);
                    $result_row = mysqli_num_rows($result);
                    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
                    {
                    while($row = $result->fetch_assoc())
                    {
                        ?>
                        <option value="<?php echo $row['user_type_id'];?>"><?php echo $row['user_type_name'];?></option>
                        <?php
                    }
                    }
                    else
                    {
                    ?>
                    <option value="NULL">ไม่มีข้อมูลหน่วยงาน</option>
                    <?php
                    }
                    ?>
                    </select>
                </div>
                </div>

            
            </div>
            <div class="panel-footer text-right">
            <button type="submit" class="btn btn-default">เรียกดู</button>
            </div>
            </form>
            </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">ดูข้อมูลตามรายชื่อ</h3>
            </div>
            <div class="panel-body">
            <form action="<?= $_SERVER['PHP_SELF']?>" method="get" class="form-horizontal">
            <br>
                <div class="form-group">
                <label class="col-lg-4 col-md-4 col-sm-4 col-xs-12 control-label">
                ชื่อบุคลากร :
                </label>
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <input type="text" name="p" placeholder="พิมพ์ชื่อบุคลากร" class="form-control" required>
                </div>
                </div>
                <br>
            </div>
            <div class="panel-footer text-right">
            <button type="submit" class="btn btn-default">เรียกดู</button>
            </div>
            </form>
            </div>
    </div>
</div>






  <br>
<?php
}
?>