<?php





	// [cudazi_message type='warning' close='Hide This']Warning, you are about to catch on fire.[/cudazi_message]
	function cudazi_message_sc($atts, $content = null) {
		extract(shortcode_atts(array(
			'type' => 'success',
			'close' => __( 'Hide', 'cudazi' )
		), $atts));
		
		$output = "<p class='". $type . " message rounded clearfix'>";
		
		if( $close) { 
			$output .= "<a class='hideparent right' href='#'>" . $close . "</a>";
		}
		$output .= $content . "</p>";
		
		return $output;
	}
	add_shortcode('cudazi_message', 'cudazi_message_sc');





	//
	// 	Columns
	//
	//	[column_start width='one_half']
	//		...content...	
	//	[column_end]
	//	[column_start width='one_half last']
	//		...content...
	//	[column_end]
	if ( ! function_exists( 'column_start_sc' ) ) {
		function column_start_sc( $atts ) {	
			extract(shortcode_atts(array(
				'width' => 'one_half'
			), $atts));		
			return "<div class='sc_column ". $width ."'>";
		}
		add_shortcode('column_start', 'column_start_sc');
	}
	if ( ! function_exists( 'column_end_sc' ) ) {
		function column_end_sc($atts, $content = null) {	
			extract(shortcode_atts(array(
				/* no attributes at this time */
			), $atts));		
			return "</div>";
		}
		add_shortcode('column_end', 'column_end_sc');
	}
	if ( ! function_exists( 'column_clear_sc' ) ) {
		function column_clear_sc($atts, $content = null) {	
			extract(shortcode_atts(array(
				/* no attributes at this time */
			), $atts));		
			return "<div class='clear'></div>";
		}
		add_shortcode('column_clear', 'column_clear_sc');
	}












	//
	// [raw] shortcode(filter) [/raw] to strip all auto formatting
	//
	
	// Remove the autop and wptexturize (in filters library) on all content
	// THEN add it all back in, except when using [raw] yourcontent [/raw]
	if ( ! function_exists( 'cudazi_strip_formatting' ) ) {
		function cudazi_strip_formatting($content) {
			$formatted_content = '';
			$pattern = "{(\[raw\].*?\[/raw\])}is";
			$contents = "{\[raw\](.*?)\[/raw\]}is";
			$arr_pieces = preg_split($pattern, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
			
			foreach ($arr_pieces as $piece) 
			{
				if (preg_match($contents, $piece, $matches)) 
				{
					$formatted_content .= $matches[1];
				} else {
					$formatted_content .= wptexturize(wpautop($piece));
				}
			}
			return $formatted_content;
		}
		// First, remove wpautop and wptexturize from the content
		// Then, add it in using cudazi_strip_formatting except on specific shortcodes	
		remove_filter('the_content', 'wpautop');
		remove_filter('the_content', 'wptexturize');
		add_filter('the_content', 'cudazi_strip_formatting', 1);
		add_filter('widget_text', 'cudazi_strip_formatting', 2);
	}
	
		
/**************************************************************************************************************************************************/		










?>