<?php

function yoga_reset_user_password()
{

    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'yoga-reset-password-nonce')) {
        die('Ooops, something went wrong, please try again later.');
    }

    $errors = new WP_Error();

    $token = $_POST['token'];
    $new_pass = $_POST['new_pass'];
    $confirm_new_pass = $_POST['confirm_new_pass'];
    $reset_user_key = $_POST['reset_user_key'];
    $reset_user_login = $_POST['reset_user_login'];

    $user = check_password_reset_key($reset_user_key, $reset_user_login);

    if (empty($new_pass) || empty($confirm_new_pass)) {
        $errors->add('password_required', __('Password is required field'));
    }

    if (isset($new_pass) && $new_pass != $confirm_new_pass) {
        $errors->add('password_reset_mismatch', __('The passwords do not match.'));
    }

    if ((!$errors->get_error_code() ) && isset($new_pass) && !empty($new_pass)) {
        reset_password($user, $new_pass);

        $data = [
            'token' => $token,
            'password' => $new_pass
        ];

        $regionId = '811593826090091886';
        $zingfit_access_token = get_transient('zingfit_access_token');

        if ($zingfit_access_token) {
            global $zingfit;
            $customerResponse = $zingfit->resetCustomerPassword($zingfit_access_token, $regionId, $data);
        }

        echo '1';
        $errors->add('password_reset', __('Your password has been reset.'));
        die();
    }

    if ($errors->get_error_code()) {
		echo '<p class="error">'. $errors->get_error_message( $errors->get_error_code() ) .'</p>';
    }
    die();
}
add_action('wp_ajax_yoga_reset_user_password', 'yoga_reset_user_password');
add_action('wp_ajax_nopriv_yoga_reset_user_password', 'yoga_reset_user_password');
