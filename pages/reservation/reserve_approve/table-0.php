<?php
 $rows = 20;
 
 if(isset($_GET['word'])){$_POST['search_box'] = $_GET['word'];}
 if(isset($_GET['sdate'])){$_POST['search_sdate'] = $_GET['sdate'];}
 if(isset($_GET['ldate'])){$_POST['search_ldate'] = $_GET['ldate'];}

 if(isset($_POST['search_box']))
{
    $word = $_POST['search_box'];
    ?>
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
          <thead>
              <tr>
                  <th id="tb_detail_main" class="text-center" style="width: 15%;">วันที่จองใช้รถยนต์</th>
                  <th id="tb_detail_sub-th">ช่วงเวลา</th>
                  <th id="tb_detail_main">จองใช้เพื่อ</th>
                  <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
                  <th id="tb_detail_sub-sv">สถานะการจอง</th>
                  <th id="tb_detail_sub-sv">สถานะการใช้</th>
                  <th id="tb_tools">เครื่องมือ</th>
              </tr>
          </thead>
          <tbody>
    <?php
    $department ="select * from department order by department_name ASC";
    $result = $conn->query($department);
    while($department = $result->fetch_assoc())
    {

       $sql = "
       SELECT * FROM reservation r
       LEFT JOIN cars c
       ON r.car_id = c.car_id
       LEFT JOIN personnel p
       ON r.personnel_id = p.personnel_id
       LEFT JOIN title_name t
       ON p.title_name_id = t.title_name_id
       LEFT JOIN department d
       ON p.department_id = d.department_id
       WHERE reservation_status = 0
        AND d.department_id = ".$department['department_id']." ";
       
       if($word !== '')
       {
         $sql .= "
           AND (
             r.requirement_detail like '%".$word."%'
             OR
             r.reserv_stime like '%".$word."%'
             OR
             r.reserv_etime like '%".$word."%'
             OR
             r.appointment_place like '%".$word."%'
             OR
             p.personnel_name like '%".$word."%'
             OR
             c.car_reg like '%".$word."%'
         )";
       }

       if($_POST['search_sdate'] !== '' && $_POST['search_ldate'] !== '')
       {
         $sdate = $_POST['search_sdate'];
         $ldate = $_POST['search_ldate'];
         $search_Date = "
         AND
         ((r.date_start BETWEEN '".$sdate."' AND '".$ldate."')
         OR 
         (r.date_end BETWEEN '".$sdate."' AND '".$ldate."')
         OR 
         ('".$sdate."' BETWEEN r.date_start  AND r.date_end)
         OR 
         ('".$ldate."' BETWEEN  r.date_start  AND r.date_end ))";

         $sql .= $search_Date;
       }

       $sql .= " ORDER BY r.date_start ASC ,r.reserv_stime ASC";

       

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
        <tr><td colspan="7"><?php echo $department['department_name'];?></td></tr>
        <?php
          while($row = $result->fetch_assoc())
          {
            $count++;
            ?>
            <tr>
              <td class="text-center">
                <?php 
                if($row["date_start"] === $row["date_end"])
                {
                  echo DateThai($row["date_start"]); 
                }
                else
                {
                  echo DateThai($row["date_start"]); 
                  echo "<br>ถึง ";
                  echo DateThai($row["date_end"]); 
                }
                ?>
              </td>
              <td class="text-center"><?php echo date("H:i",strtotime($row["reserv_stime"]))." - ".date("H:i",strtotime($row["reserv_etime"]))."น.";?></td>
              <td class="detail_colum" ><?php echo $row["requirement_detail"]; ?></td>
              <td class="text-center"><?php echo $row["car_reg"]; ?></td>
              <td class="text-center">
            <?php
              if ($row["reservation_status"] == 0) 
              {
                ?>
                <span class="label label-md label-primary">รออนุมัติ</span>
                <?php
              }
              elseif ($row["reservation_status"] == 1) 
              {
                ?>
                <span class="label label-md label-success">จองสำเร็จ</span>
                <?php
              }
              elseif ($row["reservation_status"] == 2) 
              {
                ?>
                <span class="label label-md label-danger">จองไม่สำเร็จ</span>
                <?php
              }
              elseif ($row["reservation_status"] == 3) 
              {
                ?>
                <span class="label label-md label-danger">ยกเลิกการจอง</span>
                <?php
              }
              ?>
              </td>
              <td class="text-center">
              <?php
              if ($row["usage_status"] == 0) 
              {
                ?>
                <span class="label label-md label-primary">รออนุมัติ</span>
                <?php
              }
              elseif ($row["usage_status"] == 1) 
              {
                ?>
               <span class="label label-md label-warning">กำลังดำเนินการ</span>
                <?php
              }
              elseif ($row["usage_status"] == 2) 
              {
                ?>
                <span class="label label-md label-success">ดำเนินการเสร็จสิ้น</span>
                <?php
              }
              elseif ($row["usage_status"] == 3) 
              {
                ?>
                <span class="label label-md label-danger">ยกเลิก</span>
                <?php
              }
              ?>
              </td>
              <td class="text-center">
              <button class="btn btn-sm btn-primary handleApproveDetail" role="button"
              data-toggle="modal" data-target="#reserv_approve_modal" data-id="<?php echo $row["reservation_id"];?>">
                <span class="fa fa-flag "></span> ทำรายการอนุมัติ
            </button>
              </td>
            </tr>
              <?php
          }
          ?>
          </tbody>
            </table>
            </div>
          <?php
        }
        else 
        {
          ?>
            <tr>
            <td class="text-center" colspan="7">ไม่มีรายการรออนุมัติ</td>
            </tr>
            </tbody>
            </table>
            </div>
          <?php
        }
    }
}
else
{
    ?>
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
          <thead>
              <tr>
                  <th id="tb_detail_main" class="text-center" style="width: 15%;">วันที่จองใช้รถยนต์</th>
                  <th id="tb_detail_sub-th">ช่วงเวลา</th>
                  <th id="tb_detail_main">จองใช้เพื่อ</th>
                  <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
                  <th id="tb_detail_sub-sv">สถานะการจอง</th>
                  <th id="tb_detail_sub-sv">สถานะการใช้</th>
                  <th id="tb_tools">เครื่องมือ</th>
              </tr>
          </thead>
          <tbody>
    <?php
    $department ="select * from department order by department_name ASC";
    $result = $conn->query($department);
    while($department = $result->fetch_assoc())
    {
        $sql = "
        SELECT * FROM reservation r
        LEFT JOIN cars c
        ON r.car_id = c.car_id
        LEFT JOIN personnel p
        ON r.personnel_id = p.personnel_id
        LEFT JOIN title_name t
        ON p.title_name_id = t.title_name_id
        LEFT JOIN department d
        ON p.department_id = d.department_id
        WHERE reservation_status = 0
        AND d.department_id = ".$department['department_id']."
        ORDER BY r.date_start ASC ,r.reserv_stime ASC";

       

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
        <tr><td colspan="7"><?php echo $department['department_name'];?></td></tr>
        <?php
          while($row = $result->fetch_assoc())
          {
            $count++;
            ?>
            <tr>
              <td class="text-center">
                <?php 
                if($row["date_start"] === $row["date_end"])
                {
                  echo DateThai($row["date_start"]); 
                }
                else
                {
                  echo DateThai($row["date_start"]); 
                  echo "<br>ถึง ";
                  echo DateThai($row["date_end"]); 
                }
                ?>
              </td>
              <td class="text-center"><?php echo date("H:i",strtotime($row["reserv_stime"]))." - ".date("H:i",strtotime($row["reserv_etime"]))."น.";?></td>
              <td class="detail_colum" ><?php echo $row["requirement_detail"]; ?></td>
              <td class="text-center"><?php echo $row["car_reg"]; ?></td>
              <td class="text-center">
            <?php
              if ($row["reservation_status"] == 0) 
              {
                ?>
                <span class="label label-md label-primary">รออนุมัติ</span>
                <?php
              }
              elseif ($row["reservation_status"] == 1) 
              {
                ?>
                <span class="label label-md label-success">จองสำเร็จ</span>
                <?php
              }
              elseif ($row["reservation_status"] == 2) 
              {
                ?>
                <span class="label label-md label-danger">จองไม่สำเร็จ</span>
                <?php
              }
              elseif ($row["reservation_status"] == 3) 
              {
                ?>
                <span class="label label-md label-danger">ยกเลิกการจอง</span>
                <?php
              }
              ?>
              </td>
              <td class="text-center">
              <?php
              if ($row["usage_status"] == 0) 
              {
                ?>
                <span class="label label-md label-primary">รออนุมัติ</span>
                <?php
              }
              elseif ($row["usage_status"] == 1) 
              {
                ?>
               <span class="label label-md label-warning">กำลังดำเนินการ</span>
                <?php
              }
              elseif ($row["usage_status"] == 2) 
              {
                ?>
                <span class="label label-md label-success">ดำเนินการเสร็จสิ้น</span>
                <?php
              }
              elseif ($row["usage_status"] == 3) 
              {
                ?>
                <span class="label label-md label-danger">ยกเลิก</span>
                <?php
              }
              ?>
              </td>
              <td class="text-center">
              <button class="btn btn-sm btn-primary handleApproveDetail" role="button"
              data-toggle="modal" data-target="#reserv_approve_modal" data-id="<?php echo $row["reservation_id"];?>">
                <span class="fa fa-flag "></span> ทำรายการอนุมัติ
            </button>
              </td>
            </tr>
              <?php
          }
          ?>
          </tbody>
            </table>
            </div>
          <?php
        }
        else 
        {
          ?>
            <tr>
            <td class="text-center" colspan="7">ไม่มีรายการรออนุมัติ</td>
            </tr>
            </tbody>
            </table>
            </div>
          <?php
        }
    }
}
?>