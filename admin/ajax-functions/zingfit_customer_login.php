<?php

function zingfit_customer_login()
{

    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) && !empty($_POST['remember']) ? true : false;

    $creds = array();
    $creds['user_login'] = $username;
    $creds['user_password'] = $password;
    $creds['remember'] = $remember;
    $user = wp_signon( $creds, false );

    if ($user->ID) {
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);
    }

    global $zingfit;
    $wpUserId = $user->ID;
    $zingfit->getUserAuthenticate($username, $password, $wpUserId);

    if (is_wp_error($user)) {
        echo json_encode(array('status' => false, 'error' => $user->get_error_message()));
    } else{
        echo json_encode(array('status' => true));
    }
    die();

}
add_action('wp_ajax_zingfit_customer_login', 'zingfit_customer_login');
add_action('wp_ajax_nopriv_zingfit_customer_login', 'zingfit_customer_login');
