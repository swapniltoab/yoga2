<?php

/*template name: Zingfit Customer My Attendance */

if(is_user_logged_in()){

get_header();

$regions = get_option('zingfit_regions');
$zingfit_user_access_token = current_user_zingfit_access_token;
$regionId = '811593826090091886';

if ($zingfit_user_access_token) {
    global $zingfit;
    $customerMyAttendance = $zingfit->getCustomerMyAttendance($zingfit_user_access_token, $regionId);
} else {
    logoutCureentUser();
}

?>

<div class="row page-title-div flex-column" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
        <h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
</div>

<div class="container user-account-container">

    <div class="row attendance-cancel-sec">
        <h3 class="attendance-cancel-text">To cancel your class spot please call the studio at least 12 hours prior to the scheduled class time at <a href="tel:7735583396" class="attendance-cancel-anchor">773.558.3396</a>.</h3>
    </div>

    <div class="cancel-attendace-spot-response row hideElement">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <span class="cancel-spot-response-message"></span>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Spot No</th>
                <th>Room Name</th>
                <th>Instructor Name</th>
                <th>Class Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($customerMyAttendance->content as $key => $attendance){
            $date = date("d M, Y h:i A", strtotime($attendance->classDate));
            ?>
            <tr>
                <td><?php echo ($key+1) ?></td>
                <td><?php echo $attendance->spotLabel ?></td>
                <td><?php echo $attendance->roomName ?></td>
                <td><?php echo $attendance->instructorName ?></td>
                <td><?php echo $date ?></td>
                <td><?php echo $attendance->status ?></td>
                <td>
                    <?php if($attendance->cancellable) : ?>
                        <a href="javscript:void(0)"
                            class="js-cancel-spot"
                            data-attendanceId="<?php echo $attendance->attendanceId ?>"
                            data-classDetail="<?php echo $date.' - Mat#'.$attendance->spotLabel.' - '.$attendance->instructorName ?>" >
                            Cancel Spot</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php } ?>
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