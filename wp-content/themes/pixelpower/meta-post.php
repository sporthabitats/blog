<footer class="entry-meta">
	
	<?php if ( is_single() ) { ?>		
		<span class="post-author"><?php _e('Posted by','cudazi'); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php the_author() ; ?></a></span>
	<?php }else{ ?>	
		<?php if ( comments_open() ) { ?><span class="post-comment-link"><?php comments_popup_link( __( '0 Responses', 'cudazi' ), __( '1 Response', 'cudazi' ), __( '% Responses', 'cudazi' ), null, '' ); ?></span><?php } ?>	
	<?php } ?>
	
	<?php 
		//
		// Show tags, categories or nothing
		//
		$post_footer_cats_tags = cudazi_get_option( 'post_footer_cats_tags', 'tags' );
		if ( $post_footer_cats_tags == 'tags' ) { ?>
			<span class="post-tags"><?php the_tags('',', ',''); ?></span>
		<?php }else if( $post_footer_cats_tags == 'categories' ) { ?>
			<span class="post-tags"><?php the_category(', '); ?></span>
		<?php }else if ( $post_footer_cats_tags == 'hide' ) { /* display nothing */ } ?>
	
	<span class="post-permalink"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'cudazi' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e('Permalink','cudazi'); ?></a></span>	
	<?php edit_post_link( __('[edit]','cudazi'), ''); ?>
</footer>