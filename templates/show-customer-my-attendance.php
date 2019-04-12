<?php

/*template name: Zingfit Customer My Attendance */

get_header();

$regions = get_option('zingfit_regions');
$wpUserId = get_current_user_id();
$zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
$regionId = '811593826090091886';

if ($zingfit_user_access_token) {
    global $zingfit;
    $customerMyAttendance = $zingfit->getCustomerMyAttendance($zingfit_user_access_token, $regionId);
}

?>

<div class="row page-title-div flex-column" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
        <h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
</div>

<div class="container user-account-container">

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Attendance Id</th>
                <th>Room Name</th>
                <th>Instructor Name</th>
                <th>Class Date</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($customerMyAttendance->content as $key => $attendance){
            $date = date("d M, Y", strtotime($attendance->classDate));
            ?>
            <tr>
                <td><?php echo ($key+1) ?></td>
                <td><?php echo $attendance->attendanceId ?></td>
                <td><?php echo $attendance->roomName ?></td>
                <td><?php echo $attendance->instructorName ?></td>
                <td><?php echo $date ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

<?php
get_footer();
?>