<?php

/*template name: Zingfit Customer My Series */

if(is_user_logged_in()){

get_header();

$regions = get_option('zingfit_regions');
$zingfit_user_access_token = current_user_zingfit_access_token;
$regionId = '811593826090091886';

if ($zingfit_user_access_token) {
    global $zingfit;
    $myActiveSerieses = $zingfit->getCustomerMySeriesActive($zingfit_user_access_token, $regionId);
    $myActiveContracts = $zingfit->getCustomerMyContractActive($zingfit_user_access_token, $regionId);
    $myExpiredSerieses = $zingfit->getCustomerMySeriesExpired($zingfit_user_access_token, $regionId);
    logoutCureentUser();
} else {
    logoutCureentUser();
}

?>

<div class="row page-title-div flex-column" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
        <h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
        <a href="/purchase" class="btn yoga-btn">Buy More Packages</a>
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
            <?php
            $count = 0;
            foreach($myActiveSerieses->content as $key => $activeSeriese){
            $purchaseDate = date("d M, Y", strtotime($activeSeriese->purchaseDate));
            $expiringDate = date("d M, Y", strtotime($activeSeriese->expiringDate));
            $count++;
            ?>
            <tr>
                <td><?php echo $count ?></td>
                <td><?php echo $activeSeriese->seriesName ?></td>
                <td><?php echo $purchaseDate ?></td>
                <td><?php echo $expiringDate ?></td>
            </tr>
            <?php }?>

            <?php foreach($myActiveContracts->content as $key => $activeContract){
            $purchaseDate = date("d M, Y", strtotime($activeContract->purchased[0]->purchaseDate));
            $expiringDate = date("d M, Y", strtotime($activeContract->purchased[0]->expiringDate));
            $count++;
            ?>
            <tr>
                <td><?php echo $count ?></td>
                <td><?php echo $activeContract->purchased[0]->seriesName ?></td>
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
} else {
    $url = home_url();
    wp_redirect($url);
    exit;
}
?>