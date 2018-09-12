<?php

if(!function_exists('deasil_add_bookable_option')) {
    /*add bookable checkbox on product - Admin*/
    function deasil_add_bookable_option( $product_type_options ) {
        $product_type_options['booking_option'] = array(
            'id'            => 'is_deasil_trip',
            'wrapper_class' => '',
            'label'         => esc_html__( 'Bookable', 'deasil-core' ),
            'description'   => esc_html__( 'Bookable products are Trip Pages that can be booked', 'deasil-core' )
            );

        return $product_type_options;
    }
    add_action( 'product_type_options', 'deasil_add_bookable_option');
}

if(!function_exists('deasil_update_is_deasil_trip')) {
    /*On bookable checkbox toggle Update Fields*/
    function deasil_update_is_deasil_trip( $post_id ){
        $is_deasil_trip = $_POST['is_deasil_trip'] ;
        update_post_meta( $post_id, 'is_deasil_trip', $is_deasil_trip );
    }
    add_action( 'woocommerce_process_product_meta', 'deasil_update_is_deasil_trip' );
}


if(!function_exists('deasil_remove_tab')) {
    /*On bookable checkbox toggle remove and hide extra menu - overview, itenary, cost-book*/
    function deasil_remove_tab( $tabs) {
        global $post;
        $is_bookable = get_post_meta( $post->ID, 'is_deasil_trip', true ); 
        if($is_bookable == 'on'){
            // Other default values for 'attribute' are; general, inventory, shipping, linked_product, variations, advanced
            $tabs['attribute']['class'][] = 'hide_if_simple';
            $tabs['shipping']['class'][] = 'hide_if_simple hide_if_variable';
        }

        return $tabs;
    }
    add_filter( 'woocommerce_product_data_tabs', 'deasil_remove_tab' );
}

/****************************/

if(!function_exists('deasil_meta_box_product_layout')) {
    /*add meta box Slider layout on Product detail -Admin*/
    function deasil_meta_box_product_layout()
    {
        global $post;
        if(!empty($post))
        {
            add_meta_box( 
                'deasil_slider_layout_box', 
                esc_html__('Deasil Slider Layout', 'deasil-core'), 
                'deasil_slider_layout_detail', 
                'product', 
                'side', 
                'low' ); 
        }
    }
    add_action( 'add_meta_boxes', 'deasil_meta_box_product_layout' );

    function deasil_slider_layout_detail($post){
        // $post is already set, and contains an object: the WordPress post
        global $post;
        $values = get_post_custom( $post->ID );
        
        $menu_bg = isset( $values['deasil_slider_bg'] ) ? esc_attr( $values['deasil_slider_bg'][0] ) : 'with-overlay';
        $slider_effect = isset( $values['deasil_slider_effect'] ) ? esc_attr( $values['deasil_slider_effect'][0] ) : 'carousel-fade';
        $slider_height = isset( $values['deasil_slider_height'] ) ? esc_attr( $values['deasil_slider_height'][0] ) : '';
        $slider_nav = isset( $values['deasil_slider_nav'] ) ? esc_attr( $values['deasil_slider_nav'][0] ) : '';
        $slider_indicator = isset( $values['deasil_slider_indicator'] ) ? esc_attr( $values['deasil_slider_indicator'][0] ) : '';
        $add_to_cart_label = (isset( $values['deasil_add_to_cart_label'] ) && ($values['deasil_add_to_cart_label'][0] != "")) ? esc_attr( $values['deasil_add_to_cart_label'][0] ) : esc_html__('Book Now', 'deasil-core');


        // We'll use this nonce field later on when saving.
        wp_nonce_field( 'slide_meta_box_nonce', 'meta_box_nonce_slider' );
        ?>

        <p class="post-attributes-label-wrapper">
            <label class="post-attributes-label" for="deasil_slider_bg"><?php esc_html_e('Slider Overlay', 'deasil-core')?></label>
        </p>
        <select name="deasil_slider_bg" id="deasil_slider_bg">
            <option value="with-overlay" <?php selected( $menu_bg, 'with-overlay' ); ?>><?php esc_html_e('Overlay', 'deasil-core')?></option>
            <option value="with-text-box" <?php selected( $menu_bg, 'with-text-box' ); ?>><?php esc_html_e('Boxed', 'deasil-core')?></option>
            <option value="" <?php selected( $menu_bg, '' ); ?>><?php esc_html_e('Transparent', 'deasil-core')?></option>
        </select>

        <p class="post-attributes-label-wrapper">
            <label class="post-attributes-label" for="deasil_slider_effect"><?php esc_html_e('Slider Effect', 'deasil-core')?></label>
        </p>
        <select name="deasil_slider_effect" id="deasil_slider_effect">
            <option value="carousel-fade" <?php selected( $slider_effect, 'carousel-fade' ); ?>><?php esc_html_e('Fade', 'deasil-core')?></option>
            <option value="slide" <?php selected( $slider_effect, 'slide' ); ?>><?php esc_html_e('Slide', 'deasil-core')?></option>
        </select>

        <p class="post-attributes-label-wrapper">
            <label class="post-attributes-label" for="deasil_slider_height"><?php esc_html_e('Slider height', 'deasil-core')?></label>
        </p>
        <select name="deasil_slider_height" id="deasil_slider_height">
            <option value="" <?php selected( $slider_height, '' ); ?>><?php esc_html_e('Default', 'deasil-core')?></option>
            <option value="full-height" <?php selected( $slider_height, 'full-height' ); ?>><?php esc_html_e('Full Height', 'deasil-core')?></option>
        </select>

        <p class="post-attributes-label-wrapper">
            <label class="post-attributes-label" for="deasil_slider_nav"><?php esc_html_e('Slider Nav Control Position', 'deasil-core')?></label>
        </p>
        <select name="deasil_slider_nav" id="deasil_slider_nav">
            <option value="" <?php selected( $slider_nav, '' ); ?>><?php esc_html_e('Default', 'deasil-core')?></option>
            <option value="bottom" <?php selected( $slider_nav, 'bottom' ); ?>><?php esc_html_e('Bottom', 'deasil-core')?></option>
            <option value="bottom-right" <?php selected( $slider_nav, 'bottom-right' ); ?>><?php esc_html_e('Bottom Right', 'deasil-core')?></option>
            <option value="bottom-left" <?php selected( $slider_nav, 'bottom-left' ); ?>><?php _e('Bottom left', 'deasil-core')?></option>
            <option value="hide" <?php selected( $slider_nav, 'hide' ); ?>><?php esc_html_e('Hide', 'deasil-core')?></option>
        </select>

        <p class="post-attributes-label-wrapper">
            <label class="post-attributes-label" for="deasil_slider_indicator"><?php esc_html_e('Slider Indicator', 'deasil-core')?></label>
        </p>
        <select name="deasil_slider_indicator" id="deasil_slider_indicator">
            <option value="" <?php selected( $slider_indicator, '' ); ?>><?php esc_html_e('Default', 'deasil-core')?></option>
            <option value="square" <?php selected( $slider_indicator, 'square' ); ?>><?php esc_html_e('Square', 'deasil-core')?></option>
            <option value="dashed" <?php selected( $slider_indicator, 'dashed' ); ?>><?php esc_html_e('Dashed', 'deasil-core')?></option>
            <option value="hide" <?php selected( $slider_indicator, 'hide' ); ?>><?php esc_html_e('Hide', 'deasil-core')?></option>
        </select>

         <p class="post-attributes-label-wrapper">
            <label class="post-attributes-label" for="deasil_add_to_cart_label"><?php esc_html_e('Add To Cart Button Label', 'deasil-core')?></label>
        </p>
        <input type="text" name="deasil_add_to_cart_label" id="deasil_add_to_cart_label" value="<?php echo esc_html($add_to_cart_label);?>">        
    
    <?php 
    }
}



if(!function_exists('deasil_slider_layout_detail_save')) {
    /* Save Deasil Slider setting Product to database */
    function deasil_slider_layout_detail_save( $post_id )
    {
        // Bail if we're doing an auto save
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

        // if our nonce isn't there, or we can't verify it, bail
        if( !isset( $_POST['meta_box_nonce_slider'] ) || !wp_verify_nonce( $_POST['meta_box_nonce_slider'], 'slide_meta_box_nonce' ) ) return;

        if( !current_user_can( 'edit_post', $_POST['post_ID'] ) )
            return;

        update_post_meta( $post_id, 'deasil_slider_bg', esc_attr( $_POST['deasil_slider_bg'] ) );
        update_post_meta( $post_id, 'deasil_slider_effect', esc_attr( $_POST['deasil_slider_effect'] ) );
        update_post_meta( $post_id, 'deasil_slider_height', esc_attr( $_POST['deasil_slider_height'] ) );
        update_post_meta( $post_id, 'deasil_slider_nav', esc_attr( $_POST['deasil_slider_nav'] ) );
        update_post_meta( $post_id, 'deasil_slider_indicator', esc_attr( $_POST['deasil_slider_indicator'] ) );
        update_post_meta( $post_id, 'deasil_add_to_cart_label', esc_attr( $_POST['deasil_add_to_cart_label'] ) );

    }
    add_action( 'save_post', 'deasil_slider_layout_detail_save' );
}



/****************************/

if(!function_exists('deasil_meta_box_tour_duration')) {
    /*add meta box Slider layout on Product detail -Admin*/
    function deasil_meta_box_tour_duration()
    {
        global $post;
        if(!empty($post))
        {
            add_meta_box( 
                'deasil_tour_duration', 
                esc_html__('Tour Duration', 'deasil-core'), 
                'deasil_tour_duration_detail', 
                'product', 
                'side', 
                'low' ); 
        }
    }
    add_action( 'add_meta_boxes', 'deasil_meta_box_tour_duration' );

    function deasil_tour_duration_detail($post){
        // $post is already set, and contains an object: the WordPress post
        global $post;
        $values = get_post_custom( $post->ID );
        
        $deasil_tour_day = isset( $values['deasil_tour_day'] ) ? esc_attr( $values['deasil_tour_day'][0] ) : '';
        $deasil_tour_night = isset( $values['deasil_tour_night'] ) ? esc_attr( $values['deasil_tour_night'][0] ) : '';


        // We'll use this nonce field later on when saving.
        wp_nonce_field( 'duration_meta_box_nonce', 'meta_box_nonce_duration' );
        ?>

        <p class="post-attributes-label-wrapper">
            <label class="post-attributes-label" for="deasil_tour_day"><?php esc_html_e('Tour Days', 'deasil-core')?></label>
        </p>
        <input type="number" name="deasil_tour_day" value="<?php echo $deasil_tour_day?>">

        <p class="post-attributes-label-wrapper">
            <label class="post-attributes-label" for="deasil_slider_effect"><?php esc_html_e('Tour Night', 'deasil-core')?></label>
        </p>
        <input type="number" name="deasil_tour_night" value="<?php echo $deasil_tour_night?>">
    
    <?php 
    }
}



if(!function_exists('deasil_tour_duration_detail_save')) {
    /* Save Deasil Slider setting Product to database */
    function deasil_tour_duration_detail_save( $post_id )
    {
        // Bail if we're doing an auto save
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

        // if our nonce isn't there, or we can't verify it, bail
        if( !isset( $_POST['meta_box_nonce_duration'] ) || !wp_verify_nonce( $_POST['meta_box_nonce_duration'], 'duration_meta_box_nonce' ) ) return;

        if( !current_user_can( 'edit_post', $_POST['post_ID'] ) )
            return;

        update_post_meta( $post_id, 'deasil_tour_day', esc_attr( $_POST['deasil_tour_day'] ) );
        update_post_meta( $post_id, 'deasil_tour_night', esc_attr( $_POST['deasil_tour_night'] ) );

    }
    add_action( 'save_post', 'deasil_tour_duration_detail_save' );
}



