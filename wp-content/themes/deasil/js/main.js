(function($){
	"use strict";
	$(document).ready(function(){
		deasil_stickyNavbarShrink('nav-menu');
		deasil_reponsiveNav('nav-menu');
		deasil_navwidthresponsive();
		deasil_heightAdjust();

		$('.auto-menu .page_item_has_children > a, .auto-menu .menu-item-has-children > a').append('<span class="caret"></span>');
		$('.auto-menu .page_item_has_children > a, .auto-menu .menu-item-has-children > a').on('click touchend', function (e){
			e.preventDefault();
			$(this).siblings('ul.children, ul.sub-menu').toggle();
		});


		if($(window).width() > 768){
			$('.woocommerce .products .item-desc').deasil_equalHeight();
			$('#footer [class^="col-"]').deasil_equalHeight();
			$('.team-member .member').deasil_equalHeight();
		}

		$('[data-toggle="tooltip"]').tooltip({container: 'body'});

		$('.datepicker, #datepicker').datepicker();
		$('[data-toggle="popover"]').popover();

		if (!$("body").hasClass("rtl")) {
			deasil_hideloading();
		}
		
	});

	$(window).on('resize', function(){
		deasil_stickyNavbarShrink('nav-menu');
		deasil_reponsiveNav('nav-menu');
		deasil_navwidthresponsive();
		deasil_heightAdjust();

		if($(window).width() > 768){
			$('.woocommerce .products .item-desc').deasil_equalHeight();
			$('#footer [class^="col-"]').deasil_equalHeight();
			$('.team-member .member').deasil_equalHeight();
		}
		else{
			$('.woocommerce .products .item-desc').css('height', '');
			$('#footer [class^="col-"]').css('height', '');
			$('.team-member .member').css('height', '');
		}
	});


	$(window).load(function(){
		if( $('html').attr('dir') == 'rtl' ){
			$('[data-vc-full-width="true"]').each( function(i,v){
				$(this).css('right' , $(this).css('left') ).css( 'left' , 'auto');
			});
			deasil_hideloading();
		}
	});

	function deasil_showloading(){
		$('.pre-loader').show();
	}
	function deasil_hideloading(){
		$('.pre-loader').fadeOut('slow');
	}
	/*preloader ends*/

	function deasil_stickyNavbarShrink(getnav){
		//var aboveHeight = $('.nav-menu').height();
		var aboveHeight = 2;
		var winwidth = $(window).width();
		if(winwidth > 768){
			if ($(window).scrollTop() > aboveHeight){
				$('.'+getnav).addClass('fixed');
			}
			else {
				$('.'+getnav).removeClass('fixed');
			}
			/*when scroll*/
			$(window).scroll(function(){
				if ($(window).scrollTop() > aboveHeight){
					$('.'+getnav).addClass('fixed');
				}
				else {
					$('.'+getnav).removeClass('fixed');
				}
			});
		}
		else{
			$('.'+getnav).removeClass('fixed');
			$(window).scroll(function(){
				$('.'+getnav).removeClass('fixed');
			});
		}
	}

	function deasil_reponsiveNav(getnav){
		deasil_navigationprevent();
		var winwidth = $(window).width();
		$('.'+getnav+' nav .dropdown').unbind();
		if(winwidth > 768){
			$('.'+getnav+' nav .dropdown').on({  
				mouseenter: function(){   
					$(this).children('.dropdown-menu').stop( true, true ).slideDown('fast');
					$('.dropdown').removeClass('open');
					$(this).toggleClass('open');
				},
				mouseleave: function(){
					$(this).children('.dropdown-menu').stop( true, true ).hide();
					$(this).removeClass('open');      
				}
			});
		}
		else{
			$('.'+getnav+' nav .dropdown').off('mouseover');
			$('.'+getnav+' nav .dropdown-menu').removeAttr('style');
		}
	}
	/*prevents click in small device*/
	function deasil_navigationprevent(){
		$('a.dropdown-toggle').on('click',function(e){
			var winwidth = $(window).width();
			if(winwidth <= 768){
				e.preventDefault();
			}
		});
	}


	function deasil_navwidthresponsive(){
		var navbarwidth = $('#primary-menu > ul').width() + $('.navbar-header').width() + 120;
		if(navbarwidth > $(window).width()){
			$('body').addClass('static-menu');
		}
		else{
			$('body').removeClass('static-menu');
		}
	}


	function deasil_heightAdjust(){
		var winwidth = $(window).width();
		var winheight = $(window).height();
		var textheight = $('.center-txt').height();
		var bodyheight = 0;
		var top = 0;
		if(winheight > 700 || winheight > winwidth){
			bodyheight = winheight;
			$('.full-height').css('min-height', bodyheight+'px');
			if(winwidth < 768){
				$('.full-height').css('min-height', (bodyheight - $('.nav-menu').height())+'px');
			}
		}
		else{
			bodyheight = 700;
			$('.full-height').css('min-height', bodyheight+'px');
		}

		$(".center-txt").each(function() {
			var content_height = $('.center-txt').height();
			$(this).css('top', (($(this).closest('.main-img').height() - content_height)/2+'px'));
		});
		
	}

	/*footer equal height*/
	$.fn.extend({
		deasil_equalHeight: function(){
			var heights = $(this).map(function ()
			{
				return $(this).height();
			}).get(),
			maxHeight = Math.max.apply(null, heights);
			$(this).height(maxHeight);
		}
	});


})(jQuery);