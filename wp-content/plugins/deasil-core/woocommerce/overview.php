<?php

/**
 * WooCommerce Description tab changed to "Overview"
 */


if(!function_exists('deasil_overview_options_tab')) {
    /*Add Description menu on Admin Dashboard - Product edit*/
    function deasil_overview_options_tab( $tabs) {
        global $post;
        $is_deasil_trip = get_post_meta( $post->ID, 'is_deasil_trip', true );
        if($is_deasil_trip == 'on'){
            $class = array("show_if_simple", "show_if_variable", "show_if_external");
        }
        else{
            $class = array("hide_if_simple", "hide_if_variable", "hide_if_external");
        };
        $tabs['deasil_overview_data'] = array(
            'label'     => __('Overview', 'deasil-core'),
            'target'    => 'deasil_overview_data',
            'class'     => array_merge( $class, array('deasil-overview')  ),
        );
        return $tabs;
    }
    add_filter( 'woocommerce_product_data_tabs', 'deasil_overview_options_tab', 101);
}


if(!function_exists('deasil_overview_options')) {
    /*Add Overview Content form on Admin Dashboard - Product edit*/
    function deasil_overview_options() {
        global $post;

        $deasil_overview_options = array(
            'title' => get_post_meta($post->ID, 'deasil_overview_title', true),
            'content' => get_post_meta($post->ID, 'deasil_overview_content', true),
        );
        ?>
        <div id="deasil_overview_data" class="panel woocommerce_options_panel">
            <?php 
            $overview_title = get_post_meta( $post->ID, 'deasil_trip_overview_title', true ); 
            if($overview_title == ''){
                $overview_title = esc_html__( 'Overview', 'deasil-core' );
            }
            ?>
            <p class="form-field">
                <label><?php echo esc_html__('Tab Title', 'deasil-core');?></label>
                <input type="text" name="deasil_trip_overview_title" value="<?php if(isset($overview_title)) echo $overview_title; ?>" />
            </p>
            <hr/>
            <table class="admin-table">
                <tr>
                    <td style="width: 60%">
                        <?php $overview = get_post_meta( $post->ID, 'deasil_trip_overview', true ); ?>
                        <p class="form-field">
                            <?php $deasil_overview_icons_hide = get_post_meta( $post->ID, 'deasil_overview_icons_hide', true );?>
                            <label><?php echo esc_html__('Hide Overview Icons', 'deasil-core');?></label>
                            <input type="checkbox" name="deasil_overview_icons_hide" value="hide" <?php if($deasil_overview_icons_hide == 'hide') echo 'checked';?> />
                        </p>
                        <div style="padding: 15px;">
                            <div class="overview-form">
                                <input type="hidden" class="form-count" name="form-count" value=" <?php echo count($overview);?>">
                                <?php if(is_array($overview)):
                                    $i = 0;
                                    foreach ($overview as $overviewvalue)
                                    {   
                                        echo '<div class="form-field">';

                                        if (is_array($overviewvalue)){
                                            foreach ($overviewvalue as $key => $value) {
                                                switch($key){
                                                    case 'icon':
                                                    if($value == ''){
                                                        echo '<div class="formicon" data-icon-id="'.$i.'"><i class="icon no-icon" id="formicon'.$i.'"></i></div>'; 
                                                    }
                                                    else{
                                                        echo '<div class="formicon" data-icon-id="'.$i.'"><i class="icon '.$value.'" id="formicon'.$i.'"></i></div>'; 
                                                    }
                                                    echo '<input type="hidden" name="formicon'.$i.'" id="formicon_hidden'.$i.'" value="'.$value.'" />';
                                                    break;
                                                    case 'title':
                                                    echo '<input type="text" name="formtitle'.$i.'" value="'.$value.'" />';
                                                    break;
                                                    case 'value':
                                                    echo '<input type="text" name="formvalue'.$i.'" value="'.$value.'" />';
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
                                            <input type="hidden" name="formicon0" id="formicon_hidden0" value="" />
                                            <input type="text" name="formtitle0" value="" placeholder="Title" />
                                            <input type="text" name="formvalue0" value="" placeholder="Value" />
                                        </div>
                                    <?php endif;?>

                                </div>
                                <div id="deasil-popup-overview" class="deasil-popup" title="<?php esc_attr_e( 'Choose icon' , 'deasil-core' );?>" style="display: none;">
                                    <input type="hidden" id="icon-holder-overview" name="icon-holder-overview" value="">
                                    <div class="icon-select">
                                        <input id="search-overview"  class="search-input" name="search-1" placeholder="" type="text" data-toggle="hideseek" data-list="#icon-list-overview" autocomplete="off">
                                        <div class="icon-list-wrap">
                                            <ul id="icon-list-overview" class="iconlist"></ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrap">
                                    <button type="button" id="add-overview-info" class="button"><?php esc_attr_e( 'Add' , 'deasil-core' );?></button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php echo '<strong>'.esc_html__('Side Content', 'deasil-core').'</strong>';?>
                            <?php
                            $deasil_overview_side_content = get_post_meta( $post->ID, 'deasil_overview_side_content', true );
                            $content = $deasil_overview_side_content;
                            $editor_id = 'deasil_overview_side_content';
                            $setting = array(
                                'media_buttons' => true,
                                'quicktags'     => false,
                                'teeny' => false,
                                'editor_height' => '150',
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
                <hr>
                <p class="form-field">
                    <?php $deasil_trip_map = get_post_meta( $post->ID, 'deasil_trip_map', true ); ?>
                    <?php echo $deasil_trip_map;?>
                    <label for=""><?php _e( 'Map', 'deasil-core' ); ?></label>
                    <textarea name="deasil_trip_map"><?php if(isset($deasil_trip_map)) echo $deasil_trip_map; ?></textarea>
                </p>


            </div>
            <?php
        }
        add_action('woocommerce_product_data_panels', 'deasil_overview_options');
    }


    if(!function_exists('deasil_add_custom_general_fields_save')) {
        /* Save Overview form field/data to database */
        function deasil_add_custom_general_fields_save( $post_id ){
            $deasil_trip_overview_title = $_POST['deasil_trip_overview_title'] ;
            update_post_meta( $post_id, 'deasil_trip_overview_title', $deasil_trip_overview_title );

            $form_count = esc_attr( $_POST['form-count'] );
            for ($i = 0; $i <= $form_count; $i++) {
                $form_icon = esc_attr( $_POST['formicon'.$i] );
                $form_title = esc_attr( $_POST['formtitle'.$i] );
                $form_value = esc_attr( $_POST['formvalue'.$i] );
                if($form_icon != '' || $form_title != '' || $form_value != ''){
                    $tempArray[$i]  = array("icon" => $form_icon, "title" => $form_title, "value" =>$form_value);    
                }
            } 
            $overview =  $tempArray;
            update_post_meta( $post_id, 'deasil_trip_overview', $overview );

            $deasil_overview_icons_hide = $_POST['deasil_overview_icons_hide'] ;
            update_post_meta( $post_id, 'deasil_overview_icons_hide', $deasil_overview_icons_hide );

            $deasil_overview_side_content = $_POST['deasil_overview_side_content'] ;
            update_post_meta( $post_id, 'deasil_overview_side_content', $deasil_overview_side_content );

            $deasil_trip_map = $_POST['deasil_trip_map'] ;
            update_post_meta( $post_id, 'deasil_trip_map', $deasil_trip_map );

        }
        add_action( 'woocommerce_process_product_meta', 'deasil_add_custom_general_fields_save' );
    }



/*
*Front End
*/


if(!function_exists('deasil_rename_tab_overview')) {
    /* Save Overview tab to description if product not bookable */
    function deasil_rename_tab_overview( $tabs ) {
        global $product, $post;
        $is_deasil_trip = get_post_meta( $post->ID, 'is_deasil_trip', true );
        if ( $post->post_content ) {
            if($is_deasil_trip ==  'on'){
                $overview_title = get_post_meta( $post->ID, 'deasil_trip_overview_title', true ); 
                if($overview_title == ''){
                    $overview_title = esc_html__( 'Overview', 'deasil-core' );
                }
                $tabs['description']['title'] = $overview_title;/* Rename the description tab*/
            }
            else{
                $tabs['description']['title'] = esc_html__( 'Description', 'deasil-core' );/* Rename the description tab*/
            }

            $tabs['description']['callback'] = 'deasil_custom_description_tab_content';
        }

        return $tabs;
    }
    add_filter( 'woocommerce_product_tabs', 'deasil_rename_tab_overview', 98 );


    function deasil_custom_description_tab_content() {
        global $post;
        $deasil_trip_overview = get_post_meta( $post->ID, 'deasil_trip_overview', true );
        $array_filter_overview = $deasil_trip_overview;
        $is_deasil_trip = get_post_meta( $post->ID, 'is_deasil_trip', true );
        $grade = strip_tags(get_the_term_list( $post->ID, 'grade', '', '' , '' ));
        $deasil_day = get_post_meta( $post->ID, 'deasil_tour_day', true); 
        $deasil_night = get_post_meta( $post->ID, 'deasil_tour_night', true); 
        $deasil_overview_icons_hide = get_post_meta( $post->ID, 'deasil_overview_icons_hide', true );
        $deasil_overview_side_content = get_post_meta( $post->ID, 'deasil_overview_side_content', true );

        echo '<div class="row">';
        if(isset($is_deasil_trip) && $is_deasil_trip='on'){
            if($deasil_overview_icons_hide == 'hide' && $deasil_overview_side_content == ''){
                echo '<div class="col-sm-12">';
                the_content();
                echo '</div>';
            }
            else{
                echo '<div class="col-sm-6">';
                the_content();
                echo '</div>';

                echo '<div class="col-sm-6">';
                if($deasil_overview_icons_hide != 'hide'){
                   echo '<div class="border-box">';
                   echo '<ul class="trip-overview">';

                   $terms = get_the_terms( $post->ID , 'grade' );
                   $grade_term = get_the_term_list( $post->ID , 'grade', '', ', ', '');
                   if($terms) {
                    foreach( $terms as $term ) {
                        $grade = $term->name;
                        $icon_class = get_term_meta ( $term->term_id, 'grade-icon-id', true );
                    }
                }

                $category = wc_get_product_category_list( $post->ID, ', ');
                $cat_string = strip_tags($category);
                if($cat_string != 'Uncategorized'){
                    echo '<li>';
                    echo '<span class="icon-barcode"></span>';
                    echo '<div class="detail">';
                    echo '<div class="title">'.__('Category', 'deasil-core').'</div>';
                    echo '<div class="desc">'.$category .'</div></div></li>';
                }

                $location = get_the_term_list( $post->ID, 'location', '', ', ', '' );
                if($location != ''){
                    echo '<li>';
                    echo '<span class="icon-earth"></span>';
                    echo '<div class="detail">';
                    echo '<div class="title">'.__('Location', 'deasil-core').'</div>';
                    echo '<div class="desc">'.$location.'</div></div></li>';
                }

                if (!empty($grade)){
                    echo '<li>';
                    echo '<span class="'.$icon_class.'"></span>';
                    echo '<div class="detail">';
                    echo '<div class="title">'.__('Grade', 'deasil-core').'</div>';
                    echo '<div class="desc">'.$grade_term.'</div></div></li>';
                }

                if (!empty($deasil_day)){
                    echo '<li>';                      
                    echo '<span class="icon-sun"></span>';
                    echo '<div class="detail">';
                    echo '<div class="title">'.__('Days', 'deasil-core').'</div>';
                    echo '<div class="desc">'.$deasil_day.'</div></div></li>';
                }

                if (!empty($deasil_night)){
                  echo '<li>';                      
                  echo '<span class="icon-moon"></span>';
                  echo '<div class="detail">';
                  echo '<div class="title">'.__('Nights', 'deasil-core').'</div>';
                  echo '<div class="desc">'.$deasil_night.'</div></div></li>';
              }

              if(is_array($deasil_trip_overview)){
                foreach($deasil_trip_overview  as $overview){
                    echo '<li>';
                    if(is_array($overview)){
                        foreach($overview as $key => $value){
                            if($key == 'icon'){
                                echo '<span class="'.$value.'"></span>';
                            }
                            else if($key == 'title'){
                                echo '<div class="detail">';
                                echo '<div class="title">'.$value.'</div>';
                            }
                            else if($key == 'value'){
                                echo '<div class="desc">'.$value.'</div>';
                                echo '</div>';
                            }
                            else{
                            }
                        }
                    }
                    echo '</li>';
                }
            }
            echo '</ul></div>';
        }

         if($deasil_overview_side_content != ''){
            echo do_shortcode($deasil_overview_side_content);
         };

        echo'</div>';
    }
}
else{
    echo '<div class="col-sm-12">';
    the_content();
    echo '</div>';
}

echo '</div>';
}
}
