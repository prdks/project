<?php
if (isset($_POST['query_report_usage']))
{
  $date_start = $_POST['date_start'];
  $date_end = $_POST['date_end'];

  $sql = "
  SELECT * FROM reservation r
  LEFT JOIN cars c
  ON r.car_id = c.car_id
  LEFT JOIN car_brand b
  ON c.car_brand_id = b.car_brand_id
  LEFT JOIN personnel p
  ON r.personnel_id = p.personnel_id
  LEFT JOIN title_name t
  ON p.title_name_id = t.title_name_id
  WHERE date_start >= '".$date_start."'
  AND date_end <= '".$date_end."'
  AND usage_status = 2
  ORDER BY reservation_id";
  $result = $conn->query($sql);
  $result_row = mysqli_num_rows($result);
  if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
  {
    ?>
    <div class='row' >
    <div class='col-lg-12'>
    <div class='panel panel-default'>
    <div class='panel-heading'>
      รายการจองรถยนต์
      <div class="hidden-xs hidden-sm pull-right">
        <a href="#" class="btn btn-xs btn-primary">พิมพ์รายงานการจองรถยนต์</a>
      </div>
    </div>

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
            <tr><td class='text-center' colspan='6'>ไม่พบรายการจองรถยนต์</td></tr>
        </tbody>
  </table>
  </div>

  </div>
  </div>
  </div>
  <div class="row">
    <div class="col-lg-12 text-danger">
      * หมายเหตุ : แสดงเฉพาะรายการที่ดำเนินการเสร็จสิ้นแล้วเท่านั้น
    </div>
  </div>
    <?php
  }
}

?>
