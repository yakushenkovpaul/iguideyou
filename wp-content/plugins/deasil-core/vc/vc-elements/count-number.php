<?php
/*
Element Description: VC Counter Number
*/

if ( ! class_exists( 'Deasil_VC_CountNumber' ) ) {
    class Deasil_VC_CountNumber extends WPBakeryShortCode {

      // Element Init
      function __construct() {
        add_action( 'init', array( $this, 'deasil_vc_count_number_mapping' ) );
        add_shortcode( 'deasil_vc_counter_number', array( $this, 'deasil_vc_count_number_html' ) );
    }

      // Element Mapping
    public function deasil_vc_count_number_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
          return;
      }

        // Map the block with vc_map()
      vc_map( 
        array(
            'name' => esc_html__('Deasil Count Number', 'deasil-core'),
            'base' => 'deasil_vc_counter_number',
            'description' => esc_html__('Add Count Number', 'deasil-core'), 
            'admin_label' => true,
            'category' => esc_html__('Deasil Elements', 'deasil-core'),   
            'icon' => vc_inc_dir_url . '/assets/img/vc_count_number.png',          
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
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => 'vc-title',
                    'heading' => esc_html__( 'Number', 'deasil-core' ),
                    'param_name' => 'number',
                    'value' => esc_html__( '376', 'deasil-core' ),
                    'admin_label' => false,
                ),  
                array(
                    'type' => 'textfield',
                    'holder' => 'div',
                    'class' => 'vc-desc',
                    'heading' => esc_html__( 'Description', 'deasil-core' ),
                    'param_name' => 'desc',
                    'value' => esc_html__( 'List Short Description', 'deasil-core' ),
                    'admin_label' => false,
                ),  
                array(
                    'type' => 'animation_style',
                    'heading' => __( 'Animation Style', 'deasil-core' ),
                    'param_name' => 'animation',
                    'description' => __( 'Choose your animation style', 'deasil-core' ),
                    'admin_label' => false,
                    'weight' => 0
                )   ,
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Type', 'deasil-core'),
                    'param_name'  => 'type',
                    'admin_label' => true,
                    'value'       => array(
                        'Transparent'    => 'transparent',
                        'Base'       => 'base',
                        'Primary'    => 'primary',
                        'Gray'       => 'gray',
                        'Background Color'       => 'bgcolor',
                    ),
                    'std'         => 'base',
                    'group' => 'Style'
                ),      
                array(
                  'type' => 'colorpicker',
                  'heading'     => esc_html__('Background Color', 'deasil-core'),
                  'param_name'  => 'bgcolor',
                  'value' => '#eeeeee', 
                  'dependency' => array(
                    'element' => 'type',
                    'value' => 'bgcolor'
                ),
                  'group' => 'Style'
              ), 
                array(
                  'type' => 'colorpicker',
                  'heading'     => esc_html__('Text Color', 'deasil-core'),
                  'param_name'  => 'textcolor',
                  'value' => '#444444', 
                  'dependency' => array(
                    'element' => 'type',
                    'value' => array('bgcolor', 'transparent'),
                ),
                  'group' => 'Style'
              ), 
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Background Shade', 'deasil-core'),
                    'param_name'  => 'bgshade',
                    'admin_label' => true,
                    'value'       => array(
                        'Dark'      => 'dark',
                        'Light'     => 'light'
                    ),
                    'std'         => 'light',
                    'dependency' => array(
                        'element' => 'type',
                        'value' => array('base', 'primary', 'gray')
                    ),
                    'group' => 'Style'
                ),      
                array(
                    'type'        => 'dropdown',
                    'heading'     => esc_html__('Icon Align', 'deasil-core'),
                    'param_name'  => 'align',
                    'admin_label' => true,
                    'value'       => array(
                        'Center'    => 'center',
                        'Left'     => 'left'
                    ),
                    'std'         => 'center',
                    'group' => 'Style'
                )

            )
)
);                               
} 

        // Element HTML
public function deasil_vc_count_number_html( $atts ) {

        // Params extraction
    extract(
      shortcode_atts(
        array(
          'number'      => '837',
          'desc'        => 'List Short Description',
          'deasilicon'  => 'icon-tick',
          'type'        => 'base',
          'bgshade'     => 'light',
          'align'       => 'center',
          'animation'   => 'fadeIn',
          'bgcolor'     => '#eeeeee',
          'textcolor'   => '#444444'
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

    // Fill $html var with data
    if($type == 'bgcolor'){
        $html = '<div class="counter-div ' . esc_attr($bgshade) . '" style="background-color: ' . $bgcolor . '; color: ' . $textcolor. '">
        <div class=" ' .$animation_classes . ' ">
        <span class="icon-font ' . esc_attr($deasilicon) . '" style="color: ' . $textcolor. '"></span>
        <span class="counter">' . esc_html($number) . '</span>
        <p>' . esc_html($desc) . '</p>
        </div></div>';
    }
    else if($type == 'transparent'){
        $html = '<div class="counter-div ' . esc_attr($bgshade) . '" style="color: ' . $textcolor. '">
        <div class=" ' .$animation_classes . ' ">
        <span class="icon-font ' . esc_attr($deasilicon) . '" style="color: ' . $textcolor. '"></span>
        <span class="counter">' . esc_html($number) . '</span>
        <p>' . esc_html($desc) . '</p>
        </div></div>';
    }
    else{
      $html = '<div class="counter-div ' . esc_attr($type) . ' ' . esc_attr($bgshade) . '">
      <div class=" ' .$animation_classes . ' ">
      <span class="icon-font ' . esc_attr($deasilicon) . '"></span>
      <span class="counter">' . esc_html($number) . '</span>
      <p>' . esc_html($desc) . '</p>
      </div></div>';
  }

  return $html;
} 


    } // End Element Class

    // Element Class Init
    new Deasil_VC_CountNumber();    
}
