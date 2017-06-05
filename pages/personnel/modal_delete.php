<?php
require '../_connect.php';
if(isset($_POST['checked_id'])){
  echo "
  <script>
  $(function (){
     $('#delete-btn').show();
  });
  </script>";

  $idArr = $_POST['checked_id'];
  echo "<label class='label-control'>คุณต้องการลบข้อมูลนี้ใช่หรือไม่</label> <br />";

    for ($i=0; $i < sizeof($idArr); $i++)
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
      WHERE personnel_id = '".$idArr[$i]."'";
      $result = $conn->query($sql);
      while($row = $result->fetch_assoc())
      {
        echo ($i+1).". ".$row['title_name']." ".$row['personnel_name']."<br />";
      }
    }

}else{
  echo "
  <center>
  <br /><br />
  <label class='label-control'>กรุณาเลือกข้อมูลที่ต้องการลบ</label>
  <br /><br />
  </center>

  <script>
  $(function (){
     $('#delete-btn').hide();
  });
  </script>";
}

?>
