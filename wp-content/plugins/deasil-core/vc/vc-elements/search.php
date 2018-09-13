<?php
/*
Element Description: VC Search
*/

if ( ! class_exists( 'Deasil_VC_Search' ) ) {
	class Deasil_VC_Search extends WPBakeryShortCode {

        // Element Init
		function __construct() {
			add_action( 'init', array( $this, 'deasil_vc_search_mapping' ) );
			add_shortcode( 'deasil_vc_search', array( $this, 'deasil_vc_search_html' ) );
		}

        // Element Mapping
		public function deasil_vc_search_mapping() {

            // Stop all if VC is not enabled
			if ( !defined( 'WPB_VC_VERSION' ) ) {
				return;
			}

            // Map the block with vc_map()
			vc_map( 
				array(
					'name' => esc_html__('Deasil Search', 'deasil-core'),
					'base' => 'deasil_vc_search',
					'description' => esc_html__('Add Deasil Search', 'deasil-core'), 
					'category' => esc_html__('Deasil Elements', 'deasil-core'),   
					'icon' => vc_inc_dir_url . '/assets/img/vc_search.png',            
					'params' => array(   
						array(
							'type' => 'textfield',
							'holder' => 'p',
							'class' => 'vc-title',
							'heading' => esc_html__( 'Text Label', 'deasil-core' ),
							'param_name' => 'label',
							'value' => esc_html__( 'Find', 'deasil-core' ),
							'admin_label' => false,
							'weight' => 0,
						),  
						array(
							'type' => 'textfield',
							'holder' => 'p',
							'class' => 'vc-title',
							'heading' => esc_html__( 'Sub Label', 'deasil-core' ),
							'param_name' => 'sub_label',
							'value' => esc_html__( 'Tours', 'deasil-core' ),
							'admin_label' => false,
							'weight' => 0,
						),  
						array(
							'type' => 'textfield',
							'holder' => 'p',
							'class' => 'vc-title',
							'heading' => esc_html__( 'Button Label', 'deasil-core' ),
							'param_name' => 'btn_label',
							'value' => esc_html__( 'Search', 'deasil-core' ),
							'admin_label' => false,
							'weight' => 0,
						),  
						array(
							'type'        => 'dropdown',
							'heading'     => esc_html__('Style', 'deasil-core'),
							'param_name'  => 'style',
							'admin_label' => true,
							'value'       => array(
								'Base'       => 'base',
								'Gray'       => 'gray',
								'White'      => 'white',
							),
							'std'         => 'base',
						),
						array(
							'type' => 'checkbox',
							'holder' => 'p',
							'class' => 'vc-title',
							'heading' => esc_html__( 'Hide', 'deasil-core' ),
							'param_name' => 'show_hide',
							"value"       => array(
								'Label'=>'label',
								'Location'=>'location',
								'Categories'=>'categories',
								'Grade'=>'grade',
								'Price Range'=>'price'
							), 
							'std'=> '',
							'admin_label' => false,
							'weight' => 0
						),
					)
				)
			);                                   
		} 


        // Element HTML
		public function deasil_vc_search_html( $atts ) {

			$args = array(
				'taxonomy'     => 'product_cat',
				'orderby'      => 'name',  
				'show_count'   => 0,    
				'pad_counts'   => 0,    
				'hierarchical' => 1,      
				'title_li'     => '',  
				'hide_empty'   => 0,
			);


/* 			$slidermin = deasil_minmax_price('min');
			$slidermax = deasil_minmax_price('max');
			$minprice = (empty($slidermin)) ? 0 : $slidermin;
			$maxprice = (empty( $slidermax)) ? 1000 :  $slidermax; */

			// Find min and max price in current result set.
			$prices = deasil_get_filtered_price();
			$slidermin    = floor( $prices->min_price );
			$slidermax    = ceil( $prices->max_price );
			
			$minprice = (empty($slidermin)) ? 0 : $slidermin;
			$maxprice = (empty( $slidermax)) ? 1000 :  $slidermax;


			// Params extraction
			extract(
				shortcode_atts(
					array(
						'label'   => 'Find',
						'sub_label'   => 'Tours',
						'btn_label'   => 'Search',
						'style'   => 'base',
						'show_hide' => '',
					), 
					$atts
				)
			);

			$hide_option = explode(',', $show_hide);

            // Fill $html var with data
			$html  = '<form method="get" action="' . esc_url(home_url()) . '">';
			$html .= '<div class="search-bar ' . esc_attr($style) . '">';
			if (!in_array("label", $hide_option)){
				$html .= '<div class="text-wrap"><h2>' . esc_html($label) . '</h2><h5>' . esc_html($sub_label) . '</h5></div>';
			}
			
			$html .= '<input type="hidden" name="post_type" value="product" />';
			if (!in_array("location", $hide_option)){
				$html .= '<div class="form-group"><label>' . esc_html__('Location', 'deasil-core') . '</label>
				<select name="location" class="form-control">
				<option value="">' . esc_html__('All', 'deasil-core') . '</option>
				';
				$locations = get_terms('location');
				foreach ( $locations as $location ) {
					$html .= '<option value="'. esc_attr($location->slug) .'">'. esc_html($location->name) .'</option>';
				}
				$html .='</select></div>';
			}
			if (!in_array("categories", $hide_option)){
				$html .= '<div class="form-group">
				<label>' . esc_html__('Categories', 'deasil-core') . '</label>
				<select name="product_cat" class="form-control">';
				$html .= '<option value="">'. esc_html__('All', 'deasil-core') .'</option>';
				$all_categories = get_categories( $args );
				foreach ($all_categories as $cat) {
					if($cat->category_parent == 0) {
						$category_id = $cat->term_id;       
						$html .= '<option value="'. esc_attr(strtolower($cat->slug)) .'">'. esc_html($cat->name) .'</option>';
					}       
				}
				$html .='</select></div>';
			}
			if (!in_array("grade", $hide_option)){
				$html .= '<div class="form-group">
				<label>' . esc_html__('Grade', 'deasil-core') . '</label>
				<select name="grade" class="form-control">';
				$html .= '<option value="">'. esc_html__('All', 'deasil-core') .'</option>';
				$grades = get_terms('grade');
				foreach ( $grades as $grade ) {
					$html .= '<option value="'. esc_attr($grade->slug) .'">'. esc_html($grade->name) .'</option>';
				}
				$html .='</select></div>';
			}
			if (!in_array("price", $hide_option)){
				$html .= '<div class="form-group price-range">
				<label>' . esc_html__('Price Range', 'deasil-core') . '</label>
				<div class="row">
				<div class="col-sm-12">
				<input type="hidden" id="min_price" name="min_price" value="0" class="form-control">
				<input type="hidden" id="max_price" name="max_price" value="0" class="form-control">
				<div id="amount"></div>
				<div id="slider"></div>
				</div>
				</div>
				</div>';
			}

			$html .= '<div><button type="submit" class="btn btn-search btn-primary">' .esc_html($btn_label) . '</button></div>';
			$html .= '</div>
			</form>';      

			$html .= '<script>
			(function($){
				var minprice = ' . esc_attr($minprice) . ';
				var maxprice = ' . esc_attr($maxprice) . ';
				$(document).ready(function(){
					$( "#slider" ).slider({
						range: true,
						min: minprice,
						max: maxprice,
						values: [ minprice, maxprice ],
						slide: function( event, ui ) {
							$( "#min_price" ).val(ui.values[ 0 ]);
							$( "#max_price" ).val(ui.values[ 1 ]);
							$( "#amount" ).html(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
						}
					});
					$( "#min_price" ).val($( "#slider" ).slider( "values", 0 ));
                    $( "#max_price" ).val($( "#slider" ).slider( "values", 1 ));
					$( "#amount" ).html($( "#slider" ).slider( "values", 0 ) +
					" - " + $( "#slider" ).slider( "values", 1 ) );
				});
			})(jQuery);
			</script>';
			return $html;
		} 

    } // End Element Class

    // Element Class Init
    new Deasil_VC_Search();  
}  