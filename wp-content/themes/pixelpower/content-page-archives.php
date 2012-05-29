<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		
		<header class="entry-header">
			<h2 class="entry-title"><?php the_title(); ?></h2>			
		</header>
		
		<div class="entry-content">
			<?php the_content( __( 'Read More...', 'cudazi' ) ); ?>
			<?php wp_link_pages( array( 'before' => '' . __( '<p>Pages:', 'cudazi' ), 'after' => '</p>' ) ); ?>			
			<?php edit_post_link( __( 'Edit', 'cudazi' ), '<p>', '</p>' ); ?>
			
			
			
			<div class="clearfix">
			
				<div class="sc_column one_half">
				
					<?php $posts_to_show = 50; ?>
					<h4><?php echo sprintf(__('Latest %s Posts', 'cudazi'), $posts_to_show ); ?></h4>
					<hr class="half-bottom" />
					<ul>
						<?php
							$myposts = get_posts( "numberposts=" . $posts_to_show );
							foreach( $myposts as $post ) { ?>
								<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>					
							<?php } // end foreach ?>
					</ul>
				
				</div>
				
				<div class="sc_column one_half last">						
					
					<h4><?php _e('Categories', 'cudazi'); ?></h4>
					<hr class="half-bottom" />
					<ul><?php wp_list_categories('title_li=&show_count=1&show_option_none=') ?></ul>
					
					<h4><?php _e('Months', 'cudazi'); ?></h4>
					<hr class="half-bottom" />
					<ul><?php wp_get_archives('type=monthly&show_post_count=1') ?></ul>
										
					<h4><?php _e('Tags', 'cudazi'); ?></h4>
					<hr class="half-bottom" />						
					<?php wp_tag_cloud(  ); ?>				
				</div>
				
			</div><!--//clearfix-->
			
		</div><!--//entry-content-->
		
	</article>
	
<?php endwhile; ?>