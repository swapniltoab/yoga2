(function ($) {

    $(document).ready(function () {

        $('.js-cancel-spot').click(function (e) {
            e.preventDefault();

            var attendanceId = $(this).data('attendanceid');
            var classDetail = $(this).data('classdetail');
            var ajax_url = zingfit_js_var.ajaxurl;
            console.log('attendanceId', attendanceId);
            // return false;
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_url,
                data: {
                    'action': 'zingfit_cancel_spot',
                    'attendanceId': attendanceId,
                    'classDetail': classDetail
                },
                success: (response) => {
                    $('.cancel-spot-response-message').html(response.message);
                    $('.cancel-attendace-spot-response').show();
                    $(this).hide();
                    jQuery('html, body').animate({
                        scrollTop: jQuery("div.cancel-attendace-spot-response").offset().top - 150
                    }, 1000)
                    setTimeout(function () {
                        $('.cancel-attendace-spot-response').hide();
                    }, 10000);

                }
            });
        });

    });

})(jQuery);