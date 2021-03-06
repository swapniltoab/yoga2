<?php

define('parent_theme_uri', get_template_directory_uri());
define('yoga_path', get_stylesheet_directory());
define('yoga_uri', get_stylesheet_directory_uri());

add_action('wp_enqueue_scripts', 'yoga_enqueue');
function yoga_enqueue()
{
    wp_enqueue_style('parent-style', parent_theme_uri . '/style.css');
    wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
    wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', array('jquery'), true);
    wp_enqueue_script('bootstrapJs', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'), true);
    wp_enqueue_script('calender', yoga_uri . '/js/website/calender.js', array('jquery'), true);
    wp_enqueue_script('customer-register', yoga_uri . '/js/website/customer-register.js', array('jquery'), true);
    wp_enqueue_script('customer-update-account', yoga_uri . '/js/website/customer-update-account.js', array('jquery'), true);
    wp_enqueue_script('customer-login', yoga_uri . '/js/website/customer-login.js', array('jquery'), true);
    wp_enqueue_script('book-slot', yoga_uri . '/js/website/book-slot.js', array('jquery'), true);
    wp_enqueue_script('delete-cc-card', yoga_uri . '/js/website/delete-cc-card.js', array('jquery'), true);
    wp_enqueue_script('cancel-spot', yoga_uri . '/js/website/cancel-spot.js', array('jquery'), true);
    wp_enqueue_script('schedule_reserve', yoga_uri . '/js/website/schedule_reserve.js', array('jquery'), true);
    wp_enqueue_script('forget-password', yoga_uri . '/js/website/forget-password.js', array('jquery'), true);
    wp_enqueue_script('reset-user-password', yoga_uri . '/js/website/reset-user-password.js', array('jquery'), true);
    wp_enqueue_script('yoga_common', yoga_uri . '/js/website/common.js', array('jquery'), true);

    wp_localize_script('customer-register', 'zingfit_js_var', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'homeurl' => home_url(),
    ));

}

add_action('admin_enqueue_scripts', 'yoga_admin_enqueue');
function yoga_admin_enqueue()
{
    wp_enqueue_script('admin-setting', yoga_uri . '/js/admin-setting.js', array('jquery'), true);
    wp_enqueue_script('admin-zingfit-update', yoga_uri . '/js/admin-zingfit-update.js', array('jquery'), true);

    wp_localize_script('admin-setting', 'zingfit_js_var_admin', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}

include_once yoga_path . '/admin/zingfit-settings/zingfit-settings.php';
new Zingfit_Main_Settings();

include_once yoga_path . '/zingfit/zingfit.class.php';

$settings = get_option("zingfit_api_settings");
$zingfit_client_id = $settings['general']["zingfit_client_id"];
$zingfit_client_secret = $settings['general']["zingfit_client_secret"];
$zingfit_api_url = $settings['general']["zingfit_api_url"];

if ($zingfit_client_id && $zingfit_client_secret && $zingfit_api_url):
    $zingfit = new ZingFit($zingfit_client_id, $zingfit_client_secret, $zingfit_api_url);

    $is_zingfit_access_token = get_transient('zingfit_access_token');
    if ($is_zingfit_access_token == '') {
        $zingfit->getAuthenticate();
    }

endif;

$ddd = $_SERVER['REQUEST_URI'];

if ($_SERVER['REQUEST_URI'] == '/the-warriors-way/' || $_SERVER['REQUEST_URI'] == '/the-warriors-way') {

    if (!current_user_can('administrator')) {
        if (is_user_logged_in()) {
            $seriesId = [];
            $regions = get_option('zingfit_regions');
            $zingfit_user_access_token = current_user_zingfit_access_token;
            $regionId = '811593826090091886';

            if ($zingfit_user_access_token) {
                global $zingfit;
                $myActiveSerieses = $zingfit->getCustomerMySeriesActive($zingfit_user_access_token, $regionId);
                $myActiveContracts = $zingfit->getCustomerMyContractActive($zingfit_user_access_token, $regionId);
            } else {
                logoutCureentUser();
            }

            foreach ($myActiveSerieses->content as $key => $series) {
                $seriesId[] = $series->id;
            }

            foreach ($myActiveContracts->content as $key => $activeContract) {
                $seriesId[] = $activeContract->purchased[0]->seriesId;
            }

            if (in_array('854350814192338856', $seriesId)) {

            } else {
                $url = home_url();
                wp_redirect($url . '/no-access');
                exit;
            }

        } else {
            $url = home_url();
            wp_redirect($url . '/no-access');
            exit;
        }
    }

}

include_once yoga_path . '/admin/ajax-functions/zingfit_access_token.php';
include_once yoga_path . '/admin/ajax-functions/zingfit_update_apis.php';
include_once yoga_path . '/admin/ajax-functions/zingfit_customer_register.php';
include_once yoga_path . '/admin/ajax-functions/zingfit_customer_update.php';
include_once yoga_path . '/admin/ajax-functions/zingfit_customer_login.php';
include_once yoga_path . '/admin/ajax-functions/zingfit_schedule_reserve.php';
include_once yoga_path . '/admin/ajax-functions/zingfit_book_slot.php';
include_once yoga_path . '/admin/ajax-functions/zingfit_delete_cc_card.php';
include_once yoga_path . '/admin/ajax-functions/zingfit_cancel_spot.php';
include_once yoga_path . '/admin/ajax-functions/forget-password.php';
include_once yoga_path . '/admin/ajax-functions/reset-user-password.php';

include_once yoga_path . '/shortcodes/schedule/schedule.shortcode.php';
new ZingFit_Schedule_Shortcode();

include_once yoga_path . '/shortcodes/register/register.shortcode.php';
new ZingFit_Register_Shortcode();

include_once yoga_path . '/shortcodes/login/login.shortcode.php';
new ZingFit_Login_Shortcode();

include_once yoga_path . '/shortcodes/instructor_schedule/instructor_schedule.shortcode.php';
new ZingFit_Instructor_Schedule_Shortcode();

include_once yoga_path . '/shortcodes/purchasable-series/purchasable-series-shortcode.php';
new ZingFit_Purchasable_Series_Shortcode();

$zingfit->getClassTypes();

add_action('wp_logout', 'auto_redirect_after_logout');
function auto_redirect_after_logout()
{
    wp_redirect(home_url());
    exit();
}

// function replace_howdy( $wp_admin_bar ) {
//     $my_account=$wp_admin_bar->get_node('my-account');
//     $newtitle = str_replace( 'Howdy,', 'Welcome', $my_account->title );
//     $wp_admin_bar->add_node( array(
//         'id' => 'my-account',
//         'title' => $newtitle,
//     ) );
// }
// add_filter( 'admin_bar_menu', 'replace_howdy',25 );

// add_filter('show_admin_bar', '__return_false');

if (!current_user_can('manage_options')) {
    show_admin_bar(false);
}

$wpUserId = get_current_user_id();
if (!empty($wpUserId) && $wpUserId != 0) {

    $current_user_zingfit_access_token = get_user_meta($wpUserId, 'zingfit_customer_access_token', true);
    $current_user_zingfit_access_token_expires_in = get_user_meta($wpUserId, 'zingfit_customer_access_token_expires_in', true);
    $current_user_zingfit_access_token_expires_at = get_user_meta($wpUserId, 'zingfit_customer_access_token_expires_at', true);

    $currentTime = time();

    if ($currentTime > $current_user_zingfit_access_token_expires_at) {
        logoutCureentUser();
    }

    define('current_user_zingfit_access_token', $current_user_zingfit_access_token);
}

function logoutCureentUser()
{
    if( !current_user_can('administrator') ){
?>
  <script type="text/javascript">

    function sessionLogout(){

        var pageURL = jQuery(location).attr("href");
        // localStorage.setItem('yoga_user_login_url',pageURL);

        var ajax_url = zingfit_js_var.ajaxurl;
        var postData = {
            'action': 'wp_user_session_logout',
        };

        jQuery.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_url,
            data:postData,
            success: (response) => {
                if (response.status === true) {
                    window.location.href = '/register/?redirecturl='+pageURL;
                } else {
                    window.location.href = '/register/?redirecturl='+pageURL;
                }
            }
        });

    }

    if (confirm("Session TimeOut! Logging you off.")) {
       sessionLogout();
    } else {
        sessionLogout();
    }
  </script>
<?php
    }
}

function wp_user_session_logout()
{
    $user_id = get_current_user_id();
    $sessions = WP_Session_Tokens::get_instance($user_id);
    $sessions->destroy_all();

    echo json_encode(array('status' => true));
    die();

}
add_action('wp_ajax_wp_user_session_logout', 'wp_user_session_logout');
add_action('wp_ajax_nopriv_wp_user_session_logout', 'wp_user_session_logout');
