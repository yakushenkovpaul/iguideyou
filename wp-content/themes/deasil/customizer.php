<?php
/**
 * Defines customizer options
 *
 * @package Customizer Library 
 */

function customizer_library_deasil_options() {

	// If using image radio buttons, define a directory path
	$image_path =  get_template_directory_uri() . '/assets/img/';

	// Theme defaults
	$primary_color = '#558B2F';
	$base_color = '#111111';
	$font_color = '#4b4b4b';


	$head_font = 'Montserrat';
	$body_font = 'Open Sans';
	$font_size = 14;


	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Logo inside Site identity
	$options['logo'] = array(
		'id' => 'logo',
		'label'   => esc_html__( 'Logo', 'deasil' ),
		'section' => 'title_tagline',
		'type'    => 'image',
		'transport' => 'postMessage',
		'description' => esc_html__( 'Best result with image height 50px', 'deasil' )
	);


	// favicon
	$options['favicon'] = array(
		'id' => 'favicon',
		'label'   => esc_html__( 'Favicon', 'deasil' ),
		'section' => 'title_tagline',
		'type'    => 'image',
		'transport' => 'postMessage',
		'default' => $image_path . 'favicon.png',
		'description' => esc_html__( 'PNG Image 32px X 32px', 'deasil' )
	);

	//File Upload
	$section = 'header_image';

	$sections[] = array(
		'id' => $section,
		'title' => esc_html__( 'Header Image', 'deasil' ),
		'priority' => '30',
		'description' => esc_html__( 'Best result with image size 1600px by 400px', 'deasil' )
	);

	$options['header_image'] = array(
		'id' => 'header_image',
		'label'   => esc_html__( 'Header Image', 'deasil' ),
		'section' => $section,
		'type'    => 'image',
		'default' => '',
	);

	// Colors
	$section = 'colors';

	$sections[] = array(
		'id' => $section,
		'title' => esc_html__( 'Colors', 'deasil' ),
		'priority' => '80'
	);

	$options['primary_color'] = array(
		'id' => 'primary_color',
		'label'   => esc_html__( 'Primary Color', 'deasil' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
		'transport'   => 'refresh'
	);
	$options['base_color'] = array(
		'id' => 'base_color',
		'label'   => esc_html__( 'Base Color', 'deasil' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $base_color,
	);

	// Typography
	$section = 'typography';
	$font_choices = customizer_library_get_font_choices();

	$sections[] = array(
		'id' => $section,
		'title' => esc_html__( 'Typography', 'deasil' ),
		'priority' => '80'
	);

	$options['head_font'] = array(
		'id' => 'head_font',
		'label'   => esc_html__( 'Head Font', 'deasil' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => $head_font
	);

	$options['body_font'] = array(
		'id' => 'body_font',
		'label'   => esc_html__( 'Body Font', 'deasil' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => $body_font
	);

	$font_size_select = array(
		'8px' => '8px',
		'9px'=>  '9px',
		'10px' => '10px',
		'11px'=>  '11px',
		'12px' => '12px',
		'13px' => '13px',
		'14px'=>  '14px Default',
		'15px' => '15px',
		'16px' => '16px',
		'17px' => '17px'
	);
	$options['font_size'] = array(
		'id' => 'font_size',
		'label'   => esc_html__( 'Base Font Size', 'deasil' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_size_select,
		'default' => '14px'
	);


	$panel = 'deasilsetting';

	$panels[] = array(
		'id' => $panel,
		'title' => __( 'Deasil Setting', 'deasil' ),
		'priority' => '220'
	);

// Blog
	$section = 'button';

	$sections[] = array(
		'id' => $section,
		'title' => esc_html__( 'Button Style', 'deasil' ),
		'priority' => '90',
		'panel' => $panel
	);

	$button_style = array(
		'' => 'Default',
		'btn-r'=>  'Round',
		'btn-rc' => 'Round Corner'
	);
	$options['button_style'] = array(
		'id' => 'button_style',
		'label'   => esc_html__( 'Button Style', 'deasil' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $button_style,
		'default' => 'left'
	);


	// Blog
	$section = 'blog';

	$sections[] = array(
		'id' => $section,
		'title' => esc_html__( 'Blog Layout Setting', 'deasil' ),
		'priority' => '100',
		'panel' => $panel
	);

	$deasil_menu_bg_choices = array(
		'base' => esc_html__('Base', 'deasil'),
		'overlay'=>  esc_html__('Overlay', 'deasil'),
		'transparent'=>  esc_html__('Transparent', 'deasil')
	);
	$options['deasil_menu_style'] = array(
		'id' => 'deasil_menu_style',
		'label'   => esc_html__( 'General Menu Background', 'deasil' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $deasil_menu_bg_choices,
		'default' => 'base'
	);

	$options['blog_image'] = array(
		'id' => 'blog_image',
		'label'   => esc_html__( 'Blog Title Image', 'deasil' ),
		'section' => $section,
		'type'    => 'image',
		'default' => '',
	);

	$title_choices = array(
		'left' => esc_html__('Left Align', 'deasil'),
		'center'=>  esc_html__('Center Align', 'deasil')
	);
	$options['blog_title_align'] = array(
		'id' => 'blog_title_align',
		'label'   => esc_html__( 'Blog Title Align', 'deasil' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $title_choices,
		'default' => 'left'
	);

	$blog_list_choices = array(
		'left' => esc_html__('Left Image', 'deasil'),
		'right' => esc_html__('Right Image', 'deasil'),
		'full-img'=>  esc_html__('Full Image', 'deasil')
	);

	$options['blog_list_layout'] = array(
		'id' => 'blog_list_layout',
		'label'   => esc_html__( 'Blog List Layout', 'deasil' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $blog_list_choices,
		'default' => 'right'
	);


	$options['blog_pagination'] = array(
		'id' => 'blog_pagination',
		'label'   => esc_html__( 'Show Pagination', 'deasil' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0
	);
	$options['blog_side_image'] = array(
		'id' => 'blog_side_image',
		'label'   => esc_html__( 'Side Image for Blog List', 'deasil' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0
	);


	$sidebar_choices = array(
		'right-sidebar'=>  esc_html__('Right Sidebar', 'deasil'),
		'left-sidebar' => esc_html__('Left Sidebar', 'deasil'),
		'no-sidebar' => esc_html__('No Sidebar', 'deasil'),
	);
	$options['blog_sidebar'] = array(
		'id' => 'blog_sidebar',
		'label'   => esc_html__( 'Blog Sidebar', 'deasil' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $sidebar_choices,
		'default' => 'right-sidebar'
	);


	// WooCommerce
	$section = 'woocommerce';

	$sections[] = array(
		'id' => $section,
		'title' => esc_html__( 'WooCommerce Layout', 'deasil' ),
		'priority' => '120',
		'panel' => $panel
	);

	$options['woo_image'] = array(
		'id' => 'woo_image',
		'label'   => esc_html__( 'Shop Title Image', 'deasil' ),
		'section' => $section,
		'type'    => 'image',
		'default' => '',
	);
	$title_choices = array(
		'left' => esc_html__('Left Align', 'deasil'),
		'center'=>  esc_html__('Center Align', 'deasil')
	);
	$options['woo_title_align'] = array(
		'id' => 'woo_title_align',
		'label'   => esc_html__( 'Shop Title Align', 'deasil' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $title_choices,
		'default' => 'left'
	);
	$woo_sidebar_choices = array(
		'left-sidebar' => esc_html__('Left Sidebar', 'deasil'),
		'right-sidebar'=>  esc_html__('Right Sidebar', 'deasil'),
		'no-sidebar'=>  esc_html__('No Sidebar', 'deasil')
	);
	$options['woo_sidebar'] = array(
		'id' => 'woo_sidebar',
		'label'   => esc_html__( 'Sidebar Position', 'deasil' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $woo_sidebar_choices,
		'default' => 'left-sidebar'
	);

	$options['woo_sidebar'] = array(
		'id' => 'woo_sidebar',
		'label'   => esc_html__( 'Sidebar Position', 'deasil' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $woo_sidebar_choices,
		'default' => 'left-sidebar'
	);
	$options['woo_show_toggle'] = array(
		'id' => 'woo_show_toggle',
		'label'   => esc_html__( 'Show Grid / List Toogle Button', 'deasil' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => '1'
	);

	$column_count_choices = array(
		'2' => '2',
		'3' => '3',
		'4'=>  '4'
	);
	$options['woo_column_count'] = array(
		'id' => 'woo_column_count',
		'label'   => esc_html__( 'Number of Grid Column', 'deasil' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $column_count_choices,
		'default' => '2'
	);


	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );
	// To delete custom mods use: customizer_library_remove_theme_mods();

}
add_action( 'init', 'customizer_library_deasil_options' );


