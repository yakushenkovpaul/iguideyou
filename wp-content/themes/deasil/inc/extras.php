<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Deasil
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if(!function_exists('deasil_body_classes')) {
	function deasil_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

	// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}
	add_filter( 'body_class', 'deasil_body_classes' );
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
if(!function_exists('deasil_pingback_header')) {
	function deasil_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}
	add_action( 'wp_head', 'deasil_pingback_header' );
}


/*Woocommerce filter for related product number*/
if(!function_exists('deasil_related_products_args')) {
	/*Filter related product to 3 itemsw - woocommerce */
	function deasil_related_products_args( $args ) {
		$args['posts_per_page'] = 3; 
		return $args;
	}
	add_filter( 'woocommerce_output_related_products_args', 'deasil_related_products_args' );
}