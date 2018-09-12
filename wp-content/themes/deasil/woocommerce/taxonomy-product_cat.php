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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header();
$woo_sidebar = (isset($deasil_options['woo_sidebar'])) ? $deasil_options['woo_sidebar'] : 'left-sidebar';

if ( is_product_category() ){
	global $wp_query;
	$cat = $wp_query->get_queried_object();
	$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 
	$image = wp_get_attachment_url( $thumbnail_id ); 
}

?>

<?php if($image != ''):?>
	<section class="page-img" style="background-image: url('<?php echo esc_url($image); ?>');">
	<?php else:?>
		<section class="page-img">
		<?php endif;?>
		<div class="main-title">
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ){
				echo '<h1>';
				woocommerce_page_title();
				echo '</h1>';
			}?>

			<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
			?>
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

				<div class="col-sm-8 product-grid">
					<?php if ( have_posts() ) : ?>
						<div class="toogle-view">
							<div class="icon toggle-list" data-toggle="list"><i class="fa fa-th-list"></i></div>
							<div class="icon toggle-grid active" data-toggle="grid"><i class="fa fa-th-large"></i></div>
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
