<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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


<?php  if ($blog_image != ''): ?>
	<section class="page-img" style="background-image: url('<?php echo esc_url($blog_image);?>');">
		<?php  elseif ($header_image != ''): ?>
			<section class="page-img" style="background-image: url('<?php echo esc_url($header_image);?>');">
				<?php else: ?>
					<section class="page-img">
					<?php endif;?>
					<?php if($page_title == 'center'):?>
						<div class="main-title">
							<h3><?php esc_html_e( 'Search Results', 'deasil' ); ?></h3>
							<?php echo '<p>' . get_search_query() . '</p>'; ?>
						</div>
						<?php else:?>
							<div class="page-img-txt container">
								<h3><?php esc_html_e( 'Search Results', 'deasil' ); ?></span>
									<?php echo '<p>' . get_search_query() . '</p>'; ?>
								</div>
							<?php endif;?>
						</section>


						<section>
							<div class="container main-container">

								<div class="row">
									<?php if ($sidebar == 'left-sidebar') : ?>
										<div class="col-sm-4">	
											<?php get_sidebar(); ?>
										</div>
									<?php endif;?>
									<div class="<?php echo ($sidebar != 'no-sidebar') ? 'col-sm-8' : 'col-sm-12';?>">
										<?php if ( have_posts() ) : ?>

											<?php 
											while ( have_posts() ) : the_post();
												get_template_part( 'template-parts/content', get_post_format() );
											endwhile;

											if (function_exists("deasil_pagination")){
												deasil_pagination('', 2, $show_pagination);
											};

											else : ?>
												<?php get_template_part( 'template-parts/content', 'none' ); ?>
												<br>
												<br>
												<br>
											<?php endif;?>
										</div>
										<?php if ($sidebar == 'right-sidebar') : ?>
											<div class="col-sm-4">	
												<?php get_sidebar(); ?>
											</div>
										<?php endif;?>
									</div>

								</div>
							</section>

							<?php get_footer(); ?>