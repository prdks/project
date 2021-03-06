<?php
if (isset($_GET['id']))
{
      $id = $_GET['id'];
      // $id = 11;
      $type = 0;

      $sql = "
      SELECT kilometer_out AS kout
      , kilometer_in AS kin , car_reg as car , reservation_status as status FROM reservation r
      LEFT JOIN cars c
      ON r.car_id = c.car_id
      WHERE reservation_id = ".$id;
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
    ?>
    <input type="hidden" name="car_reg" value="<?php echo $row['car'];?>">
    <?php
    if($row['status'] == 1)
    {
        /*ถ้ายังไม่มีการบันทึกเวลาเข้า-ออกมหาลัย*/
        if ($row['kout'] == 0 && $row['kin'] == 0)
        {
          $type = 1;
        ?>
        <br />
          <input type="hidden" class="send_id_for_detail" value="<?php echo $id;?>">
          <!-- Detail -->
          <div class="row">
            <div class="container-fluid">
              <div class="col-lg-12">
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <i class="fa fa-file-text fa-fw"></i> รายละเอียดการจองรถยนต์                
                    </div>
                    <div class="panel-body show-detail-enterkl">
                    </div>
                </div>
                
              </div>
            </div>
          </div>

          <div class="row">
            <div class="container-fluid">
              <div class="col-lg-12">
                <div class="panel panel-default">
                  <div class="panel-heading">บันทึกพนักงานขับรถยนต์และยามรักษาการณ์</div>
                  <form class="form-horizontal" id="enterkl_out_form">
                  <div class="panel-body">
                      <!-- ระยะทางออก -->
                      <div class="form-group">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                          <span class="requestfield">*</span> เลขกิโลเมตรเมื่อออก :
                        </label>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <input type="number" class="form-control" name="kl_out" placeholder="พิมพ์เลขกิโลเมตร" value="" required>
                        </div>
                      </div>

                      <!-- hidden -->
                      <input type="hidden" name="id" value="<?php echo $id;?>">
                      <input type="hidden" name="hdtype" value="<?php echo $type;?>">

                      </div>

                      <div class="panel-footer text-right">
                        <a href="index.php" class="btn btn-default">กลับสู่หน้าหลัก</a>
                        <button type="submit" class="btn btn-primary" name="insert">บันทึก</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        <?php
        }
        elseif ($row['kout'] != 0 && $row['kin'] == 0) /*ถ้ายังไม่มีการบันทึกบันทึกเวลาออกแล้ว ยังไม่บันทึกเข้า*/
        {
            $type = 2;
        ?>
          <br />
          <input type="hidden" class="send_id_for_detail" value="<?php echo $id;?>">
          <!-- Detail -->
          <div class="row">
            <div class="container-fluid">
              <div class="col-lg-12">
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <i class="fa fa-file-text fa-fw"></i> รายละเอียดการจองรถยนต์                
                    </div>
                    <div class="panel-body show-detail-enterkl">
                    </div>
                </div>
                
              </div>
            </div>
          </div>

          <div class="row">
            <div class="container-fluid">
              <div class="col-lg-12">
                <div class="panel panel-default">
                  <div class="panel-heading">บันทึกพนักงานขับรถยนต์และยามรักษาการณ์</div>
                  <form class="form-horizontal"  id="enterkl_in_form">
                  <div class="panel-body">
                      <!-- ระยะทาง้เข้า -->
                      <div class="form-group">
                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                          <span class="requestfield">*</span> เลขกิโลเมตรเมื่อกลับ :
                        </label>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <input type="number" class="form-control" name="kl_in" min="<?php echo $row['kout'];?>" placeholder="พิมพ์เลขกิโลเมตร" value="" required>
                        </div>
                      </div>
                      <input type="hidden" name="oldkl" value="<?php echo $row['kout']?>">

                      <!-- hidden -->
                      <input type="hidden" name="id" value="<?php echo $id;?>">
                      <input type="hidden" name="hdtype" value="<?php echo $type;?>">

                      </div>

                      <div class="panel-footer text-right">
                        <a href="index.php" class="btn btn-default">กลับสู่หน้าหลัก</a>
                        <button type="submit" class="btn btn-primary" name="insert">บันทึก</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        <?php
        }
        else /*ผิดพลาด */
        {
            echo "
            <!DOCTYPE html>
            <script>
            window.location.assign('index.php');
            </script>
            ";
        }
    }
    else 
    {
      echo "
      <!DOCTYPE html>
      <script>
      window.location.assign('index.php');
      </script>
      ";
    }

}
else
{
  session_destroy();
  echo "
  <!DOCTYPE html>
  <script>
  alert('ไม่พบรหัสการจอง กรุณาลองใหม่อีกครั้ง');
  window.location.assign('index.php');
  </script>
  ";

}
?>
