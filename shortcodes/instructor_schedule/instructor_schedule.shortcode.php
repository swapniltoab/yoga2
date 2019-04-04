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

    public function zingfit_instructor_schedule_callback($atts)
    {

        global $zingfit;

        $zingfit_access_token = get_transient('zingfit_access_token');
        $optionSites = get_option('zingfit_sites');
        $regions = get_option('zingfit_regions');
        $instructorId = $atts['instructorid'];

        $instructorClasses = $zingfit->getInstructorClasses($zingfit_access_token, $optionSites, $regions, $instructorId);

         $schedule = [];

        foreach ($instructorClasses as $class) {
            $classDate = $class['classDate'];
            $classDate = explode('T', $classDate);
            $Date = $classDate[0];
            $classDay = date('l', strtotime($Date));
            $stringDate = strtotime($Date);

            $dateArr = explode('-', $Date);
            $dateStr = $dateArr[2].'.'.$dateArr[1].'.'.$dateArr[0];

            //print_r($dateStr);
            $tempClass = [];



            $time = date('h:i A', strtotime($classDate[1]));

            $tempClass['day'] = $classDay;
            $tempClass['date'] = $dateStr;
            $tempClass['time'] = $time;
            $tempClass['instructor_name'] = $class['instructor1'];
            $tempClass['room_Id'] = $class['roomId'];

            if (is_array($schedule[$stringDate])) {
                array_push($schedule[$stringDate], $tempClass);
            } else {
                $schedule[$stringDate][0] = $tempClass;
            }
        }


        ob_start();
        include 'tpl/template.php';
        return ob_get_clean();

    }

}
