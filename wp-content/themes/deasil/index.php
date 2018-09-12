<?php

echo 'here';
exit;

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Deasil
 */

get_header(); 
$header_image = get_theme_mod('header_image');
$blog_image = get_theme_mod('blog_image');
$page_title = get_theme_mod('blog_title_align');

$sidebar = get_theme_mod('blog_sidebar', 'right-sidebar');
$show_side_img = get_theme_mod('blog_side_image');
$show_pagination = get_theme_mod('blog_pagination');
?>

<div class="section">
	<div class="container main-container">
		<div class="row">
			
			<?php if ($sidebar == 'left-sidebar') : ?>
				<div class="col-sm-4">	
					<?php get_sidebar(); ?>
				</div>
			<?php endif;?>
			<div class="<?php echo esc_attr(($sidebar != 'no-sidebar' && $sidebar != '') ? 'col-sm-8' : 'col-sm-12');?>">
				<?php if ( have_posts() ) : ?>	
						<?php 
						/* Start the Loop */
						while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', get_post_format() );
						endwhile;

				endif; ?>
			</div>

			<?php if ($sidebar == 'right-sidebar') : ?>
				<div class="col-sm-4">	
					<?php get_sidebar(); ?>
				</div>
			<?php endif;?>

		</div>
	</div>
</div>

<?php get_footer(); ?>
