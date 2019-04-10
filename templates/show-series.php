<?php

/*template name: Zingfit series */

get_header();

$regions = get_option('zingfit_regions');
$zingfit_access_token = get_transient('zingfit_access_token');
$regionId = '811593826090091886';

if ($zingfit_access_token) {
    global $zingfit;
    $serieses = $zingfit->getSeries($zingfit_access_token, $regionId);
}
?>

<div class="container" style="padding: 50px 20px">

    <?php foreach($serieses as $series): ?>
    <div class="row">
        <div class="col-md-6">
            <h2><?php echo $series['name'] ?></h2>
            <span><?php echo $series['description'] ?></span>
        </div>

        <div class="col-md-3">
            <span><?php echo $series['price']['amount'] ?> <?php echo $series['price']['currency'] ?></span>
        </div>

        <div class="col-md-3">
            <a href="/checkout/?seriesId=<?php echo $series['id'] ?>" data-series-id="<?php echo $series['id'] ?>" class="btn" >Buy This Series</a>
        </div>
    </div>
    <hr>
    <?php endforeach; ?>

</div>

<?php
get_footer();
?>