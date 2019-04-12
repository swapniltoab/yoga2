<div class="schedule-table-container">
    <div class="row schedule-table-header">
        <div class="col-md-12">
            <div class="filter-wrap">
                <div class="drop-down">
                    <select id="select-class-type" class="" name="select-class-type">
                        <option value="all-class">Class Type</option>
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
                            <option value="all-instructor">Instructor Name</option>
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

<div class="desk-calender">
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
                                                <div class="class-type">
                                                    <?php echo $class['classType'] ?>
                                                </div>
                                                <div class="instructor-name">
                                                    <?php echo $class['instructor_name'] ?><br>
                                                </div>
                                                <div class="class-time">
                                                   <?php echo $class['time'] ?>
                                                </div>
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
?></div>
</div>

<div class="mob-calender">
  <div class="main-calender-div">
    <div class="schedule-table-week-controller text-uppercase small bg-white text-center pt-2 pb-2 font-weight-bold">
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <span data-action="prev" class="prev navigator greyed">&lt;&lt;</span>
                </div>
                <div class="col-8">
                    <div class="this-week-banner date-display active">
                    This Week
                    </div>
                    <div class="js-current-dt"></div>
                </div>
                    <span data-action="next" class="next navigator">&gt;&gt;</span>
                </div>
            </div>
        </div>
    </div>


    <div id="schedule-table" class="schedule-table row no-gutters" data-currenttime="1550488645">
        <div class="col-lg bg-white text-uppercase small" id="">
                    <div class="nav nav-tabs">
        <?php
        $i = 0;
        foreach ($schedule as $classes) {
             $i++;
            $active = $i == 1 ? 'active' : '';
           // print_r($classes);
             if(array_key_exists('isEmpty',$classes) && $classes['isEmpty'] == 1){ ?>
                        <div data-toggle="tab" class="test js-day-div <?php echo $active ?>" href="#menu-<?php echo $classes[0]['date'] ?>" data-cur-dt="<?php echo $classes[0]['weekDate'] ?>" style="display:none">
                            <div class="class-day-title p-3">
                                <h3 class="font-weight-bold"><?php echo substr($classes[0]['day'], 0, 2) ?></h3>
                            </div>
                        </div>
            <?php }
                else {
                    $length = count($classes);
                    foreach ($classes as $key => $class) {
                        
                        if ($key == 0): ?>
                                <div data-toggle="tab" class="test js-day-div <?php echo $active ?>" href="#menu-<?php echo $class['date'] ?>" data-cur-dt="<?php echo $classes[0]['weekDate'] ?>" style="display:none">
                                    <div class="class-day-title p-3">
                                        <h3 class="font-weight-bold"><?php echo substr($class['day'], 0, 2); ?></h3>
                                    </div>
                                </div>
                        <?php endif;?><?php
                    }
             }

        } ?>
        </div>
                </div>
    </div>
    <div class="tab-content">
        <?php
        $i = 0;
        foreach ($schedule as $k => $classes) {
            $i++;
            $active = $i == 1 ? 'active' : 'fade';

            if(array_key_exists('isEmpty',$classes) && $classes['isEmpty'] == 1){ ?>
                <div id="menu-<?php echo $classes[0]['date'] ?>" class="classes-container tab-pane <?php echo $active ?>">
                    <div class="">
                        <span>No Data Available</span>
                    </div>
                </div>
            <?php }

                else {
                $length = count($classes);
                foreach ($classes as $key => $class) {
                     if ($key == 0):
                    ?>
                     <div id="menu-<?php echo $class['date'] ?>" class="classes-container tab-pane <?php echo $active ?>">
                     <?php
                     endif;
                     ?>
                     <div class="js-container" data-instructor="<?php echo $class['instructor_name'] ?>" data-class-type="<?php echo $class['classType'] ?>">
                        <div class="class-instructor position-relative">
                            <div class="col-8 px-0">
                            <div class="class-type">
                                <?php echo $class['classType'] ?>
                            </div>
                            <div class="instructor-name">
                                <?php echo $class['instructor_name'] ?><br>
                            </div>
                            <div class="class-time">
                                <?php echo $class['time'] ?>
                            </div>
                </div>
                         <div class="col-4 px-0">
                            <a href="/book/?classId=<?php echo $class['class_Id'] ?>" class="reserve btn-register" type="button" data-room-id="<?php echo $class['room_Id'] ?>" data-class-id="<?php echo $class['class_Id'] ?>">RESERVE</a>
                        </div>
                        </div>
                        </div>
                    <?php  if ($key == ($length - 1)): ?>
                            </div>
                    <?php endif;
                }
             }

        }
?>
    </div>

</div>

