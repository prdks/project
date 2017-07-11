<!-- รถยนต์ที่เลือก -->
<?php
$id = $_GET['id'];

$sql = "
SELECT * FROM cars c
LEFT JOIN car_brand b
ON c.car_brand_id = b.car_brand_id
LEFT JOIN reservation r
ON r.car_id = c.car_id
LEFT JOIN personnel p
ON c.personnel_id = p.personnel_id
LEFT JOIN title_name t
ON p.title_name_id = t.title_name_id
WHERE r.reservation_id =".$id;

$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<br>
<div class="panel panel-default">
  <div class="panel-heading">รายละเอียดรถยนต์
    <div class="pull-right">
      <a id="linkEditCars" data-cars="<?php echo $row['car_id']?>"
      data-reservekeys="<?php echo $_GET['id'];?>" data-toggle="modal" data-target="#editCars_modal">
        <span class="fa fa-edit"></span> เปลี่ยนรถยนต์
      </a>
    </div>
  </div>

    <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th id="tb_detail_sub-th">ทะเบียนรถยนต์</th>
          <th id="tb_detail_sub-six">ยี่ห้อรถยนต์</th>
          <th id="tb_detail_sub-six">รุ่นรถยนต์</th>
          <th id="tb_detail_sub-sv">จำนวนที่นั่ง</th>
          <th id="tb_detail_main">ผู้ดูแล</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center"><?php echo $row['car_reg']; ?></td>
          <td><?php echo $row['car_brand_name']; ?></td>
          <td><?php echo $row['car_kind']; ?></td>
          <td class="text-center"><?php echo $row['seat']; ?></td>
          <td><?php echo $row['title_name']." ".$row['personnel_name']; ?></td>
        </tr>
        <tr>
          <td colspan="5">
            <center>
              <img src="testpicture.jpg" class="img-responsive"  width="250" height="250">
            </center>
          </td>
        </tr>
      </tbody>
      </table>
    </div>
</div>
