<?php

/*template name: Zingfit Room Reserve Layout */

if(is_user_logged_in()){
get_header();

$regions = get_option('zingfit_regions');
$zingfit_user_access_token = current_user_zingfit_access_token;
$regionId = '811593826090091886';
$classId = '';
?>

<div class="row page-title-div" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
<h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
</div>

<?php
if ($_GET && !empty($_GET)) {
    $classId = $_GET['classId'];

    if ($zingfit_user_access_token && $classId != '') {
        global $zingfit;
        $reserveSpots = $zingfit->getBookableClassDetail($zingfit_user_access_token, $regionId, $classId);
        $userActiveSerieses = $zingfit->getCustomerMySeriesActive($zingfit_user_access_token, $regionId);
        $myActiveContracts = $zingfit->getCustomerMyContractActive($zingfit_user_access_token, $regionId);
    } else {
        logoutCureentUser();
    }

    $latestExpiringSeries = [];
    $seriesExpiringDates = [];
    $latestExpiringContract = [];
    $contractExpiringDates = [];
    $finalDate = [];
    $seriesKey = 100;
    $customerSeriesId = '';


    if(is_array($myActiveContracts->content) && !empty($myActiveContracts->content)){
        foreach($myActiveContracts->content as $key => $activeContracts){
            $expiringDate = $activeContracts->purchased[0]->expiringDate;
            $contractExpiringDates[] = $expiringDate;
        }

        $key = array_search(min($contractExpiringDates), $contractExpiringDates);
        $latestExpiringContract = $myActiveContracts->content[$key];
        $finalDate[] = $latestExpiringContract->purchased[0]->expiringDate;
    }

    if(is_array($userActiveSerieses->content) && !empty($userActiveSerieses->content)){
        foreach($userActiveSerieses->content as $key => $activeSeriese){
            $expiringDate = $activeSeriese->expiringDate;
            $seriesExpiringDates[] = $expiringDate;
        }

        $key = array_search(min($seriesExpiringDates), $seriesExpiringDates);
        $latestExpiringSeries = $userActiveSerieses->content[$key];
        $finalDate[] = $latestExpiringSeries->expiringDate;
    }

    if(!empty($latestExpiringSeries) || !empty($latestExpiringContract)) {
        $seriesKey = array_search(min($finalDate), $finalDate);
    }

    if($seriesKey != 100) {
        if($seriesKey == 0){
            $customerSeriesId = $latestExpiringSeries->id;
        } else if($seriesKey == 1){
            $customerSeriesId = $latestExpiringContract->purchased[0]->id;
        }
    }

    $date = date("d M, Y", strtotime($reserveSpots['classDetails']['classDate']));
    $time = date("h:i A", strtotime($reserveSpots['classDetails']['classDate']));
    $classType = $reserveSpots['classDetails']['classType'];
    $instructorName = $reserveSpots['classDetails']['instructorName'];

    if ((array_key_exists('error', $reserveSpots) && ($reserveSpots['error'] || $reserveSpots['error'] == 'Not found.')) || $reserveSpots == '') {?>

    <div class="container" style="padding: 50px 20px">
        <div class="row">
            <!-- <h2>Nothing Found. Seems Like invalid Class.</h2> -->
            <h2 class="attendance-cancel-text">We are sorry, booking for this classed is closed, please call the studio <a href="tel:+13123741029" class="attendance-cancel-anchor">+1 312-374-1029</a> ‭for more information.</h2>
        </div>
    </div>

    <?php } else {
    ?>

    <div class="container" style="padding: 50px 20px">

        <div class="row">
            <h3><?php echo $date. ' | '.$time.' | '.$instructorName.' | '.$classType.' | '.$reserveSpots['room']['name']?></h3>
        </div>
        <hr>

        <div class="row spot-book-avail-img-div">
            <img src="<?php echo yoga_uri ?>/images/room/available.png" />
        </div>

        <div class="book-spot-response row hideElement">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <span class="response-message"></span>
        </div>

        <?php if($reserveSpots['room']['name'] == 'Studio 1'){ ?>
        <div class="row studio1-row">
            <div class="room-main-img-sec">
                <div class="slots-wrapper">
                    <?php
                    $count = 0;
                    for($i=0; $i < $reserveSpots['room']['maxSpotCount']; $i++) :
                        if(array_key_exists('spots',$reserveSpots)) :
                            if($i < count($reserveSpots['spots'])) :
                                if($i == 8):
                                    $count++; ?>
                                    <a href="javascript:void(0)" class="spot floor-shape-instructor" >
                                        <span class="spot-instructor"></span>
                                    </a>
                                <?php
                                endif;
                                if($count%17 == 0): ?>
                                <div class="test">
                                <?php endif;
                                ?>
                            <a href="javascript:void(0)" class="spot floor-shape js-book-class-spot spot-<?php echo $reserveSpots['spots'][$i]['status'] ?>"
                                id="spotcell<?php echo $reserveSpots['spots'][$i]['id'] ?>"
                                data-classid="<?php echo $reserveSpots['classDetails']['id'] ?>"
                                data-spotid="<?php echo $reserveSpots['spots'][$i]['id'] ?>"
                                data-seriesId="<?php echo $customerSeriesId ?>" >
                                <span class="spot-num"><?php echo $reserveSpots['spots'][$i]['label'] ?></span>
                            </a>
                            <?php
                            if($count%17 == 16): ?>
                            </div>
                            <?php endif;
                            ?>
                        <?php endif;
                        endif;
                        $count++;
                    endfor; ?>
                </div>
            </div>
        </div>
        <?php } ?>


        <?php if($reserveSpots['room']['name'] == 'Studio 2'){ ?>
        <div class="row studio2-row">
            <div class="room-main-img-sec">
                <div class="slots-wrapper">
                    <?php
                    for($i=0; $i < $reserveSpots['room']['maxSpotCount']; $i++) :
                        if(array_key_exists('spots',$reserveSpots)) :
                            if($i < count($reserveSpots['spots'])) :
                            if($i%8 == 0): ?>
                            <div class="test">
                            <?php endif;
                            ?>
                        <a href="javascript:void(0)" class="spot floor-shape js-book-class-spot spot-<?php echo $reserveSpots['spots'][$i]['status'] ?>"
                            id="spotcell<?php echo $reserveSpots['spots'][$i]['id'] ?>"
                            data-classid="<?php echo $reserveSpots['classDetails']['id'] ?>"
                            data-spotid="<?php echo $reserveSpots['spots'][$i]['id'] ?>"
                            data-seriesId="<?php echo $customerSeriesId ?>" >
                            <span class="spot-num"><?php echo $reserveSpots['spots'][$i]['label'] ?></span>
                        </a>
                        <?php
                        if($i%8 == 7): ?>
                        </div>
                        <?php endif;
                        ?>
                    <?php endif;
                        endif;
                        endfor; ?>
                </div>
            </div>
        </div>
        <?php } ?>



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