<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<title><?php wp_title( ' ', true, 'right' ); /* filtered in libraries/filers.php */ ?></title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.gif" />
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png" />
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	<![endif]-->

	<?php
		// See functions.php for CSS / JAVASCRIPT information
		wp_head(); // do not remove this		
	?>		
</head>
<body <?php body_class(); ?>>

	<div id="branding_wrap">
		<header id="branding">	
			<div class="container">
			
				<?php
					// Grab the column settings from theme settings to determine the logo/menu container sizes
					$logo_columns = $menu_columns = "eight";
					$header_layout = cudazi_get_option( 'header_layout', 'eight|eight' );
					$header_layout = explode('|', $header_layout);
					if ( is_array( $header_layout ) ) {
						$logo_columns = $header_layout[0];
						$menu_columns = $header_layout[1];
					}					
				?>
			
				<hgroup class="<?php echo $logo_columns; ?> columns">				
					<h1 id="logo"><?php echo cudazi_get_logo(); ?></h1>
					<?php if ( ! cudazi_get_option( 'disable_tagline', false ) ) { ?>
					<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
					<?php } ?>
				</hgroup>		
				<nav class="<?php echo $menu_columns; ?> columns" id="navigation" role="navigation">
					<?php wp_nav_menu( array( 'menu_class' => 'sf-menu clearfix', 'theme_location' => 'primary', 'fallback_cb' => 'cudazi_menu_fallback' ) ); ?>						
					<?php echo cudazi_alternate_menu( array( 'menu_name' => 'primary', 'display' => 'select' ) ); ?>
				</nav>
			</div><!--//container (skeleton) -->
		</header><!--//header-->
	</div>
		
	<section id="main">

