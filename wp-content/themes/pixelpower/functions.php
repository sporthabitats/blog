<?php
	
	
	
	
	// Load custom libraries used in theme
	$cudazi_libraries = 
		array( 
			'themesetup',
			'theme-options',			
			'debug',
			'filters',
			'shortcodes',
			'widget-areas',
			'featuredimages',
			'meta-boxes',
			'custom-post-types',
			'comments',
			'plugins/cudazi-twitter-widget',
			'plugins/cudazi-bio-widget'
		);
	foreach( $cudazi_libraries as $library ) {
		include_once( 'libraries/' . $library . '.php' );
	}
	
	

	
	// Theme and Version Information
	$cudazi_theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
	define('CUDAZI_THEME_NAME', $cudazi_theme_data['Title']);
	define('CUDAZI_THEME_AUTHOR', $cudazi_theme_data['Author']);
	define('CUDAZI_THEME_URI', $cudazi_theme_data['URI']);
	define('CUDAZI_THEME_VERSION', $cudazi_theme_data['Version']);
	define('CUDAZI_THEME_INFOLINE', CUDAZI_THEME_NAME . ' by ' . CUDAZI_THEME_AUTHOR . ' (' . CUDAZI_THEME_URI . ') v' . CUDAZI_THEME_VERSION);
	
	add_action('wp_footer','cudazi_display_themeinfo');
	if ( ! function_exists('cudazi_display_themeinfo' ) ) {
		function cudazi_display_themeinfo() {
			echo '<!-- ' . CUDAZI_THEME_INFOLINE . ' -->'; // Display for easier debugging remotely
		}
	}
	
	
	
	// Output via wp_head()
	add_action( 'wp_enqueue_scripts', 'cudazi_scripts');
	if ( ! function_exists( 'cudazi_scripts' ) ) {
		function cudazi_scripts() {
			
			// Register			
			wp_register_style('cudazi_skeleton_base', get_template_directory_uri() . '/css/base.css',false, CUDAZI_THEME_VERSION,'screen');			
			wp_register_style('cudazi_skeleton_grid', get_template_directory_uri() . '/css/skeleton.css',false, CUDAZI_THEME_VERSION,'screen');							
			wp_register_style('cudazi_googlefont', 'http://fonts.googleapis.com/css?family=Yellowtail',false, CUDAZI_THEME_VERSION,'screen');
			wp_register_style('cudazi_screen', get_template_directory_uri() . '/css/screen.css',false, CUDAZI_THEME_VERSION,'screen');
			wp_register_style('cudazi_print', get_template_directory_uri() . '/css/print.css',false, CUDAZI_THEME_VERSION,'print');
			wp_register_style('cudazi_style', get_bloginfo( 'stylesheet_url' ),false, CUDAZI_THEME_VERSION, 'screen');
			
			// Load CSS			
			wp_enqueue_style('cudazi_skeleton_base');
			wp_enqueue_style('cudazi_skeleton_grid');			
			wp_enqueue_style('cudazi_googlefont');
			wp_enqueue_style('cudazi_screen');
			wp_enqueue_style('cudazi_print');			
			wp_enqueue_style('cudazi_style');
		
			// Register Scripts						
			wp_register_script("cudazi_plugins_combined", get_template_directory_uri() . "/js/plugins-combined.js", false, CUDAZI_THEME_VERSION, false);
			wp_register_script("cudazi_general", get_template_directory_uri() . "/js/script.js", false, CUDAZI_THEME_VERSION, false);
			
			// Load Scripts
			if ( is_singular() && get_option( 'thread_comments' ) )	{ wp_enqueue_script( 'comment-reply' ); }
			wp_enqueue_script("jquery");
			wp_enqueue_script("cudazi_plugins_combined");
			wp_enqueue_script("cudazi_general");				
		}
	}
	
	
	
	
	// Admin JavaScript
	add_action( 'admin_print_scripts', 'cudazi_scripts_admin');
	if ( ! function_exists( 'cudazi_scripts_admin' ) ) {
		function cudazi_scripts_admin() {
			wp_enqueue_script( 'farbtastic' );
		}
	}
	
	// Admin CSS
	add_action( 'admin_print_styles', 'cudazi_styles_admin');
	if ( ! function_exists( 'cudazi_styles_admin' ) ) {
		function cudazi_styles_admin() {
			wp_enqueue_style( 'farbtastic' );
		}
	}
	
	
	
	
	// Remove Default Contact Form 7 CSS
	function disable_contact7_scripts() {
		wp_deregister_script( 'contact-form-7' );
	}
	add_action( 'wp_print_scripts', 'disable_contact7_scripts' );
	function disable_contact7_styles() {
		wp_deregister_style( 'contact-form-7' );
		wp_deregister_style( 'contact-form-7-rtl' );
	}
	add_action( 'wp_print_styles', 'disable_contact7_styles' );

	
	
	
	// Featured Image Function
	if ( ! function_exists( 'cudazi_featured_image' ) ) {
		function cudazi_featured_image( $params = array() ) {
			
			$image = $image_full = "";
			global $post;
			
			// Defaults
			$fallback_to_first_attached = false;
			$thumbnail_size = 'twelve';
			$full_size = 'full';
			$linkto = 'file';
			$hide_on_single = false;
			$img_w = $img_h = "";
			
			// Params, override defaults if set
			extract($params);
			
			if ( is_single() && $hide_on_single ) {
				// hidden on single post
				return false;
			}else{
					
				if ( has_post_thumbnail( $post->ID ) ) {
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $thumbnail_size );
					//$img_w = $image[1]; // use width later
					//$img_h = $image[2]; // use height later
					$image = $image[0];
					$image_full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $full_size );
					$image_full = $image_full[0];						
				}else {
					if ( $fallback_to_first_attached ) {					
						$args = array( 'post_type' => 'attachment', 'order' => 'ASC', 'orderby' => 'menu_order', 'post_mime_type' => 'image', 'numberposts' => 1, 'post_status' => null, 'post_parent' => $post->ID );
						$attachments = get_posts( $args );			
						if ($attachments) {
							foreach ( $attachments as $attachment ) {
								$image = wp_get_attachment_image_src( $attachment->ID, $thumbnail_size );
								$img_w = $image[1]; // use width later
								$img_h = $image[2]; // use height later
								$image = $image[0];								
								$image_full = wp_get_attachment_image_src( $attachment->ID, $full_size );
								$image_full = $image_full[0];
							} // foreach
						} // if attachments
					}
				}
				
				// Get Post URL if linking to post
				if ( $linkto == 'post' ) {
					$image_full = get_permalink();	
				}
				
				// Return HTML if image found
				if ( $image_full && $image ) { 
					return "<div class='featured-image'>
						<a href='". $image_full . "'>
							<img src='". $image . "' alt='" . the_title_attribute(array('echo'=>0)) . "' />
						</a>
					</div>";
				}else{ 
					return false; 
				}
			
			} // end if single / hide on single
			
		}
	}
	
	
	
	
	// Paginate_links() function wrapper
	if ( ! function_exists( 'cudazi_paginate' ) ) {
		function cudazi_paginate() {
			
			if ( get_option('permalink_structure') ) {
				global $wp_query, $wp_rewrite;
				$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
				$pagination = array(
					'base' => @add_query_arg('page','%#%'),
					'format' => '',
					'total' => $wp_query->max_num_pages,
					'current' => $current,
					'show_all' => false,
					'type' => 'plain',
					'prev_text'    => __('Previous','cudazi'),
					'next_text'    => __('Next','cudazi'),
				);
				if( $wp_rewrite->using_permalinks() ) $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
				if( !empty($wp_query->query_vars['s']) ) $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
				
				$page_links = paginate_links( $pagination );
				if ( $page_links ) {			
					echo $page_links;		
				}				
			}else{
				posts_nav_link( ' - ', false, false );
			}			
		}
	}



	// Fallback (Pre 3.0) menu system
	if ( ! function_exists('cudazi_menu_fallback' ) ) {
		function cudazi_menu_fallback() {
			$menu = "<ul class='sf-menu'>";
			$menu .= "<li><a href='#'>" . __( 'Add a menu in Apperance, Menus', 'cudazi' ) . "</a></li>";
			$menu .= "</ul>";
			echo $menu;
		}
	}
		

	
	// Return an array of icons
	if ( ! function_exists( 'cudazi_get_icons' ) ) {
		function cudazi_get_icons($path = 'images/social_icons') {
			$icons = array();			
			if ($handle = @opendir(TEMPLATEPATH . '/' . $path)) {
				while (false !== ($file = readdir($handle))) {
					if (preg_match("/^.*\.(jpg|jpeg|png|gif)$/i", $file)) {
						$icons[] = $file;						
					}					
				}
				closedir($handle);				
				return $icons;
			}
		}
	}


	
	
	// Return a radio button list of icons
	if ( ! function_exists( 'cudazi_icon_radiolist' ) ) {
		function cudazi_icon_radiolist($path = 'images/social_icons', $icon_array = array(), $selected_file = '' ) {			
			$list_of_icons = "";
			if ( $icon_array && is_array($icon_array) ) {
				foreach ( $icon_array as $icon) {					
					$checked = '';						
					if($icon == $selected_file){
						$checked = 'checked';
					}
					$list_of_icons .= "<label style='display:block; width: 50px; float: left;'><input type='radio' name='social_link_icon' value='".$icon."' " .$checked . " /><img src='".get_template_directory_uri() . "/" . $path . '/' . $icon . "' alt='".$icon."' style='padding-top: 10px; position: relative; top: 5px' /></label>";											
				}				
				return $list_of_icons . "<br clear='both' />";				
			} // is array			
		}
	}
	
	
	
	
	// Text or Image Logo
	if ( ! function_exists( 'cudazi_get_logo' ) ) {
		function cudazi_get_logo() {
			$logo = cudazi_get_option( 'logo_url', '' );
			if ( $logo ) {
				$logo = "<img src='" . esc_attr( $logo ) . "' alt='" . get_bloginfo( 'name' ) . "' />";
			}else{
				$logo = "<span class='textlogo'>" . get_bloginfo( 'name' ) . "</span>";
			}			
			return "<a href='". home_url() . "'>" . $logo . "</a>";
		}
	}
	
	
	
	// Alternate menu for small screens
	if ( ! function_exists( 'cudazi_alternate_menu' ) ) {
		function cudazi_alternate_menu( $args = array() ) {			

			$output = '';
			
			// Defaults
			$menu_name = 'primary';
			$display = 'select';
			
			// Grab and apply args from function
			extract($args);						
			
			if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
			
				$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );						
				$menu_items = wp_get_nav_menu_items( $menu->term_id );				
				$output = "<select id='navigation-small'>";
				$output .= "<option value='' selected='selected'>" . __('Go to...', 'cudazi') . "</option>";
				foreach ( (array) $menu_items as $key => $menu_item ) {
				    $title = $menu_item->title;
				    $url = $menu_item->url;
					    
				    if ( $menu_item->menu_item_parent ) {
						$title = ' - ' . $title;
				    }
				    $output .= "<option value='" . $url . "'>" . $title . '</option>';
				}
				$output .= '</select>';
		    }
	
			return $output;							
		}
	}
	
	
	// Fix or scroll the header, added directly to wp_head()
	if ( ! function_exists( 'cudazi_fixed_header' ) ) {
		function cudazi_fixed_header() {
			if ( cudazi_get_option( 'fixed_header', false ) == true ) { ?>
				<!-- Added via wp_head -->
				<style>
					#branding_wrap { position: fixed; top: 0; left: 0; width: 100%; z-index: 50; }
					#main { padding-top: 100px; }
					/*un-fix on small screens*/
					@media only screen and (max-width: 767px) {
						#branding_wrap { position: relative;	}
						#main { padding-top: 0; }
					}
				</style>
				<script>				
					/* <![CDATA[ */
						jQuery(function($) { 
							if ( ! $.browser.msie ) {
								$(window).scroll(function () { 		
									var scrollTop = $(document).scrollTop();		
									if ( scrollTop > 10 ) {
										$('#branding_wrap').fadeTo(500, .9);	
									}else{		
										$('#branding_wrap').fadeTo(500, 1);
									}
								});
							}
						});				
					/* ]]&gt; */
				</script>
				<!-- // Added via wp_head -->
				<?php
			}
		}
	}	
	add_action('wp_head','cudazi_fixed_header');
	
	
	// Dynamic CSS to add to wp_head()
	if ( ! function_exists( 'cudazi_dynamic_css' ) ) {
		function cudazi_dynamic_css() {
			$color_primary = cudazi_get_option( 'color_primary', false );
			if ( $color_primary ) { ?>
				<!-- Added via wp_head + theme settings -->
				<style>
					a, a:visited, a:hover, a:focus,
					.entry-title a:hover,
					.portfolio-item-meta a, a:link {
						color: <?php echo $color_primary; ?>; 
					}
					#branding {
						border-top-color: <?php echo $color_primary; ?>;
					}
					.post-format-icon {
						background-color: <?php echo $color_primary; ?>;
					}
				</style>
				<!-- // Added via wp_head + theme settings -->
				<?php
			}
		}
	}	
	add_action('wp_head','cudazi_dynamic_css');
	
	
	
	
	// Dynamic CSS to add to wp_head()
	if ( ! function_exists( 'cudazi_google_analytics_code' ) ) {
		function cudazi_google_analytics_code() {
			$google_analytics_code = cudazi_get_option( 'google_analytics_code', false );
			if ( $google_analytics_code ) { ?>
				<!-- Added via wp_footer + theme settings -->					
				<script type="text/javascript">
					var _gaq = _gaq || []; _gaq.push(['_setAccount', '<?php echo $google_analytics_code; ?>']); _gaq.push(['_trackPageview']);					
					(function() { var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s); })();					
				</script>					
				<!-- // Added via wp_footer + theme settings -->
				<?php
			}
		}
	}	
	add_action('wp_footer','cudazi_google_analytics_code');
	
	
	
	
	
	
?>