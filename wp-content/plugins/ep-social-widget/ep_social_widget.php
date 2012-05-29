<?php
/*
Plugin Name: EP Social Widget
Plugin URI: http://www.earthpeople.se
Description: Very small and easy to use widget and shortcode to display social icons on your site. Facebook, Twitter, Flickr, Google Plus, Youtube and RSS feed
Author: Mattias Hedman, Earth People AB
Version: 0.4.0
Author URI: http://www.earthpeople.se
*/

/**
* Shortcode
**/
function epsw_shortcode($args){
	$html = '<ul class="ep_social_widget" id="epSW_shortcode">';
	foreach($args as $network => $link) {
		$pattern1 = '/^http:\/\//'; //
		$pattern2 = '/^https:\/\//';
		
		$l = strip_tags($link);		
		if(preg_match($pattern1, $l) || preg_match($pattern2, $l)){
			$link = $l;
		} else {
			$link = 'http://'.$l;
		}

		$html .= '<li>';
		switch($network) {
			case 'gplus':
				$html .= '<a href="'.$link.'" target="_blank"><img src="'.plugins_url("icon-gplus.gif", __FILE__).'" alt="" /></a>';
				break;

			case 'twitter':
				$html .= '<a href="'.$link.'" target="_blank"><img src="'.plugins_url("icon-twitter.gif", __FILE__).'" alt="" /></a>';
				break;

			case 'facebook':
				$html .= '<a href="'.$link.'" target="_blank"><img src="'.plugins_url("icon-facebook.gif", __FILE__).'" alt="" /></a>';
				break;

			case 'flickr':
				$html .= '<a href="'.$link.'" target="_blank"><img src="'.plugins_url("icon-flickr.gif", __FILE__).'" alt="" /></a>';
				break;

			case 'youtube':
				$html .= '<a href="'.$link.'" target="_blank"><img src="'.plugins_url("icon-youtube.gif", __FILE__).'" alt="" /></a>';
				break;

			case 'rss':
				$html .= '<a href="'.get_bloginfo("rss2_url").'" target="_blank"><img src="'.plugins_url("icon-rss.gif", __FILE__).'" alt="" /></a>';
				break;
		}
		$html .= '</li>';
	}
	$html .= '</ul>';

	return $html;
}
add_shortcode('ep-social-widget', 'epsw_shortcode');

/**
* Widget
**/
// Load stylesheet and widget
add_action('wp_head','epSocialWidgetCss');
add_action('widgets_init','load_epSocialWidget');

// Register the widget
function load_epSocialWidget() {
	register_widget('epSocialWidget');
}

// Widget stylesheet
function epSocialWidgetCss() {
	echo '<link href="'.plugins_url('style.css', __FILE__).'" type="text/css" rel="stylesheet" media="screen" />';
}

class epSocialWidget extends WP_Widget{

	function epSocialWidget() {
		//Settings
		$widget_ops = array('classname'=>'epsocialwidget','description'=>__('Display social icons on your site.','epsocialwidget'));
		
		//Controll settings
		$control_ops = array('id_base' => 'epsocialwidget');
		
		//Create widget
		$this->WP_Widget('epsocialwidget',__('EP Social Widget'),$widget_ops,$control_ops);
		
	}
	
	// Widget frontend
	function widget($args,$instance) {
		extract($args);
		
		//User selected settings
		$title = $instance['title'];
		$facebook= $instance['facebook'];
		$twitter = $instance['twitter'];
		$flickr = $instance['flickr'];
		$rss = $instance['rss'];
		$gplus = $instance['gplus'];
		$youtube = $instance['youtube'];
		
		echo $before_widget;
		?>
		
		<div class="ep_social_widget">
			
			<?php echo $before_title . $title . $after_title; ?>
			
			<?php if($rss == 1) : ?>
			<a href="<?php bloginfo('rss2_url'); ?>" target="_blank"><img src="<?php echo plugins_url('icon-rss.gif', __FILE__); ?>" alt="" /></a>
			<?php endif; ?>
			
			<?php if($twitter) : ?>
			<a href="<?php echo $twitter; ?>" target="_blank"><img src="<?php echo plugins_url('icon-twitter.gif', __FILE__); ?>" alt="" /></a>
			<?php endif; ?>
			
			<?php if($facebook) : ?>
			<a href="<?php echo $facebook; ?>" target="_blank"><img src="<?php echo plugins_url('icon-facebook.gif', __FILE__); ?>" alt=""/></a>
			<?php endif; ?>
			
			<?php if($flickr) : ?>
			<a href="<?php echo $flickr; ?>" target="_blank"><img src="<?php echo plugins_url('icon-flickr.gif', __FILE__); ?>" alt="" /></a>
			<?php endif; ?>
			
			<?php if($gplus) : ?>
			<a href="<?php echo $gplus; ?>" target="_blank"><img src="<?php echo plugins_url('icon-gplus.gif', __FILE__); ?>" alt="" /></a>
			<?php endif; ?>
			
			<?php if($youtube) : ?>
			<a href="<?php echo $youtube; ?>" target="_blank"><img src="<?php echo plugins_url('icon-youtube.gif', __FILE__); ?>" alt="" /></a>
			<?php endif; ?>
		</div>
		
		<?php
		echo $after_widget;
	}
	
	// Widget update
	function update($new_instance,$instance) {
		$pattern1 = '/^http:\/\//'; //
		$pattern2 = '/^https:\/\//';
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['rss'] = strip_tags($new_instance['rss']);
		
		if(!empty($new_instance['twitter'])) {
			$tw = strip_tags($new_instance['twitter']);		
			if(preg_match($pattern1, $tw) || preg_match($pattern2, $tw)){
				$instance['twitter'] = $tw;
			} else {
				$instance['twitter'] = 'http://'.$tw;
			}
		} else {
			$instance['twitter'] = '';	
		}
		
		if(!empty($new_instance['facebook'])) {
			$fb = strip_tags($new_instance['facebook']);		
			if(preg_match($pattern1, $fb) || preg_match($pattern2, $fb)){
				$instance['facebook'] = $fb;
			} else {
				$instance['facebook'] = 'http://'.$fb;
			}
		} else {
			$instance['facebook'] = '';
		}
		
		if(!empty($new_instance['flickr'])) {
			$fl = strip_tags($new_instance['flickr']);		
			if(preg_match($pattern1, $fl) || preg_match($pattern2, $fl)){
				$instance['flickr'] = $fl;
			} else {
				$instance['flickr'] = 'http://'.$fl;
			}		
		} else {
			$instance['flickr'] = '';
		}
		
		if(!empty($new_instance['gplus'])) {
			$gp = strip_tags($new_instance['gplus']);		
			if(preg_match($pattern1, $gp) || preg_match($pattern2, $gp)){
				$instance['gplus'] = $gp;
			} else {
				$instance['gplus'] = 'http://'.$gp;
			}		
		} else {
			$instance['gplus'] = '';
		}
		
		if(!empty($new_instance['youtube'])) {
			$yt = strip_tags($new_instance['youtube']);		
			if(preg_match($pattern1, $yt) || preg_match($pattern2, $yt)){
				$instance['youtube'] = $yt;
			} else {
				$instance['youtube'] = 'http://'.$yt;
			}		
		} else {
			$instance['youtube'] = '';
		}
		
		return $instance;
	}

	// Widget backend
	function form($instance) {
		$default = array('title' =>'', 'twitter'=>'','facebook'=>'','flickr'=>'','rss'=>'', 'gplus'=>'', 'youtube'=>'');
		$instance = wp_parse_args((array)$instance,$default);
	?>
		<!-- TITLE -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php echo __('Title:'); ?></label>
			<br />
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		
		<!-- RSS -->
		<p>
			<label for="<?php echo $this->get_field_id('rss'); ?>"><?php echo __('Display rss link:'); ?></label>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" <?php if($instance['rss'] == 1): ?> checked="checked" <?php endif; ?> value="1" /> <?php echo __('Yes'); ?>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" <?php if($instance['rss'] == 0): ?> checked="checked" <?php endif; ?> value="0" /> <?php echo __('No'); ?>
		</p>
		
		<!-- Twitter -->
		<p>
			<label for="<?php echo $this->get_field_id('twitter'); ?>"><?php echo __('Twitter profile link:'); ?></label>
			<br />
			<input type="text" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" value="<?php echo $instance['twitter']; ?>" class="widefat" />
		</p>
		
		<!-- Facebook -->
		<p>
			<label for="<?php echo $this->get_field_id('facebook'); ?>"><?php echo __('Facebook profile/page/group link:'); ?></label>
			<br />
			<input type="text" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" value="<?php echo $instance['facebook']; ?>" class="widefat" />
		</p>
		
		<!-- Flickr -->
		<p>
			<label for="<?php echo $this->get_field_id('flickr'); ?>"><?php echo __('Flickr profile link:'); ?></label>
			<br />
			<input type="text" id="<?php echo $this->get_field_id('flickr'); ?>" name="<?php echo $this->get_field_name('flickr'); ?>" value="<?php echo $instance['flickr']; ?>" class="widefat" />
		</p>
		
		<!-- Google Plus -->
		<p>
			<label for="<?php echo $this->get_field_id('gplus'); ?>"><?php echo __('Google Plus profile/page link:'); ?></label>
			<br />
			<input type="text" id="<?php echo $this->get_field_id('gplus'); ?>" name="<?php echo $this->get_field_name('gplus'); ?>" value="<?php echo $instance['gplus']; ?>" class="widefat" />
		</p>
		
		<!-- Youtube -->
		<p>
			<label for="<?php echo $this->get_field_id('youtube'); ?>"><?php echo __('Youtube profile/page link:'); ?></label>
			<br />
			<input type="text" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" value="<?php echo $instance['youtube']; ?>" class="widefat" />
		</p>
	
	<?php
	
	}

}

?>