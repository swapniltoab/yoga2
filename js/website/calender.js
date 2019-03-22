(function ($) {
    $(window).load(function () {
        $('div#schedule-table .col-lg:lt(7)').addClass('active').show();

        let classDay = $('.class-day');

        $('.next').click(function () {
            $(".this-week-banner").text('Next week');

            classDay.each((index, ele) => {

                if (index < 7) {
                    console.log('ifff ele ', index);
                    $(ele).removeClass('active');
                } else {
                    console.log('elseeee ele ', index);
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

    });
})(jQuery);