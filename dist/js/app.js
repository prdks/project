$(function () {
  //ชี้แล้วโชว์อธิบายปุ่ม
  $('[data-toggle="tooltip"]').tooltip();
  //ปิด Modal แล้วจะเคลียร์ textbox
  $('.modal').on('hidden.bs.modal', function () {
    $(this).find('input,textarea').val('').end();
    $(this).find("option").prop('selectedIndex', 0).end();
  });
  $('input[name=phone_number]').mask("999-999-9999");

  $('.table-responsive').on('show.bs.dropdown', function () {
    $('.table-responsive').css( "overflow", "inherit" );
});


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
