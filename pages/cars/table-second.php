<?php
$sql = "SELECT c.* from cars c ORDER BY car_id ASC";
$result = $conn->query($sql);
$result_row = mysqli_num_rows($result);
if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
{
  switch ($_SESSION['user_type']) {
    case 'เจ้าหน้าที่ดูแลระบบ':
    $sql2 = "
    SELECT d.*FROM department d
    LEFT OUTER JOIN personnel p
    ON p.department_id= d.department_id
    LEFT OUTER JOIN cars c
    ON c.personnel_id = p.personnel_id
    GROUP BY department_name
    ORDER BY COUNT(car_reg) DESC
    , department_name ASC";
    $result2 = $conn->query($sql2);
    while ($r = $result2->fetch_assoc())
    {
      echo "
      <div class='panel panel-primary'>
      <div class='panel-heading'>
      ".$r['department_name']."
      </div>
      <div class='table-responsive'>
      <table id='myTable' class='table table-striped table-bordered table-hover'>
          <thead id='Table_Default'>
              <tr>
              <th id='tb_detail_sub-th'>ทะเบียนรถยนต์</th>
              <th id='tb_detail_sub-six'>ยี่ห้อรถยนต์</th>
              <th id='tb_detail_sub-six'>รุ่นรถยนต์</th>
              <th id='tb_detail_sub-sv'>จำนวนที่นั่ง</th>
              <th id='tb_detail_main'>ผู้ดูแล</th>
              <th id='tb_detail_sub-sv'>สถานะ</th>
              <th id='tb_tools_ismore'>เครื่องมือ</th>
              </tr>
          </thead>
          <tbody>
      ";

      $sql3 = "SELECT c.* , b.* , p.* , t.* from cars c
      LEFT OUTER JOIN car_brand b
      ON c.car_brand_id = b.car_brand_id
      LEFT OUTER JOIN personnel p
      ON c.personnel_id = p.personnel_id
      LEFT OUTER JOIN title_name t
      ON p.title_name_id = t.title_name_id
      LEFT OUTER JOIN department d
      ON p.department_id = d.department_id
      WHERE department_name = '".$r['department_name']."'
      ORDER BY car_reg asc";
      $result3 = $conn->query($sql3);
      $result_row3 = mysqli_num_rows($result3);
      if ($result_row3 !== 0) // ถ้าใน คณะนั้นมีข้อมูลรถยนต์
      {
        while($row = $result3->fetch_assoc())
        {
          echo "
          <tr>
          <td class='text-center'>".$row['car_reg']."</td>
          <td>".$row['car_brand_name']."</td>
          <td>".$row['car_kind']."</td>
          <td class='text-center'>".$row['seat']."</td>
          <td>".$row['title_name']." ".$row['personnel_name']."</td>";

          if ($row['status'] === 'จองได้')
          {
            echo "<td class='text-center'><span class='label label-md label-success'>จองได้</span></td>";
          }
          else {
            echo "<td class='text-center'><span class='label label-md label-danger'>งดจอง</span></td>";
          }
          echo "
          <td class='text-center'>
          <button type='submit' class='btn btn-primary handleCarDetail' role='button'
          data-toggle='modal' data-target='#Detail_modal' data-id='".$row['car_id']."'>
            <span class='fa fa-search' data-toggle='tooltip' data-placement='top' title='ดูข้อมูล'></span>
          </button>

          <button type='submit' class='btn btn-warning handleCarEdit' role='button'
          data-toggle='modal' data-target='#Edit_modal' data-id='".$row['car_id']."'>
            <span class='fa fa-edit' data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล'></span>
          </button>

          <button class='btn btn-danger handleCarDelete' role='button'
          data-toggle='modal' data-target='#Delete_modal' data-id='".$row['car_id']."'>
            <span class='fa fa-trash-o' data-toggle='tooltip' data-placement='top' title='ลบข้อมูล'></span>
          </button>
          </td>
          </tr>
          ";
        }
      }
      else //ถ้าไม่มีมข้อมูลรถยนต์
      {
        echo "
        <tr><td class='text-center' colspan='7'>ไม่พบข้อมูลรถยนต์</td></tr>
        ";
      }

      echo "
      </tbody>
      </table>
      </div>
      </div>
      ";
    }
      break;
    case 'ผู้อนุมัติประจำหน่วยงาน ลำดับที่ 1':
    echo "
    <div class='panel panel-primary'>
    <div class='panel-heading'>
    ข้อมูลรถยนต์
    </div>
    <table id='myTable' class='table table-striped table-bordered table-hover'>
        <thead id='Table_Default'>
            <tr>
            <th id='tb_detail_sub-th'>ทะเบียนรถยนต์</th>
            <th id='tb_detail_sub-six'>ยี่ห้อรถยนต์</th>
            <th id='tb_detail_sub-six'>รุ่นรถยนต์</th>
            <th id='tb_detail_sub-sv'>จำนวนที่นั่ง</th>
            <th id='tb_detail_main'>ผู้ดูแล</th>
            <th id='tb_detail_sub-sv'>สถานะ</th>
            <th id='tb_tools_ismore'>เครื่องมือ</th>
            </tr>
        </thead>
        <tbody>
    ";
    $sql2 = "SELECT c.* , b.* , p.* , t.* from cars c
    LEFT OUTER JOIN car_brand b
    ON c.car_brand_id = b.car_brand_id
    LEFT OUTER JOIN personnel p
    ON c.personnel_id = p.personnel_id
    LEFT OUTER JOIN title_name t
    ON p.title_name_id = t.title_name_id
    LEFT OUTER JOIN department d
    ON p.department_id = d.department_id
    WHERE department_name = '".$_SESSION['department']."'
    ORDER BY car_reg ASC";
    $result2 = $conn->query($sql2);
    $result_row2 = mysqli_num_rows($result2);
    if ($result_row2 !== 0) // ถ้าใน คณะนั้นมีข้อมูลรถยนต์
    {
      while($row = $result2->fetch_assoc())
      {
        echo "
        <tr>
        <td class='text-center'>".$row['car_reg']."</td>
        <td>".$row['car_brand_name']."</td>
        <td>".$row['car_kind']."</td>
        <td class='text-center'>".$row['seat']."</td>
        <td>".$row['title_name']." ".$row['personnel_name']."</td>";

        if ($row['status'] === 'จองได้')
        {
          echo "<td class='text-center'><span class='label label-md label-success'>จองได้</span></td>";
        }
        else {
          echo "<td class='text-center'><span class='label label-md label-danger'>งดจอง</span></td>";
        }
        echo "
        <td class='text-center'>
        <button type='submit' class='btn btn-primary handleCarDetail' role='button'
        data-toggle='modal' data-target='#Detail_modal' data-id='".$row['car_id']."'>
          <span class='fa fa-search'
          data-toggle='tooltip' data-placement='top' title='ดูข้อมูล'>
          </span>
        </button>

        <button type='submit' class='btn btn-warning handleCarEdit' role='button'
        data-toggle='modal' data-target='#Edit_modal' data-id='".$row['car_id']."'>
          <span class='fa fa-edit'
          data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล'></span>
        </button>

        <button class='btn btn-danger handleCarDelete' role='button'
        data-toggle='modal' data-target='#Delete_modal' data-id='".$row['car_id']."'>
          <span class='fa fa-trash-o'
          data-toggle='tooltip' data-placement='top' title='ลบข้อมูล'></span>
        </button>
        </td>
        </tr>
        ";
      }

    }else {
      echo "
        <tr>
        <td class='text-center' colspan='7'>ไม่พบข้อมูล</td>
        </tr>";
    }
    echo "
    </tbody>
    </table>
    </div>
    ";
      break;
  }// end switch
}
else
{
  $sql = "ALTER TABLE cars AUTO_INCREMENT = 1";
  $conn->query($sql);
  echo "
  <div class='panel panel-primary'>
  <div class='panel-heading'>
  ".$r['department_name']."
  </div>
  <table class='table table-striped table-bordered table-hover'>
      <thead id='Table_Default'>
          <tr>
          <th id='tb_detail_sub-th'>ทะเบียนรถยนต์</th>
          <th id='tb_detail_sub-six'>ยี่ห้อรถยนต์</th>
          <th id='tb_detail_sub-six'>รุ่นรถยนต์</th>
          <th id='tb_detail_sub-sv'>จำนวนที่นั่ง</th>
          <th id='tb_detail_main'>ผู้ดูแล</th>
          <th id='tb_detail_sub-sv'>สถานะ</th>
          <th id='tb_tools_ismore'>เครื่องมือ</th>
          </tr>
      </thead>
      <tbody>
    <tr>
    <td class='text-center' colspan='7'>ไม่พบข้อมูล</td>
    </tr>
    </tbody>
    </table>
    </div>
    ";
}
?>
