<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

if(!function_exists('deasil_widgets_init')) {
	function deasil_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'deasil' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'deasil' ),
			'before_widget' => '<div id="%1$s" class="border-box %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="box-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'WooCommerce Sidebar', 'deasil' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'deasil' ),
			'before_widget' => '<div id="%1$s" class="border-box %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="box-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer1', 'deasil' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'deasil' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer2', 'deasil' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'deasil' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer3', 'deasil' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'deasil' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer4', 'deasil' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here.', 'deasil' ),
			'before_widget' => '<div id="%1$s" class="%2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		) );
	}
	add_action( 'widgets_init', 'deasil_widgets_init' );
}