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
        swal('รหัสผ่านไม่ตรงกัน');
        isValid = "";
      }
      if ($("input[name='new_password']").val() !== "") {
        if ($("input[name='confirm_new_password']").val() !== $("input[name='new_password']").val())
        {
          $("input[name='new_password']").closest(".form-group").addClass("has-error");
          $("input[name='confirm_new_password']").closest(".form-group").addClass("has-error");
          swal('รหัสผ่านไม่ตรงกัน');
          isValid = "";
        }
      }
      if ($("input[name='confirm_new_password']").val() !== "" && $("input[name='new_password']").val() === "") {
        $("input[name='new_password']").closest(".form-group").addClass("has-error");
        swal('กรุณาป้อนรหัสผ่านใหม่');
        isValid = "";
      }


      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');

  // ------------------------------------------------------------------

  $("#adminlogin_form").submit(function(e) {
      e.preventDefault();
      login();
  });

  $("#admininsert_form").submit(function(e) {
      e.preventDefault();
      insertdata();
  });

  $("#adminedit_form").submit(function(e) {
      e.preventDefault();
      editdata();
  });

  // --------------------------function------------------------
  function login() {
    var data = $('#adminlogin_form').serializeArray();
        data.push({name : 'mode' , value : 'login'});
      $.ajax({
        type: "POST",
        url: "admin/controller.php",
        data: data,
        dataType: 'json',
        success: function(data){
          if (data.result == 1) //สำเร็จ
          {
            window.location.assign('page_config.php');
          }
          else if (data.result == 2) //ไม่สำเร็จ
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
      }
    });
  }

  function editdata() {
    // var data = $('#admininsert_form').serializeArray();
    var form = $('#adminedit_form')[0];
    var formData = new FormData(form);
        // Attach file
        formData.append('mode', 'editdata');
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
                title: "แก้ไขตั้งค่าเสร็จสิ้น",
                text: "แจ้งเตือนจะปิดเองภายใน 2 วินาที",
                 type: "success",
                timer: 2000,
                showConfirmButton: false,
              },
              function(){ window.location.assign('admin_login.php'); }
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
      }
    });
  }
});
