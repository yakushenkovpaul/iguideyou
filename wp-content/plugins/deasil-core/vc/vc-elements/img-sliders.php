<?php
/*
Element Description: VC Image Slider
*/

if ( ! class_exists( 'Deasil_VC_ImgSlider' ) ) {
    class Deasil_VC_ImgSlider extends WPBakeryShortCodesContainer {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_img_slider_mapping' ) );
            add_shortcode( 'deasil_vc_img_slider', array( $this, 'deasil_vc_img_slider_html' ) );
        }
        
        // Element Mapping
        public function deasil_vc_img_slider_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }
            
            // Map the block with vc_map()
            vc_map( 
                array(
                    'name' => esc_html__('Deasil Slider', 'deasil-core'),
                    'base' => 'deasil_vc_img_slider',

                    'as_parent' => array('except' => 'deasil_vc_img_slider'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
                    'content_element' => true,
                    'show_settings_on_create' => true,
                    'is_container' => true,

                    'description' => esc_html__('Add Deasil Slider', 'deasil-core'), 
                    'category' => esc_html__('Deasil Elements', 'deasil-core'),   
                    'icon' => vc_inc_dir_url . '/assets/img/vc_img_slider.png',
                    'admin_label' => true,
                    "js_view" => 'VcColumnView',
                    'params' => array(   
                        array(
                            'type'        => 'dropdown',
                            'class' => 'vc-title',
                            'heading'     => esc_html__('Carousel Text', 'deasil-core'),
                            'param_name'  => 'choose_title',
                            'admin_label' => true,
                            'value'       => array(
                               'Use Container'     => 'single',
                               'Use Caption From Image'    => 'caption'
                           ),
                            'std'         => 'single',
                            'description' => esc_html__('For Multiple Title, Please set proper image "Caption" &amp; "Description" from Media menu, ignores whatever container inside this container', 'deasil-core'),
                        ), 
                        array(
                            'type'        => 'dropdown',
                            'class' => 'vc-title',
                            'heading'     => esc_html__('Include Button', 'deasil-core'),
                            'param_name'  => 'hasbutton',
                            'admin_label' => true,
                            'value'       => array(
                                'True'    => 'true',
                                'False'     => 'false'
                            ),
                            'std'         => 'true',
                            'description' => esc_html__('Set true to show button', 'deasil-core'),
                            "dependency" => array(
                                "element" => "choose_title",
                                "value" => "caption"
                            )
                        ), 
                        array(
                            'type' => 'textfield',
                            'holder' => 'div',
                            'class' => 'vc-hide',
                            'heading' => esc_html__( 'Button Label', 'deasil-core' ),
                            'param_name' => 'button_label',
                            'value' => esc_html__( 'Explore', 'deasil-core' ),
                            'description' => esc_html__( 'Button Label', 'deasil-core' ),
                            'admin_label' => true,
                            "dependency" => array(
                                "element" => "hasbutton",
                                "value" => "true"
                            )
                        ),  
                        array(
                            'type' => 'textfield',
                            'holder' => 'div',
                            'class' => 'vc-hide',
                            'heading' => esc_html__( 'Button Url', 'deasil-core' ),
                            'param_name' => 'url',
                            'value' => '#',
                            'description' => esc_html__( 'Button Url', 'deasil-core' ),
                            'admin_label' => true,
                            "dependency" => array(
                                "element" => "hasbutton",
                                "value" => "true"
                            )
                        ),  
                        array(
                            'type'        => 'attach_images',
                            'holder' => 'div',
                            'class' => 'vc-hide',
                            'heading'     => esc_html__('Images', 'deasil-core'),
                            'param_name'  => 'images',
                            'admin_label' => true,
                            'description' => esc_html__('Add Images for Slider', 'deasil-core'),
                            /*'group' => 'Style'*/
                        ),
                         array(
                            'type' => 'checkbox',
                            'class' => '',
                            'heading' => esc_html__( 'Disable Auto Slide', 'deasil-core' ),
                            'param_name' => 'disautoslide'
                        ),
                         array(
                            'type' => 'textfield',
                            'holder' => 'div',
                            'class' => 'vc-hide',
                            'heading' => esc_html__( 'Slider Speed', 'deasil-core' ),
                            'param_name' => 'speed',
                            'value' => '',
                            'std'         => '5000',
                        ),  
                        array(
                            'type'        => 'dropdown',
                            'class' => 'vc-title',
                            'heading'     => esc_html__('Slider Overlay', 'deasil-core'),
                            'param_name'  => 'overlay',
                            'admin_label' => true,
                            'value'       => array(
                                'Overlay'     => 'with-overlay',
                                'Transparent'    => 'tran',
                                'Boxed'     => 'with-text-box'
                            ),
                            'std'         => 'with-overlay',
                            'group' => 'Style'
                        ),     
                        array(
                            'type'        => 'dropdown',
                            'class' => 'vc-title',
                            'heading'     => esc_html__('Slider Effect', 'deasil-core'),
                            'param_name'  => 'effect',
                            'admin_label' => true,
                            'value'       => array(
                                'Fade'    => 'carousel-fade',
                                'Slide'     => 'default'
                            ),
                            'std'         => 'carousel-fade',
                            'group' => 'Style'
                        ), 
                        array(
                            'type'        => 'dropdown',
                            'class' => 'vc-title',
                            'heading'     => esc_html__('CSS Animation', 'deasil-core'),
                            'param_name'  => 'animation',
                            'admin_label' => true,
                            'value'       => array(
                                'Zoom'     => 'zooming',
                                'None'    => 'none',
                            ),
                            'std'         => 'zooming',
                            'group' => 'Style'
                        ),  
                        array(
                            'type'        => 'dropdown',
                            'class' => 'vc-title',
                            'heading'     => esc_html__('Slider Height', 'deasil-core'),
                            'param_name'  => 'height',
                            'admin_label' => true,
                            'value'       => array(
                                'Default'    => 'default',
                                'Full Height'     => 'full-height'
                            ),
                            'std'         => 'full-height',
                            'group' => 'Style'
                        ),    
                        array(
                            'type'        => 'dropdown',
                            'class' => 'vc-title',
                            'heading'     => esc_html__('Slider Nav Control Position', 'deasil-core'),
                            'param_name'  => 'nav_pos',
                            'admin_label' => true,
                            'value'       => array(
                                'Default'    => 'default',
                                'Bottom'     => 'bottom',
                                'Bottom Right'     => 'bottom-right',
                                'Bottom Left'     => 'bottom-left',
                                'Hide'     => 'hide'
                            ),
                            'std'         => '',
                            'group' => 'Style'
                        ), 
                        array(
                            'type'        => 'dropdown',
                            'class' => 'vc-title',
                            'heading'     => esc_html__('Slider Indicator', 'deasil-core'),
                            'param_name'  => 'indicator',
                            'admin_label' => true,
                            'value'       => array(
                                'Default'    => 'default',
                                'Square'     => 'square',
                                'Dashed'     => 'dashed',
                                'Hide'     => 'hide'
                            ),
                            'std'         => 'default',
                            'group' => 'Style'
                        )     
                    )
)
);                            
} 


        // Element HTML
public function deasil_vc_img_slider_html( $atts, $content = null) {

             // Params extraction
    extract(
        shortcode_atts(
            array(
                'choose_title'  => 'single',
                'title'         => 'Deasil Discover',
                'hasbutton'     => 'true',
                'button_label'  => 'Explore',
                'url'           => '#',
                'images'        => 'primary',
                'disautoslide'  => '',
                'speed'         => '5000',
                'overlay'       => 'with-overlay',
                'effect'        => 'carousel-fade',
                'animation'     => 'zooming',
                'height'        => 'full-height',
                'nav_pos'       => '',
                'indicator'     => 'default'
            ), 
            $atts
        )
    );

            // Fill $html var with data
    $array_img = explode(',', $images);
    $countimg = 0;
    $numberimg = count($array_img);

    if($disautoslide == TRUE){
        $data_ride = 'false';    
    }
    else{
        $data_ride = 'carousel';    
    }
    


    $html = '<div class="main-img carousel slide ' . esc_attr($effect) . ' ' . esc_attr($height) . '" id="carousel" data-ride="' . $data_ride . '" data-interval="' . $speed . '" data-pause="null">';

    if($numberimg > 1){
        $html .= '<a class="left carousel-control ' . esc_attr($nav_pos) . '" href="#carousel" role="button" data-slide="prev">
        <span class="icon-arr-left" aria-hidden="true"></span>
        <span class="sr-only">' . esc_html__('Previous', 'deasil-core') . '</span></a>
        <a class="right carousel-control ' . esc_attr($nav_pos) . '" href="#carousel" role="button" data-slide="next">
        <span class="icon-arr-right" aria-hidden="true"></span>
        <span class="sr-only">' . esc_html__('Next', 'deasil-core') . '</span>
        </a>';
    }

    $html .= '<div class="carousel-inner" role="listbox">';
    foreach ($array_img as $value) {
        $imageSrc = wp_get_attachment_image_src( $attachment_id = $value, 'full' ); 
        $imageCaption = get_post($value );
        $itemClass = ($countimg == 0) ? 'active':'';
        $html .= '<div class="item ' . $animation . ' ' . esc_attr($overlay) . ' ' . esc_attr($itemClass) . '" style="background-image: url(\' ' . esc_url($imageSrc[0]) . ' \')">';

        if($choose_title == 'caption'){
            $html .= '<div class="carousel-caption center-txt"><div class="multi-caption">';
            $html .= '<h1 class="main-header">' . esc_html($imageCaption->post_excerpt) . '</h1><p class="sub-header">' . esc_html($imageCaption->post_content) . '</p>';
            if($hasbutton =='true'){
             $html .= '<br><a href="' . esc_url($url) . '" class="btn btn-lg btn-primary hvr-sweep-to-right">' . esc_html($button_label) . '</a>';
         }
         $html .= '</div></div>';
     }

     $html .= '</div>';
     $countimg++;
 }
 $html .= '</div>';

 if($choose_title == 'single'){
    $html .= '<div class="carousel-caption center-txt ' . esc_attr(($overlay == "with-text-box" ? "with-text-box" : "")) . '"><div class="container"><div class="carousel-content">' . do_shortcode(wp_kses_post($content));
    $html .= '</div></div></div>';
};

if($numberimg > 1){
 $html .='<ol class="carousel-indicators ' . esc_attr($indicator) . '">';
 $countind = 0;
 foreach ($array_img as $value) {
    if($countind == 0){
        $html .= '<li data-target="#carousel" data-slide-to="' . esc_attr($countind) . '" class="active"></li>';
    }
    else{
        $html .= ' <li data-target="#carousel" data-slide-to="' . esc_attr($countind) . '"></li>';
    }
    $countind++;
}
$html .='</ol>';
}
$html .='</div>';

return $html;
} 

    } // End Element Class

    // Element Class Init
    if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
        class WPBakeryShortCode_Deasil_Vc_Img_Slider extends WPBakeryShortCodesContainer {
        }
    }

    new Deasil_VC_ImgSlider();   
} 