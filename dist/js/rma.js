$(document).ready(function() {

    // ---------------คลิกดูรายละเอียดในตาราง-------------
    //ตารางจัดการ
    $('.handleRMADetail').click(function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "reservation/controller.php",
            data: { id: id, mode: 'getTableDetail' },
            success: function(data) {
                $('#body_modal_detail').html(data);
            }
        });
    });

    // ถ้ากดเลือกวันจองวันแรก
    $('#dp-fistdate').click(function() {
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);

        $(this).attr('min', today);
    });

    // รีเซ็ตหากเลือกวันที่ไม่ถูกต้อง
    $('#dp-fistdate').on("change", function() {
        var date_start = $(this);
        var date_end = $("#dp-lastdate");
        if ($('#dp-lastdate').val() != '') {
            date_end.attr('min', );
            date_end.val(date_start.val());
            $('#dp-tout').attr('min', date_start.val());
            $('#dp-tin').attr('min', date_start.val());
        }
    });
    // ถ้ากดเลือกวันจองวันสุดท้าย
    $('#dp-lastdate').click(function() {
        var date_start = $("#dp-fistdate").val();
        var date_end = $(this);

        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);

        if (date_start != '') {
            date_end.attr('min', date_start);
        } else {
            date_end.attr('min', today);
        }
    });
    $('#dp-lastdate').on("change", function() {
        $('#dp-tout').attr('max', $(this).val());
        $('#dp-tin').attr('max', $(this).val());
    });

    $('#dp-tout').on("change", function() {
        $('#dp-tin').attr('min', $(this).val());
    });

    $('#dp-tout').attr('min', $('#dp-fistdate').val());
    $('#dp-tout').attr('max', $('#dp-lastdate').val());
    $('#dp-tin').attr('min', $('#dp-fistdate').val());
    $('#dp-tin').attr('max', $('#dp-lastdate').val());

    // ถ้าเลือกเวลาสิ้นสุดแต่ยังไม่เลือกเวลาเริ่มต้น
    $('#dp-timeend').click(function() {
        if ($('#dp-timestart').val() == '') {
            var start = $('#dp-timestart');
            var end = $('#dp-timeend');
            if (start.val() == '') {
                end.prop('defaultValue', '');
                start.focus();
            }
        } else {
            var start = $('#dp-timestart').val();
            var end = $('#dp-timeend');

            end.prop('defaultValue', start.substring(0, 2) + ":00");
            end.attr('min', start.substring(0, 2) + ":00");
            end.attr('max', "23:59");
        }
    });

    $('.handleRMADelete').click(function() {

        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "reservation/controller.php",
            data: { id: id, mode: 'getDelete' },
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                $('#show-delete-label').html(data.detail);
                $('#show-delete-id').val(data.id);
            }
        });

    });
    $('input[name=kilometer_total]').change(function() {
        var val = $(this).val();
        if (val > 0) {
            $('input[name=reservation_status]').each(function() {
                if ($(this).val() == 1) {
                    $(this).click();
                }
            });
            $('input[name=usage_status]').each(function() {
                if ($(this).val() == 2) {
                    $(this).click();
                }
            });
        }
    });

    $('input[name=kilometer_out]').change(function() {
        $('input[name=kilometer_in]').prop('min', $(this).val());
        $('input[name=kilometer_in]').val($(this).val());
    });

    $('input[name=kilometer_in]').click(function() {
        var kout = $('input[name=kilometer_out]');
        if (kout.val() == '') {
            kout.focus();
        }
    });

    $('input[name=kilometer_in]').change(function() {

        var kout = $('input[name=kilometer_out]').val();
        var kin = $('input[name=kilometer_in]').val();
        $('input[name=kilometer_total]').val(kin - kout);

    });

    $('input[name=reservation_status]').each(function() {
        var res = $('#hstatus').attr('data-rstatus');
        var ues = $('#hstatus').attr('data-ustatus');
        if ($(this).val() == res) {
            $(this).click();

            if (res == 0) {
                $('input[name=usage_status]').each(function() {
                    if ($(this).val() == res) {
                        $(this).attr('disabled', false)
                        $(this).click();
                    } else {
                        $(this).attr('disabled', true)
                    }
                });
                //$('#edit_reason_area').val('');
                $('#edit_reason_area').attr('required', false);
                $('#edit_reason').hide();
                //$('#edit_note_area').val('');

                $('#edit_note').hide();
            } else if (res == 1) {
                $('input[name=usage_status]').each(function() {
                    if ($(this).val() == 1 || $(this).val() == 2 || $(this).val() == 3) {
                        $(this).attr('disabled', false)
                        if ($(this).val() == ues) {
                            $(this).click();
                            //$('#edit_reason_area').val('');
                            $('#edit_reason_area').attr('required', false);
                            $('#edit_reason').hide();
                            //$('#edit_note_area').val('');
            
                            $('#edit_note').hide();
                            if (ues == 3) {
                                $('#edit_reason').show();
                                $('#edit_reason_area').attr('required', true);
                                $('#edit_note').show();

                            }
                        }
                    } else {
                        $(this).attr('disabled', true)
                    }
                });
            } else if (res == 2 || res == 3) {
                $('input[name=usage_status]').each(function() {
                    if ($(this).val() == 3) {
                        $(this).attr('disabled', false)
                        $(this).click();
                    } else {
                        $(this).attr('disabled', true)
                    }
                });
                $('#edit_reason').show();
                $('#edit_reason_area').attr('required', true);
                
                $('#edit_note').show();
            }
        }
    });


    $('input[name=reservation_status]').on("change", function() {
        var res = $(this).val();
        if (res == 0) {
            if ($('input[name=kilometer_out]').val() != 0 || $('input[name=kilometer_in]').val() != 0 || $('#dp-tout').val() !== '' || $('#dp-kout').val() !== '' || $('#dp-tin').val() !== '' ||
                $('#dp-kin').val() !== '') {
                swal({
                        title: "<h3>หากเปลี่ยนสถานะเป็นรอยืนยัน<br>ข้อมูลการบันทึกต่างๆจะถูกรีเซ็ต</h3>",
                        type: "warning",
                        html: true,
                        showCancelButton: true,
                        cancelButtonText: "ยกเลิก",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "ตกลง",
                        timer: 2000
                    },
                    function(Respone) {
                        if (Respone) {
                            $('input[name=usage_status]').each(function() {
                                if ($(this).val() == res) {
                                    $(this).attr('disabled', false)
                                    $(this).click();
                                } else {
                                    $(this).attr('disabled', true)
                                }
                            });
                            //$('#edit_reason_area').val('');
                            $('#edit_reason_area').attr('required', false);
                            $('#edit_reason').hide();
                            //$('#edit_note_area').val('');
            
                            $('#edit_note').hide();

                            $('#dp-tout').val('');
                            $('#dp-kout').val('');
                            $('#dp-tin').val('');
                            $('#dp-kin').val('');
                            $('input[name=kilometer_out]').val(0);
                            $('input[name=kilometer_in]').val(0);
                            $('input[name=kilometer_total]').val(0);
                        } else {
                            $('input[name=reservation_status]').each(function() {
                                if ($(this).val() == $('#hstatus').attr('data-rstatus')) {
                                    $(this).click();
                                }
                            });
                            $('input[name=usage_status]').each(function() {
                                if ($(this).val() == $('#hstatus').attr('data-ustatus')) {
                                    $(this).click();
                                }
                            });
                        }
                    });

            } else {
                $('input[name=usage_status]').each(function() {
                    if ($(this).val() == res) {
                        $(this).attr('disabled', false)
                        $(this).click();
                    } else {
                        $(this).attr('disabled', true)
                    }
                });
            }

        } else if (res == 1) {
            $('input[name=usage_status]').each(function() {
                if ($(this).val() == 1 || $(this).val() == 2 || $(this).val() == 3) {
                    $(this).attr('disabled', false)
                    if ($(this).val() == 1) {
                        $(this).click();
                    }
                } else {
                    $(this).attr('disabled', true)
                }
            });
            //$('#edit_reason_area').val('');
            $('#edit_reason_area').attr('required', false);
            $('#edit_reason').hide();
            //$('#edit_note_area').val('');
            $('#edit_note_area').attr('required', false);
            $('#edit_note').hide();
        } else if (res == 2 || res == 3) {
            $('input[name=usage_status]').each(function() {
                if ($(this).val() == 3) {
                    $(this).attr('disabled', false)
                    $(this).click();
                } else {
                    $(this).attr('disabled', true)
                }
            });
            $('#edit_reason').show();
            $('#edit_reason_area').attr('required', true);
            
            $('#edit_note').show();
        }
    });

    $('input[name=usage_status]').on("change", function() {
        if ($(this).val() == 3) {
            $('#edit_reason').show();
            $('#edit_reason_area').attr('required', true);
            
            $('#edit_note').show();
        } else {
            //$('#edit_reason_area').val('');
            $('#edit_reason_area').attr('required', false);
            $('#edit_reason').hide();
            //$('#edit_note_area').val('');
            $('#edit_note_area').attr('required', false);
            $('#edit_note').hide();
        }
    });
    // passenger
    $('.handleAddSelectPassenger').click(function() {
        var person_id = $(this).attr('data-id');
        var reserve_id = $(this).attr('data-reservekeys');
        $.ajax({
            type: "POST",
            url: "reservation/controller.php",
            data: { person_id: person_id, reserve_id: reserve_id, mode: 'insertSelectPassenger' },
            dataType: 'json',
            success: function(data) {
                if (data.result == 1) //insert สำเร็จ
                {
                    swal('เพิ่มข้อมูลสำเร็จ');
                    window.location.assign('edit_passenger.php?id=' + reserve_id);
                } else if (data.result == 0) //insert ไม่สำเร็จ
                {
                    swal('ไม่สามารถเพิ่มข้อมูลได้ กรุณาทำรายการใหม่');
                    window.location.assign('edit_passenger.php?id=' + reserve_id);
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
            data: { id: id, mode: 'get_passenger' },
            dataType: 'json',
            success: function(data) {
                $('#delete_id').val(data.id);
                $('#reserve_id').val(data.reserve_id);
                $('#show_delete').text('\n\" ' + data.title + data.name + ' \"');
                if (data.department !== null) {
                    $('#show_delete2').text('\n(' + data.department + ')');
                }
            }
        });
    });

    $('.handleEditPassenger').click(function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "reservation/controller.php",
            data: { id: id, mode: 'get_passenger' },
            dataType: 'json',
            success: function(data) {
                $('.handleEditSelectPassenger').attr('data-old', id);
                $('#edit-data-old').val(id);
                $('#edit_title_name').val(data.title);
                $('#edit_person_name').val(data.name);
                if (data.department !== null) {
                    $('#edit_department').val(data.department)
                } else {
                    $('#edit_department').val('ไม่ระบุ')
                }

            }
        });
    });

    $('.handleEditSelectPassenger').click(function() {
        var old = $(this).attr('data-old');
        var person_id = $(this).attr('data-id');
        var reserve_id = $(this).attr('data-reservekeys');
        $.ajax({
            type: "POST",
            url: "reservation/controller.php",
            data: { old: old, person_id: person_id, reserve_id: reserve_id, mode: 'editSelectPassenger' },
            dataType: 'json',
            success: function(data) {
                if (data.result == 1) //edit สำเร็จ
                {
                    swal('แก้ไขข้อมูลสำเร็จ');
                    window.location.assign('edit_passenger.php?id=' + reserve_id);
                } else if (data.result == 0) //edit ไม่สำเร็จ
                {
                    swal('ไม่สามารถแก้ไขข้อมูลได้ กรุณาทำรายการใหม่');
                    window.location.assign('edit_passenger.php?id=' + reserve_id);
                }
            }
        });
    });



    $('#linkEditCars').click(function() {
        $.ajax({
            type: "POST",
            url: "reservation/controller.php",
            data: {
                date_start: $('#dp-fistdate').val(),
                date_end: $('#dp-lastdate').val(),
                time_start: $('#dp-timestart').val(),
                time_end: $('#dp-timeend').val(),
                car_id: $(this).attr('data-cars'),
                reserve_id: $(this).attr('data-reservekeys'),
                mode: 'getCars_For_Edit'
            },
            success: function(data) {
                $('#tbody_cars_edit').html(data);
                $('.handleChangeCars').click(function() {
                    var res_id = $(this).attr('data-id');
                    var car_id = $(this).attr('data-carid');
                    $.ajax({
                        type: "POST",
                        url: "reservation/controller.php",
                        data: { id: res_id, carid: car_id, mode: 'editCarInRMA' },
                        dataType: 'json',
                        success: function(data) {
                            if (data.result == 1) //สำเร็จ
                            {
                                swal({
                                        title: "เปลี่ยนรถยนต์สำเร็จ",
                                        text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                                        type: "success",
                                        timer: 1000,
                                        showConfirmButton: false,
                                    },
                                    function() { window.location.assign('reserve_ma_edit.php?id=' + res_id); }
                                );
                            } else if (data.result == 0) //ไม่สำเร็จ
                            {
                                swal({
                                        title: "ไม่สามารถเปลี่ยนรถยนต์ได้<br>กรุณาทำรายการใหม่",
                                        text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                                        type: "error",
                                        timer: 2000,
                                        html: true,
                                        showConfirmButton: false,
                                    },
                                    function() { window.location.assign('reserve_ma_edit.php?id=' + res_id); }
                                );
                            } else if (data.result === 'error') {
                                swal({
                                        title: "ไม่สามารถเปลี่ยนรถยนต์ได้<br>กรุณาทำรายการใหม่",
                                        text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                                        type: "error",
                                        timer: 2000,
                                        showConfirmButton: false,
                                        html: true,
                                    },
                                    function() { window.location.assign('reserve_ma_edit.php?id=' + res_id); }
                                );
                            }
                        },
                        error: function(data) { console.log(data) }
                    });
                });
            }
        });
    });
    //-------------------------------------------------------

    $("#RMA_delete_form").submit(function(e) {
        e.preventDefault();
        deleteReservation();
    });

    function deleteReservation() {
        var data = $('#RMA_delete_form').serializeArray();
        data.push({ name: 'mode', value: 'deleteReservation' });
        $.ajax({
            type: "POST",
            url: "reservation/controller.php",
            data: data,
            dataType: 'json',
            success: function(data) {
                if (data.result == 1) //สำเร็จ
                {
                    swal({
                            title: "ลบข้อมูลสำเร็จ",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false,
                        },
                        function() { window.location.assign('reserve_ma.php'); }
                    );
                } else if (data.result == 0) //ไม่สำเร็จ
                {
                    swal({
                            title: "ไม่สามารถลบข้อมูลได้<br>กรุณาทำรายการใหม่",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "error",
                            timer: 2000,
                            showConfirmButton: false,
                            html: true,
                        },
                        function() { window.location.assign('reserve_ma.php'); }
                    );
                } else if (data.result === 'error') {
                    swal({
                            title: "ไม่สามารถลบข้อมูลได้<br>เนื่องจากมีการใช้งานอยู่",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "error",
                            timer: 2000,
                            showConfirmButton: false,
                            html: true,
                        },
                        function() { window.location.assign('reserve_ma.php'); }
                    );
                }
            }
        });
    }

    $("#RMA_edit_form").submit(function(e) {
        e.preventDefault();
        editReservation();
    });

    function editReservation() {
        var data = $('#RMA_edit_form').serializeArray();
        data.push({ name: 'mode', value: 'editReservation' });
        $.ajax({
            type: "POST",
            url: "reservation/controller.php",
            data: data,
            dataType: 'json',
            success: function(data) {
                if (data.result == 1) //สำเร็จ
                {
                    swal({
                        title: "แก้ไขข้อมูลสำเร็จ",
                        text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                } else if (data.result === 'error') {
                    swal({
                        title: "ไม่สามารถแก้ไขข้อมูลได้<br>กรุณาทำรายการใหม่",
                        text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                        type: "error",
                        timer: 2000,
                        showConfirmButton: false,
                        html: true,
                    });
                }
            },
            error: function(data) { console.log(data) }
        });
    }

    $('#delete_other_approve').click(function(){
        var id = $(this).attr('data-id');
        swal({
            title: "<h3><b>ต้องการลบข้อมูลการอนุมัติหรือไม่</b></h3>",
            type: "warning",
            showCancelButton: true,
            html: true,
            cancelButtonText: "ยกเลิก",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "ลบข้อมูล",
            closeOnConfirm: false
          },
          function(){
            $.ajax({
                type: "POST",
                url: "reservation/controller.php",
                data: {id:  id, mode: 'deleteOtherApprove'},
                dataType: 'json',
                success: function(data){
                  if (data.result == 1) //สำเร็จ
                  {
                    swal({
                          title: "ลบสำเร็จ",
                           type: "success",
                           timer: 2000,
                          confirmButtonText: "ตกลง",
                          showConfirmButton: false,
                        },
                        function()
                        {
                            window.location.assign('reserve_ma_edit.php?id=' + id);
                        }
                      );
                  }
                  else if (data.result == 0) //ไม่สำเร็จ
                  {
                    swal({
                          title: "ไม่สามารถลบข้อมูลได้<br>กรุณาทำรายการใหม่",
                           type: "error",
                           timer: 2000,
                           confirmButtonText: "ตกลง",
                           showConfirmButton: false,
                          html: true,
                        });
                  }
                }
              });
          });
    });

    // ปุ่มเพิ่มสถานที่
    var max_fields = 10; //maximum input boxes allowed
    var x = 1; //initlal text box count
    $('#addfield_location').click(function(e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            var str = '<div class="form-group">';
            str += '<label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label"></label>';
            str += '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-9">';
            str += '<input type="text" class="form-control" name="location[]" placeholder="พิมพ์ชื่อสถานที่ต้องการไป (เพิ่มเติม)">';
            str += '</div><div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"><a href="#" class="btn btn-danger remove_field">ลบ</a></div></div></div>';
            $('.location_field').append(str);
        }
    });

    $('.location_field').on("click", ".remove_field", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').parent('div').remove();
        x--;
    });

    
});