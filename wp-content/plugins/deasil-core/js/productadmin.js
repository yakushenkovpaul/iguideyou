(function($){
	"use strict";
	$(document).ready(function(){

		if(trip.bookable == 'on'){
			$('#is_deasil_trip').prop( "checked", true );
		}
		else{
			$('#is_deasil_trip').prop( "checked", false );
		};

		$('#is_deasil_trip').on('change', function(){
			$('.deasil-cost-book, .deasil-overview, .deasil-itinerary').toggleClass('show_if_simple hide_if_simple').toggle();
		});


		/*Overview*/
		$('#add-overview-info').on('click', function(){
			var form_count = parseInt($('.form-count').val(), 10);
			var new_count = form_count+1;

			$('.overview-form').append('<div class="form-field"><div class="formicon" data-icon-id="'+form_count+'"><i class="no-icon icon" id="formicon'+form_count+'"></i></div><input type="hidden" name="formicon'+form_count+'" id="formicon_hidden'+form_count+'" value="" /><input type="text" placeholder="Title" name="formtitle'+ form_count +'" value="" /><input type="text" placeholder="Value" name="formvalue'+ form_count +'" value="" /><div class="btn-delete"></div></div>');
			$('.form-count').val(new_count);

		});

		/*Itinerary*/
		$('#add-itinerary-info').on('click', function(){
			var form_count = parseInt($('#form-count').val(), 10);
			var new_count = form_count+1;

			$('.itinerary-form').append('<div class="form-field"><div class="formicon" data-icon-id="'+form_count+'"><i class="no-icon icon" id="formicon'+form_count+'"></i></div><input type="hidden" name="itineraryformicon'+form_count+'" id="formicon_hidden'+form_count+'" value="" /><input type="text" class="input-day" name="itineraryformday'+ form_count +'" value="" /><textarea class="input-title"  name="itineraryformtitle'+ form_count +'"></textarea><textarea class="input-desc" name="itineraryformvalue'+ form_count +'"></textarea><div class="btn-delete"></div></div>');
			$('#form-count').val(new_count);

		});


		
		$('body').on('click','.overview-form .formicon', function(){
			var icon_id = $(this).attr('data-icon-id');
			$('#icon-holder-overview').val(icon_id);
			var classremove =  $(this).find('#formicon'+icon_id).attr('class');
			$('#deasil-popup-overview').dialog({
				width: 600,
				open: function(event, ui) {
					$.each( dataJson, function( key, value ) {
						$('#deasil-popup-overview #icon-list-overview').append( "<li class='iconfont " + value.name + " ' data-shortcode=" + value.name + ">"+ value.name +"</li>" );
					});
					$('body').on('click','#icon-list-overview .iconfont', function(){
						var id_holder = $('#icon-holder-overview').val();
						var class_value = $(this).attr('data-shortcode');
						$('.overview-form #formicon_hidden'+id_holder).val(class_value);
						$('.overview-form #formicon'+id_holder).removeClass(classremove);
						$('.overview-form #formicon'+id_holder).addClass(class_value);
						$('#deasil-popup-overview #icon-list-overview').html('');
						$('#deasil-popup-overview').dialog('close');
					});
				}
			});   
		});

		$('body').on('click','.itinerary-form .formicon', function(){
			var icon_id = $(this).attr('data-icon-id');
			$('#icon-holder-itinerary').val(icon_id);
			var classremove =  $(this).find('#formicon'+icon_id).attr('class');
			$('#deasil-popup-itinerary').dialog({
				width: 600,
				open: function(event, ui) {
					$.each( dataJson, function( key, value ) {
						$('#deasil-popup-itinerary #icon-list-itinerary').append( "<li class='iconfont " + value.name + " ' data-shortcode=" + value.name + ">"+ value.name +"</li>" );
					});
					$('body').on('click','#icon-list-itinerary .iconfont', function(){
						var id_holder = $('#icon-holder-itinerary').val();
						var class_value = $(this).attr('data-shortcode');
						$('.itinerary-form #formicon_hidden'+id_holder).val(class_value);
						$('.itinerary-form #formicon'+id_holder).removeClass(classremove);
						$('.itinerary-form #formicon'+id_holder).addClass(class_value);
						$('#deasil-popup-itinerary #icon-list-itinerary').html('');
						$('#deasil-popup-itinerary').dialog('close');
					});
				}
			});   
		});

		/*for both overview and itinerary*/
		$('body').on('click','.btn-delete', function(){
			$(this).closest('.form-field').remove();
		});
		/*Overview ends*/

	});


})(jQuery);