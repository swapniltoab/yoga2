(function ($) {

    $(document).ready(function () {

        $(document).on('click', '#updateZingfitRegions', function (e) {

            e.preventDefault();
            var ajax_url = zingfit_js_var_admin.ajaxurl;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_url,
                data: {
                    'action': 'zingfit_update_regions'
                },
                success: (response) => {
                    alert(response.message);
                }
            });
        });



        $(document).on('click', '#updateZingfitSites', function (e) {

            e.preventDefault();
            var ajax_url = zingfit_js_var_admin.ajaxurl;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_url,
                data: {
                    'action': 'zingfit_update_sites'
                },
                success: (response) => {
                    alert(response.message);
                }
            });
        });

        $(document).on('click', '#updateZingfitGateways', function (e) {

            e.preventDefault();
            var ajax_url = zingfit_js_var_admin.ajaxurl;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_url,
                data: {
                    'action': 'zingfit_update_gateways'
                },
                success: (response) => {
                    alert(response.message);
                }
            });
        });

    });

})(jQuery);