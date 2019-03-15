<?php

function zingfit_customer_register()
{

    $formData = $_POST['formData'];
    //print_r($formData);exit;
    //$formData = json_decode($formData);

    $param = [];
    // foreach (explode('&', $formData) as $chunk) {
    //     $data = explode("=", $chunk);

    //     if ($data) {
    //         $param[$data[0]] = $data[1];
    //        // printf("Value for parameter \"%s\" is \"%s\"<br/>\n", urldecode($param[0]), urldecode($param[1]));
    //     }
    // }

    foreach ($formData as $data) {
        $param[$data['name']] = $data['value'];
    }

    $param['agreeTerms'] = isset($param['agreeTerms']) ? true : false;
    $month = $param['selectMonth'];
    $date = $param['selectDate'];
    $year = $param['selectYear'];
    $password = $param['password'];
    $birthDate = $year . '-' . $month . '-' . $date . 'T00:00';
    $param['birthDate'] = isset($param['birthDate']) ? $birthDate : "";

    global $zingfit;
    $response = $zingfit->getAuthenticate();

    $zingfit_access_token = get_transient('zingfit_access_token');

    $args = array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $zingfit_access_token,
            'Content-Type' => 'application/json;charset=UTF-8',
            'X-ZINGFIT-REGION-ID' => '811593826090091886',
        ),
        'body' => json_encode($param),
    );

    $response = wp_remote_post('https://api.zingfit.com/account', $args);
    $userdata = json_decode($response['body']);
    // error_log(print_r($response,1));

    if ($userdata) {
        echo json_encode(array('status' => true, 'userdata' => $userdata, 'response_code' => $response['response']['code']));
    } else if ($response['error']) {
        echo json_encode(array('status' => false, 'error' => $response['error'], 'error_description' => $response['error_description']));
    }
    die();

}
add_action('wp_ajax_zingfit_customer_register', 'zingfit_customer_register');
add_action('wp_ajax_nopriv_zingfit_customer_register', 'zingfit_customer_register');

function zingfit_customer_register_wp_user()
{
    $userdata = $_POST['userdata'];
    $password = $_POST['password'];

    $customer = $userdata['customer'];

    $user_id = wp_insert_user(
        array(
            'user_login' => $customer['username'],
            'user_email' => $customer['username'],
            'user_pass' => $password,
            'first_name' => $customer['firstName'],
            'last_name' => $customer['lastName'],
        )
    );

// print_r($user_id);

    $agreed = isset($customer['agreeTerms']) ? true : false;

    update_user_meta($user_id, 'zingfit_user_id', $customer['id']);
    update_user_meta($user_id, 'phone', $customer['phone']);
    update_user_meta($user_id, 'address', $customer['address']);
    update_user_meta($user_id, 'city', $customer['city']);
    update_user_meta($user_id, 'state', $customer['state']);
    update_user_meta($user_id, 'zip', $customer['zip']);
    update_user_meta($user_id, 'agreeTerms', $agreed);
    update_user_meta($user_id, 'homeRegion', $customer['homeRegion']);
    // update_user_meta( $user_id, 'region', $birthDate);

    if ($user_id) {
        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id);
    }

    if ($user_id) {
        echo json_encode(array('status' => true));
    } else {
        echo json_encode(array('status' => false));
    }
    die();

}

add_action('wp_ajax_zingfit_customer_register_wp_user', 'zingfit_customer_register_wp_user');
add_action('wp_ajax_nopriv_zingfit_customer_register_wp_user', 'zingfit_customer_register_wp_user');
