<?php

	
	
	// Remove wp_nav_menu container
	function my_wp_nav_menu_args( $args = '' ) {
		$args['container'] = false;
		return $args;
	}
	add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );



	// Surround content in [embed] shortcode	
	function add_video_embed_note($html, $url, $attr) {
		return "<!-- Embed Container -->
		<div class='embed-container'>" . $html . "</div>
		<!--//end embed-container-->";
	}
	add_filter('embed_oembed_html', 'add_video_embed_note', 10, 3);
	
	
	// Allow shortcodes in text widgets
	if ( ! is_admin() ) {
		add_filter('widget_text', 'do_shortcode');
	}
	
	
	// Nested Shortcodes
	add_filter('the_content', 'do_shortcode');
	
	
	// Filter the page title wp_title() in header.php
	if ( ! function_exists('cudazi_page_title' ) ) {
		function cudazi_page_title( $title ) { 
			$the_page_title = $title;
			if( ! $the_page_title ){
				$the_page_title = get_bloginfo("name");
			}else{
				$the_page_title = $the_page_title . " - " . get_bloginfo("name");
			}
			return $the_page_title .= " - ". get_bloginfo("description");
		} 
		add_filter('wp_title', 'cudazi_page_title');
	}


	// Remove inline styles printed when the gallery shortcode is used.
	if ( ! function_exists('cudazi_remove_gallery_css' ) ) {
		function cudazi_remove_gallery_css( $css ) {
			return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
		}
		add_filter( 'gallery_style', 'cudazi_remove_gallery_css' );
	}
	
	
	// Remove the jump that happens when a read more link is clicked
	if ( ! function_exists('cudazi_remove_readmore_jump' ) ) {
		function cudazi_remove_readmore_jump($link) {
			$offset = strpos($link, '#more-');
			if ($offset) {
				$end = strpos($link, '"',$offset);
			}
			if ($end) {
				$link = substr_replace($link, '', $offset, $end-$offset);
			}
			return $link;
		}
		add_filter('the_content_more_link', 'cudazi_remove_readmore_jump');
	}
	
	
?>