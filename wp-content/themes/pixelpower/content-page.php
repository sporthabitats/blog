<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
	
	<header class="entry-header">
		<h2 class="entry-title"><?php the_title(); ?></h2>			
	</header>
	
	<div class="entry-content">
		<?php the_content( __( 'Read More...', 'cudazi' ) ); ?>
		<?php wp_link_pages( array( 'before' => '' . __( '<p>Pages:', 'cudazi' ), 'after' => '</p>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'cudazi' ), '<p>', '</p>' ); ?>
	</div><!--//entry-content-->
	
</article>
<?php comments_template( '', true ); ?>
<?php endwhile; ?>