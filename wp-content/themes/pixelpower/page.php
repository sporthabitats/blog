<?php
/**
* Default Page Template
*/
get_header(); ?>
				
    <div class="container clearfix">
		
		<div id="primary" role="main" class="twelve columns">
			<?php // Run the loop to output the posts. ?>			
			<?php get_template_part( 'content', 'page' ); ?>
		</div><!--//columns-->
		
		<div id="secondary" role="complementary" class="four columns">
			<?php get_sidebar(); ?>
		</div><!--//columns-->
						
	</div><!--//container-->
	
<?php get_footer(); ?>