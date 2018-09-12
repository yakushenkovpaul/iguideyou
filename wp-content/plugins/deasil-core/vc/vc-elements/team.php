<?php
/*
Element Description: VC Team
*/

if ( ! class_exists( 'Deasil_VC_Team' ) ) {
    class Deasil_VC_Team extends WPBakeryShortCode {

        // Element Init
        function __construct() {
            add_action( 'init', array( $this, 'deasil_vc_team_mapping' ) );
            add_shortcode( 'deasil_vc_team', array( $this, 'deasil_vc_team_html' ) );
        }

        // Element Mapping
        public function deasil_vc_team_mapping() {

            // Stop all if VC is not enabled
            if ( !defined( 'WPB_VC_VERSION' ) ) {
              return;
            }

        // Map the block with vc_map()
        vc_map( 
          array(
            'name' => esc_html__('Deasil Team Feature', 'deasil-core'),
            'base' => 'deasil_vc_team',
            'description' => esc_html__('Add Deasil Team', 'deasil-core'), 
            'category' => esc_html__('Deasil Elements', 'deasil-core'),   
            'icon' => vc_inc_dir_url . '/assets/img/vc_team.png',            
            'params' => array(   
              array(
                'type'        => 'dropdown',
                'heading'     => esc_html__('Column', 'deasil-core'),
                'param_name'  => 'col',
                'admin_label' => true,
                'value'       => array(
                                    'Two'      => '6',
                                    'Three'    => '4',
                                    'Four'     => '3',
                                    ),
                'std'         => '4',
                'description' => esc_html__( 'First Add Team Profile from menu Team Members under Pages. It displays random team member list.', 'deasil-core' ),
                ),   
              array(
                'type'        => 'dropdown',
                'heading'     => esc_html__('Number', 'deasil-core'),
                'param_name'  => 'number',
                'admin_label' => true,
                'value'       => array(
                                    '2'      => '2',
                                    '3'    => '3',
                                    '4'     => '4',
                                    '6'      => '6',
                                    '8'      => '8',
                                    'all'   => '9999'
                                    ),
                'std'         => '3',
                'description' => esc_html__( 'Number of items to be shown' , 'deasil-core'),
                ),   
              array(
                'type'        => 'dropdown',
                'heading'     => esc_html__('Order By', 'deasil-core'),
                'param_name'  => 'orderby',
                'admin_label' => true,
                'value'       => array(
                                    'title' => 'title',
                                    'name' => 'name',
                                    'date' => 'date',
                                    'modified' => 'modified',
                                    'rand' => 'rand'
                                    ),
                'std'         => 'name',
                'description' => esc_html__( 'Select items to be orderby' , 'deasil-core'),
                ),             
              array(
                'type'        => 'dropdown',
                'heading'     => esc_html__('Style', 'deasil-core'),
                'param_name'  => 'style',
                'admin_label' => true,
                'value'       => array(
                                    'Default'    => 'default',
                                    'Circular'     => 'round'
                                    ),
                'std'         => 'default',
                ),                         

              )
            )
          );                               

      } 


        // Element HTML
        public function deasil_vc_team_html( $atts ) {
            // Params extraction
            extract(
              shortcode_atts(
                array(
                  'col'   => '4',
                  'number' => '3',
                  'orderby' => 'name',
                  'style' => 'default',
                  ), 
                $atts
                )
              );

            //Create WordPress Query with 'orderby' set to 'rand' (Random)
            $the_query = new WP_Query( array ('post_type' => 'deasil_team', 'orderby' => $orderby, 'posts_per_page' => $number ) );

            $html = '<div class="row team-member team-' . esc_attr($style) . '">';
            while ( $the_query->have_posts() ) : $the_query->the_post();

            $post_id = get_the_ID();
            $language = get_post_meta($post_id, "deasil_team_language", true);
            $location = get_post_meta($post_id, "deasil_team_location", true);
            $email = get_post_meta($post_id, "deasil_team_email", true);

            $twitter = get_post_meta($post_id, "deasil_team_twitter", true);
            $facebook = get_post_meta($post_id, "deasil_team_facebook", true);
            $google = get_post_meta($post_id, "deasil_team_google", true);
            $linkedin = get_post_meta($post_id, "deasil_team_linkedin", true);
            $instagram = get_post_meta($post_id, "deasil_team_instagram", true);

            $html .= '<div class="col-lg-' . esc_attr($col) . ' col-sm-6">';
            $html .= '<div class="member">';
            if(has_post_thumbnail()){
                $html .= '<div class="image" style="background-image: url(' . get_the_post_thumbnail_url() . ')"></div>';
            }
            else{
                $html .= '<div class="image"></div>';
            }
            $html .= ' <h4 class="name"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
            $html .= '<h5 class="detail">' . esc_html($location) . '</h5>';
            $html .= '<p>'. get_the_excerpt() . '</p>';
            $html .= '<div class="social">';
            if($facebook != '') $html .= ' <a href="' . esc_url($facebook) . '" class="icon fa fa-facebook"></a>';
            if($twitter != '') $html .= ' <a href="' . esc_url($twitter) . '" class="icon fa fa-twitter"></a>';
            if($google != '') $html .= ' <a href="' . esc_url($google) . '" class="icon fa fa-google"></a>';
            if($linkedin != '') $html .= ' <a href="' . esc_url($linkedin) . '" class="icon fa fa-linkedin"></a>';
            if($instagram != '') $html .= ' <a href="' . esc_url($instagram) . '" class="icon fa fa-instagram"></a>';

            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            endwhile;
            
            // Reset Post Data
            wp_reset_postdata();  

            $html .=  '</div>';
            return $html;
        } 

    } // End Element Class

    // Element Class Init
    new Deasil_VC_Team();    
}