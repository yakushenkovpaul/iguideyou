<?php

if(!function_exists('deasil_load_social_icons_widget')) {
	/*Social Icons widget*/
	function deasil_load_social_icons_widget() {
		register_widget( 'Deasil_Social_Icons_Widget' );
	}
	add_action( 'widgets_init', 'deasil_load_social_icons_widget' );
}

// Creating the widget 
class Deasil_Social_Icons_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(

			// Base ID of your widget
			'deasil_social_icons_widget', 

			// Widget name will appear in UI
			esc_html__('Deasil Social icons', 'deasil-core'), 

			// Widget description
			array( 'description' => esc_html__( 'Add Social Icons', 'deasil-core' ), ) 
			);
	}


	//variable
	private static $icons = array(
		"facebook",
		"twitter",
		"linkedin",
		"instagram",
		"google",
		"pinterest",
		"youtube",
		"skype",
		"tripadvisor",
		"yelp",
		);

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
			echo $args['before_title'] . esc_html($title) . $args['after_title'];

		echo '<div class="social-icon-list"><ul>';
		foreach ($instance as $key => $value) {
			if($key != 'title' && $value != ''){
				$key . '' . $value; 
				echo '<li><a href="' . esc_url($value) . '" target="_blank" title="' . esc_html(ucfirst($key)) . '"><i class="fa fa-' . esc_attr($key) . '"></i></a></li>';
			}
		}
		echo '</ul></div>';

		echo $args['after_widget'];
	}

	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = '';
		}


		$social_icons = self::$icons;
		foreach ($social_icons as $key => $value) {
			if ( isset( $instance[ $value ] ) ) {
				${$value} = $instance[ $value ];
			}
			else {
				${$value} = '';
			}
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( $value )); ?>"><?php echo esc_html(ucfirst($value)) ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id( $value )); ?>" name="<?php echo esc_attr($this->get_field_name( $value )); ?>" type="text" value="<?php echo esc_attr( ${$value} ); ?>" />
			</p>
			<?php } 
		}

		// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$social_icons = self::$icons;
			foreach ($social_icons as $key => $value) {
				$instance[$value] = ( ! empty( $new_instance[$value] ) ) ? strip_tags( $new_instance[$value] ) : '';
			}
			return $instance;
		}
} // Class wpb_widget ends here





