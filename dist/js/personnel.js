$(document).ready(function() {
    // ----------------------- personnel ----------------------------
    //  เมื่อกดปุ่มดูลายระเอียด จะส่งค่าไปที่ box
    $('.handlePersonDetail').click(function() {
        var id = $(this).attr('data-id');

        $.ajax({
            type: "POST",
            url: "personnel/controller.php",
            data: { id: id, mode: 'getDetail' },
            dataType: 'json',
            success: function(data) {
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
            data: { id: id, mode: 'getEdit' },
            dataType: 'json',
            success: function(data) {
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
        $("input[name='checked_id[]']:checked").each(function() {
            checked.push(parseInt($(this).val()));
        });
        $.post("personnel/controller.php", { checked_id: checked, mode: 'getDelete' },
            function(data) {
                $('#respone').html(data);
            }
        );

    });

    // ******* Permission ************
    $('.handlePermission').click(function() {
        var id = $(this).attr('data-id');

        $.ajax({
            type: "POST",
            url: "personnel/controller.php",
            data: { id: id, mode: 'getDetail' },
            dataType: 'json',
            success: function(data) {
                $('#show-name').html(data.name);
                $('#show-email').html(data.email);
                $('#show-phone').html(data.phone);
                $('#show-department').html(data.department);
                $('#show-position').html(data.position);
                $('#show-usertype').val(data.level);
                $('#show-id').val(id);
                $('#name_person').val(data.name)
            }
        });

    });

    // คลิกเลือกทั้งหมด
    $('#select_all').on('click', function() {
        if (this.checked) {
            $('.checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $('.checkbox').each(function() {
                this.checked = false;
            });
        }
    });

    // ถ้าเช็คเลือกทั้งหมด แต่เอาออกอันหนึ่ง ช่องเลือกทั้งหมดจะไม่ถูกเช็ค
    $('.checkbox').on('click', function() {
        if ($('.checkbox:checked').length == $('.checkbox').length) {
            $('#select_all').prop('checked', true);
        } else {
            $('#select_all').prop('checked', false);
        }
    });


    $("#insert_personnel_form").submit(function(e) {
        e.preventDefault();
        InsertPersonnel();
    });

    $("#edit_personnel_form").submit(function(e) {
        e.preventDefault();
        editPersonnel();
    });

    $("#delete_personnel_form").submit(function(e) {
        e.preventDefault();
        deletePersonnel();
    });

    $("#set_permission_form").submit(function(e) {
        e.preventDefault();
        setPermission();
    });

    // --------------- Function --------------------
    function InsertPersonnel() {
        var data = $('#insert_personnel_form').serializeArray();
        data.push({ name: 'mode', value: 'InsertPersonnel' });
        $.ajax({
            type: "POST",
            url: "personnel/controller.php",
            data: data,
            dataType: 'json',
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
                        function() { window.location.assign('personnel.php'); }
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
                        function() { window.location.assign('personnel.php'); }
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
                        function() { window.location.assign('personnel.php'); }
                    );
                }
            }
        });
    }

    function editPersonnel() {
        var data = $('#edit_personnel_form').serializeArray();
        data.push({ name: 'mode', value: 'editPersonnel' });
        $.ajax({
            type: "POST",
            url: "personnel/controller.php",
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
                        },
                        function() { window.location.assign('personnel.php'); }
                    );
                } else if (data.result == 0) //ไม่สำเร็จ
                {
                    swal({
                            title: "ไม่สามารถแก้ไขข้อมูลได้<br>เนื่องจากข้อมูลซ้ำ",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "error",
                            timer: 2000,
                            html: true,
                            showConfirmButton: false,
                        },
                        function() { window.location.assign('personnel.php'); }
                    );
                } else if (data.result === 'error') {
                    swal({
                            title: "ไม่สามารถแก้ไขข้อมูลได้<br>กรุณาทำรายการใหม่",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "error",
                            timer: 2000,
                            showConfirmButton: false,
                            html: true,
                        },
                        function() { window.location.assign('personnel.php'); }
                    );
                }
            }
        });
    }

    function deletePersonnel() {
        var checked = []
        $("input[name='checked_id[]']:checked").each(function() {
            checked.push(parseInt($(this).val()));
        });

        $.ajax({
            type: "POST",
            url: "personnel/controller.php",
            data: { checked_id: checked, mode: 'deletePersonnel' },
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
                        function() { window.location.assign('personnel.php'); }
                    );
                }
            }
        });
    }


    function setPermission() {
        var data = $('#set_permission_form').serializeArray();
        data.push({ name: 'mode', value: 'setPermission' });
        $.ajax({
            type: "POST",
            url: "personnel/controller.php",
            data: data,
            dataType: 'json',
            success: function(data) {
                if (data.result == 1) //สำเร็จ
                {
                    if (data.person != 0) 
                    {
                        swal({
                            title: "<h3>การกำหนดสิทธิ์ให้ตัวเอง<br>จำเป็นจะต้องออกจากระบบ ตกลงหรือไม่</h3>",
                            type: "warning",
                            showCancelButton: true,
                            html: true,
                            cancelButtonText: "ยกเลิก",
                            confirmButtonColor: "#428bca",
                            confirmButtonText: "ตกลง",
                            closeOnConfirm: false
                        },
                        function() {
                            swal({
                                title: "แก้ไขข้อมูลสำเร็จ",
                                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            },
                                function() {window.location.assign('_logout.php');}
                            );
                             
                        });
                        
                    } 
                   else 
                   { 
                       swal({
                           title: "แก้ไขข้อมูลสำเร็จ",
                           text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                           type: "success",
                           timer: 2000,
                           showConfirmButton: false,
                       },
                           function() {location.reload();}
                       );
                   }
                    
                    
                } else if (data.result == 0) //ไม่สำเร็จ
                {
                    swal({
                            title: "ไม่สามารถแก้ไขข้อมูลได้ กรุณาทำรายการใหม่",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "error",
                            timer: 2000,
                            html: true,
                            showConfirmButton: false,
                        },
                        function() {
                            location.reload();
                        }
                    );
                } else if (data.result === 'error') {
                    if (data.type == 5) {
                        swal({
                                title: "ไม่สามารถเปลี่ยนได้เนื่องจากจำนวนเกินที่กำหนด",
                                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false,
                                html: true,
                            },
                            function() {
                                location.reload();
                            }
                        );
                    } else {
                        swal({
                                title: "ข้อมูลไม่ถูกต้อง ไม่สามารถแก้ไขข้อมูลได้ กรุณาทำรายการใหม่",
                                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false,
                                html: true,
                            },
                            function() {
                                location.reload();
                            }
                        );
                    }

                }
            }
        });
    }

});