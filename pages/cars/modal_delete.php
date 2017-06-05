<?php
session_start();
require_once '../_connect.php';

$id = $_POST['car_id'];

$sql = "SELECT c.* , p.*, d.* , t.* from cars c
LEFT JOIN personnel p
ON c.personnel_id = p.personnel_id
LEFT JOIN title_name t
ON p.title_name_id = t.title_name_id
LEFT JOIN department d
ON p.department_id = d.department_id
WHERE car_id = '".$id."'";

$result = $conn->query($sql);

while($row = $result->fetch_assoc())
{
  echo "
  <div class='form-group'>
    <center>
      <label class='control-label'>ข้อมูลที่ต้องการลบคือ \" รถยนต์ทะเบียน ".$row['car_reg']." \"</label>
    </center>
    <input type='hidden' name='car_id' value='".$id."'/>
  </div>
  ";
}
?>
