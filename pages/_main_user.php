<?
session_start();  
 if($st!="user")
{
  echo "<script type='text/javascript'>alert('คุณไม่มีสิทธิเข้าใช้งาน กรุณาเข้าสู่ระบบ!!');</script>"; 
  echo "<script type='text/javascript'>window.location.href = \"index.php\";</script>";
}

require_once("calendar.php"); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>หน้าหลัก</title>

    <meta name="description" content="with draggable and editable events" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="css/table.css" />
    <!--[if lte IE 9]>
      <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
  body {font-size: 18px;
}

</style>
  </head>

  <body class="no-skin">
    <div id="navbar" class="navbar navbar-default          ace-save-state">
      <div class="navbar-container ace-save-state" id="navbar-container">
        

        <div class="navbar-header pull-left">
          <a href="index.html" class="navbar-brand">
            <small>
              <i class=" glyphicon glyphicon-blackboard"></i>
              ระบบสารสนเทศเพื่อการจองห้องประชุมทางไกล
            </small>
          </a>
        </div>

         <div class="navbar-buttons navbar-header pull-right" role="navigation">
          <ul class="nav ace-nav">
              <li class="light-blue dropdown-modal">
              <a data-toggle="dropdown" href="#" class="dropdown-toggle">
               <span >
                 
                  <?echo "<font size=\"2\">$NameShow</font>";?>
                </span>

                <i class="ace-icon fa fa-caret-down"></i>
              </a>

                 <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
               
                <li>
                  <a href="profile.php">
                    <i class="ace-icon fa fa-user"></i>
                    ข้อมูลส่วนตัว
                  </a>
                </li>

                <li class="divider"></li>

                <li>
                  <a href="logout.php">
                    <i class="ace-icon fa fa-power-off"></i>
                    ออกจากระบบ
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div><!-- /.navbar-container -->
    </div>
    </div>

    <div class="main-container ace-save-state" id="main-container">
      <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
      </script>

      <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
        <script type="text/javascript">
          try{ace.settings.loadState('sidebar')}catch(e){}
        </script>


        <ul class="nav nav-list">
           <li class="active">
            <a href="main_user.php">
              <i class="menu-icon fa fa-calendar"></i>
              <span class="menu-text">หน้าหลัก </span>
            </a>

          </li >
              <li >
            <a href="addevent.php">
              <i class="menu-icon fa fa-pencil-square-o"></i>
              <span class="menu-text">จองห้องประชุม</span>
            </a>

          </li >
           <li >
            <a href="m_table.php">
              <i class="menu-icon fa fa-list"></i>
              <span class="menu-text">ตารางผลการจอง</span>
            </a>

          </li >
           
          <li >
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-bar-chart-o"></i>
              <span class="menu-text">รายงานสรุปผล </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
              <li >
                <a href="r_all.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                 <font size="2"> ผลรายงานในภาพรวม</font>
                </a>

                <b class="arrow"></b>
              </li>

              <li >
                <a href="r_dep.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  <font size="2">แยกตามหน่วยงาน</font>
                </a>

                <b class="arrow"></b>
              </li>
              <li >
                <a href="r_dep2.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  <font size="2">แยกตามสัดส่วนหน่วยงาน</font>
                </a>

                <b class="arrow"></b>
              </li>

              <li class="">
                <a href="r_pie.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  <font size="2">แยกตามสัดส่วนการประชุม</font>
                </a>

                <b class="arrow"></b>
              </li>
                <li class="">
                <a href="r_user.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  <font size="2">แยกตามเจ้าหน้าที่</font>
                </a>

                <b class="arrow"></b>
              </li>
              <li >
                <a href="r_user2.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  <font size="2">แยกตามสัดส่วนเจ้าหน้าที</font>
                </a>

                <b class="arrow"></b>
              </li>
               <li >
                <a href="r_asse.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  <font size="2">ผลประเมินความพึงพอใจ</font>
                </a>

                <b class="arrow"></b>
              </li>

            </ul>
          
            <li>
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-cogs"></i>
              <span class="menu-text">จัดการข้อมูลพื้นฐาน</span>

              <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
              <li  >
                <a href="device.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  <font size="2">จัดการข้อมูลอุปกรณ์</font>
                </a>

                <b class="arrow"></b>
              </li>
              <li >
                <a href="dep.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  <font size="2">จัดการข้อมูลหน่วยงาน</font>
                </a>

                <b class="arrow"></b>
              </li>
                  <li >
                <a href="meeting_room.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  <font size="2">จัดการข้อมูลห้องประชุม</font>
                </a>

                <b class="arrow"></b>
              </li>

            

            </ul>
            </li>
            
        </ul><!-- /.nav-list -->

  
 <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
          <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
      </div>

      <div class="main-content">
        <div class="main-content-inner">
          <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
              <li>
                <i class="ace-icon fa fa-calendar"></i>
                <a href="#">ปฏิทินแสดงการจองห้องประชุมทางไกล</a>
              </li>
          
            </ul><!-- /.breadcrumb -->

         
          </div>

          <div class="page-content">
            <div class="ace-settings-container" id="ace-settings-container">
              

            <!-- /.ace-settings-box -->
            </div><!-- /.ace-settings-container -->

            

            <div class="row">
              <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                  <div class="col-sm-9">
                    <div class="space"></div>

                    <div id="calendar"></div>
                  
                  </div>

                  <div class="col-sm-3">
                    <div class="widget-box transparent">
                      <div class="widget-header">
                        <h4>อธิบายสีการจอง</h4>
                      </div>
                      <div class="widget-body">
                     <br>
                     <img src="assets/images/wait.png" width="25" height="25" > รอการอนุมัติ<br><br>
                     <img src="assets/images/finish.png" width="25" height="25" > การจองที่อนุมัติแล้ว<br><br>
                      <img src="assets/images/part.png" width="25" height="25" > การจองที่ดำเนินการเสร็จสิ้น<br><br>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- PAGE CONTENT ENDS -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script src="assets/js/jquery-2.1.4.min.js"></script>

    <!-- <![endif]-->

    <!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- page specific plugin scripts -->
    <script src="assets/js/jquery-ui.custom.min.js"></script>
    <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/fullcalendar.min.js"></script>
    <script src="assets/js/bootbox.js"></script>

    <!-- ace scripts -->
    <script src="assets/js/ace-elements.min.js"></script>
    <script src="assets/js/ace.min.js"></script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
      jQuery(function($) {

/* initialize the external events
  -----------------------------------------------------------------*/

  $('#external-events div.external-event').each(function() {

    // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
    // it doesn't need to have a start or end
    var eventObject = {
      title: $.trim($(this).text()) // use the element's text as the event title
    };

    // store the Event Object in the DOM element so we can get to it later
    $(this).data('eventObject', eventObject);

    // make the event draggable using jQuery UI
    $(this).draggable({
      zIndex: 999,
      revert: true,      // will cause the event to go back to its
      revertDuration: 0  //  original position after the drag
    });
    
  });




  /* initialize the calendar
  -----------------------------------------------------------------*/

 

  var calendar = $('#calendar').fullCalendar({
    //isRTL: true,
    //firstDay: 1,// >> change first day of week 
    
    buttonHtml: {
      prev: '<i class="ace-icon fa fa-chevron-left"></i>',
      next: '<i class="ace-icon fa fa-chevron-right"></i>'
    },
  
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
     viewRender:function( view, element ){  
        setTimeout(function(){  
            var oldYear =$(".fc-toolbar").find(".fc-center").text();      
            oldYear = $.trim(oldYear);  
            var oldY = oldYear.substr(-4);  
            var newY = parseInt(oldY)+543;  
            oldYear = oldYear.replace(oldY,newY);  
            $(".fc-toolbar").find(".fc-center").find("h2").text(oldYear);         
        },10);  
    },     
    events:      
      <?php echo json_encode($data);?>
    ,
    
   
    
    editable: true,
    droppable: false, // this allows things to be dropped onto the calendar !!!
    drop: function(date) { // this function is called when something is dropped
    
      // retrieve the dropped element's stored Event Object
      var originalEventObject = $(this).data('eventObject');
      var $extraEventClass = $(this).attr('data-class');
      
      
      // we need to copy it, so that multiple events don't have a reference to the same object
      var copiedEventObject = $.extend({}, originalEventObject);
      
      // assign it the date that was reported
      copiedEventObject.start = date;
      copiedEventObject.allDay = false;
      if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];
      
      // render the event on the calendar
      // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
      $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
      
      // is the "remove after drop" checkbox checked?
      if ($('#drop-remove').is(':checked')) {
        // if so, remove the element from the "Draggable Events" list
        $(this).remove();
      }
      
    }
    ,
    selectable: true,
    selectHelper: false,
    select: function(start, end, allDay) {
      
      
      

      calendar.fullCalendar('unselect');

    },
    eventClick: function(calEvent, jsEvent, view) {

      //display a modal
      var modal = 
      '<div class="modal fade">\
        <div class="modal-dialog">\
         <div class="modal-content">\
         <div class="modal-body">\
           <button type="button" class="close" data-dismiss="modal" style="margin-top:-10px;">&times;</button>\
              <table align="center" class="table-list" style="margin-top:10px;">\
                <tr>\
                   <th style="width: 135px">หัวข้อการประชุม :</th>\
                   <td style="width: 140px">' + calEvent.title + '</td>\
                   <th style="width: 125px">วันที่จัดการประชุม :</th>\
                   <td><b>วันที่</b>' + calEvent.re_date + '<br><b>เวลา</b>' + calEvent.re_time + '</td>\
                </tr>\
                <tr>\
                   <th>สถานะการจอง :</th>\
                   <td>' + calEvent.status + '</td>\
                   <th>วันที่รับเรื่อง :</th>\
                  <td>' + calEvent.get_date + '</td>\
                </tr>\
                <tr>\
                  <th>ชื่อผู้จอง :</th>\
                  <td>' + calEvent.us_name + '</td>\
                  <th>คณะ :</th>\
                  <td>' + calEvent.fac + '</td>\
                </tr>\
                <tr>\
                  <th>ตำแหน่ง :</th>\
                  <td>' + calEvent.p + '</td>\
                  <th>สังกัด :</th>\
                  <td>' + calEvent.be + '</td>\
                </tr>\
                <tr>\
                  <th>เบอร์โทรผู้จอง :</th>\
                  <td>' + calEvent.tel_us + '</td>\
                  <th>อีเมลผู้จอง :</th>\
                  <td>' + calEvent.mail_use + '</td>\
               </tr>\
               <tr>\
                  <th>เบอร์โทรศัพท์ภายใน :</th>\
                  <td>' + calEvent.tel_in + '</td>\
                  <th>สถานที่ประชุม :</th>\
                  <td>' + calEvent.room + '</td>\
               </tr>\
               <tr>\
                  <th>เจ้าหน้าที่รับเรื่อง :</th>\
                  <td>' + calEvent.u_get + '</td>\
                  <th>เจ้าหน้าที่รับผิดชอบ :</th>\
                  <td>' + calEvent.u_do + '</td>\
               </tr>\
               <tr>\
                  <th>จำนวนผู้เข้าประชุม :</th>\
                  <td>' + calEvent.total + '</td>\
                  <th>อุปกรณ์ที่ใช้ :</th>\
                  <td>' + calEvent.device + '</td>\
               </tr>\
               <tr>\
                  <th>ข้อมูลปลายทาง<br>(มจพ.กรุงเทพ) :</th>\
                  <td>'+ calEvent.tobangkok + '</td>\
                  <th>ข้อมูลปลายทาง<br>(มจพ.ระยอง) :</th>\
                  <td>'+ calEvent.torayong + '</td>\
               </tr>\
             </table><br>\
             <table class="table-list" border="1">\
               <tr>\
                  <th style="width: 135px">ผู้อนุมัติ :</th>\
                  <td>'+ calEvent.approve + '</td>\
               </tr>\
               <tr>\
                 <th style="width: 135px">วันที่อนุมัติ :</th>\
                 <td>'+ calEvent.day_approve + '</td>\
               </tr>\
          </table>\
          </div>\
         <div class="modal-footer">\
          <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> ปิด</button>\
         </div>\
        </div>\
       </div>\
      </div>';
    
    
      var modal = $(modal).appendTo('body');
      modal.find('form').on('submit', function(ev){
        ev.preventDefault();

        calEvent.title = $(this).find("input[type=text]").val();
        calendar.fullCalendar('updateEvent', calEvent);
        modal.modal("hide");
      });
      modal.find('button[data-action=delete]').on('click', function() {
        calendar.fullCalendar('removeEvents' , function(ev){
          return (ev._id == calEvent._id);
        })
        modal.modal("hide");
      });
      
      modal.modal('show').on('hidden', function(){
        modal.remove();
      });

  

    }
    ,eventRender: function(event, element) {
      $(element).tooltip({title:'คลิกดูรายละเอียดหัวข้อประชุม : '+event.title});             
  }


    
    
  });


})
    </script>
  </body>
</html>
