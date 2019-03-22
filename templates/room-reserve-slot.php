<?php

/*template name: Zingfit Room Reserve Layout */

get_header();

$regions = get_option('zingfit_regions');
$zingfit_access_token = get_transient('zingfit_access_token');
$regionId = '811593826090091886';

if ($_GET && $_GET != '') {
    $roomId = $_GET['roomId'];
}

if ($zingfit_access_token) {
    global $zinfit;
    $reserveSpots = $zingfit->getRoomReserveSlots($zingfit_access_token, $regionId, $roomId);
}

if ($reserveSpots['error'] && $reserveSpots['error'] == 'Not found.') {?>

<div class="container" style="padding: 50px 20px">

    <div class="row">
        <h2>Nothing Found</h2>
    </div>
    <hr>

</div>

<?php } else {
    ?>

<div class="container" style="padding: 50px 20px">

    <div class="row">
        <h2>Reserve</h2>
    </div>
    <hr>

    <div class="row">
        <h3><?php echo $reserveSpots['name'] ?></h3>
    </div>
    <hr>

    <div class="row">
        <div class="room-main-img-sec" style="background-image: url(<?php echo $reserveSpots['image'] ?>); width: 100%;height: 500px; background-repeat: no-repeat; position: relative;">
            <?php
            $j = 1;
            $x = 1;
            for($i = 1; $i<=$reserveSpots['maxSpotCount']; $i++):
                $top = ($j*80)+50;
                $left = ($x*80)+50;
                $x++;
                if($i%10 == 0){
                    $j++;
                    $x = 1;
                }
                ?>
                <a href="#" class="spot floor-shape" id="spotcell<?php echo $i ?>" style="top: <?php echo $top ?>px; left: <?php echo $left ?>px;">
                    <span class="spot-num"><?php echo $i ?></span>
                </a>
            <?php endfor; ?>
        </div>
    </div>

</div>

<?php
}

get_footer();
?>