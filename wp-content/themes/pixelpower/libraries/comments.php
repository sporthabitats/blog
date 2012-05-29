<?php
	if ( ! function_exists( 'cudazi_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 */
	function cudazi_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case '' :
		?>
		<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" class="clearfix">
				<div class="left">					  
					<?php echo get_avatar($comment,$size='60',$default='mm' ); ?>					  					
				</div><!-- end left -->
				<div class="right-comments">
					<div class="comment-text">						
						
						<p class='comment-meta-header'>
							<cite class="fn"><?php echo get_comment_author_link() ?></cite>						
							<span class="comment-meta commentmetadata"><?php comment_date(get_option('date_format')); ?></span>
							<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
						</p>
						
						<?php if ($comment->comment_approved == '0') : ?><p class="moderated"><?php _e('Your comment is awaiting moderation.','cudazi'); ?></p><?php endif; ?>
						
						<?php comment_text() ?>
						
					</div><!--//end comment-text-->				
				</div><!--//end right-comments -->
			</div>
			
		<?php
			break;
			case 'pingback'  :
			case 'trackback' :
		?>
			<li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>" class="clearfix">
					<?php echo "<div class='author'><em>" . __('Trackback:','cudazi') . "</em> ".get_comment_author_link()."</div>"; ?>
                	<?php echo strip_tags(substr(get_comment_text(),0, 110)) . "..."; ?>
                    <?php comment_author_url_link('', '<small>', '</small>'); ?>
             </div>
			<?php
			break;
		endswitch;
	}
	endif;

?>