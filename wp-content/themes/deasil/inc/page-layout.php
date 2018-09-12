<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Deasil
 */

if(!function_exists('deasil_meta_box_page_layout')) {
    function deasil_meta_box_page_layout()
    {
        global $post;
        if(!empty($post))
        {
            add_meta_box( 
                'deasil_layout_box', 
                esc_html__( 'Deasil Page Layout', 'deasil' ), 
                'deasil_meta_box_layout_detail', 
                'page', 
                'side', 
                'low' ); 
        }
    }
    add_action( 'add_meta_boxes', 'deasil_meta_box_page_layout' );

    function deasil_meta_box_layout_detail($post)
    {
    // $post is already set, and contains an object: the WordPress post
        global $post;
        $values = get_post_custom( $post->ID );
        
        $sidebar = isset( $values['deasil_layout_sidebar'] ) ? esc_attr( $values['deasil_layout_sidebar'][0] ) : 'with-sidebar';
        $page_title = isset( $values['deasil_page_title'] ) ? esc_attr( $values['deasil_page_title'][0] ) : '';
        $menu_bg = isset( $values['deasil_menu_bg'] ) ? esc_attr( $values['deasil_menu_bg'][0] ) : 'base';


        // We'll use this nonce field later on when saving.
        wp_nonce_field( 'deasil_meta_box_nonce', 'meta_box_nonce' );
        ?>

        <?php //print_r(get_current_screen());?>
        <p class="post-attributes-label-wrapper">
            <label class="post-attributes-label" for="deasil_layout_sidebar"><?php esc_html_e('Sidebar', 'deasil')?></label>
        </p>
        <select name="deasil_layout_sidebar" id="deasil_layout_sidebar">
            <option value="right-sidebar" <?php selected( $sidebar, 'right-sidebar' ); ?>><?php esc_html_e('Right Sidebar', 'deasil')?></option>
            <option value="left-sidebar" <?php selected( $sidebar, 'left-sidebar' ); ?>><?php esc_html_e('Left Sidebar', 'deasil')?></option>
            <option value="no-sidebar" <?php selected( $sidebar, 'no-sidebar' ); ?>><?php esc_html_e('No Sidebar', 'deasil')?></option>
        </select>

        <p class="post-attributes-label-wrapper">
            <label class="post-attributes-label" for="deasil_page_title"><?php esc_html_e('Page Title', 'deasil')?></label>
        </p>
        <select name="deasil_page_title" id="deasil_page_title">
            <option value="" <?php selected( $page_title, '' ); ?>><?php esc_html_e('Default Left', 'deasil')?></option>
            <option value="center" <?php selected( $page_title, 'center' ); ?>><?php esc_html_e('Center', 'deasil')?></option>
            <option value="no-title" <?php selected( $page_title, 'no-title' ); ?>><?php esc_html_e('No Title', 'deasil')?></option>
        </select>

        <p class="post-attributes-label-wrapper">
            <label class="post-attributes-label" for="deasil_menu-bg"><?php esc_html_e('Menu Background', 'deasil')?></label>
        </p>
        <select name="deasil_menu_bg" id="deasil_menu_bg">
            <option value="base" <?php selected( $menu_bg, 'base' ); ?>><?php esc_html_e('Base Color', 'deasil')?></option>
            <option value="overlay" <?php selected( $menu_bg, 'overlay' ); ?>><?php esc_html_e('Overlay', 'deasil')?></option>
            <option value="transparent" <?php selected( $menu_bg, 'transparent' ); ?>><?php esc_html_e('Transparent', 'deasil')?></option>
        </select>
        
    <?php 
    }


    add_action( 'save_post', 'deasil_meta_box_layout_detail_save' );
    function deasil_meta_box_layout_detail_save( $post_id )
    {
        // Bail if we're doing an auto save
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

        // if our nonce isn't there, or we can't verify it, bail
        if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'deasil_meta_box_nonce' ) ) return;
        if( !current_user_can( 'edit_post', $_POST['post_ID'] ) )
            return;


        // now we can actually save the data
        $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
            )
        );
        
        if( isset( $_POST['deasil_layout_sidebar'] ) )
            update_post_meta( $post_id, 'deasil_layout_sidebar', esc_attr( $_POST['deasil_layout_sidebar'] ) );
        if( isset( $_POST['deasil_page_title'] ) )
            update_post_meta( $post_id, 'deasil_page_title', esc_attr( $_POST['deasil_page_title'] ) );
        if( isset( $_POST['deasil_menu_bg'] ) )
            update_post_meta( $post_id, 'deasil_menu_bg', esc_attr( $_POST['deasil_menu_bg'] ) );

    }

}

