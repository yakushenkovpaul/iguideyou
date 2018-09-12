<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Deasil
 */

get_header(); 
?>

<?php while ( have_posts() ) : the_post();?>

<?php
	$header_image = get_theme_mod('header_image');
	$blog_image = get_theme_mod('blog_image');
	$page_title = get_theme_mod('blog_title_align');

	$sidebar = get_theme_mod('blog_sidebar', 'right-sidebar');
	$show_side_img = get_theme_mod('blog_side_image');
	$show_pagination = get_theme_mod('blog_pagination');
	
	$language = get_post_meta( get_the_ID(), 'deasil_team_language', true);
	$location = get_post_meta( get_the_ID(), 'deasil_team_location', true);
	$email = get_post_meta( get_the_ID(), 'deasil_team_email', true);

	$twitter = get_post_meta( get_the_ID(), 'deasil_team_twitter', true);
	$facebook = get_post_meta( get_the_ID(), 'deasil_team_facebook', true);
	$google = get_post_meta( get_the_ID(), 'deasil_team_google', true);
	$linkedin = get_post_meta( get_the_ID(), 'deasil_team_linkedin', true);
	$instagram = get_post_meta( get_the_ID(), 'deasil_team_instagram', true);
?>

<div class="team-single">
	<?php if ($header_image != ''): ?>
		<div class="page-img" style="background-image: url('<?php echo esc_url($header_image);?>');">
	<?php else: ?>
		<div class="page-img">
	<?php endif;?>
		</div>


		<div class="team-container container">
			<div class="row">
				<div class="col-sm-4">
					<div class="team-img-wrap">
						<?php if(has_post_thumbnail(get_the_ID())): ?>
							<div class="team-img" style="background-image: url('<?php echo the_post_thumbnail_url();?>')">
							</div>
						<?php endif;?>
					</div>
				</div>

				<div class="col-sm-8">
					<div class="team-detail">
						<h1 class="main-head"><?php the_title();?></h1>	
						<ul class="sub-head">
							<?php if(!empty($language)) echo '<li><i class="fa fa-language"></i>'.esc_html($language).'</li>';?>
							<?php if(!empty($location)) echo '<li><i class="fa fa-globe"></i>'.esc_html($location).'</li>';?>
							<?php if(!empty($email)) echo '<li><i class="fa fa-envelope-o"></i>'.esc_html($email).'</li>';?>
						</ul>
						
						<?php 
						get_template_part( 'template-parts/content-single', get_post_format() );
						?>
						<ul class="social-icon-list">
							<?php if(!empty($twitter)) echo '<li><a href="'.esc_attr($twitter).'"><i class="fa fa-twitter"></i></a></li>';?>
							<?php if(!empty($facebook)) echo '<li><a href="'.esc_attr($facebook).'"><i class="fa fa-facebook"></i></a></li>';?>
							<?php if(!empty($google)) echo '<li><a href="'.esc_attr($google).'"><i class="fa fa-google"></i></a></li>';?>
							<?php if(!empty($linkedin)) echo '<li><a href="'.esc_attr($linkedin).'"><i class="fa fa-linkedin"></i></a></li>';?>
							<?php if(!empty($instagram)) echo '<li><a href="'.esc_attr($instagram).'"><i class="fa fa-instagram"></i></a></li>';?>
						</ul>
					</div>

				</div>
			</div>
		</div>
</div>

<?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>
