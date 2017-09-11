$(document).ready(function() {
    // ---------------- Department ----------------
    $("#form_insert_department").submit(function(e) {
        e.preventDefault();
        insertDepartment();
    });

    $("#form_edit_department").submit(function(e) {
        e.preventDefault();
        editDepartment();
    });

    $("#form_delete_department").submit(function(e) {
        e.preventDefault();
        deleteDepartment();
    });

    // ------------- department ---------------
    function insertDepartment() {
        var department = $('[name=department_name]').val();
        $.ajax({
            type: "POST",
            url: "department/controller.php",
            data: { department, mode: 'insertDepartment' },
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
                        function() { window.location.assign('department.php'); }
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
                        function() { window.location.assign('department.php'); }
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
                        function() { window.location.assign('department.php'); }
                    );
                }
            }
        });
    }

    function editDepartment() {
        var department = $('[name=txt_update]').val();
        var id = $('[name=update_id]').val();
        $.ajax({
            type: "POST",
            url: "department/controller.php",
            data: { department, id, mode: 'editDepartment' },
            dataType: 'json',
            success: function(data) {
                if (data.result == 1) //สำเร็จ
                {
                    swal({
                            title: "แก้ไขข้อมูลสำเร็จ",
                            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                            type: "success",
                            showConfirmButton: false,
                            timer: 2000,
                        },
                        function() { window.location.assign('department.php'); }
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
                        function() { window.location.assign('department.php'); }
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
                        function() { window.location.assign('department.php'); }
                    );
                }
            }
        });
    }

    function deleteDepartment() {
        var id = $('[name=delete_id]').val();
        $.ajax({
            type: "POST",
            url: "department/controller.php",
            data: { id, mode: 'deleteDepartment' },
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
                        function() { window.location.assign('department.php'); }
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
                        function() { window.location.assign('department.php'); }
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
                        function() { window.location.assign('department.php'); }
                    );
                }
            }
        });
    }
});