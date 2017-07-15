<!-- รถยนต์ที่เลือก -->
<?php
$id = $_GET['id'];

$sql1 = "
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

$res = $conn->query($sql1);
$r = $res->fetch_assoc();
?>

<div class="panel panel-default">
  <div class="panel-heading">รายละเอียดรถยนต์
    <div class="pull-right">
      <a id="linkEditCars" data-cars="<?php echo $r['car_id']?>"
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
          <td class="text-center"><?php echo $r['car_reg']; ?></td>
          <td><?php echo $r['car_brand_name']; ?></td>
          <td><?php echo $r['car_kind']; ?></td>
          <td class="text-center"><?php echo $r['seat']; ?></td>
          <td><?php echo $r['title_name'].$r['personnel_name']; ?></td>
        </tr>
        <?php
        if ($r['picture_1'] != "" || $r['picture_2'] != "" || $r['picture_3'] != "" || $r['picture_3'] != "" ) {
        ?>
        <tr>
          <td class="parent" colspan="5" align="center">
           <table><tr>
            <td class="child">
              <?php for ($i=0; $i < 4 ; $i++) {
                  if ($r['picture_'.($i+1)] != "") {
                    ?>
                    <td>
                      <section class="contain">
                        <img src="viewimg.php?imgindex=<?php echo ($i+1)."&";?>id=<?php echo $r['car_id'];?>">
                      </section>
                    </td>
                    <?php
                  }
              } ?>
            </td>
           </tr></table>
        </td>


        </tr>
        <?php
        }
        ?>
      </tbody>
      </table>
    </div>
</div>
