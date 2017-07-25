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
          curInputs = curStep.find("input[type='text'],input[type='password'],input[type='url']"),
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

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');

});
