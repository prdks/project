$(document).ready(function() {
    // ---------------- User_type ----------------

    $("#form_edit_usertype").submit(function(e) {
        e.preventDefault();
        editUserType();
    });


    
    // ------------- user_type ---------------

    function editUserType() {
        var user_type = $('[name=txt_update]').val();
        var level = $('[name=txt_level]').val();
        var id = $('[name=update_id]').val();
        $.ajax({
            type: "POST",
            url: "user_type/controller.php",
            data: { user_type, level, id, mode: 'editUserType' },
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
                        function() { window.location.assign('user_type.php'); }
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
                        function() { window.location.assign('user_type.php'); }
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
                        function() { window.location.assign('user_type.php'); }
                    );
                }
            }
        });
    }


});