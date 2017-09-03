$(document).ready(function() {
    // ---------------- Brand ----------------
    $("#form_insert_brand").submit(function(e) {
        e.preventDefault();
        insertBrand();
    });

    $("#form_edit_brand").submit(function(e) {
        e.preventDefault();
        editBrand();
    });

    $("#form_delete_brand").submit(function(e) {
        e.preventDefault();
        deleteBrand();
    });
    
    // ------------- Brand ---------------
    function insertBrand() {
        var car_brand = $('[name=car_brand_name]').val();
        $.ajax({
            type: "POST",
            url: "car_brand/controller.php",
            data: { car_brand, mode: 'insertBrand' },
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
                        function() { window.location.assign('car_brand.php'); }
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
                        function() { window.location.assign('car_brand.php'); }
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
                        function() { window.location.assign('car_brand.php'); }
                    );
                }
            }
        });
    }

    function editBrand() {
        var car_brand = $('[name=txt_update]').val();
        var id = $('[name=update_id]').val();
        $.ajax({
            type: "POST",
            url: "car_brand/controller.php",
            data: { car_brand, id, mode: 'editBrand' },
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
                        function() { window.location.assign('car_brand.php'); }
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
                        function() { window.location.assign('car_brand.php'); }
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
                        function() { window.location.assign('car_brand.php'); }
                    );
                }
            }
        });
    }

    function deleteBrand() {
        var id = $('[name=delete_id]').val();
        $.ajax({
            type: "POST",
            url: "car_brand/controller.php",
            data: { id, mode: 'deleteBrand' },
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
                        function() { window.location.assign('car_brand.php'); }
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
                        function() { window.location.assign('car_brand.php'); }
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
                        function() { window.location.assign('car_brand.php'); }
                    );
                }
            }
        });
    }
});