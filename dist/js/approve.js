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

                // who approve status
                if (data.reserv_detail.first_app != null) {
                    if (data.reserv_detail.first_status == 1) {
                        $('#show-ap-1').attr('class', 'label label-success');
                        $('#show-ap-1').html('อนุมัติ');
                        $('#show-ap-2').attr('class', 'label label-success');
                        $('#show-ap-2').html('อนุมัติ');
                        $('#reason-1').html('');
                    } else if (data.reserv_detail.first_status == 2) {
                        $('#show-ap-1').attr('class', 'label label-danger');
                        $('#show-ap-1').html('ไม่อนุมัติ');
                        $('#show-ap-2').attr('class', 'label label-danger');
                        $('#show-ap-2').html('ไม่อนุมัติ');
                        if (data.reserv_detail.first_reason != "") {
                            $('#reason-1').html('<br><b>เหตุผล : </b>' + data.reserv_detail.first_reason)
                            if (data.reserv_detail.first_note != "") {
                                $('#reason-1').append(' ' + data.reserv_detail.first_note)
                            }
                        }
                    }
                } else {
                    $('#show-ap-1').attr('class', 'label label-info');
                    $('#show-ap-1').html('รออนุมัติ');
                    $('#show-ap-2').attr('class', 'label label-info');
                    $('#show-ap-2').html('รออนุมัติ');
                    $('#reason-1').html('');
                }

                if (data.status == 0) {
                    $('#show-ap-3').attr('class', 'label label-info');
                    $('#show-ap-3').html('รออนุมัติ');
                } else if (data.status == 1) {
                    $('#show-ap-3').attr('class', 'label label-success');
                    $('#show-ap-3').html('อนุมัติ');
                } else if (data.status == 2) {
                    $('#show-ap-3').attr('class', 'label label-danger');
                    $('#show-ap-3').html('ไม่อนุมัติ');
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
            $('#note_more_approve').hide()
            $('#reason').attr('required', false)
            $('#show-status').val(result)
            $(this).addClass('btn-success')
        } else if (result == 2) {
            $('#note_area').val('')
            $('#reason').val('')
            $('#note_approve').show()
            $('#note_more_approve').show()
            $('#show-status').val(result)
            $('#reason').attr('required', true)
            $(this).addClass('btn-danger')
        } else if (result == 3) {
            $('#note_area').val('')
            $('#reason').val('')
            $('#note_approve').show()
            $('#note_more_approve').show()
            $('#show-status').val(result)
            $('#reason').attr('required', true)
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
        $('#note_more_approve').hide()
    });

    $("#approve_form").submit(function(e) {
        e.preventDefault();
        approve();
    });

    function approve() {
        var data = $('#approve_form').serializeArray();
        data.push({ name: 'mode', value: 'approve_reservation' });
        $.ajax({
            type: "POST",
            url: "reservation/controller.php",
            data: data,
            dataType: 'json',
            success: function(data) {
                if (data.result == 1) //สำเร็จ
                {
                    swal({
                            title: "อนุมัติเสร็จสิ้น",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false,
                        },
                        function() { window.location.assign('reserve_approve.php'); }
                    );
                } else if (data.result == 0) //ไม่สำเร็จ
                {
                    swal({
                            title: "ไม่สามารถอนุมัติได้",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "error",
                            timer: 2000,
                            html: true,
                            showConfirmButton: false,
                        },
                        function() { window.location.assign('reserve_approve.php'); }
                    );
                } else if (data.result === 'error') {
                    swal({
                            title: "ไม่สามารถอนุมัติได้<br>กรุณาทำรายการใหม",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "error",
                            timer: 2000,
                            showConfirmButton: false,
                            html: true,
                        },
                        function() { window.location.assign('reserve_approve.php'); }
                    );
                }
            }
        });
    }
});