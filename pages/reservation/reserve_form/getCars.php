<?php
require '../../_connect.php';

$department = $_POST['user_department'];
$date_start = $_POST['date_start'];
$date_end = $_POST['date_end'];
$time_start = $_POST['time_start'];
$time_end = $_POST['time_end'];

$sql = "
SELECT c.* , b.* , p.* , t.* , d.* FROM cars c
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
WHERE c.car_id NOT IN (
   SELECT car_id FROM reservation r
  WHERE (date_start BETWEEN '".$date_start."' AND '".$date_end."')
  OR (date_end BETWEEN '".$date_start."' AND '".$date_end."')
  OR (reserv_stime BETWEEN '".strtotime ($time_start)."' AND '".strtotime ($time_end)."')
  OR (reserv_etime BETWEEN '".strtotime ($time_start)."' AND '".strtotime ($time_end)."')
  )
  AND department_name = '".$department."'
  AND c.status <> 'งดจอง'
GROUP BY car_reg";

$result = $conn->query($sql);
$result_row = mysqli_num_rows($result);
if ($result_row !== 0) // ถ้าใน Table มีข้อมูล
{
  while($row = $result->fetch_assoc())
  {
    echo "
    <tr>
    <td>
    <center>
    <input type='radio' id='selecter_cars' name='selecter_cars'
    class='selecter_cars' value='".$row['car_id']."'/>
    </center>
    </td>
    <td class='text-center'>".$row['car_reg']."</td>
    <td class='text-left'>".$row['car_brand_name']."</td>
    <td class='text-left'>".$row['car_kind']."</td>
    <td class='text-center'>".$row['seat']."</td>
    <td class='text-left'>".$row['title_name']." ".$row['personnel_name']."</td>
    <td class='text-left'>".$row['department_name']."</td>
    </tr>
    ";
  }
}else {
  echo "<tr><td colspan='7'>ไม่มีข้อมูลรถยนต์ว่าง</td></tr>";
}
?>
