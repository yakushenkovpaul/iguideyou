<?php


/*Add mce button*/
add_filter( 'mce_buttons', 'pre_code_add_button' );
function pre_code_add_button( $buttons ) {
	$buttons[] = 'pre_code_button';
	return $buttons;
}
add_filter( 'mce_external_plugins', 'pre_code_add_javascript' );
function pre_code_add_javascript( $plugin_array ) {
	$plugin_array['pre_code_button'] =  plugin_dir_url(__FILE__).'/tinymce-plugin.js';
	return $plugin_array;
}

