<?php

function zingfit_customer_update()
{

    $formData = $_POST['formData'];
    $param = [];

    foreach ($formData as $data) {
        $param[$data['name']] = $data['value'];
    }

    $password = $param['password'];

    $regions = get_option('zingfit_regions');
    $wpUserId = get_current_user_id();
    $zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
    $regionId = '811593826090091886';

    if ($zingfit_user_access_token) {
        global $zingfit;
        $userdata = $zingfit->updateCustomerInfo($zingfit_user_access_token, $regionId, $param);
    }

    if ($userdata) {
        echo json_encode(array('status' => true, 'message' => $userdata));
        $zingfit->getCustomerData($zingfit_user_access_token, $regionId);
    } else if (array_key_exists('error', $userdata) && $userdata['error']) {
        echo json_encode(array('status' => false, 'message' => $userdata['error']));
    }
    die();

}
add_action('wp_ajax_zingfit_customer_update', 'zingfit_customer_update');
add_action('wp_ajax_nopriv_zingfit_customer_register', 'zingfit_customer_register');


function zingfit_customer_update_wp_user()
{
    $customer = $_POST['userdata'];
    $password = $_POST['password'];

    $user_id = get_current_user_id();
    update_user_meta($user_id, 'zingfit_user_id', $customer['id']);
    update_user_meta($user_id, 'phone', $customer['phone']);
    update_user_meta($user_id, 'address', $customer['address']);
    update_user_meta($user_id, 'city', $customer['city']);
    update_user_meta($user_id, 'state', $customer['state']);
    update_user_meta($user_id, 'zip', $customer['zip']);
    update_user_meta($user_id, 'homeRegion', $customer['homeRegion']);

    if ($user_id) {
        if($password && $password != ''){
            wp_set_password($password, $user_id);
            // wp_set_current_user($user_id);
            // wp_set_auth_cookie($user_id);
        }
        echo json_encode(array('status' => true));
    } else {
        echo json_encode(array('status' => false));
    }
    die();

}
add_action('wp_ajax_zingfit_customer_update_wp_user', 'zingfit_customer_update_wp_user');
add_action('wp_ajax_nopriv_zingfit_customer_register_wp_user', 'zingfit_customer_register_wp_user');
