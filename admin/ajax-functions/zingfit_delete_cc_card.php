<?php

function zingfit_delete_cc_card()
{

    $cardId = $_POST['cardId'];

    $wpUserId = get_current_user_id();
    $zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
    $regionId = '811593826090091886';
    $deleteCard = 'False';

    if ($zingfit_user_access_token) {
        global $zingfit;
        $deleteCard = $zingfit->deleteCustomerCard($zingfit_user_access_token, $regionId, $cardId);
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
