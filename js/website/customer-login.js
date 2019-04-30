(function ($) {

    $(document).ready(function () {

        $('#btn_login').click(function (e) {
            e.preventDefault();


            let data = $('#loginform').serializeArray();
            let password = data[1].value;
            let remember = false;

            if ($('.rememberme').is(":checked"))
            {
                remember = true;
            }
            // console.log('data', data);

            var ajax_url = zingfit_js_var.ajaxurl;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_url,
                data: {
                    'action': 'zingfit_customer_login',
                    'username': data[0].value,
                    'password': data[1].value,
                    'remember' : remember
                },
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