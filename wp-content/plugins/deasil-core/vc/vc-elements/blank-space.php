<?php
/*
Element Description: VC Deasil Blank Space
*/

if ( ! class_exists( 'Deasil_VC_BlankSpace' ) ) {
    class Deasil_VC_BlankSpace extends WPBakeryShortCode {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_blank_space_mapping' ) );
            add_shortcode( 'deasil_vc_blank_space', array( $this, 'deasil_vc_blank_space_html' ) );
        }
        
        // Element Mapping
        public function deasil_vc_blank_space_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }
            
            // Map the block with vc_map()
            vc_map( 
                array(
                    'name' => esc_html__('Deasil Blank Space', 'deasil-core'),
                    'base' => 'deasil_vc_blank_space',
                    'description' => esc_html__('Add Blank horizontal space', 'deasil-core'), 
                    'category' => esc_html__('Deasil Elements', 'deasil-core'),   
                    'icon' => vc_inc_dir_url . '/assets/img/vc_blank_space.png',            
                    'params' => array(   
                                    array(
                                        'type'        => 'dropdown',
                                        'heading'     => esc_html__('Space Height', 'deasil-core'),
                                        'param_name'  => 'blank_height',
                                        'admin_label' => true,
                                        'value'       => array(
                                            '15'      => '15',
                                            '30'      => '30',
                                            '60'      => '60',
                                            '90'      => '90',
                                            '120'      => '120'
                                            ),
                                        'std'         => '120',
                                        'description' => esc_html__('Set height of blank space', 'deasil-core'),
                                        )          
                                    )
                )
            );                               
            
        } 
        
        
        // Element HTML
        public function deasil_vc_blank_space_html( $atts ) {

            // Params extraction
            extract(
                shortcode_atts(
                    array(
                        'blank_height'   => '120',
                        ), 
                    $atts
                    )
                );
            
            // Fill $html var with data
            $html = '
            <div class="clearfix" style="height: ' . esc_attr($blank_height) . 'px"></div>
            ';      
            return $html;
        } 
        
    } // End Element Class

    // Element Class Init
    new Deasil_VC_BlankSpace();   
} 