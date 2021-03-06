<?php

/*template name: Zingfit Charge Card */

if(is_user_logged_in()){

get_header(); ?>

<div class="row page-title-div" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
<h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
</div>

<?php
$regions = get_option('zingfit_regions');
$zingfit_user_access_token = current_user_zingfit_access_token;
$regionId = '811593826090091886';
$html = '';

$html .= '<div class="p-5 text-center">';

if ($_POST && !empty($_POST)) {


    if(array_key_exists('radioSelectedCardId',$_POST) && $_POST['radioSelectedCardId'] != ''){


        $orderId = $_POST['orderId'];
        $cardOnFileId = [
            "cardId" => $_POST['radioSelectedCardId'],
        ];

        if ($zingfit_user_access_token) {
            global $zingfit;
            $orderInfo = $zingfit->chargeCardOnFile($zingfit_user_access_token, $regionId, $orderId, $cardOnFileId);
        } else {
            logoutCureentUser();
        }

    } else if(array_key_exists('stripeToken',$_POST) && $_POST['stripeToken'] != ''){

        $orderId = $_POST['orderId'];
        $checkoutInfo = [
            "zip" => $_POST['zip'],
            "firstName" => $_POST['firstName'],
            "lastName" => $_POST['lastName'],
            "address" => $_POST['address'],
            "saveCard" => false,
            "token" => $_POST['stripeToken']
        ];

        if ($zingfit_user_access_token) {
            global $zingfit;
            $orderInfo = $zingfit->chargeCreditCard($zingfit_user_access_token, $regionId, $orderId, $checkoutInfo);
        } else {
            logoutCureentUser();
        }

    }

    if ($orderInfo['error'] || $orderInfo['error'] == 'Not found.') {
        $html .= '<h2>Failed to make payment! Please try again.</h2>';
    } else {
        $html .= '<h2>Transaction successfull! Your order Id is:'.$orderInfo["id"].' <br> and total amount paid is '.$orderInfo["total"]["amount"].' '.$orderInfo["total"]["currency"].'</h2>';
    }

} else{
    $html .= '<h2>Access Denied</h2>';
}
    $html .= '<a href="/account" class="btn mt-5 yoga-btn">BACK TO ACCOUNT</a>';
    $html .= '</div>';
    echo $html;

get_footer();
} else {
    $url = home_url();
    wp_redirect($url.'/register/');
    exit;
}
?>