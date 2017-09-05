$(document).ready(function() {
    //ตารางยืนยัน
    $(".handleApproveDetail").click(function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "reservation/controller.php",
            data: { id: id, mode: 'getDetail' },
            dataType: 'json',
            success: function(data) {

                $('#show-detail').html(data.reserv_detail.detail);
                $('#show-cars').html(data.reserv_detail.cars);
                $('#show-date').html(data.reserv_detail.date);
                if (data.reserv_detail.meet == null) {
                    $('#show-meet').html("ยังไม่กำหนด");
                } else {
                    $('#show-meet').html(data.reserv_detail.meet);
                }
                $('#show-person').html(data.reserv_detail.person);
                $('#show-phone').html(data.reserv_detail.phone);

                //passenger
                var passenger_str = "";
                if (data.passenger != '') {
                    $.each(data.passenger, function(index, value) {
                        passenger_str += value
                    });
                    $('#show-passenger').html(passenger_str);
                } else {
                    $('#show-passenger').html('ไม่มีผู้โดยสารเพิ่มเติม');
                }


                $('#show-location').html(data.reserv_detail.location);

                $('#show-status').val('0');
                $('#note_area').html(data.note);

                $('#reserve_id').val(id);

            }
        });
    });



    $('button[name=approve_btn]').click(function() {
        var result = $(this).val()

        if (result == 1) {
            $('#note_approve').hide()
            $('#note_area').attr('required', false)
            $('#show-status').val(result)
            $(this).addClass('btn-success')
        } else if (result == 2) {
            $('#note_area').val('')
            $('#note_approve').show()
            $('#show-status').val(result)
            $('#note_area').attr('required', true)
            $(this).addClass('btn-danger')
        } else if (result == 3) {
            $('#note_area').val('')
            $('#note_approve').show()
            $('#show-status').val(result)
            $('#note_area').attr('required', true)
            $(this).addClass('btn-warning')
        }
        $('button[name=approve_btn]').each(function() {
            if ($(this).val() !== result) {
                $(this).attr('class', 'btn btn-sm btn-default')
            }
        });
    });

    $('#reserv_approve_modal').on('hidden.bs.modal', function() {
        $('button[name=approve_btn]').each(function() {
            $(this).attr('class', 'btn btn-sm btn-default')
        });
        $('#note_approve').hide()
    })
});