<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Deasil
 */

if ( ! function_exists( 'deasil_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function deasil_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	/*
	 if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	 }
	*/

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$byline = sprintf(
		esc_html_x( 'By %s', 'post author', 'deasil' ),
		'<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'deasil' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);


	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'deasil' ) );
		if ( $categories_list && deasil_categorized_blog() ) {
			$posted_in = $categories_list; 
		}
		else{
			$posted_in = '';
		}

	}

	$comments_count = wp_count_comments(get_the_ID());

	echo '<div class="author"> ' . $byline . '</div><p class="byline">' . $posted_on. '<span class="dot"></span>';
	if($posted_in != ''){
		echo '<span class="italic">in</span> '.$posted_in.'<span class="dot"></span> ';
	}
	printf( _n( '%s comment', '%s comments', $comments_count->total_comments , 'deasil' ), number_format_i18n( $comments_count->total_comments  ) );
}
endif;

if ( ! function_exists( 'deasil_posted_on_line' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function deasil_posted_on_line() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$byline = sprintf(
		esc_html_x( 'By %s', 'post author', 'deasil' ),
		'<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'deasil' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);


	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'deasil' ) );
		if ( $categories_list && deasil_categorized_blog() ) {
			$posted_in = $categories_list; // WPCS: XSS OK.
		}

	}

	$comments_count = wp_count_comments(get_the_ID());

	echo '<p class="byline"> ';
	echo $byline . '<span class="dot"></span>' . $posted_on. '<span class="dot"></span>';
	if(isset($posted_in)){
		echo '<span class="italic">in</span> '.$posted_in.'<span class="dot"></span>';
	}
	 printf( _n( '%s comment', '%s comments', $comments_count->total_comments , 'deasil' ), number_format_i18n( $comments_count->total_comments  ) );
	}
endif;


if ( ! function_exists( 'deasil_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function deasil_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() && is_single()) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'deasil' ) );
		if ( $categories_list && deasil_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'deasil' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ' ', 'deasil' ) );
		if ( $tags_list ) {
			printf( '<div class="tag-wrap">' . $tags_list . '</div>');
		}
	}

	if ( is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment', 'deasil' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span> &nbsp;&nbsp;';
	}

	edit_post_link(
		sprintf(
			esc_html__( 'Edit', 'deasil' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function deasil_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'deasil_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'deasil_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so deasil_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so deasil_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in deasil_categorized_blog.
 */
function deasil_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'deasil_categories' );
}
add_action( 'edit_category', 'deasil_category_transient_flusher' );
add_action( 'save_post',     'deasil_category_transient_flusher' );


