(function ($) {

    $(document).ready(function () {

        $('#js-update-user-btn').click(function (e) {
            e.preventDefault();

             $(".error-message").empty();
             if (!validateForm()) {
                 return false;
             }

            var data = $('#usedAccountEdit').serializeArray();
            var password = data[1].value;

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
                        var userdata = response.message;
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
                                    window.location.href = '/account';
                                } else {
                                    alert('Failed');
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
        var password1 = $("#password1").val();
        var confirmPassword = $("#confirm_password").val();

        $(".js-pass").each(function () {
            var input_value = $(this).val().trim();
            if(input_value.length > 0){
                var isValidPass = validatePass(input_value);
                if (!isValidPass) {
                    result = false;
                    $(this).parent().closest('.js-form-control').find(".error-message").empty().text('Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters');
                }
                if (password1 != confirmPassword) {
                    $(this).parent().closest('.js-form-control').find(".error-message").empty().text('Password not matching');
                }
            }
        });

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
                        $(this).parent().closest('.js-form-control').find('.error-message').empty().text('Enter only 5 digit Zip code');
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

    function validatePass(input_value) {
        var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,15}$/;
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
        var pattern = /^\d{5}$/;
        if (!pattern.test(input_value)) {
            return false;
        }
        return true;
    }

})(jQuery);