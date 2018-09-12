<?php
if(!function_exists('deasil_post_team')) {
	/*Regiter post type team*/
	function deasil_post_team() {
		$labels = array(
			'name'               => esc_html_x( 'Team Members', 'post type general name', 'deasil-core' ),
			'singular_name'      => esc_html_x( 'Team Member', 'post type singular name', 'deasil-core' ),
			'menu_name'          => esc_html_x( 'Team Members', 'admin menu', 'deasil-core' ),
			'name_admin_bar'     => esc_html_x( 'Team Member', 'add new on admin bar', 'deasil-core' ),
			'add_new'            => esc_html__( 'Add New', 'deasil-core' ),
			'add_new_item'       => esc_html__( 'Add New Team Member', 'deasil-core' ),
			'new_item'           => esc_html__( 'New Team Member', 'deasil-core' ),
			'edit_item'          => esc_html__( 'Edit Team Member', 'deasil-core' ),
			'view_item'          => esc_html__( 'View Team Member', 'deasil-core' ),
			'all_items'          => esc_html__( 'All Team Members', 'deasil-core' ),
			'search_items'       => esc_html__( 'Search Team Members', 'deasil-core' ),
			'parent_item_colon'  => esc_html__( 'Parent Team Members:', 'deasil-core' ),
			'not_found'          => esc_html__( 'No Team Members found.', 'deasil-core' ),
			'not_found_in_trash' => esc_html__( 'No Team Members found in Trash.', 'deasil-core' )
			);

		$args = array(
			'labels'             => $labels,
			'description'        => esc_html__( 'Description.', 'deasil-core' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'team_member' ),
			'capability_type'    => 'page',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 20,
			'menu_icon'           => 'dashicons-businessman',
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
			);
		register_post_type( 'deasil_team', $args ); 
	}
	add_action( 'init', 'deasil_post_team' );
}