<?php

class ZingFit_Login_Shortcode
{

    public function __construct()
    {

        $this->define_admin_hooks();

    }

    private function define_admin_hooks()
    {
        add_shortcode('zingfit_login', array($this, 'zingfit_login_callback'));
    }

    public function zingfit_login_callback($args)
    {
        global $zingfit;

        if(! is_user_logged_in()){
            $content = include 'tpl/template.php';
            echo $content;
        }
    }

}
