<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Deasil
 */
global $options;

get_header(); 

while ( have_posts() ) : the_post();

$header_image = get_theme_mod('header_image');
$blog_image = get_theme_mod('blog_image');
$page_title = get_theme_mod('blog_title_align');

$sidebar = get_theme_mod('blog_sidebar', 'right-sidebar');
$show_side_img = get_theme_mod('blog_side_image');
$show_pagination = get_theme_mod('blog_pagination');

$sidebar = get_post_meta( get_the_ID(), 'deasil_layout_sidebar', true);
$page_title = get_post_meta( get_the_ID(), 'deasil_page_title', true);
?>

<?php if($page_title != 'no-title'){ ?>
<?php  if (has_post_thumbnail()): ?>
	<section class="page-img" style="background-image: url('<?php echo esc_url(the_post_thumbnail_url());?>');">
<?php  elseif ($header_image != ''): ?>
	<section class="page-img" style="background-image: url('<?php echo esc_url($header_image);?>');">
<?php else: ?>
	<section class="page-img">
<?php endif;?>

		<?php if($page_title == 'center'):?>
			<div class="main-title">
				<?php the_title( '<h1>', '</h1>' ); ?>
				<?php 
				if ( has_excerpt() ) {
					if(!is_page(array('cart', 'checkout', 'my-account'))) the_excerpt('<p>', '</p>');
				}
				?>
			</div>
		<?php else:?>
			<div class="page-img-txt container">
				<div class="row">
					<div class="col-sm-6">
						<?php the_title( '<h1 class="main-head">', '</h1>' ); ?>
						<?php 
						if ( has_excerpt() ) {
							if(!is_page(array('cart', 'checkout', 'my-account'))) the_excerpt('<p>', '</p>');
						}
						?>
					</div>
					<div class="col-sm-6">
						<?php deasil_breadcrumb(); ?>
					</div>
				</div>
			</div>
		<?php endif;?>

	</section>
<?php } ?>


	<section>
		<div class="container <?php echo ($page_title == 'no-title') ? 'main-container' : 'page-container'?>">
			<div class="row">
				<?php if ($sidebar == 'left-sidebar') : ?>
					<div class="col-sm-4">	
						<?php get_sidebar(); ?>
					</div>
				<?php endif;?>
				<div class="<?php echo esc_attr(($sidebar != 'no-sidebar' && $sidebar != '') ? 'col-sm-8' : 'col-sm-12');?>">
					<?php 
					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>
				</div>
				<?php if ($sidebar == 'right-sidebar') : ?>
					<div class="col-sm-4">	
						<?php get_sidebar(); ?>
					</div>
				<?php endif;?>
			</div>
		</div>
	</section>
<?php endwhile; ?>

<?php get_footer(); ?> 
