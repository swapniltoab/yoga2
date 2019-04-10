<?php

/*template name: Zingfit Room Reserve Layout */

get_header();

$regions = get_option('zingfit_regions');
$wpUserId = get_current_user_id();
$zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
$regionId = '811593826090091886';

if ($_GET && $_GET != '') {
    $classId = $_GET['classId'];
}

if ($zingfit_user_access_token) {
    global $zinfit;
    $reserveSpots = $zingfit->getBookableClassDetail($zingfit_user_access_token, $regionId, $classId);
}

if (array_key_exists('error', $reserveSpots) && ($reserveSpots['error'] || $reserveSpots['error'] == 'Not found.')) {?>

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
        <h3><?php echo $reserveSpots['room']['name'] ?></h3>
    </div>
    <hr>

    <div class="row">
        <div class="room-main-img-sec" style="background-image: url(<?php echo $reserveSpots['room']['image'] ?>); width: 100%;height: 500px; background-repeat: no-repeat; position: relative;">
            <?php
            $j = 1;
            $x = 1;
            $i = 0;
            while($i < $reserveSpots['room']['maxSpotCount']) :
                $i++;
                $top = ($j*50)+70;
                $left = ($x*50)+70;
                $x++;
                if($i%17 == 0){
                    $j++;
                    $x = 1;
                }
                ?>
                <a href="javascript:void(0)" class="spot floor-shape js-book-class-spot"
                    id="spotcell<?php echo $reserveSpots['spots'][$i-1]['id'] ?>"
                    data-classid="<?php echo $reserveSpots['classDetails']['id'] ?>"
                    data-spotid="<?php echo $reserveSpots['spots'][$i-1]['id'] ?>"
                    style="top: <?php echo $top ?>px; left: <?php echo $left ?>px;">
                    <span class="spot-num"><?php echo $reserveSpots['spots'][$i-1]['label'] ?></span>
                </a>
            <?php endwhile; ?>
        </div>
    </div>

</div>

<?php
}

get_footer();
?>