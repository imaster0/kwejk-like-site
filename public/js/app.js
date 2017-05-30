$(function() {
	 "use strict";
	$('a.page-scroll').on('click', function(event) {

        $('html, body').stop().animate({
            scrollTop: ($($(this).attr('href')).offset().top - 49)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

});
