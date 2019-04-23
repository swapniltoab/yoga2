(function ($) {

    $(document).ready(function () {

        $('.js-book-class-spot').click(function (e) {
            e.preventDefault();

            if ($(this).hasClass('spot-Enrolled')) {
                return false;
            }

            let classId = $(this).data('classid');
            let spotId = $(this).data('spotid');
            let seriesId = $(this).data('seriesid');

            let ajax_url = zingfit_js_var.ajaxurl;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_url,
                data: {
                    'action': 'zingfit_book_slot',
                    'classId': classId,
                    'spotId': spotId,
                    'seriesId': seriesId
                },
                success: (response) => {
                    console.log(response);
                    if(response.status == true){
                        window.location.href = '/book/confirm/';
                    } else {
                        $('.response-message').text(response.message);
                        $('.book-spot-response').show();
                        jQuery('html, body').animate({
                            scrollTop: jQuery("div.book-spot-response").offset().top-150
                        }, 1000)
                        setTimeout(function(){
                            $('.book-spot-response').hide();
                        },10000);
                    }
                }
            });
        });

    });

})(jQuery);