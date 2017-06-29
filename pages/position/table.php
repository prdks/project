<?php
if(isset($_POST['handleSearch']))
{
  $word = $_POST['search_box'];
  $sql = "select * from position where position_name LIKE '%".$word."%' ORDER BY position_name ASC";
  $result = $conn->query($sql);
  $result_row = mysqli_num_rows($result);
  if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
  {
    $count = 0;
    echo "
    <table id='myTable' class='table table-striped table-bordered table-hover'>
        <thead id='Table_Default'>
            <tr>
                <th id='tb_sharp'>#</th>
                <th id='tb_detail_main'>ชื่อตำแหน่ง</th>
                <th id='tb_tools'>เครื่องมือ</th>
            </tr>
        </thead>
        <tbody>
    ";

    while($row = $result->fetch_assoc()){
      $count += 1;
      echo "
      <tr>

      <td class='text-center'>".$count."</td>

      <td>".$row['position_name']."</td>

      <td class='text-center'>
      <button type='submit' class='btn btn-warning handleEdit' role='button'
      data-toggle='modal' data-target='#Edit_modal' data-id='".$row['position_id']."' data-npage='position'>
        <span class='fa fa-edit' data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล'></span>
      </button>

      <button class='btn btn-danger handleDelete' role='button'
      data-toggle='modal' data-target='#Delete_modal' data-id='".$row['position_id']."' data-npage='position'>
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
    $sql = "ALTER TABLE position AUTO_INCREMENT = 1";
    $conn->query($sql);
    echo "
    <table class='table table-striped table-bordered table-hover'>
        <thead id='Table_Default'>
            <tr>
                <th id='tb_sharp'>#</th>
                <th id='tb_detail_main'>ชื่อตำแหน่ง</th>
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
  $sql = "select * from position ORDER BY position_name ASC";
  $result = $conn->query($sql);
  $result_row = mysqli_num_rows($result);
  if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
  {
    $count = 0;
    echo "
    <table id='myTable' class='table table-striped table-bordered table-hover'>
        <thead id='Table_Default'>
            <tr>
                <th id='tb_sharp'>#</th>
                <th id='tb_detail_main'>ชื่อตำแหน่ง</th>
                <th id='tb_tools'>เครื่องมือ</th>
            </tr>
        </thead>
        <tbody>
    ";

    while($row = $result->fetch_assoc()){
      $count += 1;
      echo "
      <tr>

      <td class='text-center'>".$count."</td>

      <td>".$row['position_name']."</td>

      <td class='text-center'>
      <button type='submit' class='btn btn-warning handleEdit' role='button'
      data-toggle='modal' data-target='#Edit_modal' data-id='".$row['position_id']."' data-npage='position'>
        <span class='fa fa-edit' data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล'></span>
      </button>

      <button class='btn btn-danger handleDelete' role='button'
      data-toggle='modal' data-target='#Delete_modal' data-id='".$row['position_id']."' data-npage='position'>
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
    $sql = "ALTER TABLE position AUTO_INCREMENT = 1";
    $conn->query($sql);
    echo "
    <table class='table table-striped table-bordered table-hover'>
        <thead id='Table_Default'>
            <tr>
                <th id='tb_sharp'>#</th>
                <th id='tb_detail_main'>ชื่อตำแหน่ง</th>
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