<?php
/**
* The Template for displaying single posts, customized to pull in a unique post template on a per-post basis.
*/
	get_header(); 
?>	
	<div class="container clearfix">
	
		<div id="primary" role="main" class="twelve columns">
			
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>    				
				<?php get_template_part( 'content', get_post_format() ); ?>				
				<?php get_template_part( 'nav', 'post-single' ); ?>				
				<?php comments_template( '', true ); ?>								
			<?php endwhile; // end of the loop. ?>			
		</div><!--//columns-->	
	
		<div id="secondary" role="complementary" class="four columns">
			<?php get_sidebar(); ?>
		</div><!--//columns-->
		
	</div><!--//container-->
		
<?php get_footer(); ?>