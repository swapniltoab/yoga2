<?php

function zingfit_book_slot()
{

    $classId = $_POST['classId'];

    $data = [
        'spotId' => $_POST['spotId'],
        'seriesItemId' => $_POST['seriesId']
    ];


    $regions = get_option('zingfit_regions');
    $wpUserId = get_current_user_id();
    $zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
    $regionId = '811593826090091886';

    if ($zingfit_user_access_token) {
        global $zingfit;
        $bookSpot = $zingfit->customerBookSpot($zingfit_user_access_token, $regionId, $classId, $data);
    }


    echo json_encode([
        'response' => $bookSpot
    ]);
    // if (is_wp_error($user)) {
    //     echo json_encode(array('status' => false, 'error' => $user->get_error_message()));
    // } else{
    //     echo json_encode(array('status' => true));
    // }
    die();

}
add_action('wp_ajax_zingfit_book_slot', 'zingfit_book_slot');
add_action('wp_ajax_nopriv_zingfit_book_slot', 'zingfit_book_slot');
