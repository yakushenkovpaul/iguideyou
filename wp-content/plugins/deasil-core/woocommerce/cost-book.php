<?php
/*custom tab  Cost & Book*/
if(!function_exists('deasil_cost_book_options_tab')) {
	/*Cost and book option - Admin*/
	function deasil_cost_book_options_tab( $tabs) {
		global $post;
		$is_deasil_trip = get_post_meta( $post->ID, 'is_deasil_trip', true ); 
		if($is_deasil_trip == 'on'){
			$class = array("show_if_simple", "show_if_variable", "show_if_external");
		}
		else{
			$class = array("hide_if_simple", "hide_if_variable", "hide_if_external");
		};
		$tabs['deasil_cost_book_data'] = array(
			'label'     => esc_html__('Cost & Book', 'deasil-core'),
			'target'    => 'deasil_cost_book_data',
			'class'     => array_merge( $class, array('deasil-cost-book')),
		);
		return $tabs;
	}
	add_filter( 'woocommerce_product_data_tabs', 'deasil_cost_book_options_tab', 103);
}


if(!function_exists('deasil_cost_book_options')) {
	function deasil_cost_book_options() {
		global $post;

		$deasil_cost_book_options = array(
			'title' => get_post_meta($post->ID, 'deasil_cost_book_title', true),
			'content' => get_post_meta($post->ID, 'deasil_cost_book_content', true),
		);  
		?>
		<div id="deasil_cost_book_data"  class="panel woocommerce_options_panel">
			<?php 
			$cost_book_title = get_post_meta( $post->ID, 'deasil_trip_cost_book_title', true ); 
			$deasil_trip_costbook_tab_hide = get_post_meta( $post->ID, 'deasil_trip_costbook_tab_hide', true ); 
			if($cost_book_title == ''){
				$cost_book_title = esc_html__( 'Cost &amp; Book', 'deasil-core' );
			}	
			?>
			<table class="admin-table">
				<tr>
					<td>
						<p class="form-field">
							<label><?php echo esc_html__('Tab Title', 'deasil-core');?></label>
							<input type="text" name="deasil_trip_cost_book_title" value="<?php if(isset($cost_book_title)) echo $cost_book_title; ?>" />
						</p>
					</td>
					<td style="width: 80px;">
						<p class="form-field">
							<label><?php echo esc_html__('Hide tab', 'deasil-core');?></label>
							<input type="checkbox" name="deasil_trip_costbook_tab_hide" value="hide" <?php if($deasil_trip_costbook_tab_hide == 'hide') echo 'checked';?> />
						</p>
					</td>
				</tr>
			</table>
			<hr/>
			<table class="admin-table">
				<tr>
					<td style="width: 60%">
						<p class="form-field">
							<?php $deasil_disable_defailt_booking = get_post_meta( $post->ID, 'deasil_disable_default_booking', true ); ?>    
							<label for=""><?php esc_html_e('Disable default Booking', 'deasil-core');?></label>
							<?php if($deasil_disable_defailt_booking == 1):?>
								<input  type="checkbox" name="deasil_disable_default_booking" value="1" checked/>
								<?php else:?>
									<input  type="checkbox" name="deasil_disable_default_booking" value="1"/>
								<?php endif;?>
							</p>		

							<p class="form-field">
								<?php $deasil_book_info = get_post_meta( $post->ID, 'deasil_book_info', true ); ?>    
								<label for=""><?php esc_html_e('Booking Information', 'deasil-core');?></label>
								<div style="padding-left: 12px; margin-top: -15px;">
									<?php
									$content = $deasil_book_info;
									$editor_id = 'deasil_book_info';
									$setting = array(
										'media_buttons' => false,
										'quicktags'     => false,
										'teeny' 	=> false,
										'tinymce' => array(
											'toolbar1'=>  'formatselect,bold,italic,underline,bullist,numlist,link,unlink, pre_code_button',
											'toolbar2'=> ''
										),
									);
									wp_editor( $content, $editor_id , $setting);
									?>
								</div>
							</p>									
						</td>
						<td style="width: 60%">
							<p class="form-field">
								<?php $deasil_inquiry_form = get_post_meta( $post->ID, 'deasil_inquiry_form', true ); ?>    
								<label for=""><?php esc_html_e('Extra Information', 'deasil-core');?></label>
								<div style="padding-left: 12px; margin-top: -15px;">
									<?php
									$content = $deasil_inquiry_form;
									$editor_id = 'deasil_inquiry_form';
									$setting = array(
										'media_buttons' => false,
										'quicktags'     => false,
										'teeny' 	=> false,
										'tinymce' => array(
											'toolbar1'=>  'formatselect,bold,italic,underline,bullist,numlist,link,unlink, pre_code_button',
											'toolbar2'=> ''
										),
									);
									wp_editor( $content, $editor_id , $setting);
									?>
								</div>
							</p>
						</td>
					</tr>
				</table>

			</div>
			<?php
		}
		add_action('woocommerce_product_data_panels', 'deasil_cost_book_options');
	}


	if(!function_exists('deasil_cost_book_fields_save')) {
		/*Function to save all custom field information from products*/
		function deasil_cost_book_fields_save( $post_id ){
			/*update*/
			
			$deasil_trip_cost_book_title = $_POST['deasil_trip_cost_book_title'] ;
			update_post_meta( $post_id, 'deasil_trip_cost_book_title', $deasil_trip_cost_book_title );

			$deasil_trip_costbook_tab_hide = $_POST['deasil_trip_costbook_tab_hide'] ;
			update_post_meta( $post_id, 'deasil_trip_costbook_tab_hide', $deasil_trip_costbook_tab_hide );

			$deasil_disable_default_booking = $_POST['deasil_disable_default_booking'] ;
			update_post_meta( $post_id, 'deasil_disable_default_booking', $deasil_disable_default_booking );

			$deasil_inquiry_form = $_POST['deasil_inquiry_form'] ;
			update_post_meta( $post_id, 'deasil_inquiry_form', $deasil_inquiry_form );

			$deasil_book_info = $_POST['deasil_book_info'] ;
			update_post_meta( $post_id, 'deasil_book_info', $deasil_book_info );
		}
		add_action( 'woocommerce_process_product_meta', 'deasil_cost_book_fields_save' );
	}

	if(!function_exists('deasil_cost_book')) {
		/*Cost and Book tab - Frontend*/
		function deasil_cost_book( $tabs ) {
			global $post;
			$product = wc_get_product( $post->ID );
			$is_deasil_trip = get_post_meta( $post->ID, 'is_deasil_trip', true ); 

			if($is_deasil_trip == 'on'){
				$cost_book_title = get_post_meta( $post->ID, 'deasil_trip_cost_book_title', true );
				if($cost_book_title == ''){
					$cost_book_title = esc_html__( 'Cost &amp; Book', 'deasil-core' );
				}	

				$tabs['cost_book'] = array(
					'title' 	=> $cost_book_title,
					'priority' 	=> 30,
					'callback' 	=> 'deasil_cost_book_content'
				);

				$deasil_trip_costbook_tab_hide = get_post_meta( $post->ID, 'deasil_trip_costbook_tab_hide', true );
				if($deasil_trip_costbook_tab_hide != 'hide' ){
					return $tabs;
				}
			}
		}
		add_filter( 'woocommerce_product_tabs', 'deasil_cost_book' );


		function deasil_add_booking_calendar() {
			global $post;
			$product = wc_get_product( $post->ID );
			$product_price = $product->get_price();
			if ( $product->is_in_stock() && !empty($product_price) ) :
				echo '<br><div>';
			echo '<label>' . esc_html__('Book Date', 'deasil-core') . '</label>';
			echo '<input type="text" name="deasil_book_date" value="" class="form-control datepicker"><br>';
			echo '</div>';
		endif; 
	}

	function deasil_cost_book_content() {
		global $post;
		$product = wc_get_product( $post->ID );
		echo '<div class="row">';
		echo '<div class="col-sm-7 cost-book">';

		$deasil_disable_defailt_booking = get_post_meta( $post->ID, 'deasil_disable_default_booking', true );

		if($deasil_disable_defailt_booking != 1){
			if( $product->is_type( 'simple' ) ){
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
				add_action( 'woocommerce_before_add_to_cart_button', 'deasil_add_booking_calendar');
				do_action( 'woocommerce_single_product_summary' );
			}
			elseif( $product->is_type( 'variable' ) ){
				$variations = deasil_find_valid_variations();
				?>

				<table class="price-table" cellspacing="0">
					<tbody>
						<?php
						foreach ($variations as $key => $value) {
							if( !$value['variation_is_visible'] ) continue;
							?>
							<tr>								
								<td>
									<?php 
									if (($value['display_price'] != $value['display_regular_price']) && ($value['display_price'] < $value['display_regular_price'])) { 
										echo  '<div class="onsale"><span>' . esc_html__( 'Sale!', 'deasil-core' ) . '</span></div>';
									}
									?>

									<?php 
									foreach($value['attributes'] as $key => $val ) {
										$val = str_replace(array('-','_'), ' ', $val);
										printf( '<span class="attr attr-%s">%s</span>', $key, ucwords($val) );
									} 
									?>
								</td>
								<td>
									<?php echo $value['price_html'];?>	
								</td>
								<td>
									<?php 
									if($value['is_in_stock']  == 1){
										if($value['availability_html'] == ''){
											echo '<p class="stock in-stock">'.esc_html__('Available', 'deasil-core').'</p>';
										}
										else{
											echo $value['availability_html'];
										}

									}
									else{
										echo $value['availability_html'];
									}
									?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>


				<div class="deasil-variable-product-meta">
					<?php
					remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
					remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
					remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
					remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
					remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

					do_action( 'woocommerce_single_product_summary' );
					?>
				</div>

				<?php
			}
			else{
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

				do_action( 'woocommerce_single_product_summary' );
				
			}
		}

		$deasil_book_info = get_post_meta( $post->ID, 'deasil_book_info', true ); 
		if(isset($deasil_book_info) && $deasil_book_info != ''){
			echo do_shortcode($deasil_book_info);
		}


		echo '</div>';
		echo '<div class="col-sm-5">';
		$deasil_inquiry_form = get_post_meta( $post->ID, 'deasil_inquiry_form', true ); 
		if(isset($deasil_inquiry_form) && $deasil_inquiry_form != ''){
			echo do_shortcode($deasil_inquiry_form);
		}
		echo '</div>';
		echo '</div>';

	}

	function deasil_find_valid_variations() {
		global $product;

		$variations = $product->get_available_variations();
		$attributes = $product->get_attributes();
		$new_variants = array();

		   			 // Loop through all variations
		foreach( $variations as $variation ) {

		        // Peruse the attributes.

		        // 1. If both are explicitly set, this is a valid variation
		        // 2. If one is not set, that means any, and we must 'create' the rest.

		        $valid = true; // so far
		        foreach( $attributes as $slug => $args ) {
		        	if( array_key_exists("attribute_$slug", $variation['attributes']) && !empty($variation['attributes']["attribute_$slug"]) ) {
		                // Exists
		        	} 
		        	else {
		                // Not exists, create
		                $valid = false; // it contains 'anys'
		                // loop through all options for the 'ANY' attribute, and add each
		                foreach( explode( '|', $attributes[$slug]['value']) as $attribute ) {
		                	$attribute = trim( $attribute );
		                	$new_variant = $variation;
		                	$new_variant['attributes']["attribute_$slug"] = $attribute;
		                	$new_variants[] = $new_variant;
		                }

		            }
		        }
		        // This contains ALL set attributes, and is itself a 'valid' variation.
		        if( $valid )
		        	$new_variants[] = $variation;
		    }
		    return $new_variants;
		}

	}



	if(!function_exists('deasil_book_date_validation')) {
		/*validation for single product*/
		function deasil_book_date_validation() { 
			$product_id = $_REQUEST['add-to-cart'];
			$product = wc_get_product($product_id);
			$is_trip = get_post_meta($product_id, 'is_deasil_trip', true );
			if( $product->is_type( 'simple' ) && ($is_trip == 'on')){
				if ( empty( $_REQUEST['deasil_book_date'] ) ) {
					wc_add_notice( esc_html__( 'Please enter Date', 'deasil-core' ), 'error' );
					return false;
				}
			}
			return true;
		}
		add_action( 'woocommerce_add_to_cart_validation', 'deasil_book_date_validation');
	}


	if(!function_exists('deasil_save_book_date_field')) {
		/*Save data to database*/
		function deasil_save_book_date_field( $cart_item_data, $product_id ) {
			if( isset( $_REQUEST['deasil_book_date'] ) ) {
				$cart_item_data[ 'deasil_book_date' ] = $_REQUEST['deasil_book_date'];
				/* below statement make sure every add to cart action as unique line item */
				$cart_item_data['unique_key'] = md5( microtime().rand() );
			}
			return $cart_item_data;
		}
		add_action( 'woocommerce_add_cart_item_data', 'deasil_save_book_date_field', 10, 2 );
	}


	if(!function_exists('deasil_book_date_meta_on_cart_and_checkout')) {
		/*Render on cart and checkout page*/
		function deasil_book_date_meta_on_cart_and_checkout( $cart_data, $cart_item = null ) {
			$custom_items = array();
			/* Woo 2.4.2 updates */
			if( !empty( $cart_data ) ) {
				$custom_items = $cart_data;
			}
			if( isset( $cart_item['deasil_book_date'] ) ) {
				$custom_items[] = array( "name" => 'Date', "value" => $cart_item['deasil_book_date'] );
			}
			return $custom_items;
		}
		add_filter( 'woocommerce_get_item_data', 'deasil_book_date_meta_on_cart_and_checkout', 10, 2 );
	}


	if(!function_exists('deasil_book_date_order_meta_handler')) {
		/*This is a piece of code that will add your custom field with order meta - Order Page.*/
		function deasil_book_date_order_meta_handler( $item_id, $values, $cart_item_key ) {
			if( isset( $values['deasil_book_date'] ) ) {
				wc_add_order_item_meta( $item_id, __("Book Date", 'deasil-core') , $values['deasil_book_date'] );
			}
		}
		add_action( 'woocommerce_add_order_item_meta', 'deasil_book_date_order_meta_handler', 1, 3 );
	}