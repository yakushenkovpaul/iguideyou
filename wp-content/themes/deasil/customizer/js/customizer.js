/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

 ( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.navbar-brand' ).text( to );
		} );
	} );


	wp.customize( 'logo', function( value ) {
		//console.log(wp.customize._value.logo._value);
		value.bind( function( to ) {
			$( '.logo-img' ).attr('src', to );
			if(to == ''){
				$( '.navbar-brand' ).html(wp.customize._value.blogname._value);
			}
			else{
				$( '.navbar-brand' ).html('<img src="'+to+'">');	
			}
		} );
	} );


	// Blog list page
	wp.customize( 'blog_title', function( value ) {
		value.bind( function( to ) {
			$( '.blog .main-head' ).html( to );
		} );
	} );

	// Blog Title align
	// wp.customize( 'blogtitlealign', function( value ) {
	// 	value.bind( function( to ) {
	// 		setTimeout(function(){ 
	// 			//$('#save').trigger('click');
	// 		}, 3000);
	// 	} );

} )( jQuery );
