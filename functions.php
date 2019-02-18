<?php
add_action( 'wp_enqueue_scripts', 'yoga_enqueue' );
function yoga_enqueue() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css' );
    wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js', array('jquery'), true );
}

add_action( 'admin_enqueue_scripts', 'yoga_admin_enqueue' );
function yoga_admin_enqueue() {
    wp_enqueue_script( 'admin-setting', get_stylesheet_directory_uri() . '/js/admin-setting.js', array('jquery'), true );

    wp_localize_script('admin-setting', 'zingfit_js_var_admin', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}

include_once get_stylesheet_directory() . '/admin/zingfit-settings/zingfit-settings.php';
new Zingfit_Main_Settings();

include_once get_stylesheet_directory() . '/zingfit/zingfit.class.php';

$settings = get_option("zingfit_api_settings");
$zingfit_client_id = $settings['general']["zingfit_client_id"];
$zingfit_client_secret = $settings['general']["zingfit_client_secret"];
$zingfit_api_url = $settings['general']["zingfit_api_url"];

if($zingfit_client_id && $zingfit_client_secret && $zingfit_api_url) :
    $zingfit = new ZingFit($zingfit_client_id, $zingfit_client_secret, $zingfit_api_url);
endif;

// $zingfit->getRegions();
    // $zingfit->getSites();
    // $zingfit->getClasses();

include_once get_stylesheet_directory() . '/admin/ajax-functions/zingfit_access_token.php';

include_once get_stylesheet_directory() . '/shortcodes/schedule/schedule.shortcode.php';
new ZingFit_Schedule_Shortcode();