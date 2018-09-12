<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Deasil
 */

global $deasil_options;
$header_image = (isset($deasil_options['header_image'])) ? $deasil_options['header_image'] : '';
get_header(); 
?>

<?php if ($header_image != ''): ?>
	<section class="page-img" style="background-image: url('<?php echo esc_url($header_image);?>');">
<?php else: ?>
	<section class="page-img">
<?php endif;?>
	</section>

	<section class="error-404 not-found">
		<div class="container page-404">
			<div class="clip-text clip-text_one" style="background-image: url('<?php echo esc_url($header_image);?>');">404</div>
			<h2><?php esc_html_e( 'This Page Could Not Be Found!', 'deasil' ); ?></h2>
			<h5><?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'deasil' ); ?></h5>
			<div class="search-field">
				<?php get_search_form();?>
			</div>
		</div>
	</section>
	
<?php
get_footer();
