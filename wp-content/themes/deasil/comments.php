<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Deasil
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<div class="section-title left">
			<h4>
				<?php
					printf( // WPCS: XSS OK.
						esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'deasil' ) ),
						number_format_i18n( get_comments_number() ),
						'<span>' . get_the_title() . '</span>'
						);
				?>
			</h4>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h4 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'deasil' ); ?></h4>
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'deasil' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'deasil' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ul',
					'short_ping' => true,
					'format'     => 'xhtml'
					) );
			?>
		</ul><!-- .comment-list -->

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
					<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
						<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'deasil' ); ?></h2>
						<div class="nav-links">

							<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'deasil' ) ); ?></div>
							<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'deasil' ) ); ?></div>

						</div><!-- .nav-links -->
					</nav><!-- #comment-nav-below -->
					<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>


	<br>
	<br>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'deasil' ); ?></p>
	<?php
	endif;

	$fields =  array(
		'author' =>
		'<div class="form-group"><label for="author">' . esc_html__( 'Name', 'deasil' ) . '</label> ' .
		( $req ? '<span class="required">*</span>' : '' ) .
		'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		'" class="form-control" /></div>',

		'email' =>
		'<div class="form-group"><label for="email">' . esc_html__( 'Email', 'deasil' ) . '</label> ' .
		( $req ? '<span class="required">*</span>' : '' ) .
		'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		'" class="form-control" /></div>'
		);
	
	$comments_args = array(
		'label_submit'	 		=> esc_html__( 'Send', 'deasil' ),
		'class_submit' 			=> 'btn btn-primary hvr-sweep-to-right',

		'title_reply'			=> esc_html__( 'Reply or Comment', 'deasil' ),
		'title_reply_before'	=> '<div class="section-title left reply-title"><h4>',
		'title_reply_after'		=> '</h4></div>',

        // remove "Text or HTML to be displayed after the set of comment fields"
		'comment_notes_after' 	=> '',
        // redefine your own textarea (the comment body)
		'comment_field' 		=> '<div class="form-group"><textarea id="comment" name="comment" aria-required="true" class="form-control"></textarea></div>',
		'fields' 				=> apply_filters( 'comment_form_default_fields', $fields )
		);

	comment_form($comments_args);
	?>

</div><!-- #comments -->
