<?php
/*
Element Description: VC Deasil Button
*/

if ( ! class_exists( 'Deasil_VC_Button' ) ) {
    class Deasil_VC_Button extends WPBakeryShortCode {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_deasil_button_mapping' ) );
            add_shortcode( 'deasil_vc_button', array( $this, 'deasil_vc_deasil_button_html' ) );
        }
        
        // Element Mapping
        public function deasil_vc_deasil_button_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
                return;
            }
            
            // Map the block with vc_map()
            vc_map( 
                array(
                    'name' => esc_html__('Deasil Button', 'deasil-core'),
                    'base' => 'deasil_vc_button',
                    'description' => esc_html__('Add Deasil Button', 'deasil-core'), 
                    'category' => esc_html__('Deasil Elements', 'deasil-core'),      
                    'icon' => vc_inc_dir_url . '/assets/img/vc_button.png',            
                    'params' => array(   
                                    array(
                                        'type' => 'textfield',
                                        'holder' => 'p',
                                        'class' => 'vc-title',
                                        'heading' => esc_html__( 'Label', 'deasil-core' ),
                                        'param_name' => 'label',
                                        'value' => esc_html__( 'Default value', 'deasil-core' ),
                                        'description' => esc_html__( 'Box Title', 'deasil-core' ),
                                        'admin_label' => false,
                                        'weight' => 0,
                                        ),  
                                    array(
                                        'type' => 'textfield',
                                        'holder' => 'p',
                                        'class' => 'vc-title',
                                        'heading' => esc_html__( 'Link URL', 'deasil-core' ),
                                        'param_name' => 'url',
                                        'value' => esc_html__( 'Default value', 'deasil-core' ),
                                        'description' => esc_html__( 'Box Title', 'deasil-core' ),
                                        'admin_label' => false,
                                        'weight' => 0,
                                        ),  
                                    array(
                                        'type'        => 'dropdown',
                                        'heading'     => esc_html__('Target', 'deasil-core'),
                                        'param_name'  => 'target',
                                        'admin_label' => true,
                                        'value'       => array(
                                            '_blank'    => '_blank',
                                            '_self'     => '_self',
                                            '_parent'   => '_parent',
                                            '_top'      => '_top'
                                            ),
                                        'std'         => '_blank',
                                        'description' => esc_html__('Available option: selft, parent, top', 'deasil-core'),
                                        ),         
                                    array(
                                        'type'        => 'dropdown',
                                        'heading'     => esc_html__('Size', 'deasil-core'),
                                        'param_name'  => 'size',
                                        'admin_label' => true,
                                        'value'       => array(
                                            'Large'     => 'lg',
                                            'Medium'    => 'md',
                                            'Small'   => 'sm',
                                            ),
                                        'std'         => 'md',
                                        'description' => esc_html__('Available option: medium-md, large-lg, small-sm', 'deasil-core'),

                                        ),         
                                    array(
                                        'type'        => 'dropdown',
                                        'heading'     => esc_html__('Color', 'deasil-core'),
                                        'param_name'  => 'color',
                                        'admin_label' => true,
                                        'value'       => array(
                                            'Primary'   => 'primary',
                                            'Default'   => 'default',
                                            'Success'   => 'success',
                                            'Danger'    => 'danger',
                                            'Warning'   => 'warning',
                                            'Info'      => 'info'
                                            ),
                                        'std'         => 'primary',
                                        'description' => esc_html__('Available option: primary, success, danger, warning, info, default', 'deasil-core'),
                                        ),
                                     array(
                                        'type'        => 'dropdown',
                                        'heading'     => esc_html__('Align', 'deasil-core'),
                                        'param_name'  => 'align',
                                        'admin_label' => true,
                                        'value'       => array(
                                            'Left'   => '',
                                            'Center'   => 'pull-center',
                                            'right'   => 'pull-right'
                                            ),
                                        'std'         => '',
                                        ),
                                    array(
                                        'type' => 'textfield',
                                        'holder' => 'p',
                                        'class' => 'vc-title',
                                        'heading' => esc_html__( 'CSS Class', 'deasil-core' ),
                                        'param_name' => 'cssclass',
                                        'value' => ''
                                        )                   
                                    )
                )
            );                               
        } 


        // Element HTML
        public function deasil_vc_deasil_button_html( $atts ) {

         // Params extraction
            extract(
                shortcode_atts(
                    array(
                        'label'     => 'Button',
                        'url'       => '#',
                        'target'    => '_blank',
                        'size'      => 'md',
                        'color'     => 'primary',
                        'align'     => '',
                        'cssclass'  => ''
                        ), 
                    $atts
                    )
                );

             // Fill $html var with data
            $html = '
            <a href="' . esc_url($url) . '" target="' . esc_attr($target) . '" class="btn btn-' . esc_attr($color) . ' btn-' . esc_attr($size) . ' ' . $align . ' ' . $cssclass . ' ">' . esc_html($label) . '</a>';      
            return $html;
        } 

    } // End Element Class

    // Element Class Init
    new Deasil_VC_Button();    
}