<?php
 $rows = 10;
 
 if(isset($_GET['word'])){$_POST['search_box'] = $_GET['word'];}

if(isset($_POST['search_box']))
{
  $word = $_POST['search_box'];
  $sql = "select * from user_type WHERE user_type_name LIKE '%".$word."%' ORDER BY user_level ASC";
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
    <table id='myTable' class='table table-striped table-bordered table-hover'>
        <thead id='Table_Default'>
            <tr>
                <th id='tb_detail_sub-sv'>ระดับผู้ใช้งาน</th>
                <th id='tb_detail_main'>ชือประเภทผู้ใช้งาน</th>
                <th id='tb_tools'>เครื่องมือ</th>
            </tr>
        </thead>
        <tbody>
    ";

    while($row = $result->fetch_assoc()){
      $count++;
      echo "
      <tr>
      <td class='text-center'>".$row['user_level']."</td>
      <td>".$row['user_type_name']."</td>

      <td class='text-center'>
      <button type='submit' class='btn btn-warning handleEdit' role='button'
      data-toggle='modal' data-target='#Edit_modal' data-id='".$row['user_type_id']."' data-npage='user_type'>
        <span class='fa fa-edit'></span> แก้ไขชื่อประเภท
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
    $sql = "ALTER TABLE user_type AUTO_INCREMENT = 1";
    $conn->query($sql);
    echo "
    <table class='table table-striped table-bordered table-hover'>
        <thead id='Table_Default'>
            <tr>
                <th id='tb_detail_sub-sv'>ระดับผู้ใช้งาน</th>
                <th id='tb_detail_main'>ชือประเภทผู้ใช้งาน</th>

                <th id='tb_tools'>เครื่องมือ</th>
            </tr>
        </thead>
        <tbody>
      <tr>
      <td class='text-center' colspan='3'>ไม่พบข้อมูล</td>
      </tr>
      </tbody>
      </table>
      ";
  }
}
else
{
  $sql = "select * from user_type ORDER BY user_level ASC";
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
    <table id='myTable' class='table table-striped table-bordered table-hover'>
        <thead id='Table_Default'>
            <tr>
                <th id='tb_detail_sub-sv'>ระดับผู้ใช้งาน</th>
                <th id='tb_detail_main'>ชือประเภทผู้ใช้งาน</th>

                <th id='tb_tools'>เครื่องมือ</th>
            </tr>
        </thead>
        <tbody>
    ";

    while($row = $result->fetch_assoc()){
      $count++;
      echo "
      <tr>
      <td class='text-center'>".$row['user_level']."</td>
      <td>".$row['user_type_name']."</td>

      <td class='text-center'>
      <button type='submit' class='btn btn-warning handleEdit' role='button'
      data-toggle='modal' data-target='#Edit_modal' data-id='".$row['user_type_id']."' data-npage='user_type'>
        <span class='fa fa-edit'></span> แก้ไขชื่อประเภท
      </button>
      </td>
      </tr>";

    }
      echo "
      </tbody>
      </table>
      ";
  }else {
    $sql = "ALTER TABLE user_type AUTO_INCREMENT = 1";
    $conn->query($sql);
    echo "
    <table class='table table-striped table-bordered table-hover'>
        <thead id='Table_Default'>
            <tr>
                <th id='tb_detail_sub-sv'>ระดับผู้ใช้งาน</th>
                <th id='tb_detail_main'>ชือประเภทผู้ใช้งาน</th>
                <th id='tb_tools'>เครื่องมือ</th>
            </tr>
        </thead>
        <tbody>
      <tr>
      <td class='text-center' colspan='3'>ไม่พบข้อมูล</td>
      </tr>
      </tbody>
      </table>
      ";
  }
}
?>
