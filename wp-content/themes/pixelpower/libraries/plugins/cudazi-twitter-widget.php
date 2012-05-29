<?php
/*
* Plugin Name: Cudazi Custom Tweets Widget
* Description: Display latest tweets in a custom format.
* Version: 1.0
* Author: Cudazi
* Author URI: http://cudazi.com/
*/

class Cudazi_TweetsWidget extends WP_Widget {

    function Cudazi_TweetsWidget() {		
		$widget_options = array( 'description' => __( 'Reusable custom tweets by Cudazi.', 'cudazi') );
		$control_options = array( 'width' => 200, 'height' => 350 );
        parent::WP_Widget(false, $name = __( 'Cudazi Custom Tweets', 'cudazi'), $widget_options, $control_options );	
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$max = $instance['max'];
		$username = $instance['username'];
		$unique_id = 'latest-tweets-' . rand(1, 10000); // just in case more than one is on a page at a time
		
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title ) {
                        echo $before_title . $title . $after_title;						
					} ?>
                  <div id='<?php echo $unique_id; ?>'></div>
				<script type="text/javascript">
					/* <![CDATA[ */
						jQuery(function($) {
							$("#<?php echo $unique_id; ?>").tweet({								
								username: "<?php echo $username; ?>",
								count: <?php echo $max; ?>,								
								loading_text: "<?php _e( 'Loading tweets...', 'cudazi' ); ?>",							
								template: "{text}{time}"								
							});
						});
					/* ]]> */
                </script> 
              <?php echo $after_widget; ?>
        <?php
    }


	// Update Settings
    function update($new_instance, $old_instance) {				
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['max'] = strip_tags($new_instance['max']);
		$instance['username'] = strip_tags($new_instance['username']);
		return $instance;
    }

	
	// User Settings Form
    function form($instance) {		
    	
    	if ( ! isset( $instance['title'] ) ) {
    		$instance['title'] = __('Latest Tweets','cudazi');
    	}
    	if ( ! isset(  $instance['max'] ) ) {
    		$instance['max'] = 3;
    	}
    	if ( ! isset(  $instance['username'] ) ) {
    		$instance['username'] = 'envato';
    	}
    	
        $title = esc_attr($instance['title']);
		$max = esc_attr($instance['max']);
		$username = esc_attr($instance['username']);

        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'cudazi'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('max'); ?>"><?php _e('Maximum:', 'cudazi'); ?> <input class="widefat" id="<?php echo $this->get_field_id('max'); ?>" name="<?php echo $this->get_field_name('max'); ?>" type="text" value="<?php echo $max; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Twitter Username:', 'cudazi'); ?> <input class="widefat" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" type="text" value="<?php echo $username; ?>" /></label></p>
        <?php 
    }

}

// register Cudazi_TweetsWidget widget
add_action('widgets_init', create_function('', 'return register_widget("Cudazi_TweetsWidget");'));


?>