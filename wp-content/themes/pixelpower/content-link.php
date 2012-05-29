<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix with-entry-wrap'); ?>>												
	<?php 
		$ft_image_atts = array( 'fallback_to_first_attached' => false );
		echo cudazi_featured_image( $ft_image_atts ); 
	?>
	
	<div class="entry-wrap">
		<header class="entry-header">					
			<h2 class="entry-title">
				<?php						
					$content = apply_filters('the_content', get_the_content() );
					$content = preg_match_all( '/href\s*=\s*[\"\']([^\"\']+)/', $content, $links );
		    		$content = $links[1][0];
				    echo sprintf( "<a href='%s' title='%s'>%s</a>", $content, __('Visit: ' . $content,'cudazi'), get_the_title() );
				?>
			</h2>		
			<div class="post-format-icon"></div>		
			<time class="entry-date" datetime="<?php the_time('c'); ?>" pubdate="pubdate" title="<?php the_time( get_option('date_format') ); ?>">
				<?php the_time( 'M d' ); ?>
			</time>
		</header>
	
		<div class="entry-content">
			<?php the_content( __( 'Read More...', 'cudazi' ) ); ?>
			<?php if ( is_single() ) { wp_link_pages( array( 'before' => '' . __( '<p>Pages:', 'cudazi' ), 'after' => '</p>' ) ); } ?>
		</div><!--//entry-content-->
						
		<?php get_template_part( 'meta', 'post' ); ?>
		
	</div><!--//entry-wrap-->
</article><!--//post-->
