(function ($) {

    $(document).ready(function () {

        var email = localStorage.getItem('yoga_login_email');
        if (email) {
            $('#login_email').val(email);
        }

        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('redirecturl=');
                sParameterName = sParameterName.slice(1);
                return sParameterName;
            }
        };

        $('.js-login-forgot-password').click(function(e){
            e.preventDefault();
            $('#loginform').hide();
            $('#forgotPasswordForm').show();
        });

        $('.js-back-to-login').click(function(e){
            e.preventDefault();
            $('#forgotPasswordForm').hide();
            $('#loginform').show();
        });

        $('#btn_login').click(function (e) {
            e.preventDefault();


            var data = $('#loginform').serializeArray();

            var ajax_url = zingfit_js_var.ajaxurl;
            var postData = {
                'action': 'zingfit_customer_login',
                'username': data[0].value,
                'password': data[1].value,
            };

            if ($('.rememberme').is(":checked")) {
                postData['remember'] = 1;
            }

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_url,
                data: postData,
                success: (response) => {
                    if (response.status === true) {
                        if ($('.rememberme').is(":checked")) {
                            localStorage.setItem('yoga_login_email', data[0].value);
                        }

                        var redirecturl = getUrlParameter();

                        if (redirecturl) {
                            window.location.href = redirecturl;
                        } else {
                            window.location.href = '/account/';
                        }
                    } else {
                        alert('Failed WP login');
                    }
                }
            });
        });

    });

})(jQuery);