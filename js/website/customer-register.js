(function ($) {

    $(document).ready(function(){

        $('#btn_register').click(function(e){
            e.preventDefault();

             $(".error-message").empty();
            if(!validateForm()){
                return false;
            }
            
            //if(! $form.valid()) return false;
            let data = $('#registerform').serializeArray();
            let password = data[1].value;
            console.log('data', data);
            
           // var formData = JSON.stringify(jQuery('#registerform').serializeArray());
            //console.log('formdata', formData);
            
            var ajax_url = zingfit_js_var.ajaxurl;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_url,
                data: {
                    'action': 'zingfit_customer_register',
                    'formData': data
                },
                success: (response) => {
                    if(response.status === true){
                        let userdata = response.userdata;
                        if(response.response_code =='406')
                        {
                            alert('User is already exists in zingfit api, please use another email/username');
                            return false;
                        }
                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: ajax_url,
                            data: {
                                'action': 'zingfit_customer_register_wp_user',
                                'userdata': userdata,
                                'password': password
                            },
                            success: (userResponse) => {
                                if(userResponse.status === true){
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

    function validateForm(){
        var result = true;
        $(".js-required").each(function() {
            var input_value =  $(this).val().trim();
            //Zconsole.log('input........',input_value);
            //var mail_input_value =  $.trim($("input[name='username']").val());

            //var ddl = document.getElementById("state");
            //var state_value = ddl.options[ddl.selectedIndex].value;
            //var state_value = document.querySelector('#state').value;
            //console.log('state', state_value);

            if(input_value.length == 0){
                result = false;
                $(this).parent().closest('.js-form-control').find(".error-message").empty().text('Required');
            }
            // if ($('#state')[0].tagName !='SELECT') {
            //     result = false;
            //     $(this).parent().closest('.js-form-control').find(".error-message").empty().text('Required');
            // }

            //    else {
            //     result = true;
            //  }

            
        });
        return result;
        
    }
})(jQuery);