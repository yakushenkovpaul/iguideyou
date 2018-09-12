 jQuery(function($) {
 	"use strict";
 	$(document).ready(function(){
 		if(Cookies.get('isgridlist')){
 			var isgridlist = Cookies.get('isgridlist');
 		}
 		else {
 			var isgridlist = 'grid';
 		}
 		if(isgridlist == 'list'){
 			$('.product-grid .toogle-view > .icon').removeClass('active');
 			$('.product-grid .toogle-view > .toggle-list').addClass('active');
 			$('.product-grid').addClass('is-list');	
 			$('.woocommerce .products .item-desc').css('height', '');
 		} 


 		$('.toogle-view > .icon').on('click', function(){
 			var attr = $(this).attr('data-toggle');
 			Cookies.set('isgridlist', attr, { expires: 7 });

 			$('.toogle-view > .icon').removeClass('active');
 			$(this).addClass('active');
 			if(attr == 'list'){
 				$(this).closest('.product-grid').addClass('is-list');	
 				$('.woocommerce .products .item-desc').css('height', '');
 			}
 			else{
 				$(this).closest('.product-grid').removeClass('is-list');
 				$('.woocommerce .products .item-desc').deasil_equalHeight();	
 			}

 		});

 	});

 	$(window).on('resize', function(){

 	});
 })
