<?php
/*
Element Description: VC Feature List
*/

if ( ! class_exists( 'Deasil_VC_FeatureList' ) ) {
    class Deasil_VC_FeatureList extends WPBakeryShortCode {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_feature_list_mapping' ) );
            add_shortcode( 'deasil_vc_feature_list', array( $this, 'deasil_vc_feature_list_html' ) );
        }
        
        // Element Mapping
        public function deasil_vc_feature_list_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }

            $primary_color = get_theme_mod('primary_color', '#558b2f');
            
            // Map the block with vc_map()
            vc_map( 
                array(
                    'name' => esc_html__('Deasil Feature List', 'deasil-core'),
                    'base' => 'deasil_vc_feature_list',
                    'description' => esc_html__('Add Feature List', 'deasil-core'), 
                    'admin_label' => true,
                    'category' => esc_html__('Deasil Elements', 'deasil-core'),   
                    'icon' => vc_inc_dir_url . '/assets/img/vc_feature_list.png',          
                    'params' => array(   
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Choose icon/image', 'deasil-core'),
                            'param_name'  => 'iconimage',
                            'admin_label' => true,
                            'value'       => array(
                                'Icon'    => 'icon',
                                'Image'     => 'img'
                            ),
                            'std'         => 'icon',
                        ),     
                        array(
                            'type'        => 'attach_image',
                            'heading'     => esc_html__('Add Image', 'deasil-core'),
                            'param_name'  => 'image',
                            'admin_label' => true,
                            'description' => esc_html__('Add transparent background PNG, for icon', 'deasil-core'),
                            'dependency' => array(
                                'element' => 'iconimage',
                                'value' => 'img'
                            )
                        ),    
                        array(
                            'type'        => 'textfield',
                            'heading'     => esc_html__('Image width in px', 'deasil-core'),
                            'param_name'  => 'width',
                            'value'       => '',
                            'std'         => '80',
                            'dependency' => array(
                                'element' => 'iconimage',
                                'value' => 'img'
                            )
                        ),        
                        array(
                          'type' => 'iconpicker',
                          'heading' => esc_html__('Select a Icon', 'deasil-core'),
                          'param_name' => 'deasilicon',
                          'value' => 'icon-tick',
                          'admin_label' => true,
                          'settings' => array(
                              'emptyIcon' => false,
                              'iconsPerPage' => 48,
                              'type' => 'deasilicon',
                          ),
                          'dependency' => array(
                            'element' => 'iconimage',
                            'value' => 'icon'
                        )
                        ), 
                        array(
                          'type' => 'colorpicker',
                          'heading'     => esc_html__('Icon Color', 'deasil-core'),
                          'param_name'  => 'iconcolor',
                          'value' => $primary_color, 
                        ), 
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Icon Type', 'deasil-core'),
                            'param_name'  => 'type',
                            'admin_label' => true,
                            'value'       => array(
                                'Diamond'    => 'diamond',
                                'Circle'     => 'circle',
                                'Square'     => 'square',
                                'Chat'     => 'chat'
                            ),
                            'std'         => 'center',
                            'dependency' => array(
                                'element' => 'iconimage',
                                'value' => 'icon'
                            ),
                             'group' => 'Style'
                        ),  
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Icon Style', 'deasil-core'),
                            'param_name'  => 'style',
                            'admin_label' => true,
                            'value'       => array(
                                'Solid'    => 'solid',
                                'Border'     => 'border',
                                'Line'     => 'line'
                            ),
                            'std'         => 'center',
                            'dependency' => array(
                                'element' => 'iconimage',
                                'value' => 'icon'
                            ),
                             'group' => 'Style'
                        ),  
                        array(
                            'type' => 'textfield',
                            'holder' => 'div',
                            'class' => 'vc-title',
                            'heading' => esc_html__( 'Title', 'deasil-core' ),
                            'param_name' => 'title',
                            'value' => esc_html__( 'List Title', 'deasil-core' ),
                            'admin_label' => false,
                        ),  
                        array(
                            'type' => 'textarea_html',
                            'holder' => 'div',
                            'class' => 'vc-desc',
                            'heading' => esc_html__( 'List Description', 'deasil-core' ),
                            'param_name' => 'content',
                            'value' => esc_html__( 'List Description', 'deasil-core' ),
                            'admin_label' => false,
                        ),  
                        array(
                          'type' => 'colorpicker',
                          'heading'     => esc_html__('Text Color', 'deasil-core'),
                          'param_name'  => 'color',
                          'value' => '#4b4b4b', 
                      ),        
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Align', 'deasil-core'),
                            'param_name'  => 'align',
                            'admin_label' => true,
                            'value'       => array(
                                'Center'    => 'center',
                                'Left'     => 'left'
                            ),
                            'std'         => 'center',
                            'group' => 'Style'
                        ),  
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Boxed', 'deasil-core'),
                            'param_name'  => 'boxed',
                            'admin_label' => true,
                            'value'       => array(
                                'Default'    => 'list',
                                'Boxed'     => 'box'
                            ),
                            'std'         => 'list',
                            'group' => 'Style',
                            'dependency' => array(
                                'element' => 'align',
                                'value' => 'center'
                            )
                        )

                    )
)
);                               
} 

        // Element HTML
public function deasil_vc_feature_list_html( $atts, $content = '' ) {

    $primary_color = get_theme_mod('primary_color', '#558b2f');
    // Params extraction
    extract(
        shortcode_atts(
            array(
                'title'     => 'List Title',
                'iconimage' => 'icon',
                'image'     => '',
                'width'     => '80',
                'deasilicon'=> 'icon-tick',
                'iconcolor' => '',
                'boxed'     => 'list',
                'type'      => 'square',
                'style'     => 'solid',
                'align'     => 'center',
                'color'     => '#4b4b4b'
            ), 
            $atts
        )
    );

    $imageurl = wp_get_attachment_image_url( $image, 'full', false );
    if($iconimage == 'icon'){
        $html = '<div class="feature-' . esc_attr($boxed) . ' ' . esc_attr($align) . '">
        <div class="feature-icon ' . esc_attr($type) . '-icon  ' . esc_attr($style) . '" style="background: ' . $iconcolor . '"><span class="' . esc_attr($deasilicon) . '"></span></div>
        <div class="desc" style="color: ' . esc_attr($color) . '">
        <h4>' . esc_html($title) . '</h4>'. wp_kses_post($content) . '</div></div>';
    }
    else{
        $html = '<div class="feature-' . esc_attr($boxed) . ' ' . esc_attr($align) .'">
        <img class="feature-img" src="' . esc_url($imageurl) . '" style="width: ' . esc_attr($width) . 'px">
        <div class="desc" style="color: ' . esc_attr($color) . '">
        <h4>' . esc_html($title) . '</h4>' . wp_kses_post($content).'</div></div>';
    }
    return $html;
} 

    } // End Element Class

    // Element Class Init
    new Deasil_VC_FeatureList();    
}
