<?php

/*template name: Zingfit Spot Failed */

session_start();
if($_SESSION['spot_book'] != true){

get_header(); ?>

<div class="row page-title-div" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
<h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
</div>

<?php

$message = $_SESSION['spot_book_message'];
$status = $_SESSION['spot_book_status'];

$html = '';
$html .= '<div class="p-5 text-center">';

if($status == false){
    $html .= '<h2>'.$message.' </h2>';
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