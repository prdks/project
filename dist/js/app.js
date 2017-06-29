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
// ----------------------- personnel ----------------------------
  //  เมื่อกดปุ่มดูลายระเอียด จะส่งค่าไปที่ box
  $('.handlePersonDetail').click(function() {
    var id = $(this).attr('data-id');

    $.ajax({
      type: "POST",
      url: "personnel/controller.php",
      data: {id: id, mode: 'getDetail'},
      dataType: 'json',
      success: function(data){
        $('#show-name').html(data.name);
        $('#show-email').html(data.email);
        $('#show-phone').html(data.phone);
        $('#show-department').html(data.department);
        $('#show-position').html(data.position);
      }
    });

  });

  //  เมื่อกดปุ่มแก้ไข จะส่งค่าไปที่ box
  $('.handlePersonEdit').click(function() {
    var id = $(this).attr('data-id');

    $.ajax({
      type: "POST",
      url: "personnel/controller.php",
      data: {id: id, mode: 'getEdit'},
      dataType: 'json',
      success: function(data){
        $('#display-title').val(data.title);
        $('#display-name').val(data.name);
        $('#display-email').val(data.email);
        $('#display-phone').val(data.phone);
        $('#display-department').val(data.department);
        $('#display-position').val(data.position);
        $('#display-id').val(data.id);
      }
    });

  });

  // Send data to modal_delete
  $('#btn_delet_modal').click(function() {
    var checked = []
    $("input[name='checked_id[]']:checked").each(function ()
    {
      checked.push(parseInt($(this).val()));
    });
    $.post("personnel/controller.php" ,
      {checked_id: checked , mode: 'getDelete'} ,
      function(data) {
        $('#respone').html(data);
      }
    );

  });

  // send data to Delete
  $('#delete-btn').on('click',function() {
    var checked = []
    $("input[name='checked_id[]']:checked").each(function ()
    {
      checked.push(parseInt($(this).val()));
    });
    $.post("personnel/delete.php" ,{checked_id: checked});
  });

  // ******* Permission ************
  $('.handlePermission').click(function () {
    var id = $(this).attr('data-id');

    $.ajax({
      type: "POST",
      url: "personnel/controller.php",
      data: {id: id, mode: 'getDetail'},
      dataType: 'json',
      success: function(data){
        $('#show-name').html(data.name);
        $('#show-email').html(data.email);
        $('#show-phone').html(data.phone);
        $('#show-department').html(data.department);
        $('#show-position').html(data.position);
        $('#show-usertype').val(data.type);
        $('#show-id').val(id);
      }
    });

  })
// ----------------------- Cars ----------------------------
  $('#status_note').hide();
  $('#display-note-area').hide();
  $('#display-status').change(function(){
      var s = $(this).val();
      if(s == 'งดจอง') {
          $('#display-note').prop('required',true);
          $('#display-note-area').show();
      } else {
          $('#display-note').prop('required',false);
          $('#display-note-area').hide();
      }
  });

  //  เมื่อกดปุ่มดูลายระเอียด จะส่งค่าไปที่ box
  $('.handleCarDetail').click(function() {
    var id = $(this).attr('data-id');

    $.ajax({
      type: "POST",
      url: "cars/controller.php",
      data: {id: id, mode: 'getDetail'},
      dataType: 'json',
      success: function(data){
        $('#show-reg').html(data.reg);
        $('#show-provine').html(data.provine);
        $('#show-brand').html(data.brand);
        $('#show-kind').html(data.kind);
        if (data.detail == "") {
          $('#show-detail').html(" - ");
        }else {
          $('#show-detail').html(data.detail);
        }
        $('#show-seat').html(data.seat);
        $('#show-driver').html(data.driver);
        $('#show-department').html(data.department);
        $('#show-status').html(data.status);
        if (data.status == 'จองได้')
        {
          $('#status_note').hide();
        }
        else
        {
          $('#status_note').show();
          $('#show-note').html(data.note);
        }

      }
    });

  });

  //  เมื่อกดปุ่มแก้ไข จะส่งค่าไปที่ box
  $('.handleCarEdit').click(function() {
    var id = $(this).attr('data-id');
    $.ajax({
      type: "POST",
      url: "cars/controller.php",
      data: {id: id, mode: 'getEdit'},
      dataType: 'json',
      success: function(data){
        $('#display-reg').val(data.reg);
        $('#display-province').val(data.province);
        $('#display-brand').val(data.brand);
        $('#display-kind').val(data.kind);
        $('#display-detail').val(data.detail);
        $('#display-seat').val(data.seat);
        $('#display-driver').val(data.driver);
        $('#display-department').val(data.department);
        $('#display-status').val(data.status);
        if (data.status == 'จองได้')
        {
          $('#display-note-area').hide();
        }
        else
        {
          $('#display-note-area').show();
          $('#display-note').val(data.note);
        }
        $('#display-id').val(data.id);
      }
    });

  });


  $('.handleCarDelete').click(function() {
      var id = $(this).attr('data-id');
      $.ajax({
        type: "POST",
        url: "cars/controller.php",
        data: {id: id, mode: 'getDelete'},
        dataType: 'json',
        success: function(data){
          $('#show-delete-label').html('\" รถยนต์ทะเบียน '+ data.reg +' \"' );
          $('#show-delete-id').val(data.id);
        }
      });

  });
// -------------------------------------------------------------
  // คลิกเลือกทั้งหมด
  $('#select_all').on('click',function(){
    if(this.checked){
        $('.checkbox').each(function(){
            this.checked = true;
        });
    }else{
         $('.checkbox').each(function(){
            this.checked = false;
        });
    }
  });

  // ถ้าเช็คเลือกทั้งหมด แต่เอาออกอันหนึ่ง ช่องเลือกทั้งหมดจะไม่ถูกเช็ค
  $('.checkbox').on('click',function(){
      if($('.checkbox:checked').length == $('.checkbox').length){
          $('#select_all').prop('checked',true);
      }else{
          $('#select_all').prop('checked',false);
      }
  });

  $('#note').hide();
  $('#status').change(function(){
      var s = $(this).val();
      if( s == 'งดจอง') {
          $('#note_area').prop('required',true);
          $('#note').show();
      } else {
          $('#note_area').prop('required',false);
          $('#note').hide();
      }
  });

  $("button[id$='cancel_btn']").click(function() {
    window.location.href = "index.php"
  });
  // ถ้าตาราง สถานที่ยังไม่มีข้อมูล
  var tbody_location = $("#LocationListTable tbody");
  if (tbody_location.children().length == 0) {
    $('#Table_Loaction').hide();
    $('#EmptyLocation').show();
  }

  // เมื่อกดปุ่มเพิ่มสถานที่
  $('#insertList').click(function (event) {
    var LocationName = $('#location_name').val();
    var province = $('#province').val();

    if (LocationName != '' && LocationName.length != 0) {
        if ( $.trim(LocationName) == '' ){ //ถ้าใส่แต่ whitespace
          $('#location_name').val('');
          $('#location_name').attr('required', true);
        }else {
          $('#EmptyLocation').hide();
          $('#Table_Loaction').show();
          var table = document.getElementById("LocationListTable").getElementsByTagName("tbody")[0];
          var rowCount = table.rows.length;
          var row = table.insertRow(rowCount);
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          cell1.innerHTML = "<center><button type='button' class='btn btn-danger btn-xs' onclick='DeleteLocation(this)' name='btn[]'>ลบ</button></center>";
          cell2.innerHTML = LocationName;
          cell3.innerHTML = province;
          $('#location_name').val('');
          $('#province')[0].selectedIndex = 0;
          $('#location_name').focus();
          $('#location_name').attr('required', false);
          event.preventDefault();
        }
    }else {
      $('#location_name').attr('required', true);
    }
  });

  // ถ้ากดเลือกวันจองวันแรก
  $('#date_start').click(function() {
    setDateStart();
  });
  // รีเซ็ตหากเลือกวันที่ไม่ถูกต้อง
  $('#date_start').on("change",function () {
    if ($('#date_end').val() != '') {
      resetWrongDate();
    }
  });
  // ถ้ากดเลือกวันจองวันสุดท้าย
  $('#date_end').click(function() {
    setDateEnd();
  });

// ถ้าเลือกเวลาสิ้นสุดแต่ยังไม่เลือกเวลาเริ่มต้น
  $('#time_end').click(function() {
    if($('#time_start').val() == ''){
      setWrongTime()
    }else {
      setTimeEnd();
    }
  });


  $(".selecter_cars").click(function(){  // เมื่อคลิก checkbox  ใดๆ
    if($(this).prop("checked")==true){ // ตรวจสอบ property  การ ของ
        var indexObj=$(this).index(".selecter_cars"); //
        $(".selecter_cars").not(":eq("+indexObj+")").prop( "checked", false ); // ยกเลิกการคลิก รายการอื่น
    }
  });

  $('#getPersonFromDB').hide();
  $('#InsetPerson').hide();

  $("input[name='select_mode']").click(function(){  // เมื่อคลิก checkbox  ใดๆ
    if($(this).prop("checked")==true){ // ตรวจสอบ property  การ ของ
        var indexObj=$(this).index("input[name='select_mode']"); //
        $("input[name='select_mode']").not(":eq("+indexObj+")").prop( "checked", false ); // ยกเลิกการคลิก รายการอื่น
        if($(this).val() == 1){
          $('#getPersonFromDB').show();
          $('#InsetPerson').hide();
        }else if ($(this).val() == 2) {
          $('#getPersonFromDB').hide();
          $('#InsetPerson').show();
        }
    }
  });

  // ถ้าตาราง ผู้โดยสาร่ยังไม่มีข้อมูล
  var tbody_sPersonnel = $("#PassengerListTable tbody");
  if (tbody_location.children().length == 0) {
    $('#Table_Passenger').hide();
    $('#EmptyPassenger').show();
  }

  //ถ้ากดปุ่มเพิ่มผู้โดยสารจากตาราง
  $("#TablePersonnelList").delegate("button", "click", function(e) {
      var table = document.getElementById("TablePersonnelList").getElementsByTagName("tbody")[0];
      e = e || window.event;
      var data = [];
      var target = e.srcElement || e.target;
      while (target && target.nodeName !== "TR") {
          target = target.parentNode;
      }
      if (target) {
          var cells = target.getElementsByTagName("td");
          for (var i = 0; i < cells.length; i++) {
              data.push(cells[i].innerHTML);
          }
      }
      $('#EmptyPassenger').hide();
      $('#Table_Passenger').show();
      var table = document.getElementById("PassengerListTable").getElementsByTagName("tbody")[0];
      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);
      $.each( data, function( index, value ) {
        if (index == 0) {
          row.insertCell(index).innerHTML = "<center><button type='button' class='btn btn-danger btn-xs' onclick='DeletePassenger(this)' name='btn[]'>ลบ</button></center>";
        }else if (index == 1) {
          row.insertCell(index).innerHTML = value;
        }else {
          row.insertCell(index).innerHTML = "<center>"+value+"</center>";
        }
      });
      $(this).attr('disabled',true);
  });

  // เมื่อกดปุ่มเพิ่มชื่อผู้้โดยสารกำหนดเอง
  $('#insertPassengerList').click(function (event) {
    var title = $('#select_title_name').val();
    var name = $('#person_name').val();
    var department = $('#select_department').val();

    if (name != '' && name.length != 0) {
        if ( $.trim(name) == '' ){ //ถ้าใส่แต่ whitespace
          $('#person_name').val('');
          $('#person_name').attr('required', true);
        }else {
          $('#EmptyPassenger').hide();
          $('#Table_Passenger').show();
          var table = document.getElementById("PassengerListTable").getElementsByTagName("tbody")[0];
          var rowCount = table.rows.length;
          var row = table.insertRow(rowCount);
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          cell1.innerHTML = "<center><button type='button' class='btn btn-danger btn-xs' onclick='DeletePassenger(this)' name='btn[]'>ลบ</button></center>";
          cell2.innerHTML = title+' '+name;
          cell3.innerHTML = "<center>"+department+"</center>";
          $('#person_name').val('');
          $('#select_title_name')[0].selectedIndex = 0;
          $('#select_department')[0].selectedIndex = 0;
          $('#person_name').focus();
          $('#person_name').attr('required', false);
          event.preventDefault();
        }
    }else {
      $('#person_name').attr('required', true);
    }
  });

  // --------------------------tab---------------------------
  //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();

    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);

        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {
      var id = $(this).attr("id");
      switch (id) {
        case 'btnDetail':
            if ($('#formdetail').valid()) {
            sendDatatoGetCars();
            setBtnOnDetailForm();
           }
          break;
        case 'btnSelectCars':
          if (!$("input[id='selecter_cars']:checked").val()) {
             alert('กรุณาเลือกรถยนต์');
          }
          else {
            setBtnOnSelectCarsForm();
          }
          break;
        case 'btnInsertLocation':
          if (tbody_location.children().length == 0) {
            alert('กรุณาเพิ่มสถานที่อย่างน้อย 1 สถานที่');
          }else {
            setBtnOnInsertLocationForm();
          }
          break;
        case 'btnInsertPassenger':
          getReservationData();
          setBtnOnInsertPassengerForm();
          break;
      }
    });

    $(".prev-step").click(function () {
      var id = $(this).attr("id");
      switch (id) {
        case 'btnSelectCars':
          var $active = $('.wizard .nav-tabs li.active');
          $active.removeClass('success');
          $active.removeClass('active')

          $('#step2').removeClass('active');
          $('#step1').addClass('active');
          $active.prev().removeClass('success');
          $active.prev().addClass('active');
          break;
        case 'btnInsertLocation':
          var $active = $('.wizard .nav-tabs li.active');
          $active.removeClass('success');
          $active.removeClass('active');

          $('#step3').removeClass('active');
          $('#step2').addClass('active');
          $active.prev().removeClass('success');
          $active.prev().addClass('active');
          break;
        case 'btnInsertPassenger':
          var $active = $('.wizard .nav-tabs li.active');
          $active.removeClass('success');
          $active.removeClass('active');

          $('#step4').removeClass('active');
          $('#step3').addClass('active');
          $active.prev().removeClass('success');
          $active.prev().addClass('active');
          break;
        case 'btnComplet':
          var $active = $('.wizard .nav-tabs li.active');
          $active.removeClass('success');
          $active.removeClass('active');

          $('#complete').removeClass('active');
          $('#step4').addClass('active');
          $active.prev().removeClass('success');
          $active.prev().addClass('active');
          break;
      }
    });
    // -------------Calendar-------------------------
    $('#calendar').fullCalendar({
      locale: 'th'
    });
    //------------- Set Province BOX ---------------
    getProvince();
    // ---------------คลิกดูรายละเอียดในตาราง-------------
    //ตารางรวม
    // $("#reservation_tablelist tbody tr").click(function() {
    //   $.post("reservation/reserve_list/getReservationDetail.php"
    //   ,{reservation_id : $(this).attr('id')}
    //   ,function(data){
    //     $('#show_reservation_detail').html(data);
    //   });
    //    $('#reserv_detail_modal').modal('show');
    // });

    //-------------------------------------------------------
    //ตารางยืนยัน
    $(".handleApproveDetail").click(function() {
      var id = $(this).attr('data-id');
      //window.location.href = 'approve.php?id='+id;
      $.ajax({
        type: "POST",
        url: "reservation/controller.php",
        data: {id: id, mode: 'getDetail_approve'},
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
          $.each( data.passenger, function( index, value )
          {
              passenger_str += value
          });
          $('#show-passenger').html(passenger_str);

          //location
          var location_str = "";
          $.each( data.location, function( index, value )
          {
              location_str += value
          });
          $('#show-location').html(location_str);

          $('#show-status').val('0');
          $('#note_area').html(data.note);

          $('#reserve_id').val(id);

          }
      });
    });



    $('button[name=approve_btn]').click(function () {
        var result = $(this).val()

        if (result == 1)
        {
          $('#note_approve').hide()
          $('#note_area').attr('required', false)
          $('#show-status').val(result)
          $(this).addClass('btn-success')
        }
        else if (result == 2)
        {
          $('#note_area').val('')
          $('#note_approve').show()
          $('#show-status').val(result)
          $('#note_area').attr('required', true)
          $(this).addClass('btn-danger')
        }
        else if (result == 3)
        {
          $('#note_area').val('')
          $('#note_approve').show()
          $('#show-status').val(result)
          $('#note_area').attr('required', true)
          $(this).addClass('btn-warning')
        }
        $('button[name=approve_btn]').each(function () {
          if ($(this).val() !== result) {
            $(this).attr('class', 'btn btn-sm btn-default')
          }
        });
    });

    $('#reserv_approve_modal').on('hidden.bs.modal', function () {
        $('button[name=approve_btn]').each(function () {
          $(this).attr('class', 'btn btn-sm btn-default')
        });
        $('#note_approve').hide()
    })
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
    // --------------------------------------------------

});
