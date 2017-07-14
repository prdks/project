<?php
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
      WHERE (date_start BETWEEN '".$date_start."' AND '".$date_end."')
      OR (date_end BETWEEN '".$date_start."' AND '".$date_end."')
      OR (reserv_stime BETWEEN '".strtotime ($time_start)."' AND '".strtotime ($time_end)."')
      OR (reserv_etime BETWEEN '".strtotime ($time_start)."' AND '".strtotime ($time_end)."')
      )
    GROUP BY car_reg
    ORDER BY department_name asc";

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
        echo "
        <tr>
        <td class='text-center'>".$row['car_reg']."</td>
        <td>".$row['car_brand_name']."</td>
        <td>".$row['car_kind']."</td>
        <td class='text-center'>".$row['seat']."</td>
        <td>".$row['title_name']." ".$row['personnel_name']."</td>
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
      WHERE (date_start BETWEEN '".$date_start."' AND '".$date_end."')
      OR (date_end BETWEEN '".$date_start."' AND '".$date_end."')
      OR (reserv_stime BETWEEN '".strtotime ($time_start)."' AND '".strtotime ($time_end)."')
      OR (reserv_etime BETWEEN '".strtotime ($time_start)."' AND '".strtotime ($time_end)."')
      )
    AND department_name = '".$_SESSION['department']."'
    GROUP BY car_reg
    ORDER BY department_name asc";

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
        echo "
        <tr>
        <td class='text-center'>".$row['car_reg']."</td>
        <td>".$row['car_brand_name']."</td>
        <td>".$row['car_kind']."</td>
        <td class='text-center'>".$row['seat']."</td>
        <td>".$row['title_name']." ".$row['personnel_name']."</td>
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
