<div class="schedule-table-container">
    <div class="row schedule-table-header">
        <div class="col-md-12">
            <div class="filter-wrap">
                <div class="drop-down">
                    <select id="select-class-type" class="" name="select-class-type">
                        <option value="all-class">Select Class Type</option>
                    <?php
                    global $zingfit;
                    $classTypes = $zingfit->getClassTypes();
                    foreach($classTypes as $classType){

                        $classtypeName = $classType['name'];
                        $classtypeId = $classType['id'];
                   ?>
                        <option class="" value="<?php echo $classtypeName ?>"><?php echo $classtypeName ?></option>
                    <?php }
                    ?>
                     </select>
                </div>
                <div class="drop-down">
                    <select id="select-instructor" class="" name="select-instructor">
                            <option value="all-instructor">Select Instructor</option>
                        <?php
                        $allInstructors = $zingfit->getAllInstructors();
                        foreach($allInstructors as $instructors){
                        $instructorName = $instructors['fullName'];
                        ?>
                        <option class="" value="<?php echo str_replace(" ","",$instructorName) ?>"><?php echo $instructorName ?></option>
                        <?php } ?>
                     </select>
                </div>
            </div>
        </div>
    </div>
</div>

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
        foreach ($schedule as $classes) {

            if(array_key_exists('isEmpty',$classes) && $classes['isEmpty'] == 1){ ?>
                <div class="col-lg bg-white text-uppercase small class-day" id="">
                    <div class="">
                        <div class="class-day-title p-3">
                            <h3 class="font-weight-bold"><?php echo $classes[0]['day'] ?></h3>
                            <span><?php echo $classes[0]['date'] ?></span>
                        </div>
                    </div>

                    <div class="classes-container">
                        <span>No Data Available</span>
                    </div>

                </div>
            <?php }
                else {
                $length = count($classes);
                foreach ($classes as $key => $class) {
                    if ($key == 0): ?>
                        <div class="col-lg bg-white text-uppercase small class-day" id="">
                            <div class="">
                                <div class="class-day-title p-3">
                                    <h3 class="font-weight-bold"><?php echo $class['day'] ?></h3>
                                    <span><?php echo $class['date'] ?></span>
                                </div>
                    <?php endif;?>
                                <div class="classes-container js-container" data-instructor="<?php echo $class['instructor_name'] ?>" data-class-type="<?php echo $class['classType'] ?>">
                                    <div id="" class="class-container p-3 row no-gutters  not-private " data-room="<?php echo $class['room_Id'] ?>" data-classid="<?php echo $class['class_Id'] ?>" data-classdate="" data-classinstructorname="" data-gender="">
                                        <div class="col-7 col-lg-12">
                                            <div class="class-instructor position-relative">
                                                <div class="class-time">
                                                <?php echo $class['time'] ?>
                                                </div>
                                                <div class="class-type">
                                                <?php echo $class['classType'] ?>
                                                </div>
                                                <?php echo $class['instructor_name'] ?><br>
                                                <a href="/book/?classId=<?php echo $class['class_Id'] ?>" class="reserve btn-register" type="button" data-room-id="<?php echo $class['room_Id'] ?>" data-class-id="<?php echo $class['class_Id'] ?>">RESERVE</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php if ($key == ($length - 1)): ?>
                            </div>
                        </div>
                    <?php endif;
                }
             }

        }
?>
    </div>
</div>

