
<?php
/**
* The main template file.
*/
get_header(); ?>

   <div class="container clearfix">
		
		<div id="primary" role="main" class="twelve columns">
			
			<?php
				/* Queue the first post, that way we know
				 * what date we're dealing with (if that is the case).
				 *
				 * We reset this later so we can run the loop
				 * properly with a call to rewind_posts().
				 */
				if ( have_posts() ) { 
					the_post(); 
				} 
				?>					
				<?php if ( is_day() ) : ?>
					<div class="post"><h2 class="entry-title archive-title"><?php printf( __( 'Daily Archives: %s', 'cudazi' ), get_the_date() ); ?></h2></div>
				<?php elseif ( is_month() ) : ?>
					<div class="post"><h2 class="entry-title archive-title"><?php printf( __( 'Monthly Archives: %s', 'cudazi' ), get_the_date( 'F Y' ) ); ?></h2></div>
				<?php elseif ( is_year() ) : ?>
					<div class="post"><h2 class="entry-title archive-title"><?php printf( __( 'Yearly Archives: %s', 'cudazi' ), get_the_date( 'Y' ) ); ?></h2></div>
				<?php elseif ( is_author()  ) : ?>

		            <div class="post">
		            	<?php echo get_avatar( get_the_author_meta('ID'), 25, '', '' ); ?>
		            	<h2 class="entry-title archive-title"><?php printf( __( 'Posts by: %s', 'cudazi' ), get_the_author_link() ); ?></h2>
		            	<?php if ( get_the_author_meta( 'description' ) ) { ?>
		            		<p><?php the_author_meta( 'description' ); ?></p>
		            	<?php } ?>
		            </div>
		        <?php elseif ( is_tag()  ) : ?>
		            <div class="post"><h2 class="entry-title archive-title"><?php echo single_tag_title( null, false ); ?></h2>
		            <?php $tag_description = tag_description();
		                if ( ! empty( $tag_description ) )
		                    printf("<p>%s</p>", $tag_description); ?>					
		        	</div>
		        <?php elseif ( is_category()  ) : ?>
		        	<div class="post"><h2 class="entry-title archive-title"><?php echo single_cat_title( null, false ); ?></h2>
					<?php $category_description = category_description();
		                if ( ! empty( $category_description ) )
		                    printf("<p>%s</p>", $category_description); ?>					
		        	</div>
				<?php else : ?>
					<div class="post"><h2 class="entry-title archive-title"><?php _e( 'Archive', 'cudazi' ); ?></h2></div>
				<?php endif; ?>			

				<?php				
				/* Since we called the_post() above, we need to rewind the loop back to the beginning that way we can run the loop properly, in full. */
				rewind_posts();
				
				/* Run the loop for the archives page to output the posts. */		
				while ( have_posts() ) : the_post();
					get_template_part( 'content', get_post_format() );
				endwhile;
				
				get_template_part( 'nav', 'post-loop' );				
				?>
			
		</div><!--//columns-->
		
		<div id="secondary" role="complementary" class="four columns">
			<?php get_sidebar(); ?>
		</div><!--//columns-->
						
	</div><!--//container-->
        
<?php get_footer(); ?>