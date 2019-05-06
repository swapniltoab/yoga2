<?php

/*template name: Zingfit Add Card Update */

get_header();
?>

<div class="row page-title-div" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
<h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
</div>

<?php
$regions = get_option('zingfit_regions');
$zingfit_user_access_token = current_user_zingfit_access_token;
$regionId = '811593826090091886';

$html = '';
$html .= '<div class="p-5 text-center">';

if ($_POST && $_POST != '') {
    $info = [
        "gatewayId" => $_POST['gatewayId'],
        "zip" => $_POST['zip'],
        "firstName" => $_POST['firstName'],
        "lastName" => $_POST['lastName'],
        "address" => $_POST['billingAddress'],
        "token" => $_POST['stripeToken']
    ];

    if ($zingfit_user_access_token) {
        global $zingfit;
        $cardInfo = $zingfit->saveCustomerCreditCard($zingfit_user_access_token, $regionId, $info);
    } else {
        logoutCureentUser();
    }

    if ($cardInfo['error'] || $cardInfo['error'] == 'Not found.') {
        $html .= '<h2>Failed to save your card! Please try again.</h2>';
    } else {
        $html .= '<h2>Your card is added successfully!.</h2>';
    }

} else{
    $html .= '<h2>Access Denied</h2>';
}

    $html .= '<a href="/account" class="btn mt-5 yoga-btn">BACK TO ACCOUNT</a>';
    $html .= '</div>';
    echo $html;

get_footer();
?>