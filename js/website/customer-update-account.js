(function ($) {

    $(document).ready(function () {

        $('#js-update-user-btn').click(function (e) {
            e.preventDefault();

            // $(".error-message").empty();
            // if (!validateForm()) {
            //     return false;
            // }

            let data = $('#usedAccountEdit').serializeArray();
            let password = data[1].value;

            var ajax_url = zingfit_js_var.ajaxurl;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_url,
                data: {
                    'action': 'zingfit_customer_update',
                    'formData': data
                },
                success: (response) => {
                    if (response.status === true) {
                        let userdata = response.userdata;
                        if (response.response_code == '406') {
                            alert('User is already exists in zingfit api, please use another email/username');
                            return false;
                        }
                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: ajax_url,
                            data: {
                                'action': 'zingfit_customer_update_wp_user',
                                'userdata': userdata,
                                'password': password
                            },
                            success: (userResponse) => {
                                if (userResponse.status === true) {
                                    window.location.href = '/';
                                } else {
                                    alert('Failed WP registration');
                                }
                            }
                        });

                    } else {
                        alert('Failed from zingfit registration');
                    }

                }
            });
        });

    });

    function validateForm() {

        $(".error-message").empty();
        var result = true;
        var password = $(".js-pass").val();
        var confirmPassword = $(".js-confirm-pass").val();

        $(".js-required").each(function () {
            var input_value = $(this).val().trim();

            if (input_value.length == 0) {
                result = false;
                $(this).parent().closest('.js-form-control').find(".error-message").empty().text('Required');

            } else {
                if ($(this).hasClass('js-email')) {
                    var isValidEmail = validateEmail(input_value);
                    if (!isValidEmail) {
                        result = false;
                        $(this).parent().closest('.js-form-control').find(".error-message").empty().text('Please Enter valid email');
                    }
                }

                if ($(this).hasClass('js-pass')) {
                    var isValidPass = validatePass(input_value);
                    if (!isValidPass) {
                        result = false;
                        $(this).parent().closest('.js-form-control').find(".error-message").empty().text('Please a Strong password');
                    }
                }

                if ($(this).hasClass('js-text-only')) {
                    var isValidText = validateOnlyText(input_value);
                    if (!isValidText) {
                        result = false;
                        $(this).parent().closest('.js-form-control').find('.error-message').empty().text('Enter only letters');
                    }
                }

                if ($(this).hasClass('js-mob')) {
                    var isValidMob = validateMobile(input_value);
                    if (!isValidMob) {
                        result = false;
                        $(this).parent().closest('.js-form-control').find('.error-message').empty().text('Enter 10 digit mobile number');
                    }
                }

                if ($(this).hasClass('js-zip')) {
                    var isValidZip = validateZip(input_value);
                    if (!isValidZip) {
                        result = false;
                        $(this).parent().closest('.js-form-control').find('.error-message').empty().text('Enter only 6 digit mobile number');
                    }
                }


            }
        });
        return result;



    }

    function validateEmail(input_value) {
        var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
        if (!pattern.test(input_value)) {
            return false;
        }
        return true;
    }

    function validateOnlyText(input_value) {
        var pattern = /^[a-zA-Z]+$/;
        if (!pattern.test(input_value)) {
            return false;
        }
        return true;

    }

    function validateMobile(input_value) {
        var pattern = /^\d{10}$/;
        if (!pattern.test(input_value)) {
            return false;
        }
        return true;
    }

    function validateZip(input_value) {
        var pattern = /^\d{6}$/;
        if (!pattern.test(input_value)) {
            return false;
        }
        return true;
    }

})(jQuery);