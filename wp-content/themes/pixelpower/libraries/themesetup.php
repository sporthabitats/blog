<?php
	/** Tell WordPress to run cudazi_setup() when the 'after_setup_theme' hook is run. */
	add_action( 'after_setup_theme', 'cudazi_setup_theme' );
	
	if ( ! function_exists('cudazi_setup_theme' ) ) {
		function cudazi_setup_theme() {
	  
			
			// Add default posts and comments RSS feed links to head
			add_theme_support( 'automatic-feed-links' );
			
			// Post Formats
			add_theme_support( 'post-formats', 
				array( 
					'aside', 
					'gallery', 
					'link', 
					'image', 
					'quote', 
					'status', 
					'video', 
					'audio', 
					'chat' 
				) );
			
			// Custom background WP function
			add_custom_background();
			
			// Make theme available for translation
			// Translations can be filed in the /languages/ directory
			load_theme_textdomain( 'cudazi', TEMPLATEPATH . '/languages' );
			$locale = get_locale();
			$locale_file = TEMPLATEPATH . "/languages/$locale.php";
			if ( is_readable( $locale_file ) )
				require_once( $locale_file );
		
			// This theme uses wp_nav_menu() in one location.
			register_nav_menus( array(
				'primary' => __( 'Primary Menu', 'cudazi' )
			) );
			
			
			// Content Width
			if ( ! isset( $content_width ) ) $content_width = 780;
			
			
			// Editor CSS
			add_editor_style( array(
				'css/base.css',
				'css/skeleton.css',
				'css/screen.css'
			) );
			
		}
	}
?>