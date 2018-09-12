<?php
/*custom tab  Itenary*/

/**
 * WooCommerce Add tab
 */

if(!function_exists('deasil_itinerary_options_tab')) {
    /*Add itenary menu on Admin Dashboard - Product edit*/
    function deasil_itinerary_options_tab( $tabs) {
        global $post;
        $product = wc_get_product( $post->ID );
        $is_deasil_trip = get_post_meta( $post->ID, 'is_deasil_trip', true );
         if($is_deasil_trip == 'on'){
            $class = array("show_if_simple", "show_if_variable", "show_if_external");
        }
        else{
            $class = array("hide_if_simple", "hide_if_variable", "hide_if_external");
        };

        $tabs['deasil_itinerary_data'] = array(
            'label'     => esc_html__('Itinerary', 'deasil-core'),
            'target'    => 'deasil_itinerary_data',
            'class'     => array_merge($class, array('deasil-itinerary')),
        );
        return $tabs;
    }
    add_filter( 'woocommerce_product_data_tabs', 'deasil_itinerary_options_tab', 102);
}

if(!function_exists('deasil_itinerary_options')) {
    /*Add itinerary Content form on Admin Dashboard - Product edit*/
    function deasil_itinerary_options() {
        global $post;

        $deasil_itinerary_options = array(
            'title' => get_post_meta($post->ID, 'deasil_itinerary_title', true),
            'content' => get_post_meta($post->ID, 'deasil_itinerary_content', true),
        );
        ?>
        <div id="deasil_itinerary_data" class="panel woocommerce_options_panel">
            <?php 
            $itinerary_title = get_post_meta( $post->ID, 'deasil_trip_itinerary_title', true ); 
            $deasil_trip_itinerary_tab_hide = get_post_meta( $post->ID, 'deasil_trip_itinerary_tab_hide', true ); 
            if($itinerary_title == ""){
                $itinerary_title = esc_html__( 'Itinerary', 'deasil-core' );
            }
            ?>
            <table class="admin-table">
                <tr>
                    <td>
                        <p class="form-field">
                            <label><?php echo esc_html__('Tab Title', 'deasil-core');?></label>
                            <input type="text" name="deasil_trip_itinerary_title" value="<?php if(isset($itinerary_title)) echo $itinerary_title; ?>" />
                        </p>
                    </td>
                    <td style="width: 80px;">
                        <p class="form-field">
                            <label><?php echo esc_html__('Hide tab', 'deasil-core');?></label>
                            <input type="checkbox" name="deasil_trip_itinerary_tab_hide" value="hide" <?php if($deasil_trip_itinerary_tab_hide == 'hide') echo 'checked';?> />
                        </p>
                    </td>
                </tr>
            </table>
            <hr/>

            <table class="admin-table">
                <tr>
                    <td style="width: 60%">
                        <?php $itinerary = get_post_meta( $post->ID, 'deasil_itinerary_field', true ); ?>
                        <div class="itinerary-form">
                            <input type="hidden" id="form-count" name="itinerary-form-count" value=" <?php echo count($itinerary);?>">
                            <?php if(is_array($itinerary)):
                                $i = 0;
                                foreach ($itinerary as $itineraryvalue)
                                {   
                                    echo '<div class="form-field">';
                                    if (is_array($itineraryvalue)){
                                        foreach ($itineraryvalue as $key => $value) {
                                            switch($key){
                                                case 'icon':
                                                if($value == ''){
                                                    echo '<div class="formicon" data-icon-id="'.$i.'"><i class="icon no-icon" id="formicon'.$i.'"></i></div>'; 
                                                }
                                                else{
                                                    echo '<div class="formicon" data-icon-id="'.$i.'"><i class="icon '.$value.'" id="formicon'.$i.'"></i></div>';     
                                                }
                                                echo '<input type="hidden" name="itineraryformicon'.$i.'" id="formicon_hidden'.$i.'" value="'.$value.'" />';
                                                break;
                                                case 'day':
                                                echo '<input type="text" class="input-day" name="itineraryformday'.$i.'" value="'.$value.'" />';
                                                break;
                                                case 'title':
                                                echo '<textarea class="input-title" name="itineraryformtitle'.$i.'">'.$value.'</textarea>';
                                                break;
                                                case 'value':
                                                $editor_content = $value;
                                                $editor_id = 'itineraryformvalue'.$i;
                                                $setting = array(
                                                    'media_buttons' => false,
                                                    'quicktags'     => false,
                                                    'teeny'     => true,
                                                    'tinymce' => array(
                                                        'toolbar1'=> 'bullist,bold,italic,link,unlink'
                                                    ),
                                                );
                                                wp_editor( $editor_content, $editor_id , $setting);
                                            //echo '<textarea class="input-desc" name="itineraryformvalue'.$i.'">'.$value.'</textarea>';
                                                break;
                                            }
                                        }
                                    }
                                    echo '<div class="btn-delete"></div></div>';
                                    $i = $i + 1 ;
                                }
                                else: ?>
                                    <div class="form-field">
                                        <div class="formicon" data-icon-id="0"><i class="no-icon icon" id="formicon0"></i></div>
                                        <input type="hidden" name="itineraryformicon0" id="formicon_hidden0" value="" />
                                        <input type="text" class="input-day" name="itineraryformday0" value="" placeholder="Day" />
                                        <textarea class="input-title"  name="itineraryformtitle0"></textarea>
                                        <textarea class="input-desc"  name="itineraryformvalue0"></textarea>
                                    </div>
                                <?php endif; ?>

                            </div>
                            <div id="deasil-popup-itinerary" class="deasil-popup" title="<?php esc_attr_e( 'Choose icon' , 'deasil-core' );?>" style="display: none;">
                                <input type="hidden" id="icon-holder-itinerary" name="icon-holder-itinerary" value="">
                                <div class="icon-select">
                                    <input id="search-itinerary" class="search-input" name="search-1" placeholder="" type="text" data-toggle="hideseek" data-list="#icon-list-itinerary" autocomplete="off">
                                    <div class="icon-list-wrap">
                                        <ul id="icon-list-itinerary" class="iconlist"></ul>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-wrap">
                                <button type="button" id="add-itinerary-info" class="button"><?php esc_attr_e( 'Add' , 'deasil-core' );?></button>
                            </div>

                        </td>

                        <td>
                            <?php

                            echo '<strong>'.esc_html__('Side Content', 'deasil-core').'</strong>';
                            $deasil_itinerary_side_content = get_post_meta( $post->ID, 'deasil_itinerary_side_content', true );
                            $content = $deasil_itinerary_side_content;
                            $editor_id = 'deasil_itinerary_side_content';
                            $setting = array(
                                'media_buttons' => true,
                                'quicktags'     => false,
                                'teeny' => false,
                                'editor_height' => '250',
                                'tinymce' => array(
                                    'toolbar1'=>  'formatselect,bold,italic,underline,bullist,numlist,link,unlink, pre_code_button',
                                    'toolbar2'=> ''
                                )
                            );
                            wp_editor( $content, $editor_id , $setting);

                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        <?php }
        add_action('woocommerce_product_data_panels', 'deasil_itinerary_options');
    }


    if(!function_exists('deasil_itinerary_fields_save')) {
        /* Save Itenary form data to database */
        function deasil_itinerary_fields_save( $post_id ){
            $deasil_trip_itinerary_title = $_POST['deasil_trip_itinerary_title'] ;
            update_post_meta( $post_id, 'deasil_trip_itinerary_title', $deasil_trip_itinerary_title );

            $deasil_trip_itinerary_tab_hide = $_POST['deasil_trip_itinerary_tab_hide'] ;
            update_post_meta( $post_id, 'deasil_trip_itinerary_tab_hide', $deasil_trip_itinerary_tab_hide );

            $form_count = esc_attr( $_POST['itinerary-form-count'] );
            for ($i = 0; $i <= $form_count; $i++) {
                $form_icon = esc_attr( $_POST['itineraryformicon'.$i] );
                $form_day = esc_attr( $_POST['itineraryformday'.$i] );
                $form_title = esc_attr( $_POST['itineraryformtitle'.$i] );
                $form_value = $_POST['itineraryformvalue'.$i];
                if($form_icon != '' || $form_day != ''|| $form_title != '' || $form_value != ''){
                    $itinerarytempArray[$i]  = array("icon" => $form_icon, "day" => $form_day, "title" => $form_title, "value" =>$form_value);    
                }
            } 

            $deasil_itinerary_field =  $itinerarytempArray;
            update_post_meta( $post_id, 'deasil_itinerary_field', $deasil_itinerary_field );

            $deasil_itinerary_side_content = $_POST['deasil_itinerary_side_content'] ;
            update_post_meta( $post_id, 'deasil_itinerary_side_content', $deasil_itinerary_side_content );

        }
        add_action( 'woocommerce_process_product_meta', 'deasil_itinerary_fields_save' );
    }


/*
*frontend*
*/

if(!function_exists('deasil_itinerary_woo_tab')) {
    /*Add itenary tab to product detail on frontend*/
    function deasil_itinerary_woo_tab( $tabs ) {
        global $post;
        $is_deasil_trip = get_post_meta( $post->ID, 'is_deasil_trip', true );        
        if($is_deasil_trip == 'on'){
            $itinerary_title = get_post_meta( $post->ID, 'deasil_trip_itinerary_title', true ); 


            if($itinerary_title == ""){
                $itinerary_title = esc_html__( 'Itinerary', 'deasil-core' );
            }
            $tabs['itinerary'] = array(
                'title' 	=> $itinerary_title,
                'priority' 	=> 20,
                'callback' 	=> 'deasil_itinerary_woo_tab_content'
            );

            $deasil_trip_itinerary_tab_hide = get_post_meta( $post->ID, 'deasil_trip_itinerary_tab_hide', true );
            if($deasil_trip_itinerary_tab_hide != 'hide' ){
                return $tabs;    
            }
            
        }
    }
    add_filter( 'woocommerce_product_tabs', 'deasil_itinerary_woo_tab' );

    function deasil_itinerary_woo_tab_content() {
        global $post;
        $deasil_itinerary_field = get_post_meta( $post->ID, 'deasil_itinerary_field', true );
        $deasil_itinerary_side_content = get_post_meta( $post->ID, 'deasil_itinerary_side_content', true );

        echo '<div class="row">';        
        if($deasil_itinerary_side_content == ''){
            $class_sub = 'col-sm-12 only-itinerary';
        }
        else{
            $class_sub = 'col-sm-7';
        }
        echo '<div class="'. $class_sub .'">';
        if(empty($deasil_itinerary_field)){
            echo esc_html__('Not Available', 'deasil-core');
        }
        else{
            if(is_array($deasil_itinerary_field)){
                foreach ($deasil_itinerary_field as $itineraryvalue){
                    echo '<div class="itinerary-steps">';
                    if(is_array($itineraryvalue)){
                        foreach ($itineraryvalue as $key => $value) {
                            switch($key){
                                case 'icon':
                                if($value == ''){
                                    echo '<div class="no-icon"></div>';    
                                }
                                else{
                                    echo '<div class="'.$value.'"></div>';      
                                }

                                break;
                                case 'day':
                                if($value != ''){
                                    echo '<div class="day-number">'.$value.'</div>';    
                                }
                                break;
                                case 'title':
                                echo '<div class="title">'.$value.'</div>';
                                break;
                                case 'value':
                                echo '<div class="detail">'.$value.'</div>';
                                break;
                            }
                        }
                    }
                    echo '</div>';
                }
            }
            
        }
        echo '</div>';
        if($deasil_itinerary_side_content != ''){
            echo '<div class="col-sm-5">';
            echo '<div class="itinerary-side">';
            echo do_shortcode($deasil_itinerary_side_content);
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    }
}
