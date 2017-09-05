$(document).ready(function() {
    // รีเซ็ตหากเลือกวันที่ไม่ถูกต้อง
    $('#report_date_start').on("change", function() {
        var date_start = $(this);
        var date_end = $("#report_date_end");
        if ($('#report_date_end').val() != '') {
            date_end.attr('min', );
            date_end.val(date_start.val());
        }
    });
    // ถ้ากดเลือกวันจองวันสุดท้าย
    $('#report_date_end').click(function() {
        var date_start = $("#report_date_start").val();
        var date_end = $(this);

        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);

        if (date_start != '') {
            date_end.attr('min', date_start);
        }
    });
});