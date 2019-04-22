<?php

function zingfit_book_slot()
{

    $classId = $_POST['classId'];
    $spotId = $_POST['spotId'];
    $seriesId = $_POST['seriesId'];

    $regions = get_option('zingfit_regions');
    $wpUserId = get_current_user_id();
    $zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
    $regionId = '811593826090091886';

    if ($zingfit_user_access_token) {
        global $zingfit;
        $bookSpot = $zingfit->customerBookSpot($zingfit_user_access_token, $regionId, $classId, $spotId, $seriesId);
    }

    session_start();
    $_SESSION['spot_book'] = true;

    if(isset($bookSpot->error) && $bookSpot->code != '200'){

        $_SESSION['spot_book_status'] = false;
        $_SESSION['spot_book_message'] = $bookSpot->error;
        echo json_encode([
            'status' => false,
            'message' => $bookSpot->error
        ]);
    } else {

        $_SESSION['spot_book_status'] = true;
        $_SESSION['spot_book_message'] = $bookSpot;
        $_SESSION['spot_book_spotId'] = $spotId;
        echo json_encode([
            'status' => true,
            'message' => $bookSpot
        ]);
    }

    die();
}
add_action('wp_ajax_zingfit_book_slot', 'zingfit_book_slot');
add_action('wp_ajax_nopriv_zingfit_book_slot', 'zingfit_book_slot');
