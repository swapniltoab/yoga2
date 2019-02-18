(function ($) {

    $(document).ready(function () {
        let generateAccessTokenBtn = document.getElementById('js-zingfit-generate-access-token');

        generateAccessTokenBtn.addEventListener('click', (e) => {
            e.preventDefault();
            var ajax_url = zingfit_js_var_admin.ajaxurl;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_url,
                data: {
                    'action': 'zingfit_generate_access_token'
                },
                success: (response) => {
                    if(response.status === true){
                        document.getElementById('zingfit_access_token').value = response.access_token;
                    } else {

                    }

                }
            });

        });
    });

})(jQuery);