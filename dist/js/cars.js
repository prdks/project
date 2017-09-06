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
    getProvince();

    function getProvince() {
        $.getJSON("_province.json", function(result){
          var province_group = result.th.changwats;
          sorting(province_group, 'name');
              $.each(province_group, function(i, field){
                $('#province').append($('<option>').text(field.name).attr('value', field.name));
                $('#display-province').append($('<option>').text(field.name).attr('value', field.name));
              });
        });
      }
      
      $('#note').hide();
      $('#status').change(function(){
          var s = $(this).val();
          if( s == 'งดจอง') {
              $('#note_area').prop('required',true);
              $('#note').show();
          } else {
              $('#note_area').prop('required',false);
              $('#note').hide();
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

                var state_pic = 0;
                var str_pic = '<div class="table-responsive"><table><tr><td class="child">';
                if (data.pic1 != 0) {state_pic++; str_pic += '<td><section class="contain"><img src="viewimg.php?mode=car&imgindex=1&id=' + id + '"></section></td>'; }
                if (data.pic2 != 0) {state_pic++; str_pic += '<td><section class="contain"><img src="viewimg.php?mode=car&imgindex=2&id=' + id + '"></section></td>'; }
                if (data.pic3 != 0) {state_pic++; str_pic += '<td><section class="contain"><img src="viewimg.php?mode=car&imgindex=3&id=' + id + '"></section></td>'; }
                if (data.pic4 != 0) {state_pic++; str_pic += '<td><section class="contain"><img src="viewimg.php?mode=car&imgindex=4&id=' + id + '"></section></td>'; }
                str_pic += '</td></tr><table></div>';
                if(state_pic > 0){$('#dt-show-picture').show(); $('#show-picture').html(str_pic);}
                else{$('#dt-show-picture').hide(); $('#show-picture').html('');}
                
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
                    str_pic = '<a class="btn btn-primary edit_picture1" data-picnum="1">เปลี่ยนรูปภาพ</a> ';
                    str_pic += '<a class="btn btn-danger delete_picture1" data-id='+id+'>ลบ</a>';
                    str_pic += '<br><input type="file" class="form-control hidden" name="filUpload0">';
                    $('#show-button_edit_1').html(str_pic);

                    $('.edit_picture1').click(function(){
                        var btn_txt = $(this).text();
                        if(btn_txt === 'เปลี่ยนรูปภาพ'){ $(this).html('ยกเลิก'); }
                        else{ $(this).html('เปลี่ยนรูปภาพ'); $('input[name=filUpload0]').val('') }

                        $('input[name=filUpload0]').toggleClass('hidden')
                    });

                    $('.delete_picture1').click(function(){
                        var id = $(this).attr('data-id');
                        var pic_num = 1;
                        swal({
                            title: "ต้องการลบรูปที่ "+ pic_num +" หรือไม่",
                            type: "warning",
                            showCancelButton: true,
                            cancelButtonText: "ยกเลิก",
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "ลบรูปภาพ",
                            closeOnConfirm: false
                          },
                          function(){
                            $.ajax({
                                type: "POST",
                                url: "cars/controller.php",
                                data: {id, pic_num, mode: 'deletePicture'},
                                dataType: 'json',
                                success: function(data){
                                  if (data.result == 1) //สำเร็จ
                                  {
                                    swal({
                                          title: "ลบสำเร็จ",
                                           type: "success",
                                          confirmButtonText: "ตกลง",
                                          showConfirmButton: true,
                                        },
                                        function()
                                        {
                                            str_pic = '<input type="file" class="form-control" name="filUpload'+(pic_num-1)+'">';
                                            $('#show-picture_edit_'+pic_num).html('');
                                            $('#show-button_edit_'+pic_num).html(str_pic);
                                        }
                                      );
                                  }
                                  else if (data.result == 0) //ไม่สำเร็จ
                                  {
                                    swal({
                                          title: "ไม่สามารถลบข้อมูลได้<br>กรุณาทำรายการใหม่",
                                           type: "error",
                                           confirmButtonText: "ตกลง",
                                           showConfirmButton: true,
                                          html: true,
                                        });
                                  }
                                  else if (data.result === 'error')
                                  {
                                    swal({
                                          title: "ไม่สามารถลบข้อมูลได้<br>เนื่องจากมีการใช้งานอยู่",
                                           type: "error",
                                           confirmButtonText: "ตกลง",
                                           showConfirmButton: true,
                                          html: true,
                                        });
                                  }
                                }
                              });
                          });
                    });

                } else {
                    str_pic = '<input id="file-upload" data-number="1" class="form-control" type="file" name="filUpload0"/>';
                    $('#show-picture_edit_1').html('');
                    $('#show-button_edit_1').html(str_pic);
                }
                //--------------------- Pic 2 --------------------
                if (data.pic2 != 0) {
                    str_pic = '<section class="contain"><img src="viewimg.php?mode=car&imgindex=2&id=' + id + '"></section>';
                    str_pic += '<br>';
                    $('#show-picture_edit_2').html(str_pic);
                    str_pic = '<a class="btn btn-primary edit_picture2" data-picnum="2">เปลี่ยนรูปภาพ</a> ';
                    str_pic += '<a class="btn btn-danger delete_picture2" data-id='+id+'>ลบ</a>';
                    str_pic += '<br><input type="file" class="form-control hidden" name="filUpload1">';
                    $('#show-button_edit_2').html(str_pic);

                    $('.edit_picture2').click(function(){
                        var btn_txt = $(this).text();
                        if(btn_txt === 'เปลี่ยนรูปภาพ'){ $(this).html('ยกเลิก'); }
                        else{ $(this).html('เปลี่ยนรูปภาพ'); $('input[name=filUpload1]').val('') }

                        $('input[name=filUpload1]').toggleClass('hidden')
                    });

                    $('.delete_picture2').click(function(){
                        var id = $(this).attr('data-id');
                        var pic_num = 2;
                        swal({
                            title: "ต้องการลบรูปที่ "+ pic_num +" หรือไม่",
                            type: "warning",
                            showCancelButton: true,
                            cancelButtonText: "ยกเลิก",
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "ลบรูปภาพ",
                            closeOnConfirm: false
                          },
                          function(){
                            $.ajax({
                                type: "POST",
                                url: "cars/controller.php",
                                data: {id, pic_num, mode: 'deletePicture'},
                                dataType: 'json',
                                success: function(data){
                                  if (data.result == 1) //สำเร็จ
                                  {
                                    swal({
                                          title: "ลบสำเร็จ",
                                           type: "success",
                                          confirmButtonText: "ตกลง",
                                          showConfirmButton: true,
                                        },
                                        function()
                                        {
                                            str_pic = '<input type="file" class="form-control" name="filUpload'+(pic_num-1)+'">';
                                            $('#show-picture_edit_'+pic_num).html('');
                                            $('#show-button_edit_'+pic_num).html(str_pic);
                                        }
                                      );
                                  }
                                  else if (data.result == 0) //ไม่สำเร็จ
                                  {
                                    swal({
                                          title: "ไม่สามารถลบข้อมูลได้<br>กรุณาทำรายการใหม่",
                                           type: "error",
                                           confirmButtonText: "ตกลง",
                                           showConfirmButton: true,
                                          html: true,
                                        });
                                  }
                                  else if (data.result === 'error')
                                  {
                                    swal({
                                          title: "ไม่สามารถลบข้อมูลได้<br>เนื่องจากมีการใช้งานอยู่",
                                           type: "error",
                                           confirmButtonText: "ตกลง",
                                           showConfirmButton: true,
                                          html: true,
                                        });
                                  }
                                }
                              });
                          });
                    });

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
                    str_pic = '<a class="btn btn-primary edit_picture3" data-picnum="3">เปลี่ยนรูปภาพ</a> ';
                    str_pic += '<a class="btn btn-danger delete_picture3" data-id='+id+'>ลบ</a>';
                    str_pic += '<br><input type="file" class="form-control hidden" name="filUpload2">';
                    $('#show-button_edit_3').html(str_pic);

                    $('.edit_picture3').click(function(){
                        var btn_txt = $(this).text();
                        if(btn_txt === 'เปลี่ยนรูปภาพ'){ $(this).html('ยกเลิก'); }
                        else{ $(this).html('เปลี่ยนรูปภาพ'); $('input[name=filUpload2]').val('') }

                        $('input[name=filUpload2]').toggleClass('hidden')
                    });

                    $('.delete_picture3').click(function(){
                        var id = $(this).attr('data-id');
                        var pic_num = 3;
                        swal({
                            title: "ต้องการลบรูปที่ "+ pic_num +" หรือไม่",
                            type: "warning",
                            showCancelButton: true,
                            cancelButtonText: "ยกเลิก",
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "ลบรูปภาพ",
                            closeOnConfirm: false
                          },
                          function(){
                            $.ajax({
                                type: "POST",
                                url: "cars/controller.php",
                                data: {id, pic_num, mode: 'deletePicture'},
                                dataType: 'json',
                                success: function(data){
                                  if (data.result == 1) //สำเร็จ
                                  {
                                    swal({
                                          title: "ลบสำเร็จ",
                                           type: "success",
                                          confirmButtonText: "ตกลง",
                                          showConfirmButton: true,
                                        },
                                        function()
                                        {
                                            str_pic = '<input type="file" class="form-control" name="filUpload'+(pic_num-1)+'">';
                                            $('#show-picture_edit_'+pic_num).html('');
                                            $('#show-button_edit_'+pic_num).html(str_pic);
                                        }
                                      );
                                  }
                                  else if (data.result == 0) //ไม่สำเร็จ
                                  {
                                    swal({
                                          title: "ไม่สามารถลบข้อมูลได้<br>กรุณาทำรายการใหม่",
                                           type: "error",
                                           confirmButtonText: "ตกลง",
                                           showConfirmButton: true,
                                          html: true,
                                        });
                                  }
                                  else if (data.result === 'error')
                                  {
                                    swal({
                                          title: "ไม่สามารถลบข้อมูลได้<br>เนื่องจากมีการใช้งานอยู่",
                                           type: "error",
                                           confirmButtonText: "ตกลง",
                                           showConfirmButton: true,
                                          html: true,
                                        });
                                  }
                                }
                              });
                          });
                    });


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
                    str_pic = '<a class="btn btn-primary edit_picture4" data-picnum="4">เปลี่ยนรูปภาพ</a> ';
                    str_pic += '<a class="btn btn-danger delete_picture4" data-id='+id+'>ลบ</a>';
                    str_pic += '<br><input type="file" class="form-control hidden" name="filUpload3">'
                    $('#show-button_edit_4').html(str_pic);

                    $('.edit_picture4').click(function(){
                        var btn_txt = $(this).text();
                        if(btn_txt === 'เปลี่ยนรูปภาพ'){ $(this).html('ยกเลิก'); }
                        else{ $(this).html('เปลี่ยนรูปภาพ'); $('input[name=filUpload3]').val('') }

                        $('input[name=filUpload3]').toggleClass('hidden')
                    });

                    $('.delete_picture4').click(function(){
                        var id = $(this).attr('data-id');
                        var pic_num = 4;
                        swal({
                            title: "ต้องการลบรูปที่ "+ pic_num +" หรือไม่",
                            type: "warning",
                            showCancelButton: true,
                            cancelButtonText: "ยกเลิก",
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "ลบรูปภาพ",
                            closeOnConfirm: false
                          },
                          function(){
                            $.ajax({
                                type: "POST",
                                url: "cars/controller.php",
                                data: {id, pic_num, mode: 'deletePicture'},
                                dataType: 'json',
                                success: function(data){
                                  if (data.result == 1) //สำเร็จ
                                  {
                                    swal({
                                          title: "ลบสำเร็จ",
                                           type: "success",
                                          confirmButtonText: "ตกลง",
                                          showConfirmButton: true,
                                        },
                                        function()
                                        {
                                            str_pic = '<input type="file" class="form-control" name="filUpload'+(pic_num-1)+'">';
                                            $('#show-picture_edit_'+pic_num).html('');
                                            $('#show-button_edit_'+pic_num).html(str_pic);
                                        }
                                      );
                                  }
                                  else if (data.result == 0) //ไม่สำเร็จ
                                  {
                                    swal({
                                          title: "ไม่สามารถลบข้อมูลได้<br>กรุณาทำรายการใหม่",
                                           type: "error",
                                           confirmButtonText: "ตกลง",
                                           showConfirmButton: true,
                                          html: true,
                                        });
                                  }
                                  else if (data.result === 'error')
                                  {
                                    swal({
                                          title: "ไม่สามารถลบข้อมูลได้<br>เนื่องจากมีการใช้งานอยู่",
                                           type: "error",
                                           confirmButtonText: "ตกลง",
                                           showConfirmButton: true,
                                          html: true,
                                        });
                                  }
                                }
                              });
                          });
                    });

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
                            title: "ไม่สามารถเพิ่มข้อมูลได้<br>กรุณาทำรายการใหม่1",
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
                            title: "ข้อมูลนี้มีอยู่แล้ว<br>กรุณาทำรายการใหม่2",
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