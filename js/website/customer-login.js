(function ($) {

    $(document).ready(function () {

        $('#btn_login').click(function (e) {
            e.preventDefault();


            var data = $('#loginform').serializeArray();

            var ajax_url = zingfit_js_var.ajaxurl;
            var postData = {
                'action': 'zingfit_customer_login',
                'username': data[0].value,
                'password': data[1].value,
            };

            if ($('.rememberme').is(":checked"))
            {
                postData['remember'] = 1;
            }

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_url,
                data:postData,
                success: (response) => {
                    if (response.status === true) {
                        window.location.href = '/account/';
                    } else {
                        alert('Failed WP login');
                    }
                }
            });
        });

    });

})(jQuery);