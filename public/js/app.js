$(function() { //document onload
	 "use strict";

	 var disp = $('.hidden-sm-down').css('display');
	 var disp2 = $('.show-sm-down').css('display');

	 if($(window).width() < 768){
	 	if(disp != 'none') $('.hidden-sm-down').css('display', 'none');
	 	if(disp2 != 'inline') $('.show-sm-down').css('display', 'inline');
	 }
	 else{
	 	if(disp != 'inline') $('.hidden-sm-down').css('display', 'inline');
	 	if(disp2 != 'none') $('.show-sm-down').css('display', 'none');
	 }

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




	// OPCJA 'ROZWIŃ'
	$('.c-post-image>img').on('load', function(){
		let wholeImg = $(this).height();

		if(wholeImg > 800){
			$(this).parent().css('max-height', '600px');
			$(this).parent().css('overflow', 'hidden');
			var sth = $(this).parent().append("<div class='onclickit'>ROZWIŃ</div>");
			$(sth).on('click', function(){
				$(this).animate({"max-height": wholeImg}, 633, function(){});
				$(this).children('.onclickit').css('display', 'none');
			});
		}
	});

	//POSTY
	$('.pst-btn').on('click', function(ev){
		var btn = $(this);
		var btnid = btn.attr('id');

		//przycisk dodaj
		if(btnid == "dodaj"){
			if(btn.hasClass("selected")){
				btn.attr("title", "Dodaj do ulubionych");
			}
			else{
				btn.attr("title", "Usuń z ulubionych");
			}
			btn.toggleClass("selected");
		}
		// - koniec dodaj
//console.log("Link: " + "../../user/" + btnid + "/" + btn.attr('name'));

		$.ajax({
			method: "post",
			url: "../../user/" + btnid + "/" + btn.attr('name'),
			data: { _token: token}
		})
		.done(function(data){

				if(btnid == "like" || btnid == "dislike"){
					$('#like-btn-'+btn.attr('name')).text(data[0]);
					$('#dislike-btn-'+btn.attr('name')).text(data[1]);
				}
		});

		ev.preventDefault();
	});

	$('.show-sm-down').on('click', function(ev){
		ev.preventDefault();
		$(".hidden-sm-down").toggle();
	});

	$(window).on('resize', function(){
		var disp = $('.hidden-sm-down').css('display');
		var disp2 = $('.show-sm-down').css('display');

		if($(window).width() < 768){
			if(disp != 'none') $('.hidden-sm-down').css('display', 'none');
			if(disp2 != 'inline') $('.show-sm-down').css('display', 'inline');
		}
		else{
			if(disp != 'inline') $('.hidden-sm-down').css('display', 'inline');
			if(disp2 != 'none') $('.show-sm-down').css('display', 'none');
		}
	});
});
