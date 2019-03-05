(function ($) {

    $(document).ready(function () {

        $('#btn_login').click(function (e) {
            e.preventDefault();


            let data = $('#loginform').serializeArray();
            let password = data[1].value;
            console.log('data', data);

            var ajax_url = zingfit_js_var.ajaxurl;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_url,
                data: {
                    'action': 'zingfit_customer_login',
                    'username': data[0].value,
                    'password': data[1].value,
                },
                success: (response) => {
                    if(response.status === true){
                        window.location.href = '/';
                    } else {
                        alert('Failed WP login');
                    }
                }
            });
        });

    });

    // function validateForm() {
    //     var result = true;
    //     $(".js-required").each(function () {
    //         var input_value = $(this).val().trim();
            
    //         if (input_value.length == 0) {
    //             result = false;
    //             $(this).parent().closest('.js-form-control').find(".error-message").empty().text('Required');
    //         }

    //     });
    //     return result;

    // }

})(jQuery);