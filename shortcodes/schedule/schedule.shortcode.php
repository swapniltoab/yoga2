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
        $prevDate = '';
        foreach($classes as $class){
            $classDate = $class['classDate'];
            $classDate = explode('T', $classDate);
            $classDate = $classDate[0];
            $classDay = date('l', strtotime($classDate));
            $stringDate = strtotime($classDate);
            $tempClass = [];

            if($prevDate !== $stringDate){
                $tempClass['day'] = $classDay;
            }


            array_push($schedule[$stringDate], $tempClass);

            error_log('$tempClass ..... '.print_r($tempClass,1));
        }
        error_log('$schedule  ..... '.print_r($schedule,1));
        
        $content = include 'tpl/template.php';
        echo $content;
    }

}
