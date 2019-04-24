<?php

/*template name: Zingfit series */

get_header();?>

<div class="row page-title-div" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
<h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
</div>

<?php $regions = get_option('zingfit_regions');
$zingfit_access_token = get_transient('zingfit_access_token');
$regionId = '811593826090091886';

if ($zingfit_access_token) {
    global $zingfit;
    $serieses = $zingfit->getSeries($zingfit_access_token, $regionId);
}

?>

<div class="container desktop-series" style="padding: 50px 20px">

    <?php foreach($serieses as $series):
        $currency = $series['price']['currency'] == 'USD' ? '$' : $series['price']['currency'];?>
    <div class="row show-series">
        <div class="col-md-6 series-info">
            <h2><?php echo $series['name'] ?></h2>
            <span><?php echo $series['description'] ?></span>
        </div>

        <div class="col-md-3 series-price">
            <span><?php echo $currency . $series['price']['amount'] ?></span>
        </div>

        <div class="col-md-3 series-button">
            <a href="/checkout/?seriesId=<?php echo $series['id'] ?>" data-series-id="<?php echo $series['id'] ?>" class="btn" >BUY THIS PACKAGE</a>
        </div>
    </div>
    <hr>
    <?php endforeach; ?>

</div>

<div class="container mobile-series" style="padding: 50px 20px">

    <?php foreach($serieses as $series):
        $currency = $series['price']['currency'] == 'USD' ? '$' : $series['price']['currency'];?>
    <div class="row show-series">
        <div class="col-md-6">
            <div class="series-info">
                <h2><?php echo $series['name'] ?></h2>
                <span><?php echo $series['description'] ?></span>
            </div>
            <div class="series-price">
                <span><?php echo $currency . $series['price']['amount'] ?></span>
            </div>
        </div>

        <div class="col-md-3 series-button">
            <a href="/checkout/?seriesId=<?php echo $series['id'] ?>" data-series-id="<?php echo $series['id'] ?>" class="btn" >BUY THIS PACKAGE</a>
        </div>
    </div>
    <hr>
    <?php endforeach; ?>

</div>

<?php
get_footer();
?>