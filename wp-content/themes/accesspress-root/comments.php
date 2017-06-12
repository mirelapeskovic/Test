<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package AccessPress Root
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
			<span class="comment-title-wrap">
				<?php
					printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'accesspress-root' ),
						number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
				?>
			</span>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'accesspress-root' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'accesspress-root' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'accesspress-root' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'accesspress-root' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'accesspress-root' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'accesspress-root' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'accesspress-root' ); ?></p>
	<?php endif; ?>

	<?php 

		$args = array(
		'fields' => apply_filters(
		'comment_form_default_fields', array(
		'author' =>'<div class="name-email-row clearfix"><p class="comment-form-author">' . '<input id="author" placeholder="'.__('Name *','accesspress-root').'" name="author" type="text" value="' .
		esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" />'.
		'</p>',

		'email'  => '<p class="comment-form-email">' . '<input id="email" placeholder="'.__('Email Address *','accesspress-root').'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		'" size="30" aria-required="true" />'  .
		'</p></div>',

		'url'    => '<p class="comment-form-url">' .
		'<input id="url" name="url" placeholder="'.__('Website','accesspress-root').'" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> ' .
		'</p>'
		)
		),

		'comment_field' => '<p class="comment-form-comment">' .
		'<textarea id="comment" name="comment" placeholder="'.__('Comment *','accesspress-root').'" cols="45" rows="8" aria-required="true"></textarea>' .
		'</p>',
		'comment_notes_after' => '',
		'comment_notes_before' => '',
		);

    comment_form( $args );

	?>

</div><!-- #comments -->
