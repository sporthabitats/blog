<?php
/*
* Plugin Name: Cudazi Custom Bio Widget
* Description: Display author bio in site sidebar.
* Version: 1.0
* Author: Cudazi
* Author URI: http://cudazi.com/
*/

class Cudazi_BioWidget extends WP_Widget {

    function Cudazi_BioWidget() {		
		$widget_options = array( 'description' => __( 'Reusable custom widget by Cudazi.', 'cudazi') );
		$control_options = array( 'width' => 400, 'height' => 350 );
        parent::WP_Widget(false, $name = __( 'Cudazi Custom Bio', 'cudazi'), $widget_options, $control_options );	
    }

    function widget($args, $instance) {		
        extract( $args );
        
		$photo_url = $instance['photo_url'];
		$photo_linkto = $instance['photo_linkto'];
		$description = $instance['description'];
		
		
		
		//
		// Social Icons Post Type
		//		
		$social_args = array(
			'post_type' => 'social_link',
			'numberposts' => -0,
			'posts_per_page' => -1
		);
		$social_icon_output = "";
		$social_icons = get_posts( $social_args );
		
		foreach ( $social_icons as $icon ) {					
			$url = $icon_url = '';				
			$url = get_post_meta($icon->ID, 'social_link_url', true);
			$icon_url = get_template_directory_uri() . "/images/social_icons/" . get_post_meta($icon->ID, 'social_link_icon', true);									
			$social_icon_output .= "<li><a href='" . esc_url($url) . "' title='" . esc_attr($icon->post_title) . "'><img src='" . esc_url($icon_url) . "' alt='" . esc_attr($icon->post_title) . "' /></a></li>";
		}
		
		if ( $social_icon_output ) {
			$social_icon_output = "<ul class='bio-social-links'>" . $social_icon_output . "</ul>";
		}
		
		
        ?>
		<?php echo $before_widget; ?>

		<?php if ( $photo_url ) { ?>
			<div class="bio-photo-wrap">
				<?php if ( $photo_linkto ) { ?><a href="<?php echo esc_attr($photo_linkto); ?>"><?php } ?>
					<?php if ( $photo_url ) { ?><img src="<?php echo esc_attr($photo_url); ?>" alt="<?php bloginfo('name'); ?>" /><?php } ?>
				<?php if ( $photo_linkto ) { ?></a><?php } ?>
			</div>
		<?php } ?>
		
		<?php if ( $description || $social_icons ) { ?>
			<div class="bio-description-wrap clearfix">
				
				<?php if ( $description ) { ?>
					<div class="bio-description">
						<?php echo $description; ?>
					</div>
				<?php } ?>
				
				<?php echo $social_icon_output; ?>
				
			</div>
		<?php } ?>
		
		<?php echo $after_widget; ?>
		<?php
    }


	// Update Settings
    function update($new_instance, $old_instance) {				
		$instance = $old_instance;		
		$instance['photo_url'] = strip_tags($new_instance['photo_url']);
		$instance['photo_linkto'] = strip_tags($new_instance['photo_linkto']);
		$instance['description'] = $new_instance['description'];
		return $instance;
    }
	
	// User Settings Form
    function form($instance) {		
    	    	
    	if ( ! isset(  $instance['photo_url'] ) ) {
    		$instance['photo_url'] = '';
    	}
    	if ( ! isset(  $instance['photo_linkto'] ) ) {
    		$instance['photo_linkto'] = '';
    	}
    	if ( ! isset(  $instance['description'] ) ) {
    		$instance['description'] = '';
    	}
        
		$photo_url = esc_attr($instance['photo_url']);
		$photo_linkto = esc_attr($instance['photo_linkto']);
		$description = esc_html($instance['description']);

        ?>
            <p><?php _e('All fields optional. Social icons pull from the items you created using the Social Links custom post type in the main menu.','cudazi'); ?></p>            
            <p>
            	<label for="<?php echo $this->get_field_id('photo_url'); ?>"><?php _e('Photo URL:', 'cudazi'); ?> <input class="widefat" id="<?php echo $this->get_field_id('photo_url'); ?>" name="<?php echo $this->get_field_name('photo_url'); ?>" type="text" value="<?php echo $photo_url; ?>" /></label>
            	<br /><small><?php _e('Full image source/path. Image should be over 425px wide to fit in all layout options as the site resizes. Eg: http://dummyimage.com/420x525','cudazi'); ?></small>
            </p>
            <p>
            	<label for="<?php echo $this->get_field_id('photo_linkto'); ?>"><?php _e('Photo Links To:', 'cudazi'); ?> <input class="widefat" id="<?php echo $this->get_field_id('photo_linkto'); ?>" name="<?php echo $this->get_field_name('photo_linkto'); ?>" type="text" value="<?php echo $photo_linkto; ?>" /></label>
            	<br /><small><?php _e('Optional, allow the image above to be clickable.','cudazi'); ?></small>
            </p>
            <p>
            	<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Bio/ Description:', 'cudazi'); ?> <textarea cols="10" rows="3" class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" type="text"><?php echo $description; ?></textarea></label>
            	<br /><small><?php _e('Tell us a little about yourself!','cudazi'); ?></small>	
            </p>
            
        <?php 
    }

}

// register Cudazi_BioWidget widget
add_action('widgets_init', create_function('', 'return register_widget("Cudazi_BioWidget");'));
