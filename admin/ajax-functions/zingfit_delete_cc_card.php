<?php

function zingfit_delete_cc_card()
{

    $cardId = $_POST['cardId'];

    $zingfit_user_access_token = current_user_zingfit_access_token;
    $regionId = '811593826090091886';
    $deleteCard = 'False';

    if ($zingfit_user_access_token) {
        global $zingfit;
        $deleteCard = $zingfit->deleteCustomerCard($zingfit_user_access_token, $regionId, $cardId);
    } else {
        logoutCureentUser();
    }

    if ($deleteCard) {
        echo json_encode(array('status' => false, 'error' => 'Something went wrong! Please try again.'));
    } else{
        echo json_encode(array('status' => true));
    }
    die();

}
add_action('wp_ajax_zingfit_delete_cc_card', 'zingfit_delete_cc_card');
add_action('wp_ajax_nopriv_zingfit_delete_cc_card', 'zingfit_delete_cc_card');
