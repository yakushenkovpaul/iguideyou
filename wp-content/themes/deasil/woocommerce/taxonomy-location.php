<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); 

$term = get_queried_object();
$term_id = $term->term_id	;
$image_id = get_term_meta ( $term_id, 'location-image-id', true );
$map_id = get_term_meta ( $term_id, 'map-image-id', true );
$map_image = wp_get_attachment_image_url( $map_id, 'large', false );
$header_image = get_header_image();
$woo_sidebar = (isset($deasil_options['woo_sidebar'])) ? $deasil_options['woo_sidebar'] : 'left-sidebar';
$deasil_show_toggle = (get_theme_mod('woo_show_toggle') == false) ? get_theme_mod('woo_show_toggle') : '1';
$deasil_grid_column = (get_theme_mod('woo_column_count') != '') ? get_theme_mod('woo_column_count') : '2';

if(isset($image_id) && !empty($image_id)){
	$header_image = wp_get_attachment_image_url( $image_id, 'large', false );
}
else if($header_image != ''){
	$header_image = $header_image;
}
else{
	$header_image = 'no-img';
}

?>

<?php if($header_image != 'no-img'): ?>
	<section class="page-img" style="background-image: url('<?php echo esc_url($header_image); ?>');">
<?php else:?>
	<section class="page-img">
<?php endif;?>
		<div class="page-img-txt container">
			<div class="row">
				<div class="col-sm-4">
					<br>
					<div class="map-image">
					<?php if( $map_image != ''){
						echo '<img class="img-responsive" src="' . esc_url($map_image) . '" alt=" ' . esc_attr__('Location', 'deasil') . ' "/>';
					}
					else{
						echo '<i class="grade-icon icon-earth"></i>';
					}
					?>
					</div>
					<br>
					<br>
				</div>
				<div class="col-sm-7">
					<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) {
						echo '<h2>';
						woocommerce_page_title();
						echo '</h2>';
					}?>
					<?php 
						/** woocommerce_archive_description hook.
						 *
						 * @hooked woocommerce_taxonomy_archive_description - 10
						 * @hooked woocommerce_product_archive_description - 10
						 */
						do_action( 'woocommerce_archive_description' ); 
					?>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="container main-container">
			<div class="row">

				<?php if($woo_sidebar == 'left-sidebar'):?>
					<div class="col-sm-4">
						<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
							<div class="sidebar">
								<?php dynamic_sidebar('sidebar-2'); ?>
							</div>
						<?php } ?>
					</div>
				<?php endif;?>

				<div class="<?php echo esc_attr(($woo_sidebar != 'no-sidebar' && $woo_sidebar != '') ? 'col-sm-8' : 'col-sm-12');?>">
					<div class="product-grid column-<?php echo $deasil_grid_column;?>"">
						<?php if ( have_posts() ) : ?>
							<div class="toogle-view <?php echo ($deasil_show_toggle == '0') ? 'hide' : ''?>"">
								<div class="icon icon-list" data-toggle="list"></div>
								<div class="icon icon-grid active" data-toggle="grid"></div>
							</div>
							<?php
							/**
							 * woocommerce_before_shop_loop hook.
							 *
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							do_action( 'woocommerce_before_shop_loop' );
							?>
							<div class="row">

								<?php woocommerce_product_loop_start(); ?>
								<?php woocommerce_product_subcategories(); ?>

								<?php while ( have_posts() ) : the_post(); ?>
										<?php wc_get_template_part( 'content', 'product' ); ?>
								<?php endwhile; // end of the loop. ?>

								<?php woocommerce_product_loop_end(); ?>
							</div>
							<?php
							/**
							 * woocommerce_after_shop_loop hook.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
							?>

						<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

							<?php wc_get_template( 'loop/no-products-found.php' ); ?>

						<?php endif; ?>

					</div>
				</div>

				<?php if($woo_sidebar == 'right-sidebar'):?>
					<div class="col-sm-4">
						<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
							<div class="sidebar">
								<?php dynamic_sidebar('sidebar-2'); ?>
							</div>
						<?php } ?>
					</div>
				<?php endif;?>

			</div>
		</div>
	</section>

<?php get_footer( 'shop' ); ?>
