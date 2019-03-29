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
        
        foreach($schedule as $classes){
            $length = count($classes);
            foreach ($classes as $key => $class) {
                if ($key == 0) : ?>

                    <div class="col-lg bg-white text-uppercase small class-day" id="">
                        <div class="">

                            <div class="class-day-title p-3">
                                <h3 class="font-weight-bold"><?php echo $class['day'] ?></h3>
                                <span><?php echo $class['date'] ?></span>
                            </div>

                <?php endif; ?>

                            <div class="classes-container">
                                <div id="" class="class-container p-3 row no-gutters  not-private " data-room="" data-classid="" data-classdate="" data-classinstructorname="" data-gender="">
                                    <div class="col-7 col-lg-12">
                                        <div class="class-instructor position-relative">
                                            <div class="class-time">
                                            <?php echo $class['time'] ?>
                                            </div>
                                            <?php echo $class['instructor_name'] ?><br>
                                            <?php //echo $class['room_Id'] ?><br>
                                            <a href="/book/?roomId=<?php echo $class['room_Id']?>" class="reserve" type="button" data-room-id="<?php echo $class['room_Id']?>">RESERVE</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                <?php if ($key == ($length-1)) : ?>
                        </div>
                    </div>
                <?php endif; ?>

        <?php
            }
        }
        ?>
    </div>
</div>

