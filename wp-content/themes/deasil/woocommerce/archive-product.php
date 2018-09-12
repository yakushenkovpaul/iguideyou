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
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;

$header_image = (isset($deasil_options['header_image'])) ? $deasil_options['header_image'] : '';

$woo_sidebar = (isset($deasil_options['woo_sidebar'])) ? $deasil_options['woo_sidebar'] : 'left-sidebar';
$woo_image = (isset($deasil_options['woo_image'])) ? $deasil_options['woo_image'] : '';
$woo_title_align = (isset($deasil_options['woo_title_align'])) ? $deasil_options['woo_title_align'] : '';
$deasil_show_toggle = (isset($deasil_options['woo_show_toggle']) && $deasil_options['woo_show_toggle'] == '0') ?  'hide': '';
$deasil_grid_column = (isset($deasil_options['woo_column_count'])) ? $deasil_options['woo_column_count'] : '2'; 

get_header( 'shop' ); 
?>


<?php  if ($woo_image != ''): ?>
	<section class="page-img" style="background-image: url('<?php echo esc_url($woo_image);?>');">
		<?php  elseif ($header_image != ''): ?>
			<section class="page-img" style="background-image: url('<?php echo esc_url($header_image);?>');">
				<?php else: ?>
					<section class="page-img">
					<?php endif;?>
					<div class="page-img-txt container">

						<?php if($woo_title_align == 'center'):?>
							<div class="main-title">
								<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
									<h1><?php woocommerce_page_title(); ?></h1>
								<?php endif; ?>
							</div>
							<?php else:?>
								<div class="page-img-txt container">
									<div class="row">
										<div class="col-sm-6">
											<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
												<h1><?php woocommerce_page_title(); ?></h1>
											<?php endif; ?>
										</div>
										<div class="col-sm-6">
											<div class="breadcrumb">
												<?php
												remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10,0);
												remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10,0);
												do_action( 'woocommerce_before_main_content' );
												?>
											</div>
										</div>
									</div>
								</div>
							<?php endif;?>

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
									<div class="product-grid column-<?php echo $deasil_grid_column;?>">
										<div class="toogle-view <?php echo $deasil_show_toggle ;?>">
											<div class="icon toggle-list" data-toggle="list"><i class="fa fa-th-list"></i></div>
											<div class="icon toggle-grid active" data-toggle="grid"><i class="fa fa-th-large"></i></div>
										</div>
										
										<?php
										if ( woocommerce_product_loop() ) {

											/**
											 * Hook: woocommerce_before_shop_loop.
											 *
											 * @hooked wc_print_notices - 10
											 * @hooked woocommerce_result_count - 20
											 * @hooked woocommerce_catalog_ordering - 30
											 */
											do_action( 'woocommerce_before_shop_loop' );

											echo '<div class="row">';
											woocommerce_product_loop_start();

											if ( wc_get_loop_prop( 'total' ) ) {
												while ( have_posts() ) {
													the_post();

													/**
													 * Hook: woocommerce_shop_loop.
													 *
													 * @hooked WC_Structured_Data::generate_product_data() - 10
													 */
													do_action( 'woocommerce_shop_loop' );
													
													wc_get_template_part( 'content', 'product' );
													
												}
											}

											woocommerce_product_loop_end();
											echo '</div>';

											/**
											 * Hook: woocommerce_after_shop_loop.
											 *
											 * @hooked woocommerce_pagination - 10
											 */
											do_action( 'woocommerce_after_shop_loop' );
										} else {
											/**
											 * Hook: woocommerce_no_products_found.
											 *
											 * @hooked wc_no_products_found - 10
											 */
											do_action( 'woocommerce_no_products_found' );
										}

										/**
										 * Hook: woocommerce_after_main_content.
										 *
										 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
										 */
										do_action( 'woocommerce_after_main_content' );
										?>

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
