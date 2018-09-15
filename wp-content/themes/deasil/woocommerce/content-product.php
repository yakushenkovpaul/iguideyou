<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product, $post;
// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$deasil_trip_overview = get_post_meta( $post->ID, 'deasil_trip_overview', true );
$is_deasil_trip = get_post_meta( $post->ID, 'is_deasil_trip', true ); 
$deasil_day = get_post_meta( $post->ID, 'deasil_tour_day', true); 
$deasil_night = get_post_meta( $post->ID, 'deasil_tour_night', true); 
$deasil_add_to_cart_label = get_post_meta( get_the_ID(), 'deasil_add_to_cart_label', true);
?>

<li <?php wc_product_class('single-item');?>>
	<?php if($is_deasil_trip == 'on'): ?>

		<div class="item-img" style="background-image: url(<?php echo esc_url(has_post_thumbnail() ? get_the_post_thumbnail_url($post->ID) : '')?>)">	
			<?php if ( $product->is_on_sale() ) : ?>
				<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="onsale"><span>' . esc_html__( 'Sale!', 'deasil' ) . '</span></div>', $post, $product ); ?>
			<?php endif; ?>
			
			<div class="item-overlay">
				<div class="item-overlay-meta">
					<a href="<?php the_permalink();?>"><span class="fa fa-binoculars"></span></a>
					<div class="meta-cat"><?php echo wc_get_product_category_list( $product->get_id()); ?></div>
					<div class="meta-rate"><?php woocommerce_template_loop_rating();?></div>
				</div>
			</div>
			
		</div>

		<div class="item-desc">
			<div class="item-headline">
				<h4 class="item-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
				<div class="location">
					<?php $location = strip_tags(get_the_term_list( $post->ID, 'location', '', ', ' , '' ));?>
					<?php if($location != ""){
						echo esc_html($location);
					}?>
				</div>
			</div>
			<div class="item-excerpt"><?php echo get_the_excerpt();?></div>

			<div class="item-detail">	
				<div class="left">
					<!--
					<div class="day">
						<span class="icon-sun"></span>
						<?php if(!empty($deasil_day) && ($deasil_day != '')): ?>
						<?php echo esc_html($deasil_day) . ' '; echo (($deasil_day == '1') ? esc_html__('Day', 'deasil') : esc_html__('Days', 'deasil')); ?>
						<?php else:?>
							<span class="disable"><?php _e('NA', 'deasil');?></span>
						<?php endif;?>
					</div>
					<div class="night">
						<span class="icon-moon"></span>
						<?php if(!empty($deasil_night) && ($deasil_night != '')): ?>
						<?php echo esc_html($deasil_night) . ' '; echo (($deasil_night == '1') ? esc_html__('Night', 'deasil') : esc_html__('Nights', 'deasil')); ?>
						<?php else:?>
							<span class="disable"><?php esc_html_e('NA', 'deasil');?></span>
						<?php endif;?>
					</div>
				-->
				</div>
				<div class="right">
					<div class="item-info">
						<?php
						$terms = get_the_terms( $post->ID , 'grade' );
						if($terms) {
							foreach( $terms as $term ) {
								$grade = $term->name;
								$icon_class = get_term_meta ( $term->term_id, 'grade-icon-id', true );
								if(!empty($grade) && ($grade != '')) {
									echo '<div class="item-difficulty">
									<span class="' . $icon_class . '" data-toggle = "tooltip" data-placement = "bottom"  title = "' . esc_attr__('Difficulty', 'deasil') . ' : ' . $grade . '"></span>
									</div >';
								}
								else {
									echo '<div class="item-difficulty">
									<span class="icon-easy disable" data-toggle = "tooltip" data-placement = "bottom"  title = "' . esc_attr__('Difficulty : NA', 'deasil') . '" ></span>
									</div >';
								}
							}
						}
						?>
						<div class="grade">
							<?php if(!empty($grade)){
								echo esc_html($grade);
							}?>
						</div>
					</div>
				</div>
			</div>
			<div class="price-wrap">
				<div class="left">
					<?php woocommerce_template_loop_price();?>
				</div>
				<div class="right price-info">
					<?php echo wc_price_info_show();?>
				</div>
			</div>
			<div class="bottom-button">
			<a href="<?php the_permalink();?>" class="btn btn-primary">
					<?php 
					if($deasil_add_to_cart_label != ''){
						echo $deasil_add_to_cart_label;
					}
					else{
					esc_html_e('Book Now', 'deasil');	
					}
					?>	
					</a>								
				</div>

		</div>

		<?php else: ?>

			<div class="item-img" style="background-image: url(<?php echo (has_post_thumbnail() ? get_the_post_thumbnail_url($post->ID) : '')?>)">	
				<?php if ( $product->is_on_sale() ) : ?>
					<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="onsale"><span>' . esc_html__( 'Sale!', 'deasil' ) . '</span></div>', $post, $product ); ?>
				<?php endif; ?>
				<div class="item-overlay">
					<div class="item-overlay-meta">
						<a href="<?php the_permalink();?>"><span class="fa fa-binoculars"></span></a>
					</div>
				</div>
			</div>

			<div class="item-desc">
				<h4 class="item-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
				<div class="item-detail">
					<div class="left">
						<?php
						woocommerce_template_loop_rating();
						woocommerce_template_loop_price();
						?>
					</div>
					<div class="right">
						<a href="<?php the_permalink();?>" class="btn btn-primary"><?php esc_html_e('Buy Now', 'deasil');?></a>
					</div>
				</div>
			</div>

		<?php endif; ?>

	</li>



