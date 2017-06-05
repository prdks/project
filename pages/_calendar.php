<?php 
include("connect.php");

$link = mysqli_connect("localhost", "root", "1234", "myproject");
mysqli_set_charset($link, "utf8");
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


$query="SELECT reservations.id_res , reservations.title  title,reservations.id_room id_room, 
reservations.us_name us_name, reservations.position p, reservations.belong_to b,
department.name_dep fac,reservations.tel_in tel_in, reservations.tel_us tel_us,
reservations.mail_use mail_use, reservations.u_get u_get, reservations.u_do u_do,reservations.to_bangkok to_bangkok, reservations.class1 c1, reservations.room1 r1, 
reservations.building1 b1,reservations.ip1 ip1,reservations.gw1,reservations.uname1 uname1,
reservations.tel1 tel1,reservations.to_rayong to_rayong, reservations.class2 c2,
reservations.room2 r2, reservations.building2 b2,reservations.ip2 ip2,reservations.gw2,
reservations.uname2 uname2 ,reservations.tel2 tel2,reservations.start_date start,
reservations.end_date  end,reservations.status_m status_m,reservations.total total,reservations.to_date todate,device.d_name device,reservations.approve approve,reservations.day_approve day_approve 
FROM reservations 
INNER JOIN  device ON reservations.d_id=device.d_id
INNER JOIN department ON reservations.fac=department.id_dep "; 

if ($result = $link->query($query)) {

     /* fetch object array */
  while ($obj = $result->fetch_object()) {

      /*วันที่จัดการประชุม*/
      $m2=substr($obj->start,5,2);
      $d2=substr($obj->start,8,2);
      $year2=substr($obj->start,0,4);
      $y2=$year2+543;
      $timestart=substr($obj->start,11,5);
      $timeend=substr($obj->end,11,5);
      $re_date=" ". $d2."/".$m2."/".$y2;
      $re_time=" "."$timestart-$timeend";

      /*สังกัด*/
      if($obj->b=="1"){ $b="ภาควิชา";}
      else if($obj->b=="2"){$b="ฝ่าย";}
      else if($obj->b=="3"){$b="กอง";}
      else if($obj->b=="4"){$b="กองงาน";}
      else {$b="-";}
        /*ชื่อผู้จอง*/    

      if($obj->us_name!=""){$name=$obj->us_name;}else{$name="-";}
      /*จำนวนผู้เข้าประชุม*/
      if($obj->total!=""){$total=$obj->total;}else{$total="-";}
      /*เบอร์โทรภายใน*/
      if($obj->tel_in!=""){$tel_in=$obj->tel_in;}else{$tel_in="-";}
      /*เบอร์โทรผู้จอง*/
      if($obj->tel_us!=""){$tel_us=$obj->tel_us;}else{$tel_us="-";}
      /*เมลผู้จอง*/
      if($obj->mail_use!=""){$mail_use=$obj->mail_use;}else{$mail_use="-";}


       /*ปลายทางกรุงเทพ*/
      if( $obj->c1!=""|| $obj->r1!=""|| $obj->b1!=""|| $obj->ip1!=""|| $obj->gw1!=""||
        $obj->uname1!=""|| $obj->tel1!="")
      {
        $tobangkok="ชั้น"." ".$obj->c1."   "."ห้อง".$obj->r1." <br>  "."อาคาร".$obj->b1." <br>  "."IP Address :"." ".$obj->ip1."<br>"." Gateway :". " ".$obj->gw1."<br>"."เจ้าหน้าที่ :"." ".$obj->uname1."<br>"."เบอร์ติดต่อ :"." ".$obj->tel1;
      }else{
        $tobangkok="-";
      }
      /*ปลายทางระยอง*/
      if( $obj->c2!=""|| $obj->r2!=""|| $obj->b2!=""|| $obj->ip2!=""|| $obj->gw2!=""||
        $obj->uname2!=""|| $obj->tel2!="")
      {
        $torayong="ชั้น"." ".$obj->c2."   "."ห้อง".$obj->r2." <br>  "."อาคาร".$obj->b2." <br>  "."IP Address :"." ".$obj->ip2."<br>"." Gateway :". " ".$obj->gw2."<br>"."เจ้าหน้าที่ :"." ".$obj->uname2."<br>"."เบอร์ติดต่อ :"." ".$obj->tel2;

      }else{
        $torayong="-";
      }
      /*วันที่อนุมัติ*/
      if($obj->day_approve!="0000-00-00"){
      $d3=substr($obj->day_approve,8,2);
      $m3=substr($obj->day_approve,5,2);
      $y3=substr($obj->day_approve,0,4);
      $year3=$y3+543;
      $date3=$d3."/".$m3."/$year3";
      }else{$date3="-"; }

      /*ผู้อนุมัติ*/
      if($obj->approve=="1"){
      $appr="ผู้ช่วยผู้อำนวยการสำนักคอมพิวเตอร์และเทคโนโลยีสารสนเทศ มจพ.ปราจีนบุรี";
      }else{ $appr=" -";}

      /*สถานะ*/
      if($obj->status_m=="1"){$m="รออนุมัติ";$c="red";}
      else if($obj->status_m=="2"){$m="อนุมัติแล้ว";$c="green";}
      else if($obj->status_m=="3"){$m="เลื่อนการประชุม";$c="red";}
      // else if($obj->status_m=="4"){$m="ยกเลิก(ผู้ใช้ขอยกเลิก)";$c="red";}
      // else if($obj->status_m=="5"){$m="ยกเลิก(สำนักคอมไม่สามารถจัดได้)";$c="red";}
      // else if($obj->status_m=="6"){$m="ยกเลิก(เกิดการชน ไม่สามารถจัดวันอื่นได้)";$c="red";}
       else if($obj->status_m=="7"){$m="ดำเนินการเสร็จสิ้น";$c="blue";}

      /*สีสถานะ*/
          $arr_type_color=array(  
          "1"=>"#FFFF00",  
          "2"=>"#00FF66",  
          "3"=>"#FFFFFF",
          "7"=>"#FF69B4"
      ); 

          $arr_type_status=array(
            "1"=>"<b>รออนุมัติ</b>",
            "2"=>"<b>อนุมัติแล้ว</b>",
            "3"=>"<b>เลื่อนการประชุม</b>",
            "4"=>"<b>ยกเลิก(ผู้ใช้ขอยกเลิก)</b>",
            "5"=>"<b>ยกเลิก(สำนักคอมไม่สามารถจัดได้)</b>",
            "6"=>"<b>ยกเลิก(เกิดการชน ไม่สามารถจัดวันอื่นได้)</b>",
            "7"=>"<b>ดำเนินการเสร็จสิ้น</b>"
          );
          /*สังกัด*/
          $arr_type_be=array(
           "b1"=>"ภาควิชา", 
           "b2"=>"ฝ่าย",
           "b3"=>"กอง",
           "b4"=>"กองงาน"
          );
          /*ตำแหน่ง*/
          if($obj->p =="1"){$p="เจ้าหน้าที่";} 
          if($obj->p =="2"){$p="อาจารย์";} 
          if($obj->p =="3"){$p="คณบดี";}
          /*วันที่ขอใช้งาน*/
          $m1=substr($obj->todate,5,2);
          $d1=substr($obj->todate,8,2);
          $year1=substr($obj->todate,0,4);
          $y1=$year1+543;
          $get_date=" ". $d1."/".$m1."/".$y1;

          if($obj->status_m=="1" || $obj->status_m=="2" || $obj->status_m=="7" ){
              $data[] = array(
                      'id' => $obj->id,
                      'title'=> $obj->title,
                      'start'=> $obj->start,
                      "color"=>$arr_type_color[$obj->status_m] ,
                      "textColor"=>'#000000',
                      'width'=>"80%",
                      'end'=> $obj->end,

                      'status'=>$m,
                      'day_approve'=>$date3,
                      'approve'=>$appr,
                      'u_get'=>Test1($obj->u_get),
                      'u_do'=>Test2($obj->u_do),
                      'mail_use'=>$mail_use,
                      'total'=>$obj->total,
                      'tobangkok'=>$tobangkok,
                      'torayong'=>$torayong,
                      'device'=>$obj->device,
                      'us_name'=>$name,
                      'fac'=>$obj->fac,
                      'be'=>$b,
                      'p'=>$p,
                      'total'=>$total,
                      'tel_in'=>$tel_in,
                      'tel_us'=>$tel_us,
                      'room'=>RoomJa($obj->id_room),
                      're_date'=>$re_date,
                      're_time'=>$re_time,
                      'get_date'=>$get_date
                   
                     );


   }
 }//close if $obj->status_m

    /* free result set */
    $result->close();
}

mysqli_close($link);



?>
