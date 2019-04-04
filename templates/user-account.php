<?php

/*template name: Zingfit User Account */

get_header();

$regions = get_option('zingfit_regions');
$wpUserId = get_current_user_id();
$zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
$regionId = '811593826090091886';

if ($zingfit_user_access_token) {
    global $zinfit;
    $seriesOrderId = $zingfit->getCustomerData($zingfit_user_access_token, $regionId);
}

$currentUserID = get_current_user_id();
$currentUserData = get_user_meta($currentUserID, 'zingfit_customer_data', true);

$currentUserDataMyInfo = [
                    'Name' => $currentUserData['firstName'].' '.$currentUserData['lastName'],
                    'Address' => $currentUserData['address'],
                    'Phone' => $currentUserData['phone'],
                    'Email' => $currentUserData['username']
                ];

$currentUserDataBillingInfo = [
                    'First Name' => $currentUserData['firstName'],
                    'Last Name' => $currentUserData['lastName'],
                    'Address' => $currentUserData['billingAddress'],
                    'ZIP' => $currentUserData['billingZip']
                ];
?>

<div class="container user-account-container">

    <div class="row">

        <div class="user-account-header">
            <h3 class="yoga-h3 float-left">My Info</h3>
            <span class="yoga-span float-right">
                <a href="/account/edit/" class="yoga-a js-edit-user-info">eidt info</a>
            </span>
        </div>

    </div>

    <div class="row">

        <div class="user-account-body">

            <div class="col-md-3">
                <?php foreach($currentUserDataMyInfo as $key => $currentUser) :
                    if($currentUser) : ?>
                    <label class="user-account-left-label"><?php echo $key ?>: </label>
                <?php
                endif;
                endforeach;?>
            </div>

            <div class="col-md-9">
                <?php foreach($currentUserDataMyInfo as $key => $currentUser) :
                    if($currentUser) : ?>
                    <label class="user-account-right-label"><?php echo $currentUser ?></label>
                <?php
                endif;
                endforeach;?>
            </div>

        </div>

    </div>

    <div class="row">

        <div class="user-account-header">
            <h3 class="yoga-h3 float-left">Billing Info</h3>
        </div>

    </div>

    <div class="row">

        <div class="user-account-body">

            <div class="col-md-3">
                <?php foreach($currentUserDataBillingInfo as $key => $currentUserBillingInfo) :
                    if($currentUserBillingInfo) : ?>
                    <label class="user-account-left-label"><?php echo $key ?>: </label>
                <?php
                endif;
                endforeach;?>
            </div>

            <div class="col-md-9">
                <?php foreach($currentUserDataBillingInfo as $key => $currentUserBillingInfo) :
                    if($currentUserBillingInfo) : ?>
                    <label class="user-account-right-label"><?php echo $currentUserBillingInfo ?></label>
                <?php
                endif;
                endforeach;?>
            </div>

        </div>

    </div>

</div>

<?php
get_footer();
?>