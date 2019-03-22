<?php

class ZingFit_Register_Shortcode
{

    public function __construct()
    {
        $this->define_admin_hooks();
    }

    private function define_admin_hooks()
    {
        add_shortcode('zingfit_register', array($this, 'zingfit_register_callback'));
    }

    public function zingfit_register_callback($args)
    {
        global $zingfit;

        if(! is_user_logged_in()){
            ob_start();
            include 'tpl/template.php';
            return ob_get_clean();
        }
    }

}
