<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

include_once get_stylesheet_directory() . '/zingfit/zingfit.class.php';

$zingfit = new ZingFit('yoga2point0-classpass','aad1d8d3aacc413bac02cd1ea13a66ae', 'https://api.zingfit.com/oauth/token');

$zingfit->getAuthenticate();
