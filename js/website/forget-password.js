/* global zingfit_js_var */

jQuery(document).ready(function ($) {

  $('#btn_login_forgot_password').click(function (event) {

    event.preventDefault();

    var reg_email = $('#forgot_email').val();
    var nonce = $('#yoga-forgot-nonce').val();
    var ajax_url = zingfit_js_var.ajaxurl;
    var emailFilter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
    var validator = true;

    var errorEmailEle = $('#error_forgot_email');

    $(errorEmailEle).text('');

    if (reg_email === '') {
      $(errorEmailEle).text('Please enter required field.');
      validator = false;
    } else if (!emailFilter.test(reg_email)) {
      $(errorEmailEle).text('Please enter a valid e-mail address');
      validator = false;
    } else {
      $(errorEmailEle).text('');
    }

    if (validator === false) {
      return false;
    }

    data = {
      action: 'yoga_user_forget_pass',
      email: reg_email,
      nonce: nonce
    };

    $.post(ajax_url, data, function (response) {
      if (response) {
        if (response.status === true) {

          $(reg_email).val('');
          $(errorEmailEle).text(response.message);

        } else {

          $(errorEmailEle).text(response.message);

        }
      }
    }, 'json');

  });
});