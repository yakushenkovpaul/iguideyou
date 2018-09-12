<?php
/*
Element Description: VC Testimonials
*/

if ( ! class_exists( 'Deasil_VC_TestimonialWrap' ) ) {
    //parent Class 
    class Deasil_VC_TestimonialWrap extends WPBakeryShortCodesContainer {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_testimonial_wrap_mapping' ) );
            add_shortcode( 'deasil_vc_testimonial_wrap', array( $this, 'deasil_vc_testimonial_wrap_html' ) );
        }
        
        // Element Mapping
        public function deasil_vc_testimonial_wrap_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }
            
            // Map the block with vc_map()
            vc_map( 
                array(
                    'name' => esc_html__('Deasil Testimonial', 'deasil-core'),
                    'base' => 'deasil_vc_testimonial_wrap',
                    'as_parent' => array('only' => 'deasil_vc_testimonial'), /*Use only|except attributes to limit child shortcodes (separate multiple values with comma)*/
                    'content_element' => true,
                    'show_settings_on_create' => true,
                    'is_container' => true,
                    'description' => esc_html__('Add Deasil Testimonial', 'deasil-core'), 
                    'category' => esc_html__('Deasil Elements', 'deasil-core'),   
                    'icon' => vc_inc_dir_url . '/assets/img/vc_testimonial_wrap.png',
                    'admin_label' => false,
                    "js_view" => 'VcColumnView',
                    'params' => array(   
                                    array(
                                        'type'        => 'dropdown',
                                        'heading'     => esc_html__('Type', 'deasil-core'),
                                        'param_name'  => 'type',
                                        'admin_label' => true,
                                        'value'       => array(
                                                        'Carousel'      => 'carousel',
                                                        'Simple Box'    => 'boxed',
                                                        )
                                        ),    
                                    array(
                                        'type'        => 'dropdown',
                                        'heading'     => esc_html__('Column', 'deasil-core'),
                                        'param_name'  => 'col',
                                        'admin_label' => true,
                                        'value'       => array(
                                            'One'       => '1',
                                            'Two'       => '2',
                                            'Three'     => '3',
                                            'Four'      => '4'
                                            ),
                                        "dependency" => array(
                                            "element" => "type",
                                            "value" => "boxed"
                                            )
                                        ),       
                                    array(
                                        'type'        => 'dropdown',
                                        'heading'     => esc_html__('Style', 'deasil-core'),
                                        'param_name'  => 'style',
                                        'admin_label' => true,
                                        'value'       => array(
                                            'Default'       => '',
                                            'Primary'    => 'primary',
                                            'Base'       => 'base',
                                            'Gray'       => 'gray',
                                            'Bacground Image'   => 'bg-image',
                                            )
                                        ),      
                                    array(
                                        'type'        => 'attach_image',
                                        'holder' => 'div',
                                        'class' => 'vc-hide',
                                        'heading'     => esc_html__('Background Image', 'deasil-core'),
                                        'param_name'  => 'image',
                                        'admin_label' => true,
                                        'description' => esc_html__('Add Background Image', 'deasil-core'),
                                        "dependency" => array(
                                            "element" => "style",
                                            "value" => "bg-image"
                                            )
                                        )  
                                )
                )
            );                                    
        } 
        
        
        // Element HTML
        public function deasil_vc_testimonial_wrap_html( $atts, $content = null) {

            // Params extraction
            extract(
                shortcode_atts(
                    array(
                        'type'    => 'carousel',
                        'col'     => '',
                        'image'   => '',
                        'style'   => ''
                        ), 
                    $atts
                    )
                );
            $imageSrc = wp_get_attachment_image_src( $attachment_id = $image, 'full' ); 
            if($type == 'carousel') {
                if($style == 'bg-image') {
                    $html  = '<div class="testimonial-wrap ' . esc_attr($style) . '" style="background-image: url(\'' . esc_url($imageSrc[0]) . '\')">
                                <div class="container">
                                    <div class="testimonial">
                                        ' . do_shortcode(wp_kses_post($content)) . '
                                    </div>
                                </div>
                            </div>';      
                }
                else {
                    $html   = '<div class="testimonial-wrap ' . esc_attr($style) . '">
                                <div class="container">
                                    <div class="testimonial">
                                        ' . do_shortcode(wp_kses_post($content)) . '
                                    </div>
                                </div>
                            </div>';      
                }

                $html .= '<script>
                            (function($){
                                $(document).ready(function(){
                                    var testimonial = $(".testimonial");
                                    if($(".testimonial .testimonial-item").length > 1){
                                        testimonial.owlCarousel({
                                            animateOut: \'fadeOut\',
                                            autoplay: true,
                                            items:1,
                                            margin:30,
                                            loop:true,
                                            dots:false,
                                            nav:true,
                                            navText: [\'<span class="icon-arrow-left"><span>\',\'<span class="icon-arrow-right"><span>\'],
                                            stagePadding:0
                                        });
                                    }
                                });
                            })(jQuery);
                        </script>'; 
            }
            else{
                if($style == 'bg-image') {
                    $html = '
                    <div class="testimonial-wrap testimonial-boxed ' . esc_attr($style) .' col-' . esc_attr($col) . '"  style="background-image: url(\'' . esc_url($imageSrc[0]) . '\')" >
                        <div class="container">
                            <div class="testimonial">
                                ' . do_shortcode(wp_kses_post($content)) . '
                            </div>
                        </div>
                    </div>';  
                }
                else {
                    $html = '
                    <div class="testimonial-wrap testimonial-boxed ' . esc_attr($style) .' col-' . esc_attr($col) . '">
                        <div class="container">
                            <div class="testimonial">
                                ' . do_shortcode(wp_kses_post($content)) . '
                            </div>
                        </div>
                    </div>';  
                }
            }
            return $html;
        } 

    } // End Element Class


    new Deasil_VC_TestimonialWrap();   
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Deasil_Vc_Testimonial_Wrap extends WPBakeryShortCodesContainer {
    }
}



if ( ! class_exists( 'Deasil_VC_Testimonial' ) ) {
    // Child Class 
    class Deasil_VC_Testimonial extends WPBakeryShortCode {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_testimonial_mapping' ) );
            add_shortcode( 'deasil_vc_testimonial', array( $this, 'deasil_vc_testimonial_html' ) );
        }
        
        // Element Mapping
        public function deasil_vc_testimonial_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }
            
        // Map the block with vc_map()
            vc_map( 

                array(
                    'name' => esc_html__('Testimonial', 'deasil-core'),
                    'base' => 'deasil_vc_testimonial',

                    'as_child' => array('only' => 'deasil_vc_testimonial_wrap'), /*Use only|except attributes to limit child shortcodes (separate multiple values with comma)*/
                    'content_element' => true,

                    'description' => esc_html__('Add Testimonial', 'deasil-core'), 
                    'category' => esc_html__('Deasil Elements', 'deasil-core'),   
                    'icon' => vc_inc_dir_url . '/assets/img/vc_testimonial.png',            
                    'params' => array(   

                        array(
                            'type'        => 'attach_image',
                            'holder' => 'div',
                            'class' => 'vc-hide',
                            'heading'     => esc_html__('Avatar Image', 'deasil-core'),
                            'param_name'  => 'avatar',
                            'admin_label' => true,
                            'description' => esc_html__('Add Avatar Image preferable square', 'deasil-core'),
                            ),      

                        array(
                            'type' => 'textfield',
                            'holder' => 'p',
                            'class' => 'vc-title',
                            'heading' => esc_html__( 'Full Name', 'deasil-core' ),
                            'param_name' => 'name',
                            'description' => esc_html__( '', 'deasil-core' ),
                            'admin_label' => false,
                            ),  

                        array(
                            'type' => 'textfield',
                            'holder' => 'p',
                            'class' => 'vc-title',
                            'heading' => esc_html__( 'Address', 'deasil-core' ),
                            'param_name' => 'address',
                            'description' => esc_html__( '', 'deasil-core' ),
                            'admin_label' => false,
                            ),  


                        array(
                            'type'        => 'dropdown',
                            'heading'     => esc_html__('Rate', 'deasil-core'),
                            'param_name'  => 'rate',
                            'admin_label' => true,
                            'value'       => array(
                                '1'      => '1',
                                '2'      => '2',
                                '3'      => '3',
                                '4'      => '4',
                                '5'      => '5'
                                ),
                            'std'         => '5',
                            'description' => esc_html__('Rate one to five', 'deasil-core'),
                            ),        

                        array(
                            'type' => 'textarea_html',
                            'holder' => 'p',
                            'class' => 'vc-title',
                            'heading' => esc_html__( 'Blockquote', 'deasil-core' ),
                            'param_name' => 'content',
                            'description' => esc_html__( '', 'deasil-core' ),
                            'admin_label' => false,
                            ),                                    
                        )
                    )
                );                               

        } 


        // Element HTML
        public function deasil_vc_testimonial_html( $atts, $content = '' ) {

            // Params extraction
            extract(
                shortcode_atts(
                    array(
                        'avatar'    =>'',
                        'name'   => '',
                        'address'     => '',
                        'rate'  => '5',
                        ), 
                    $atts
                    )
                );

            // Fill $html var with data
            $imageSrc = wp_get_attachment_image_src( $attachment_id = $avatar, 'full' ); 
            $html = '<div class="testimonial-item">
                        <div>
                            <div class="avatar" style="background-image: url(' . esc_url($imageSrc[0]) . ');">
                            </div>
                            <div class="name">' . esc_html($name) . '</div>
                            <div>'. esc_html($address) . '</div>
                            <div class="rating ' . esc_attr($rate) . '">';
                                for($i=0; $i < $rate; $i++){
                                    $html .=  '<span class="icon-star"></span>';
                                }
                                for($i=0; $i<(5-$rate); $i++){
                                    $html .=  '<span class="icon-star-empty"></span>';
                                }
                                $html .='</div>
                                <div>' . wp_kses_post($content) . '</div>
                            </div>
                        </div>';     
            return $html;
        } 

    } 
    // End Element Class

    // Element Class Init
    new Deasil_VC_Testimonial();   
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Deasil_Vc_Testimonial extends WPBakeryShortCode {
    }
}