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
				$cats = get_categories();
				foreach ( $cats as $cat ){
					echo "<h4>" . $cat->name . " (". $cat->count .")</h4>";
					$category_description = category_description( $cat->term_id );
		                if ( ! empty( $category_description ) ) {
		                    printf("%s", $category_description); 
					}
					echo "<hr class='half-bottom' />";
					echo "<ul>";
					$myposts = get_posts( array( 'cat' => $cat->term_id, 'posts_per_page' => -1 ) );
					foreach( $myposts as $post ) { ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>					
					<?php } // end foreach
					echo "</ul><br />";
				}
				
			?>					
			
		</div><!--//entry-content-->
		
	</article>
	
<?php endwhile; ?>