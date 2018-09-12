<?php
/*
Element Description: VC Banner
*/
if ( ! class_exists( 'Deasil_VC_Banner' ) ) {
    class Deasil_VC_Banner extends WPBakeryShortCodesContainer {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_banner_mapping' ) );
            add_shortcode( 'deasil_vc_banner', array( $this, 'deasil_vc_banner_html' ) );
        }
        
        // Element Mapping
        public function deasil_vc_banner_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }

            $primary_color = get_theme_mod('primary_color', '#558b2f');
            $base_color = get_theme_mod('base_color', '#111111');
            
            // Map the block with vc_map()
            vc_map( 
                array(
                    'name' => esc_html__('Deasil Banner', 'deasil-core'),
                    'base' => 'deasil_vc_banner',

                    'as_parent' => array('except' => 'deasil_vc_banner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                    'content_element' => true,
                    'show_settings_on_create' => true,
                    'is_container' => true,

                    'description' => esc_html__('Add Deasil Banner', 'deasil-core'), 
                    'category' => esc_html__('Deasil Elements', 'deasil-core'),   
                    'icon' => vc_inc_dir_url . '/assets/img/vc_banner.png',
                    'admin_label' => true,
                    "js_view" => 'VcColumnView',
                    'params' => array(   

                        array(
                            'type' => 'textfield',
                            'holder' => '',
                            'class' => 'title-class',
                            'heading' => esc_html__( 'Title', 'deasil-core' ),
                            'param_name' => 'title',
                            'value' => esc_html__( 'Banner Title', 'deasil-core' ),
                            'description' => esc_html__( 'Keep blank if not needed', 'deasil-core' ),
                            'admin_label' => true,
                            'weight' => 0,
                        ),
                        array(
                          'type' => 'colorpicker',
                          'heading'     => esc_html__('Background Color', 'deasil-core'),
                          'param_name'  => 'bgcolor',
                          'value' => $base_color, 
                        ), 
                        array(
                          'type' => 'colorpicker',
                          'heading'     => esc_html__('Border Color', 'deasil-core'),
                          'param_name'  => 'bordercolor',
                          'value' => $primary_color, 
                        ), 
                        array(
                          'type' => 'colorpicker',
                          'heading'     => esc_html__('Text Color', 'deasil-core'),
                          'param_name'  => 'textcolor',
                          'value' => '#ffffff', 
                        )                
                    )
                )
            );                            
            
        } 
        
        
        // Element HTML
        public function deasil_vc_banner_html( $atts, $content = null) {

            $primary_color = get_theme_mod('primary_color', '#558b2f');
            $base_color = get_theme_mod('base_color', '#111111');
            // Params extraction
            extract(
                shortcode_atts(
                    array(
                        'title'         =>  'banner Title',
                        'bgcolor'       =>  $base_color,
                        'bordercolor'   =>  $primary_color,
                        'textcolor'     =>  '#ffffff',
                        'type'          =>  'base'
                    ), 
                    $atts
                )
            );

            // Fill $html var with data
            $html = '<div class="banner ' . esc_attr($type) . '" style="background: ' . $bgcolor . '; color: ' . $textcolor . ' ">
            <div class="line-box" style="border-color: ' . $bordercolor . ' ">
            <div class="line-title" style="background: ' . $bgcolor . '">' . esc_html($title) . '</div>
            ' . do_shortcode(wp_kses_post($content)) . '</div>
            </div>';      
            return $html;

        } 

    } // End Element Class

    // Element Class Init
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Deasil_Vc_Banner extends WPBakeryShortCodesContainer {
        }
    }

    new Deasil_VC_Banner();
}    