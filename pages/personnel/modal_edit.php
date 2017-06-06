<?php
session_start();
require_once '../_connect.php';
$id = $_POST['personnel_id'];
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
  WHERE personnel_id = '".$id."'";

$res = $conn->query($sql);

while($r = $res->fetch_assoc())
{
  echo "
  <!-- คำนำหน้าชื่อ -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      <span class='requestfield'>*</span> คำนำหน้าชื่อ :
    </label>
    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>";

    $sql = "select * from title_name ORDER BY title_name ASC";
    $result = $conn->query($sql);
    echo "<select name='title_name' class='form-control'>";
    while($row = $result->fetch_array())
    {
      if($row['title_name']=== $r['title_name'])
      {
        echo "<option value='".$row['title_name_id']."' selected>
        ".$row['title_name']."
        </option> ";
      }
      else
      {
        echo "<option value='".$row['title_name_id']."'>
        ".$row['title_name']."
        </option> ";
      }
    }

    echo "</select>
    </div>
  </div>
  <!-- ชื่อนามสกุล -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      <span class='requestfield'>*</span> ชื่อ-นามสกุล :
    </label>
    <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
      <input type='text' class='form-control' name='user_name'
      id='user_name' placeholder='พิมพ์ชื่อ-นามสกุล' value='".$r['personnel_name']."'>
    </div>
  </div>
  <!-- อีเมลล์ -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      <span class='requestfield'>*</span> อีเมลล์ :
    </label>
    <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
      <input type='email' name='email' class='form-control'
      placeholder='พิมพ์อีเมลล์' value='".$r['email']."'>
    </div>
  </div>
  <!-- เบอร์โทรศัพท์ -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      <span class='requestfield'>*</span> เบอร์โทรศัพท์ :
    </label>
    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
      <input type='tel' name='phonenumber' class='form-control'
      value='".$r['phone_number']."' maxlength='15' placeholder='พิมพ์เบอร์โทรศัพท์'>
    </div>
  </div>
  <!-- หน่วยงาน -->";

      switch ($_SESSION['user_type']) {
        case 'เจ้าหน้าที่ดูแลระบบ':
          echo
          "<div class='form-group'>
            <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
              <span class='requestfield'>*</span> หน่วยงาน :
            </label>
            <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>";

            $sql = "select * from department ORDER BY department_name ASC";
            $result = $conn->query($sql);

            echo "<select name='department' class='form-control'>";

            while($row = $result->fetch_array())
            {
              if($row['department_name'] === $r['department_name']) echo "<option value='".$row['department_id']."' selected>".$row['department_name']."</option>";
              else echo "<option value='".$row['department_id']."'>".$row['department_name']."</option>";
            }
            echo "</select>
            </div>
          </div>";
          break;
        case 'ผู้อนุมัติประจำหน่วยงาน ลำดับที่ 1':
          echo "<input type='hidden' name='department' value='".$r['department_id']."' />";
          break;
      }

  echo "
  <!-- ตำแหน่ง -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      <span class='requestfield'>*</span> ตำแหน่ง :
    </label>
    <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>";

    $sql = "select * from position ORDER BY position_name ASC";
    $result = $conn->query($sql);

    echo "<select name='position' class='form-control'>";

    while($row = $result->fetch_array())
    {
      if($row['position_name'] === $r['position_name'])
      {
        echo "<option value='".$row['position_id']."' selected>".$row['position_name']."</option>";
      }
      else
      {
        echo "<option value='".$row['position_id']."'>".$row['position_name']."</option>";
      }
    }

    echo "</select>
    </div>
  </div>
  <input type='hidden' name='id' value='".$id."' />
  ";

}
?>
