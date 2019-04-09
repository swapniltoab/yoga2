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

        $availSlots = [];
        $days = [];
        $schedule = [];

        $time = strtotime("now");
        
        for($i=0; $i<=13; $i++){
            $temp = [];
            $next = strtotime("+".$i." day");
            $temp['day'] = date('l',$next);
            $temp['date'] = date('m-d',$next);
            array_push($days, $temp);
        }

        foreach ($classes as $class) {
            $classDate = $class['classDate'];
            $classDate = explode('T', $classDate);
            $Date = $classDate[0];
            $classDay = date('l', strtotime($Date));
            $date = date('m-d', strtotime($Date));
            $stringDate = strtotime($Date);
            $tempClass = [];

            $time = date('h:i A', strtotime($classDate[1]));

            $tempClass['day'] = $classDay;
            $tempClass['date'] = $date; // substr($Date, 5);
            $tempClass['time'] = $time;
            $tempClass['instructor_name'] = $class['instructor1'];
            $tempClass['room_Id'] = $class['roomId'];

            if (is_array($availSlots[$date])) {
                array_push($availSlots[$date], $tempClass);
            } else {
                $availSlots[$date][0] = $tempClass;
            }
        }
        
        foreach($days as $k => $day){
            
            if (!array_key_exists($day['date'],$availSlots))
            {   
                $schedule[$day['date']]['isEmpty'] = true;
                $schedule[$day['date']][] = $day;
            } else {
                 $schedule[$day['date']] = $availSlots[$day['date']];
            }
            
        }
        // print_r($schedule);

        ob_start();
        include 'tpl/template.php';
        return ob_get_clean();

    }

}
