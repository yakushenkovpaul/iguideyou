<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Deasil
 */
$deasil_blog_list_layout = get_theme_mod('blog_list_layout', 'right');

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-list <?php echo $deasil_blog_list_layout;?>">
		<?php if(has_post_thumbnail()): ?>
			<div class="post-img" style="background-image: url(<?php echo esc_url(the_post_thumbnail_url());?>)" >
				<div class="item-overlay">
					<a href="<?php the_permalink(); ?>"><span class="fa fa-binoculars"></span></a>
				</div>
			</div>
		<?php endif;?>
		<div class="post-summary">
			<header>
				<?php the_title( '<h4 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
				<?php deasil_posted_on_line(); ?>
			</header>
			<div class="post-excerpt">
				<?php
				the_excerpt( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'deasil' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
				?>
			</div>

			<a href="<?php the_permalink(); ?>"  class="btn btn-primary"><?php echo esc_html__('Read More', 'deasil');?></a>
		</div>
	</div>
</div>
