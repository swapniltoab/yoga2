<?php

/*template name: Zingfit Customer My Series */

get_header();

$regions = get_option('zingfit_regions');
$wpUserId = get_current_user_id();
$zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
$regionId = '811593826090091886';

if ($zingfit_user_access_token) {
    global $zingfit;
    $myActiveSerieses = $zingfit->getCustomerMySeriesActive($zingfit_user_access_token, $regionId);
    $myExpiredSerieses = $zingfit->getCustomerMySeriesExpired($zingfit_user_access_token, $regionId);
}

?>

<div class="row page-title-div flex-column" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
        <h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
        <a href="#" class="btn yoga-btn">Buy More Series</a>
</div>

<div class="container user-account-container">

    <div class="row">
        <div class="user-account-header">
            <h3 class="yoga-h3 float-left">My Series (Active)</h3>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Series Name</th>
                <th>Purchase Date</th>
                <th>Expiration Date</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($myActiveSerieses->content as $key => $activeSeriese){
            $purchaseDate = date("d M, Y", strtotime($activeSeriese->purchaseDate));
            $expiringDate = date("d M, Y", strtotime($activeSeriese->expiringDate));
            ?>
            <tr>
                <td><?php echo ($key+1) ?></td>
                <td><?php echo $activeSeriese->seriesName ?></td>
                <td><?php echo $purchaseDate ?></td>
                <td><?php echo $expiringDate ?></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>

    <div class="row">

        <div class="user-account-header">
            <h3 class="yoga-h3 float-left">My Series (Expired)</h3>
        </div>

    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Series Name</th>
                <th>Purchase Date</th>
                <th>Expiration Date</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($myExpiredSerieses->content as $key => $expiredSeriese){
            $purchaseDate = date("d M, Y", strtotime($expiredSeriese->purchaseDate));
            $expiredDate = date("d M, Y", strtotime($expiredSeriese->expiredDate));
            ?>
            <tr>
                <td><?php echo ($key+1) ?></td>
                <td><?php echo $expiredSeriese->seriesName ?></td>
                <td><?php echo $purchaseDate ?></td>
                <td><?php echo $expiredDate ?></td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>

</div>

<?php
get_footer();
?>