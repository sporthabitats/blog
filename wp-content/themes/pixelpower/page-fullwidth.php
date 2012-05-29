<?php
/**
* Template Name: Full Width Page
*/
get_header(); ?>
				
    <div class="container clearfix">
		
		<div id="primary" role="main" class="sixteen columns">
			<?php // Run the loop to output the posts. ?>			
			<?php get_template_part( 'content', 'page' ); ?>
		</div><!--//columns-->
						
	</div><!--//container-->
	
<?php get_footer(); ?>