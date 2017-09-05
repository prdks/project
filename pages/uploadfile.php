<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
      ?>
      <script src="../dist/js/personnel.js"></script>
</head>

<body>
    <div id="wrapper">
      <!-- Navigation -->
      <?php include '_navbar.php'; ?>
      <!-- ./Navigation -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">การนำเข้าข้อมูลรายชื่อบุคลากร</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
          <!-- Description -->
          <div class="row">
                <div class="col-lg-12">
                    <div class="well well-sm">
                    <h4 class="text-primary"><b><span class="text-danger">*</span> การเพิ่มข้อมูลนำเข้า กรุณาเรียงข้อมูลดังนี้ : </b>คำนำหน้าชื่อ, ชื่อจริง, นามสกุล, อีเมลล์, เบอร์โทรศัพท์, หน่วยงาน, ตำแหน่ง</h4>
                        <p class="text-danger">ข้อควรจำ :</p>
                        <ul>
                            <li>ข้อมูลจะต้องมีทั้งหมด 7 column โดยแต่ละ column จะถูกคั้นด้วยเครื่องหมาย , คอมม่า</li>
                            <li>รายชื่อที่นำเข้าจะเป็นประเภทผู้ใช้งานทั่วไปทุกข้อมูล</li>
                            <li>โปรแกรมจะนำเข้าข้อมูลตั้งแต่บรรทัดที่ 1 หากบรรทัดแรกให้เป็นคำอธิบายให้นำออก</li>
                            <li>ไฟล์ CSV สามารถสร้างได้ด้วยโปรแกรม Microsoft Excel แล้วบันทึกเป็น CSV (Comma delimited) (*.csv)</li>
                            <li>ไฟล์ CSV ที่ได้อาจจะไม่ได้ถูกเข้ารหัส UTF-8 (หมายความว่า ภาษาไทยจะใช้งานไม่ได้) ดังนั้นให้ใช้โปรแกรม Notepad เปิดไฟล์แล้วบันทึกใหม่ โดยให้เลือกรูปแบบ Encoding เป็น UTF-8</li>
                        </ul>
                    </div>
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
          <!-- Upload form -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            นำเข้าข้อมูลด้วยไฟล์ CSV
                        </div>
                        <div class="panel-body">
                            <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST" class="form-horizontal" enctype="multipart/form-data">

                            <div class="form-group">
                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                                    <span class="requestfield">*</span> เลือกไฟล์ CSV :
                                </label>
                                <div class="col-md-4 col-sm-4 col-xs-6">
                                    <input type="file" class="form-control" name="fileCSV" accept=".csv" required>
                                </div>
                            </div>
                            
                        </div>
                        <div class="panel-footer text-right">
                            <button type="submit" name="upload_btn" class="btn btn-primary">นำเข้าข้อมูล</button>
                        </div>

                        </form>
                    </div>
                        <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <?php
            if (isset($_POST['upload_btn'])) 
            {
                $tmp_name = $_FILES["fileCSV"]["tmp_name"];
                $name = basename($_FILES["fileCSV"]["name"]);

                move_uploaded_file($tmp_name,'fileupload/'.$name); // Copy/Upload CSV
                $objCSV = fopen('fileupload/'.$name, "r");
                
                $success = 0;
                $fail = 0;
                $dup = 0;
                $FailArr = array(); // Insert ไม่ได้
                $DuplArr = array(); // ซ้ำ

                  while (($objArr = fgetcsv($objCSV, 1000, ",")) !== FALSE)
                  {
                    $title = $objArr[0];
                    $name = $objArr[1]." ".$objArr[2];
                    $email = $objArr[3];
                    $phone = $objArr[4];
                    $department = $objArr[5];
                    $position = $objArr[6];
                    $user_type = 1;
                    
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
                        $str = $objArr[0].",".$objArr[1].",".$objArr[2].",".$objArr[3].",".$objArr[4].",".$objArr[5].",".$objArr[6];
                        array_push($FailArr,$str);
                      }
                    }
                    else
                    {
                      $dup++;
                      $str = $objArr[0].",".$objArr[1].",".$objArr[2].",".$objArr[3].",".$objArr[4].",".$objArr[5].",".$objArr[6];
                      array_push($DuplArr,$str);
                    }
                    // -------------------------------------------------------------------
                  }
                
                  fclose($objCSV);
                
                  $str = 'เพิ่มข้อมูลสำเร็จ: '.$success.' | เพิ่มไม่สำเร็จ: '.$fail.' | ข้อมูลซ้ำ: '.$dup;

                  echo "<h4>".$str."</h4>";

                  if($fail > 0)
                  {
                      ?>
                      <div class="alert alert-danger alert-dismissable fade in">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <strong>ข้อมูลที่ไม่สามารถเพิ่มได้ มีดังนี้</strong> 
                          <br>
                      <?php
                      foreach ($FailArr as $key => $value) {
                          echo ($key+1).") ".$value."<br>";
                      }
                      ?>   
                      </div>
                      <?php
                  }

                  if($dup > 0)
                  {
                    ?>
                    <div class="alert alert-danger alert-dismissable fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>ข้อมูลที่ไม่สามารถเพิ่มได้ เนื่องจากข้อมูลซ้ำ มีดังนี้</strong> 
                        <br>
                    <?php
                      foreach ($DuplArr as $key => $value) {
                          echo ($key+1).") ".$value."<br>";
                      }
                     ?>   
                     </div>
                    <?php
                  }
            }
            ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>
</html>
