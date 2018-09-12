<?php
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

if (is_front_page() && is_home()) {
    // Default homepage
	$blog_title = esc_html__('Blog', 'deasil');
}
elseif(is_home()){
    //Blog page
	$blog_title = get_the_title( get_option('page_for_posts', true) );
}

?>

<?php  if ($blog_image != ''): ?>
	<section class="page-img" style="background-image: url('<?php echo esc_url($blog_image);?>');">
<?php  elseif ($header_image != ''): ?>
	<section class="page-img" style="background-image: url('<?php echo esc_url($header_image);?>');">
<?php else: ?>
	<section class="page-img">
<?php endif;?>
		<?php if($page_title == 'center'):?>
			<div class="main-title">
				<h1><?php echo esc_html($blog_title); ?></h1>
			</div>
		<?php else:?>
			<div class="page-img-txt container">
				<div class="row">
					<div class="col-sm-6">
						<h1><?php echo esc_html($blog_title); ?></h1>
					</div>
					<div class="col-sm-6">
						<?php deasil_breadcrumb(); ?>
					</div>
				</div>

				
			</div>
		<?php endif;?>
	</section>

	<div class="blog-section">
		<div class="container main-container">

			<div class="row">
				<?php if ($sidebar == 'left-sidebar') : ?>
					<div class="col-sm-4">	
						<?php get_sidebar(); ?>
					</div>
				<?php endif;?>
				<div class="<?php echo esc_attr(($sidebar != 'no-sidebar' && $sidebar != '') ? 'col-sm-8' : 'col-sm-12');?>">
					<?php if ( have_posts() ) { ?>	
					<?php 
					
					while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/content', get_post_format() );
					endwhile;

					if (function_exists("deasil_pagination")){
						deasil_pagination('', 2, $show_pagination);
					};

				} ?>
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
