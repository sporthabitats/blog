<?php
	
	
	// Register social_link post type
	add_action('init', 'social_register');
	if ( ! function_exists('social_register' ) ) {
		function social_register() {
			$labels = array(
				'name' => __('Social Links', 'cudazi'),
				'singular_name' => __('Social Link', 'cudazi'),
				'add_new' => __('Add New', 'cudazi'),
				'add_new_item' => __('Add New Item','cudazi'),
				'edit_item' => __('Edit Item','cudazi'),
				'new_item' => __('New Item','cudazi'),
				'view_item' => __('View Item','cudazi'),
				'search_items' => __('Search Social Links','cudazi'),
				'not_found' =>  __('Nothing found','cudazi'),
				'not_found_in_trash' => __('Nothing found in Trash','cudazi'),
				'parent_item_colon' => ''
			);
			$args = array(
				'labels' => $labels,
				'public' => false,
				'publicly_queryable' => false,
				'show_ui' => true,
				'query_var' => false,
				'menu_icon' => null,
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => null,
				'supports' => array('title')
			  ); 		
			register_post_type( 'social_link' , $args );		
		}		
	}

	
	// Register Portfolio post type
	add_action('init', 'portfolio_register');
	if ( ! function_exists('portfolio_register' ) ) {
		function portfolio_register() {
			$labels_portfolio = array(
				'add_new' => __('Add New', 'cudazi'),
				'add_new_item' => __('Add New Portfolio Post', 'cudazi'),
				'edit_item' => __('Edit Portfolio Post', 'cudazi'),
				'menu_name' => __('Portfolio', 'cudazi'),
				'name' => __('Portfolio', 'cudazi'),
				'new_item' => __('New Portfolio Post', 'cudazi'),
				'not_found' =>  __('No portfolio posts found', 'cudazi'),
				'not_found_in_trash' => __('No portfolio posts found in Trash', 'cudazi'), 
				'parent_item_colon' => '',
				'singular_name' => __('Portfolio Post', 'post type singular name', 'cudazi'),
				'search_items' => __('Search Portfolio Posts', 'cudazi'),
				'view_item' => __('View Portfolio Post', 'cudazi'),
			);
			$args_portfolio = array(
				'capability_type' => 'post',
				'has_archive' => true, 
				'hierarchical' => false,
				'labels' => $labels_portfolio,
				'menu_position' => 4,
				'public' => true,
				'publicly_queryable' => true,
				'query_var' => true,
				/* 'rewrite' => array( 'slug' => 'portfolio', 'with_front' => true ), <----- You can set this BUT can't have a page with a slug of portfolio. */
				'rewrite' => false,
				'show_in_menu' => true, 
				'show_ui' => true, 
				'supports' => array( 'comments', 'editor', 'excerpt', 'thumbnail', 'title' ),
			);
			register_post_type( 'portfolio', $args_portfolio );		
			flush_rewrite_rules();
		}		
	}
	
	


	// Portfolio Categories		
	$labels = array(
		'add_new_item' => __( 'Add New Category', 'cudazi'),
		'all_items' => __( 'All Categories', 'cudazi'),
		'edit_item' => __( 'Edit Category', 'cudazi'), 
		'name' => __( 'Portfolio Categories', 'taxonomy general name', 'cudazi'),
		'new_item_name' => __( 'New Genre Category', 'cudazi'),
		'menu_name' => __( 'Categories', 'cudazi'),
		'parent_item' => __( 'Parent Category', 'cudazi'),
		'parent_item_colon' => __( 'Parent Category:', 'cudazi'),
		'singular_name' => __( 'Portfolio Category', 'cudazi'),
		'search_items' =>  __( 'Search Categories', 'cudazi'),
		'update_item' => __( 'Update Category', 'cudazi'),
	);
	register_taxonomy( 'portfolio-category', array( 'portfolio' ), array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio/category' ),
		'show_ui' => true,
	));
	
	
	
	
	// Portfolio Tags		
	$labels = array(
		'add_new_item' => __( 'Add New Tag', 'cudazi'),
		'all_items' => __( 'All Tags', 'cudazi'),
		'edit_item' => __( 'Edit Tag', 'cudazi'), 
		'menu_name' => __( 'Portfolio Tags', 'cudazi'),
		'name' => __( 'Portfolio Tags', 'cudazi'),
		'new_item_name' => __( 'New Genre Tag', 'cudazi'),
		'parent_item' => __( 'Parent Tag', 'cudazi'),
		'parent_item_colon' => __( 'Parent Tag:', 'cudazi'),
		'singular_name' => __( 'Portfolio Tag', 'cudazi'),
		'search_items' =>  __( 'Search Tags', 'cudazi'),
		'update_item' => __( 'Update Tag', 'cudazi'),
	);
	register_taxonomy( 'portfolio-tags', array( 'portfolio' ), array(
		'hierarchical' => false,
		'labels' => $labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio/tag' ),
		'show_ui' => true,
	));	

