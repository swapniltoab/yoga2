<?php

/*template name: zingfit authentication */
if ( !is_user_logged_in() ) {
get_header();
?>

<div class="container">
    <div class="row form_row">
        <div class="col-sm-6">
            <?php
                echo do_shortcode('[zingfit_login]');
                echo do_shortcode('[zingfit_register]');
            ?>
        </div>

        <div class="col-sm-6 right_col">
            <div class="div-form-sec">
                <span class="js-ShowLoginForm hideElement span-text-sec">Already have Yoga 2.0 account, please sign in.</span><br>
                <input class="js-ShowLoginForm btn hideElement" type="submit" value="SIGN IN >" /><br>
            </div>

            <div class="div-form-sec">
                <span class="js-ShowRegisterForm span-text-sec">In order to reserve a spot, please create a Yoga 2.0 account</span><br>
                <input class="js-ShowRegisterForm btn" type="submit" value="SIGN UP >" />
            </div>

        </div>

    </div>
</div>

<?php
get_footer();
} else {
    $url = home_url();
    wp_redirect($url);
    exit;
}?>