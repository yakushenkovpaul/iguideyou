<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Deasil
 */

$header_image = get_theme_mod('header_image');
$blog_image = get_theme_mod('blog_image');
$page_title = get_theme_mod('blog_title_align');

$sidebar = get_theme_mod('blog_sidebar', 'right-sidebar');
$show_side_img = get_theme_mod('blog_side_image');
$show_pagination = get_theme_mod('blog_pagination');

get_header(); 
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
							<?php
							the_archive_title( '<h3 class="main-head archive-head">', '</h3>' );
							the_archive_description( '<p class="sub-head">', '</p>' );
							?>
						</div>
						<?php else:?>
							<div class="page-img-txt container">
								<?php
								the_archive_title( '<h3 class="main-head archive-head">', '</h3>' );
								the_archive_description( '<p class="sub-head">', '</p>' );
								?>
							</div>
						<?php endif;?>

						<div class="page-img-txt container">
							<?php
							
							?>
						</div>
					</section>


					<div class="section">f
						
						<div class="container main-container">
							<div class="row">
								<?php if ($sidebar == 'left-sidebar') : ?>
									<div class="col-sm-4">	
										<?php get_sidebar(); ?>
									</div>
								<?php endif;?>
								<div class="<?php echo ($sidebar != 'no-sidebar') ? 'col-sm-8' : 'col-sm-12';?>">
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

					<?php get_footer();
