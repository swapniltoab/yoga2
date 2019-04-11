<?php

/*template name: Zingfit Room Reserve Layout */

get_header();

$regions = get_option('zingfit_regions');
$wpUserId = get_current_user_id();
$zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
$regionId = '811593826090091886';
$classId = '';

if ($_GET && $_GET != '') {
    $classId = $_GET['classId'];

    if ($zingfit_user_access_token && $classId != '') {
        global $zingfit;
        $reserveSpots = $zingfit->getBookableClassDetail($zingfit_user_access_token, $regionId, $classId);
        $userActiveSerieses = $zingfit->getCustomerMySeriesActive($zingfit_user_access_token, $regionId);
    }

    $latestExpiringSeries = [];
    $seriesExpiringDates = [];

    foreach($userActiveSerieses->content as $key => $activeSeriese){
        $expiringDate = $activeSeriese->expiringDate;   // date("Y-m-d", strtotime($activeSeriese->expiringDate));
        $seriesExpiringDates[] = $expiringDate;
    }

    $key = array_search(min($seriesExpiringDates), $seriesExpiringDates);
    $latestExpiringSeries = $userActiveSerieses->content[$key];

    if (array_key_exists('error', $reserveSpots) && ($reserveSpots['error'] || $reserveSpots['error'] == 'Not found.')) {?>

    <div class="container" style="padding: 50px 20px">
        <div class="row">
            <h2>Nothing Found. Seems Like invalid Class.</h2>
        </div>
    </div>

    <?php } else {
    ?>

    <div class="container" style="padding: 50px 20px">

        <div class="row">
            <h3><?php echo $reserveSpots['room']['name'] ?></h3>
        </div>
        <hr>

        <div class="row">
            <div class="room-main-img-sec" style="">
                <div class="slots-wrapper">
                    <?php
                    $i = 0;
                    for($i=0; $i < 51; $i++) : ?>
                        <a href="javascript:void(0)" class="spot floor-shape js-book-class-spot spot-<?php echo $reserveSpots['spots'][$i]['status'] ?>"
                            id="spotcell<?php echo $reserveSpots['spots'][$i]['id'] ?>"
                            data-classid="<?php echo $reserveSpots['classDetails']['id'] ?>"
                            data-spotid="<?php echo $reserveSpots['spots'][$i]['id'] ?>"
                            data-seriesId="<?php echo $latestExpiringSeries->seriesId ?>">
                            <span class="spot-num"><?php echo $reserveSpots['spots'][$i]['label'] ?></span>
                        </a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

    </div>

    <?php
    }
} else { ?>

<div class="container" style="padding: 50px 20px">
    <div class="row">
        <h2>Invalid Access to this page.</h2>
    </div>
</div>

<?php
}
get_footer();
?>