<?php
session_start();
require_once '../_connect.php';
$id = $_POST['car_id'];


$sql = "SELECT c.* , b.* , p.* , t.* from cars c
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

  $car_reg = $row['car_reg'];
  $reg = substr($car_reg,0,strpos($car_reg,' '));
  $province = substr($car_reg,strpos($car_reg,' ')+1,strlen($car_reg));


  echo "
  <!-- เลขทะเบียน -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      <span class='requestfield'>*</span> ทะเบียนรถยนต์ :
    </label>
    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-6'>
    <input type='text' class='form-control' name='car_reg'
    id='car_reg' value='".$reg."' placeholder='พิมพ์เลขทะเบียน' required>
    </div>
    <div class='col-lg-4 col-md-4 col-sm-4 col-xs-6'>
    <select class='form-control' id='province' name='province' value=''></select>
    </div>
  </div>
  <!-- ยี่ห้อ -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      <span class='requestfield'>*</span> เลือกยี่ห้อ :
    </label>
    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
    <select name='car_brand' class='form-control' required>";
    $sql = "Select * from car_brand order by car_brand_name ASC";
    $result = $conn->query($sql);
    if(mysqli_num_rows($result) !== 0)
    {
      while ($r= $result->fetch_assoc())
      {
        if($r['car_brand_name'] === $row['car_brand_name'])
        {
          echo "
          <option value='".$r['car_brand_name']."' selected>
          ".$r['car_brand_name']."
          </option>";
        }
        else
        {
          echo "
          <option value='".$r['car_brand_name']."'>
          ".$r['car_brand_name']."
          </option>";
        }

      }
    }
    else
    {
      echo "<option value=null>ไม่พบข้อมูลยี่ห้อรถยนต์</option>";
    }
echo "
  </select>
    </div>
  </div>
  <!-- รุ่น -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      <span class='requestfield'>*</span> รุ่น :
    </label>
    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
    <input type='text' class='form-control' name='car_kind'
    id='car_kind' value='".$row['car_kind']."' placeholder='พิมพ์รุ่นของรถยนต์' required>
    </div>
  </div>
  <!-- รายละเอียด -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      รายละเอียด :
    </label>
    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
    <textarea  rows='3' type='text' class='form-control' id='car_detail' name='car_detail'
    placeholder='พิมพ์รายละเอียดของรถยนต์' style='resize:none;'>".$row['car_detail']."</textarea>
    </div>
  </div>
  <!-- จำนวนที่นั่ง -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      <span class='requestfield'>*</span> จำนวนที่นั่ง :
    </label>
    <div class='col-lg-3 col-md-3 col-sm-3 col-xs-6'>
    <input class='form-control' type='number' name='seat' min='1' max='50'
    placeholder='0' required value='".$row['seat']."'>
    </div>
  </div>
  <!-- คนขับรถยนต์ -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      <span class='requestfield'>*</span> เลือกคนขับ :
    </label>
    <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>";
      switch ($_SESSION['user_type']) {
        case 'เจ้าหน้าที่ดูแลระบบ':
        $sql = "
          SELECT
            psn.* , t.* , p.* , d.*
          FROM personnel psn
          LEFT OUTER JOIN title_name t
            ON psn.title_name_id = t.title_name_id
          LEFT OUTER JOIN  position p
            ON psn.position_id = p.position_id
          LEFT OUTER JOIN  department  d
            ON psn.department_id = d.department_id
          WHERE position_name = 'คนขับรถยนต์'
          ORDER BY department_name ASC";
          $result = $conn->query($sql);
          if(mysqli_num_rows($result) !== 0)
          {
            echo "
            <select name='driver' class='form-control' required>
            ";
            $sql2 = "SELECT d.*FROM department d
            LEFT OUTER JOIN personnel p
            ON p.department_id= d.department_id
            LEFT OUTER JOIN cars c
            ON c.personnel_id = p.personnel_id
            GROUP BY department_name
            ORDER BY COUNT(car_reg) DESC
            , department_name ASC";
            $result2 = $conn->query($sql2);
            while ($r = $result2->fetch_assoc())
            {
                  $sql = "
                    SELECT
                      psn.* , t.* , p.* , d.*
                    FROM personnel psn
                    LEFT OUTER JOIN title_name t
                      ON psn.title_name_id = t.title_name_id
                    LEFT OUTER JOIN  position p
                      ON psn.position_id = p.position_id
                    LEFT OUTER JOIN  department  d
                      ON psn.department_id = d.department_id
                    WHERE position_name = 'คนขับรถยนต์'
                    AND department_name = '".$r['department_name']."'
                    ORDER BY department_name ASC";
                  $result = $conn->query($sql);
                  if(mysqli_num_rows($result) !== 0)
                  {
                    echo "<optgroup label='".$r['department_name']."'>";
                    while ($r = $result->fetch_assoc())
                    {
                      if ($r['personnel_name'] == $row['personnel_name']) {
                        echo "
                        <option value='".$r['personnel_name']."' selected>
                        ".$r['title_name']." ".$r['personnel_name']."
                        </option>";
                      }else {
                        echo "
                        <option value='".$r['personnel_name']."'>
                        ".$r['title_name']." ".$r['personnel_name']."
                        </option>";
                      }

                    }
                  }else {
                    echo "<optgroup label='".$r['department_name']."' disabled style='color:#cccccc;'>";
                    echo "<option value=null style='color:#dfdfdf;' disabled>ไม่พบข้อมูลคนขับรถยนต์</option>";
                  }

            }
          }
          else
          {
            echo "
            <select name='driver' class='form-control' readonly disable >
            <option value=null>ไม่พบข้อมูลคนขับรถยนต์</option>";
          }
          echo "
          </select>";
          break;
        case 'ผู้อนุมัติประจำหน่วยงาน ลำดับที่ 1':
        $sql = "
          SELECT
            psn.* , t.* , p.* , d.*
          FROM personnel psn
          LEFT OUTER JOIN title_name t
            ON psn.title_name_id = t.title_name_id
          LEFT OUTER JOIN  position p
            ON psn.position_id = p.position_id
          LEFT OUTER JOIN  department  d
            ON psn.department_id = d.department_id
          WHERE position_name = 'คนขับรถยนต์'
          AND department_name = '".$_SESSION['department']."'";
          $result = $conn->query($sql);
          if(mysqli_num_rows($result) !== 0)
          {
            echo "
            <select name='driver' class='form-control'>";
            while ($r = $result->fetch_assoc())
            {
              if($r['personnel_name'] == $row['personnel_name'])
              {
                echo "
                <option value='".$r['personnel_name']."' selected>
                ".$r['title_name']." ".$r['personnel_name']."
                </option>";
              }
              else
              {
                echo "
                <option value='".$r['personnel_name']."'>
                ".$r['title_name']." ".$r['personnel_name']."
                </option>";
              }
            }
          }
          else
          {
            echo "
            <select name='driver' class='form-control' readonly disable>";
            echo "<option value=null>ไม่พบข้อมูลคนขับรถยนต์</option>";
          }
          echo "
          </select>";
          break;
      }
  echo "
    </div>
  </div>
  <!-- สถานะ -->
  <div class='form-group'>
    <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
      สถานะรถยนต์ :
    </label>
    <div class='col-lg-3 col-md-3 col-sm-3 col-xs-6'>
    <select name='status' class='form-control'>";
    if($row['status'] === 'จองได้')
    {
      echo "
      <option value='จองได้' selected>จองได้</option>
      <option value='งดจอง'>งดจอง</option>";
    }
    else
    {
      echo "
      <option value='จองได้'>จองได้</option>
      <option value='งดจอง' selected>งดจอง</option>";
    }
echo "
    </select>
    </div>
  </div>";
  if($row['status'] === 'งดจอง'){
    echo "<!-- ถ้้าสถานะงดจอง -->
    <div class='form-group'>
      <label class='col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label'>
        <span class='requestfield'>*</span> หมายเหตุ :
      </label>
      <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
      <textarea  rows='3' type='text' class='form-control' id='note_area' name='note'
      placeholder='พิมพ์หมายเหตุที่งดจองรถยนต์' style='resize:none;'>".$row['note']."</textarea>
      </div>
    </div>";
  }
echo"<input type='hidden' name='car_id' value='".$id."'/>
  ";
?>
