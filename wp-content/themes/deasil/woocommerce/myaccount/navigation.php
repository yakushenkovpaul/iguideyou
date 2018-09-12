<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation">
	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<?php 
			switch($label){
				case 'Dashboard':
				$faicon = 'fa-tachometer';
				break;
				case 'Orders':
				$faicon = 'fa-check-square-o';
				break;
				case 'Downloads':
				$faicon = 'fa-download';
				break;
				case 'Addresses':
				$faicon = 'fa-map-marker';
				break;
				case 'Account details':
				$faicon = 'fa-th-list';
				break;
				case 'Logout':
				$faicon = 'fa-power-off';
				break;
				default:
				$faicon = 'fa-arrow-right';
			}
			?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><i class="fa <?php echo $faicon;?>"></i><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
