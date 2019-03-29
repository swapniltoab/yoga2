<div class="main-calender-div">
    <div class="schedule-table-week-controller text-uppercase small bg-white text-center pt-2 pb-2 font-weight-bold">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <span data-action="prev" class="prev navigator greyed">&lt;&lt;</span>
                </div>
                <div class="col-8 this-week-banner date-display active">This Week</div>
                    <span data-action="next" class="next navigator">&gt;&gt;</span>
                </div>
            </div>
        </div>
    </div>


    <div id="schedule-table" class="schedule-table row no-gutters" data-currenttime="1550488645">

        <?php

       global $zinfit;
       $test = $zingfit->getInstructorClasses('','', '', '');
        //error_log('$test .... '.print_r($test,1));
        print_r($test);
        
        ?>
    </div>
</div>

