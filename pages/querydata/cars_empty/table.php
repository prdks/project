<?php
 $rows = 10;
 if(isset($_GET['btn'])){$_POST['query_cars_empty'] = $_GET['btn'];}
if(isset($_GET['dstart'])){$_POST['date_start'] = $_GET['dstart'];}
if(isset($_GET['dend'])){$_POST['date_end'] = $_GET['dend'];}
if(isset($_GET['tstart'])){$_POST['time_start'] = $_GET['tstart'];}
if(isset($_GET['tend'])){$_POST['time_end'] = $_GET['tend'];}

if (isset($_POST['query_cars_empty'])) {
  $date_start = $_POST['date_start'];
  $date_end = $_POST['date_end'];
  $time_start = $_POST['time_start'];
  $time_end = $_POST['time_end'];

  if (($date_start !== '' && $date_end !== '') || ($time_start !== '' && $time_end !== '')) {
  switch ($_SESSION['user_type']) {
    case 0:
    $sql = "
    SELECT c.* , b.* , p.* , t.* , d.* FROM cars c
    LEFT JOIN reservation r
    ON r.car_id = c.car_id
    LEFT OUTER JOIN car_brand b
    ON c.car_brand_id = b.car_brand_id
    LEFT OUTER JOIN personnel p
    ON c.personnel_id = p.personnel_id
    LEFT OUTER JOIN title_name t
    ON p.title_name_id = t.title_name_id
    LEFT OUTER JOIN department d
    ON p.department_id = d.department_id
    WHERE c.car_id NOT IN (
       SELECT car_id FROM reservation r
      WHERE 
        ((date_start BETWEEN '".$date_start."' AND '".$date_end."')
        OR 
        (date_end BETWEEN '".$date_start."' AND '".$date_end."')
        OR 
         ('".$date_start."' BETWEEN date_start  AND date_end)
        OR 
         ('".$date_end."' BETWEEN  date_start  AND date_end ))
        AND 
        ((reserv_stime BETWEEN '".$time_start."' AND '".$time_end."')
        OR 
        (reserv_etime BETWEEN '".$time_start."' AND '".$time_end."')
        OR 
         ('".$time_start."' BETWEEN reserv_stime  AND reserv_etime)
        OR 
         ('".$time_end."' BETWEEN  reserv_stime  AND reserv_etime ))
      )
    AND c.status <> 'งดจอง'
    Group by car_reg ORDER BY car_reg";

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
      echo "
      <div class='row' >
      <div class='col-lg-12'>
      <div class='panel panel-primary'>
      <div class='panel-heading'>รายการรถยนต์ว่าง</div>

      <div class='table-responsive'>
      <table id='cars_empty_table' class='table table-striped table-bordered table-hover'>
          <thead>
              <tr>
                <th id='tb_detail_sub-th'>ทะเบียนรถยนต์</th>
                <th id='tb_detail_sub-six'>ยี่ห้อรถยนต์</th>
                <th id='tb_detail_sub-six'>รุ่นรถยนต์</th>
                <th id='tb_detail_sub-sv'>จำนวนที่นั่ง</th>
                <th id='tb_detail_main'>ผู้ดูแล</th>
                <th id='tb_detail_main'>หน่วยงาน</th>
                <th id='tb_detail_sub-sv'>สถานะ</th>
                <!-- <th id='tb_tools'>เมนู</th> -->
              </tr>
          </thead>
          <tbody>
      ";
      while($row = $result->fetch_assoc())
      {
        $count++;
        echo "
        <tr>
        <td class='text-center'>".$row['car_reg']."</td>
        <td>".$row['car_brand_name']."</td>
        <td>".$row['car_kind']."</td>
        <td class='text-center'>".$row['seat']."</td>
        <td>".$row['title_name'].$row['personnel_name']."</td>
        <td>".$row['department_name']."</td>";

        if ($row['status'] === 'จองได้')
        {
          echo "<td class='text-center'><span class='label label-md label-success'>จองได้</span></td>";
        }
        else {
          echo "<td class='text-center'><span class='label label-md label-danger'>งดจอง</span></td>";
        }
        // if ($row['status'] !== 'งดจอง')
        // {
        //   echo "<td class='text-center'><button type='button' class='btn btn-primary btn-xs btn-block'>จองรถยนต์</button></td>";
        // }
        // else {
        //   echo "<td class='text-center'><button type='button' class='btn btn-primary btn-xs btn-block' disabled>จองรถยนต์</button></td>";
        // }
        echo "</tr>";
      }
      echo "
      </tbody>
      </table>
      </div>

      </div>
      </div>
      </div>";
      ?>
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
                      if(isset($_POST['query_cars_empty'])){$linkURL = "cars_empty.php?page=".($page-1)."&btn=t&dstart=".$_POST['date_start']."&dend=".$_POST['date_end']."&tstart=".$_POST['time_start']."&tend=".$_POST['time_end'];}
                      else{$linkURL = "cars_empty.php?page=".($page-1);}
                  }
                  ?>
                  <a href="<?php echo $linkURL;?>">&laquo;</a>
              </li>
              <?php
          }
  
          if(isset($_POST['query_cars_empty']))
          {
              for ($i=1; $i <= $total_page ; $i++)
              {
                  ?>
                  <li <?php if($page==$i){echo 'class=active';}?> ><a href="cars_empty.php?page=<?php echo $i."&btn=t&dstart=".$_POST['date_start']."&dend=".$_POST['date_end']."&tstart=".$_POST['time_start']."&tend=".$_POST['time_end']; ?>"><?php echo $i; ?></a></li>
                  <?php
              }
          }
          else 
          {
              for ($i=1; $i <= $total_page ; $i++)
              {
                  ?>
                  <li <?php if($page==$i){echo 'class=active';}?> ><a href="cars_empty.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                  <?php
              }
          }
          
  
          if($total_page > 1)
          {
              ?>
              <li <?php if($page==$total_page){echo 'disabled';}?>>
                  <?php if($page == $total_page){ $linkURL = "";}
                  else{
                      if(isset($_POST['query_cars_empty'])){$linkURL = "cars_empty.php?page=".($page+1)."&btn=t&dstart=".$_POST['date_start']."&dend=".$_POST['date_end']."&tstart=".$_POST['time_start']."&tend=".$_POST['time_end'];}
                      else{$linkURL = "cars_empty.php?page=".($page+1);}
                  } ?>
                  <a href="<?php echo $linkURL;?>">&raquo;</a>
              </li>
              <?php
          }
          ?>
          
      </ul>
      <?php
    }else {
      echo "
      <div class='row' >
      <div class='col-lg-12'>
      <div class='panel panel-primary'>
      <div class='panel-heading'>รายการรถยนต์ว่าง</div>

      <div class='table-responsive'>
      <table id='cars_empty_table' class='table table-striped table-bordered table-hover'>
          <thead>
              <tr>
                <th id='tb_detail_sub-th'>ทะเบียนรถยนต์</th>
                <th id='tb_detail_sub-six'>ยี่ห้อรถยนต์</th>
                <th id='tb_detail_sub-six'>รุ่นรถยนต์</th>
                <th id='tb_detail_sub-sv'>จำนวนที่นั่ง</th>
                <th id='tb_detail_main'>ผู้ดูแล</th>
                <th id='tb_detail_main'>หน่วยงาน</th>
                <th id='tb_detail_sub-sv'>สถานะ</th>
                <!-- <th id='tb_tools'>เมนู</th> -->
              </tr>
          </thead>
          <tbody>
              <tr><td class='text-center' colspan='7'>ไม่มีข้อมูลรถยนต์ว่าง</td></tr>
          </tbody>
    </table>
    </div>

    </div>
    </div>
    </div>";
    }
    
      break;

    case 4:
    $sql = "
    SELECT c.* , b.* , p.* , t.* , d.* FROM cars c
    LEFT JOIN reservation r
    ON r.car_id = c.car_id
    LEFT OUTER JOIN car_brand b
    ON c.car_brand_id = b.car_brand_id
    LEFT OUTER JOIN personnel p
    ON c.personnel_id = p.personnel_id
    LEFT OUTER JOIN title_name t
    ON p.title_name_id = t.title_name_id
    LEFT OUTER JOIN department d
    ON p.department_id = d.department_id
    WHERE c.car_id NOT IN (
       SELECT car_id FROM reservation r
      WHERE 
      ((date_start BETWEEN '".$date_start."' AND '".$date_end."')
      OR 
      (date_end BETWEEN '".$date_start."' AND '".$date_end."')
      OR 
       ('".$date_start."' BETWEEN date_start  AND date_end)
      OR 
       ('".$date_end."' BETWEEN  date_start  AND date_end ))
      AND 
      ((reserv_stime BETWEEN '".$time_start."' AND '".$time_end."')
      OR 
      (reserv_etime BETWEEN '".$time_start."' AND '".$time_end."')
      OR 
       ('".$time_start."' BETWEEN reserv_stime  AND reserv_etime)
      OR 
       ('".$time_end."' BETWEEN  reserv_stime  AND reserv_etime ))
      )
    AND department_name = '".$_SESSION['department']."'
    GROUP BY car_reg
    ORDER BY department_name asc";

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
      echo "
      <div class='row' >
      <div class='col-lg-12'>
      <div class='panel panel-primary'>
      <div class='panel-heading'>รายการรถยนต์ว่าง</div>

      <div class='table-responsive'>
      <table id='cars_empty_table' class='table table-striped table-bordered table-hover'>
          <thead>
              <tr>
                <th id='tb_detail_sub-th'>ทะเบียนรถยนต์</th>
                <th id='tb_detail_sub-six'>ยี่ห้อรถยนต์</th>
                <th id='tb_detail_sub-six'>รุ่นรถยนต์</th>
                <th id='tb_detail_sub-sv'>จำนวนที่นั่ง</th>
                <th id='tb_detail_main'>ผู้ดูแล</th>
                <th id='tb_detail_main'>หน่วยงาน</th>
                <th id='tb_detail_sub-sv'>สถานะ</th>
                <!-- <th id='tb_tools'>เมนู</th> -->
              </tr>
          </thead>
          <tbody>
      ";
      while($row = $result->fetch_assoc())
      {
        $count++;
        echo "
        <tr>
        <td class='text-center'>".$row['car_reg']."</td>
        <td>".$row['car_brand_name']."</td>
        <td>".$row['car_kind']."</td>
        <td class='text-center'>".$row['seat']."</td>
        <td>".$row['title_name'].$row['personnel_name']."</td>
        <td>".$row['department_name']."</td>";

        if ($row['status'] === 'จองได้')
        {
          echo "<td class='text-center'><span class='label label-md label-success'>จองได้</span></td>";
        }
        else {
          echo "<td class='text-center'><span class='label label-md label-danger'>งดจอง</span></td>";
        }
        // if ($row['status'] !== 'งดจอง')
        // {
        //   echo "<td class='text-center'><button type='button' class='btn btn-primary btn-xs btn-block'>จองรถยนต์</button></td>";
        // }
        // else {
        //   echo "<td class='text-center'><button type='button' class='btn btn-primary btn-xs btn-block' disabled>จองรถยนต์</button></td>";
        // }
        echo "</tr>";
      }
      echo "
      </tbody>
      </table>
      </div>

      </div>
      </div>
      </div>";
      ?>
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
                      if(isset($_POST['query_cars_empty'])){$linkURL = "cars_empty.php?page=".($page-1)."&btn=t&dstart=".$_POST['date_start']."&dend=".$_POST['date_end']."&tstart=".$_POST['time_start']."&tend=".$_POST['time_end'];}
                      else{$linkURL = "cars_empty.php?page=".($page-1);}
                  }
                  ?>
                  <a href="<?php echo $linkURL;?>">&laquo;</a>
              </li>
              <?php
          }
  
          if(isset($_POST['query_cars_empty']))
          {
              for ($i=1; $i <= $total_page ; $i++)
              {
                  ?>
                  <li <?php if($page==$i){echo 'class=active';}?> ><a href="cars_empty.php?page=<?php echo $i."&btn=t&dstart=".$_POST['date_start']."&dend=".$_POST['date_end']."&tstart=".$_POST['time_start']."&tend=".$_POST['time_end']; ?>"><?php echo $i; ?></a></li>
                  <?php
              }
          }
          else 
          {
              for ($i=1; $i <= $total_page ; $i++)
              {
                  ?>
                  <li <?php if($page==$i){echo 'class=active';}?> ><a href="cars_empty.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                  <?php
              }
          }
          
  
          if($total_page > 1)
          {
              ?>
              <li <?php if($page==$total_page){echo 'disabled';}?>>
                  <?php if($page == $total_page){ $linkURL = "";}
                  else{
                      if(isset($_POST['query_cars_empty'])){$linkURL = "cars_empty.php?page=".($page+1)."&btn=t&dstart=".$_POST['date_start']."&dend=".$_POST['date_end']."&tstart=".$_POST['time_start']."&tend=".$_POST['time_end'];}
                      else{$linkURL = "cars_empty.php?page=".($page+1);}
                  } ?>
                  <a href="<?php echo $linkURL;?>">&raquo;</a>
              </li>
              <?php
          }
          ?>
          
      </ul>
      <?php
    }else {
      echo "
      <div class='row' >
      <div class='col-lg-12'>
      <div class='panel panel-primary'>
      <div class='panel-heading'>รายการรถยนต์ว่าง</div>

      <div class='table-responsive'>
      <table id='cars_empty_table' class='table table-striped table-bordered table-hover'>
          <thead>
              <tr>
                <th id='tb_detail_sub-th'>ทะเบียนรถยนต์</th>
                <th id='tb_detail_sub-six'>ยี่ห้อรถยนต์</th>
                <th id='tb_detail_sub-six'>รุ่นรถยนต์</th>
                <th id='tb_detail_sub-sv'>จำนวนที่นั่ง</th>
                <th id='tb_detail_main'>ผู้ดูแล</th>
                <th id='tb_detail_main'>หน่วยงาน</th>
                <th id='tb_detail_sub-sv'>สถานะ</th>
                <!-- <th id='tb_tools'>เมนู</th> -->
              </tr>
          </thead>
          <tbody>
              <tr><td class='text-center' colspan='7'>ไม่มีข้อมูลรถยนต์ว่าง</td></tr>
          </tbody>
    </table>
    </div>

    </div>
    </div>
    </div>";
    }
      break;
  }

  }else {
    echo "
    <div class='row' >
    <div class='col-lg-12'>
    <div class='panel panel-primary'>
    <div class='panel-heading'>รายการรถยนต์ว่าง</div>
    <br />
    <p class='text-center'>ไม่มีข้อมูลรถยนต์ว่าง</p>
    <br />
    </div>
    </div>
    </div>";
  }
}else {
  echo "
  <div class='row' >
  <div class='col-lg-12'>
  <div class='panel panel-primary'>
  <div class='panel-heading'>รายการรถยนต์ว่าง</div>
  <br />
  <p class='text-center'>ไม่มีข้อมูลรถยนต์ว่าง</p>
  <br />
  </div>
  </div>
  </div>";
}

?>
