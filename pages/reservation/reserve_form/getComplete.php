<?php
require '../../_connect.php';
$data = $_POST['data'];
$selecter_cars = $_POST['checked'];
$LocationData = $_POST['LocationData'];

function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		return " $strDay $strMonthThai $strYear";
	}

for ($i=0; $i < sizeof($data)-2; $i++)
{
    switch ($i) {
      case 0:
        echo "
        <!-- ชื่อนามสกุล -->
        <div class='row' style='padding:4px'>
          <div class='form-group'>
          <label class='control-label col-lg-3 col-md-3 col-sm-4 text-right'>
          ชื่อผู้ขออนุมัติ :
          </label>
          <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
          <p>".$data[$i]['value']."</p>
          </div>
          </div>
        </div>";
        break;
      case 1:
      echo "
      <!-- ตำแหน่ง -->
      <div class='row' style='padding:4px'>
        <div class='form-group'>
        <label class='control-label col-lg-3 col-md-3 col-sm-4 text-right'>
        ตำแหน่ง :
        </label>
        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
        <p>".$data[$i]['value']."</p>
        </div>
        </div>
      </div>
      <!-- สังกัดหน่วยงาน -->
      <div class='row' style='padding:4px'>
        <div class='form-group'>
        <label class='control-label col-lg-3 col-md-3 col-sm-4 text-right'>
        หน่วยงาน :
        </label>
        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
        <p>".$data[7]['value']."</p>
        </div>
        </div>
      </div>
      ";

        break;
      case 2:
      echo "
      <!-- ความประสงค์ขอใช้รถยนต์ -->
      <div class='row' style='padding:4px'>
        <div class='form-group'>
        <label class='control-label col-lg-3 col-md-3 col-sm-4 text-right'>
        ความประสงค์ขอใช้รถยนต์ :
        </label>
        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
        <p style='word-wrap:break-word;'>".$data[$i]['value']."</p>
        </div>
        </div>
      </div>";
        break;
      case 3:
      echo "
      <!-- วันแรกที่ต้องการจอง -->
      <div class='row' style='padding:4px'>
        <div class='form-group'>
        <label class='control-label col-lg-3 col-md-3 col-sm-4 text-right'>
        วันแรกที่ต้องการจอง :
        </label>
        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
        <p>".DateThai($data[$i]['value'])."</p>
        </div>
        </div>
      </div>";
        break;
      case 4:
      echo "
      <!-- วันสุดท้ายที่ต้องการจอง -->
      <div class='row' style='padding:4px'>
        <div class='form-group'>
        <label class='control-label col-lg-3 col-md-3 col-sm-4 text-right'>
        วันสุดท้ายที่ต้องการจอง :
        </label>
        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
        <p>".DateThai($data[$i]['value'])."</p>
        </div>
        </div>
      </div>";
        break;
    }
}
      echo "
      <!-- ช่วงเวลา -->
      <div class='row' style='padding:4px'>
        <div class='form-group'>
        <label class='control-label col-lg-3 col-md-3 col-sm-4 text-right'>
        ช่วงเวลา :
        </label>
        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
        <p>ตั้งแต่เวลา ".$data[5]['value']." น. ถึง ".$data[6]['value']." น.</p>
        </div>
        </div>
      </div>";

      echo "
      <!-- รถยนต์ -->
      <div class='row' style='padding:4px'>
        <div class='form-group'>
        <label class='control-label col-lg-3 col-md-3 col-sm-4 text-right'>
        รถยนต์ที่ต้องการจองใช้ :
        </label>
        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>";

        $sql="SELECT c.* , b.* , p.* , t.* FROM cars c
        LEFT JOIN reservation r
        ON r.car_id = c.car_id
        LEFT OUTER JOIN car_brand b
        ON c.car_brand_id = b.car_brand_id
        LEFT OUTER JOIN personnel p
        ON c.personnel_id = p.personnel_id
        LEFT OUTER JOIN title_name t
        ON p.title_name_id = t.title_name_id
        LEFT OUTER JOIN department d
        ON p.department_id = d.department_id
        WHERE c.car_id ='".$selecter_cars[0]['Car_id']."'";

        $result = $conn->query($sql);
        $result_row = mysqli_num_rows($result);
        if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
        {
          while($row = $result->fetch_assoc())
          {
            echo "<p>".$row['car_reg']." / ยี่ห้อ ".$row['car_brand_name']." / รุ่น ".$row['car_kind']." / ".$row['seat']." ที่นั่ง</p>";
          }
        }
      echo
      " </div>
        </div>
      </div>";

      echo "
      <!-- สถานที่ที่ต้องการไป -->
      <div class='row' style='padding:4px'>
        <div class='form-group'>
        <label class='control-label col-lg-3 col-md-3 col-sm-4 text-right'>
        สถานที่ต้องการไป :
        </label>
        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>";
        for ($i=0; $i < sizeof($LocationData); $i++)
        {
            echo ($i+1).'. '.$LocationData[$i]['LocationName'].' จังหวัด '.$LocationData[$i]['Province']."<br />";
        }
      echo "</div>
        </div>
      </div>";

      echo "
      <!-- รายชื่อ -->
      <div class='row' style='padding:4px'>
        <div class='form-group'>
        <label class='control-label col-lg-3 col-md-3 col-sm-4 text-right'>
        ผู้โดยสาร :
        </label>
        <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>";
        if(!isset($_POST['PassengerData'])){
          echo "ไม่มีผู้โดยสารเพิ่มเติม";
        }else {
          $PassengerData = $_POST['PassengerData'];
          for ($i=0; $i < sizeof($PassengerData); $i++)
          {
              echo ($i+1).'. '.$PassengerData[$i]['Name'].' ('.$PassengerData[$i]['Department'].")<br />";
          }
        }

      echo "</div>
        </div>
      </div>";

?>
