<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		
		<header class="entry-header">
			<h2 class="entry-title"><?php the_title(); ?></h2>			
		</header>
		
		<div class="entry-content">
			<?php the_content( __( 'Read More...', 'cudazi' ) ); ?>
			<?php wp_link_pages( array( 'before' => '' . __( '<p>Pages:', 'cudazi' ), 'after' => '</p>' ) ); ?>			
			<?php edit_post_link( __( 'Edit', 'cudazi' ), '<p>', '</p>' ); ?>
			
	
			<?php 
				$tags = get_tags();
				foreach ( $tags as $tag ){			
					echo "<h4>" . $tag->name . " (". $tag->count .")</h4>";
					$tag_description = tag_description( $tag->term_id );
		                if ( ! empty( $tag_description ) ) {
		                    printf("%s", $tag_description); 
					}
					echo "<hr class='half-bottom' />";
					echo "<ul>";
					$myposts = get_posts( array( 'tag_id' => $tag->term_id, 'posts_per_page' => -1 ) );
					foreach( $myposts as $post ) { ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>					
					<?php } // end foreach
					echo "</ul><br />";
				}
				
			?>					
			
		</div><!--//entry-content-->
		
	</article>
	
<?php endwhile; ?>