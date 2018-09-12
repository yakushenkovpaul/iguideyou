<?php

if(!function_exists('deasil_load_location_widget')) {
	/*Location List widget*/
	function deasil_load_location_widget() {
		register_widget( 'Deasil_Location_Widget' );
	}
	add_action( 'widgets_init', 'deasil_load_location_widget' );
}


// Creating the widget 
class Deasil_Location_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'deasil_location_widget', 
			// Widget name will appear in UI
			esc_html__('Deasil Trip Location', 'deasil-core'), 
			// Widget description
			array( 'description' => esc_html__( 'Filter location', 'deasil-core' ), ) 
			);
	}


	// Creating widget front-end
	public function widget( $args, $instance ) {
		if(isset($instance['title'])){
			$title = apply_filters( 'widget_title', $instance['title'] );
		}
		else{
			$title = '';
		}

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];


		echo '<ul>';
		$terms = get_terms('location');
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term, 'location');
			echo '<li><a href="' . esc_url($term_link) . '" data-toggle="tooltip" data-placement="bottom" title="' . esc_attr($term->name) . '">';
			echo esc_html($term->name);
			echo '</a></li>';
		}
		echo '</ul>';

		echo $args['after_widget'];
	}

	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = esc_html($instance[ 'title' ]);
		}
		else {
			$title = esc_html__( 'New title', 'deasil-core' );
		}
		// Widget admin form
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'deasil-core' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
	
} // Class wpb_widget ends here





