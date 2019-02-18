<?php

class ZingFit_Schedule_Shortcode
{

    public function __construct()
    {

        $this->define_admin_hooks();

    }

    private function define_admin_hooks()
    {
        add_shortcode('zingfit_schedule', array($this, 'zingfit_schedule_callback'));
    }

    public function zingfit_schedule_callback($args)
    {
        $content = include 'tpl/template.php';
        echo $content;
    }

}
