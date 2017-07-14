<?php
session_start();
require_once '_connect.php';
date_default_timezone_set("Asia/Bangkok");

function DateThai($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
  }
function FullDateThai($strDate)
  {
      $strYear = date("Y",strtotime($strDate))+543;
      $strMonth= date("n",strtotime($strDate));
      $strDay= date("j",strtotime($strDate));
      $strHour= date("H",strtotime($strDate));
      $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
      $strMonthThai=$strMonthCut[$strMonth];
      return "วันที่ $strDay $strMonthThai พ.ศ. $strYear";
  }
  function DateTimeThai($strDate)
  {
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, เวลา : $strHour:$strMinute"."น.";
  }

 ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ระบบจองรถยนต์ มจพ.ปราจีนบุรี</title>

<!-- Bootstrap Core CSS -->
<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/jquery/jquery.maskedinput.js"></script>
<script src="../vendor/jquery-ui/jquery-ui.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../vendor/metisMenu/metisMenu.min.js"></script>

<!-- Moment -->
 <script type="text/javascript" src="../vendor/moment/moment.js"></script>


<!-- Fullcalendar -->
<link rel='stylesheet' href='../vendor/fullcalendar/fullcalendar.css' />
<script src='../vendor/fullcalendar/fullcalendar.js'></script>
<script type="text/javascript" src="../vendor/fullcalendar/locale/th.js"></script>

<!-- QRcode -->
<script type="text/javascript" src="../vendor/qrcode/qrcode.js"></script>

<!-- datetimepicker -->
<link rel="stylesheet" href="../vendor/datetimepicker/css/bootstrap-datepicker.css">
<script src="../vendor/datetimepicker/js/bootstrap-datepicker-custom.js" charset="utf-8"></script>
<script src="../vendor/datetimepicker/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>

<!-- jqeury-validation -->
<script src="../vendor/jqeury-validation/dist/jquery.validate.js" charset="utf-8"></script>
<script src="../vendor/jqeury-validation/dist/localization/messages_th.js" charset="utf-8"></script>

<!-- Custom CSS -->
<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
<link href="../dist/css/app.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Athiti" rel="stylesheet">


<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>
<script src="../dist/js/app.js"></script>
<script src="../dist/js/func.js"></script>
<script src="../dist/js/validate.js"></script>
<script src="../dist/js/personnel.js"></script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
/*------------------ Stye SearchBox ----------------*/
.stylish-input-group .input-group-addon{
    background: white !important;
}
.stylish-input-group .form-control{
	border-right:0;
	box-shadow:0 0 0;
	border-color:#ccc;
}
.stylish-input-group button{
    border:0;
    background:transparent;
}
</style>
