<?php
/**
 * The template for displaying Comments.
*/
?>

<?php if ( have_comments() || comments_open() ) { ?>
<div id="comments">
<?php } ?>

<?php if ( post_password_required() ) : ?><p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'cudazi' ); ?></p><?php return; endif; ?>

<?php if ( have_comments() ) : ?>
	
	<div id="commentlist_wrap" <?php echo ( ! comments_open() ? "class='remove-bottom'" : ''); ?>>
		
		<h5 id="comments-title"><?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'cudazi' ), number_format_i18n( get_comments_number() ), '' . get_the_title() . '' ); ?></h5>
	
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation clearfix">
				<div class="nav-previous left"><?php previous_comments_link( __( '&lt;&nbsp;&nbsp;Older Comments', 'cudazi' ) ); ?></div>
				<div class="nav-next right"><?php next_comments_link( __( 'Newer Comments&nbsp;&nbsp;&gt;', 'cudazi' ) ); ?></div>
			</div>
		<?php endif; // check for comment navigation ?>
		
			<ol id="commentlist">
				<?php /* Loop through and list the comments, see cudazi_comment() for formatting options. */
				wp_list_comments( array( 'callback' => 'cudazi_comment' ) ); ?>
			</ol>
		
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation clearfix">
				<div class="nav-previous left"><?php previous_comments_link( __( '&lt;&nbsp;&nbsp;Older Comments', 'cudazi' ) ); ?></div>
				<div class="nav-next right"><?php next_comments_link( __( 'Newer Comments&nbsp;&nbsp;&gt;', 'cudazi' ) ); ?></div>
			</div>
		<?php endif; // check for comment navigation ?>
		
	</div><!--//commentlist_wrap-->
	
<?php endif; // end have_comments() ?>
	
<?php if ( comments_open() ) {
	comment_form( array( 'comment_notes_before' => "<p>" . __('Your email address will not be published. Please enter your name, email and a comment.', 'cudazi') . "</p>" ) ); 
} ?>
	
<?php if ( have_comments() || comments_open() ) { ?>
</div><!-- //comments -->
<?php } ?>