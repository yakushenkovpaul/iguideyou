<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Deasil
 */

$menu_bg = get_post_meta( get_the_ID(), 'deasil_menu_bg', true);
$page_title = get_post_meta( get_the_ID(), 'deasil_page_title', true);
$deasil_logo = get_theme_mod('logo');
$button_style = get_theme_mod('button_style');
$favicon = get_theme_mod('favicon');

if ( is_home() || is_search() || is_archive()) {
	$menu_bg = get_theme_mod('deasil_menu_style');
}
else{
	$menu_bg = get_post_meta( get_the_ID(), 'deasil_menu_bg', true);
}

?>

<!DOCTYPE html><!-- aaaaqqqq11 -->
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if($favicon != ''): ?>
		<link rel="shortcut icon" type="image/png" href="<?php echo esc_url($favicon);?>"/>
	<?php else: ?>
		<link rel="shortcut icon" type="image/png" href="<?php echo get_template_directory_uri().'/assets/img/favicon.png';?>"/>
	<?php endif;?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
		<div class="deasil-body <?php echo esc_attr($button_style);?>">

			<div class="pre-loader">
				<div class="loading-img"></div>
			</div>

			<div id="page" class="site">
				<a class="skip-link screen-reader-text " href="#content"><?php esc_html_e( 'Skip to content', 'deasil' ); ?></a>

				<header class="nav-menu <?php echo esc_attr($menu_bg); ?>">
					<nav class="navbar">
						<div class="container-fluid">
							<div class="navbar-header">
								<?php if(!empty($deasil_logo)):?>
									<span id="logo">
										<a class="navbar-brand" href="<?php echo esc_url(site_url());?>">
											<img class="logo-img" src="<?php echo esc_url(get_theme_mod('logo'));?>" alt="<?php bloginfo('name');?>">
										</a>
									</span>
								<?php else: ?>
									<span id="blogname">
										<a class="navbar-brand" href="<?php echo esc_url(site_url());?>">
											<?php bloginfo('name');?>
										</a>
									</span>
								<?php endif; ?>

								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar">
									<span class="sr-only"><?php esc_html_e('Toggle navigation', 'deasil');?></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>

							<div class="collapse navbar-collapse" id="main-navbar">
								<?php /* Primary navigation */
								if ( has_nav_menu( 'primary' ) && class_exists('Deasil_Bootstrap_Nav_Walker') ) {
									wp_nav_menu( array(
										'theme_location' 	=> 'primary',
										'depth' 			=> 5,
										'container' 		=> 'div',
										'container_class' 	=> 'default-menu',
										'container_id'      => 'primary-menu',
										'menu_class' 		=> 'nav navbar-nav',

										'walker' 			=> new Deasil_Bootstrap_Nav_Walker()
										)
									);
								}
								else if ( has_nav_menu( 'primary' )) {
									wp_nav_menu( array(
										'theme_location' 	=> 'primary',
										'depth' 			=> 5,
										'container' 		=> 'div',
										'container_class' 	=> 'default-menu auto-menu',
										'container_id'      => 'primary-menu',
										'menu_class' 		=> 'nav navbar-nav',
										)
									);
								}
								else{
									wp_page_menu(array(
									    'menu_class'      => 'default-menu auto-menu',
									    'menu_id'         => 'primary-menu'
									)
									);
								}
								?>
							</div>
						</div>
					</nav>
				</header>

			<div id="content" class="site-content">
