<?php

if(!function_exists('deasil_change_add_cart_text')) {
	/*Change label on button add  to cart to Book Now - woocommerce */
	function deasil_change_add_cart_text() {
		$deasil_add_to_cart_label = get_post_meta( get_the_ID(), 'deasil_add_to_cart_label', true);
					if($deasil_add_to_cart_label != ''){
						return $deasil_add_to_cart_label;
					}
					else{
					return esc_html__( 'Book Now', 'deasil-core' ); 
					}
		
	}
	add_filter( 'woocommerce_product_single_add_to_cart_text', 'deasil_change_add_cart_text' );
	add_filter( 'woocommerce_product_add_to_cart_text', 'deasil_change_add_cart_text' ); 
}


if(!function_exists('deasil_woocommerce_search_result_title')) {
	/*Filter for custom format for title to search result page - woocommercew*/
	function deasil_woocommerce_search_result_title( $page_title )
	{
		if ( is_search() ) {
			if (! get_search_query()) {
				$page_title = '<span>' . esc_html__('Search Results:', 'deasil-core') . '</span>' . esc_html__( 'All Products', 'deasil-core' );
			} else {
				$page_title = '<span>' . esc_html__('Search Results:', 'deasil-core') . '</span>' . sprintf( esc_html__( '%s', 'deasil-core' ), get_search_query() );
			}
		}
		return $page_title;
	}
	add_filter( 'woocommerce_page_title', 'deasil_woocommerce_search_result_title', 10, 1 );
}
