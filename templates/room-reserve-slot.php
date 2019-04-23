<?php

/*template name: Zingfit Room Reserve Layout */

if(is_user_logged_in()){
get_header();

$regions = get_option('zingfit_regions');
$wpUserId = get_current_user_id();
$zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
$regionId = '811593826090091886';
$classId = '';
?>

<div class="row page-title-div" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
<h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
</div>

<?php
if ($_GET && $_GET != '') {
    $classId = $_GET['classId'];

    if ($zingfit_user_access_token && $classId != '') {
        global $zingfit;
        $reserveSpots = $zingfit->getBookableClassDetail($zingfit_user_access_token, $regionId, $classId);
        $userActiveSerieses = $zingfit->getCustomerMySeriesActive($zingfit_user_access_token, $regionId);
    }

    error_log('$reserveSpots ... '.print_r($reserveSpots,1));

    $style = '';
    if($reserveSpots['room']['name'] == 'Studio 2'){
        $style = 'style="margin:10px 33px;"';
    }

    $latestExpiringSeries = [];
    $seriesExpiringDates = [];
    $customerSeriesId = '';

    if(is_array($userActiveSerieses->content) && !empty($userActiveSerieses->content)){
        foreach($userActiveSerieses->content as $key => $activeSeriese){
            $expiringDate = $activeSeriese->expiringDate;
            $seriesExpiringDates[] = $expiringDate;
        }

        $key = array_search(min($seriesExpiringDates), $seriesExpiringDates);
        $latestExpiringSeries = $userActiveSerieses->content[$key];
    }

    if(!empty($latestExpiringSeries)) {
        $customerSeriesId = $latestExpiringSeries->id;
    }

    $date = date("d M, Y", strtotime($reserveSpots['classDetails']['classDate']));
    $time = date("h:i A", strtotime($reserveSpots['classDetails']['classDate']));
    $classType = $reserveSpots['classDetails']['classType'];
    $instructorName = $reserveSpots['classDetails']['instructorName'];

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
            <h3><?php echo $date. ' | '.$time.' | '.$instructorName.' | '.$classType.' | '.$reserveSpots['room']['name']?></h3>
        </div>
        <hr>

        <div class="book-spot-response row hideElement">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <span class="response-message"></span>
        </div>

        <div class="row">
            <div class="room-main-img-sec" style="">
                <div class="slots-wrapper">
                    <?php
                    for($i=0; $i < $reserveSpots['room']['maxSpotCount']; $i++) :
                        if(array_key_exists('spots',$reserveSpots)) :
                            if($i < count($reserveSpots['spots'])) :
                        ?>
                        <a href="javascript:void(0)" class="spot floor-shape js-book-class-spot spot-<?php echo $reserveSpots['spots'][$i]['status'] ?>"
                            id="spotcell<?php echo $reserveSpots['spots'][$i]['id'] ?>"
                            data-classid="<?php echo $reserveSpots['classDetails']['id'] ?>"
                            data-spotid="<?php echo $reserveSpots['spots'][$i]['id'] ?>"
                            data-seriesId="<?php echo $customerSeriesId ?>"
                            <?php echo $style ?>>
                            <span class="spot-num"><?php echo $reserveSpots['spots'][$i]['label'] ?></span>
                        </a>
                    <?php endif;
                        endif;
                        endfor; ?>
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
} else {
    $url = home_url();
    wp_redirect($url.'/register/');
    exit;
}
?>