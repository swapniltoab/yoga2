<?php

function zingfit_customer_login()
{

    $username = $_POST['username'];
    $password = $_POST['password'];
    // print_r($formData);exit;
   
    $creds = array();
	$creds['user_login'] = $username;
	$creds['user_password'] = $password;
	//$creds['remember'] = true;
	$user = wp_signon( $creds, false );
    
    if (is_wp_error($user)) {
        echo json_encode(array('status' => false, 'error' => $user->get_error_message()));
    } else if ($response['error']){
        echo json_encode(array('status' => true));
    }
    die();

}
add_action('wp_ajax_zingfit_customer_login', 'zingfit_customer_login');
add_action('wp_ajax_nopriv_zingfit_customer_login', 'zingfit_customer_login');
