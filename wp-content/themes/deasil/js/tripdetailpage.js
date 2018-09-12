 jQuery(function($) {
 	"use strict";
 	$(document).ready(function(){
 		var trip_insight = $(".insight-list-wrap");
 		if(trip_insight.children('.insight-list').length > 1){
 			trip_insight.owlCarousel({
 				animateOut: 'fadeOut',
 				autoplay: true,
                smartSpeed: 500,
 				items:4,
 				loop:true,
 				dots:false,
 				stagePadding:0,
 				responsiveClass:true,
 				responsive:{
 					0:{
 						items:1
 					},
 					700:{
 						items:4
 					}
 				}
 			});
 		}
        deasil_galleryOWl();
 	});

     $(window).resize(function() {
         deasil_galleryOWl();
     });

     function deasil_galleryOWl(){
         var winWidth = $(window).width();
         var owlGallery = $("#trip-gallery");
         if(winWidth < 768){
             owlGallery.owlCarousel({
                 animateOut: 'fadeOut',
                 autoplay: true,
                 items:1,
                 loop:true,
                 dots:false,
                 nav:true,
                 navText: ['<span class="icon-arrow-left"><span>','<span class="icon-arrow-right"><span>'],
                 stagePadding:0
             });
         }
         else{
             owlGallery.trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
             owlGallery.find('.owl-stage-outer').children(':eq(0)').unwrap();
         }
     }


 	$('.nav-tabs > li > a').on('click', function(e) {
 		e.preventDefault();
 		$(this).tab('show');
 	});

 	$('#single_add_to_cart_button').on('click', function(){
 		$('.wc-tabs a[href="#tab-cost_book"]').tab('show');
 		$('.woocommerce-Tabs-panel').hide();
 		$('#tab-cost_book').show();
 	});
 })
