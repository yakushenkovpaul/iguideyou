<?php 

if(!function_exists('deasil_remove_product_tabs')) {
	/*If product is bookable trip it removes additional Information tab*/
	function deasil_remove_product_tabs( $tabs ) {
		global $post;
		$product = wc_get_product( $post->ID );
		$is_deasil_trip = get_post_meta( $post->ID, 'is_deasil_trip', true ); 
		if($is_deasil_trip == 'on'){
	    	unset( $tabs['additional_information'] );   // Remove the additional information tab      
		}
		return $tabs;
	}
	add_filter( 'woocommerce_product_tabs', 'deasil_remove_product_tabs', 98 );
}