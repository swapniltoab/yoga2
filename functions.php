<?php

define('parent_theme_uri', get_template_directory_uri());
define('yoga_path', get_stylesheet_directory());
define('yoga_uri', get_stylesheet_directory_uri());

add_action( 'wp_enqueue_scripts', 'yoga_enqueue' );
function yoga_enqueue() {
    wp_enqueue_style( 'parent-style', parent_theme_uri . '/style.css' );
    wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
    wp_enqueue_script( 'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array('jquery'), true );
    wp_enqueue_script( 'bootstrapJs', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'), true );
    wp_enqueue_script( 'calender', yoga_uri . '/js/website/calender.js', array('jquery'), true );
    wp_enqueue_script( 'customer-register', yoga_uri . '/js/website/customer-register.js', array('jquery'), true );
    wp_enqueue_script( 'customer-update-account', yoga_uri . '/js/website/customer-update-account.js', array('jquery'), true );
    wp_enqueue_script( 'customer-login', yoga_uri . '/js/website/customer-login.js', array('jquery'), true );
    wp_enqueue_script( 'book-slot', yoga_uri . '/js/website/book-slot.js', array('jquery'), true );
    wp_enqueue_script( 'delete-cc-card', yoga_uri . '/js/website/delete-cc-card.js', array('jquery'), true );
    wp_enqueue_script( 'schedule_reserve', yoga_uri . '/js/website/schedule_reserve.js', array('jquery'), true );
    wp_enqueue_script( 'yoga_common', yoga_uri . '/js/website/common.js', array('jquery'), true );

    wp_localize_script('customer-register', 'zingfit_js_var', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));

}

add_action( 'admin_enqueue_scripts', 'yoga_admin_enqueue' );
function yoga_admin_enqueue() {
    wp_enqueue_script( 'admin-setting', yoga_uri . '/js/admin-setting.js', array('jquery'), true );
    wp_enqueue_script( 'admin-zingfit-update', yoga_uri . '/js/admin-zingfit-update.js', array('jquery'), true );

    wp_localize_script('admin-setting', 'zingfit_js_var_admin', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}

include_once yoga_path . '/admin/zingfit-settings/zingfit-settings.php';
new Zingfit_Main_Settings();

include_once yoga_path . '/zingfit/zingfit.class.php';

$settings = get_option("zingfit_api_settings");
$zingfit_client_id = $settings['general']["zingfit_client_id"];
$zingfit_client_secret = $settings['general']["zingfit_client_secret"];
$zingfit_api_url = $settings['general']["zingfit_api_url"];

if($zingfit_client_id && $zingfit_client_secret && $zingfit_api_url) :
    $zingfit = new ZingFit($zingfit_client_id, $zingfit_client_secret, $zingfit_api_url);

    $is_zingfit_access_token = get_transient('zingfit_access_token');
    if (false === $is_zingfit_access_token) {
        $zingfit->getAuthenticate();
    }

endif;

include_once yoga_path . '/admin/ajax-functions/zingfit_access_token.php';
include_once yoga_path . '/admin/ajax-functions/zingfit_update_apis.php';
include_once yoga_path . '/admin/ajax-functions/zingfit_customer_register.php';
include_once yoga_path . '/admin/ajax-functions/zingfit_customer_update.php';
include_once yoga_path . '/admin/ajax-functions/zingfit_customer_login.php';
include_once yoga_path . '/admin/ajax-functions/zingfit_schedule_reserve.php';
include_once yoga_path . '/admin/ajax-functions/zingfit_book_slot.php';
include_once yoga_path . '/admin/ajax-functions/zingfit_delete_cc_card.php';

include_once yoga_path . '/shortcodes/schedule/schedule.shortcode.php';
new ZingFit_Schedule_Shortcode();

include_once yoga_path . '/shortcodes/register/register.shortcode.php';
new ZingFit_Register_Shortcode();

include_once yoga_path . '/shortcodes/login/login.shortcode.php';
new ZingFit_Login_Shortcode();

include_once yoga_path . '/shortcodes/instructor_schedule/instructor_schedule.shortcode.php';
new ZingFit_Instructor_Schedule_Shortcode();

$zingfit->getClassTypes();