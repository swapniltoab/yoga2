<?php

function yoga_user_forget_pass()
{
    $email = $_POST['email'];

    $user_data = get_user_by('email', trim($email));
    if (empty($user_data)) {
        echo json_encode(array('status' => false, 'message' => __('You do not have account. Please Sign Up!')));
        die();
    } else {
        $user_login = $user_data->user_login;
        $user_name = $user_data->first_name;
        $user_email = $user_data->user_email;
        $key = get_password_reset_key($user_data);

        $data = [
            'username' => $email
        ];

        $regionId = '811593826090091886';
        $zingfit_access_token = get_transient('zingfit_access_token');

        if ($zingfit_access_token) {
            global $zingfit;
            $customerResponse = $zingfit->forgotCustomerPassword($zingfit_access_token, $regionId, $data);
        }

        if (is_wp_error($key)) {
            return $key;
        }

        $resetc_pass_link = (home_url() . "/reset-password/?action=rp&key=$key&login=" . rawurlencode($user_login));

        $message = 'Here is the link to update your password'.$resetc_pass_link;

        if (wp_mail($user_email, 'Yoga2Point0 - Reset you password', $message)) {
            echo json_encode(array('status' => true, 'message' => __('Please check your email, follow the link and reset your password.')));
        } else {
            echo json_encode(array('status' => false, 'message' => __('Failed sending mail')));
        }
    }
    die();
}
add_action('wp_ajax_yoga_user_forget_pass', 'yoga_user_forget_pass');
add_action('wp_ajax_nopriv_yoga_user_forget_pass', 'yoga_user_forget_pass');
