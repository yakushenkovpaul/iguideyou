<h1 class="main-header" itemprop="name">
	<?php echo get_the_title(); ?>
</h1>	
<h4 class="sub-header"><?php echo strip_tags(get_the_excerpt());?></h4>
<?php if ( $product->is_on_sale() ) : ?>
	<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="onsale"><span>' . esc_html__( 'Sale!', 'deasil' ) . '</span></div>', $post, $product ); ?>
<?php endif; ?>