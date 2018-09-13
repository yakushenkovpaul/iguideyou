<?php
/**
 * Deasil functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Deasil
 */

// Define constant
define('DEASIL_VERSION', '1.0');
define('DEASIL_BASE_URL', get_template_directory_uri());
define('DEASIL_ASSETS', DEASIL_BASE_URL . '/assets');
define('DEASIL_CSS', DEASIL_BASE_URL . '/assets/css');
define('DEASIL_JS', DEASIL_BASE_URL . '/js');


if ( ! function_exists( 'deasil_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function deasil_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Deasil, use a find and replace
	 * to change 'deasil' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'deasil', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'deasil' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	
	//Registers an editor stylesheet for the theme.
	add_editor_style( 'editor-style.css' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	//Image Background
	$args = array(
		'default-color' => 'ffffff',
	);
	add_theme_support( 'custom-background', $args );

}
endif;
add_action( 'after_setup_theme', 'deasil_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function deasil_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'deasil_content_width', 640 );
}
add_action( 'after_setup_theme', 'deasil_content_width', 0 );


/*diable WPBakery Page Builder (Visual composer) frontend editor*/
if( function_exists('vc_disable_frontend')){
	vc_disable_frontend();
}


/**
 * Register Sidebar for Sidebar and footer widgets
 */
require get_template_directory() . '/inc/register-sidebar.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Load Breadcrumb
 */
require get_template_directory() . '/inc/breadcrumb.php';

/**
 * Load Pagination for blog listing
 */
require get_template_directory() . '/inc/pagination.php';


/**
 * Load Meta Box for page layout
 */
require get_template_directory() . '/inc/page-layout.php';


/**
 * Style and Script enqueue
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Load template tags and alteration 
 */
require get_template_directory() . '/inc/custom.php';


/**
 * TGMA for neccessary plugin installation and recommendation
 */
require get_template_directory() . '/tgm/tgm.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Load Customizer
 */
require get_template_directory() . '/customizer/customizer-library.php';
require get_template_directory() . '/customizer.php';

/**
 * Implement Color / font change
 */
require get_template_directory() . '/inc/color.php';
require get_template_directory() . '/inc/color-hex-rgba.php';
require get_template_directory() . '/function-customizer.php';




function deasil_global_variable() {
	global $deasil_options;
	$deasil_options = get_option('theme_mods_deasil');
	//check database - same as theme-mods_theme-slug
}
add_action( 'init', 'deasil_global_variable' );

add_theme_support('woocommerce');
add_theme_support('wc-product-gallery-lightbox' );
add_theme_support('wc-product-gallery-slider' );



/**
 * One Click Demo Import
 */
function deasil_ocdi_import_files() {
	return array(
		array(
			'import_file_name'           	=> 'All Content',
			'local_import_file'            	=> trailingslashit( get_template_directory() ) . 'demo/deasil.xml',
			'local_import_widget_file'     	=> trailingslashit( get_template_directory() ) . 'demo/deasil.json',
			'local_import_customizer_file' 	=> trailingslashit( get_template_directory() ) . 'demo/deasil.dat',
			'import_preview_image_url'   	=> get_template_directory_uri() . '/demo/home.jpg',
			'import_notice'              	=> esc_html__( 'Import all pages, post, widget, customizer setting.', 'deasil' ),
			'preview_url'                	=> 'http://deasil.moldthemes.com',
		),
		array(
			'import_file_name'           => 'HomePage',
			'categories'                 => array( 'Home Pages' ),
			'local_import_file'          => trailingslashit( get_template_directory() ) . '/demo/home.xml',
			'import_preview_image_url'   => get_template_directory_uri() . '/demo/home2.jpg',
			'import_notice'              => esc_html__( 'Import only home pages.', 'deasil' ),
			'preview_url'                => 'http://deasil.moldthemes.com',
		)
	);
}
add_filter( 'pt-ocdi/import_files', 'deasil_ocdi_import_files' );


add_action( 'woocommerce_product_options_pricing', 'wc_rrp_product_field' );

function wc_rrp_product_field() {
	woocommerce_wp_text_input( array( 'id' => 'rrp_price', 'class' => 'wc_input_price short', 'label' => __( 'РРЦ', 'woocommerce' ) . ' (' . get_woocommerce_currency_symbol() . ')' ) );
}

add_action( 'save_post', 'wc_rrp_save_product' );

function wc_rrp_save_product( $product_id ) {
	// Если это автосохранение, то ничего не делаем, сохраняем данные только при нажатии на кнопку Обновить
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;
	if ( isset( $_POST['rrp_price'] ) ) {
		if ( is_numeric( $_POST['rrp_price'] ) )
		update_post_meta( $product_id, 'rrp_price', $_POST['rrp_price'] );
	} else {	
		delete_post_meta( $product_id, 'rrp_price' );
	}
}

add_action( 'woocommerce_single_product_summary', 'wc_rrp_show', 5 );

function wc_rrp_show() {
	global $product;
	// Ничего не предпринимаем для вариативных товаров
	if ( $product->product_type <> 'variable' ) {
		$value = get_post_meta( $product->id, 'rrp_price', true );
		echo '<p>' . woocommerce_price( $value ) . '</p>';
	}
}

