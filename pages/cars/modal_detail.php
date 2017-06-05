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

while($row = $result->fetch_assoc())
{
  echo "
  <!-- ทะเบียน -->
  <div class='row' style='margin-left:10px;margin-right:10px;'>
    <div class='form-group'>
      <label class='control-label col-md-3 col-sm-3 col-xs-12'>ทะเบียนรถยนต์ :</label>
      <div class='col-md-6 col-sm-6 col-xs-10'>
      <p>".$row['car_reg']."</p>
      </div>
    </div>
  </div>
  <!-- ยี่ห้อ -->
  <div class='row' style='margin-left:10px;margin-right:10px;'>
    <div class='form-group'>
      <label class='control-label col-md-3 col-sm-3 col-xs-12'>ยี่ห้อ :</label>
      <div class='col-md-6 col-sm-6 col-xs-10'>
      <p>".$row['car_brand_name']."</p>
      </div>
    </div>
  </div>
  <!-- รุ่น -->
  <div class='row' style='margin-left:10px;margin-right:10px;'>
    <div class='form-group'>
      <label class='control-label col-md-3 col-sm-3 col-xs-12' for='car_kind'>รุ่น :</label>
      <div class='col-md-6 col-sm-6 col-xs-10'>
      <p>".$row['car_kind']."</p>
      </div>
    </div>
  </div>
  <!-- รายละเอียด -->
  <div class='row' style='margin-left:10px;margin-right:10px;'>
    <div class='form-group'>
      <label class='control-label col-md-3 col-sm-3 col-xs-12'>รายละเอียด :</label>
      <div class='col-md-9 col-sm-9 col-xs-12'>";
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
  </div>
  <!-- จำนวนที่นั่ง -->
  <div class='row' style='margin-left:10px;margin-right:10px;'>
    <div class='form-group'>
      <label class='control-label col-md-3 col-sm-3 col-xs-12'>จำนวนที่นั่ง :</label>
      <div class='col-md-2 col-sm-2 col-xs-4'>
      <p>".$row['seat']." ที่นั่ง</p>
      </div>
    </div>
  </div>
  <!-- คนขับรถยนต์ -->";
      switch ($_SESSION['user_type']) {
        case 'เจ้าหน้าที่ดูแลระบบ':
          echo "
          <div class='row' style='margin-left:10px;margin-right:10px;'>
            <div class='form-group'>
              <label class='control-label col-md-3 col-sm-3 col-xs-12'>คนขับรถยนต์ :</label>
              <div class='col-md-6 col-sm-6 col-xs-10'>
              <p>".$row['title_name']." ".$row['personnel_name']."</p>
              </div>
            </div>
          </div>";
          break;
        case 'ผู้อนุมัติประจำหน่วยงาน ลำดับที่ 1':
          echo "
          <div class='row' style='margin-left:10px;margin-right:10px;'>
            <div class='form-group'>
              <label class='control-label col-md-3 col-sm-3 col-xs-12'>คนขับรถยนต์ :</label>
              <div class='col-md-6 col-sm-6 col-xs-10'>
              <p>".$row['title_name']." ".$row['personnel_name']."</p>
              </div>
            </div>
          </div>";
          break;
      }
  echo "
  <!-- สังกัด -->";
      switch ($_SESSION['user_type'])
      {
        case 'เจ้าหน้าที่ดูแลระบบ':
          echo "
          <div class='row' style='margin-left:10px;margin-right:10px;'>
            <div class='form-group'>
              <label class='control-label col-md-3 col-sm-3 col-xs-12'>สังกัดหน่วยงาน :</label>
              <div class='col-md-6 col-sm-6 col-xs-10'>
              <p>".$row['department_name']."</p>
              </div>
            </div>
          </div>";
          break;
      }

  echo "
  <!-- สถานะ -->
  <div class='row' style='margin-left:10px;margin-right:10px;'>
    <div class='form-group'>
      <label class='control-label col-md-3 col-sm-3 col-xs-12'>สถานะรถยนต์ :</label>
      <div class='col-md-3 col-sm-3 col-xs-6'>";
      if ($row['status'] === 'จองได้')
      {
        echo "<td class='text-center'><span class='label label-md label-success'>จองได้</span></td>";
      }
      else {
        echo "<td class='text-center'><span class='label label-md label-danger'>งดจอง</span></td>";
      }
echo "</div>
    </div>
  </div>
  <!-- ถ้าสถานะเป็นงดจอง -->";
      if ($row['status'] === 'งดจอง')
      {
        echo "
        <div class='row' style='margin-left:10px;margin-right:10px;'>
          <div class='form-group'>
            <label class='control-label col-md-3 col-sm-3 col-xs-12 text-danger'>หมายเหตุ :</label>
            <div class='col-md-6 col-sm-6 col-xs-10  text-danger'>
            <p style='word-wrap:break-word;'>".$row['note']."</p>
            </div>
          </div>
        </div>";
      }
echo "
  <input type='hidden' name='car_id' value='".$id."'/>
  ";
}
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
