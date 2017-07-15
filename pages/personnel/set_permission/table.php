<?php
$department_id = $_GET['id'];

// $sql = "
// SELECT t.* from user_type t
// order by user_level ASC ";

$sql = "
SELECT t.* from user_type t
LEFT OUTER JOIN personnel p
ON p.user_type_id = t.user_type_id
GROUP By user_type_name
Order by COUNT(p.personnel_id) DESC ";

$result = $conn->query($sql);
$result_row = mysqli_num_rows($result);

if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
{

  while($row = $result->fetch_assoc()){
    ?>
    <div class="row">
        <div class="col-lg-12">
      <div class="panel panel-primary">
          <div class="panel-heading">ข้อมูลบุคลากร : ประเภท<?php echo $row['user_type_name']; ?></div>
          <div class='table-responsive'>
          <table id="myTable" class="table table-striped table-bordered table-hover">
              <thead id="Table_Default">
                  <tr>
                      <th id="tb_sharp">#</th>
                      <th id="tb_detail_main">ชื่อบุคลากร</th>
                      <th id="tb_detail_sub-nd">ตำแหน่ง</th>
                      <th id="tb_tools_ismore">เครื่องมือ</th>
                  </tr>
              </thead>
              <tbody>
    <?php
    $sql2 = "
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
    WHERE type.user_type_id = ".$row['user_type_id']."
    AND d.department_id = ".$department_id."
    ORDER BY psn.personnel_name ASC";

    $res = $conn->query($sql2);
    $result_row2 = mysqli_num_rows($res);
    if ($result_row2 !== 0) // ถ้าใน Table มีข้อมูล
    {
          $count = 0;
          while($r = $res->fetch_assoc())
          {
              $count += 1;
              ?>
                    <tr>
                    <td class="text-center"><?php echo $count ?></td>
                    <td><?php echo $r["title_name"].$r["personnel_name"]; ?></td>
                    <td><?php echo $r["position_name"]; ?></td>

                    <td class="text-center">
                    <button type="submit" class="btn btn-primary handlePermission" role="button"
                    data-toggle="modal" data-target="#Set_permission_modal" data-id="<?php echo $r["personnel_id"];?>">
                        <span class="fa fa-gear"></span> กำหนดสิทธิ์
                    </button>
                    </td>
                    </tr>

              <?php
          }
    }
    else
    {
      ?>
            <tr>
            <td class="text-center" colspan="4">ไม่มีข้อมูลบุคลากร</td>
            </tr>
      <?php
    }

    ?>
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
    <?php
  }


}
?>
