<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mora Theme
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

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'mora' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'mora' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'mora' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'mora' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size'=> '60',
					'callback'	 => 'mora_comment'
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'mora' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'mora' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'mora' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'mora' ); ?></p>
	<?php endif; ?>

<?php

	$mora_commenter = wp_get_current_commenter();
	$mora_req = get_option( 'require_name_email' );
	$mora_aria_req = ( $mora_req ? " aria-required='true'" : '' );

	comment_form(array(
		'comment_notes_before' => '<p class="comment-notes">' .	esc_html__( 'Your email address will not be published. Marked fields are required.', 'mora' ).		'</p>',		
		'fields' => apply_filters( 'comment_form_default_fields', array(
			
			'author' => '<div class="row"><div class="four columns"><div class="comment-form-author"><fieldset><input id="author" name="author" type="text" placeholder="'.esc_attr__( 'Name', 'mora' ). ( $mora_req ? ' *' : '' ).'" value="' . esc_attr( $mora_commenter['comment_author'] ) . '" size="30"' . $mora_aria_req . ' /></fieldset></div></div>',
			'email' => '<div class="four columns"><div class="comment-form-email"><fieldset><input id="email" name="email" type="text" value="' . esc_attr(  $mora_commenter['comment_author_email'] ) . '" size="30" placeholder="'. esc_attr__( 'Email', 'mora' ) . ( $mora_req ? ' *' : '' ) .'" ' . $mora_aria_req . ' /></fieldset></div></div>',
			'url' => '<div class="four columns"><div class="comment-form-url"><fieldset><input id="url" name="url" type="text" value="' . esc_attr( $mora_commenter['comment_author_url'] ) . '" placeholder="'.esc_attr__( 'Website', 'mora' ).'" size="30" /></fieldset></div></div></div>'

		)),
		'title_reply' => esc_html__( 'Leave a Comment', 'mora' ),
		'title_reply_to' => esc_html__( 'Leave a  Comment', 'mora' ),
		'cancel_reply_link' => esc_html__( 'Cancel Comment', 'mora' ),	
		'comment_field' => '<div class="comment-form-comment"><fieldset>' . '<textarea id="comment" placeholder="' . esc_attr__( 'Your Comment', 'mora' ) . ( $mora_req ? ' *' : '' ) . '" name="comment" cols="45" rows="8" aria-required="true"></textarea></fieldset></div>',
		'label_submit' => esc_attr__( 'Submit', 'mora' ),
		'id_submit' => 'submit_my_comment',
		'class_submit' => 'solid',
		
	));
	?>

</div><!-- #comments -->
