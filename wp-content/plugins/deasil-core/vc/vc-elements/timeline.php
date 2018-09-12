<?php
/*
Element Description: VC Timeline
*/

if ( ! class_exists( 'Deasil_VC_TimelineWrap' ) ) {
    //parent Class 
    class Deasil_VC_TimelineWrap extends WPBakeryShortCodesContainer {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_timeline_wrap_mapping' ) );
            add_shortcode( 'deasil_vc_timeline_wrap', array( $this, 'deasil_vc_timeline_wrap_html' ) );
        }
        
        // Element Mapping
        public function deasil_vc_timeline_wrap_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }
            
            $rand_id = 'anima-' . substr(md5(uniqid(rand(), true)), 0, 5);

            // Map the block with vc_map()
            vc_map( 
                array(
                    'name' => esc_html__('Deasil Timeline', 'deasil-core'),
                    'base' => 'deasil_vc_timeline_wrap',
                    'as_parent' => array('only' => 'deasil_vc_timeline'), /*Use only|except attributes to limit child shortcodes (separate multiple values with comma)*/
                    "content_element" => true,
                    "show_settings_on_create" => true,
                    "is_container" => true,
                    'description' => esc_html__('Add Deasil Timeline', 'deasil-core'), 
                    'category' => esc_html__('Deasil Elements', 'deasil-core'),   
                    'icon' => vc_inc_dir_url . '/assets/img/vc_timeline.png',
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
                            'heading'     => esc_html__('Text Position', 'deasil-core'),
                            'param_name'  => 'text_align',
                            'admin_label' => true,
                            'value'       => array(
                                'Right to Icon'    => 'right',
                                'Left to Icon'       => 'left',
                                'Alternate'       => 'alternate'
                            ),
                            'std'         => 'alternate',
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
public function deasil_vc_timeline_wrap_html( $atts, $content = null) {

             // Params extraction
    extract(
        shortcode_atts(
            array(
                'type'   => 'primary',
                'text_align' => 'alternate',
                'animation_id' => ''
            ), 
            $atts
        )
    );

    $html  = '<div class="timeline tl-' . esc_attr($text_align) . ' ' . esc_attr($type) . '" id="' . esc_attr($animation_id) . '">' . do_shortcode(wp_kses_post($content)) . '</div>';  
    $html .= '<script>
    (function($){
        $(document).ready(function(){
            $("#' . esc_attr($animation_id) . ' .time-module").waypoint(function() {
            }, {
                offset: "75%"
            });
        });
    })(jQuery);
    </script>';       
    return $html;
} 

    } // End Element Class

    new Deasil_VC_TimelineWrap();   

}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Deasil_Vc_Timeline_Wrap extends WPBakeryShortCodesContainer {
    }
}



if ( ! class_exists( 'Deasil_VC_Timeline' ) ) {
    // Child Class 
    class Deasil_VC_Timeline extends WPBakeryShortCode {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_timeline_mapping' ) );
            add_shortcode( 'deasil_vc_timeline', array( $this, 'deasil_vc_timeline_html' ) );
        }
        
        // Element Mapping
        public function deasil_vc_timeline_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }
            
            // Map the block with vc_map()
            vc_map( 
                array(
                    'name' => esc_html__('Timeline', 'deasil-core'),
                    'base' => 'deasil_vc_timeline',
                    'as_child' => array('only' => 'deasil_vc_timeline_wrap'), /*Use only|except attributes to limit child shortcodes (separate multiple values with comma)*/
                    'content_element' => true,
                    'description' => esc_html__('Add Timeline', 'deasil-core'), 
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
                            'type' => 'textarea',
                            'holder' => 'p',
                            'class' => 'vc-title',
                            'heading' => esc_html__( 'Timeline Text', 'deasil-core' ),
                            'param_name' => 'text',
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
        public function deasil_vc_timeline_html( $atts ) {

            // Params extraction
            extract(
                shortcode_atts(
                    array(
                        'deasilicon'    =>'icon-tick',
                        'text'          => '',
                        'animation'     => 'fadeIn'
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

            $html  = '<div class="time-module ' . $animation_classes . ' ">
            <div class="index">
            <span class="' . esc_attr($deasilicon) . '"></span>';
            if($text != ''){
                $html .= '<div class="time-pop">' . esc_attr($text) . '</div>';   
            }    
            $html .= '</div></div>';
            return $html;
        } 

    } // End Element Class

    // Element Class Init
    new Deasil_VC_Timeline();    

}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Deasil_Vc_Timeline extends WPBakeryShortCode {
    }
}