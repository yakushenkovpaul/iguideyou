<?php
if(!function_exists('deasil_minmax_price')) {
	function deasil_minmax_price($type){
		global $wpdb;
		$results = $wpdb->get_results( "SELECT IF(meta_value IS NULL or meta_value = '', '', meta_value) as price
			FROM $wpdb->postmeta WHERE meta_key='_sale_price' OR meta_key='_regular_price'", OBJECT );
		$price_array = array();
		foreach($results as $key => $values)
		{
			$price_array[$key] = $values->price;
		}

		if($type == 'min'){
			$price = array_filter($price_array);
			if(!empty($price)){
				$min = min($price);
			}
			else{
				$min = 0;
			}
			return $min;
		}
		else if($type == 'max'){
			$price = array_filter($price_array);
			if(!empty($price)){
				$max = max($price);
			}
			else{
				$max = 1000;
			}
			return $max;
		}
	}
}

if(!function_exists('deasil_get_filtered_price')) {
	function deasil_get_filtered_price() {
		global $wpdb;

		$args       = wc()->query->get_main_query()->query_vars;
		$tax_query  = isset( $args['tax_query'] ) ? $args['tax_query'] : array();
		$meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();

		if ( ! is_post_type_archive( 'product' ) && ! empty( $args['taxonomy'] ) && ! empty( $args['term'] ) ) {
			$tax_query[] = array(
				'taxonomy' => $args['taxonomy'],
				'terms'    => array( $args['term'] ),
				'field'    => 'slug',
			);
		}

		foreach ( $meta_query + $tax_query as $key => $query ) {
			if ( ! empty( $query['price_filter'] ) || ! empty( $query['rating_filter'] ) ) {
				unset( $meta_query[ $key ] );
			}
		}

		$meta_query = new WP_Meta_Query( $meta_query );
		$tax_query  = new WP_Tax_Query( $tax_query );

		$meta_query_sql = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
		$tax_query_sql  = $tax_query->get_sql( $wpdb->posts, 'ID' );

		$sql  = "SELECT min( FLOOR( price_meta.meta_value ) ) as min_price, max( CEILING( price_meta.meta_value ) ) as max_price FROM {$wpdb->posts} ";
		$sql .= " LEFT JOIN {$wpdb->postmeta} as price_meta ON {$wpdb->posts}.ID = price_meta.post_id " . $tax_query_sql['join'] . $meta_query_sql['join'];
		$sql .= " 	WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
			AND {$wpdb->posts}.post_status = 'publish'
			AND price_meta.meta_key IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) ) . "')
			AND price_meta.meta_value > '' ";
		$sql .= $tax_query_sql['where'] . $meta_query_sql['where'];

		$search = WC_Query::get_main_search_query_sql();
		if ( $search ) {
			$sql .= ' AND ' . $search;
		}

		return $wpdb->get_row( $sql ); // WPCS: unprepared SQL ok.
	}
}