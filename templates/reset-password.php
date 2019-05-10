<?php
/* Template Name: Zingfit Reset Password */


$errors = new WP_Error();
/* @var $_GET type */

if(!empty($_GET) && array_key_exists('key',$_GET) && array_key_exists('login',$_GET)){

    get_header();

    $key = $_GET['key'];
    $user_login = $_GET['login'];
    $user = check_password_reset_key($key, $user_login);

    if (is_wp_error($user)) {
        if ($user->get_error_code() === 'expired_key') {
            $errors->add('expiredkey', __('Sorry, the key has expired. Please try again.'));
        } else {
            $errors->add('invalidkey', __('Sorry, the key does not appear to be valid.'));
        }
    }

    if ($errors->get_error_code()) {
        echo $errors->get_error_message($errors->get_error_code());
    } else {
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <form id ="resetPasswordForm" name="resetPasswordForm" method="post" accept-charset="UTF-8">
                    <div class="container">

                        <h2>Reset Password</h2>

                        <div class="js-form-control row">
                            <label class="col-md-3 form-label" for="reset_password"><b>PASSWORD</b></label>
                            <div class="col-md-9">
                                <input type="password" class="form-input" id="js-reset_password" name="reset_password" required><br>
                                <span class="error-message" id="error_new_password" style="color:red"></span>
                            </div>
                        </div>

                        <div class="js-form-control row">
                            <label class="col-md-3 form-label" for="confirm_reset_password"><b>CONFIRM PASSWORD</b></label>
                            <div class="col-md-9">
                                <input type="password" class="form-input" id="js-confirm_reset_password" name="confirm_reset_password" required><br>
                                <span class="error-message" id="error_confirm_password" style="color:red"></span>
                            </div>
                        </div>

                        <input type="hidden" name="reset_user_key" id="reset_user_key"
                            value="<?php // echo esc_attr($key); ?>" autocomplete="off" />
                        <input type="hidden" name="reset_user_login" id="reset_user_login"
                            value="<?php // echo esc_attr($user_login); ?>" />

                        <div class="row">
                            <div class="col-md-12" style="text-align:center">
                                <?php wp_nonce_field('yoga-reset-password-nonce', 'yoga-reset-password-nonce', true, true);?>
                                <input id="btn_reset_password" class="btn" type="submit" value="Set Password">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    }

    get_footer();
} else {

    $url = home_url();
    wp_redirect($url);
    exit;
}

?>