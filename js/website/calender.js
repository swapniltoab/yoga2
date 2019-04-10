(function ($) {
    var selectedClassType = null;
    var selectedInstructor = null;
    $(window).load(function () {
        $('div#schedule-table .col-lg:lt(7)').addClass('active').show();

        let classDay = $('.class-day');

        $('.next').click(function () {
            $(".this-week-banner").text('Next week');

            classDay.each((index, ele) => {

                if (index < 7) {
                    // console.log('ifff ele ', index);
                    $(ele).removeClass('active');
                } else {
                    // console.log('elseeee ele ', index);
                    $(ele).addClass('active');
                }
            });
        });

        $('.prev').click(function () {
            $(".this-week-banner").text('This week');

            classDay.each((index, ele) => {

                if (index > 6) {
                    $(ele).removeClass('active');
                } else {
                    $(ele).addClass('active');
                }
            });
        });

        $("#select-class-type").change(function () {
            var classtype = $('#select-class-type  :selected').val();
            selectedClassType = classtype;

            $(".js-container").each(function () {
                var classDataVal = $(this).data("class-type");
                var instructorDataVal= $(this).data("instructor");
               
                if (classtype == 'all-class' && selectedInstructor == 'all-instructor'){
                    $(this).show();
                } else {
                    if (selectedInstructor != null && selectedInstructor != "all-instructor") {

                        if (classtype == 'all-class' && selectedInstructor != "all-instructor") {
                            if (selectedInstructor == instructorDataVal) {
                                $(this).show(200);
                            } else {
                                $(this).hide(200);
                            }
                        } else {
                            if (classtype == classDataVal && selectedInstructor == instructorDataVal) {
                                $(this).show(200);
                            } else {
                                $(this).hide(200);
                            }
                        }
                    } else {
                       
                        if (classtype == classDataVal) {
                            $(this).show(200);
                        } else {
                            $(this).hide(200);
                        }
                    }
                }

                
            });
            
        });

        $("#select-instructor").change(function () {
            var instructor = $('#select-instructor  :selected').val();
            selectedInstructor = instructor;
           
            $(".js-container").each(function () {
                var instructorDataVal = $(this).data("instructor");
                var classDataVal = $(this).data("class-type");
           
                if (selectedClassType == 'all-class' && instructor == 'all-instructor') {
                   
                    $(this).show();
                } else {
                    if (selectedClassType != null && selectedClassType != "all-class") {
           
                        if (instructor == 'all-instructor' && selectedClassType != "all-class"){
                            if (selectedClassType == classDataVal) {
                                $(this).show(200);
                            } else {
                                $(this).hide(200);
                            }
                        } else {
                            if (instructor == instructorDataVal && selectedClassType == classDataVal) {
                                $(this).show(200);
                            } else {
                                $(this).hide(200);
                            }
                        }
                        
                    } else {
                      
                        if (instructor == instructorDataVal) {
                            $(this).show(200);
                        } else {
                            $(this).hide(200);
                        }
                    }
                }
            });
        });
        
    });
})(jQuery);