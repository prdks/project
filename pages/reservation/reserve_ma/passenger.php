<!-- รายชื่อผู้โดยสาร -->
<?php
$id = $_GET['id'];

$sql2 = "
SELECT * FROM passenger p
LEFT JOIN reservation r
ON p.reservation_id = r.reservation_id
LEFT JOIN department d
ON p.department_id = d.department_id
WHERE p.reservation_id = ".$id."
ORDER BY department_name ASC
, passenger_name ASC";

$res2 = $conn->query($sql2);

?>
<div class="panel panel-default">
  <div class="panel-heading">รายชื่อผู้โดยสาร
    <div class="pull-right">
      <a href="edit_passenger.php?id=<?php echo $_GET['id'];?>">
        <span class="fa fa-edit"></span> แก้ไขข้อมูล
      </a>
    </div>
  </div>

    <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th id="tb_sharp">ลำดับ</th>
          <th id="tb_detail_main">ชื่อผู้โดยสาร</th>
          <th id="tb_detail_main">หน่วยงาน</th>
        </tr>
      </thead>
      <tbody>
<?php
$res2_row = mysqli_num_rows($res2);
if ($res2_row !== 0) // ถ้าใน Table มีข้อมูล
{
    $count = 0;
    while($ro = $res2->fetch_assoc())
    {
      $count++;
      ?>
    <tr>
      <td class="text-center"><?php echo $count; ?></td>
      <td><?php echo $ro['passenger_name']; ?></td>
      <td>
      <?php
       if ($ro['department_id'] != 0) {
        echo $ro['department_name'];
      }else {
        echo "ไม่ระบุหน่วยงาน";
      }
      ?>
      </td>
    </tr>
    <?php
    }

}
else
{
  ?>
  <tr>
    <td colspan="3" class="text-center">ไม่พบรายชื่อผู้โดยสารเพิ่มเติม</td>
  </tr>
  <?php
}
?>
</tbody>
</table>
</div>
</div>
