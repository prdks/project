<!DOCTYPE html>
<html lang="en">

<head>
      <?php
        include '_head.php';
      ?>
</head>

<body>

<?php
$sql = "SELECT count(id) as c FROM config ";
$result = $conn->query($sql);
$row = $result->fetch_array();
if ($row['c'] == 0)
{
  echo "
  <!DOCTYPE html>
  <script>
  function redir()
  {
  window.location.assign('admin_login.php');
  }
  </script>
  <body onload='redir();'></body>
  ";
}
else
{
?>
    <div id="wrapper">
      <!-- Navigation -->
      <?php include '_navbar.php'; ?>
      <!-- ./Navigation -->
        <div id="page-wrapper">
          <br />

              <div class="row">
                <div class="col-sm-12 col-xs-12">
                  <div class="hidden-lg hidden-md text-right">
                    <i class="fa fa-square fa-fw c-ap"></i> : รอนุมัติ /
                    <i class="fa fa-square fa-fw c-suc"></i> : อนุมัติแล้ว /
                    <i class="fa fa-square fa-fw c-cancel"></i> : จองไม่สำเร็จ,ยกเลิก
                  </div>
                </div>
              </div>
              <!-- ปฏิทิน -->
               <div class="row">
                 <div class="col-lg-12">
                   <div class="panel panel-default">
                    <div class="panel-heading">
                      ปฏิทินการจองใช้รถยนต์
                      <div class="hidden-xs hidden-sm pull-right">
                        <i class="fa fa-square fa-fw c-ap"></i> : รอนุมัติ /
                        <i class="fa fa-square fa-fw c-suc"></i> : อนุมัติแล้ว /
                        <i class="fa fa-square fa-fw c-cancel"></i> : จองไม่สำเร็จ,ยกเลิก
                      </div>

                    </div>
                    <div class="panel-body">
                      <div id="calendar"></div>
                    </div>
                  </div>
                 </div>
               </div>

          <br />
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<script type="text/javascript">
$(function () {
  $('#calendar').fullCalendar({
    header: {
        left: 'prev,next today',  //  prevYear nextYea
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek',
    },
    buttonIcons:{
        prev: 'left-single-arrow',
        next: 'right-single-arrow',
        prevYear: 'left-double-arrow',
        nextYear: 'right-double-arrow'
    },
    displayEventTime:false,
    handleWindowResize: true,
    minTime: '00:00:00',
    maxTime: '24:00:00',
    eventLimit:false,
    eventLimitText: 'ดูรายการทั้งหมด' ,
    isRTL:false,
    allDaySlot:false,
    nextDayThreshold : '00:00:00',
    timeFormat:"HH:mm"+"น.",
    slotLabelFormat:"HH:mm"+"น.",
    events: {
        url: '_calendar.php',
        error: function() {
        }
    },
    eventRender: function(event, element) {
      var titleLimit = 40;
      if (event.title.length > titleLimit) {
          element.find('.fc-title').text(event.title.substr(0,titleLimit)+'...').parent().attr('title', event.title);
      }
      $(element).tooltip({title:'คลิกดูรายละเอียดการจอง'});
    },
    viewRender:function( view, element ){
       setTimeout(function(){ //แปลงพ.ศ.ด้านบน
           var oldYear =$(".fc-toolbar").find(".fc-center").text();
           oldYear = $.trim(oldYear);
           var oldY = oldYear.substr(-4);
           var newY = parseInt(oldY)+543;
           oldYear = oldYear.replace(oldY,newY);
           $(".fc-toolbar").find(".fc-center").find("h2").text(oldYear);
       },10);
       setTimeout(function(){ //แปลงพ.ศ.หน้าแผนงาน
           $(".fc-widget-header").find(".fc-list-heading-alt").each(function () {
            var oldYear = $(this).text();
            oldYear = $.trim(oldYear);
            var oldY = oldYear.substr(-4);
            var newY = parseInt(oldY)+543;
            oldYear = oldYear.replace(oldY,newY);
            $(this).text(oldYear);
          });
       },10);
   },
    eventLimit:true,
    locale: 'th',
    eventClick: function(calEvent, jsEvent, view) {
      var passenger_str = "";
      $.each( calEvent.passenger, function( index, value ){passenger_str += value});

      //display a modal
      var modal =
      '<div class="modal fade">\
        <div class="modal-dialog modal-lg">\
         <div class="modal-content">\
         <div class="modal-header">\
           <button type="button" class="close" data-dismiss="modal">&times;</button>\
           <h4 class="modal-title"><i class="fa fa-book"></i> รายละเอียดการจองรถยนต์</h4>\
         </div>\
         <div class="modal-body">\
           <table class="table table-bordered">\
             <!-- จองใช้เพื่อ -->\
             <tr>\
             <td class="col-lg-3 col-md-3 col-sm-3 col-xs-3 topic">จองใช้เพื่อ :</td>\
             <td>'+calEvent.detail+'</td>\
             </tr>\
             <!-- รถยนต์ที่จอง -->\
             <tr>\
             <td class="field-label col-xs-3 topic">รถยนต์ที่จอง :</td>\
             <td> '+calEvent.car_reg+'/ ยี่ห้อ '+calEvent.car_brand+' / รุ่น '+calEvent.car_kind+' / '+calEvent.seat+' ที่นั่ง </td>\
             </tr>\
             <!-- วันที่ใช้รถยนต์ -->\
             <tr>\
             <td class="field-label col-xs-3 topic">วันที่ใช้รถยนต์ :</td>\
             <td>'+calEvent.reservation_date+'</td>\
             </tr>\
             <!-- รายชื่อผู้โดยสาร -->\
             <tr>\
             <td class="field-label col-xs-3 topic">รายชื่อผู้โดยสาร :</td>\
             <td><dl>'+passenger_str+'</dl></td>\
             </tr>\
             <!-- สถานที่จะไป -->\
             <tr>\
             <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">สถานที่จะไป :</td>\
             <td>'+calEvent.location+'</td>\
             </tr>\
             <!-- ให้รถไปรับที่ -->\
             <tr>\
             <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">ให้รถไปรับที่ :</td>\
             <td>'+calEvent.appointment+'</td>\
             </tr>\
             <!-- ผู้ติดต่อ -->\
             <tr>\
             <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">ผู้ติดต่อ :</td>\
             <td>'+calEvent.person+'&nbsp;&nbsp;&nbsp;<b>โทรศัพท์</b> '+calEvent.tel+'</td>\
             </tr>\
             <!-- วันที่ทำรายการ -->\
             <tr>\
             <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">วันที่ทำรายการ :</td>\
             <td>'+calEvent.timestamp+'</td>\
             </tr>\
             <!-- empty -->\
             <tr>\
             <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic" colspan="2"></td>\
             </tr>\
             <!-- ผลการจอง -->\
             <tr>\
             <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">ผลการจอง :</td>\
             <td>'+calEvent.rstatus+'&nbsp;&nbsp;&nbsp;<b>บันทึกโดย</b> '+calEvent.person_approve+'&nbsp;&nbsp;&nbsp;<b>โทรศัพท์</b> '+calEvent.tel_approve+'</td>\
             </tr>\
             <!-- เหตุผล -->\
             <tr>\
             <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">หมายเหตุ :</td>\
             <td>'+calEvent.reserve_note+'</td>\
             </tr>\
             <!-- วันที่แก้ไขสถานะล่าสุด -->\
             <tr>\
             <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">วันที่บันทึกผล :</td>\
             <td>'+calEvent.updateStatus+'</td>\
             </tr>\
             <!-- พนักงานขับรถยนต์ -->\
             <tr>\
             <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 topic">พนักงานขับรถ :</td>\
             <td>'+calEvent.name_driver+'&nbsp;&nbsp;&nbsp;<b>โทรศัพท์</b> '+calEvent.tel_driver+'</td>\
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
  });
});
</script>
<?php
}
?>

</body>
</html>
