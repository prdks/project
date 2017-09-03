$(document).ready(function() {
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
            }
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