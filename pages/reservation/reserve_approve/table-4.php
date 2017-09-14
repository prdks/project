<?php
 if(isset($_POST['search_box']))
{
  $word = $_POST['search_box'];
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
    AND d.department_name = '".$_SESSION['department']."'
    AND (
        r.requirement_detail like '%".$word."%'
        OR
        r.date_start like '%".$word."%'
        OR
        r.date_end like '%".$word."%'
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
    )
    ORDER BY reservation_id ASC 
    ,date_start ASC 
    ,reserv_stime ASC";
    $result = $conn->query($sql);
    $result_row = mysqli_num_rows($result);
    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
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
      while($row = $result->fetch_assoc())
      {
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
          <td><?php echo $row["requirement_detail"]; ?></td>
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
      <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
          <thead>
              <tr>
                  <th id="tb_detail_sub-th">วันที่ใช้รถยนต์ใช้</th>
                  <th id="tb_detail_sub-th">เวลา</th>
                  <th id="tb_detail_main">จองใช้เพื่อ</th>
                  <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
                  <th id="tb_detail_sub-sv">สถานะการจอง</th>
                  <th id="tb_detail_sub-sv">สถานะการใช้</th>
              </tr>
          </thead>
          <tbody>
        <tr>
        <td class="text-center" colspan="6">ไม่มีรายการรออนุมัติ</td>
        </tr>
        </tbody>
        </table>
        </div>
      <?php
    }   
}
else
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
    WHERE r.reservation_status = 0
    AND d.department_name = '".$_SESSION['department']."'
    ORDER BY reservation_id ASC 
    ,date_start ASC 
    ,reserv_stime ASC";
    $result = $conn->query($sql);
    $result_row = mysqli_num_rows($result);
    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
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
      while($row = $result->fetch_assoc())
      {
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
          <td><?php echo $row["requirement_detail"]; ?></td>
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
      <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
          <thead>
              <tr>
                  <th id="tb_detail_sub-th">วันที่ใช้รถยนต์ใช้</th>
                  <th id="tb_detail_sub-th">เวลา</th>
                  <th id="tb_detail_main">จองใช้เพื่อ</th>
                  <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
                  <th id="tb_detail_sub-sv">สถานะการจอง</th>
                  <th id="tb_detail_sub-sv">สถานะการใช้</th>
              </tr>
          </thead>
          <tbody>
        <tr>
        <td class="text-center" colspan="6">ไม่มีรายการรออนุมัติ</td>
        </tr>
        </tbody>
        </table>
        </div>
      <?php
    }
}
?>