$(document).ready(function() {

    $('.handleUserRerserveDetail').click(function () {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "reservation/controller.php",
            data: { id: id, mode: 'getTableDetail' },
            success: function(data) {
                $('#show_detail_user').html(data);
            },
            error : function(data) { console.log(data)}
        });

        $('#printpdf').attr('href', 'form_without_data.php?id='+id)
        $('#printpdf').attr('target', '_blank') 
        
    });

    $("button[id$='cancel_btn']").click(function() {
        window.location.href = "index.php"
    });

    $("#editprofileform").submit(function(e) {
        e.preventDefault();
        updateProfile();
    });

    $("#new_user_form").submit(function(e) {
        e.preventDefault();
        NewUser();
    });

    // ------------------ Function ---------------------
    function updateProfile() {
        var data = $('#editprofileform').serializeArray();
        data.push({ name: 'mode', value: 'updateProfile' });
        $.ajax({
            type: "POST",
            url: "user/controller.php",
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
                        function() { window.location.assign('profile.php'); }
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
                        function() { window.location.assign('profile.php'); }
                    );
                }
            },
            error: function(data) {
                swal({
                        title: "ไม่สามารถแก้ไขข้อมูลได้<br>เนื่องจากข้อมูลไม่ครบ",
                        text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                        type: "error",
                        timer: 2000,
                        showConfirmButton: false,
                        html: true,
                    },
                    function() { window.location.assign('profile.php'); }
                );
            }
        });
    }

    function NewUser() {
        var data = $('#new_user_form').serializeArray();
        data.push({ name: 'mode', value: 'NewUser' });
        $.ajax({
            type: "POST",
            url: "user/controller.php",
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
                        function() { window.location.assign('index.php'); }
                    );
                } else if (data.result === 'error') {
                    swal({
                            title: "ไม่สามารถเพิ่มข้อมูลได้<br>กรุณาทำรายการใหม่",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "error",
                            timer: 2000,
                            showConfirmButton: false,
                            html: true,
                        },
                        function() { window.location.assign('index.php'); }
                    );
                }
            },
            error: function(data) {console.log(data)}
        });
    }
});