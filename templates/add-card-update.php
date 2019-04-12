<?php

/*template name: Zingfit Add Card Update */

get_header();
?>

<div class="row page-title-div" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
<h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
</div>

<?php $regions = get_option('zingfit_regions');
$wpUserId = get_current_user_id();
$zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
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
    }

    if ($cardInfo['error'] || $cardInfo['error'] == 'Not found.') {
        $html .= '<h2>Failed to save card! Please try again.</h2>';
    } else {
        $html .= '<h2>Successfull saved card!.</h2>';
        $html .= '<p>Card Last 4 digits are:</p>'.$cardInfo->lastFour;
        $html .= '<p>and Card Type is:</p>'.$cardInfo->cardType;
    }

} else{
    $html .= '<h2>Access Denied</h2>';
}

    $html .= '<a href="/account" class="btn mt-5 yoga-btn">BACK TO ACCOUNT</a>';
    $html .= '</div>';
    echo $html;

get_footer();
?>