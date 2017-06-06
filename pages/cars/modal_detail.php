<?php
session_start();
require_once '../_connect.php';

$id = $_POST['car_id'];

$sql = "SELECT c.* , b.* , p.* , t.* , d.* from cars c
LEFT OUTER JOIN car_brand b
ON c.car_brand_id = b.car_brand_id
LEFT OUTER JOIN personnel p
ON c.personnel_id = p.personnel_id
LEFT OUTER JOIN title_name t
ON p.title_name_id = t.title_name_id
LEFT OUTER JOIN department d
ON p.department_id = d.department_id
WHERE car_id = '".$id."'";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

  echo "
  <div class='row'>
  <!-- ทะเบียน -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      ทะเบียนรถยนต์ :
    </label>
    <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
      <p>".$row['car_reg']."</p>
    </div>
  </div>
  <!-- ยี่ห้อ -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      ยี่ห้อ :
    </label>
    <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
      <p>".$row['car_brand_name']."</p>
    </div>
  </div>
  <!-- รุ่น -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      รุ่น :
    </label>
    <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
      <p>".$row['car_kind']."</p>
    </div>
  </div>
  <!-- รายละเอียด -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      รายละเอียด :
    </label>
    <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>";
    if($row['car_detail'] == '')
    {
      echo "<p>-</p>";
    }
    else
    {
      echo "<p style='word-wrap:break-word;'>".$row['car_detail']."</p>";
    }
echo "</div>
  </div>
  <!-- จำนวนที่นั่ง -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      จำนวนที่นั่ง :
    </label>
    <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
      <p>".$row['seat']." ที่นั่ง</p>
    </div>
  </div>
  <!-- คนขับรถยนต์ -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      คนขับรถยนต์ :
    </label>
    <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
      <p>".$row['title_name']." ".$row['personnel_name']."</p>
    </div>
  </div>
  <!-- สังกัด -->";
      switch ($_SESSION['user_type'])
      {
        case 'เจ้าหน้าที่ดูแลระบบ':
          echo "
          <div class='form-group'>
            <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
              สังกัดหน่วยงาน :
            </label>
            <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12'>
              <p>".$row['department_name']."</p>
            </div>
          </div>";
          break;
      }

  echo "
  <!-- สถานะ -->
    <div class='form-group'>
      <label class='control-label col-md-3 col-sm-3 col-xs-12'>สถานะรถยนต์ :</label>
      <div class='col-lg-9 col-md-9 col-sm-9 col-xs-12'>
      <p>".$row['status']."</p>
      </div>
    </div>
  <!-- ถ้าสถานะเป็นงดจอง -->";
      if ($row['status'] === 'งดจอง')
      {
        echo "
        <div class='form-group'>
          <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label text-danger'>
            หมายเหตุ :
          </label>
          <div class='col-lg-7 col-md-7 col-sm-7 col-xs-12 text-danger'>
            <p style='word-wrap:break-word;'>".$row['note']."</p>
          </div>
        </div>";
      }
  echo "</div>";
?>
<style media="screen">
label{
  text-align: justify;
}
@media screen and (min-width: 48em){
  label{
      text-align: right;
  }
</style>
