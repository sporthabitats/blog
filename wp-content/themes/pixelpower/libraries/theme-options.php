<?php


add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );


// Init plugin options to white list our options
function theme_options_init(){
	register_setting( 'cudazi_options', 'cudazi_theme_options', 'theme_options_validate' );
}


// Load up the menu page
function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'cudazi' ), __( 'Theme Options', 'cudazi' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}


// Settings array()
$select_post_footer_cats_tags = array(
	'tags' => array(
		'value' =>	'tags',
		'label' => __( 'Display Tags', 'cudazi' )
	),
	'categories' => array(
		'value' =>	'categories',
		'label' => __( 'Display Categories', 'cudazi' )
	),
	'hide' => array(
		'value' =>	'hide',
		'label' => __( 'Display Nothing', 'cudazi' )
	)
);


// Settings array()
$select_portfolio_columns_default = array(
	'4' => array(
		'value' => '4',
		'label' => __( 'Four Columns', 'cudazi' )
	),
	'2' => array(
		'value' => '2',
		'label' => __( 'Two Columns', 'cudazi' )
	),
	'1' => array(
		'value' => '1',
		'label' => __( 'One Column', 'cudazi' )
	)
);


// Settings array()
$select_header_layout = array(
	'eight|eight' => array(
		'value' => 'eight|eight',
		'label' => __( 'Eight | Eight (Default)', 'cudazi' )
	),
	'one|fifteen' => array(
		'value' => 'one|fifteen',
		'label' => __( 'One | Fifteen', 'cudazi' )
	),
	'two|fourteen' => array(
		'value' => 'two|fourteen',
		'label' => __( 'Two | Fourteen', 'cudazi' )
	),
	'three|thirteen' => array(
		'value' => 'three|thirteen',
		'label' => __( 'Three | Thirteen', 'cudazi' )
	),
	'four|twelve' => array(
		'value' => 'four|twelve',
		'label' => __( 'Four | Twelve', 'cudazi' )
	),
	'five|eleven' => array(
		'value' => 'five|eleven',
		'label' => __( 'Five | Eleven', 'cudazi' )
	),
	'six|ten' => array(
		'value' => 'six|ten',
		'label' => __( 'Six | Ten', 'cudazi' )
	),
	'seven|nine' => array(
		'value' => 'seven|nine',
		'label' => __( 'Seven | Nine', 'cudazi' )
	),	
	'nine|seven' => array(
		'value' => 'nine|seven',
		'label' => __( 'Nine | Seven', 'cudazi' )
	),
	'ten|six' => array(
		'value' => 'ten|six',
		'label' => __( 'Ten | Six', 'cudazi' )
	),
	'eleven|five' => array(
		'value' => 'eleven|five',
		'label' => __( 'Eleven | Five', 'cudazi' )
	),
	'twelve|four' => array(
		'value' => 'twelve|four',
		'label' => __( 'Twelve | Four', 'cudazi' )
	),
	'thirteen|three' => array(
		'value' => 'thirteen|three',
		'label' => __( 'Thirteen | Three', 'cudazi' )
	),
	'fourteen|two' => array(
		'value' => 'fourteen|two',
		'label' => __( 'Fourteen | Two', 'cudazi' )
	),
	'fifteen|one' => array(
		'value' => 'fifteen|one',
		'label' => __( 'Fifteen | One', 'cudazi' )
	)
);



/**
 * Create the options page
 */
function theme_options_do_page() {
	global $select_post_footer_cats_tags, $select_portfolio_columns_default, $select_header_layout;

	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;

	?>
	<div class="wrap">	
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'cudazi' ) . "</h2>"; ?>
		<?php if ( false !== $_REQUEST['settings-updated'] ) : ?><div class="updated fade"><p><strong><?php _e( 'Options saved', 'cudazi' ); ?></strong></p></div><?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'cudazi_options' ); ?>
			<?php $options = get_option( 'cudazi_theme_options' ); ?>			
			
			<p><?php echo sprintf( __('Custom settings and options for the %s theme. Be sure to click the save options button after making any changes.','cudazi'), get_current_theme() ); ?></p>
			
			<h3><br /><?php _e('Header Settings and Style','cudazi'); ?></h3>
			
			<table class="form-table">
				

				<?php
				 $field_key = 'fixed_header';
				 if ( ! isset( $options[$field_key] ) )
				 	$options[$field_key] = '';
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Fixed Header', 'cudazi' ); ?></th>
					<td>
						<label class="description">
							<input id="<?php echo $field_key; ?>" name="cudazi_theme_options[<?php echo $field_key; ?>]" type="checkbox" value="1" <?php checked( '1', $options[$field_key] ); ?> /> <?php _e( 'Make the header fixed at the top of the page', 'cudazi' ); ?>
						</label>
					</td>
				</tr>




				<?php
				 $field_key = 'logo_url';
				 if ( ! isset( $options[$field_key] ) )
				 	$options[$field_key] = '';
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Full Logo URL', 'cudazi' ); ?></th>
					<td>
						<input id="<?php echo $field_key; ?>" class="regular-text" type="text" name="cudazi_theme_options[<?php echo $field_key; ?>]" value="<?php esc_attr_e( $options[$field_key] ); ?>" />
						<br />
						<span class="description"><?php _e( 'Enter the full URL to your custom logo.', 'cudazi' ); ?></span>
						<br />
						<span class="description"><?php _e( 'Tip: Upload it in the Media Library and then copy the given File URL. Position it exactly using #logo img {} in the css.', 'cudazi' ); ?></span>
					</td>
				</tr>
				
				
				<?php
				 $field_key = 'disable_tagline';
				 if ( ! isset( $options[$field_key] ) )
				 	$options[$field_key] = '';
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Tagline / Description', 'cudazi' ); ?></th>
					<td>
						<label class="description">
							<input id="<?php echo $field_key; ?>" name="cudazi_theme_options[<?php echo $field_key; ?>]" type="checkbox" value="1" <?php checked( '1', $options[$field_key] ); ?> /> <?php _e( 'Disable the tagline / blog description to make more room for the logo / menu.', 'cudazi' ); ?>
						</label>
					</td>
				</tr>
				
				
				
				
				<?php
				 $field_key = 'header_layout';
				 if ( ! isset( $options[$field_key] ) )
				 	$options[$field_key] = '';
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Header Layout', 'cudazi' ); ?></th>
					<td>
						<select name="cudazi_theme_options[<?php echo $field_key; ?>]">
							<?php
								$selected = $options[$field_key];
								$p = '';
								$r = '';
								foreach ( $select_header_layout as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<br />
						<span class="description"><?php _e( 'Control the sizes of the logo and menu containers. Default should be fine unless you have too many menu items, a long logo or long tagline/description.', 'cudazi' ); ?></span>
					</td>
				</tr>
				
				</table>
				
				
				
				<h3><br /><?php _e('General Site Style / Colors','cudazi'); ?></h3>				

				<table class="form-table">
				

				<?php				
				 $field_key = 'color_primary';
				 if ( ! isset( $options[$field_key] ) )
				 	$options[$field_key] = '';
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Primary Color', 'cudazi' ); ?></th>
					<td>
						<input id="<?php echo $field_key; ?>" class="regular-text" type="text" name="cudazi_theme_options[<?php echo $field_key; ?>]" value="<?php echo ( $options[$field_key] ? esc_attr_e( $options[$field_key] ) : '#' ); ?>" style='width: 150px;' />
						<div id="picker"></div>
						<br />
						<span class="description"><?php _e( 'Enter the color code you want used as the primary color.<br />Leave blank for default color. For making extensive CSS edits, set up a child theme.', 'cudazi' ); ?></span>
					</td>
				</tr>
				<script>
					jQuery(function($){
						var picker = $('#picker');
						var input = $('#color_primary');
						$(picker).hide();
							$(picker).farbtastic(input);
							$(input).click(function(){
								$(picker).fadeIn();
						});					    
					});
				</script>
				
				
				
				
				<tr valign="top"><th scope="row"><?php _e( 'Background Color or Image', 'cudazi' ); ?></th>
					<td><span class='description'><?php _e('Set the background color or image in appearance > background.','cudazi'); ?></span></td>
				</tr>
				
				<tr valign="top"><th scope="row"><?php _e( 'Dark or Alternate Styles', 'cudazi' ); ?></th>
					<td><span class='description'><?php _e("Install and activate any alternate <a href='http://codex.wordpress.org/Child_Themes'>child themes</a> to customize the site further.",'cudazi'); ?></span></td>
				</tr>
				
				
				
				</table>
				


				<h3><br /><?php _e('Other Settings / Information','cudazi'); ?></h3>

				
				
				<table class="form-table">


				<?php
				 $field_key = 'post_footer_cats_tags';
				 if ( ! isset( $options[$field_key] ) )
				 	$options[$field_key] = '';
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Post Footer', 'cudazi' ); ?></th>
					<td>
						<select name="cudazi_theme_options[<?php echo $field_key; ?>]">
							<?php
								$selected = $options[$field_key];
								$p = '';
								$r = '';

								foreach ( $select_post_footer_cats_tags as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<br />
						<span class="description"><?php _e( 'During post loop, show tags, categories or nothing in the post footer.', 'cudazi' ); ?></span>
					</td>
				</tr>
				
				
				
				<?php
				 $field_key = 'portfolio_columns_default';
				 if ( ! isset( $options[$field_key] ) )
				 	$options[$field_key] = '';
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Default Portfolio Columns', 'cudazi' ); ?></th>
					<td>
						<select name="cudazi_theme_options[<?php echo $field_key; ?>]">
							<?php
								$selected = $options[$field_key];
								$p = '';
								$r = '';
								foreach ( $select_portfolio_columns_default as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<br />
						<span class="description"><?php _e( "Override this using a <a href='http://codex.wordpress.org/Custom_Fields#Usage'>custom field</a> of columns (1, 2 or 4) on the portfolio page template. This setting affects the portfolio archive view.", 'cudazi' ); ?></span>
					</td>
				</tr>
				


				
				
				
				
				
				
				<?php
				 $field_key = 'google_analytics_code';
				 if ( ! isset( $options[$field_key] ) )
				 	$options[$field_key] = '';
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Google Analytics Code', 'cudazi' ); ?></th>
					<td>
						<input id="<?php echo $field_key; ?>" class="regular-text" type="text" name="cudazi_theme_options[<?php echo $field_key; ?>]" value="<?php esc_attr_e( $options[$field_key] ); ?>" />
						<br />
						<label class="description" for="<?php echo $field_key; ?>"><?php _e( 'Enter your Google Analytics Tracking code ID, eg: <code>UA-XXXXX-X</code>', 'cudazi' ); ?></label>
						<br />
						<span class='description'><?php _e("More analytics plugins: <a href='http://wordpress.org/extend/plugins/search.php?q=google+analytics'>Plugin Repository</a>.",'cudazi'); ?></span>
					</td>
				</tr>
				



				<?php
				/**
				 * A sample textarea option
				 */
				 $field_key = '';
				?>
				<?php /* ?>
				<tr valign="top"><th scope="row"><?php _e( 'A textbox', 'cudazi' ); ?></th>
					<td>
						<textarea id="cudazi_theme_options[sometextarea]" class="large-text" cols="50" rows="10" name="cudazi_theme_options[sometextarea]"><?php echo esc_textarea( $options['sometextarea'] ); ?></textarea>
						<label class="description" for="cudazi_theme_options[sometextarea]"><?php _e( 'Sample text box', 'cudazi' ); ?></label>
					</td>
				</tr>
			<?php */ ?>				
				
				
			</table>			
			<p class="submit"><input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'cudazi' ); ?>" /></p>			
			<br />
		</form>
	</div>
	<?php
}



/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {

	global $select_post_footer_cats_tags, $select_portfolio_columns_default, $select_header_layout;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['fixed_header'] ) )
		$input['fixed_header'] = null;
	$input['fixed_header'] = ( $input['fixed_header'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['logo_url'] = wp_filter_nohtml_kses( $input['logo_url'] );
	
	if ( $input['color_primary'] != '#' ) {
		$input['color_primary'] = wp_filter_nohtml_kses( $input['color_primary'] );
	}else{ $input['color_primary'] = null; }
	
	// Our select option must actually be in our array of select options	
	if ( ! array_key_exists( $input['portfolio_columns_default'], $select_portfolio_columns_default ) )
		$input['portfolio_columns_default'] = null;

	// Our select option must actually be in our array of select options	
	if ( ! array_key_exists( $input['post_footer_cats_tags'], $select_post_footer_cats_tags ) )
		$input['post_footer_cats_tags'] = null;
	
	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['disable_tagline'] ) )
		$input['disable_tagline'] = null;
	$input['disable_tagline'] = ( $input['disable_tagline'] == 1 ? 1 : 0 );
	
	// Safe, no html
	$input['google_analytics_code'] = wp_filter_nohtml_kses( $input['google_analytics_code'] );
	
	
	
	// return cleaned data
	return $input;
}
// the above was adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/




// Function to grab custom settings
if ( ! function_exists( 'cudazi_get_option' ) ) {
	function cudazi_get_option( $key = '', $default = '' ) {
		
		// Key must be set, otherwise just return nothing
		if ( ! $key ) {
			return false;
		}
		
		// Options from wp options table
		$option_arr = get_option( 'cudazi_theme_options' );

		// If the option array is actually an array		
		// Example - before the first save to the databse
		if ( is_array( $option_arr ) ) {
		
			// Check if the options array contains this key
			if ( array_key_exists( $key, $option_arr ) ) {
			
				// If the array key has a value
				if ( $option_arr[$key] ) {
					return $option_arr[$key];
				}else{
					// Key is empty, return the default
					return $default;
				}				
			}else{			
				// key does not exist
				return $default;
			}	
		}else{		
			// Option array is not set
			return $default;
		}			
	} // end function
} // end if function exists



