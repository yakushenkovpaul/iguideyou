<?php
/*
Element Description: VC Steps
*/
if ( ! class_exists( 'Deasil_VC_StepsWrap' ) ) {
    //parent Class 
    class Deasil_VC_StepsWrap extends WPBakeryShortCodesContainer {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_steps_wrap_mapping' ) );
            add_shortcode( 'deasil_vc_steps_wrap', array( $this, 'deasil_vc_steps_wrap_html' ) );
        }
        
        // Element Mapping
        public function deasil_vc_steps_wrap_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }

            $rand_id = 'anima-' . substr(md5(uniqid(rand(), true)), 0, 5);
            
            // Map the block with vc_map()
            vc_map( 
                array(
                    'name' => esc_html__('Deasil Steps', 'deasil-core'),
                    'base' => 'deasil_vc_steps_wrap',
                    'as_parent' => array('only' => 'deasil_vc_steps'), /*Use only|except attributes to limit child shortcodes (separate multiple values with comma)*/
                    'content_element' => true,
                    'show_settings_on_create' => true,
                    'is_container' => true,
                    'description' => esc_html__('Add Deasil Steps', 'deasil-core'), 
                    'category' => esc_html__('Deasil Elements', 'deasil-core'),   
                    'icon' => vc_inc_dir_url . '/assets/img/vc_steps.png',
                    'admin_label' => false,
                    "js_view" => 'VcColumnView',
                    'params' => array(   
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Type', 'deasil-core'),
                            'param_name'  => 'type',
                            'admin_label' => true,
                            'value'       => array(
                                'Primary'    => 'primary',
                                'Base'       => 'base',
                                'Gray'       => 'gray'
                            ),
                            'std'         => 'primary',
                        ),      
                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Column', 'deasil-core'),
                            'param_name'  => 'column',
                            'admin_label' => true,
                            'value'       => array(
                                'Three'   => '3',
                                'Four'    => '4',
                                'Five'    => '5',
                                'Six'     => '6',
                            ),
                            'std'         => '4',
                        ),   
                        array(
                            'type' => 'hidden',
                            'holder' => '',
                            'class' => 'title-class',
                            'heading' => esc_html__( 'Unique CSS ID', 'deasil-core' ),
                            'param_name' => 'animation_id',
                            'description' => esc_html__( 'CSS ID', 'deasil-core' ),
                            'std'    => $rand_id,
                        )
                    )
                )
            );                            
        } 


        // Element HTML
        public function deasil_vc_steps_wrap_html( $atts, $content = null) {

            // Params extraction
            extract(
                shortcode_atts(
                    array(
                        'type'   => 'primary',
                        'col'   => '4',
                        'animation_id' => ''
                    ), 
                    $atts
                )
            );

            $html  = '<div class="steps steps-' . esc_attr($col) . ' ' . esc_attr($type) . '" id="' . esc_attr($animation_id) . '">' . do_shortcode(wp_kses_post($content)) . '</div>';      
            $html .= '<script>
            (function($){
                $(document).ready(function(){
                    $("#' . esc_attr($animation_id) . ' .step-module").waypoint(function() {
                        }, {
                            offset: "75%"
                            });
                            });
                            })(jQuery);
                            </script>
                            ';   
                            return $html;
                        } 

    } // End Element Class

    new Deasil_VC_StepsWrap();  
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Deasil_Vc_Steps_Wrap extends WPBakeryShortCodesContainer {
    }
}



if ( ! class_exists( 'Deasil_VC_Steps' ) ) {
    // Child Class 
    class Deasil_VC_Steps extends WPBakeryShortCode {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_steps_mapping' ) );
            add_shortcode( 'deasil_vc_steps', array( $this, 'deasil_vc_steps_html' ) );
        }
        
        // Element Mapping
        public function deasil_vc_steps_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }
            
            // Map the block with vc_map()
            vc_map( 
                array(
                    'name' => esc_html__('Steps', 'deasil-core'),
                    'base' => 'deasil_vc_steps',
                    'as_child' => array('only' => 'deasil_vc_steps_wrap'), /*Use only|except attributes to limit child shortcodes (separate multiple values with comma)*/
                    'content_element' => true,
                    'description' => esc_html__('Add Steps', 'deasil-core'), 
                    'category' => esc_html__('Deasil Elements', 'deasil-core'),   
                    'icon' => vc_inc_dir_url . '/assets/img/vc_dot.png',            
                    'params' => array(      
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
                            )
                        ), 
                        array(
                            'type' => 'textarea_html',
                            'holder' => 'p',
                            'class' => 'vc-title',
                            'heading' => esc_html__( 'Text', 'deasil-core' ),
                            'param_name' => 'content',
                            'admin_label' => false,
                        ),  
                        array(
                            'type' => 'animation_style',
                            'heading' => __( 'Animation Style', 'deasil-core' ),
                            'param_name' => 'animation',
                            'description' => __( 'Choose your animation style', 'deasil-core' ),
                            'admin_label' => false,
                            'weight' => 0
                        )                 
                    )
                )
            );                               

        } 


        // Element HTML
        public function deasil_vc_steps_html( $atts, $content = '' ) {

            // Params extraction
            extract(
                shortcode_atts(
                    array(
                        'deasilicon'    => 'icon-tick',
                        'animation'     => 'fadeIn',
                    ), 
                    $atts
                )
            );
            // Build the animation classes
            if($animation == 'none'){
                $animation_classes = $this->getCSSAnimation('fadeIn');
            }
            else{
                $animation_classes = $this->getCSSAnimation( $animation );
            }
            

            $html = '<div class="step-module' . $animation_classes . '">
            <div class="index"><span class="' . esc_attr($deasilicon) . '"></span></div>
            <div class="label-text">' . wp_kses_post($content) . '</div>
            </div>';
            return $html;
        } 
        
    } // End Element Class

    // Element Class Init
    new Deasil_VC_Steps();   
} 

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Deasil_Vc_Steps extends WPBakeryShortCode {
    }
}