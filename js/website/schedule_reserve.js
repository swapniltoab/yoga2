(function ($) {

    $(document).ready(function () {

        $('.reserve').click(function (e) {
            var roomid = $(this).attr('data-room-id');

            var ajax_url = zingfit_js_var.ajaxurl;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_url,
                data: {
                    'action': 'zingfit_schedule_reserve',
                    'room': roomid
                },
                success: {

                }
            });
        });

    });

})(jQuery);