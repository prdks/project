<ul class="breadcrumb">
  <li><a href="report_booking.php">เมนูหลักออกรายการงานการจองรถยนต์</a></li>
  <li class="active">รายงานจองใช้รถยนต์-ตามหน่วยงาน</li>
</ul>
<!-- searchbox -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
                เรียกดูรายงานการจองรถยนต์ <i class="fa fa-search fa-fw"></i>
          </div>

          <form action="<?=$_SERVER['PHP_SELF'];?>" class="form-horizontal" method="get">
            <div class="panel-body">
              <!-- วันแรกที่จองใช้ -->
              <input type="hidden" name="menu" value="department">
              <div class="form-group">
                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                  <span class="requestfield">*</span> จากวันที่จอง :
                </label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <div class="input-group">
                    <!-- วันที่เริ่ม  -->
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    <input class="form-control" name="date_start" id="report_date_start" type="date">
                  </div>
                </div>
              </div>
              <!-- วันสุดท้ายที่จองใช้ -->
              <div class="form-group">
                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                  <span class="requestfield">*</span> ถึงวันที่ :
                </label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <div class="input-group">
                    <!-- วันที่สิ้นสุด  -->
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                    <input class="form-control" name="date_end" id="report_date_end" type="date">
                  </div>
                </div>
              </div>
              <!-- หน่วยงาน -->
              <div class="form-group">
                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                  <span class="requestfield">*</span> หน่วยงาน :
                </label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <select class="form-control" name="department">
                    <?php
                    $sql = "SELECT * FROM department ORDER By department_name ASC";
                    $result = $conn->query($sql);
                    $result_row = mysqli_num_rows($result);
                    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
              	    {
                      while ($row = $result->fetch_assoc())
                      {
                      ?>
                      <option value="<?php echo $row['department_id'];?>"><?php echo $row['department_name'];?></option>
                      <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div class="text-right" style="margin-top:10px;">
                  <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> แสดงผลลัพธ์</button>
              </div>
            </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_GET['date_start'])  && isset($_GET['date_end']))
{
  if ($_GET['date_start'] != '' && $_GET['date_end'] != '' )
  {
    $date_start = $_GET['date_start'];
    $date_end = $_GET['date_end'];
    $department = $_GET['department'];

    $sql = "
    SELECT * FROM reservation r
    LEFT JOIN cars c
    ON r.car_id = c.car_id
    LEFT JOIN car_brand b
    ON c.car_brand_id = b.car_brand_id
    LEFT JOIN personnel p
    ON r.personnel_id = p.personnel_id
    LEFT JOIN department d
    ON p.department_id = d.department_id
    LEFT JOIN title_name t
    ON p.title_name_id = t.title_name_id
    WHERE date_start >= '".$date_start."'
    AND date_end <= '".$date_end."'
    AND d.department_id = '".$department."'
    AND reservation_status = 1
    ORDER BY date_start ASC";
    $result = $conn->query($sql);
    $result_row = mysqli_num_rows($result);
    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
    {
      ?>
      <div class='row' >
      <div class='col-lg-12'>
      <div class='panel panel-default'>
      <div class='panel-heading'>
        <?php
        if ($date_start !== $date_end)
        {
        ?>
        รายการจองรถยนต์ (<?php echo FullDateThai($date_start).' ถึง '.FullDateThai($date_end); ?>)
        <?php
        }
        else
        {
        ?>
        รายการจองรถยนต์ (<?php echo FullDateThai($date_start); ?>)
        <?php
        }
        ?>
        <div class="hidden-xs hidden-sm pull-right">
          <a href="report_booking_department_pdf.php?<?php echo 'start='.$date_start.'&end='.$date_end.'&department='.$department;?>" class="btn btn-xs btn-primary" target="_blank">พิมพ์รายงานการจองรถยนต์</a>
        </div>
      </div>

      <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
          <thead>
            <?php $row = $result->fetch_assoc(); ?>
              <tr>
                <th colspan="4"><?php echo $row['department_name']; ?></th>
              </tr>
              <tr>
                <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
                  <th id="tb_tools_ismore">วันที่ใช้รถยนต์</th>
                  <th id="tb_detail_main">จองใช้เพื่อ</th>
                  <th id="tb_detail_main">สถานที่ไป</th>
              </tr>
          </thead>
          <tbody>
          <?php
          while ($row = $result->fetch_assoc())
          {
          ?>
          <tr>
            <td class="text-center"><?php echo $row["car_reg"]; ?></td>
              <td style="padding-left:25px;">
                <?php echo ShortDateThai($row["date_start"]).' '.date("H:i",strtotime($row["reserv_stime"])).'น.'; ?><br />
                <?php echo ShortDateThai($row["date_end"]).' '.date("H:i",strtotime($row["reserv_etime"])).'น.'; ?>
              </td>
              <td><?php echo $row["requirement_detail"]; ?></td>
              <td><?php echo $row["location"]; ?></td>
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
    <div class="row">
      <div class="col-lg-12 text-danger">
        * หมายเหตุ : แสดงเฉพาะรายการที่อนุมัติแล้วเท่านั้น
      </div>
    </div>
      <?php
    }
    else
    {
    ?>
    <div class='row' >
    <div class='col-lg-12'>
    <div class='panel panel-default'>
    <div class='panel-heading'>
      รายการจองรถยนต์
    </div>
    <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th id="tb_detail_sub-th">วันที่ใช้รถยนต์</th>
                <th id="tb_detail_sub-th">เวลา</th>
                <th id="tb_detail_main">จองใช้เพื่อ</th>
                <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
                <th id="tb_detail_sub-sv">สถานะการจอง</th>
                <th id="tb_detail_sub-sv">สถานะการใช้</th>
            </tr>
        </thead>
        <tbody>
            <tr><td class='text-center' colspan='6'>ไม่พบรายการจองรถยนต์</td></tr>
        </tbody>
  </table>

  </div>

  </div>
  </div>
  </div>
    <?php
    }
  }
}


?>
