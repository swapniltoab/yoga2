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
        global $zingfit;
        $classes = $zingfit->getClasses();
        $schedule = [];

        foreach($classes as $class){
            $classDate = $class['classDate'];
            $classDate = explode('T', $classDate);
            $Date = $classDate[0];
            $classDay = date('l', strtotime($Date));
            $stringDate = strtotime($Date);
            $tempClass = [];

            $tempClass['day'] = $classDay;
            $tempClass['date'] = $Date;
            $tempClass['time'] = $classDate[1];
            $tempClass['instructor_name'] = $class['instructor1'];

            if(is_array($schedule[$stringDate])){
                array_push($schedule[$stringDate], $tempClass);
            } else {
                $schedule[$stringDate][0] = $tempClass;
            }

        }
        // error_log('$schedule  ..... '.print_r($schedule,1));

        $content = include 'tpl/template.php';
        echo $content;
    }

}
