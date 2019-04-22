<?php

/*template name: Zingfit Spot Confirm */

session_start();
if($_SESSION['spot_book'] == true){

get_header(); ?>

<div class="row page-title-div" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
<h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
</div>

<?php

$message = $_SESSION['spot_book_message'];
$status = $_SESSION['spot_book_status'];

$html = '';
$html .= '<div class="p-5 text-center">';

if($status == true){

    $spotId = $_SESSION['spot_book_spotId'];
    $zingfit_access_token = get_transient('zingfit_access_token');
    $regionId = '811593826090091886';
    $classId = $message->classId;
    global $zingfit;
    $classInfo = $zingfit->getClassInfo($zingfit_access_token, $regionId, $classId);
    $classDateTime = date("d M, Y h:i A", strtotime($classInfo->classDate));

    $html .= '<h2>Successfully booked your spot! <br> Your Spot Id is:'.$spotId.' <br> on '.$classDateTime.' by '.$classInfo->instructorName.' of type '.$classInfo->classType.'</h2>';
    $html .= '<a href="/account" class="btn mt-5 yoga-btn">BACK TO ACCOUNT</a>';
} else {
    $html .= '<h2>Error! '.$message.' </h2>';
    $html .= '<a href="/account" class="btn mt-5 yoga-btn">BACK TO ACCOUNT</a>';
}

$html .= '</div>';
echo $html;

get_footer();

session_unset();
session_destroy();

} else {
    $url = home_url();
    wp_redirect($url.'/account/');
    exit;
}
?>