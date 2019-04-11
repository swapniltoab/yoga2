<?php

function zingfit_customer_login()
{

    $username = $_POST['username'];
    $password = $_POST['password'];

    $creds = array();
	$creds['user_login'] = $username;
	$creds['user_password'] = $password;
	//$creds['remember'] = true;
    $user = wp_signon( $creds, false );

    global $zingfit;
    $wpUserId = $user->ID;
    // $is_zingfit_customer_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
    // if (false === $is_zingfit_customer_access_token) {
        $zingfit->getUserAuthenticate($username, $password, $wpUserId);
    // }

    if (is_wp_error($user)) {
        echo json_encode(array('status' => false, 'error' => $user->get_error_message()));
    } else{
        echo json_encode(array('status' => true));
    }
    die();

}
add_action('wp_ajax_zingfit_customer_login', 'zingfit_customer_login');
add_action('wp_ajax_nopriv_zingfit_customer_login', 'zingfit_customer_login');
