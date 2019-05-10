/* global zingfit_js_var */

jQuery(document).ready(function ($) {

  $('#btn_reset_password').click(function (event) {

    event.preventDefault();

    var pass_nonce = $('#yoga-reset-password-nonce').val();
    var new_pass = $('#js-reset_password').val();
    var confirm_new_pass = $('#js-confirm_reset_password').val();
    var reset_user_key = $('#reset_user_key').val();
    var reset_user_login = $('#reset_user_login').val();
    var ajax_url = zingfit_js_var.ajaxurl;
    var validator = true;

    var errorNewPassEle = $('#error_new_password');
    var errorConfPassEle = $('#error_confirm_password');

    if (new_pass === '') {
      $(errorNewPassEle).text('Please enter required field.');
      validator = false;
    } else if (new_pass.length < 6) {
      $(errorNewPassEle).text('Password must be at least 6 characters long');
      return false;
    } else {
      $(errorNewPassEle).text('');
    }

    if (confirm_new_pass === '') {
      $(errorConfPassEle).text('Please enter required field.');
      validator = false;
    } else {
      $(errorConfPassEle).text('');
    }

    if (confirm_new_pass !== new_pass) {
      $(errorConfPassEle).text('Password not matched. Try again.');
      validator = false;
    } else {
      $(errorConfPassEle).text('');
    }

    if (validator === false) {
      return false;
    }

    data = {
      action: 'yoga_reset_user_password',
      nonce: pass_nonce,
      new_pass: new_pass,
      confirm_new_pass: confirm_new_pass,
      reset_user_key: reset_user_key,
      reset_user_login: reset_user_login
    };

    $.post(ajax_url, data, function (response) {
      if (response) {
        if (response === '1') {
          setTimeout(function () {
            document.location.href = zingfit_js_var.homeurl;
          }, 1000);
        } else {
          alert(response);
        }
      }
    });

  });
});
