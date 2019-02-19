<div class="schedule-table-week-controller text-uppercase small bg-white text-center pt-2 pb-2 font-weight-bold">
	<div class="container">
		<div class="row">
			<div class="col-2">
				<span data-action="prev" class="prev navigator greyed">&lt;&lt;</span>
			</div>
			<div class="col-8 this-week-banner date-display active">
				This Week <span class="hidden showOnMobile">FEB 16 2019</span>
			</div>
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

                <div class="col-lg bg-white text-uppercase small class-day active" id="tab-2019-02-18">
                    <div class="  ">

                        <div class="class-day-title p-3">
                            <h3 class=" font-weight-bold"><?php echo $class['day'] ?></h3>
                            <span><?php echo $class['date'] ?></span>
                        </div>

                        <?php endif; ?>

                        <div class="classes-container">
                            <div id="794234914659632960" class="class-container p-3 row no-gutters  not-private " data-room="noho" data-classid="794234914659632960" data-classdate="2019-02-18T07:00:00" data-classinstructorname="Rob" data-gender="">
                                <div class="col-7 col-lg-12">
                                    <div class="class-instructor position-relative">
                                        <div class="class-time">
                                        <?php echo $class['time'] ?>
                                        </div>
                                        <?php echo $class['instructor_name'] ?><br>
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

    <!-- <div class="col-lg bg-white text-uppercase small class-day active" id="tab-2019-02-19">
        <div class="  ">
            <div class="class-day-title p-3">
                <h3 class=" font-weight-bold">Tuesday</h3>
                <span>02-19</span>
            </div>
            <div class="classes-container">
                <div id="794234915741763405" class="class-container p-3 row no-gutters  not-private " data-room="noho" data-classid="794234915741763405" data-classdate="2019-02-19T06:00:00" data-classinstructorname="Brian" data-gender="">
                    <div class="col-7 col-lg-12">
                        <div class="class-instructor position-relative">
                            <div class="class-time">
                                06:00 AM
                            </div>
                            Brian<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="col-lg bg-white text-uppercase small class-day active" id="tab-2019-02-21">
        <div class="  ">
            <div class="class-day-title p-3">
                <h3 class=" font-weight-bold">Wednesday</h3>
                <span>02-20</span>
            </div>
            <div class="classes-container">
                <div id="794234916756784986" class="class-container p-3 row no-gutters  not-private " data-room="noho" data-classid="794234916756784986" data-classdate="2019-02-20T06:00:00" data-classinstructorname="Morgan" data-gender="">
                    <div class="col-7 col-lg-12">
                        <div class="class-instructor position-relative">
                            <div class="class-time">
                                06:00 AM
                            </div>
                            Morgan<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="col-lg bg-white text-uppercase small class-day active" id="tab-2019-02-21">
        <div class="  ">
            <div class="class-day-title p-3">
                <h3 class=" font-weight-bold">Thursday</h3>
                <span>02-21</span>
            </div>
            <div class="classes-container">
                <div id="794234917855692648" class="class-container p-3 row no-gutters  not-private " data-room="noho" data-classid="794234917855692648" data-classdate="2019-02-21T06:00:00" data-classinstructorname="JD" data-gender="">
                    <div class="col-7 col-lg-12">
                        <div class="class-instructor position-relative">
                            <div class="class-time">
                                06:00 AM
                            </div>
                            JD<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="col-lg bg-white text-uppercase small class-day active" id="tab-2019-02-22">
        <div class="  ">
            <div class="class-day-title p-3">
                <h3 class=" font-weight-bold">Friday</h3>
                <span>02-22</span>
            </div>
            <div class="classes-container">
                <div id="794234918870714230" class="class-container p-3 row no-gutters  not-private " data-room="noho" data-classid="794234918870714230" data-classdate="2019-02-22T06:00:00" data-classinstructorname="noho" data-gender="">
                    <div class="col-7 col-lg-12">
                        <div class="class-instructor position-relative">
                            <div class="class-time">
                                06:00 AM
                            </div>
                            noho<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="col-lg bg-white text-uppercase small class-day active" id="tab-2019-02-23">
        <div class="  ">
            <div class="class-day-title p-3">
                <h3 class=" font-weight-bold">Saturday</h3>
                <span>02-23</span>
            </div>
            <div class="classes-container">
                <div id="794234920028342147" class="class-container p-3 row no-gutters  not-private " data-room="noho" data-classid="794234920028342147" data-classdate="2019-02-23T07:30:00" data-classinstructorname="Dillon" data-gender="">
                    <div class="col-7 col-lg-12">
                        <div class="class-instructor position-relative">
                            <div class="class-time">
                                07:30 AM
                            </div>
                            Dillon<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="col-lg bg-white text-uppercase small class-day active" id="tab-2019-02-24">
        <div class="  ">
            <div class="class-day-title p-3">
                <h3 class=" font-weight-bold">Sunday</h3>
                <span>02-24</span>
            </div>
            <div class="classes-container">
                <div id="800018769312220178" class="class-container p-3 row no-gutters  not-private " data-room="noho" data-classid="800018769312220178" data-classdate="2019-02-24T07:30:00" data-classinstructorname="Kristina" data-gender="">
                    <div class="col-7 col-lg-12">
                        <div class="class-instructor position-relative">
                            <div class="class-time">
                                07:30 AM
                            </div>
                            Kristina<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

</div>
