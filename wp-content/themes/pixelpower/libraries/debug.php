<?php
	//	Library: Debug
	//	Contains: Tools to help debug the theme or plugins


	// Log in as admin user, visit your site and go to: 
	// www.yoursite.com/?cudazi_debug=1 
	if ( ! function_exists('cudazi_debug_options' ) ) {
		function cudazi_debug_options() {
			global $cudazi_theme_options;
			if( ! empty($_GET["cudazi_debug"] ) && current_user_can('update_core') ) {
				if( $_GET["cudazi_debug"] == 1 ) {
					echo "<pre style='background:#fff;color:#000;'>";
					print_r($cudazi_theme_options);
					echo "</pre>";
				}
			}
		}
	}
	add_action('wp_head','cudazi_debug_options');
	
	
	// Output formatted array
	if ( ! function_exists('print_r_pre' ) ) {
		function print_r_pre($array) {
			echo "<pre>";
			print_r($array);
			echo "</pre>";
		}
	}
	
?>