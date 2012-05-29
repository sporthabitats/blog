<?php
/**
* Template Name: Archives
*/
get_header(); ?>
				
    <div class="container clearfix">
		
		<div id="primary" role="main" class="twelve columns">
			<?php // Run the loop to output the posts. ?>			
			<?php get_template_part( 'content', 'page-archives' ); ?>						
		</div><!--//columns-->
		
		<div id="secondary" role="complementary" class="four columns">
			<?php get_sidebar(); ?>
		</div><!--//columns-->
						
	</div><!--//container-->
	
<?php get_footer(); ?>