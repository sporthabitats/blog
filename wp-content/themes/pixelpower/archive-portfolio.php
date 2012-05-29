<?php
/**
* Portfolio Archive Template
* - Used / included inside other page templates
*/
get_header();


	// Comes across as true if loading this template from within a page template
	global $from_page_template;
	
	
	// Portfolio options, set if page is being pulled through portfolio page template
	global $portfolio_options;
	
	
	//	Defaults
	$columns = cudazi_get_option('portfolio_columns_default', 4);
			
			
	// Override if set via portfolio options array
	if ( isset( $portfolio_options['columns'] ) ) {								
		$columns  = $portfolio_options['columns'];
	}
	
	
	// Assign grid size based on columns
	if ( $columns == 1 ) {
		$grid_size = 'sixteen';
	}else if ( $columns == 2 ) {
		$grid_size = 'eight';
	}else{
		$columns = 4;
		$grid_size = 'four';
	}
?>




<?php if ( ! $from_page_template ) { /* if page is not pulled through a page template, wrap in appropriate divs and change functionality */ ?>
<div class="container clearfix">	
	<div id="primary" role="main" class="sixteen columns">
	
	<?php 
		$current_term = '';
		
		$portfolio_tags_qs = get_query_var( 'portfolio-tags' );
		$portfolio_category_qs = get_query_var( 'portfolio-category' );
	
		if ( $portfolio_tags_qs ) {
			$current_term = get_term_by( 'slug', $portfolio_tags_qs, get_query_var( 'taxonomy' ) ); 
		}
		if ( $portfolio_category_qs ) {
			$current_term = get_term_by( 'slug', $portfolio_category_qs, get_query_var( 'taxonomy' ) ); 
		}
	?>
		
	<?php if ( $current_term ) { ?>
	<!-- Archive name / description -->
    <article class="post archive-portfolio">
    	<h2 class="entry-title"><?php echo $current_term->name; ?></h2>
    	<?php
	    	if( $current_term->description )
	    		echo sprintf('<p>%s</p>', $current_term->description);
	    ?>
    </article>
    <!-- // Archive name / description -->
    <?php } // end current term set ?>
   
<?php } // end from page template ?>





<?php


	/*
	 *	Portfolio Items Loop
	 *	Query may be modified by parent page template
	 */		
	
	$count = 0;
	$output = "";
	$overall_tag_array = array();
	
	while ( have_posts() ) : the_post();
		
		$count++; 
		
		$excerpt = get_the_excerpt(); 
		$the_title = the_title("<h3><a href='" . get_permalink() . "'>",'</a></h3>', false);								
		$featured_image = $full_size_featured_image = "";
		
		
		// Assign featured image link and img src
		if ( has_post_thumbnail() ) {
			
			// Only load large thumbnails for 1 column layout	
			if ( $columns == 1 ) {							
				$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'sixteen' );				
			}else{
				$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'eight' );
			}			
			$featured_image = "<img src='" . $featured_image[0] . "' />";
			
			$full_size_featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			$full_size_featured_image = $full_size_featured_image[0];
		}
				
		
		// Apply alpha or omega class to first and last columns
		if ( $count == 1 ) {
			$alpha_omega = 'alpha';
		}else if ( $count == $columns ) {
			$alpha_omega = 'omega';
		}else{
			$alpha_omega = '';
		}

		
		// Tag List for CSS/Filter
		$tag_list = "";
		$tags = get_the_terms( $post->ID, 'portfolio-tags' );			
		if ( ! empty( $tags ) ) {
			foreach ( $tags as $t ) {
				$tag_list .= " tag-" . $t->slug;
				$overall_tag_array[] = $t->slug;
			}
		}
		
		
		// Portfolio Item
		$output .= "<article class='portfolio-item " . $grid_size . ' ' . $alpha_omega . $tag_list . " columns'>";							
			if ( $featured_image ) {					
				$output .= "<a rel='gallery' href='" . $full_size_featured_image . "'>" . $featured_image . "</a>";
			}else{
				$output .= __('No featured image set for this post!','cudazi');
			}				
			$output .= "<p class='portfolio-item-meta'><a class='link' href='" . get_permalink() . "'>" . get_the_title() . "</a></p>";								
		$output .= "</article>";
		
		
		// Reset counter on last column
		if ( $count == $columns )
			$count = 0;
		

	endwhile; // End the loop
	
    
    if ( $output ) {
    
    	// Sort and trim down array to unique tags
    	sort($overall_tag_array);
    	$overall_tag_array = array_unique($overall_tag_array);
    	
    	// If more than 1 tag, add filter
    	if ( count( $overall_tag_array ) > 1 ) {
    	    		
	    	// Loop through tags and assemble the filter list
	    	$filter_list = "";
	    	if ( !empty ( $overall_tag_array ) ) {
	    		foreach( $overall_tag_array as $tag ) {    			
	    			$tag = get_term_by( 'slug', $tag, 'portfolio-tags' );
	    			$filter_list .= "<a href='#' class='tag-".$tag->slug."'>" . $tag->name . "</a>";
	    		}
	    	}
	    	
	    	if ( $filter_list ) {
	    		echo "<div class='portfolio-filter'><a href='#' class='tag-all current'>" . __('All','cudazi') . "</a>" . $filter_list . "</div>";
	    	}
		} // end if count > 1
		
		
		// Output Portfolio Items
		echo "<div class='portfolio-item-wrap'>" . $output . "</div>";
	}else{
		?><article class='portfolio-item sixteen alpha columns'>
		<p class='portfolio-item-meta'><?php _e( 'No Portfolio Items to Display', 'cudazi' ); ?></p>							
		</article>				
	<?php
	}
	
	
	// Load Navigation
	get_template_part( 'nav', 'post-loop' ); 


	// Get things back to normal
	wp_reset_query();
	
	
?>


<?php if ( ! $from_page_template ) { /* if page is not pulled through a page template, wrap in appropriate divs */ ?>
		</div><!--//columns-->	
	</div><!--//container-->
	<?php get_footer(); ?>
<?php } ?>