$(document).ready(function() {
    $('#status_note').hide();
    $('#display-note-area').hide();
    $('#display-status').change(function() {
        var s = $(this).val();
        if (s == 'งดจอง') {
            $('#display-note').prop('required', true);
            $('#display-note-area').show();
        } else {
            $('#display-note').prop('required', false);
            $('#display-note-area').hide();
        }
    });
    //  เมื่อกดปุ่มดูลายระเอียด จะส่งค่าไปที่ box
    $('.handleCarDetail').click(function() {
        var id = $(this).attr('data-id');

        $.ajax({
            type: "POST",
            url: "cars/controller.php",
            data: { id: id, mode: 'getDetail' },
            dataType: 'json',
            success: function(data) {
                $('#show-reg').html(data.reg);
                $('#show-provine').html(data.provine);
                $('#show-brand').html(data.brand);
                $('#show-kind').html(data.kind);
                if (data.detail == "") {
                    $('#show-detail').html(" - ");
                } else {
                    $('#show-detail').html(data.detail);
                }
                $('#show-seat').html(data.seat);
                $('#show-driver').html(data.driver);
                $('#show-department').html(data.department);
                $('#show-status').html(data.status);
                if (data.status == 'จองได้') {
                    $('#status_note').hide();
                } else {
                    $('#status_note').show();
                    $('#show-note').html(data.note);
                }

                var str_pic = '<div class="table-responsive"><table><tr><td class="child">';
                if (data.pic1 != 0) { str_pic += '<td><section class="contain"><img src="viewimg.php?mode=car&imgindex=1&id=' + id + '"></section></td>'; }
                if (data.pic2 != 0) { str_pic += '<td><section class="contain"><img src="viewimg.php?mode=car&imgindex=2&id=' + id + '"></section></td>'; }
                if (data.pic3 != 0) { str_pic += '<td><section class="contain"><img src="viewimg.php?mode=car&imgindex=3&id=' + id + '"></section></td>'; }
                if (data.pic4 != 0) { str_pic += '<td><section class="contain"><img src="viewimg.php?mode=car&imgindex=4&id=' + id + '"></section></td>'; }
                str_pic += '</td></tr><table></div>';
                $('#show-picture').html(str_pic);
            }
        });

    });

    //  เมื่อกดปุ่มแก้ไข จะส่งค่าไปที่ box
    $('.handleCarEdit').click(function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "cars/controller.php",
            data: { id: id, mode: 'getEdit' },
            dataType: 'json',
            success: function(data) {
                $('#display-reg').val(data.reg);
                $('#display-province').val(data.province);
                $('#display-brand').val(data.brand);
                $('#display-kind').val(data.kind);
                $('#display-detail').val(data.detail);
                $('#display-seat').val(data.seat);
                $('#display-driver').val(data.driver);
                $('#display-department').val(data.department);
                $('#display-status').val(data.status);
                if (data.status == 'จองได้') {
                    $('#display-note-area').hide();
                } else {
                    $('#display-note-area').show();
                    $('#display-note').val(data.note);
                }
                $('#display-id').val(data.id);

                var str_pic = '';
                //--------------------- Pic 1 --------------------
                if (data.pic1 != 0) {
                    str_pic = '<section class="contain"><img src="viewimg.php?mode=car&imgindex=1&id=' + id + '"></section>';
                    str_pic += '<br>';                    
                    $('#show-picture_edit_1').html(str_pic);
                    str_pic = '<button class="btn btn-sm btn-primary" type="button">แก้ไข</button> ';
                    str_pic += '<button class="btn btn-sm btn-danger" type="button" data-id='+id+'>ลบ</button>';
                    str_pic += '<input type="file" class="form-control hidden" name="filUpload0">';
                    $('#show-button_edit_1').html(str_pic);
                } else {
                    str_pic = '<input type="file" class="form-control" name="filUpload0">';
                    $('#show-picture_edit_1').html('');
                    $('#show-button_edit_1').html(str_pic);
                }
                //--------------------- Pic 2 --------------------
                if (data.pic2 != 0) {
                    str_pic = '<section class="contain"><img src="viewimg.php?mode=car&imgindex=2&id=' + id + '"></section>';
                    str_pic += '<br>';
                    $('#show-picture_edit_2').html(str_pic);
                    str_pic = '<button class="btn btn-sm btn-primary" type="button">แก้ไข</button> ';
                    str_pic += '<button class="btn btn-sm btn-danger" type="button" data-id='+id+'>ลบ</button>';
                    str_pic += '<input type="file" class="form-control hidden" name="filUpload1">';
                    $('#show-button_edit_2').html(str_pic);
                } else {
                    str_pic = '<input type="file" class="form-control" name="filUpload1">';
                    $('#show-picture_edit_2').html('');
                    $('#show-button_edit_2').html(str_pic);
                }
                //--------------------- Pic 3 --------------------
                if (data.pic3 != 0) {
                    str_pic = '<section class="contain"><img src="viewimg.php?mode=car&imgindex=3&id=' + id + '"></section>';
                    str_pic += '<br>';
                    $('#show-picture_edit_3').html(str_pic);
                    str_pic = '<button class="btn btn-sm btn-primary" type="button">แก้ไข</button> ';
                    str_pic += '<button class="btn btn-sm btn-danger" type="button" data-id='+id+'>ลบ</button>';
                    str_pic += '<input type="file" class="form-control hidden" name="filUpload2">';
                    $('#show-button_edit_3').html(str_pic);
                } else {
                    str_pic = '<input type="file" class="form-control" name="filUpload2">';
                    $('#show-picture_edit_3').html('');
                    $('#show-button_edit_3').html(str_pic);
                }
                //--------------------- Pic 4 --------------------
                if (data.pic4 != 0) {
                    str_pic = '<section class="contain"><img src="viewimg.php?mode=car&imgindex=4&id=' + id + '"></section>';
                    str_pic += '<br>';
                    $('#show-picture_edit_4').html(str_pic);
                    str_pic = '<button class="btn btn-sm btn-primary" type="button">แก้ไข</button> ';
                    str_pic += '<button class="btn btn-sm btn-danger" type="button" data-id='+id+'>ลบ</button>';
                    str_pic += '<input type="file" class="form-control hidden" name="filUpload3">';
                    $('#show-button_edit_4').html(str_pic);
                } else {
                    str_pic = '<input type="file" class="form-control" name="filUpload3">';
                    $('#show-picture_edit_4').html('');
                    $('#show-button_edit_4').html(str_pic);
                }

            }
        });

    });


    $('.handleCarDelete').click(function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "cars/controller.php",
            data: { id: id, mode: 'getDelete' },
            dataType: 'json',
            success: function(data) {
                $('#show-delete-label').html('\" รถยนต์ทะเบียน ' + data.reg + ' \"');
                $('#show-delete-id').val(data.id);
            }
        });

    });
    // ---------------------------------------------
    $("#insert_cars_form").submit(function(e) {
        e.preventDefault();
        insertCars();
    });

    $("#edit_cars_form").submit(function(e) {
        e.preventDefault();
        editCars();
    });

    $("#delete_cars_form").submit(function(e) {
        e.preventDefault();
        deleteCars();
    });
    // ------------ Function ---------------------------
    function insertCars() {
        // var data = $('#admininsert_form').serializeArray();
        var form = $('#insert_cars_form')[0];
        var formData = new FormData(form);
        // Attach file
        formData.append('mode', 'insertCars');
        // data.push({name : 'mode' , value : 'insertdata'});
        $.ajax({
            type: "POST",
            url: "cars/controller.php",
            data: formData,
            dataType: 'json',
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
            success: function(data) {
                if (data.result == 1) //สำเร็จ
                {
                    swal({
                            title: "เพิ่มข้อมูลสำเร็จ",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false,
                        },
                        function() { window.location.assign('cars.php'); }
                    );
                } else if (data.result == 0) //ไม่สำเร็จ
                {
                    swal({
                            title: "ไม่สามารถเพิ่มข้อมูลได้<br>กรุณาทำรายการใหม่",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "error",
                            timer: 2000,
                            html: true,
                            showConfirmButton: false,
                        },
                        function() { window.location.assign('cars.php'); }
                    );
                } else if (data.result === 'error') {
                    swal({
                            title: "ข้อมูลนี้มีอยู่แล้ว<br>กรุณาทำรายการใหม่",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "error",
                            timer: 2000,
                            html: true,
                            showConfirmButton: false,
                        },
                        function() { window.location.assign('cars.php'); }
                    );
                }
            },
            error: function(data) { console.log(data) }
        });
    }

    function editCars() {
        // var data = $('#admininsert_form').serializeArray();
        var form = $('#edit_cars_form')[0];
        var formData = new FormData(form);
        // Attach file
        formData.append('mode', 'editCars');
        // data.push({name : 'mode' , value : 'insertdata'});
        $.ajax({
            type: "POST",
            url: "cars/controller.php",
            data: formData,
            dataType: 'json',
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
            success: function(data) {
                if (data.result == 1) //สำเร็จ
                {
                    swal({
                            title: "แก้ไขข้อมูลสำเร็จ",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false,
                        },
                        function() { window.location.assign('cars.php'); }
                    );
                } else if (data.result == 0) //ไม่สำเร็จ
                {
                    swal({
                            title: "ไม่สามารถแก้ไขข้อมูลได้<br>กรุณาทำรายการใหม่",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "error",
                            timer: 2000,
                            html: true,
                            showConfirmButton: false,
                        },
                        function() { window.location.assign('cars.php'); }
                    );
                } else if (data.result === 'error') {
                    swal({
                            title: "ข้อมูลไม่ถูกต้อง<br>กรุณาทำรายการใหม่",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "error",
                            timer: 2000,
                            html: true,
                            showConfirmButton: false,
                        },
                        function() { window.location.assign('cars.php'); }
                    );
                }
            },
            error: function(data) { console.log(data) }
        });
    }

    function deleteCars() {
        var data = $('#delete_cars_form').serializeArray();
        data.push({ name: 'mode', value: 'deleteCars' });
        $.ajax({
            type: "POST",
            url: "cars/controller.php",
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
                        function() { window.location.assign('cars.php'); }
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
                        function() { window.location.assign('cars.php'); }
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
                        function() { window.location.assign('cars.php'); }
                    );
                }
            }
        });
    }
});