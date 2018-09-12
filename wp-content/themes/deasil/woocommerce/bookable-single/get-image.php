<?php 
$overlay = get_post_meta( get_the_ID(), 'deasil_slider_bg', true); 
$effect = get_post_meta( get_the_ID(), 'deasil_slider_effect', true); 
$height = get_post_meta( get_the_ID(), 'deasil_slider_height', true); 
$nav_pos = get_post_meta( get_the_ID(), 'deasil_slider_nav', true); 
$nav_indicator = get_post_meta( get_the_ID(), 'deasil_slider_indicator', true);
$image_ids = $product->get_gallery_image_ids(); 
?>

<?php if ( has_post_thumbnail() ) :?>
	
	<?php if(empty($image_ids)):?>
		<div class="main-img <?php echo $height .' '. $overlay;?>" style="background-image: url(<?php the_post_thumbnail_url()?>)">
			<div class="main-image-txt center-txt">
				<?php require get_template_directory() . '/woocommerce/bookable-single/get-main-header.php';?>
			</div>
		</div>
	<?php else:?>
		<div class="main-img carousel slide <?php echo $effect . ' ' . $height .' '. $overlay;?>" id="carousel" data-ride="carousel">
			<a class="left carousel-control <?php echo $nav_pos;?>" href="#carousel" role="button" data-slide="prev">
				<span class="icon-arrow-left" aria-hidden="true"></span>
				<span class="sr-only"><?php esc_html__( 'Previous', 'deasil' );?></span>
			</a>
			<a class="right carousel-control <?php echo $nav_pos;?>" href="#carousel" role="button" data-slide="next">
				<span class="icon-arrow-right" aria-hidden="true"></span>
				<span class="sr-only"><?php esc_html__( 'Next', 'deasil' );?></span>
			</a>
			<ol class="carousel-indicators <?php echo $nav_indicator;?>">
				<?php

				$attachment_ids = $product->get_gallery_image_ids();
				$attachment_count = 0;
				foreach( $attachment_ids as $attachment_id ) 
				{
					$is_active = ($attachment_count == 0) ? 'active ' : '';
					echo '
					<li data-target="#carousel" data-slide-to="'.$attachment_count.'" class="'.$is_active.'"></li>';
					$attachment_count++;
				}
				?>
			</ol>
			<div class="carousel-inner" role="listbox">
				<?php
				$attachment_count = 0;
				foreach( $attachment_ids as $attachment_id ) 
				{
					$is_active = ($attachment_count == 0) ? 'active ' : '';
					echo '<div class="item '.$is_active.'" style="background-image: url(\''.$Original_image_url = wp_get_attachment_url( $attachment_id ).'\')"></div>';

					$attachment_count++;
				}
				?>
			</div>
			<div class="carousel-caption center-txt">
				<?php require get_template_directory() . '/woocommerce/bookable-single/get-main-header.php';?>
			</div>
		</div>
	<?php endif;?>

<?php else:?>

	<div class="main-img no-bg <?php echo $height .' '. $overlay;?>">
		<div class="main-image-txt center-txt">
			<?php require get_template_directory() . '/woocommerce/bookable-single/get-main-header.php';?>
		</div>
	</div>

<?php endif;?>


