<?php
	/*
		Setup and init widget areas.
	*/
	
	if ( ! function_exists('cudazi_widgets_init' ) ) {
		function cudazi_widgets_init() {
			
			$default_before_widget = '<div id="%1$s" class="widget %2$s">';
			$default_after_widget = '</div>';
			$default_before_title = '<h3 class="widgettitle">';
			$default_after_title = '</h3>';
			
		
			register_sidebar( array(
				'name' => __( 'Column Two: All', 'cudazi' ),
				'id' => 'column-two-all',
				'description' => __( 'Appears in any template with a sidebar column except the 404 not found page.', 'cudazi' ),
				'before_widget' => $default_before_widget,
				'after_widget' => $default_after_widget,
				'before_title' => $default_before_title,
				'after_title' => $default_after_title
			) );
			
			
			register_sidebar( array(
				'name' => __( 'Column Two: Blog / Blog as Home', 'cudazi' ),
				'id' => 'column-two-blog',
				'description' => __( 'Appears when a static blog page is set in reading settings or when your home page is showing posts.', 'cudazi' ),
				'before_widget' => $default_before_widget,
				'after_widget' => $default_after_widget,
				'before_title' => $default_before_title,
				'after_title' => $default_after_title
			) );
			
			register_sidebar( array(
				'name' => __( 'Column Two: Home', 'cudazi' ),
				'id' => 'column-two-home',
				'description' => __( 'Appears when a static home page is set in reading settings and visiting that home page', 'cudazi' ),
				'before_widget' => $default_before_widget,
				'after_widget' => $default_after_widget,
				'before_title' => $default_before_title,
				'after_title' => $default_after_title
			) );
			
			
			
			
			register_sidebar( array(
				'name' => __( 'Column Two: Single Post', 'cudazi' ),
				'id' => 'column-two-single-post',
				'description' => __( 'Appears on a single post page', 'cudazi' ),
				'before_widget' => $default_before_widget,
				'after_widget' => $default_after_widget,
				'before_title' => $default_before_title,
				'after_title' => $default_after_title
			) );
			register_sidebar( array(
				'name' => __( 'Column Two: Single Page', 'cudazi' ),
				'id' => 'column-two-page',
				'description' => __( 'Appears on a single page template, except the home page.', 'cudazi' ),
				'before_widget' => $default_before_widget,
				'after_widget' => $default_after_widget,
				'before_title' => $default_before_title,
				'after_title' => $default_after_title
			) );
			
			
			register_sidebar( array(
				'name' => __( 'Column Two: Any Archive Page', 'cudazi' ),
				'id' => 'column-two-archive',
				'description' => __( 'When any type of Archive page is being displayed. Category, Tag, Author and Date based pages are all types of Archives.', 'cudazi' ),
				'before_widget' => $default_before_widget,
				'after_widget' => $default_after_widget,
				'before_title' => $default_before_title,
				'after_title' => $default_after_title
			) );
			register_sidebar( array(
				'name' => __( 'Column Two: 404 Page', 'cudazi' ),
				'id' => 'column-two-404',
				'description' => __( 'When a page displays after an "HTTP 404: Not Found" error occurs.', 'cudazi' ),
				'before_widget' => $default_before_widget,
				'after_widget' => $default_after_widget,
				'before_title' => $default_before_title,
				'after_title' => $default_after_title
			) );
			register_sidebar( array(
				'name' => __( 'Column Two: Logged in User', 'cudazi' ),
				'id' => 'column-two-logged-in',
				'description' => __( 'Appears in the sidebar when a user is logged in.', 'cudazi' ),
				'before_widget' => $default_before_widget,
				'after_widget' => $default_after_widget,
				'before_title' => $default_before_title,
				'after_title' => $default_after_title
			) );
			
			
			register_sidebar( array(
				'name' => __( 'Footer', 'cudazi' ),
				'id' => 'footer-bottom',
				'description' => __( 'Footer, designed for a text widget. Do not enter a widget title. Check the box to add a paragraph tag.', 'cudazi' ),
				'before_widget' => $default_before_widget,
				'after_widget' => $default_after_widget,
				'before_title' => '',
				'after_title' => ''
			) );
			
			
			
			
			
		}
	}
	
	/** Register sidebars by running cudazi_widgets_init() on the widgets_init hook. */
	add_action( 'widgets_init', 'cudazi_widgets_init' );
?>