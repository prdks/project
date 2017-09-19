$(document).ready(function() {
    // getDetail
    if ($('.send_id_for_detail').val() !== '') {
        var id = $('.send_id_for_detail').val();
        $.ajax({
            type: "POST",
            url: "reservation/controller.php",
            data: { id: id, mode: 'getTableDetail_Minimal' },
            success: function(data) {
                $('.show-detail-enterkl').html(data);
            }
        });
    }

    //  ENTER OUT
    $("#enterkl_out_form").submit(function(e) {
        e.preventDefault();
        enter_kilomater_out();
    });

    function enter_kilomater_out() {
        var car = $('input[name=car_reg').val()

        swal({
                title: "<h4>ยืนยันการเพิ่มเลขกิโลเมตร<br>ของรถยนต์ทะเบียน <b>" + car + "</b></h4>",
                type: "warning",
                showCancelButton: true,
                html: true,
                cancelButtonText: "ยกเลิก",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "ยืนยัน",
                closeOnConfirm: false
            },
            function() {
                var data = $('#enterkl_out_form').serializeArray();
                data.push({ name: 'mode', value: 'enter_kilomater' });
                $.ajax({
                    type: "POST",
                    url: "reservation/controller.php",
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        if (data.result == 1) //สำเร็จ
                        {
                            swal({
                                    title: "เพิ่มจำนวนเลขกิโลเมตรสำเร็จ",
                                    text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                                    type: "success",
                                    timer: 2000,
                                    showConfirmButton: false,
                                },
                                function() { window.location.assign('index.php'); }
                            );
                        } else if (data.result == 0) //ไม่สำเร็จ
                        {
                            swal({
                                title: "ไม่สามารถจำนวนเลขกิโลเมตรได้<br>กรุณาทำรายการใหม่",
                                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                                type: "error",
                                timer: 2000,
                                html: true,
                                showConfirmButton: false,
                            });
                        }
                    }
                });
            });
    }

    // ENTER IN
    $("#enterkl_in_form").submit(function(e) {
        e.preventDefault();
        enter_kilomater_in();
    });

    function enter_kilomater_in() {
        var car = $('input[name=car_reg').val()

        swal({
                title: "<h4>ยืนยันการเพิ่มเลขกิโลเมตร<br>ของรถยนต์ทะเบียน <b>" + car + "</b></h4>",
                type: "warning",
                showCancelButton: true,
                html: true,
                cancelButtonText: "ยกเลิก",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "ยืนยัน",
                closeOnConfirm: false
            },
            function() {
                var data = $('#enterkl_in_form').serializeArray();
                data.push({ name: 'mode', value: 'enter_kilomater' });
                $.ajax({
                    type: "POST",
                    url: "reservation/controller.php",
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        if (data.result == 1) //สำเร็จ
                        {
                            swal({
                                    title: "เพิ่มจำนวนเลขกิโลเมตรสำเร็จ",
                                    text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                                    type: "success",
                                    timer: 2000,
                                    showConfirmButton: false,
                                },
                                function() { window.location.assign('index.php'); }
                            );
                        } else if (data.result == 0) //ไม่สำเร็จ
                        {
                            swal({
                                title: "ไม่สามารถจำนวนเลขกิโลเมตรได้<br>กรุณาทำรายการใหม่",
                                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                                type: "error",
                                timer: 2000,
                                html: true,
                                showConfirmButton: false,
                            });
                        }
                    }
                });
            });
    }
});