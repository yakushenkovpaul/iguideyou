(function($){
	"use strict";
	$(document).ready(function(){
		$('#menu-to-edit > .menu-item').each(function(index, el){
			if ($(el).hasClass('menu-item-depth-0')) {
				$(el).find('.item-title').append('<span title="Enable Mega Menu" class="deasil-mega-menu-button"><i class="fa fa-gear"></i></span>');	
				
				var current = $(el).find('.edit-menu-item-classes').val();

				if (current.indexOf('deasil-mega-menu') > -1) {
					$(el).find('.deasil-mega-menu-button').addClass('active');
				}


				var col = $(el).find('.edit-menu-item-classes').val();
				col = current.match(/deasil-col-[0-9]*/);
				col = (col && col.length) ? col[0].replace('deasil-col-', '').trim() : 2;	


				var width = $(el).find('.edit-menu-item-classes').val();
				width = current.match(/deasil-width-[a-z]*/);
				width = (width && width.length) ? width[0].replace('deasil-width-', '').trim() : "fullwidth";	


				if (current.indexOf('deasil-mega-menu') > -1) {
					$(el).find('.item-title').append('<select title="Choose number of column" class="deasil-mega-menu-select-col" style=""><option value="6" '+((col == 6) ? 'selected' : '')+'>6</opton><option value="5" '+((col == 5) ? 'selected' : '')+'>5</opton><option value="4" '+((col == 4) ? 'selected' : '')+'>4</opton><option value="3" '+((col == 3) ? 'selected' : '')+'>3</opton><option value="2" '+((col == 2) ? 'selected' : '')+'>2</opton></select><select title="Choose menu width" class="deasil-mega-menu-select-width" style=""><option value="fullwidth" '+((width == "fullwidth") ? 'selected' : '')+'>Full Width</opton><option value="menuwidth" '+((width == "menuwidth") ? 'selected' : '')+'>Menu Width</opton></select>');
				}
				else{
					$(el).find('.item-title').append('<select title="Choose number of column" class="deasil-mega-menu-select-col" style="display: none;"><option value="6" '+((col == 6) ? 'selected' : '')+'>6</opton><option value="5" '+((col == 5) ? 'selected' : '')+'>5</opton><option value="4" '+((col == 4) ? 'selected' : '')+'>4</opton><option value="3" '+((col == 3) ? 'selected' : '')+'>3</opton><option value="2" '+((col == 2) ? 'selected' : '')+'>2</opton></select><select title="Choose menu width" class="deasil-mega-menu-select-width" style="display: none;"><option value="fullwidth" '+((width == "fullwidth") ? 'selected' : '')+'>Full Width</opton><option value="menuwidth" '+((width == "menuwidth") ? 'selected' : '')+'>Menu Width</opton></select>');
				}
				
			}
		});
		
		$('.deasil-mega-menu-button').on('click', function(){
			var input = $(this).parents('.menu-item').find('.edit-menu-item-classes');
			var select_btn = $(this).siblings('.deasil-mega-menu-select-col');
			var select_width = $(this).siblings('.deasil-mega-menu-select-width');
			var new_class = 'deasil-mega-menu deasil-col-' + select_btn.val() + ' deasil-width-' + select_width.val();
			input.val(new_class);
			$(this).toggleClass('active');
			if ($(this).hasClass('active')) {
				input.val('deasil-mega-menu ' + input.val().trim());
				select_btn.show();
				select_width.show();
			} else {
				input.val('');
				select_btn.hide();
				select_width.hide();
			}
		});

		$('.deasil-mega-menu-select-col, .deasil-mega-menu-select-width').on('change', function(){

			var input = $(this).closest('.menu-item').find('.edit-menu-item-classes');
			var select_col = $(this).parent('.item-title').find('.deasil-mega-menu-select-col').val();
			var select_width = $(this).parent('.item-title').find('.deasil-mega-menu-select-width').val();

			var new_class = 'deasil-mega-menu deasil-col-' + select_col + ' deasil-width-' + select_width;
			console.log(new_class);
			input.val(new_class);
		});
	});
})(jQuery);