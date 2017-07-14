<?php
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  // $id = 11;
  $type = 0;

  $sql = "
  SELECT kilometer_out AS kout
  , kilometer_in AS kin FROM reservation
  WHERE reservation_id = ".$id;
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();


?>
  <br />
  <div class="row">
    <div class="container-fluid">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">บันทึกพนักงานขับรถยนต์และยามรักษาการณ์</div>
          <form class="form-horizontal" action="enterkl/edit.php" method="post">

            <div class="panel-body">
              <?php
              /*ถ้ายังไม่มีการบันทึกเวลาเข้า-ออกมหาลัย*/
              if ($row['kout'] == 0 && $row['kin'] == 0)
              {
                $type = 1;
              ?>
              <!-- ระยะทางออก -->
              <div class="form-group">
                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                  <span class="requestfield">*</span> เลขกิโลเมตรเมื่อออก :
                </label>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <input type="number" class="form-control" name="kl_out" placeholder="พิมพ์เลขกิโลเมตร" value="">
                </div>
              </div>

          <?php }
            /*ถ้ายังไม่มีการบันทึกบันทึกเวลาออกแล้ว ยังไม่บันทึกเข้า*/
            elseif ($row['kout'] != 0 && $row['kin'] == 0)
            {
              $type = 2;
          ?>
              <!-- ระยะทาง้เข้า -->
              <div class="form-group">
                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">
                  <span class="requestfield">*</span> เลขกิโลเมตรเมื่อเข้า :
                </label>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <input type="number" class="form-control" name="kl_in" min="<?php echo $row['kout'];?>" placeholder="พิมพ์เลขกิโลเมตร" value="">
                </div>
              </div>
              <input type="hidden" name="oldkl" value="<?php echo $row['kout']?>">
      <?php }
            /*ผิดพลาด */
            else
            {
              echo "
              <!DOCTYPE html>
              <script>
              window.location.assign('index.php');
              </script>
              ";
            }
      ?>
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
}else {
  session_destroy();
  echo "
  <!DOCTYPE html>
  <script>
  alert('เข้าลิ้งค์แบบไม่ถูกต้อง');
  window.location.assign('index.php');
  </script>
  ";

}
?>
