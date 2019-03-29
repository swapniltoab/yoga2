<?php

class ZingFit_Instructor_Schedule_Shortcode
{

    public function __construct()
    {
        $this->define_admin_hooks();
    }

    private function define_admin_hooks()
    {
        add_shortcode('zingfit_instructor_schedule', array($this, 'zingfit_instructor_schedule_callback'));
    }

    public function zingfit_instructor_schedule_callback($args)
    {
        global $zingfit;
       $schedule = $zingfit->getInstructorClasses('','', '', '');

        ob_start();
        include 'tpl/template.php';
        return ob_get_clean();

    }

}
