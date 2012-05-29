<?php




	//
	// Add Meta Boxes on Admin Init
	//	
	add_action("admin_init", "cudazi_admin_init");
	if ( ! function_exists('cudazi_admin_init' ) ) {
		function cudazi_admin_init(){						

			add_meta_box("cudazi_social_link_meta", __("Details","cudazi"), "cudazi_social_link_meta", "social_link", "normal", "default");
			
		}
	}
	
	
	
	//
	//	Save
	//
	add_action('save_post', 'cudazi_save_meta_box_content');
	if ( ! function_exists('cudazi_save_meta_box_content' ) ) {
		function cudazi_save_meta_box_content(){		
			global $post;
			if ( isset( $post ) ) {
				if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
					return $post->ID;
				} else {
					if ( isset( $post->post_type ) ) {
						if ( $post->post_type == 'social_link' ) {
							if ( isset( $_POST["social_link_url"] ) && isset( $_POST["social_link_icon"] ) )  {
								update_post_meta($post->ID, "social_link_url", $_POST["social_link_url"]);
								update_post_meta($post->ID, "social_link_icon", $_POST["social_link_icon"]);					
							}
						}
					}
				}
					
			}
		}
	}	
	
	
	
	//
	//	Meta Boxes
	//

	// Meta Box
	if ( ! function_exists('cudazi_social_link_meta' ) ) {
		function cudazi_social_link_meta(){		
			global $post;
			$custom = get_post_custom($post->ID);			
			if ( isset( $custom["social_link_url"][0] ) ) {
				$social_link_url = $custom["social_link_url"][0];
			}else{
				$social_link_url = "";
			}
			if ( isset( $custom["social_link_icon"][0] ) ) {
				$social_link_icon = $custom["social_link_icon"][0];				
			}else{
				$social_link_icon = "";			
			}						
			?>			
			<p><?php _e('Enter a link to your social profile such as: http://twitter.com/cudazi','cudazi'); ?></p> 
			<p><input type="text" style='width:300px; border-style:solid; border-width:1px;' name="social_link_url" value="<?php echo $social_link_url; ?>" /></p>		
			
			<?php
			// Get array of social icons
			$cz_icons = cudazi_get_icons('images/social_icons');	
				
			// Get radio button list of social icons
			echo cudazi_icon_radiolist('images/social_icons', $cz_icons, $social_link_icon);
			
			echo '<br /><p>' . __('Need more icons? Upload them to images/social_icons in this theme folder.', 'cudazi') . "</p>";
		}
	}
