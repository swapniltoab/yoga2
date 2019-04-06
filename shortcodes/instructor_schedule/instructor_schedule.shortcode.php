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


        $availSlots = [];
        $days = [];
        $schedule = [];

        $time = strtotime("now");

        for($i=0; $i<=6; $i++){
            $temp = [];
            $next = strtotime("+".$i." day");
            $temp['day'] = date('l',$next);
            $temp['date'] = date('d-m',$next);
            array_push($days, $temp);
        }

        //  $schedule = [];

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

            if (is_array($availSlots[$classDay])) {
                array_push($availSlots[$classDay], $tempClass);
            } else {
                $availSlots[$classDay][0] = $tempClass;
            }
        }

        foreach($days as $k => $day){
            if (!array_key_exists($day['day'],$availSlots))
            {
                $schedule[$day['day']]['isEmpty'] = true;
                $schedule[$day['day']][] = $day;
            } else {
                $schedule[$day['day']] = $availSlots[$day['day']];
            }
        }


        ob_start();
        include 'tpl/template.php';
        return ob_get_clean();

    }

}
