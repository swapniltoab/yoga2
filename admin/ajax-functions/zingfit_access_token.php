<?php

function zingfit_generate_access_token()
{
    global $zingfit;
    $response = $zingfit->getAuthenticate();

    if ($response['access_token']) {
        echo json_encode(array('status' => true, 'access_token' => $response['access_token'], 'expires_in' => $response['expires_in']));
    } else if ($response['error']){
        echo json_encode(array('status' => false, 'error' => $response['error'], 'error_description' => $response['error_description']));
    }
    die();
}
add_action('wp_ajax_zingfit_generate_access_token', 'zingfit_generate_access_token');