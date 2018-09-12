<?php
/*
Element Description: VC Support Icons
*/

if ( ! class_exists( 'Deasil_VC_Supported_By' ) ) {
    class Deasil_VC_Supported_By extends WPBakeryShortCode {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_supported_by_mapping' ) );
            add_shortcode( 'deasil_vc_supported_by', array( $this, 'deasil_vc_supported_by_html' ) );
        }
        
        // Element Mapping
        public function deasil_vc_supported_by_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }

             $rand_id = 'support-' . substr(md5(uniqid(rand(), true)), 0, 5);
            
            // Map the block with vc_map()
            vc_map( 
                array(
                    'name' => esc_html__('Deasil Supported By', 'deasil-core'),
                    'base' => 'deasil_vc_supported_by',
                    'description' => esc_html__('Add Supported Logo', 'deasil-core'), 
                    'category' => esc_html__('Deasil Elements', 'deasil-core'),   
                    'icon' => vc_inc_dir_url . '/assets/img/vc_supported_by.png',            
                    'params' => array(   
                        array(
                            'type' => 'textfield',
                            'holder' => 'p',
                            'class' => 'vc-title',
                            'heading' => esc_html__( 'Title', 'deasil-core' ),
                            'param_name' => 'title',
                            'value' => esc_html__( 'Supported By', 'deasil-core' ),
                            'admin_label' => false,
                        ),    
                        array(
                            'type'        => 'attach_images',
                            'holder' => 'div',
                            'class' => 'vc-hide',
                            'heading'     => esc_html__('Logos', 'deasil-core'),
                            'param_name'  => 'logos',
                            'admin_label' => true,
                            'description' => esc_html__('Add Logo Images with height 40px', 'deasil-core'),
                        ),  
                        array(
                            'type' => 'textarea',
                            'holder' => 'p',
                            'class' => 'vc-desc',
                            'heading' => esc_html__( 'Url', 'deasil-core' ),
                            'param_name' => 'url',
                            'value' => esc_html__( '', 'deasil-core' ),
                            'description' => esc_html__( 'Add url to logo image seperated by comma in order', 'deasil-core' ),
                            'admin_label' => false,
                        ), 
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__( 'Number', 'deasil-core' ),
                            'param_name' => 'number',
                            'value'       => array(
                                '4'    => '4',
                                '5'    => '5',
                                '6'    => '6',
                                '7'    => '7',
                                '8'    => '8',
                            ),
                            'std'         => '5',
                            'description' => esc_html__('Number of Logos', 'deasil-core'),
                            'admin_label' => true,
                        ),      
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__( 'Carousel', 'deasil-core' ),
                            'param_name' => 'carousel',
                            'value'       => array(
                              'Enable'    => 'true',
                              'Disable'     => 'false'
                          ),
                            'std'         => 'false'
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => esc_html__( 'RtL Support', 'deasil-core' ),
                            'param_name' => 'rtl',
                            'value'       => array(
                              'True'    => 'true',
                              'False'     => 'false'
                          ),
                            'std'         => 'false',
                            'admin_label' => true,
                            'description' => esc_html__( 'RTL support for language', 'deasil-core' ),
                        ),    
                        array(
                            'type' => 'hidden',
                            'holder' => '',
                            'heading' => esc_html__( 'Unique CSS ID', 'deasil-core' ),
                            'param_name' => 'support_id',
                            'std'    => $rand_id,
                        )                                
                    )
                )
            );                               
} 


        // Element HTML
public function deasil_vc_supported_by_html( $atts ) {

            // Params extraction
    extract(
        shortcode_atts(
            array(
                'title'         => 'Supported By',
                'url'           => '',
                'logos'         => '',
                'number'        => '5',
                'carousel'      => 'false',
                'rtl'           => 'false',
                'support_id'    => ''
            ), 
            $atts
        )
    );

            // Fill $html var with data

    $array_img = explode(',', $logos);
    if($url != ''){
        $array_url = explode(',', $url);
    }
    else{
        $array_url = 0;
    }


    $count = 0;


    $html = '<div class="supported-by">';
    if($title != ''){
        $html .= ' <h4>'. esc_html($title) .'</h4>';
    }
   if($support_id == '' || $carousel == 'false'){
     $html .= '<ul class="supported-list no-carousel">';    
   }
   else{
     $html .= '<ul class="supported-list" id="'. $support_id .'">';    
   }
   
    
    foreach ($array_img as $value) {
        $imageSrc = wp_get_attachment_image_src( $attachment_id = $value, 'full' ); 
        $html .= '<li>';
        if(ctype_space($array_url[$count])){
         $html .= '<img src="' . esc_url($imageSrc[0]) . '" alt="" data-rjs="2">';
     }
     else{
         $html .= '<a href="' . esc_url($array_url[$count]) . '">
         <img src="' . esc_url($imageSrc[0]) . '" alt="" data-rjs="2">
         </a>';
     }
     $html .= '</li>';
     $count++;
 }
 $html .='</ul>
 </div>';

 if($carousel == 'true'){
     $html .= '<script>
     (function($){
        $(document).ready(function(){
            var supportList = $("#'. $support_id .'");
            if(supportList.children(\'li\').length > 1){
                supportList.owlCarousel({
                    animateOut: \'fadeOut\',
                    autoplay: true,
                    margin:30,
                    items: 5,
                    loop:true,
                    dots:false,
                    rtl: ' . esc_attr($rtl) . ',
                    nav:false,
                    responsive:{  
                        320: {
                            items: 1 
                            },
                            400: {
                                items: 2
                                },
                                540:{
                                    items: 3 
                                    },
                                    960:{
                                        items: ' . esc_attr($number) . '
                                    }
                                }
                                });
                            }
                            });
                            })(jQuery);
                            </script>';
                        }


                        return $html;
                    } 

} // End Element Class

    // Element Class Init
new Deasil_VC_Supported_By();   
} 