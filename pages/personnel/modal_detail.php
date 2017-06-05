<?php
require_once '../_connect.php';

$id = $_POST['personnel_id'];

$sql = "
  SELECT
    personnel_id,personnel_name, email, phone_number , title_name,
    position_name , department_name,user_type_name
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

$result = $conn->query($sql);

while($row = $result->fetch_assoc())
{
  echo "
  <!-- ชื่อนามสกุล -->
  <div class='row' style='margin-left:5px;margin-right:5px;'>
    <div class='form-group'>
    <label class='control-label col-md-3 col-sm-3 col-xs-12'>ชื่อ-นามสกุล :</label>
    <div class='col-md-7 col-sm-7 col-xs-12'>
    <p>".$row['title_name']." ".$row['personnel_name']."</p>
    </div>
    </div>
  </div>
  <!-- อีเมลล์ -->
  <div class='row' style='margin-left:5px;margin-right:5px;'>
    <div class='form-group'>
    <label class='control-label col-md-3 col-sm-3 col-xs-12'>อีเมลล์ :</label>
    <div class='col-md-7 col-sm-7 col-xs-12'>
    <p>".$row['email']."</p>
    </div>
    </div>
  </div>
  <!-- เบอร์โทรศัพท์ -->
  <div class='row' style='margin-left:5px;margin-right:5px;'>
    <div class='form-group'>
    <label class='control-label col-md-3 col-sm-3 col-xs-12'>เบอร์โทรศัพท์ :</label>
    <div class='col-md-7 col-sm-7 col-xs-12'>
    <p>".$row['phone_number']."</p>
    </div>
    </div>
  </div>
  <!-- หน่วยงาน -->
  <div class='row' style='margin-left:5px;margin-right:5px;'>
    <div class='form-group'>
      <label class='control-label col-md-3 col-sm-3 col-xs-12'>หน่วยงาน :</label>
      <div class='col-md-7 col-sm-7 col-xs-12'>
      <p>".$row['department_name']."</p>
      </div>
    </div>
  </div>
  <!-- ตำแหน่ง -->
  <div class='row' style='margin-left:5px;margin-right:5px;'>
    <div class='form-group'>
      <label class='control-label col-md-3 col-sm-3 col-xs-12'>ตำแหน่ง :</label>
      <div class='col-md-5 col-sm-5 col-xs-12'>
      <p>".$row['position_name']."</p>
      </div>
    </div>
  </div>
  <!-- ประเภท -->
  <div class='row' style='margin-left:5px;margin-right:5px;'>
    <div class='form-group'>
      <label class='control-label col-md-3 col-sm-3 col-xs-12'>ระดับผู้ใช้งาน :</label>
      <div class='col-md-5 col-sm-5 col-xs-12'>
      <p>".$row['user_type_name']."</p>
      </div>
    </div>
  </div>
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
