(function ($) {

    $(document).ready(function () {

        $('.js-book-class-spot').click(function (e) {
            e.preventDefault();

            let classId = $(this).data('classid');
            let spotId = $(this).data('spotid');
            let seriesId = $(this).data('seriesid');

            // return false;

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
                    // if (response.status === true) {
                    //     window.location.href = '/';
                    // } else {
                    //     alert('Failed WP login');
                    // }
                }
            });
        });

    });

})(jQuery);