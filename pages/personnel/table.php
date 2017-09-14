<?php
switch ($_SESSION['user_type']) {
  case 0:
   if(isset($_POST['search_box']))
  {
    $word = $_POST['search_box'];
    $sql = "
      SELECT
      psn.* , t.* , p.* , d.* , type.*
      FROM personnel psn
      LEFT OUTER JOIN title_name t
        ON psn.title_name_id = t.title_name_id
      LEFT OUTER JOIN  position p
        ON psn.position_id = p.position_id
      LEFT OUTER JOIN  department  d
        ON psn.department_id = d.department_id
      LEFT OUTER JOIN  user_type type
        ON psn.user_type_id = type.user_type_id
      WHERE
          psn.personnel_name LIKE '%".$word."%'
        OR
          psn.email LIKE '%".$word."%'
        OR
          psn.phone_number LIKE '%".$word."%'
        OR
          title_name LIKE '%".$word."%'
        OR
          position_name LIKE '%".$word."%'
        OR
          department_name LIKE '%".$word."%'
        OR
          user_type_name LIKE '%".$word."%'
      ORDER BY department_name ASC , personnel_name ASC
      , position_name ASC , user_type_name ASC";
    $result = $conn->query($sql);
    $result_row = mysqli_num_rows($result);
    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
    {

    $count = 0;

      echo "
      <table id='myTable' class='table table-striped table-bordered table-hover'>
          <thead id='Table_Default'>
              <tr>
                  <th id='tb_checkbox'>
                  เลือก<br>
                  <center>
                  <input type='checkbox' id='select_all' name='select_all' class='checkbox'/>
                  </center>
                  </th>
                  <th id='tb_sharp'>ลำดับ</th>
                  <th id='tb_detail_sub-nd'>ชื่อบุคลากร</th>
                  <th id='tb_detail_sub-th'>ตำแหน่ง</th>
                  <th id='tb_detail_main'>หน่วยงาน</th>
                  <th id='tb_tools'>เครื่องมือ</th>
              </tr>
          </thead>
          <tbody>
      ";

      while($row = $result->fetch_assoc()){
        $count += 1;
        if($_SESSION['user_name'] == $row['personnel_name'])
        {
          echo "
          <tr>
          <td>
          <center>
          <input type='checkbox' disabled/>
          </center>
          </td>
  
          <td class='text-center'>".$count."</td>
          <td>".$row['title_name'].$row['personnel_name']." <b><h7 class='text-info'>(ผู้ใช้งาน)</h7></b></td>
          <td class='text-center'>".$row['position_name']."</td>
          <td>".$row['department_name']."</td>
          <td class='text-center'>
  
          <button type='submit' class='btn btn-primary handlePersonDetail' role='button'
          data-toggle='modal' data-target='#Detail_modal' data-id='".$row['personnel_id']."'>
            <span class='fa fa-user' data-toggle='tooltip' data-placement='top' title='ดูข้อมูล' ></span>
          </button>
  
          <button type='submit' class='btn btn-warning handlePersonEdit' role='button'
          data-toggle='modal' data-target='#Edit_modal' data-id='".$row['personnel_id']."' disabled>
              <span class='fa fa-edit' data-toggle='tooltip' data-placement='top' title='กรุณาแก้ไขที่หน้าข้อมูลส่วนตัว' ></span>
          </button>
  
          </td>
          </tr>";
        }
        else
        {
          echo "
          <tr>
          <td>
          <center>
          <input type='checkbox' id='checked_id[]' name='checked_id[]'
          class='checkbox'value='".$row['personnel_id']."'/>
          </center>
          </td>
  
          <td class='text-center'>".$count."</td>
          <td>".$row['title_name'].$row['personnel_name']."</td>
          <td class='text-center'>".$row['position_name']."</td>
          <td>".$row['department_name']."</td>
          <td class='text-center'>
  
          <button type='submit' class='btn btn-primary handlePersonDetail' role='button'
          data-toggle='modal' data-target='#Detail_modal' data-id='".$row['personnel_id']."'>
            <span class='fa fa-user' data-toggle='tooltip' data-placement='top' title='ดูข้อมูล' ></span>
          </button>
  
          <button type='submit' class='btn btn-warning handlePersonEdit' role='button'
          data-toggle='modal' data-target='#Edit_modal' data-id='".$row['personnel_id']."'>
              <span class='fa fa-edit' data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล' ></span>
          </button>
  
          </td>
          </tr>";
        }

      }
        echo "
        </tbody>
        </table>
        ";
      }else {
        echo "
        <table class='table table-striped table-bordered table-hover'>
            <thead id='Table_Default'>
                <tr>
                <th id='tb_checkbox'>เลือก</th>
                <th id='tb_sharp'>ลำดับ</th>
                <th id='tb_detail_sub-nd'>ชื่อบุคลากร</th>
                <th id='tb_detail_sub-th'>ตำแหน่ง</th>
                <th id='tb_detail_main'>หน่วยงาน</th>
                <th id='tb_tools'>เครื่องมือ</th>
                </tr>
            </thead>
            <tbody>
          <tr>
          <td class='text-center' colspan='6'>ไม่พบข้อมูล</td>
          </tr>
          </tbody>
          </table>
          ";
      }
  }
  else //ถ้าไม่ได้กด search
  {
    $sql = "
    SELECT
       psn.* , t.* , p.* , d.* , type.*
      FROM personnel psn
      LEFT OUTER JOIN title_name t
        ON psn.title_name_id = t.title_name_id
      LEFT OUTER JOIN  position p
        ON psn.position_id = p.position_id
      LEFT OUTER JOIN  department  d
        ON psn.department_id = d.department_id
      LEFT OUTER JOIN  user_type type
        ON psn.user_type_id = type.user_type_id
        ORDER BY department_name ASC , personnel_name ASC
        , position_name ASC , user_type_name ASC";
    $result = $conn->query($sql);
    $result_row = mysqli_num_rows($result);
    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
    {
      $count = 0;
      echo "
      <table id='myTable' class='table table-striped table-bordered table-hover'>
          <thead id='Table_Default'>
              <tr>
                  <th id='tb_checkbox'>
                  เลือก<br>
                  <center>
                  <input type='checkbox' id='select_all' name='select_all' class='checkbox'/>
                  </center>
                  </th>
                  <th id='tb_sharp'>ลำดับ</th>
                  <th id='tb_detail_sub-nd'>ชื่อบุคลากร</th>
                  <th id='tb_detail_sub-th'>ตำแหน่ง</th>
                  <th id='tb_detail_main'>หน่วยงาน</th>
                  <th id='tb_tools'>เครื่องมือ</th>
              </tr>
          </thead>
          <tbody>
      ";

      while($row = $result->fetch_assoc()){
        $count += 1;
        if($_SESSION['user_name'] == $row['personnel_name'])
        {
          echo "
          <tr>
          <td>
          <center>
          <input type='checkbox' disabled/>
          </center>
          </td>
  
          <td class='text-center'>".$count."</td>
          <td>".$row['title_name'].$row['personnel_name']." <b><h7 class='text-info'>(ผู้ใช้งาน)</h7></b></td>
          <td class='text-center'>".$row['position_name']."</td>
          <td>".$row['department_name']."</td>
          <td class='text-center'>
  
          <button type='submit' class='btn btn-primary handlePersonDetail' role='button'
          data-toggle='modal' data-target='#Detail_modal' data-id='".$row['personnel_id']."'>
            <span class='fa fa-user' data-toggle='tooltip' data-placement='top' title='ดูข้อมูล' ></span>
          </button>
  
          <button type='submit' class='btn btn-warning handlePersonEdit' role='button'
          data-toggle='modal' data-target='#Edit_modal' data-id='".$row['personnel_id']."' disabled>
              <span class='fa fa-edit' data-toggle='tooltip' data-placement='top' title='กรุณาแก้ไขที่หน้าข้อมูลส่วนตัว' ></span>
          </button>
  
          </td>
          </tr>";
        }
        else
        {
          echo "
          <tr>
          <td>
          <center>
          <input type='checkbox' id='checked_id[]' name='checked_id[]'
          class='checkbox'value='".$row['personnel_id']."'/>
          </center>
          </td>
  
          <td class='text-center'>".$count."</td>
          <td>".$row['title_name'].$row['personnel_name']."</td>
          <td class='text-center'>".$row['position_name']."</td>
          <td>".$row['department_name']."</td>
          <td class='text-center'>
  
          <button type='submit' class='btn btn-primary handlePersonDetail' role='button'
          data-toggle='modal' data-target='#Detail_modal' data-id='".$row['personnel_id']."'>
            <span class='fa fa-user' data-toggle='tooltip' data-placement='top' title='ดูข้อมูล' ></span>
          </button>
  
          <button type='submit' class='btn btn-warning handlePersonEdit' role='button'
          data-toggle='modal' data-target='#Edit_modal' data-id='".$row['personnel_id']."'>
              <span class='fa fa-edit' data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล' ></span>
          </button>
  
          </td>
          </tr>";
        }

      }
        echo "
        </tbody>
        </table>
        ";
    }else {
      $sql = "ALTER TABLE personnel AUTO_INCREMENT = 1";
      $conn->query($sql);
      echo "
      <table class='table table-striped table-bordered table-hover'>
          <thead id='Table_Default'>
              <tr>
              <th id='tb_checkbox'>เลือก</th>
              <th id='tb_sharp'>ลำดับ</th>
              <th id='tb_detail_sub-nd'>ชื่อบุคลากร</th>
              <th id='tb_detail_sub-th'>ตำแหน่ง</th>
              <th id='tb_detail_main'>หน่วยงาน</th>
              <th id='tb_tools'>เครื่องมือ</th>
              </tr>
          </thead>
          <tbody>
        <tr>
        <td class='text-center' colspan='6'>ไม่พบข้อมูล</td>
        </tr>
        </tbody>
        </table>
        ";
    }
  }
    break;
  case 4:
   if(isset($_POST['search_box']))
  {
    $word = $_POST['search_box'];
    $sql = "
    SELECT
    psn.* , t.* , p.* , d.* , type.*
    FROM personnel psn
    LEFT OUTER JOIN title_name t
      ON psn.title_name_id = t.title_name_id
    LEFT OUTER JOIN  position p
      ON psn.position_id = p.position_id
    LEFT OUTER JOIN  user_type type
      ON psn.user_type_id = type.user_type_id
    LEFT OUTER JOIN  department  d
      ON psn.department_id = d.department_id
     WHERE d.department_name = '".$_SESSION['department']."'
     AND
     (
       psn.personnel_name LIKE '%".$word."%'
     OR
       psn.email LIKE '%".$word."%'
     OR
       psn.phone_number LIKE '%".$word."%'
     OR
       title_name LIKE '%".$word."%'
     OR
       position_name LIKE '%".$word."%'
     OR
       department_name LIKE '%".$word."%'
     OR
       user_type_name LIKE '%".$word."%'
      )
      ORDER BY department_name ASC , personnel_name ASC
      , position_name ASC , user_type_name ASC";
    $result = $conn->query($sql);
    $result_row = mysqli_num_rows($result);
    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
    {

    $count = 0;

      echo "
      <table id='myTable' class='table table-striped table-bordered table-hover'>
          <thead id='Table_Default'>
              <tr>
                  <th id='tb_checkbox'>
                  เลือก<br>
                  <center>
                  <input type='checkbox' id='select_all' name='select_all' class='checkbox'/>
                  </center>
                  </th>
                  <th id='tb_sharp'>ลำดับ</th>
                  <th id='tb_detail_sub-nd'>ชื่อบุคลากร</th>
                  <th id='tb_detail_sub-th'>ตำแหน่ง</th>
                  <th id='tb_tools'>เครื่องมือ</th>
              </tr>
          </thead>
          <tbody>
      ";

      while($row = $result->fetch_assoc()){
        $count += 1;
        if($_SESSION['user_name'] == $row['personnel_name'])
        {
          echo "
          <tr>
          <td>
          <center>
          <input type='checkbox' disabled/>
          </center>
          </td>
  
          <td class='text-center'>".$count."</td>
          <td>".$row['title_name'].$row['personnel_name']." <b><h7 class='text-info'>(ผู้ใช้งาน)</h7></b></td>
          <td class='text-center'>".$row['position_name']."</td>
          <td class='text-center'>
  
          <button type='submit' class='btn btn-primary handlePersonDetail' role='button'
          data-toggle='modal' data-target='#Detail_modal' data-id='".$row['personnel_id']."'>
            <span class='fa fa-user' data-toggle='tooltip' data-placement='top' title='ดูข้อมูล' ></span>
          </button>
  
          <button type='submit' class='btn btn-warning handlePersonEdit' role='button'
          data-toggle='modal' data-target='#Edit_modal' data-id='".$row['personnel_id']."' disabled>
              <span class='fa fa-edit' data-toggle='tooltip' data-placement='top' title='กรุณาแก้ไขที่หน้าข้อมูลส่วนตัว' ></span>
          </button>
  
          </td>
          </tr>";
        }
        else
        {
          echo "
          <tr>
          <td>
          <center>
          <input type='checkbox' id='checked_id[]' name='checked_id[]'
          class='checkbox'value='".$row['personnel_id']."'/>
          </center>
          </td>
  
          <td class='text-center'>".$count."</td>
          <td>".$row['title_name'].$row['personnel_name']."</td>
          <td class='text-center'>".$row['position_name']."</td>
          <td class='text-center'>
  
          <button type='submit' class='btn btn-primary handlePersonDetail' role='button'
          data-toggle='modal' data-target='#Detail_modal' data-id='".$row['personnel_id']."'>
            <span class='fa fa-user' data-toggle='tooltip' data-placement='top' title='ดูข้อมูล' ></span>
          </button>
  
          <button type='submit' class='btn btn-warning handlePersonEdit' role='button'
          data-toggle='modal' data-target='#Edit_modal' data-id='".$row['personnel_id']."'>
              <span class='fa fa-edit' data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล' ></span>
          </button>
  
          </td>
          </tr>";
        }

      }
        echo "
        </tbody>
        </table>
        ";
      }else {
        echo "
        <table class='table table-striped table-bordered table-hover'>
            <thead id='Table_Default'>
                <tr>
                <th id='tb_checkbox'>เลือก</th>
                <th id='tb_sharp'>ลำดับ</th>
                <th id='tb_detail_sub-nd'>ชื่อบุคลากร</th>
                <th id='tb_detail_sub-th'>ตำแหน่ง</th>
                <th id='tb_tools'>เครื่องมือ</th>
                </tr>
            </thead>
            <tbody>
          <tr>
          <td class='text-center' colspan='5'>ไม่พบข้อมูล</td>
          </tr>
          </tbody>
          </table>
          ";
      }
  }
  else
  {
    $sql = "
    SELECT
       psn.* , t.* , p.* , d.* , type.*
      FROM personnel psn
      LEFT OUTER JOIN title_name t
        ON psn.title_name_id = t.title_name_id
      LEFT OUTER JOIN  position p
        ON psn.position_id = p.position_id
      LEFT OUTER JOIN  department  d
        ON psn.department_id = d.department_id
      LEFT OUTER JOIN  user_type type
        ON psn.user_type_id = type.user_type_id
      WHERE department_name = '".$_SESSION['department']."'
      ORDER BY department_name ASC , personnel_name ASC
      , position_name ASC , user_type_name ASC";
    $result = $conn->query($sql);
    $result_row = mysqli_num_rows($result);
    if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
    {
      $count = 0;
      echo "
      <table id='myTable' class='table table-striped table-bordered table-hover'>
          <thead id='Table_Default'>
              <tr>
                  <th id='tb_checkbox'>
                  เลือก<br>
                  <center>
                  <input type='checkbox' id='select_all' name='select_all' class='checkbox'/>
                  </center>
                  </th>
                  <th id='tb_sharp'>ลำดับ</th>
                  <th id='tb_detail_sub-nd'>ชื่อบุคลากร</th>
                  <th id='tb_detail_sub-th'>ตำแหน่ง</th>
                  <th id='tb_tools'>เครื่องมือ</th>
              </tr>
          </thead>
          <tbody>
      ";

      while($row = $result->fetch_assoc()){
        $count += 1;
        if($_SESSION['user_name'] == $row['personnel_name'])
        {
          echo "
          <tr>
          <td>
          <center>
          <input type='checkbox' disabled/>
          </center>
          </td>
  
          <td class='text-center'>".$count."</td>
          <td>".$row['title_name'].$row['personnel_name']." <b><h7 class='text-info'>(ผู้ใช้งาน)</h7></b></td>
          <td class='text-center'>".$row['position_name']."</td>
          <td class='text-center'>
  
          <button type='submit' class='btn btn-primary handlePersonDetail' role='button'
          data-toggle='modal' data-target='#Detail_modal' data-id='".$row['personnel_id']."'>
            <span class='fa fa-user' data-toggle='tooltip' data-placement='top' title='ดูข้อมูล' ></span>
          </button>
  
          <button type='submit' class='btn btn-warning handlePersonEdit' role='button'
          data-toggle='modal' data-target='#Edit_modal' data-id='".$row['personnel_id']."' disabled>
              <span class='fa fa-edit' data-toggle='tooltip' data-placement='top' title='กรุณาแก้ไขที่หน้าข้อมูลส่วนตัว' ></span>
          </button>
  
          </td>
          </tr>";
        }
        else
        {
          echo "
          <tr>
          <td>
          <center>
          <input type='checkbox' id='checked_id[]' name='checked_id[]'
          class='checkbox'value='".$row['personnel_id']."'/>
          </center>
          </td>
  
          <td class='text-center'>".$count."</td>
          <td>".$row['title_name'].$row['personnel_name']."</td>
          <td class='text-center'>".$row['position_name']."</td>
          <td class='text-center'>
  
          <button type='submit' class='btn btn-primary handlePersonDetail' role='button'
          data-toggle='modal' data-target='#Detail_modal' data-id='".$row['personnel_id']."'>
            <span class='fa fa-user' data-toggle='tooltip' data-placement='top' title='ดูข้อมูล' ></span>
          </button>
  
          <button type='submit' class='btn btn-warning handlePersonEdit' role='button'
          data-toggle='modal' data-target='#Edit_modal' data-id='".$row['personnel_id']."'>
              <span class='fa fa-edit' data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล' ></span>
          </button>
  
          </td>
          </tr>";
        }

      }
        echo "
        </tbody>
        </table>
        ";
    }else {
      $sql = "ALTER TABLE personnel AUTO_INCREMENT = 1";
      $conn->query($sql);
      echo "
      <table class='table table-striped table-bordered table-hover'>
          <thead id='Table_Default'>
              <tr>
              <th id='tb_checkbox'>เลือก</th>
              <th id='tb_sharp'>ลำดับ</th>
              <th id='tb_detail_sub-nd'>ชื่อบุคลากร</th>
              <th id='tb_detail_sub-th'>ตำแหน่ง</th>
              <th id='tb_tools'>เครื่องมือ</th>
              </tr>
          </thead>
          <tbody>
        <tr>
        <td class='text-center' colspan='5'>ไม่พบข้อมูล</td>
        </tr>
        </tbody>
        </table>
        ";
    }
  }
    break;

}
?>
