$(function () {
  //ชี้แล้วโชว์อธิบายปุ่ม
  $('[data-toggle="tooltip"]').tooltip();
  //ปิด Modal แล้วจะเคลียร์ textbox
  $('.modal').on('hidden.bs.modal', function () {
    $(this).find('input,textarea').val('').end();
    $(this).find("option").prop('selectedIndex', 0).end();
  });
  $('input[name=phone_number]').mask("999-999-9999");
// -------------------------------------------------------------
  //  เมื่อกดปุ่มแก้ไข จะส่งค่าไปที่ box
  $('.handleEdit').click(function() {
    var id = $(this).attr('data-id');
    var npage = $(this).attr('data-npage');

    var url = npage+"/controller.php";

    $.ajax({
      type: "POST",
      url: url,
      data: {id: id, mode: 'getDetail'},
      dataType: 'json',
      success: function(data){

          if (npage === 'user_type') {
            $('#update_id').val(id)
            $('#show_update').val(data.name)
            $('#show_level').val(data.user_level)
          }else{
            $('#update_id').val(id)
            $('#show_update').val(data.name)
          }
      }
    });
  });

  //  เมื่อกดปุ่มลบ จะส่งค่าไปที่ box
  $('.handleDelete').click(function() {

    var id = $(this).attr('data-id');
    var npage = $(this).attr('data-npage');

    var url = npage+"/controller.php";

    $.ajax({
      type: "POST",
      url: url,
      data: {id: id, mode: 'getDetail'},
      dataType: 'json',
      success: function(data){
        $('#delete_id').val(id);
        $('#show_delete').text('\n\" '+data.name+' \"');
      }
    });
  });


  

  


    // ---------------คลิกดูรายละเอียดในตาราง-------------
    //ตารางจัดการ
    $('.handleRMADetail').click(function () {
      var id = $(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: "reservation/controller.php",
        data: {id: id, mode: 'getDetail'},
        dataType: 'json',
        success: function(data){

          $('#show-detail').html(data.reserv_detail.detail);
          $('#show-cars').html(data.reserv_detail.cars);
          $('#show-date').html(data.reserv_detail.date);
          if (data.reserv_detail.meet == null) {
            $('#show-meet').html("ยังไม่กำหนด");
          }else {
            $('#show-meet').html(data.reserv_detail.meet);
          }
          $('#show-person').html(data.reserv_detail.person);
          $('#show-phone').html(data.reserv_detail.phone);

          //passenger
          var passenger_str = "";
          if (data.passenger != '') {
            $.each( data.passenger, function( index, value )
            {
                passenger_str += value
            });
            $('#show-passenger').html(passenger_str);
          }
          else
          {
            $('#show-passenger').html('ไม่มีผู้โดยสารเพิ่มเติม');
          }

          $('#show-location').html(data.reserv_detail.location);

          }
      });
    });

    // ถ้ากดเลือกวันจองวันแรก
    $('#dp-fistdate').click(function() {
      var now = new Date();
      var day = ("0" + now.getDate()).slice(-2);
      var month = ("0" + (now.getMonth() + 1)).slice(-2);
      var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

      $(this).attr('min',today);
    });

    // รีเซ็ตหากเลือกวันที่ไม่ถูกต้อง
    $('#dp-fistdate').on("change",function () {
      var date_start = $(this);
      var date_end = $("#dp-lastdate");
      if ($('#dp-lastdate').val() != '') {
        date_end.attr('min', );
        date_end.val(date_start.val());
        $('#dp-tout').attr('min',date_start.val());
        $('#dp-tin').attr('min',date_start.val());
      }
    });
    // ถ้ากดเลือกวันจองวันสุดท้าย
    $('#dp-lastdate').click(function() {
      var date_start = $("#dp-fistdate").val();
      var date_end = $(this);

      var now = new Date();
      var day = ("0" + now.getDate()).slice(-2);
      var month = ("0" + (now.getMonth() + 1)).slice(-2);
      var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

        if (date_start != '') {
          date_end.attr('min', date_start);
        }else {
          date_end.attr('min', today);
        }
    });
    $('#dp-lastdate').on("change" , function () {
      $('#dp-tout').attr('max',$(this).val());
      $('#dp-tin').attr('max',$(this).val());
    });

    $('#dp-tout').on("change" , function () {
      $('#dp-tin').attr('min',$(this).val());
    });

    $('#dp-tout').attr('min',$('#dp-fistdate').val());
    $('#dp-tout').attr('max',$('#dp-lastdate').val());
    $('#dp-tin').attr('min',$('#dp-fistdate').val());
    $('#dp-tin').attr('max',$('#dp-lastdate').val());

    // ถ้าเลือกเวลาสิ้นสุดแต่ยังไม่เลือกเวลาเริ่มต้น
      $('#dp-timeend').click(function() {
        if($('#dp-timestart').val() == ''){
          var start = $('#dp-timestart');
          var end = $('#dp-timeend');
          if (start.val() == '') {
            end.prop('defaultValue','');
            start.focus();
          }
        }else {
          var start = $('#dp-timestart').val();
          var end = $('#dp-timeend');

          end.prop('defaultValue', start.substring(0,2)+":00");
          end.attr('min', start.substring(0,2)+":00");
          end.attr('max', "23:59");
        }
      });

    $('.handleRMADelete').click(function () {

      var id = $(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: "reservation/controller.php",
        data: {id: id, mode: 'getDelete'},
        dataType: 'json',
        success: function(data){
          // console.log(data);
          $('#show-delete-label').html(data.detail);
          $('#show-delete-id').val(data.id);
        }
      });

    });
    $('input[name=kilometer_total]').change(function () {
      var val = $(this).val();
      if (val > 0) {
        $('input[name=reservation_status]').each(function () {
          if ($(this).val() == 1 ) {
            $(this).click();
          }
        });
        $('input[name=usage_status]').each(function () {
          if ($(this).val() == 2 ) {
            $(this).click();
          }
        });
      }
    });

    $('input[name=kilometer_out]').change(function () {
      $('input[name=kilometer_in]').prop('min', $(this).val());
      $('input[name=kilometer_in]').val($(this).val());
    });

    $('input[name=kilometer_in]').click(function () {
        var kout = $('input[name=kilometer_out]');
        if (kout.val() == '') {
          kout.focus();
        }
    });

    $('input[name=kilometer_in]').change(function () {

      var kout = $('input[name=kilometer_out]').val();
      var kin = $('input[name=kilometer_in]').val();
      $('input[name=kilometer_total]').val(kin - kout);

    });

    $('input[name=reservation_status]').each(function () {
      var res = $('#hstatus').attr('data-rstatus');
      var ues = $('#hstatus').attr('data-ustatus');
      if ($(this).val() == res) {
        $(this).click();

        if (res == 0) {
          $('input[name=usage_status]').each(function () {
            if ($(this).val() == res) {
              $(this).attr('disabled',false)
              $(this).click();
            }else {
              $(this).attr('disabled',true)
            }
          });
          $('#edit_note_area').val(''); $('#edit_note_area').attr('required', false);
          $('#edit_note').hide();
        }
        else if (res == 1) {
          $('input[name=usage_status]').each(function () {
            if ($(this).val() == 1 || $(this).val() == 2 || $(this).val() == 3) {
              $(this).attr('disabled',false)
              if ($(this).val() == ues){
                $(this).click();
                $('#edit_note_area').val('');
                $('#edit_note_area').attr('required', false);
                $('#edit_note').hide();
                if (ues == 3) {
                  $('#edit_note').show();
                  $('#edit_note_area').attr('required', true)
                }
              }
            }else {
              $(this).attr('disabled',true)
            }
          });
        }
        else if (res == 2 || res == 3) {
          $('input[name=usage_status]').each(function () {
            if ($(this).val() == 3) {
              $(this).attr('disabled',false)
              $(this).click();
            }else {
              $(this).attr('disabled',true)
            }
          });
          $('#edit_note_area').attr('required', true);
          $('#edit_note').show();
        }
      }
    });

    $('input[name=reservation_status]').on("change",function () {
      var res = $(this).val();
      if (res == 0) {
        $('input[name=usage_status]').each(function () {
          if ($(this).val() == res) {
            $(this).attr('disabled',false)
            $(this).click();
          }else {
            $(this).attr('disabled',true)
          }
        });
        $('#edit_note_area').val('');
        $('#edit_note_area').attr('required', false);
        $('#edit_note').hide();
      }
      else if (res == 1) {
        $('input[name=usage_status]').each(function () {
          if ($(this).val() == 1 || $(this).val() == 2 || $(this).val() == 3) {
            $(this).attr('disabled',false)
            if ($(this).val() == 1){
              $(this).click();
            }
          }else {
            $(this).attr('disabled',true)
          }
        });
        $('#edit_note_area').val('');
        $('#edit_note_area').attr('required', false);
        $('#edit_note').hide();
      }
      else if (res == 2 || res == 3) {
        $('input[name=usage_status]').each(function () {
          if ($(this).val() == 3) {
            $(this).attr('disabled',false)
            $(this).click();
          }else {
            $(this).attr('disabled',true)
          }
        });
        $('#edit_note_area').attr('required', true);
        $('#edit_note').show();
      }
    });
    $('input[name=usage_status]').on("change",function () {
      if ($(this).val() == 3) {
        $('#edit_note_area').attr('required', true);
        $('#edit_note').show();
      }else {
        $('#edit_note_area').val('');
        $('#edit_note_area').attr('required', false);
        $('#edit_note').hide();
      }
    });
    // passenger
    $('.handleAddSelectPassenger').click(function () {
      var person_id = $(this).attr('data-id');
      var reserve_id = $(this).attr('data-reservekeys');
      $.ajax({
        type: "POST",
        url: "reservation/controller.php",
        data: {person_id: person_id, reserve_id: reserve_id, mode: 'insertSelectPassenger'},
        dataType: 'json',
        success: function(data){
          if (data.result == 1) //insert สำเร็จ
          {
            swal('เพิ่มข้อมูลสำเร็จ');
            window.location.assign('edit_passenger.php?id='+reserve_id);
          }
          else if (data.result == 0) //insert ไม่สำเร็จ
          {
            swal('ไม่สามารถเพิ่มข้อมูลได้ กรุณาทำรายการใหม่');
            window.location.assign('edit_passenger.php?id='+reserve_id);
          }
        }
      });
    });



    //  เมื่อกดปุ่มลบ จะส่งค่าไปที่ box
    $('.handleDeletePassenger').click(function() {
      var id = $(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: "reservation/controller.php",
        data: {id: id, mode: 'get_passenger'},
        dataType: 'json',
        success: function(data){
          $('#delete_id').val(data.id);
          $('#reserve_id').val(data.reserve_id);
          $('#show_delete').text('\n\" '+data.title+data.name+' \"');
          if (data.department !== null) {
            $('#show_delete2').text('\n('+data.department+')');
          }
        }
      });
    });

    $('.handleEditPassenger').click(function() {
      var id = $(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: "reservation/controller.php",
        data: {id: id, mode: 'get_passenger'},
        dataType: 'json',
        success: function(data){
          $('.handleEditSelectPassenger').attr('data-old',id);
          $('#edit-data-old').val(id);
          $('#edit_title_name').val(data.title);
          $('#edit_person_name').val(data.name);
          if (data.department !== null) {
            $('#edit_department').val(data.department)
          }else {
            $('#edit_department').val('ไม่ระบุ')
          }

        }
      });
    });

    $('.handleEditSelectPassenger').click(function () {
      var old = $(this).attr('data-old');
      var person_id = $(this).attr('data-id');
      var reserve_id = $(this).attr('data-reservekeys');
      $.ajax({
        type: "POST",
        url: "reservation/controller.php",
        data: {old:old, person_id: person_id, reserve_id: reserve_id, mode: 'editSelectPassenger'},
        dataType: 'json',
        success: function(data){
          if (data.result == 1) //edit สำเร็จ
          {
            swal('แก้ไขข้อมูลสำเร็จ');
            window.location.assign('edit_passenger.php?id='+reserve_id);
          }
          else if (data.result == 0) //edit ไม่สำเร็จ
          {
            swal('ไม่สามารถแก้ไขข้อมูลได้ กรุณาทำรายการใหม่');
            window.location.assign('edit_passenger.php?id='+reserve_id);
          }
        }
      });
    });

    $('#linkEditCars').click(function () {
      $.ajax({
        type: "POST",
        url: "reservation/controller.php",
        data:
         {date_start : $('#dp-fistdate').val()
          ,date_end : $('#dp-lastdate').val()
          ,time_start : $('#dp-timestart').val()
          ,time_end : $('#dp-timeend').val()
          ,car_id : $(this).attr('data-cars')
          ,reserve_id : $(this).attr('data-reservekeys')
          , mode: 'getCars_For_Edit'},
        success: function(data){
          $('#tbody_cars_edit').html(data);
        }
      });
    });
    //-------------------------------------------------------
 
    //-------------------------------------------------------
    //ตารางของยูเซอร์
    // $("#approve_tablelist tbody tr").click(function(e) {
    //   $.post("reservation/reserve_approve/getReservationDetail.php"
    //   ,{reservation_id : $(this).attr('id')}
    //   ,function(data){
    //     $('#show_reservation_approve').html(data);
    //   });
    //    $('#reserv_approve_modal').modal('show');
    // });

    $("#user_reservation_tablelist tbody tr").click(function() {
      $.post("user/getDetail.php"
      ,{reservation_id : $(this).attr('id')}
      ,function(data){
        $('#show_detail').html(data);
      });
       $('#detail_modal').modal('show');
       var reservation_id = localStorage['reservation_id'];
       if (!reservation_id) localStorage['reservation_id'] = $(this).attr('id');

    });

});
