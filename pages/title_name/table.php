
<?php
 $rows = 10;
 
if(isset($_GET['word'])){$_POST['search_box'] = $_GET['word'];}

if(isset($_POST['search_box']))
{
  $word = $_POST['search_box'];
  $sql = "select * from title_name WHERE title_name LIKE '%".$word."%' ORDER BY title_name ASC ";
  $total_data = mysqli_num_rows($conn->query($sql));
  $total_page = ceil($total_data/$rows);
  if(isset($_GET['page'])){$page = $_GET['page'];}
  else{$page = '';}
  if($page==""){ $page = 1;}
  $start =  ($page-1) * $rows;
  if($page != 1){$count = ($page*$rows)-$rows; $start_count = $count;}
  else{$count = 0; $start_count = $count;}

  $sql .= "Limit $start,$rows";
  $result = $conn->query($sql);
  $result_row = mysqli_num_rows($result);
  if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
  {
    
    echo "

    <table id='myTable' class='table table-striped table-bordered table-hover'>
        <thead id='Table_Default'>
            <tr>
                <th id='tb_sharp'>ลำดับ</th>
                <th id='tb_detail_main'>คำนำหน้าชื่อ</th>
                <th id='tb_tools'>เครื่องมือ</th>
            </tr>
        </thead>
        <tbody class='page-content'>
    ";

    while($row = $result->fetch_array()){

      $count += 1;
      echo "
      <tr>

      <td class='text-center'>".$count."</td>

      <td>".$row['title_name']."</td>

      <td class='text-center'>
      <button type='submit' class='btn btn-warning handleEdit' role='button'
      data-toggle='modal' data-target='#Edit_modal' data-id='".$row['title_name_id']."' data-npage='title_name'>
        <span class='fa fa-edit' data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล'></span>
      </button>

      <button class='btn btn-danger handleDelete' role='button'
      data-toggle='modal' data-target='#Delete_modal' data-id='".$row['title_name_id']."' data-npage='title_name'>
        <span class='fa fa-trash-o' data-toggle='tooltip' data-placement='top' title='ลบข้อมูล'></span>
      </button>

      </td>
      </tr>";

    }
      echo "
      </tbody>
      </table>

      ";
  }else {
    $sql = "ALTER TABLE title_name AUTO_INCREMENT = 1";
    $conn->query($sql);
    echo "
    <table class='table table-striped table-bordered table-hover'>
        <thead id='Table_Default'>
            <tr>
              <th id='tb_sharp'>ลำดับ</th>
              <th id='tb_detail_main'>คำนำหน้าชื่อ</th>
              <th id='tb_tools'>เครื่องมือ</th>
            </tr>
        </thead>
        <tbody class='page-content'>
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
  $sql = "select * from title_name ORDER BY title_name ASC ";
  $total_data = mysqli_num_rows($conn->query($sql));
  $total_page = ceil($total_data/$rows);
  if(isset($_GET['page'])){$page = $_GET['page'];}
  else{$page = '';}
  if($page==""){ $page = 1;}
  $start =  ($page-1) * $rows;
  if($page != 1){$count = ($page*$rows)-$rows; $start_count = $count;}
  else{$count = 0; $start_count = $count;}

  $sql .= "Limit $start,$rows";
  $result = $conn->query($sql);
  $result_row = mysqli_num_rows($result);
  if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
  {
    echo "

    <table id='myTable' class='table table-striped table-bordered table-hover'>
        <thead id='Table_Default'>
            <tr>
              <th id='tb_sharp'>ลำดับ</th>
              <th id='tb_detail_main'>คำนำหน้าชื่อ</th>
              <th id='tb_tools'>เครื่องมือ</th>
            </tr>
        </thead>
        <tbody class='page-content'>
    ";

    while($row = $result->fetch_array()){
      $count += 1;
      echo "
      <tr>

      <td class='text-center'>".$count."</td>

      <td>".$row['title_name']."</td>

      <td class='text-center'>
      <button type='submit' class='btn btn-warning handleEdit' role='button'
      data-toggle='modal' data-target='#Edit_modal'  data-id='".$row['title_name_id']."' data-npage='title_name'>
        <span class='fa fa-edit' data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล'></span>
      </button>

      <button class='btn btn-danger handleDelete' role='button'
      data-toggle='modal' data-target='#Delete_modal' data-id='".$row['title_name_id']."' data-npage='title_name'>
        <span class='fa fa-trash-o' data-toggle='tooltip' data-placement='top' title='ลบข้อมูล'></span>
      </button>

      </td>
      </tr>";

    }
      echo "
      </tbody>
      </table>

      ";
  }else {
    $sql = "ALTER TABLE title_name AUTO_INCREMENT = 1";
    $conn->query($sql);
    echo "
    <table class='table table-striped table-bordered table-hover'>
        <thead id='Table_Default'>
            <tr>
              <th id='tb_sharp'>ลำดับ</th>
              <th id='tb_detail_main'>คำนำหน้าชื่อ</th>
              <th id='tb_tools'>เครื่องมือ</th>
            </tr>
        </thead>
        <tbody class='page-content'>
      <tr>
      <td class='text-center' colspan='3'>ไม่พบข้อมูล</td>
      </tr>
      </tbody>
      </table>
      ";
  }
}

?>
