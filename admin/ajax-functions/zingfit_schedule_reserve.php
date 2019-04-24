<?php

function zingfit_schedule_reserve()
{
    global $zingfit;
    $zingfit_access_token = get_transient('zingfit_access_token');
    $room = $_POST['room'];

    $args = array(
        'headers' => array(
            'Authorization' => 'Bearer ' . $zingfit_access_token,
            'X-ZINGFIT-REGION-ID' => '811593826090091886',
        )
    );
    $url = 'https://api.zingfit.com/rooms/'.$room;

    $response = wp_remote_get($url,$args);
}
add_action('wp_ajax_zingfit_schedule_reserve', 'zingfit_schedule_reserve');