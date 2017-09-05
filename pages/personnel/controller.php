<?php
require_once '../_connect.php';
$mode = $_POST['mode'];

if ($mode == 'getDetail')
{
    $id = $_POST['id'];
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

    $row = $result->fetch_assoc();
    $arr = array(
              'name' => $row['title_name'].$row['personnel_name'],
              'email' => $row['email'],
              'phone' => $row['phone_number'],
              'department' => $row['department_name'],
              'position' => $row['position_name'],
              'type' => $row['user_type_name']
            );
    echo json_encode($arr);
}
elseif ($mode == 'getEdit')
{
    $id = $_POST['id'];
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

    $row = $result->fetch_assoc();
    $arr = array(
              'title' => $row['title_name'],
              'name' => $row['personnel_name'],
              'email' => $row['email'],
              'phone' => $row['phone_number'],
              'department' => $row['department_name'],
              'position' => $row['position_name'],
              'type' => $row['user_type_name'],
              'id' => $row['personnel_id']
            );
    echo json_encode($arr);
}
elseif ($mode == 'getDelete')
{
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
          echo ($i+1).". ".$row['title_name'].$row['personnel_name']."<br />";
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
}
elseif ($mode == 'InsertPersonnel')
{
  $name = $_POST['user_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone_number'];
  
  $title = $_POST['title_name'];
  $department = $_POST['department'];
  $position = $_POST['position'];
  $user_type = $_POST['user_type_basic'];
  
  
  $sql = "select * from personnel where personnel_name ='".$name."'";
  $result = $conn->query($sql);
  if($result->num_rows === 0)
  {
  
    $sql = "insert into personnel
    (personnel_name,email,phone_number,title_name_id,position_id,department_id,user_type_id)
    values
    ('".$name."','".$email."','".$phone."'
    ,(select title_name_id from title_name where title_name = '".$title."')
    ,(select position_id from position where position_name = '".$position."')
    ,(select department_id from department where department_name = '".$department."')
    ,(select user_type_id from user_type where user_level = '".$user_type."'))
    ON DUPLICATE KEY UPDATE personnel_id = personnel_id";
  
    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  else
  {
    echo json_encode(array('result' => 'error'));
  }
}
elseif ($mode == 'editPersonnel')
{
  $id = $_POST['id'];
  $name = $_POST['user_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone_number'];
  
  $title = $_POST['title_name'];
  $department = $_POST['department'];
  $position = $_POST['position'];
  
  $sql = "select * from personnel where personnel_name ='".$name."'";
  $result = $conn->query($sql);
  if($result)
  {
    $sql = "update personnel
    set personnel_name = '".$name."'
    ,email = '".$email."'
    ,phone_number = '".$phone."'
    ,title_name_id = (select title_name_id from title_name where title_name = '".$title."')
    ,department_id = (select department_id from department where department_name = '".$department."')
    ,position_id = (select position_id from position where position_name = '".$position."')
    where personnel_id= '".$id."'";
  
    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  else
  {
    echo json_encode(array('result' => 'error'));
  }
}
elseif ($mode == 'deletePersonnel')
{
  if(isset($_POST['checked_id']))
  {
    $idArr = $_POST['checked_id'];
    foreach($idArr as $id)
    {
      $sql = "delete from personnel where personnel_id = '".$id."'";
      $result =$conn->query($sql);
    }
  }
  echo json_encode(array('result' => '1'));
}
elseif ($mode == 'setPermission')
{
  $id = $_POST['id'];
  $type = $_POST['user_type'];
  
  $sql = "select * from personnel where personnel_id ='".$id."'";
  $result = $conn->query($sql);
  if($result)
  {
    $sql = "update personnel
    set user_type_id = (select user_type_id from user_type where user_type_name = '".$type."')
    where personnel_id= '".$id."'";
  
    if($conn->query($sql)===true){echo json_encode(array('result' => '1'));}
    else {echo json_encode(array('result' => '0'));}
  }
  else
  {
    echo json_encode(array('result' => 'error'));
  }
}
elseif ($mode == 'uploadFilePersonnel') 
{

  $objCSV = fopen($_FILES["fileCSV"]["name"], "r");

  while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE)
  {
    $title = $objArr[0];
    $name = $objArr[1]." ".$objArr[2];
    $email = $objArr[3];
    $phone = $objArr[4];
    $department = $objArr[5];
    $position = $objArr[6];
    $user_type = 1;
    $success = 0;
    $fail = 0;
    $dup = 0;
    $FailArr = array(); // Insert ไม่ได้
    $DuplArr = array(); // ซ้ำ
    // -------------------------------------------------------------------
    $sql = "select * from personnel where personnel_name ='".$name."'";
    $result = $conn->query($sql);
    if($result->num_rows === 0)
    {
    
      $sql = "insert into personnel
      (personnel_name,email,phone_number,title_name_id,position_id,department_id,user_type_id)
      values
      ('".$name."','".$email."','".$phone."'
      ,(select title_name_id from title_name where title_name = '".$title."')
      ,(select position_id from position where position_name = '".$position."')
      ,(select department_id from department where department_name = '".$department."')
      ,(select user_type_id from user_type where user_level = ".$user_type."))
      ON DUPLICATE KEY UPDATE personnel_id = personnel_id";
    
      if($conn->query($sql)===true){
        $success++;
      }
      else {
        $fail++;
        $str = $fail.". ชื่อ: ".$name.", หน่วยงาน: ".$department.", ตำแหน่ง: ".$position;
        array_push($FailArr,$str);
      }
    }
    else
    {
      $dup++;
      $str = $fail.". ชื่อ: ".$name.", หน่วยงาน: ".$department.", ตำแหน่ง: ".$position;
      array_push($DuplArr,$str);
    }
    // -------------------------------------------------------------------
  }

  fclose($objCSV);

  $str = 'เพิ่มสำเร็จ:'.$success.' | ไม่สำเร็จ: '.$fail.' | ข้อมูลซ้ำ: '.$dup;
  echo json_encode(array('result' => $str));
  
}
?>
