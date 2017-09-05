$(document).ready(function() {
    $("button[id$='cancel_btn']").click(function() {
        window.location.href = "index.php"
    });

    $("#editprofileform").submit(function(e) {
        e.preventDefault();
        updateProfile();
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
                            title: "ไม่สามารถแก้ไขข้อมูลได้<br>กรุณาทำรายการใหม",
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

});