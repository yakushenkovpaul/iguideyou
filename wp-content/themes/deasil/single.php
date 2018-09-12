<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Deasil
 */

get_header('shop'); 
$header_image = get_theme_mod('header_image');
$blog_image = get_theme_mod('blog_image');
$page_title = get_theme_mod('blog_title_align');

$sidebar = get_theme_mod('blog_sidebar', 'right-sidebar');
$show_side_img = get_theme_mod('blog_side_image');
$show_pagination = get_theme_mod('blog_pagination');

?>

<?php while ( have_posts() ) : the_post();?>
	
<div class="post-single ">

	<?php if(has_post_thumbnail(get_the_ID())): ?>
		<div class="page-img" style="background-image: url('<?php echo the_post_thumbnail_url();?>')">
	<?php else: ?>
		<div class="page-img">
	<?php endif;?>

			<div class="page-img-txt container">
					<div class="author-img">
						<?php echo get_avatar( get_the_author_meta('ID'), 60); ?>
					</div>
					<div class="entry-meta">
						<h1 class="main-head"><?php the_title();?></h1>	
						<?php if ( 'post' === get_post_type() ) : ?>
							<?php deasil_posted_on(); ?>
							<ul class="tag-wrap">
								<?php 
								$post_tags = get_the_tags();
								if ($post_tags) {
									foreach($post_tags as $tag) {
										echo '<li><a href="'.get_home_url().'/tag/' . $tag->slug . '">' . $tag->name . '</a></li>'; 
									}
								}
								?>
							</ul>
						<?php endif; ?>
					</div>
			</div>

		</div>


	<main>
		<div class="container main-container">
			<div class="row">
				<?php if ($sidebar == 'left-sidebar') : ?>
					<div class="col-sm-4">	
						<?php get_sidebar(); ?>
					</div>
				<?php endif;?>
				
				<div class="<?php echo esc_attr(($sidebar != 'no-sidebar' && $sidebar != '') ? 'col-sm-8' : 'col-sm-12');?>">

					<?php 
					get_template_part( 'template-parts/content-single', get_post_format() );
					?>

					<ul class="prev-next-post clearfix">
						<li class="prev-post"> 
							<?php $previous = get_previous_post();?>
							<?php if ($previous): ?>
								<a href="<?php echo get_permalink( $previous->ID );?>">	
									<?php if(has_post_thumbnail($previous->ID)):?>
										<?php $imageprev = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'single-post-thumbnail' ); ?>
										<div class="prev-next-img" style="background-image: url('<?php echo esc_url($imageprev[0]); ?>')"></div>
									<?php else : ?>
										<div class="prev-next-img"><i class="fa fa-arrow-left"></i></div>
									<?php endif; ?>
									<div class="prev-next-title">
										<div class="prev-next-arr"><?php esc_html_e('Previous Post', 'deasil');?></div><?php echo esc_html($previous->post_title)?>
									</div>
								</a>
							<?php endif; ?>
						</li>

						<li class="next-post"> 
							<?php $next = get_next_post();?>
							<?php if ($next): ?>
								<a href="<?php echo get_permalink( $next->ID );?>">
									<?php if (has_post_thumbnail($next->ID)): ?>
										<?php $image_next = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'single-post-thumbnail' ); ?>
										<div class="prev-next-img" style="background-image: url('<?php echo esc_url($image_next[0]); ?>')"></div>
									<?php else : ?>
										<div class="prev-next-img"><i class="fa fa-arrow-right"></i></div>
									<?php endif; ?>
									<div class="prev-next-title">
										<div class="prev-next-arr"><?php esc_html_e('Next Post', 'deasil');?></div>
										<?php echo esc_html($next->post_title)?>
									</div>
								</a>
							<?php endif; ?>

						</li>
					</ul>

					<!-- If comments are open or we have at least one comment, load up the comment template. -->
					<?php if ( comments_open() || get_comments_number() ) :
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
	</main>
</div>


<?php endwhile; // End of the loop. ?>
<?php get_footer(); ?>
