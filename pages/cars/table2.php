<?php
switch ($_SESSION['user_type']) {
  case 'เจ้าหน้าที่ดูแลระบบ':
  if(isset($_POST['handleSearch']))
  {
    $word = $_POST['search_box'];
    $sql = "SELECT c.* , b.* , p.* , t.* , d.* from cars c
    LEFT OUTER JOIN car_brand b
    ON c.car_brand_id = b.car_brand_id
    LEFT OUTER JOIN personnel p
    ON c.personnel_id = p.personnel_id
    LEFT OUTER JOIN title_name t
    ON p.title_name_id = t.title_name_id
    LEFT OUTER JOIN department d
    ON p.department_id = d.department_id
    WHERE
       c.car_reg LIKE '%".$word."%'
    OR b.car_brand_name LIKE '%".$word."%'
    OR c.car_kind LIKE '%".$word."%'
    OR p.personnel_name LIKE '%".$word."%'
    OR t.title_name LIKE '%".$word."%'
    OR d.department_name LIKE '%".$word."%'
    ORDER BY department_name ASC
    , car_reg ASC";
    $result = $conn->query($sql);
    $result_row = mysqli_num_rows($result);
    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
    {
      ?>
      <table id="myTable" class="table table-striped table-bordered table-hover">
          <thead id="Table_Default">
              <tr>
              <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
              <th id="tb_detail_sub-six">ยี่ห้อรถยนต์</th>
              <th id="tb_detail_sub-six">รุ่นรถยนต์</th>
              <th id="tb_detail_sub-sv">จำนวนที่นั่ง</th>
              <th id="tb_detail_main">ผู้ดูแล</th>
              <th id="tb_detail_main">สังกัดหน่วยงาน</th>
              <th id="tb_detail_sub-sv">สถานะ</th>
              <th id="tb_tools_ismore">เครื่องมือ</th>
              </tr>
          </thead>
          <tbody>
      <?php

      while($r = $result->fetch_assoc())
      {
        ?>
          <td class="text-center"><?php echo $r["car_reg"]; ?></td>
          <td><?php echo $r["car_brand_name"]; ?></td>
          <td><?php echo $r["car_kind"]; ?></td>
          <td class="text-center"><?php echo $r["seat"]; ?></td>
          <td><?php echo $r["title_name"]." ".$r["personnel_name"]; ?></td>
          <td><?php echo $r["department_name"]; ?></td>
        <?php
            if ($r['status'] === 'จองได้')
            {
              ?>
              <td class='text-center'><span class='label label-md label-success'>จองได้</span></td>
              <?php
            }
            else
            {
              ?>
              <td class='text-center'><span class='label label-md label-danger'>งดจอง</span></td>
              <?php
            }
          ?>
          <td class="text-center">
          <button type="submit" class="btn btn-primary handleCarDetail" role="button"
          data-toggle="modal" data-target="#Detail_modal" data-id="<?php echo $r["car_id"];?>">
            <span class="fa fa-search" data-toggle="tooltip" data-placement="top" title="ดูข้อมูล"></span>
          </button>

          <button type="submit" class="btn btn-warning handleCarEdit" role="button"
          data-toggle="modal" data-target="#Edit_modal" data-id="<?php echo $r["car_id"];?>">
            <span class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูล"></span>
          </button>

          <button class="btn btn-danger handleCarDelete" role="button"
          data-toggle="modal" data-target="#Delete_modal" data-id="<?php echo $r["car_id"];?>">
            <span class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"></span>
          </button>
          </td>
          </tr>
          <?php
      }
      ?>
    </tbody>
    </table>
      <?php
      }else {
        ?>
        <table id="myTable" class="table table-striped table-bordered table-hover">
            <thead id="Table_Default">
                <tr>
                <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
                <th id="tb_detail_sub-six">ยี่ห้อรถยนต์</th>
                <th id="tb_detail_sub-six">รุ่นรถยนต์</th>
                <th id="tb_detail_sub-sv">จำนวนที่นั่ง</th>
                <th id="tb_detail_main">ผู้ดูแล</th>
                <th id="tb_detail_main">สังกัดหน่วยงาน</th>
                <th id="tb_detail_sub-sv">สถานะ</th>
                <th id="tb_tools_ismore">เครื่องมือ</th>
                </tr>
            </thead>
            <tbody>
              <tr class="text-center" colspan="8">ไม่พบข้อมูล</tr>
            </tbody>
          </table>
        <?php
      }
  }
  else //ถ้าไม่ได้กด search
  {
    $sql = "SELECT c.* , b.* , p.* , t.* , d.* from cars c
    LEFT OUTER JOIN car_brand b
    ON c.car_brand_id = b.car_brand_id
    LEFT OUTER JOIN personnel p
    ON c.personnel_id = p.personnel_id
    LEFT OUTER JOIN title_name t
    ON p.title_name_id = t.title_name_id
    LEFT OUTER JOIN department d
    ON p.department_id = d.department_id
    ORDER BY department_name ASC
    , car_reg ASC";
    $result = $conn->query($sql);
    $result_row = mysqli_num_rows($result);
    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
    {
      ?>
      <table id="myTable" class="table table-striped table-bordered table-hover">
          <thead id="Table_Default">
              <tr>
              <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
              <th id="tb_detail_sub-six">ยี่ห้อรถยนต์</th>
              <th id="tb_detail_sub-six">รุ่นรถยนต์</th>
              <th id="tb_detail_sub-sv">จำนวนที่นั่ง</th>
              <th id="tb_detail_main">ผู้ดูแล</th>
              <th id="tb_detail_main">สังกัดหน่วยงาน</th>
              <th id="tb_detail_sub-sv">สถานะ</th>
              <th id="tb_tools_ismore">เครื่องมือ</th>
              </tr>
          </thead>
          <tbody>
      <?php

      while($r = $result->fetch_assoc())
      {
        ?>
          <td class="text-center"><?php echo $r["car_reg"]; ?></td>
          <td><?php echo $r["car_brand_name"]; ?></td>
          <td><?php echo $r["car_kind"]; ?></td>
          <td class="text-center"><?php echo $r["seat"]; ?></td>
          <td><?php echo $r["title_name"]." ".$r["personnel_name"]; ?></td>
          <td><?php echo $r["department_name"]; ?></td>
        <?php
            if ($r['status'] === 'จองได้')
            {
              ?>
              <td class='text-center'><span class='label label-md label-success'>จองได้</span></td>
              <?php
            }
            else
            {
              ?>
              <td class='text-center'><span class='label label-md label-danger'>งดจอง</span></td>
              <?php
            }
          ?>
          <td class="text-center">
          <button type="submit" class="btn btn-primary handleCarDetail" role="button"
          data-toggle="modal" data-target="#Detail_modal" data-id="<?php echo $r["car_id"];?>">
            <span class="fa fa-search" data-toggle="tooltip" data-placement="top" title="ดูข้อมูล"></span>
          </button>

          <button type="submit" class="btn btn-warning handleCarEdit" role="button"
          data-toggle="modal" data-target="#Edit_modal" data-id="<?php echo $r["car_id"];?>">
            <span class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูล"></span>
          </button>

          <button class="btn btn-danger handleCarDelete" role="button"
          data-toggle="modal" data-target="#Delete_modal" data-id="<?php echo $r["car_id"];?>">
            <span class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"></span>
          </button>
          </td>
          </tr>
          <?php
      }
      ?>
    </tbody>
    </table>
      <?php
      }else {
        ?>
        <table id="myTable" class="table table-striped table-bordered table-hover">
            <thead id="Table_Default">
                <tr>
                <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
                <th id="tb_detail_sub-six">ยี่ห้อรถยนต์</th>
                <th id="tb_detail_sub-six">รุ่นรถยนต์</th>
                <th id="tb_detail_sub-sv">จำนวนที่นั่ง</th>
                <th id="tb_detail_main">ผู้ดูแล</th>
                <th id="tb_detail_main">สังกัดหน่วยงาน</th>
                <th id="tb_detail_sub-sv">สถานะ</th>
                <th id="tb_tools_ismore">เครื่องมือ</th>
                </tr>
            </thead>
            <tbody>
              <tr class="text-center" colspan="8">ไม่พบข้อมูล</tr>
            </tbody>
          </table>
        <?php
      }
  }
    break;
  case 'ผู้อนุมัติประจำหน่วยงาน ลำดับที่ 1':
  if(isset($_POST['handleSearch']))
  {
    $word = $_POST['search_box'];
    $sql = "SELECT c.* , b.* , p.* , t.* from cars c
    LEFT OUTER JOIN car_brand b
    ON c.car_brand_id = b.car_brand_id
    LEFT OUTER JOIN personnel p
    ON c.personnel_id = p.personnel_id
    LEFT OUTER JOIN title_name t
    ON p.title_name_id = t.title_name_id
    LEFT OUTER JOIN department d
    ON p.department_id = d.department_id
    WHERE
      ( c.car_reg LIKE '%".$word."%'
    OR b.car_brand_name LIKE '%".$word."%'
    OR c.car_kind LIKE '%".$word."%'
    OR p.personnel_name LIKE '%".$word."%'
    OR t.title_name LIKE '%".$word."%'
    )
    AND d.department_name = '".$_SESSION['department']."'
    ORDER BY car_reg ASC";
    $result = $conn->query($sql);
    $result_row = mysqli_num_rows($result);
    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
    {
      ?>
      <table id="myTable" class="table table-striped table-bordered table-hover">
          <thead id="Table_Default">
              <tr>
              <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
              <th id="tb_detail_sub-six">ยี่ห้อรถยนต์</th>
              <th id="tb_detail_sub-six">รุ่นรถยนต์</th>
              <th id="tb_detail_sub-sv">จำนวนที่นั่ง</th>
              <th id="tb_detail_main">ผู้ดูแล</th>
              <th id="tb_detail_sub-sv">สถานะ</th>
              <th id="tb_tools_ismore">เครื่องมือ</th>
              </tr>
          </thead>
          <tbody>
      <?php

      while($r = $result->fetch_assoc())
      {
        ?>
          <td class="text-center"><?php echo $r["car_reg"]; ?></td>
          <td><?php echo $r["car_brand_name"]; ?></td>
          <td><?php echo $r["car_kind"]; ?></td>
          <td class="text-center"><?php echo $r["seat"]; ?></td>
          <td><?php echo $r["title_name"]." ".$r["personnel_name"]; ?></td>
        <?php
            if ($r['status'] === 'จองได้')
            {
              ?>
              <td class='text-center'><span class='label label-md label-success'>จองได้</span></td>
              <?php
            }
            else
            {
              ?>
              <td class='text-center'><span class='label label-md label-danger'>งดจอง</span></td>
              <?php
            }
          ?>
          <td class="text-center">
          <button type="submit" class="btn btn-primary handleCarDetail" role="button"
          data-toggle="modal" data-target="#Detail_modal" data-id="<?php echo $r["car_id"];?>">
            <span class="fa fa-search" data-toggle="tooltip" data-placement="top" title="ดูข้อมูล"></span>
          </button>

          <button type="submit" class="btn btn-warning handleCarEdit" role="button"
          data-toggle="modal" data-target="#Edit_modal" data-id="<?php echo $r["car_id"];?>">
            <span class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูล"></span>
          </button>

          <button class="btn btn-danger handleCarDelete" role="button"
          data-toggle="modal" data-target="#Delete_modal" data-id="<?php echo $r["car_id"];?>">
            <span class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"></span>
          </button>
          </td>
          </tr>
          <?php
      }
      ?>
    </tbody>
    </table>
      <?php
      }else {
        ?>
        <table id="myTable" class="table table-striped table-bordered table-hover">
            <thead id="Table_Default">
                <tr>
                <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
                <th id="tb_detail_sub-six">ยี่ห้อรถยนต์</th>
                <th id="tb_detail_sub-six">รุ่นรถยนต์</th>
                <th id="tb_detail_sub-sv">จำนวนที่นั่ง</th>
                <th id="tb_detail_main">ผู้ดูแล</th>
                <th id="tb_detail_sub-sv">สถานะ</th>
                <th id="tb_tools_ismore">เครื่องมือ</th>
                </tr>
            </thead>
            <tbody>
              <tr class="text-center" colspan="7">ไม่พบข้อมูล</tr>
            </tbody>
          </table>
        <?php
      }
  }
  else //ถ้าไม่ได้กด search
  {
    $sql = "SELECT c.* , b.* , p.* , t.* from cars c
    LEFT OUTER JOIN car_brand b
    ON c.car_brand_id = b.car_brand_id
    LEFT OUTER JOIN personnel p
    ON c.personnel_id = p.personnel_id
    LEFT OUTER JOIN title_name t
    ON p.title_name_id = t.title_name_id
    LEFT OUTER JOIN department d
    ON p.department_id = d.department_id
    WHERE d.department_name = '".$_SESSION['department']."'
    ORDER by car_reg ASC";
    $result = $conn->query($sql);
    $result_row = mysqli_num_rows($result);
    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
    {
      ?>
      <table id="myTable" class="table table-striped table-bordered table-hover">
          <thead id="Table_Default">
              <tr>
              <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
              <th id="tb_detail_sub-six">ยี่ห้อรถยนต์</th>
              <th id="tb_detail_sub-six">รุ่นรถยนต์</th>
              <th id="tb_detail_sub-sv">จำนวนที่นั่ง</th>
              <th id="tb_detail_main">ผู้ดูแล</th>
              <th id="tb_detail_sub-sv">สถานะ</th>
              <th id="tb_tools_ismore">เครื่องมือ</th>
              </tr>
          </thead>
          <tbody>
      <?php

      while($r = $result->fetch_assoc())
      {
        ?>
          <td class="text-center"><?php echo $r["car_reg"]; ?></td>
          <td><?php echo $r["car_brand_name"]; ?></td>
          <td><?php echo $r["car_kind"]; ?></td>
          <td class="text-center"><?php echo $r["seat"]; ?></td>
          <td><?php echo $r["title_name"]." ".$r["personnel_name"]; ?></td>
        <?php
            if ($r['status'] === 'จองได้')
            {
              ?>
              <td class='text-center'><span class='label label-md label-success'>จองได้</span></td>
              <?php
            }
            else
            {
              ?>
              <td class='text-center'><span class='label label-md label-danger'>งดจอง</span></td>
              <?php
            }
          ?>
          <td class="text-center">
          <button type="submit" class="btn btn-primary handleCarDetail" role="button"
          data-toggle="modal" data-target="#Detail_modal" data-id="<?php echo $r["car_id"];?>">
            <span class="fa fa-search" data-toggle="tooltip" data-placement="top" title="ดูข้อมูล"></span>
          </button>

          <button type="submit" class="btn btn-warning handleCarEdit" role="button"
          data-toggle="modal" data-target="#Edit_modal" data-id="<?php echo $r["car_id"];?>">
            <span class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="แก้ไขข้อมูล"></span>
          </button>

          <button class="btn btn-danger handleCarDelete" role="button"
          data-toggle="modal" data-target="#Delete_modal" data-id="<?php echo $r["car_id"];?>">
            <span class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="ลบข้อมูล"></span>
          </button>
          </td>
          </tr>
          <?php
      }
      ?>
    </tbody>
    </table>
      <?php
      }else {
        ?>
        <table id="myTable" class="table table-striped table-bordered table-hover">
            <thead id="Table_Default">
                <tr>
                <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
                <th id="tb_detail_sub-six">ยี่ห้อรถยนต์</th>
                <th id="tb_detail_sub-six">รุ่นรถยนต์</th>
                <th id="tb_detail_sub-sv">จำนวนที่นั่ง</th>
                <th id="tb_detail_main">ผู้ดูแล</th>
                <th id="tb_detail_sub-sv">สถานะ</th>
                <th id="tb_tools_ismore">เครื่องมือ</th>
                </tr>
            </thead>
            <tbody>
              <tr class="text-center" colspan="7">ไม่พบข้อมูล</tr>
            </tbody>
          </table>
        <?php
      }
  }
    break;

}
?>
