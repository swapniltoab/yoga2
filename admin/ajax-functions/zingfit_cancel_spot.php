<?php

function zingfit_cancel_spot()
{

    $attendanceId = $_POST['attendanceId'];
    $classDetail = $_POST['classDetail'];

    $zingfit_user_access_token = current_user_zingfit_access_token;
    $regionId = '811593826090091886';
    $cancelAttendanceSpot = false;

    if ($zingfit_user_access_token) {
        global $zingfit;
        $cancelAttendanceSpot = $zingfit->cancelCustomerAttendanceSpot($zingfit_user_access_token, $regionId, $attendanceId);
    } else {
        logoutCureentUser();
    }

    if (!empty($cancelAttendanceSpot) && $cancelAttendanceSpot['response']['code'] == '204') {
        echo json_encode(array('message' => 'Your spot for <b>'.$classDetail.'</b> has been successfully canceled'));
    } else{
        echo json_encode(array('message' => $cancelAttendanceSpot['body']->error));
    }
    die();

}
add_action('wp_ajax_zingfit_cancel_spot', 'zingfit_cancel_spot');
add_action('wp_ajax_nopriv_zingfit_cancel_spot', 'zingfit_cancel_spot');
