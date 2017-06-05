$(function () {
  $.validator.setDefaults({
    lang: 'TH',
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
  });
// //title
// $('#insert_title_form').validate();
// $('#edit_title_form').validate();
// //position
// $('#insert_position_form').validate();
// edit profile page
$('#editprofileform').validate();
// reservation page
 $('#formdetail').validate({
        rules: {
            detail: {
                required: true
            },
            date_start: {
                required: true
            },
            date_end: {
                required: true
            },
            time_start: {
              required: true
            },
            time_end: {
              required: true
            }
        },
			messages: {
				detail: "กรุณากรอกรายละเอียดการจอง",
				date_start: "กรุณาเลือกวันแรกที่ต้องการจอง",
				date_end: "กรุณาเลือกวันสุดท้ายที่ต้องการจอง",
        time_start: "กรุณาเลือกช่วงเวลาเริ่มต้น",
        time_end: "กรุณาเลือกช่วงเวลาสิ้นสุด"
			}
  });

});
