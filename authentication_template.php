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
            <input class="js-ShowLoginForm btn hideElement" type="submit" value="SIGN IN >" /><br>
            <input class="js-ShowRegisterForm btn" type="submit" value="SIGN UP >" />
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