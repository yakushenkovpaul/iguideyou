<?php
/*
Element Description: VC Extra Deasil icons
*/

if ( ! class_exists( 'Deasil_VC_Icons' ) ) {
    class Deasil_VC_Icons extends WPBakeryShortCode {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_iconfont_mapping' ) );
            add_shortcode( 'deasil_vc_iconfont', array( $this, 'deasil_vc_iconfont_html' ) );
        }

        // Element Mapping
        public function deasil_vc_iconfont_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }

            // Map the block with vc_map()
            vc_map( 
                array(
                    'name' => esc_html__('Deasil Icon Font', 'deasil-core'),
                    'base' => 'deasil_vc_iconfont',
                    'description' => esc_html__('Add Deasil Icons', 'deasil-core'), 
                    'admin_label' => true,
                    'category' => esc_html__('Deasil Elements', 'deasil-core'),   
                    'icon' => vc_inc_dir_url . '/assets/img/vc_icon.png',          
                    'params' => array(   
                                    array(
                                        'type' => 'iconpicker',
                                        'heading' => esc_html__('Select a Icon', 'deasil-core'),
                                        'param_name' => 'deasilicon',
                                        'value' => 'icon-balloon',
                                        'admin_label' => true,
                                        'settings' => array(
                                                        'emptyIcon' => false,
                                                        'iconsPerPage' => 48,
                                                        'type' => 'deasilicon',
                                                        )
                                        ) ,      
                                    array(
                                        'type'        => 'dropdown',
                                        'heading'     => esc_html__('Size', 'deasil-core'),
                                        'param_name'  => 'size',
                                        'admin_label' => true,
                                        'value'       => array(
                                                            '16'    => '16',
                                                            '20'    => '20',
                                                            '24'    => '24',
                                                            '32'    => '32',
                                                            '48'    => '48',
                                                            '64'    => '64',
                                                            '128'    => '128',
                                                            ),
                                        'std'         => '32',
                                        ),        
                                    array(
                                        'type'        => 'dropdown',
                                        'heading'     => esc_html__('Color', 'deasil-core'),
                                        'param_name'  => 'color',
                                        'admin_label' => true,
                                        'value'       => array(
                                                            'Base'      => 'base',
                                                            'Primary'   => 'primary',
                                                            'Success'   => 'success',
                                                            'Danger'    => 'danger',
                                                            'Info'      => 'info',
                                                            'Warning'   => 'warning',
                                                            'Color Picker' => 'colorpicker'
                                                            ),
                                        'std'         => 'primary',
                                        ),    
                                    array(
                                        'type'        => 'colorpicker',
                                        'heading'     => esc_html__('Choose Color', 'deasil-core'),
                                        'param_name'  => 'colorchoose',
                                        'admin_label' => true,
                                        'value'       => '',
                                        'dependency' => array(
                                                            'element' => 'color',
                                                            'value' => 'colorpicker'
                                                            )
                                        ),  
                                    array(
                                        'type' => 'textfield',
                                        'holder' => '',
                                        'class' => 'title-class',
                                        'heading' => esc_html__( 'Link/Anchor', 'deasil-core' ),
                                        'param_name' => 'link',
                                        'value' => '',
                                        'description' => esc_html__( 'Keep empty if link is not needed', 'deasil-core' ),
                                        'admin_label' => true,
                                        )  
                                )
                )
            );                               

        } 

        // Element HTML
        public function deasil_vc_iconfont_html( $atts ) {
            // Params extraction
            extract(
                shortcode_atts(
                    array(
                        'deasilicon'   => 'icon-balloon',
                        'size'       => '32',
                        'color'       => 'primary',
                        'colorchoose' => '',
                        'link' => ''
                        ), $atts)
            );

            // Fill $html var with data
            if($link != ''){
                $html = '<a href="' . esc_url($link) . '"><i class="icon-' . esc_attr($color) . ' icon-' . esc_attr($size) . ' ' . esc_attr($deasilicon) . ' " style="color: ' . esc_attr($colorchoose) . '"></i></a>';      
            }
            else{
                $html = '<i class="icon-' . esc_attr($color) . ' icon-' . esc_attr($size) . ' ' . esc_attr($deasilicon) . ' " style="color: '. esc_attr($colorchoose) .'"></i>';      
            }
            return $html;
        } 

    } // End Element Class

    // Element Class Init
    new Deasil_VC_Icons();    
}
