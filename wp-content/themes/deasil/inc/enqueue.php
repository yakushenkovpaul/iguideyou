<?php
/**
*Google font enqueue
*/
if(!function_exists('deasil_google_font')) {
	function deasil_google_fonts_url() {
		$head_font = get_theme_mod( 'head_font' );
		$body_font = get_theme_mod( 'body_font' );

		if ($head_font != '0' && $body_font != '0'){
			$head_import = preg_replace('/\s+/', '+', $head_font);
			$body_import = preg_replace('/\s+/', '+', $body_font);
			$font_url = add_query_arg( 'family', ( $head_import .  '|' . $body_import . ':400,400i,800,800i&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
		} 
		else if ($head_font != '0' && $body_font == '0'){
			$head_import = preg_replace('/\s+/', '+', $head_font);
			$font_url = add_query_arg( 'family', ( $head_import .  '|' . 'Open Sans' . ':400,400i,800,800i&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
		}
		else if ($head_font == '0' && $body_font != '0'){
			$body_import = preg_replace('/\s+/', '+', $body_font);
			$font_url = add_query_arg( 'family', ( '"Montserrat"' .  '|'  . $body_import . ':400,400i,800,800i&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
		} 
		else{
			$font_url = add_query_arg( 'family', ( 'Montserrat|Open Sans:400,400i,800,800i&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
		}

		return $font_url;
	}
	function deasil_google_font() {
		wp_enqueue_style( 'google-fonts', deasil_google_fonts_url() , array(), DEASIL_VERSION);
	}
	add_action( 'wp_enqueue_scripts', 'deasil_google_font' );
}



/**
*Enqueue scripts and styles.
*/
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
if(!function_exists('deasil_enqueue_styles_scripts')) {
	function deasil_enqueue_styles_scripts(){

		wp_enqueue_style( 'deasil-style', get_stylesheet_uri() );
		wp_enqueue_script( 'deasil-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), DEASIL_VERSION );

		/*comment toggle on reply click*/
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), '3.3.5');
		wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/font/font-awesome/css/font-awesome.css', array(), '4.6.3' );
		wp_enqueue_style('deasil-jqueryui', get_template_directory_uri() . '/assets/css/jqueryui.css', array(), DEASIL_VERSION);

		wp_register_style( 'deasil-woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), DEASIL_VERSION );
		if ( class_exists( 'woocommerce' ) ) {
			wp_enqueue_style( 'deasil-woocommerce' );
		}
		
		wp_enqueue_style('deasil-main', get_template_directory_uri() . '/assets/css/main.css', array(), '4.6.3' );
		wp_style_add_data( 'deasil-main', 'rtl', 'replace' );
		
		wp_enqueue_script( 'jqueryui', get_template_directory_uri() . '/vendor/jqueryui/jquery-ui-1.10.3.custom.min.js', array('jquery'), '1.10.3', true );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/vendor/bootstrap/dist/js/bootstrap.js', array('jquery'), '3.3.5', true );
		
		wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/vendor/lightbox/js/lightbox.js', array('jquery'), '2.7.1', true );
		wp_enqueue_script( 'owlcarousel', get_template_directory_uri() . '/vendor/owlcarousel/owl.carousel.js', array('jquery'), '2.0.0');
		wp_enqueue_script( 'js.cookie', get_template_directory_uri() . '/js/js.cookie.js', array('jquery'), DEASIL_VERSION, true );
		wp_enqueue_script( 'deasil-main', get_template_directory_uri() . '/js/main.js', array('jquery'), DEASIL_VERSION, true );

		global $post;
		$post_type = get_post_type(get_the_ID());
		if ( is_object( $post ) && ($post_type == 'product') ) {
			wp_enqueue_script( 'deasil-trip-detail', get_template_directory_uri() . '/js/tripdetailpage.js', array('jquery'), DEASIL_VERSION, true );
		}
		wp_enqueue_script( 'deasil-archive-page', get_template_directory_uri() . '/js/archivepage.js', array('jquery'), DEASIL_VERSION, true );
	}
	add_action('wp_enqueue_scripts', 'deasil_enqueue_styles_scripts', 1);

}

/**
* Admin Enqueue scripts and styles.
*/
if(!function_exists('deasil_admin_enqueue_styles_scripts')) {
	function deasil_admin_enqueue_styles_scripts() {
		wp_enqueue_script( 'deasil_customizer_js', get_template_directory_uri()  . '/js/customizer.js', array( 'customize-preview' ), DEASIL_VERSION, true );
	}
	add_action( 'admin_enqueue_scripts', 'deasil_admin_enqueue_styles_scripts' );
}


/**
* Login Page Enqueue scripts and styles.
*/
if(!function_exists('deasil_login_logo')) {
	function deasil_login_logo() { 
		if(get_theme_mod('logo') != ''){
			
			$primary_color = get_theme_mod( 'primary_color' );
			$base_color = get_theme_mod( 'base_color' );
			$logo_url = get_theme_mod('logo');
			if($primary_color == ''){
				$primary_color = '#558b2f';
			}
			if($base_color == ''){
				$base_color = '#111';
			}

			wp_enqueue_style(
				'login-style',
				get_template_directory_uri() . '/assets/css/login.css'
			);
			$login_css = "#login h1 a, .login h1 a {
				background-image: url({$logo_url});
				background-color: {$base_color};
				border-radius: 5px 5px 0 0;
			}
			.login form{
				border-radius: 0 0 5px 5px;	
			}
			.login #login_error, .login .message{
				border-left-color: {$primary_color} !important;
			}
			.login .button-primary{
				background: {$primary_color} !important;
			}
			input[type=text]:focus,
			input[type=email]:focus{
				border-color: {$primary_color} !important;
			}

			.login a:focus,
			.login a:hover{
				color: {$primary_color} !important;
			}";
			wp_add_inline_style( 'login-style', $login_css );
		}

	}
	add_action( 'login_enqueue_scripts', 'deasil_login_logo' );
}