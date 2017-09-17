$(document).ready(function() {
    // car_detail
    $('.handleCarDetail').click(function() {
        var id = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "cars/controller.php",
            data: { id: id, mode: 'getDetail' },
            success: function(data) {
                $('.detail_car_modal').html(data);
            }
        });

    });

});