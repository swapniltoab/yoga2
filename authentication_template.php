<?php

/*template name: zingfit authentication */
if ( !is_user_logged_in() ) {
get_header();
?>

<div class="container">
    <div class="row form_row login_register_form_row">
        <div class="col-sm-6 register-page-left">
            <?php
                echo do_shortcode('[zingfit_login]');
                echo do_shortcode('[zingfit_register]');
            ?>
        </div>

        <div class="col-sm-6 right_col register-page-right">
            <div class="div-form-sec">
                <span class="js-ShowLoginFormSpan hideElement span-text-sec">Already have a Yoga2.0 account?</span><br>
                <input class="js-ShowLoginForm btn hideElement" type="submit" value="SIGN IN >" /><br>
            </div>

            <div class="div-form-sec">
                <span class="js-ShowRegisterFormSpan span-text-sec">Create a Yoga2.0 account to reserve your mat!</span><br>
                <input class="js-ShowRegisterForm btn" type="submit" value="SIGN UP >" />
            </div>

        </div>

    </div>
</div>

<?php
get_footer();
} else {
    $url = home_url();
    wp_redirect($url.'/account/');
    exit;
}?>