<?php
$sql = "
SELECT * FROM reservation r
LEFT JOIN cars c
ON r.car_id = c.car_id
LEFT JOIN personnel p
ON r.personnel_id = p.personnel_id
LEFT JOIN title_name t
ON p.title_name_id = t.title_name_id
ORDER BY date_start ASC , reserv_stime ASC";
$result = $conn->query($sql);
$result_row = mysqli_num_rows($result);
if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
{
  ?>
  <div class="table-responsive">
  <table id="reservation_tablelist" class="table table-striped table-bordered table-hover">
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
  <?php

  while($row = $result->fetch_assoc())
  {
    ?>
    <tr id="<?php echo $row["reservation_id"];?>">
      <td class="text-center"><?php echo DateThai($row["date_start"]) ?></td>
      <td class="text-center"><?php echo date("H:i",strtotime($row["reserv_stime"]))." - ".date("H:i",strtotime($row["reserv_etime"]))."น."; ?></td>
      <td><?php echo $row["requirement_detail"]; ?></td>
      <td class="text-center"><?php echo $row["car_reg"]; ?></td>
      <td class="text-center">
    <?php
      if ($row['reservation_status'] == 0) {
        ?>
        <span class="label label-md label-primary">รออนุมัติ</span>
        <?php
      }elseif ($row['reservation_status'] == 1) {
        ?>
        <span class="label label-md label-success">จองสำเร็จ</span>
        <?php
      }elseif ($row['reservation_status'] == 2) {
        ?>
        <span class="label label-md label-danger">จองไม่สำเร็จ</span>
        <?php
      }elseif ($row['reservation_status'] == 3) {
        ?>
        <span class="label label-md label-danger">ยกเลิกการจอง</span>
        <?php
      }
echo" </td>
      <td class='text-center'>";
      if ($row['usage_status'] == 0) {
        ?>
        <span class="label label-md label-primary">รออนุมัติ</span>
        <?php
      }elseif ($row['usage_status'] == 1) {
        ?>
        <span class="label label-md label-warning">กำลังดำเนินการ</span>
        <?php
      }elseif ($row['usage_status'] == 2) {
        ?>
        <span class="label label-md label-success">ดำเนินการเสร็จสิ้น</span>
        <?php
      }elseif ($row['usage_status'] == 3) {
        ?>
        <span class="label label-md label-danger">ยกเลิก</span>
        <?php
      }
      ?>
    </td>
    </tr>
      <?php
  }
    ?>
  </tbody>
  </table>
  </div>
    <?php
}else {
  $sql = "ALTER TABLE reservation AUTO_INCREMENT = 1";
  $conn->query($sql);
  $sql = "ALTER TABLE location AUTO_INCREMENT = 1";
  $conn->query($sql);
  $sql = "ALTER TABLE passenger AUTO_INCREMENT = 1";
  $conn->query($sql);
  ?>
  <div class="table-responsive">
  <table id="reservationtablelist" class="table table-striped table-bordered table-hover">
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
    <td class="text-center" colspan="6">ไม่พบข้อมูล</td>
    </tr>
    </tbody>
    </table>
    </div>
  <?php
}
?>
