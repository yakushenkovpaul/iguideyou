<?php
/*
Plugin Name: Deasil Core
Plugin URI: http://deasil.moldthemes.com
Description: Deasil Core Plugin 
Version: 1.7
Author: Mold Themes
Author URI: http://www.moldthemes.com
Text Domain: deasil-core
Domain Path:  /languages
*/

/*
* Define constant
*/
define('DEASIL_CORE_MAIN_FILE_URL', __FILE__);
define('DEASIL_CORE_VERSION', '1.7');
define('DEASIL_CORE_BASE_URL', plugin_dir_url(__FILE__));

/**
* Localization
*/
if(!function_exists('deasil_load_plugin_textdomain')) {
	function deasil_load_plugin_textdomain() {
		$domain = 'deasil-core';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
		// wp-content/languages/plugin-name/plugin-name-de_DE.mo
		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		// wp-content/plugins/plugin-name/languages/plugin-name-de_DE.mo
		load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
	}
	add_action( 'plugins_loaded', 'deasil_load_plugin_textdomain' );
}

/**
* Enqueue Admin styles and scripts
*/
if(!function_exists('deasil_load_admin_styles')) {
	function deasil_load_admin_styles($hook) {
		wp_enqueue_media();
		wp_enqueue_style('fontawesome', DEASIL_CORE_BASE_URL . 'font/font-awesome/css/font-awesome.css', array(), '4.6.3' );
		wp_enqueue_style('deasil-iconfont', DEASIL_CORE_BASE_URL .'font/iconfont/iconstyle.css', array(), DEASIL_CORE_VERSION);
		wp_enqueue_style('deasil-admin', DEASIL_CORE_BASE_URL .'css/admin.css', array(), DEASIL_CORE_VERSION);

		wp_enqueue_script( 'deasil-datajson', DEASIL_CORE_BASE_URL .'font/iconfont/data.json', array(), DEASIL_CORE_VERSION);
		wp_localize_script('deasil-datajson', 'iconfont', array(
			'pluginsUrl' =>  DEASIL_CORE_BASE_URL
		));

		wp_enqueue_script( 'hideseek_js', DEASIL_CORE_BASE_URL . 'font/iconfont/javascripts/vendor/jquery.hideseek.min.js', array(), DEASIL_CORE_VERSION);
		wp_enqueue_script( 'rainbow_js', DEASIL_CORE_BASE_URL . 'font/iconfont/javascripts/vendor/rainbow-custom.min.js', array(), DEASIL_CORE_VERSION);
		wp_enqueue_script( 'anchor_js', DEASIL_CORE_BASE_URL . 'font/iconfont/javascripts/vendor/jquery.anchor.js', array(), DEASIL_CORE_VERSION);
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_script( 'admin', DEASIL_CORE_BASE_URL . 'js/admin.js', array('jquery'), array(), DEASIL_CORE_VERSION);

		if ( 'nav-menus.php' == $hook ) {
			wp_enqueue_script('deasil-mega-menu-admin-js', DEASIL_CORE_BASE_URL  . '/mega-menu/assets/admin.js', array(), DEASIL_CORE_VERSION);
			wp_enqueue_style('deasil-mega-menu-admin-style', DEASIL_CORE_BASE_URL  . '/mega-menu/assets/admin.css', array(), DEASIL_CORE_VERSION);
		}

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker');


		$bookable = array(
				'addShortcode'	    => esc_html__('Add Shortcode', 'deasil-core'), //Used in tinymce-plugin.js
				'insertShortcode'	    => esc_html__('Insert Shortcode', 'deasil-core'),

				'button'	    => esc_html__('Button', 'deasil-core'),
				'label'	    		=> esc_html__('Label', 'deasil-core'),
				'buttonSize'	    => esc_html__('Button Size', 'deasil-core'),
				'buttonColor'	    => esc_html__('Button Color', 'deasil-core'),

				'infoBox'	    	=> esc_html__('Info Box', 'deasil-core'),
				'title'	   			=> esc_html__('Title', 'deasil-core'),
				'backgroundColor'	=> esc_html__('Background Color', 'deasil-core'),
				'textColor'	    => esc_html__('Text Color', 'deasil-core'),
			);
		wp_localize_script( 'admin', 'shortcode', $bookable );


		global $post;
		if ( is_object( $post ) && $post->post_type=='product' ) {
			$is_deasil_trip = get_post_meta( $post->ID, 'is_deasil_trip', true ); 
			wp_enqueue_script( 'productadmin', DEASIL_CORE_BASE_URL . 'js/productadmin.js', array('jquery'), array(), DEASIL_CORE_VERSION);
			$bookable = array(
				'bookable'      	=> $is_deasil_trip, //used in admin.js
			);
			wp_localize_script( 'admin', 'trip', $bookable );
		}  
		
	} 
	add_action( 'admin_enqueue_scripts', 'deasil_load_admin_styles' );
}

/**
* Enqueue Frontend styles and scripts
*/
if(!function_exists('deasil_enqueue_styles_scripts_plugin')) {

	function deasil_enqueue_styles_scripts_plugin(){
		wp_enqueue_style( 'animatecss', DEASIL_CORE_BASE_URL . 'css/animate.css', array(), DEASIL_CORE_VERSION);
		wp_enqueue_style( 'deasil-core', DEASIL_CORE_BASE_URL . 'css/core.css', array(), DEASIL_CORE_VERSION);
		wp_enqueue_style( 'deasil-iconfont-font', DEASIL_CORE_BASE_URL . 'font/iconfont/iconstyle.css', array(), DEASIL_CORE_VERSION);

		wp_enqueue_script('waypoint', DEASIL_CORE_BASE_URL  . 'js/jquery.waypoints.js', array('jquery'), '', false);
		wp_enqueue_script('counterup', DEASIL_CORE_BASE_URL . 'js/countnumbers.js',  array('waypoint'), '', false);
	}
	add_action('wp_enqueue_scripts', 'deasil_enqueue_styles_scripts_plugin', 200);
}



/**
* Deasil Setting Customizer
*/
require 'customizer/deasil_setting.php';


/**
* Nav Walker for Mega menu
*/
require 'mega-menu/bootstrap-nav-walker.php';
require 'mega-menu/cart-menu.php';


/**
 * Taxonomy
 */
require 'taxonomy/class-grade-taxonomy.php';
require 'taxonomy/class-location-taxonomy.php';

/**
 * Widget
 */
require 'widget/grade-widget.php';
require 'widget/location-widget.php';
require 'widget/searc-tour-widget.php';
require 'widget/social-icons.php';

/**
 * WooCommerce Support
 */
require 'woocommerce/misc.php';
require 'woocommerce/product-trip.php';

require 'woocommerce/additional-info.php';
require 'woocommerce/overview.php';
require 'woocommerce/itinerary.php';
require 'woocommerce/cost-book.php';

/**
 * Trim zeros in price decimals
 **/
add_filter( 'woocommerce_price_trim_zeros', '__return_true' );
require 'helper/minmax-price.php';

/**
 * Visual Customizer Expand
 */
require 'vc/vc-expand.php';

/**
 * Shortcode for tinymce Expand
 */
require 'tmce/deasil-mce.php';


/**
 * Add Custom post type Deasil Team
 */
require 'deasil-team/register-team.php';
require 'deasil-team/team-metabox.php';

// Enable font size & font family selects in the editor
if ( ! function_exists( 'deasil_core_mce_buttons' ) ) {
	function deasil_core_mce_buttons( $buttons ) {
		//array_unshift( $buttons, 'fontselect' ); 
		array_unshift( $buttons, 'fontsizeselect' ); 
		return $buttons;
	}
}
add_filter( 'mce_buttons_2', 'deasil_core_mce_buttons' );
if ( ! function_exists( 'wpex_mce_text_sizes' ) ) {
	function wpex_mce_text_sizes( $initArray ){
		$initArray['fontsize_formats'] = ".8em .9em 1em 1.2em 1.5em 2em 2.5 3em 4em 5em";
		return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'wpex_mce_text_sizes' );