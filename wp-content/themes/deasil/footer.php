<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Deasil
 */

?>

			</div><!-- #content -->

				<footer id="footer">
					<div class="container">
						<div class="row">
							<?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
								<div class="col-md-3 col-sm-6">
									<?php dynamic_sidebar( 'footer-1' ); ?>
								</div>
							<?php } ?>
							<?php if ( is_active_sidebar( 'footer-2' ) ) { ?>
								<div class="col-md-3 col-sm-6">
									<?php dynamic_sidebar( 'footer-2' ); ?>
								</div>
							<?php } ?>
							<?php if ( is_active_sidebar( 'footer-3' ) ) { ?>
								<div class="col-md-3 col-sm-6">
									<?php dynamic_sidebar( 'footer-3' ); ?>
								</div>
							<?php } ?>
							<?php if ( is_active_sidebar( 'footer-4' ) ) { ?>
								<div class="col-md-3 col-sm-6">
									<?php dynamic_sidebar( 'footer-4' ); ?>
								</div>
							<?php } ?>
						</div>
					</div>
					<div class="copy"><span>&copy;</span> <?php echo esc_html__('Copyright', 'deasil') . ' ' . get_bloginfo();?></div>
				</footer>

				</div><!-- #page -->
				
		</div><!-- .deasil-body -->
		<?php wp_footer(); ?>
	</body>
</html>
