<?php
/*
Element Description: VC Infobox
*/
if ( ! class_exists( 'Deasil_VC_Infobox' ) ) {
    class Deasil_VC_Infobox extends WPBakeryShortCodesContainer {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_infobox_mapping' ) );
            add_shortcode( 'deasil_vc_infobox', array( $this, 'deasil_vc_infobox_html' ) );
        }
        
        // Element Mapping
        public function deasil_vc_infobox_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }
            
            // Map the block with vc_map()
            vc_map( 
                array(
                    'name' => esc_html__('Deasil Infobox', 'deasil-core'),
                    'base' => 'deasil_vc_infobox',

                    'as_parent' => array('except' => 'deasil_vc_infobox'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                    'content_element' => true,
                    'show_settings_on_create' => true,
                    'is_container' => true,

                    'description' => esc_html__('Add Deasil Infobox', 'deasil-core'), 
                    'category' => esc_html__('Deasil Elements', 'deasil-core'),   
                    'icon' => vc_inc_dir_url . '/assets/img/vc_infobox.png',
                    'admin_label' => true,
                    "js_view" => 'VcColumnView',
                    'params' => array(   

                        array(
                            'type' => 'textfield',
                            'holder' => '',
                            'class' => 'title-class',
                            'heading' => esc_html__( 'Title', 'deasil-core' ),
                            'param_name' => 'title',
                            'value' => esc_html__( 'Infobox Title', 'deasil-core' ),
                            'description' => esc_html__( 'Box Title', 'deasil-core' ),
                            'admin_label' => true,
                            'weight' => 0,
                        ),
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => esc_html__('Background Color', 'deasil-core'),
                            'param_name'  => 'type',
                            'admin_label' => true,
                            "value"       => '#FFFFFF'
                        ),     
                        array(
                            'type'        => 'colorpicker',
                            'heading'     => esc_html__('Text Color', 'deasil-core'),
                            'param_name'  => 'color',
                            'admin_label' => true,
                            "value"       => '#4b4b4b'
                        ),  
                         array(
                            'type' => 'textfield',
                            'holder' => '',
                            'heading' => esc_html__( 'CSS Class', 'deasil-core' ),
                            'param_name' => 'cssclass',
                            'value' => '',
                        ),                 

                    )
                )
            );                            
            
        } 
        
        
        // Element HTML
        public function deasil_vc_infobox_html( $atts, $content = null) {

            // Params extraction
            extract(
                shortcode_atts(
                    array(
                        'title'    => 'Title',
                        'type'     => '#FFFFFF',
                        'color'    => '#4b4b4b',
                        'cssclass' => '',
                    ), 
                    $atts
                )
            );

            // Fill $html var with data
            $html = '<div class="border-box ' . esc_attr($cssclass) . '"" style="background: ' . esc_attr($type) . '; color:  ' . esc_attr($color) . '">
            <div class="box-title">' . esc_html($title) . '</div>
            ' . do_shortcode(wp_kses_post($content)) . '
            </div>';      
            return $html;

        } 

    } // End Element Class

    // Element Class Init
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Deasil_Vc_Infobox extends WPBakeryShortCodesContainer {
        }
    }

    new Deasil_VC_Infobox();
}    