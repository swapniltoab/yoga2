<?php

/*template name: Zingfit User Account */

if(is_user_logged_in()){

get_header(); ?>

<div class="row page-title-div flex-column" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
<h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
<div class="yoga-divider"></div>
</div>

<?php $regions = get_option('zingfit_regions');
$wpUserId = get_current_user_id();
$zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
$regionId = '811593826090091886';
$userCardsData = '';

if ($zingfit_user_access_token) {
    global $zingfit;
    $customerData = $zingfit->getCustomerData($zingfit_user_access_token, $regionId);
    $userCardsData = $zingfit->getCustomerCardsOfFile($zingfit_user_access_token, $regionId);
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
        <div class="header-btn-wrapper">
            <a href="/the-warriors-way" class="btn yoga-btn">Exclusive content</a>
            <a href="/account/my-series" class="btn yoga-btn">My PACKAGES</a>
            <a href="/account/my-attendance" class="btn yoga-btn">My Attendance</a>
            <a href="/calendar/" class="btn yoga-btn">Reserve a Space</a>
        </div>
    </div>

    <div class="row">

        <div class="user-account-header">
            <h3 class="yoga-h3 float-left">My Info</h3>
            <span class="yoga-span float-right">
                <a href="/account/edit/" class="yoga-a js-edit-user-info">edit info</a>
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

    <div class="row">

        <div class="user-account-header">
            <h3 class="yoga-h3 float-left">Cards On File</h3>
            <span class="yoga-span float-right">
                <a href="/account/addcard" class="yoga-a js-edit-user-info">Add New Card</a>
            </span>
        </div>

    </div>


    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>TYPE</th>
                <th>NUMBER</th>
                <th>EXPIRATION</th>
                <th>ACTION</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($userCardsData as $key => $Card){
                $strDate = strtotime($Card->expiration);
                $date = date('m/y',$strDate);
            ?>
            <tr>
                <td><?php echo ($key+1) ?></td>
                <td><?php echo $Card->cardType ?></td>
                <td><?php echo $Card->lastFour ?></td>
                <td><?php echo $date ?></td>
                <td><a href="javscript:void(0)" class="js-delete-cc-card" data-cardId="<?php echo $Card->id ?>">Delete Card</a></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>

</div>

<?php
get_footer();
} else {
    $url = home_url();
    wp_redirect($url.'/register/');
    exit;
}
?>