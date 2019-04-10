<?php

/*template name: Zingfit Charge Card */

get_header();

$regions = get_option('zingfit_regions');
$wpUserId = get_current_user_id();
$zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
$regionId = '811593826090091886';

if ($_POST && $_POST != '') {
    $orderId = $_POST['orderId'];
    $checkoutInfo = [
        "zip" => $_POST['zip'],
        "firstName" => $_POST['firstName'],
        "lastName" => $_POST['lastName'],
        "address" => $_POST['address'],
        "saveCard" => true,                 //$_POST['saveCard'],
        "token" => $_POST['stripeToken']
    ];

    if ($zingfit_user_access_token) {
        global $zingfit;
        $orderInfo = $zingfit->chargeCreditCard($zingfit_user_access_token, $regionId, $orderId, $checkoutInfo);
    }

    if ($orderInfo['error'] || $orderInfo['error'] == 'Not found.') {
        echo '<h2>Failed to make payment! Please try again.</h2>';
    } else {
        echo '<h2>Transaction successfull! Your order Id is:'.$orderInfo["id"].' <br> and total amount paid is '.$orderInfo["total"]["amount"].' '.$orderInfo["total"]["currency"].'</h2>';
    }

} else{
    echo '<h2>Access Denied.</h2>';
}

get_footer();
?>