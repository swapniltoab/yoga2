<?php

/*template name: Zingfit Add Card Update */

get_header();

$regions = get_option('zingfit_regions');
$wpUserId = get_current_user_id();
$zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
$regionId = '811593826090091886';

if ($_POST && $_POST != '') {
    $info = [
        "gatewayId" => $_POST['gatewayId'],
        "zip" => $_POST['zip'],
        "firstName" => $_POST['firstName'],
        "lastName" => $_POST['lastName'],
        "address" => $_POST['address'],
        "saveCard" => true,                 //$_POST['saveCard'],
        "token" => $_POST['stripeToken']
    ];

    if ($zingfit_user_access_token) {
        global $zingfit;
        $cardInfo = $zingfit->saveCustomerCreditCard($zingfit_user_access_token, $regionId, $info);
    }

    // error_log('$info ..'.print_r($cardInfo,1));
    // if ($cardInfo['error'] || $cardInfo['error'] == 'Not found.') {
    //     echo '<h2>Failed to save card! Please try again.</h2>';
    // } else {
    //     echo '<h2>Successfull saved card!.</h2>';
    // }

} else{
    echo '<h2>Access Denied.</h2>';
}

get_footer();
?>