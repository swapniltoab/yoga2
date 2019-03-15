<?php

/*template name: Zingfit series */

get_header();

$regions = get_option('zingfit_regions');

$zingfit_access_token = get_transient('zingfit_access_token');

$args = array(
    'headers' => array(
        'Authorization' => 'Bearer ' . $zingfit_access_token,
        'X-ZINGFIT-REGION-ID' => '811593826090091886',
    )
);
$url = 'https://api.zingfit.com/series';

$response = wp_remote_get($url,$args);

$serieses = json_decode(wp_remote_retrieve_body($response), true);

?>

<div class="container" style="padding: 50px 20px">

    <div class="row">
        <select>
            <option value="">Select Rigion</option>
            <?php foreach($regions as $region): ?>
                <option value="<?php echo $region['id'] ?>"><?php echo $region['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <hr>

    <!-- <div class="row"> -->

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
                <a href="javascript:void(0)" data-series-id="<?php echo $series['id'] ?>" class="btn" >Buy This Series</a>
            </div>
        </div>
        <hr>
        <?php endforeach; ?>

    <!-- </div> -->

</div>

<?php
get_footer();
?>