<?php

function deasil_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'deasil_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'ffffff',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'deasil_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'deasil_custom_header_setup' );

if ( ! function_exists( 'deasil_header_style' ) ) :
    /**
     * Styles the header image and text displayed on the blog.
     *
     * @see deasil_custom_header_setup().
     */
    function deasil_header_style() {
    	$header_text_color = get_header_textcolor();

        /*
         * If no custom options for text are set, let's bail.
         * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
         */
        if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
        	return;
        }

        // If we get this far, we have custom styles. Let's do this.
        ?>
        <style type="text/css">
        <?php
        // Has the text been hidden?
        if ( ! display_header_text() ) :
        	?>
        	.site-title,
        	.site-description {
        	position: absolute;
        	clip: rect(1px, 1px, 1px, 1px);
        }
        <?php
            // If the user has set a custom color for the text use that.
    else :
    	?>
    	.navbar-brand {
    	color: #<?php echo esc_attr( $header_text_color ); ?> !important;
    }
<?php endif; ?>
</style>
<?php
}
endif;