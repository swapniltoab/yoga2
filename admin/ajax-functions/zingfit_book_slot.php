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

        $customErrorMsgs = [
            'NO_SERIES' => 'You need to purchase a class in order to reserve a mat, <a href="/purchase/">click here</a>.',
            'SPOT_UNAVAILABLE' => 'That mat is no longer available, please select another one.',
            'OVER_LIMIT' => 'You already have a mat reserved for this class, to change mat location please call the studio.',
            'SERIES_LIMIT' => 'You need to purchase a class in order to reserve a mat, <a href="/purchase/">click here</a>.',
            'CLASS_FULL' => 'This class is now currently full, please choose a different class',
            'NOT_BOOKABLE' => 'You are no longer able to reserve a mat for this class',
            'SERIES_SCHEDULED_FOR_FREEZE' => 'You are no longer able to reserve a mat for this class'
        ];
        $errorMsg = '';

        if(array_key_exists($bookSpot->error, $customErrorMsgs)){
            $errorMsg = $customErrorMsgs[$bookSpot->error];
        } else {
            $errorMsg = $bookSpot->error;
        }

        // $_SESSION['spot_book_status'] = false;
        // $_SESSION['spot_book_message'] = $errorMsg;
        echo json_encode([
            'status' => false,
            'message' => $errorMsg
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
