(function ($) {

    $(document).ready(function () {

        $('.js-book-class-spot').click(function (e) {
            e.preventDefault();

            let classId = $(this).data('classid');
            let spotId = $(this).data('spotid');
            console.log('data', classId);
            console.log('data', spotId);

            // return false;

            let ajax_url = zingfit_js_var.ajaxurl;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_url,
                data: {
                    'action': 'zingfit_book_slot',
                    'classId': classId,
                    'spotId': spotId
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