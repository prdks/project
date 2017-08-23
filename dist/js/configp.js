$(function() {

  $('.PreBtn2').click(function () {
    $('a[href="#step-1"]').trigger('click');
  });
  $('.PreBtn3').click(function () {
    $('a[href="#step-2"]').trigger('click');
  });

  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[name='password'],input[name='confirm_password'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");

          }
      }
      if ($("input[name='confirm_password']").val() !== $("input[name='password']").val())
      {
        $("input[name='password']").closest(".form-group").addClass("has-error");
        $("input[name='confirm_password']").closest(".form-group").addClass("has-error");
        swal({
          title: "รหัสผ่านไม่ตรงกัน",
          text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
           type: "error",
          timer: 2000,
          html: true,
          showConfirmButton: false,
        });
        isValid = "";
      }
      

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
  // ------------------------------------------------------------------
  $(".back_home").click(function () {
    $("#hometab").click();
  });
  // --------------------- Edit User Pass ------------------------------
  $("#link_editUserpass").click(function () {
    var id = $(".callback_v").val();
    $.ajax({
      type: "POST",
      url: "admin/controller.php",
      data: {id, mode:'getData'},
      dataType: 'json',
      success: function(data){
        $('input[name=username]').val(data.username);
        // clear input password
        $('input[name=old_password]').val('');
        $('input[name=new_password]').val('');
        $('input[name=confirm_new_password]').val('');

      }
    });

  });

  $("#edit_pass_form").submit(function(e) {
    e.preventDefault();

    var username = $('input[name=username]');
    var new_p = $('input[name=new_password]');
    var confirm_p = $('input[name=confirm_new_password]');

    if($.trim(username.val()).length != 0)
    {
      if(confirm_p.val() !== new_p.val())
        {
          swal({
            title: "รหัสผ่านใหม่ไม่ตรงกัน",
            text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
             type: "error",
            timer: 2000,
            html: true,
            showConfirmButton: false,
          });
          confirm_p.focus();
        }
        else
        {
          updateUserPass();
        }
    }
    else
    {
      swal({
        title: "กรุณาป้อนชื่อผู้ใช้งาน",
        text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
         type: "error",
        timer: 2000,
        html: true,
        showConfirmButton: false,
      });
      username.focus();
    }
    
  });

  function updateUserPass() 
  {
    var id = $(".callback_v").val();
    var data = $('#edit_pass_form').serializeArray();
    data.push({name : 'id' , value : id});
    data.push({name : 'mode' , value : 'updateUserPass'});
    $.ajax({
      type: "POST",
      url: "admin/controller.php",
      data: data,
      dataType: 'json',
      success: function(data){
        if (data.result == 1)
        {
          swal({
              title: "แก้ไขรหัสผ่านสำเร็จ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
              type: "success",
              timer: 2000,
              showConfirmButton: false,
            },
            function(){ window.location.assign('page_config.php?callback='+id);}
          );
        }
        else if (data.result == 0)
        {
          swal({
              title: "แก้ไขรหัสผ่านผิดพลาด กรุณาทำรายการใหม",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
              type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            });
          $("#link_editUserpass").click();
        }
        else if (data.result === 'error')
        {
          swal({
                title: "รหัสผ่านเดิมไม่ถูกต้อง กรุณาทำรายการใหม่",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                type: "error",
                timer: 2000,
                html: true,
                showConfirmButton: false,
              });
          $("#link_editUserpass").click();
        }
      }
    }); 
  }
  // --------------------- Edit Data ------------------------------
  $("#link_editInfo").click(function () {
    var id = $(".callback_v").val();
    $.ajax({
      type: "POST",
      url: "admin/controller.php",
      data: {id, mode:'getData'},
      dataType: 'json',
      success: function(data){
        $('input[name=name').val(data.name);
        $('input[name=domain_name]').val(data.domain);
        $('input[name=url]').val(data.url);
      }
    });
  });

  $("#edit_data_form").submit(function(e) {
    e.preventDefault();
    updateData();
  });

  function updateData() 
  {
    var id = $(".callback_v").val();
    var data = $('#edit_data_form').serializeArray();
    data.push({name : 'id' , value : id});
    data.push({name : 'mode' , value : 'updateData'});
    $.ajax({
      type: "POST",
      url: "admin/controller.php",
      data: data,
      dataType: 'json',
      success: function(data){
        if (data.result == 1)
        {
          swal({
              title: "แก้ไขข้อมูลคณะสำเร็จ",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
              type: "success",
              timer: 2000,
              showConfirmButton: false,
            },
            function(){ window.location.assign('page_config.php?callback='+id);}
          );
        }
        else if (data.result == 0)
        {
          swal({
              title: "แก้ไขข้อมูลคณะผิดพลาด กรุณาทำรายการใหม",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
              type: "error",
              timer: 2000,
              showConfirmButton: false,
              html: true,
            });
          $("#link_editInfo").click();
        }
      }
    }); 
  }
  // --------------------- Edit Logo ------------------------------
  $("#link_editLogo").click(function(){
    $('input[name=logo]').val('');
  });

  $("#edit_logo_form").submit(function(e) {
    e.preventDefault();
    updateLogo();
  });

  function updateLogo() 
  {
    var id = $(".callback_v").val();
    var form = $('#edit_logo_form')[0];
    var formData = new FormData(form);
    formData.append('id', id);
    formData.append('mode', 'updateLogo');
    $.ajax({
      type: "POST",
      url: "admin/controller.php",
      data: formData,
      dataType: 'json',
      contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
      processData: false, // NEEDED, DON'T OMIT THIS
      success: function(data){
        if (data.result == 1)
          {
            swal({
                title: "แก้ไขรูปโลโก้คณะสำเร็จ",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                type: "success",
                timer: 2000,
                showConfirmButton: false,
              },
              function(){ window.location.assign('page_config.php?callback='+id);}
            );
          }
          else if (data.result == 0)
          {
            swal({
                title: "แก้ไขรูปโลโก้คณะผิดพลาด กรุณาทำรายการใหม",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
                html: true,
              });
            $("#link_editLogo").click();
          }
      }
    });
  }
  // --------------------- Delete Data ------------------------------
  $("#delete_data_btn").click(function () {
    var status = $(this).attr('data-status');
    if (status == 1) 
    {
      swal({
        title: "<b><h3>ต้องการลบข้อมูลการตั้งค่าระบบใช่หรือไม่</h3></b>",
        text: "<span class='text-danger'>หมายเหตุ : การลบข้อมูลการตั้งค่าระบบ<br>ข้อมูลอื่นๆภายในระบบจะยังคงอยู่</span>",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: 'ยกเลิก',
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "ยืนยันลบข้อมูล",
        closeOnConfirm: false,
        html: true
      },
      function(){
        var id = $(".callback_v").val();
        $.ajax({
          type: "POST",
          url: "admin/controller.php",
          data: {id: id , mode: 'DeleteData'},
          dataType: 'json',
          success: function(data){
            if (data.result == 1)
              {
                swal({
                    title: "ลบข้อมูลการตั้งค่าสำเร็จ",
                    text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false,
                  },
                  function(){ window.location.assign('_logout.php');}
                );
              }
              else if (data.result == 0)
              {
                swal({
                    title: "ไม่สามารถลบข้อมูลได้ กรุณาทำรายการใหม",
                    text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                    type: "error",
                    timer: 2000,
                    showConfirmButton: false,
                    html: true,
                  });
              }
          }
        });
      });
    }
    else
    {
      swal({
        title: "<b><h3>ไม่สามารถลบข้อมูลการตั้งค่าระบบได้</h3></b>",
        text: "<span class='text-danger'>หมายเหตุ : เนื่องจากไม่พบข้อมูลผู้ดูแลระบบ</span>",
        type: "error",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "ตกลง",
        closeOnConfirm: true,
        html: true
      });
    }
  });

  // -------------------------  Login -----------------------------

  $("#adminlogin_form").submit(function(e) {
      e.preventDefault();
      login();
  });

  function login() {
    var data = $('#adminlogin_form').serializeArray();
        data.push({name : 'mode' , value : 'login'});
      $.ajax({
        type: "POST",
        url: "admin/controller.php",
        data: data,
        dataType: 'json',
        success: function(data){
          if (data.result == 1) //login by user & pass form database
          {
            window.location.assign('page_config.php?callback='+data.id);
          }
          else if (data.result == 2) //login by config_user&pass
          {
            window.location.assign('page_config.php');
          }
          else if (data.result === 'error')
          {
            swal({
                  title: "<b><h3>ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง<br>กรุณาเข้าสู่ระบบใหม่อีกครั้ง</h3></b>",
                  text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                   type: "error",
                  timer: 2000,
                  html: true,
                  showConfirmButton: false,
                },
                function(){ window.location.assign('admin_login.php'); }
              );
          }
        }
      });
  }

  // -------------------------- Insert Config------------------------
  
  $("#admininsert_form").submit(function(e) {
      e.preventDefault();
      insertdata();
  });


  function insertdata() {
    // var data = $('#admininsert_form').serializeArray();
    var form = $('#admininsert_form')[0];
    var formData = new FormData(form);
        // Attach file
        formData.append('mode', 'insertdata');
    // data.push({name : 'mode' , value : 'insertdata'});
    $.ajax({
      type: "POST",
      url: "admin/controller.php",
      data: formData,
      dataType: 'json',
      contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
      processData: false, // NEEDED, DON'T OMIT THIS
      success: function(data){
        // console.log(data);
        if (data.result == 1) //สำเร็จ
        {
          swal({
                title: "ตั้งค่าเสร็จสิ้น",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "success",
                timer: 2000,
                showConfirmButton: false,
              },
              function(){ window.location.assign('signup_app.php'); }
            );
        }
        else if (data.result == 0) //ไม่สำเร็จ
        {
          swal({
                title: "การตั้งค่าผิดพลาด กรุณาทำรายการใหม",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "error",
                timer: 2000,
                showConfirmButton: false,
                html: true,
              },
              function(){ window.location.assign('page_config.php'); }
            );
        }
        else if (data.result == 2) //สำเร็จแต่มีแอดมิน
          {
            swal({
                title: "ตั้งค่าเสร็จสิ้น",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                type: "success",
                timer: 2000,
                showConfirmButton: false,
              },
              function(){ window.location.assign('index.php'); }
            );
          }
      }
    });
  }
// --------------------- Insert Admin Data -------------------
$("#adminsignup_form").submit(function(e) {
  e.preventDefault();
  InsertAdmin();
});

function InsertAdmin() {
  var data = $('#adminsignup_form').serializeArray();
  data.push({name : 'mode' , value : 'InsertAdmin'});
  $.ajax({
    type: "POST",
    url: "admin/controller.php",
    data: data,
    dataType: 'json',
    success: function(data){
      if (data.result == 1)
      {
        window.location.assign('index.php');
      }
      else if (data.result === 'error')
      {
        swal({
              title: "ผิดพลาด กรุณาทำรายการใหม่",
              text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
              type: "error",
              timer: 2000,
              html: true,
              showConfirmButton: false,
            },
            function(){ window.location.assign('signup_app.php'); }
          );
      }
    }
  });
}

});
