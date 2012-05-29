<!-- Source: sidebar.php -->
<?php
	
	// General flag to see if any widget areas are in use
	$widgets_used = false;
	
	// Static home/blog set. Visiting blog page
	if ( is_home() || ( is_home() && is_front_page() ) ) {
		if ( is_active_sidebar( 'column-two-blog' ) ) {
			dynamic_sidebar( 'column-two-blog' );
			$widgets_used = true;
		}
	}
	
	// Static home/blog set. Visiting home page
	if ( is_front_page() && ! is_home() ) {
		if ( is_active_sidebar( 'column-two-home' ) ) {
			dynamic_sidebar( 'column-two-home' );
			$widgets_used = true;
		}
	}
	
	// A Single post page
	if ( is_single() ) {		
		if ( is_active_sidebar( 'column-two-single-post' ) ) {
			dynamic_sidebar( 'column-two-single-post' );
			$widgets_used = true;
		}	
	}
	
	// A Single Page
	// When any of the following return true: is_page()
	if ( is_page() && ! is_front_page() ) {
		if ( is_active_sidebar( 'column-two-page' ) ) {
			dynamic_sidebar( 'column-two-page' );
			$widgets_used = true;
		} 
	}

	// Any Archive Page 
	// When any type of Archive page is being displayed. Category, Tag, Author and Date based pages are all types of Archives. 
	if ( is_archive() ) {
		if ( is_active_sidebar( 'column-two-archive' ) ) {
			dynamic_sidebar( 'column-two-archive' );
			$widgets_used = true;
		} 
	}
	
	// A 404 Not Found Page 
	// When a page displays after an "HTTP 404: Not Found" error occurs. 
	if ( is_404() ) {
		if ( is_active_sidebar( 'column-two-404' ) ) {
			dynamic_sidebar( 'column-two-404' );
			$widgets_used = true;
		} 
	}
	
	// Display when user is logged in
	if ( is_user_logged_in() ) {
		if ( is_active_sidebar( 'column-two-logged-in' ) ) {
			dynamic_sidebar( 'column-two-logged-in' );
			$widgets_used = true;
		}
	}
	
	// Show everywhere except 404 page
	if ( ! is_404() ) {
		if ( is_active_sidebar( 'column-two-all' ) ) {
			dynamic_sidebar( 'column-two-all' );
			$widgets_used = true;
		} 
	}
	
	// If no widgets set and user is admin, display a message
	if ( $widgets_used && current_user_can('administrator') ) { /* reserved for future use*/ }
	
?>