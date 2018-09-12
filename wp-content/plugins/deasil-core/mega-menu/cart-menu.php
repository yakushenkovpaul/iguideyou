<?php 
add_filter('wp_nav_menu_items','deasil_menu_cart', 10, 2);
function deasil_menu_cart($menu, $args) {

	/*Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location*/
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'primary' !== $args->theme_location )
		return $menu;

	ob_start();
	global $woocommerce;
	$viewing_cart = esc_html__('View your shopping cart', 'deasil-core');
	$start_shopping = esc_html__('Start shopping', 'deasil-core');
	$cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : $woocommerce->cart->get_cart_url();
	$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );

	$cart_contents_count = $woocommerce->cart->cart_contents_count;
	$cart_contents = '<span class="badge badge-danger">'.$cart_contents_count.'</span>';
	
	/*comment the line below to hide nav menu cart item when there are no items in the cart*/
	$cart_total = $woocommerce->cart->get_cart_total();
	if ( $cart_contents_count > 0 ) {

		if ($cart_contents_count == 0) {
			$menu_item = '<li class="right"><a class="wcmenucart-contents" href="'. esc_attr($shop_page_url) .'" title="'. esc_attr($start_shopping) .'">';
			$menu_item .= '<i class="fa fa-shopping-cart"></i> ';
		} else {
			$menu_item = '<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-shopping-cart"></i>';
			$menu_item .= $cart_contents;
			$menu_item .= '</a><div role="menu" class="cart-menu-wrap dropdown-menu" style="display: none;"><table class="cart-menu"><tbody>';


			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

					$menu_item .= '<tr class="woocommerce-cart-form__cart-item' . esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ).'">';

					$menu_item .= '<td class="product-remove">';
					$menu_item .= apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
						'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
						esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
						esc_html__( 'Remove this item', 'deasil-core' ),
						esc_attr( $product_id ),
						esc_attr( $_product->get_sku() )
						), $cart_item_key );
					$menu_item .='</td>';

					$menu_item .= '<td class="product-thumbnail">';
					$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

					if ( ! $product_permalink ) {
						$menu_item .= $thumbnail;
					} 
					else {
						$menu_item .= '<a href="'.esc_url( $product_permalink ).'">'.$thumbnail.'</a>';
					}
					$menu_item .='</td>';


					$menu_item .='<td class="product-name" data-title="'.esc_attr__( 'Product', 'deasil-core' ).'">';

					if ( ! $product_permalink ) {
						$menu_item .= apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
					} else {
						$menu_item .= apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
					}

								// Meta data
					$menu_item .= wc_get_formatted_cart_item_data( $cart_item );

								// Backorder notification
					if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
						$menu_item .= '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'deasil-core' ) . '</p>';
					}
					$menu_item .='</td>';


					$menu_item .='<td class="product-price" data-title="'.esc_attr__( 'Price', 'deasil-core' ).'">';
					$menu_item .= apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					$menu_item .= ' <span class="cross">X</span> ';
					$menu_item .='<span class="product-quantity" data-title="'. esc_attr__( 'Quantity', 'deasil-core' ).'">';
					$menu_item .= esc_html($cart_item['quantity']);
					$menu_item .='</span>';
					$menu_item .='</td>';
					$menu_item .= '</tr>';
				}
			}

			$menu_item .= '<tr><td colspan="5"><a href="'. esc_url($cart_url) .'" class="btn-view">'.esc_html__('View Cart', 'deasil-core').'</a></td></tr>';

			$menu_item .= '</tbody></table></div></li>';

		}
		$menu_item .= '</a></li>';

		echo $menu_item;
	}

	$social = ob_get_clean();
	return $menu . $social;
}