$(function() { //document onload
	 "use strict";

	//wybieranie tagów
	$('.tag-option').on('click', function(event){
		var img = $(this).children('i').first();

		//zmiana tła i symbolu przy kliknięciu
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
