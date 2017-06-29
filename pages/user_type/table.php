<?php
if(isset($_POST['handleSearch']))
{
  $word = $_POST['search_box'];
  $sql = "select * from user_type WHERE user_type_name LIKE '%".$word."%' ORDER BY user_level ASC";
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

      if ($row['user_level'] == -1 || $row['user_level'] == 0) {
        echo "
        <tr>
        <td class='text-center'>".$row['user_level']."</td>
        <td>".$row['user_type_name']."</td>

        <td class='text-center'>
        <button type='submit' class='btn btn-warning handleEdit' role='button'
        data-toggle='modal' data-target='#Edit_modal' data-id='".$row['user_type_id']."' data-npage='user_type' disabled>
          <span class='fa fa-edit'  data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล'></span>
        </button>

        <button class='btn btn-danger handleDelete' role='button'
        data-toggle='modal' data-target='#Delete_modal' data-id='".$row['user_type_id']."' data-npage='user_type' disabled>
          <span class='fa fa-trash-o' data-toggle='tooltip' data-placement='top' title='ลบข้อมูล'></span>
        </button>

        </td>
        </tr>";
      }else {
        echo "
        <tr>
        <td class='text-center'>".$row['user_level']."</td>
        <td>".$row['user_type_name']."</td>

        <td class='text-center'>
        <button type='submit' class='btn btn-warning handleEdit' role='button'
        data-toggle='modal' data-target='#Edit_modal' data-id='".$row['user_type_id']."' data-npage='user_type'>
          <span class='fa fa-edit'  data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล'></span>
        </button>

        <button class='btn btn-danger handleDelete' role='button'
        data-toggle='modal' data-target='#Delete_modal' data-id='".$row['user_type_id']."' data-npage='user_type'>
          <span class='fa fa-trash-o' data-toggle='tooltip' data-placement='top' title='ลบข้อมูล'></span>
        </button>

        </td>
        </tr>";
      }

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
      if ($row['user_level'] == -1 || $row['user_level'] == 0) {
        echo "
        <tr>
        <td class='text-center'>".$row['user_level']."</td>
        <td>".$row['user_type_name']."</td>

        <td class='text-center'>
        <button type='submit' class='btn btn-warning handleEdit' role='button'
        data-toggle='modal' data-target='#Edit_modal' data-id='".$row['user_type_id']."' data-npage='user_type' disabled>
          <span class='fa fa-edit'  data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล'></span>
        </button>

        <button class='btn btn-danger handleDelete' role='button'
        data-toggle='modal' data-target='#Delete_modal' data-id='".$row['user_type_id']."' data-npage='user_type' disabled>
          <span class='fa fa-trash-o' data-toggle='tooltip' data-placement='top' title='ลบข้อมูล'></span>
        </button>

        </td>
        </tr>";
      }else {
        echo "
        <tr>
        <td class='text-center'>".$row['user_level']."</td>
        <td>".$row['user_type_name']."</td>

        <td class='text-center'>
        <button type='submit' class='btn btn-warning handleEdit' role='button'
        data-toggle='modal' data-target='#Edit_modal' data-id='".$row['user_type_id']."' data-npage='user_type'>
          <span class='fa fa-edit'  data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล'></span>
        </button>

        <button class='btn btn-danger handleDelete' role='button'
        data-toggle='modal' data-target='#Delete_modal' data-id='".$row['user_type_id']."' data-npage='user_type'>
          <span class='fa fa-trash-o' data-toggle='tooltip' data-placement='top' title='ลบข้อมูล'></span>
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
