(function ($) {

    $(document).ready(function () {

        $('.js-delete-cc-card').click(function (e) {
            e.preventDefault();

            let cardId = $(this).data('cardid');
            console.log('cardId', cardId);

            // return false;

            let ajax_url = zingfit_js_var.ajaxurl;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_url,
                data: {
                    'action': 'zingfit_delete_cc_card',
                    'cardId': cardId,
                },
                success: (response) => {
                    if (response.status === true) {
                        window.location.href = '/account';
                    } else {
                        alert(response.error);
                    }
                }
            });
        });

    });

})(jQuery);