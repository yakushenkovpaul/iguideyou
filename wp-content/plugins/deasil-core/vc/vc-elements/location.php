<?php
/*
Element Description: VC Location
*/

if ( ! class_exists( 'Deasil_VC_Location' ) ) {
    class Deasil_VC_Location extends WPBakeryShortCode {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_location_mapping' ) );
            add_shortcode( 'deasil_vc_location', array( $this, 'deasil_vc_location_html' ) );
        }

        // Element Mapping
        public function deasil_vc_location_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
            }

            // Map the block with vc_map()
            vc_map( 
                array(
                    'name' => esc_html__('Deasil Location Carousel', 'deasil-core'),
                    'base' => 'deasil_vc_location',
                    'description' => esc_html__('Add Random Location', 'deasil-core'), 
                    'category' => esc_html__('Deasil Elements', 'deasil-core'),   
                    'icon' => vc_inc_dir_url . '/assets/img/vc_location.png',            
                    'params' => array(   
                                    array(
                                        'type'        => 'dropdown',
                                        'heading'     => esc_html__('Column', 'deasil-core'),
                                        'param_name'  => 'col',
                                        'admin_label' => true,
                                        'value'       => array(
                                                            'One'      => '1',
                                                            'Two'      => '2',
                                                            'Three'    => '3',
                                                            'Four'     => '4',
                                                            'Six'      => '6'
                                                            ),
                                        'std'         => '4',
                                        'description' => esc_html__( 'Please add location term Product > Location', 'deasil-core' ),
                                        ),             
                                    array(
                                        'type'        => 'textfield',
                                        'heading'     => esc_html__('Height in PX', 'deasil-core'),
                                        'param_name'  => 'height',
                                        'admin_label' => true,
                                        'std'         => '240',
                                        ), 
                                    array(
                                        'type'        => 'dropdown',
                                        'heading'     => esc_html__('Show Map', 'deasil-core'),
                                        'param_name'  => 'showmap',
                                        'admin_label' => true,
                                        'value'       => array(
                                                            'Show'    => 'show-map',
                                                            'Hide'     => 'hide'
                                                            ),
                                        'std'         => 'hide'
                                        ),  
                                    array(
                                        'type'        => 'dropdown',
                                        'heading'     => esc_html__('Carousel', 'deasil-core'),
                                        'param_name'  => 'carousel',
                                        'admin_label' => true,
                                        'value'       => array(
                                                            'Yes'    => 'true',
                                                            'No'     => 'false'
                                                            ),
                                        'std'         => 'true'
                                        ),  
                                    array(
                                        'type' => 'dropdown',
                                        'heading' => esc_html__( 'Navigation Arrow', 'deasil-core' ),
                                        'param_name' => 'nav',
                                        'value'       => array(
                                                                'Show'    => 'true',
                                                                'Hide'     => 'false'
                                                                ),
                                        'admin_label' => true,
                                        'dependency' => array(
                                          'element' => 'carousel',
                                          'value' => 'true'
                                          )
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
                                        'description' => esc_html__( 'RTL support for language', 'deasil-core' )
                                        )                              
                                )
                    )
            );                               

        } 


        // Element HTML
        public function deasil_vc_location_html( $atts ) {
            
            // Params extraction
            extract(
              shortcode_atts(
                array(
                  'col'    => '4',
                  'height' => '240',
                  'showmap' => 'false',
                  'carousel' => 'true',
                  'nav' => 'true',
                  'rtl' => 'false'
                  ), 
                $atts
                )
              );


            switch($col){
                case 1:
                $column_class = 'col-md-12';
                break;
                case 2:
                $column_class = 'col-md-6';
                break;
                case 3:
                $column_class = 'col-md-4';
                break;
                case 4:
                $column_class = 'col-md-3';
                break;
                case 6:
                $column_class = 'col-md-22';
                break;
                default:
                $column_class = 'col-md-4';
            }

            $map_margin_top = $height/2 - 50;

            $max = 5; 
            $taxonomy = 'location';
            $terms = get_terms($taxonomy, 'type=product&orderby=name&order= ASC&hide_empty=0');

            // Random order
            shuffle($terms);

            // $number is from vc option number
            //$terms = array_slice($terms, 0, $max);

            if($carousel == 'false'){
              $html = '<div class="location-carousel row">';
            }
            else{
              $html = '<div class="location-carousel carousel-on">';
            }

            if ($terms) {
                foreach($terms as $term) {
                    $term_id = $term->term_id;
                    $image_id = get_term_meta ( $term_id, 'location-image-id', true );
                    $map_id = get_term_meta ( $term_id, 'map-image-id', true );
                    $header_image = wp_get_attachment_image_url( $image_id, 'medium', false );
                    $map_image = wp_get_attachment_image_url( $map_id, 'medium', false );

                    $html .= '<a href="' . esc_url(get_term_link( $term, $taxonomy )) . '">';

                    if($carousel == 'false') { 
                        $html .= '<div class="' . esc_attr($column_class) . '">';
                        $html .= '<div class="location-item ' . esc_attr($showmap) . '" style="background-image: url(' . esc_url($header_image) . '); height: ' . esc_attr($height) . 'px">';
                        $html .= '<div class="location-map" style="background-image: url(' . esc_url($map_image) . '); top: ' . esc_attr($map_margin_top) . 'px"></div>';
                        $html .= '<div class="location-term">' . esc_html($term->name) . '</div>';
                        $html .= '</div>';
                        $html .= '</div>';
                    }
                    else {
                        $html .= '<div class="location-item ' . esc_attr($showmap) . '" style="background-image: url(' . esc_url($header_image) . '); height: ' . esc_attr($height) . 'px">';
                        $html .= '<div class="location-map" style="background-image: url(' . esc_url($map_image) . '); top: ' . esc_attr($map_margin_top) . 'px"></div>';
                        $html .= '<div class="location-term">' . esc_html($term->name) . '</div>';
                        $html .= '</div>';
                    }
                    $html .=  '</a>';
                }
            }

            $html .=  '</div>';

            if($carousel == 'true'){
                $html .= '
                        <script>
                            (function($){
                                $(document).ready(function(){
                                    var location = $(".carousel-on");
                                    location.owlCarousel({
                                    animateOut: \'fadeOut\',
                                    autoplay: true,
                                    responsiveClass: true,
                                    responsive: {
                                                    0:{
                                                      items:1,
                                                    },
                                                    500:{
                                                      items:2,
                                                    },
                                                    700:{
                                                      items:3,
                                                    },
                                                    1000:{
                                                      items: ' . esc_attr($col) . ',
                                                      nav:true,
                                                    }
                                                 },
                                    margin: 30,
                                    loop: true,
                                    rtl: ' . esc_attr($rtl) . ',
                                    dots: false,
                                    nav: ' . esc_attr($nav) . ',
                                    navText: [\'<span class="icon-arrow-left"><span>\',\'<span class="icon-arrow-right"><span>\'],
                                    stagePadding: 0
                                    });
                                });
                            })(jQuery);
                        </script>'; 
            }
            return $html;
        } 

    } // End Element Class

    // Element Class Init
    new Deasil_VC_Location();    
}