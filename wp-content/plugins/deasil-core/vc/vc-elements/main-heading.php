<?php
/*
Element Description: VC Deasil Heading
*/

if ( ! class_exists( 'Deasil_VC_MainHeading' ) ) {
    class Deasil_VC_MainHeading extends WPBakeryShortCode {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_main_heading_mapping' ) );
            add_shortcode( 'deasil_vc_main_heading', array( $this, 'deasil_vc_main_heading_html' ) );
        }
        
        // Element Mapping
        public function deasil_vc_main_heading_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }
            
            // Map the block with vc_map()
            vc_map( 
                array(
                    'name' => esc_html__('Deasil Heading', 'deasil-core'),
                    'base' => 'deasil_vc_main_heading',
                    'description' => esc_html__('Add Section Heading', 'deasil-core'), 
                    'category' => esc_html__('Deasil Elements', 'deasil-core'),   
                    'icon' => vc_inc_dir_url . '/assets/img/vc_main_heading.png',            
                    'params' => array(   
                                    array(
                                        'type' => 'textfield',
                                        'holder' => 'div',
                                        'class' => 'vc-title',
                                        'heading' => esc_html__( 'Title', 'deasil-core' ),
                                        'param_name' => 'title',
                                        'value' => esc_html__( 'Heading & Titles', 'deasil-core' ),
                                        'admin_label' => false,
                                        ),  
                                    array(
                                        'type' => 'textarea_html',
                                        'holder' => 'div',
                                        'class' => 'vc-desc',
                                        'heading' => esc_html__( 'Sub Title', 'deasil-core' ),
                                        'param_name' => 'content',
                                        'value' => esc_html__( 'Sub Heading', 'deasil-core' ),
                                        'admin_label' => false,
                                        ),  
                                    array(
                                        'type'        => 'dropdown',
                                        'heading'     => esc_html__('Align', 'deasil-core'),
                                        'param_name'  => 'align',
                                        'admin_label' => true,
                                        'value'       => array(
                                                            'Center'    => 'center',
                                                            'Left'     => 'left',
                                                            'Right'   => 'right'
                                                            ),
                                        'std'         => 'center',
                                        'description' => esc_html__('Available option: center, left, right', 'deasil-core'),
                                        ),      
                                    array(
                                        'type'        => 'dropdown',
                                        'heading'     => esc_html__('Text Color', 'deasil-core'),
                                        'param_name'  => 'color',
                                        'admin_label' => true,
                                        'value'       => array(
                                                            'Default'    => '',
                                                            'Primary'  => 'primary',
                                                            'Base'     => 'base',
                                                            'Gray'     => 'gray',
                                                            'White'    => 'white',
                                                            ),
                                        'description' => esc_html__('Available option: primary, base, gray, white', 'deasil-core'),
                                        )                      
                                )
                )
             );                               
            
        } 
        
        
        // Element HTML
        public function deasil_vc_main_heading_html( $atts, $content = '' ) {

         // Params extraction
            extract(
                shortcode_atts(
                    array(
                        'title'   => __('Heading & Titles', 'deasil-core'),
                        'align'  => 'center',
                        'color'  => '',
                        ), 
                    $atts
                    )
                );
            
        // Fill $html var with data
            $html = '<div class="main-title ' . esc_attr($align) . ' ' . esc_attr($color) . '">
                        <h1>' . esc_html($title) . '</h1>
                        <div>' . wp_kses_post($content) . '</div>
                    </div>';      
            
            return $html;
        } 
        
    } // End Element Class

    // Element Class Init
    new Deasil_VC_MainHeading();    
}