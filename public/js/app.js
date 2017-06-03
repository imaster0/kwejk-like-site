$(function() {
	 "use strict";
	$('a.page-scroll').on('click', function(event) {

        $('html, body').stop().animate({
            scrollTop: ($($(this).attr('href')).offset().top - 49)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

	//wybieranie tagów
	$('.tag-option').on('click', function(event){
		var img = $(this).children('i').first();

		if(img.hasClass('fa-plus-circle')){
			img.removeClass('fa-plus-circle');
			img.addClass('fa-minus-circle');
			img.parent().removeClass('badge-success');
			img.parent().addClass('badge-danger');
		}
		else{
			img.removeClass('fa-minus-circle');
			img.addClass('fa-plus-circle');
			img.parent().removeClass('badge-danger');
			img.parent().addClass('badge-success');
		}
	});
});
