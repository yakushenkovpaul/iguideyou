<?php

function deasil_customize_css(){
	$head_font = get_theme_mod('head_font', 'Sans-serif');
	$body_font = get_theme_mod('body_font', 'Sans-serif');

	if($head_font == '0'){
		$head_font = 'Sans-serif';
		// $head_font = 'Open Sans,Arial,sans-serif';
	}
	
	if($body_font == '0'){
		$body_font = 'Sans-serif';
		// $body_font = 'Open Sans,Arial,sans-serif';
	}
	
	$font_color = '#444444';
	$font_size_base = '16px';
	$font_line_height = '1.6';
	$primary_color = get_theme_mod('primary_color', '#558b2f');
	$base_color = get_theme_mod('base_color', '#111111');

	$screen_md = '992px';

	$primary = new Color($primary_color);
	$base = new Color($base_color);

	$primary_50  = '#'.$primary->lighten(37);
	$primary_100 = '#'.$primary->lighten(28);
	$primary_200 = '#'.$primary->lighten(20);
	$primary_300 = '#'.$primary->lighten(12);
	$primary_400 = '#'.$primary->lighten(6);
	$primary_500 = $primary_color;
	$primary_600 = '#'.$primary->darken(6);
	$primary_700 = '#'.$primary->darken(12);
	$primary_800 = '#'.$primary->darken(18);
	$primary_900 = '#'.$primary->darken(24);
	$primary_contrast = $primary->isDark() ? "#eeeeee":"#333333";

	$base_50  = '#'.$base->lighten(37);
	$base_100 = '#'.$base->lighten(28);
	$base_200 = '#'.$base->lighten(20);
	$base_300 = '#'.$base->lighten(12);
	$base_400 = '#'.$base->lighten(6);
	$base_500 = $base_color;
	$base_600 = '#'.$base->darken(6);
	$base_700 = '#'.$base->darken(12);
	$base_800 = '#'.$base->darken(18);
	$base_900 = '#'.$base->darken(24);
	$base_contrast = $base->isDark() ? "#eeeeee":"#333333";


	$body_bg = '#ffffff';

	$gray_50 =  '#e6e6e6';
	$gray_100 = '#cfcfc';
	$gray_200 = '#bbbbbb';
	$gray_300 = '#a7a7a7';
	$gray_500 = '#888888';
	$gray_600 = '#797979';
	$gray_700 = '#696969';
	$gray_800 = '#5a5a5a';
	$gray_900 = '#4b4b4b';

	?>
	<style id="deasil-css" type="text/css">
	/*---------- 1.1 Base/_normalize ----------*/
	body{
		font-family: <?php echo $body_font;?>;
		color: <?php echo $font_color;?>;
		font-size: <?php echo $font_size_base;?> !important;
		line-height: <?php echo $font_line_height;?>;
	}


	h1, h2, h3, h4, h5, h6, .navbar-brand, .nav-bar, .nav-bar a{
		font-family: <?php echo $head_font;?>;
	}

	a{
		color: <?php echo $primary_color;?>;

	}
	a:hover, a:focus{
		color: <?php echo $primary_700;?>;
	}



	/*---------- 2.2 Modules/_navigation ----------*/

	.nav-menu .icon-bar{
		background: <?php echo $base_contrast;?>
	}
	.nav-menu.base .navbar{
		background: <?php echo $base_color;?>;
	}
	.nav-menu.overlay{
		border-bottom: 0px;
	}
	.nav-menu.overlay .navbar{
		background: <?php echo hex2rgba($base_color, 0.5);?>; 
	}
	.nav-menu  .navbar.transparent{
		background: transparent;
	}
	.nav-menu  .navbar .navbar-brand{
		color: <?php echo $base_contrast;?>;
	}

	.nav-menu .default-menu > ul > li > a{
		font-family: <?php echo $body_font;?>;
		font-weight: normal;
		color: <?php echo $base_contrast;?>;
	}
	.nav-menu .default-menu > ul > li > a:focus *[class^="icon"],
	.nav-menu .default-menu > ul > li > a:hover *[class^="icon"]{
		color: <?php echo $primary_color;?>;
	}

	.nav-menu .default-menu > ul > li .dropdown-menu, 
	.nav-menu .default-menu > ul > li .children, 
	.nav-menu .default-menu > ul > li .sub-menu{
		background: <?php echo hex2rgba($base_color, 0.8)?>;
		color: <?php echo $primary_color;?>;
	}
	.nav-menu .default-menu > ul > li .dropdown-menu li, 
	.nav-menu .default-menu > ul > li .children li, 
	.nav-menu .default-menu > ul > li .sub-menu li{
		border-bottom: 1px solid <?php echo hex2rgba($base_contrast, 0.1)?>;
	}
	.nav-menu .default-menu > ul > li .dropdown-menu li:hover, 
	.nav-menu .default-menu > ul > li .children li:hover, 
	.nav-menu .default-menu > ul > li .sub-menu li:hover{
		background: <?php echo $base_600;?>;
	}
	.nav-menu .default-menu > ul > li .dropdown-menu a, 
	.nav-menu .default-menu > ul > li .children a, 
	.nav-menu .default-menu > ul > li .sub-menu a{
		color: <?php echo $base_contrast;?>;
	}
	.nav-menu .default-menu > ul > li .dropdown-menu a:hover, 
	.nav-menu .default-menu > ul > li .children a:hover, 
	.nav-menu .default-menu > ul > li .sub-menu a:hover{
		color: <?php echo $primary_color;?>;
	}


	.nav-menu .default-menu > ul > li .dropdown-menu h5, 
	.nav-menu .default-menu > ul > li .children h5, 
	.nav-menu .default-menu > ul > li .sub-menu h5{
		border-bottom: 1px solid <?php echo hex2rgba($base_contrast, 0.1)?>;
	}

	.nav-menu .default-menu > ul > li .dropdown-menu li.hor-line:after, 
	.nav-menu .default-menu > ul > li .children li.hor-line:after, 
	.nav-menu .default-menu > ul > li .sub-menu li.hor-line:after{
		background: <?php echo hex2rgba($primary_color, 0.7)?>;
	}


	.nav-menu .cart-menu{
		background: <?php echo $base_400;?>;
		color: <?php echo $base_color;?>;
	}
	.nav-menu .cart-menu li{
		border-bottom: 1px solid <?php echo hex2rgba($base_contrast, 0.1)?>;
	}
	.nav-menu .cart-menu li [class^='icon-']:hover,
	.nav-menu .cart-menu li .fa:hover,
	.nav-menu .cart-menu li .glyphicon:hover {
		color: <?php echo $primary_color;?>;
	}
	.nav-menu .cart-menu .delete:hover{
		color: <?php echo $primary_color;?>;
	}
	.nav-menu .deasil-mega-menu .dropdown-menu .dropdown-menu:before{
		background: <?php echo $primary_color;?>;
	}

	
	.menu-item:not(.deasil-mega-menu) .dropdown-menu li,
	.menu-item:not(.deasil-mega-menu) ..children li,
	.menu-item:not(.deasil-mega-menu) .sub-menu li
	{
		border-bottom: 1px solid  <?php echo hex2rgba($base_contrast, 0.05)?>;
	}
	.menu-item:not(.deasil-mega-menu) .dropdown-menu li:hover,
	.menu-item:not(.deasil-mega-menu) ..children li:hover,
	.menu-item:not(.deasil-mega-menu) .sub-menu li:hover
	{
		background: <?php echo $primary_color;?>;
	}


	.nav-menu.fixed .navbar{
		background: <?php echo $base_color;?>;
	}
	.nav-menu.fixed .navbar.transparent{
		background: <?php echo $base_color;?>;
	}
	.nav-menu.fixed .navbar-toggle .icon-bar{
		background-color:<?php echo $primary_color;?>;
	}
	.nav-menu.fixed .default-menu > ul > li > a{
		color: <?php echo $base_contrast;?>;
	}
	
	.static-menu .nav-menu {
		border-bottom: 0px;
	}
	.static-menu .nav-menu .navbar{
		background: <?php echo $base_color;?>;
	}

	@media screen and (min-width: 992px) {
		.nav-menu .default-menu > ul & > li:hover > a{
			border-bottom: 4px solid <?php echo $primary_color;?>;
		}
		.nav-menu .default-menu > ul & > li.open > a, 
		.nav-menu .default-menu > ul & > li.open > a.dropdown-toggle,
		.nav-menu .default-menu > ul & > li.open > a:focus,
		.nav-menu .default-menu > ul & > li.open > a:hover,
		.nav-menu .default-menu > ul & > li.open  *[class^="icon"]{
			border-bottom: 4px solid <?php echo $primary_color;?>;
		}
	}

	@media screen and (max-width: 768px) {
		.nav-menu{
			border-bottom: 0px;
		}
		.nav-menu .navbar{
			background: <?php echo $base_color;?> !important;
		}
		.nav-menu .nav > li {
			border-bottom: 1px solid <?php echo hex2rgba($base_contrast, 0.1)?>;
		}

		.nav-menu.fixed .nav > li > a{
			color: <?php echo $base_contrast;?>;
		}
		.nav-menu.fixed .nav > li > a:focus,
		.nav-menu.fixed .nav > li > a:hover,
		{
			color: <?php echo $base_contrast;?>;
		}
	}


	/*---------- 2.4 Modules/_carousel ----------*/
	.carousel .carousel-indicators li{
		background:  #ffffff;
	}
	.carousel .carousel-indicators li.active{
		background: <?php echo $primary_color;?>;
	}

	.main-img.no-bg{
		background: <?php echo $primary_700;?>;
	}

	.main-image-txt .main-header,
	.carousel-caption .main-header{
		font-family: <?php echo $head_font;?>;
	}

	.main-image-txt .main-header:after,
	.carousel-caption .main-header:after{
		border-top: 1px solid <?php echo $primary_color;?>;
	}
	.main-image-txt .main-header hr,
	.carousel-caption .main-header hr{
		border-color: <?php echo $primary_color;?>;
	}
	.main-image-txt .main-header .sub-header,
	.carousel-caption .main-header .sub-header{
		font-family: <?php echo $body_font;?>;
	}



	/*---------- 2.5 Modules/_page-header ----------*/
	.page-img{
		background-color: <?php echo $primary_600;?>;
	}
	.page-img .main-head{
		font-family: <?php echo $head_font;?>;
	}
	.page-img .sub-head{
		font-family: <?php echo $body_font;?>;
	}




	/*---------- 2.6 Modules/_section ----------*/
	.section.base, 
	main.base{
		background: <?php echo $base_color;?>;
		color: <?php echo $base_contrast;?>;
	}
	.section.primary, 
	main.primary{
		background: <?php echo $primary_color;?>;
		color: <?php echo $primary_contrast;?>;
	}



	/*---------- 2.7 Modules/_headline ----------*/
	.main-title h1:after, 
	.main-title h2:after,
	.main-title h3:after,
	.main-title h4:after,
	.main-title h5:after,
	.main-title h6:after{
		border-top: 1px solid  <?php echo $primary_color;?>;
	}

	.main-title.primary{
		color: <?php echo $primary_color;?>;
	}
	.main-title.base{
		color: <?php echo $base_color;?>;
	}
	.section-title{
		font-family: <?php echo $head_font;?>;
	}
	.section-title h1,
	.section-title h2, 
	.section-title h3, 
	.section-title h4, 
	.section-title h5, 
	.section-title h6{
		border-color: <?php echo $primary_color;?>;
	}



	/*---------- 2.8 Modules/_banner ----------*/
	.banner .line-box{
		border: 2px solid <?php echo hex2rgba($primary_color, 0.2);?>;
	}
	.banner .line-box .line-title{
		background: <?php echo $body_bg;?>;
		font-family: <?php echo $head_font;?>;
	}
	.banner.white{
		background: #fff;
		color: <?php echo $font_color;?>;
	}
	.banner.base{
		background: <?php echo $base_color;?>;
		color: <?php echo $base_contrast;?>;
	}
	.banner.base .line-title{
		background: <?php echo $base_color;?>;
	}
	.banner.primary{
		background: <?php echo $primary_color;?>;
		color: <?php echo $primary_contrast;?>;
	}
	.banner.primary .line-box{
		border: 2px solid <?php echo hex2rgba($base_color, 0.7);?>; 
	}
	.banner.primary .line-title{
		background: <?php echo $primary_color;?>;
	}
	.banner.gray{
		background: <?php echo $gray_50;?>;
		color: <?php echo $gray_900?>;
	}
	.banner.gray .line-box{
		border: 2px solid  <?php echo hex2rgba($primary_color, 0.7);?>;
	}
	.banner.gray .line-title{
		background: <?php echo $gray_50;?>;
	}


	/*---------- 2.9 Modules/_counter-number-banner ----------*/
	.counter-div{
		color: <?php echo $primary_color;?>;
	}
	.counter-div .icon-font{
		color: <?php echo $primary_color;?>;
	}
	.counter-div .counter{
		font-family: <?php echo $head_font;?>;
	}

	/*variations*/
	.counter-div.base{
		background: <?php echo $base_color;?>;
		color:  <?php echo $base_contrast;?>;
	}
	.counter-div.base .icon-font{
		color: <?php echo $primary_500;?>;
	}
	.counter-div.base .counter{
		color:  <?php echo $base_contrast;?>;
	}
	.counter-div.base.light{
		background:  <?php echo $base_300;?>;
	}

	.counter-div.primary{
		background:  <?php echo hex2rgba($primary_color, 0.8);?>;
		color: #ffffff;
	}
	.counter-div.primary .icon-font{
		color: #ffffff;
	}
	.counter-div.primary.light{
		background:  <?php echo $primary_300;?>; 
	}


	.counter-div
	.counter{
		font-family: <?php echo $head_font;?>;
	}

	/*variations*/
	.counter-div.gray{
		color: <?php echo $primary_500;?>;
	}



	/*---------- 2.10 Modules/_buttons ----------*/
	.btn, 
	input[type='submit'], 
	.button{
		font-family: <?php echo $head_font;?>;
	}

	input[type='submit'], 
	.btn-primary{
		background: <?php echo $primary_color;?>;
	}

	input[type='submit']:hover, 
	.btn-primary:hover,
	input[type='submit']:focus, 
	.btn-primary:focus{
		background: <?php echo $primary_700;?>;
	}

	.btn-contrast{
		background: <?php echo $primary_contrast;?>;
	}
	.btn-contrast:hover, 
	.btn-contrast:focus{
		background: <?php echo $primary_contrast;?>;
	}

	.btn-base{
		background: <?php echo $base_color;?>;
	}
	.btn-base:hover, 
	.btn-base:focus{
		background: <?php echo $base_700;?>;
	}
	.btn-white{
		color: <?php echo $primary_color;?>;
	}

	.btn-line{
		background: transparent !important;
	}
	.btn-line.btn-primary{
		color: <?php echo $primary_color;?>;
		border-color: <?php echo $primary_color;?>;
	}
	.btn-line.btn-primary:hover{
		color: <?php echo $primary_600;?>;
		border-color: <?php echo $primary_600;?>;
	}
	.btn-line.btn-base{
		color: <?php echo $base_color;?>;
		border-color: <?php echo $base_color;?>;
	}
	.btn-line.btn-base:hover{
		color: <?php echo $base_600;?>;
		border-color: <?php echo $base_600;?>;
	}
	.btn-line.btn-contrast{
		color: <?php echo $primary_contrast;?>;
		border-color: <?php echo $primary_contrast;?>;
	}
	.btn-line.btn-contrast:hover{
		color: <?php echo $primary_contrast;?>;
		border-color: <?php echo $primary_contrast;?>;
	}


	/*---------- 2.12 Modules/_form ----------*/
	.form-control:focus {
		border-color:  <?php echo hex2rgba($primary_color, 0.3);?>;
	}
	.input-group .input-group-addon{
		color: <?php echo $primary_color;?>;
	}



	/*---------- 2.13 Modules/_table ----------*/

	.table-btn-wrap	#table-right, 
	.table-btn-wrap #table-left{
		color: <?php echo $primary_contrast;?>;
		background: <?php echo $primary_color;?>;;
		border: 1px solid <?php echo $primary_color;?>;;
	}




	/*---------- 2.14 Modules/_breadcrumb ----------*/
	.breadcrumb li a:hover{
		color: <?php echo $primary_color;?>;
	}


	/*---------- 2.18 Modules/_blockquotes ----------*/
	blockquote footer{
		color: <?php echo $primary_600;?>;
	}


	/*---------- 2.19 Modules/_pagination ----------*/

	.pagination li.active a, 
	.pagination li.active span{
		background: <?php echo $primary_color;?>;
		color: <?php echo $primary_contrast;?>;
	}



	/*---------- 2.20 Modules/_social-icons ----------*/
	.social{
		margin-bottom: 15px;
	}
	.social	.icon{
		background: <?php echo $primary_color;?>;
		color: #ffffff;
	}
	.social	.icon:hover,
	.social	.icon:focus{
		background: <?php echo $primary_600;?>;
	}


	.social-icon-list li a{
		background: <?php echo $primary_color;?>;
		color: #ffffff;
		font-family: <?php echo $head_font;?>;
	}
	.social-icon-list li a:hover{
		background: <?php echo $primary_600;?>;
	}



	/*---------- 2.21 Modules/_sort-bar ----------*/
	.toogle-view .icon:hover, .toogle-view .icon.active{
		background: <?php echo $primary_color;?>;
		color: #ffffff;
		border: 1px solid <?php echo $primary_color;?>;
	}



	/*---------- 2.22 Modules/_step-timeline ----------*/
	.itinerary-steps [class^='icon-'], 
	.itinerary-steps .fa, 
	.itinerary-steps .glyphicon, 
	.itinerary-steps .no-icon {
		background: <?php echo $primary_contrast;?>;
		color: <?php echo $primary_color;?>;
	}
	.itinerary-steps.primary [class^='icon-'], 
	.itinerary-steps.primary .fa, 
	.itinerary-steps.primary .glyphicon {
		background: <?php echo $primary_color;?>;
		color: <?php echo $primary_contrast;?>;
		border-color: <?php echo $primary_900;?>;
	}
	.itinerary-steps.base [class^='icon-'], 
	.itinerary-steps.base .fa, 
	.itinerary-steps.base .glyphicon {
		background: <?php echo $base_color;?>;
		border-color: <?php echo $base_50;?>;
		color: <?php echo $primary_color;?>;
	}


	.steps.primary .index{
		background: <?php echo $primary_color;?>;
		color: <?php echo $primary_contrast;?>;
	}
	.steps.base .index{
		background: <?php echo $base_color;?>;
		color: <?php echo $base_contrast;?>;
	}


	.timeline.primary .time-module .index [class^='icon-'],
	.timeline.primary .time-module .index .fa,
	.timeline.primary .time-module .index .glyphicon
	{
		background: <?php echo $primary_color;?>;
		color: <?php echo $primary_contrast;?>;
	}
	.timeline.base .time-module{
		color:  <?php echo hex2rgba($base_color, 0.8);?>;
	}
	.timeline.base .time-module .index [class^='icon-'],
	.timeline.base .time-module .index .fa,
	.timeline.base .time-module .index .glyphicon
	{
		background: <?php echo $base_color;?>;
		color: <?php echo $base_contrast;?>;	
	}




	/*---------- 2.23 Modules/_feature-list ----------*/
	.circle-icon, 
	.square-icon, 
	.diamond-icon{
		background: <?php echo $primary_color;?>;
	}
	.circle-icon.line, 
	.square-icon.line, 
	.diamond-icon.line{
		border-color:  <?php echo $primary_color;?>;
	}

	.circle-icon.line [class^='icon-'], 
	.square-icon.line .fa, 
	.diamond-icon.line .glyphicon {
		color: <?php echo $primary_color;?>;
	}

	.chat-icon{
		background: <?php echo $primary_color;?>;
	}
	.chat-icon:before{
		border-top-color: <?php echo $primary_color;?>;
	}
	.chat-icon.line{
		border-color:  <?php echo $primary_color;?>;
	}
	.chat-icon.line [class^='icon-'],
	.chat-icon.line .fa,
	.chat-icon.line .glyphicon
	{
		color: <?php echo $primary_color;?>;
	}

	/*---------- 2.24 Modules/_icons ----------*/
	.icon-primary{
		color: <?php echo $primary_color;?>;
	}
	.icon-base{
		color: <?php echo $base_color;?>;
	}

	/*---------- 2.25 Modules/_testimonial ----------*/

	.testimonial-wrap.bg-image:before{
		background: rgba(0,0,0, .3);
	}

	.testimonial-wrap.primary{
		background: <?php echo $primary_color;?>;
		color: <?php echo $primary_contrast;?>;
	}
	.testimonial-wrap.primary .testimonial-item > div{
		border-color: <?php echo $primary_400;?>;
	}

	.testimonial-wrap.base{
		background: <?php echo $base_color;?>;
		color: <?php echo $base_contrast;?>;
	}
	.testimonial-wrap.base .testimonial-item > div{
		border-color: <?php echo $base_300;?>;
	}
	.testimonial-wrap.base p{
		color: <?php echo $base_contrast;?>;
	}


	.testimonial .name{
		font-family: <?php echo $head_font;?>;
	}
	.testimonial.dark{
		outline: 1px solid <?php echo $primary_900;?>;
	}
	.testimonial.dark:before{
		background: rgba(0,0,0,.8);
	}



	.testimonial .owl-nav [class*='owl-']{
		background: <?php echo $primary_color;?>;
	}
	.testimonial .owl-nav [class*='owl-']:hover{
		background: <?php echo $base_color;?>;
	}
	.testimonial .owl-nav [class*='owl-']:hover {
		background: <?php echo $primary_600;?>;
	}

	.testimonial .owl-dots .owl-dot span {
		background: <?php echo $primary_color;?>;
	}
	.testimonial .owl-dots .owl-dot.active span,
	.testimonial .owl-dots .owl-dot:hover span {
		background: <?php echo $primary_contrast;?>;
	}


	/*---------- 2.28 Modules/_search-bar ----------*/
	.search-bar{
		background: <?php echo $base_color;?>;
		color: <?php echo $base_contrast;?>;
	}
	.search-bar label{
		color: <?php echo $base_contrast;?>;
	}
	.search-bar .form-control{
		border: 1px solid  <?php echo hex2rgba($base_contrast, 0.7);?>;
	}



	/*---------- 2.29 Modules/_sidebar ----------*/
	.sidebar .btn-group[data-toggle="buttons"] .btn-default.active{
		color: <?php echo $primary_color;?>;
	}


	/*---------- 2.31 Modules/_image-gallery ----------*/

	#trip-gallery .trip-gallery-item .hover-overlay{
		background: <?php echo hex2rgba($primary_900, 0.3);?>;
	}
	#trip-gallery .trip-gallery-item .hover-overlay [class^="icon-"],
	#trip-gallery .trip-gallery-item .hover-overlay .fa,
	#trip-gallery .trip-gallery-item .hover-overlay .glyphicon
	{
		background: <?php echo $primary_color;?>;
	}

	#trip-gallery .owl-nav .owl-prev,
	#trip-gallery .owl-nav .owl-next{
		background: <?php echo $base_color;?>;
	}


	/*---------- 2.32 Modules/_footer ----------*/
	#footer{
		background: <?php echo $base_color;?>;

	}
	#footer h1:after,
	#footer h2:after,
	#footer h3:after,
	#footer h4:after,
	#footer h5:after,
	#footer h6:after{
		background: <?php echo $primary_color;?>;
	}
	#footer,
	#footer a{
		color:  <?php echo hex2rgba($base_contrast, 0.9);?>; 
	}
	#footer a:hover{
		color: <?php echo $primary_color;?>;
	}
	#footer .copy{
		background: <?php echo hex2rgba($base_contrast, 0.05);?>; 
		color: <?php echo hex2rgba($base_contrast, 0.5);?>; 
	}



	/*---------- 2.33 location Carousel ----------*/
	.location-carousel .location-item:before{
		background: <?php echo hex2rgba($primary_900, 0.4);?>;
	}
	.location-carousel .location-item:after{
		background: <?php echo $primary_color;?>;
		color: #ffffff;
	}
	.location-carousel .location-term{
		font-family: <?php echo $head_font;?>;
	}



	/*---------- 3.2 Partials/_trip-grid ----------*/
	.single-item .item-img .item-overlay{
		color: #ffffff;
		background: <?php echo hex2rgba($primary_900, 0.3);?>;
	}
	.single-item .item-img .item-overlay [class^="icon-"], 
	.single-item .item-img .item-overlay .fa{
		background: <?php echo $primary_color;?>;
	}
	.single-item .item-img .item-overlay a{
		color: #ffffff;
	} 



	/*---------- 3.3 Partials/_trip-detail ----------*/
	ul.trip-overview [class^='icon-'], 
	ul.trip-overview .fa,
	ul.trip-overview .glyphicon {
		color: <?php echo $primary_color;?>;
	}


	/*---------- 3.4 Partials/_blog-page ----------*/
	.post-list .post-img .item-overlay{
		color: #ffffff;
		background: <?php echo hex2rgba($primary_900, 0.3);?>;
	}
	.post-list .post-img .item-overlay [class^="icon-"], 
	.post-list .post-img .item-overlay .fa{
		background: <?php echo $primary_color;?>;
	}
	.post-list .post-img .item-overlay a{
		color: #ffffff;
	} 

	.post-list .post-summary .post-title a{
		color: <?php echo $font_color;?>;
	}
	.post-list .post-summary .post-title a:hover{
		color: <?php echo $primary_color;?>;
	}

	.post-list .post-summary .byline{
		color: <?php echo $gray_300;?>;
	}
	.post-list .post-summary .byline a{
		color: <?php echo $gray_300;?>;
	}
	.post-list .post-summary .byline a:hover{
		color: <?php echo $primary_color;?>;
	}



	.post-single .page-img-txt {
		margin-top: 50px;
	}
	.post-single .page-img-txt a{
		color: #fff;
	}
	.post-single .page-img-txt a:hover{
		color: <?php echo $primary_100;?>;
	}
	.post-single .page-img-txt .author,
	.post-single .page-img-txt  .byline{
		color: #fff;
	}

	.post-single .prev-next-post .prev-next-img{
		background-color: <?php echo $gray_50;?>;
		color: <?php echo $primary_color;?>;
	}

	.tag-wrap a{	
		border:1px solid #fff;	
		color: #fff;
	}
	.tag-wrap a:hover{
		background: <?php echo $primary_color;?>;
		border-color: <?php echo $primary_color;?>; 
		color: #fff !important;
	}




	/*---------- 3.5 Partials/_page-404 ----------*/
	.page-404 .clip-text_one {
		text-shadow: 0 0  1px <?php echo hex2rgba($primary_600, 0.5);?>;
	}
	.page-404 .search-field:before{
		background: <?php echo $primary_color;?>;
	}




	/*---------- 4.1 Partials/_lightbox ----------*/
	.lb-prev, .lb-next {
		background: <?php echo hex2rgba($base_color, 0.7);?>;
	}
	.lb-nav a:hover{
		background: <?php echo $base_color;?>;
		color: <?php echo $primary_color;?>;
	}

	/*---------- 4.2 Vendor/_contact-form-7 ----------*/
	[type='button'].wpcf7-form-control, 
	[type='submit'].wpcf7-form-control{
		background: <?php echo $primary_color;?>;
	}



	/*---------- 4.4 Vendors/_jquery-ui ----------*/

	.ui-datepicker .ui-datepicker-header{
		background: <?php echo hex2rgba($primary_color, 0.1);?>;
		color: <?php echo $font_color;?>;
		padding: 2px 0;
	}
	.ui-datepicker .ui-datepicker-header	.ui-state-hover{
		background: <?php echo hex2rgba($primary_color, 0.9);?>;
	}
	.ui-datepicker td .ui-state-highlight,
	.ui-datepicker td .ui-state-hover{
		background: <?php echo $primary_color;?>;
	}

	.ui-dialog .ui-dialog-buttonset button, 
	.ui-dialog .ui-dialog-buttonset input[type="button"], 
	.ui-dialog .ui-dialog-buttonset input[type="submit"]{
		background: <?php echo $primary_color;?>;
		border: 1px solid <?php echo $primary_color;?>;
		color: #ffffff;
	}


	/*ui-dialog*/
	.ui-dialog-buttonpane .ui-dialog-buttonset .ui-button {
		color: #ffffff;
		background-color: <?php echo $primary_color;?>;
		border-color: <?php echo $primary_600;?>;
	}
	.ui-dialog-buttonpane .ui-dialog-buttonset .ui-button.ui-state-hover{
		color: #ffffff;
		background-color: <?php echo $primary_600;?>;
		border-color: <?php echo $primary_700;?>;
	}



	/*ui-tabs*/
	.ui-tabs .ui-tabs-nav li a:hover{
		background-color: <?php echo $primary_color;?>;
		color: <?php echo $primary_contrast;?>;
	}
	/*bootstrap-select*/
	.bootstrap-select  .btn-default.dropdown-toggle.bs-placeholder:hover{
		color: <?php echo $primary_contrast;?>;
		background: <?php echo $primary_color;?>;
		border-color: <?php echo $primary_600;?>;
	}
	.bootstrap-select  .dropdown-menu > li > a:hover{
		background: <?php echo $primary_color;?>;
		color: <?php echo $primary_contrast;?>;
	}


	/*ui-slider*/
	.ui-slider{
		background: <?php echo $primary_800;?>;
	}
	.ui-slider .ui-slider-handle{
		background: <?php echo $primary_600;?>;
	}
	.ui-slider .ui-slider-range{
		background: <?php echo $primary_500;?>;
	}


	/*---------- Miscellanous/woocommerce ----------*/
	.woocommerce div.product .woocommerce-tabs ul.tabs{
		border-bottom: 5px solid  <?php echo $primary_700;?>;
	}
	.woocommerce div.product .woocommerce-tabs ul.tabs li a{
		font-family: <?php echo $head_font;?>;
	}
	.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover{
		color: <?php echo $primary_color;?>;
	}
	.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover:after{
		background: <?php echo $primary_color;?>;
	}

	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a{
		background: <?php echo $primary_color;?>;
		color: #ffffff;
		border:1px solid <?php echo $primary_600;?>;
		border-bottom: none; 
	}

	.woocommerce .onsale{
		background-color: <?php echo $primary_color;?>;
		color: #ffffff;
	}
	.woocommerce .onsale:before, 
	.woocommerce .onsale:after {
		background: <?php echo $primary_color;?>;
	}

	.widget_product_search .search-field:focus{
		border-color: <?php echo $primary_color;?>;
	}

	.widget_product_search [type='submit']{
		color: <?php echo $primary_contrast;?>;
		background-color: <?php echo $primary_color;?>;
	}

	/*-main woocommerce-*/
	p.demo_store {
		background-color: <?php echo $primary_color;?>;
		color: <?php echo $primary_contrast;?>;
	}
	p.demo_store a {
		color: <?php echo $primary_contrast;?>;
	}

	.woocommerce-breadcrumb a:hover{
		color: <?php echo $primary_color;?>;
	}

	.woocommerce nav.woocommerce-pagination ul li span.current, 
	.woocommerce nav.woocommerce-pagination ul li a:hover, 
	.woocommerce nav.woocommerce-pagination ul li a:focus {
		background: <?php echo $primary_color;?>;
		color: #ffffff;
	}

	.main-image-txt, .carousel-caption .onsale {
		background: <?php echo $primary_500;?>;
		color: #ffffff;
	}
	.main-image-txt, .carousel-caption .onsale:before, 
	.main-image-txt, .carousel-caption .onsale:after {
		background: color: #ffffff;
	}


	a.button,
	button.button,
	input.button,
	#respond input#submit {	 	
		color: #ffffff;
		background-color: <?php echo $primary_color;?>;
	}
	a.button:hover,
	button.button:hover,
	input.button:hover,
	#respond input#submit:hover {	 
		background-color: <?php echo $primary_700;?>;
		text-decoration: none;
		background-image: none;
	}
	a.button.alt,
	button.button.alt,
	input.button.alt,
	#respond input#submit.alt {	
		background-color: <?php echo $primary_color;?>;
		color: #ffffff;
		-webkit-font-smoothing: antialiased;
	}

	.widget_price_filter .ui-slider .ui-slider-handle {
		background-color: <?php echo $primary_600;?>;
		border: 1px solid <?php echo $primary_600;?>;
	}
	.widget_price_filter .ui-slider .ui-slider-range {
		background-color: <?php echo $primary_color;?>;
	}


	.woocommerce-message,
	.woocommerce-error,
	.woocommerce-info {
		background-color: <?php echo $gray_50;?>;
		color: <?php echo $gray_800;?>;
		border-top: 0px;
	}
</style>
<?php
}

add_action( 'wp_head', 'deasil_customize_css', 10);
?>
