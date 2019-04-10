<?php

/*template name: Zingfit Customer My Attendance */

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

<div class="container user-account-container">

    <div class="row">

        <div class="user-account-header">
            <h3 class="yoga-h3 float-left">My Series (Active)</h3>
        </div>

    </div>

    <div class="div-table">

        <div class="div-table-row">
            <div class="div-table-col" align="center">Series Name</div>
            <div  class="div-table-col">Purchase Date</div>
            <div  class="div-table-col">Expiration Date</div>
        </div>

        <?php foreach($myActiveSerieses->content as $key => $activeSeriese){
            $purchaseDate = date("d M, Y", strtotime($activeSeriese->purchaseDate));
            $expiringDate = date("d M, Y", strtotime($activeSeriese->expiringDate));
            ?>
            <div class="div-table-row">
                <div class="div-table-col"><?php echo $activeSeriese->seriesName ?></div>
                <div class="div-table-col"><?php echo $purchaseDate ?></div>
                <div class="div-table-col"><?php echo $expiringDate ?></div>
            </div>
        <?php }?>

    </div>

    <hr>

    <div class="row">

        <div class="user-account-header">
            <h3 class="yoga-h3 float-left">My Series (Expired)</h3>
        </div>

    </div>

    <div class="div-table">

        <div class="div-table-row">
            <div class="div-table-col" align="center">Series Name</div>
            <div  class="div-table-col">Purchase Date</div>
            <div  class="div-table-col">Expiration Date</div>
        </div>

        <?php foreach($myExpiredSerieses->content as $key => $expiredSeriese){
            $purchaseDate = date("d M, Y", strtotime($expiredSeriese->purchaseDate));
            $expiredDate = date("d M, Y", strtotime($expiredSeriese->expiredDate));
            ?>
            <div class="div-table-row">
                <div class="div-table-col"><?php echo $expiredSeriese->seriesName ?></div>
                <div class="div-table-col"><?php echo $purchaseDate ?></div>
                <div class="div-table-col"><?php echo $expiredDate ?></div>
            </div>
        <?php }?>

    </div>


</div>

<?php
get_footer();
?>