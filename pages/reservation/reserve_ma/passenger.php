<!-- รายชื่อผู้โดยสาร -->
<br>
<?php
$id = $_GET['id'];

$sql = "
SELECT * FROM passenger p
LEFT JOIN reservation r
ON p.reservation_id = r.reservation_id
LEFT JOIN department d
ON p.department_id = d.department_id
WHERE p.reservation_id = ".$id."
";

$result = $conn->query($sql);

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
          <th id="tb_sharp">#</th>
          <th id="tb_detail_main">ชื่อผู้โดยสาร</th>
          <th id="tb_detail_main">หน่วยงาน</th>
        </tr>
      </thead>
      <tbody>
<?php
$result_row = mysqli_num_rows($result);
if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
{
    $count = 0;
    while($row = $result->fetch_assoc())
    {
      $count++;
      ?>
    <tr>
      <td class="text-center"><?php echo $count; ?></td>
      <td><?php echo $row['passenger_name']; ?></td>
      <td>
      <?php
       if ($row['department_id'] != 0) {
        echo $row['department_name'];
      }else {
        echo "-";
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
