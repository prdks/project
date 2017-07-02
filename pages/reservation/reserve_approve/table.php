<?php
$sql = "
SELECT * FROM reservation r
LEFT JOIN cars c
ON r.car_id = c.car_id
LEFT JOIN personnel p
ON r.personnel_id = p.personnel_id
LEFT JOIN title_name t
ON p.title_name_id = t.title_name_id
WHERE reservation_status = 0
ORDER BY reservation_id ASC ,date_start ASC , reserv_stime ASC";
$result = $conn->query($sql);
$result_row = mysqli_num_rows($result);
if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
{
  echo "
  <div class='table-responsive'>
  <table id='approve_tablelist' class='table table-striped table-bordered table-hover'>
      <thead>
          <tr>
              <th id='tb_detail_sub-th'>วันที่จอง</th>
              <th id='tb_detail_sub-th'>เวลา</th>
              <th id='tb_detail_main'>จองใช้เพื่อ</th>
              <th id='tb_detail_sub-th'>ทะเบียนรถยนต์</th>
              <th id='tb_detail_sub-sv'>สถานะคำร้อง</th>
              <th id='tb_detail_sub-sv'>สถานะการใช้</th>
              <th id='tb_tools'>เครื่องมือ</th>
          </tr>
      </thead>
      <tbody>
  ";

  while($row = $result->fetch_assoc()){

    echo "
    <tr id='".$row['reservation_id']."'>
      <td class='text-center'>".DateThai($row['date_start'])."</td>
      <td class='text-center'>".date("H:i",strtotime($row['reserv_stime']))." - ".date("H:i",strtotime($row['reserv_etime']))."น.</td>
      <td>".$row['requirement_detail']."</td>
      <td class='text-center'>".$row['car_reg']."</td>
      <td class='text-center'>";
      if ($row['reservation_status'] == 0) {
        echo "<span class='label label-md label-primary'>รออนุมัติ</span>";
      }elseif ($row['reservation_status'] == 1) {
        echo "<span class='label label-md label-success'>จองสำเร็จ</span>";
      }elseif ($row['reservation_status'] == 2) {
        echo "<span class='label label-md label-danger'>จองไม่สำเร็จ</span>";
      }elseif ($row['reservation_status'] == 3) {
        echo "<span class='label label-md label-danger'>ยกเลิกการจอง</span>";
      }
echo" </td>
      <td class='text-center'>";
      if ($row['usage_status'] == 0) {
        echo "<span class='label label-md label-primary'>รออนุมัติ</span>";
      }elseif ($row['usage_status'] == 1) {
        echo "<span class='label label-md label-warning'>กำลังดำเนินการ</span>";
      }elseif ($row['usage_status'] == 2) {
        echo "<span class='label label-md label-success'>ดำเนินการเสร็จสิ้น</span>";
      }elseif ($row['usage_status'] == 3) {
        echo "<span class='label label-md label-danger'>ยกเลิก</span>";
      }
echo" </td>
      <td class='text-center'>
      <button class='btn btn-sm btn-primary handleApproveDetail' role='button'
      data-toggle='modal' data-target='#reserv_approve_modal' data-id='".$row['reservation_id']."'>
        <span class='fa fa-flag '></span> ทำรายการอนุมัติ
      </button>
      </td>
    </tr>";
  }
    echo "

    </tbody>
    </table>
    </div>
    ";
}else {
  $sql = "ALTER TABLE reservation AUTO_INCREMENT = 1";
  $conn->query($sql);
  $sql = "ALTER TABLE location AUTO_INCREMENT = 1";
  $conn->query($sql);
  $sql = "ALTER TABLE passenger AUTO_INCREMENT = 1";
  $conn->query($sql);
  echo "
  <div class='table-responsive'>
  <table id='reservationtablelist' class='table table-striped table-bordered table-hover'>
      <thead>
          <tr>
              <th id='tb_detail_sub-th'>วันที่จองใช้</th>
              <th id='tb_detail_sub-th'>เวลา</th>
              <th id='tb_detail_main'>จองใช้เพื่อ</th>
              <th id='tb_detail_sub-th'>ทะเบียนรถยนต์</th>
              <th id='tb_detail_sub-sv'>สถานะคำร้อง</th>
              <th id='tb_detail_sub-sv'>สถานะการใช้</th>
          </tr>
      </thead>
      <tbody>
    <tr>
    <td class='text-center' colspan='6'>ไม่พบข้อมูล</td>
    </tr>
    </tbody>
    </table>
    </div>
    ";
}

function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return " $strDay $strMonthThai $strYear";
	}
?>
