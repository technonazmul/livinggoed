<?php
/**
 * Houzez functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Houzez
 * @since Houzez 1.0
 * @author Waqas Riaz
 */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
global $wp_version;

/**
*	---------------------------------------------------------------------------------------
*	Define constants
*	---------------------------------------------------------------------------------------
*/
define( 'HOUZEZ_THEME_NAME', 'Houzez' );
define( 'HOUZEZ_THEME_SLUG', 'houzez' );
define( 'HOUZEZ_THEME_VERSION', '3.4.4' );
define( 'HOUZEZ_FRAMEWORK', get_template_directory() . '/framework/' );
define( 'HOUZEZ_WIDGETS', get_template_directory() . '/inc/widgets/' );
define( 'HOUZEZ_INC', get_template_directory() . '/inc/' );
define( 'HOUZEZ_TEMPLATE_PARTS', get_template_directory() . '/template-parts/' );
define( 'HOUZEZ_IMAGE', get_template_directory_uri() . '/img/' );
define( 'HOUZEZ_CSS_DIR_URI', get_template_directory_uri() . '/css/' );
define( 'HOUZEZ_JS_DIR_URI', get_template_directory_uri() . '/js/' );
/**
*	----------------------------------------------------------------------------------------
*	Set up theme default and register various supported features.
*	----------------------------------------------------------------------------------------
*/

if ( ! function_exists( 'houzez_setup' ) ) {
	
	function houzez_setup() {

		/* add title tag support */
		add_theme_support( 'title-tag' );

		/* Load child theme languages */
		load_theme_textdomain( 'houzez', get_stylesheet_directory() . '/languages' );

		/* load theme languages */
		load_theme_textdomain( 'houzez', get_template_directory() . '/languages' );

		/* Add default posts and comments RSS feed links to head */
		add_theme_support( 'automatic-feed-links' );

		//Add support for post thumbnails.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'houzez-gallery', 1170, 785, true);	
		add_image_size( 'houzez-item-image-1', 592, 444, true );
		add_image_size( 'houzez-top-v7', 780, 780, true );
		add_image_size( 'houzez-item-image-4', 758, 564, true );
		add_image_size( 'houzez-item-image-6', 584, 438, true );
		add_image_size( 'houzez-variable-gallery', 0, 600, false );
		add_image_size( 'houzez-map-info', 120, 90, true );
		add_image_size( 'houzez-image_masonry', 496, 9999, false ); // blog-masonry.php

		/**
		*	Register nav menus. 
		*/
		register_nav_menus(
			array(
				'top-menu' => esc_html__( 'Top Menu', 'houzez' ),
				'main-menu' => esc_html__( 'Main Menu', 'houzez' ),
				'main-menu-left' => esc_html__( 'Menu Left', 'houzez' ),
				'main-menu-right' => esc_html__( 'Menu Right', 'houzez' ),
				'mobile-menu-hed6' => esc_html__( 'Mobile Menu Header 6', 'houzez' ),
				'footer-menu' => esc_html__( 'Footer Menu', 'houzez' )
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(

		) );

		//remove gallery style css
		add_filter( 'use_default_gallery_style', '__return_false' );

		update_option( 'redux-framework_extendify_plugin_notice', 'hide' );
	
		/*
		 * Adds `async` and `defer` support for scripts registered or enqueued by the theme.
		 */
		$loader = new Houzez_Script_Loader();
		add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );
	}
}
add_action( 'after_setup_theme', 'houzez_setup' );


remove_filter( 'pre_user_description', 'wp_filter_kses' );
// Add sanitization for WordPress posts.
add_filter( 'pre_user_description', 'wp_filter_post_kses' );

/**
 *	---------------------------------------------------------------------
 *	Classes
 *	---------------------------------------------------------------------
 */
require_once( HOUZEZ_FRAMEWORK . 'classes/Houzez_Query.php' );
require_once( HOUZEZ_FRAMEWORK . 'classes/houzez_data_source.php' );
require_once( HOUZEZ_FRAMEWORK . 'classes/upgrade20.php');
require_once( HOUZEZ_FRAMEWORK . 'classes/script-loader.php');
require_once( HOUZEZ_FRAMEWORK . 'classes/houzez-lazy-load.php');
require_once( HOUZEZ_FRAMEWORK . 'admin/class-admin.php');

/**
 *	---------------------------------------------------------------------
 *	Hooks
 *	---------------------------------------------------------------------
 */
require_once( HOUZEZ_FRAMEWORK . 'template-hooks.php' );

/**
 *	---------------------------------------------------------------------
 *	Functions
 *	---------------------------------------------------------------------
 */
require_once( HOUZEZ_FRAMEWORK . 'functions/template-functions.php' );
//require_once( HOUZEZ_FRAMEWORK . 'functions/header-functions.php' );
//require_once( HOUZEZ_FRAMEWORK . 'functions/footer-functions.php' );
require_once( HOUZEZ_FRAMEWORK . 'functions/price_functions.php' );
require_once( HOUZEZ_FRAMEWORK . 'functions/helper_functions.php' );
require_once( HOUZEZ_FRAMEWORK . 'functions/search_functions.php' );
require_once( HOUZEZ_FRAMEWORK . 'functions/google_map_functions.php' );
require_once( HOUZEZ_FRAMEWORK . 'functions/open_street_map_functions.php' );
require_once( HOUZEZ_FRAMEWORK . 'functions/profile_functions.php' );
require_once( HOUZEZ_FRAMEWORK . 'functions/property_functions.php' );
require_once( HOUZEZ_FRAMEWORK . 'functions/emails-functions.php' );
require_once( HOUZEZ_FRAMEWORK . 'functions/blog-functions.php' );
require_once( HOUZEZ_FRAMEWORK . 'functions/membership-functions.php' );
require_once( HOUZEZ_FRAMEWORK . 'functions/cron-functions.php' );
require_once( HOUZEZ_FRAMEWORK . 'functions/property-expirator.php');
require_once( HOUZEZ_FRAMEWORK . 'functions/messages_functions.php');
require_once( HOUZEZ_FRAMEWORK . 'functions/property_rating.php');
require_once( HOUZEZ_FRAMEWORK . 'functions/menu-walker.php');
require_once( HOUZEZ_FRAMEWORK . 'functions/mobile-menu-walker.php');
require_once( HOUZEZ_FRAMEWORK . 'functions/review.php');
require_once( HOUZEZ_FRAMEWORK . 'functions/stats.php');
require_once( HOUZEZ_FRAMEWORK . 'functions/agency_agents.php');
require_once( HOUZEZ_FRAMEWORK . 'admin/menu/menu.php');


if ( class_exists( 'WooCommerce', false ) ) {
	require_once( HOUZEZ_FRAMEWORK . 'functions/woocommerce.php' );
}

require_once( get_template_directory() . '/template-parts/header/partials/favicon.php' );

require_once(get_theme_file_path('localization.php'));

/**
 *	---------------------------------------------------------------------------------------
 *	Yelp
 *	---------------------------------------------------------------------------------------
 */
require_once( get_template_directory() . '/inc/yelpauth/yelpoauth.php' );

/**
 *	---------------------------------------------------------------------------------------
 *	include metaboxes
 *	---------------------------------------------------------------------------------------
 */
if( houzez_theme_verified() ) {

	if( is_admin() ) {
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/property-metaboxes.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/property-additional-metaboxes.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/agency-metaboxes.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/agent-metaboxes.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/partner-metaboxes.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/testimonials-metaboxes.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/posts-metaboxes.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/packages-metaboxes.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/reviews-metaboxes.php' );
		//require_once( HOUZEZ_FRAMEWORK . 'metaboxes/project-metaboxes.php' );

		if( houzez_check_classic_editor () ) {
			require_once( get_theme_file_path('/framework/metaboxes/listings-templates-metaboxes-classic-editor.php') );
			require_once( get_theme_file_path('/framework/metaboxes/page-header-metaboxes-classic-editor.php') );
		} else {
			require_once( get_theme_file_path('/framework/metaboxes/listings-templates-metaboxes.php') );
			require_once( get_theme_file_path('/framework/metaboxes/page-header-metaboxes.php') );
		}

		
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/header-search-metaboxes.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/page-template-metaboxes.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/transparent-menu-metaboxes.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/taxonomies-metaboxes.php' );

		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/status-meta.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/type-meta.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/label-meta.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/cities-meta.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/state-meta.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/area-meta.php' );
		require_once( HOUZEZ_FRAMEWORK . 'metaboxes/metaboxes.php' );
	}
	
}


/**
 *	---------------------------------------------------------------------------------------
 *	Options Admin Panel
 *	---------------------------------------------------------------------------------------
 */
require_once( HOUZEZ_FRAMEWORK . 'options/remove-tracking-class.php' ); // Remove tracking
require_once( HOUZEZ_FRAMEWORK . 'options/houzez-option.php' );

if( ! function_exists( 'houzez_load_redux_config' ) ) {
	function houzez_load_redux_config() {
		if ( class_exists( 'ReduxFramework' ) ) {
			require_once(get_theme_file_path('/framework/options/houzez-options.php'));
			require_once(get_theme_file_path('/framework/options/main.php'));
		}
	}
}
add_action('after_setup_theme', 'houzez_load_redux_config', 20);


/**
 *	----------------------------------------------------------------
 *	Enqueue scripts and styles.
 *	----------------------------------------------------------------
 */
require_once( HOUZEZ_INC . 'register-scripts.php' );

/**
 *	----------------------------------------------------
 *	TMG plugin activation
 *	----------------------------------------------------
 */
require_once( HOUZEZ_FRAMEWORK . 'class-tgm-plugin-activation.php' );
require_once( HOUZEZ_FRAMEWORK . 'register-plugins.php' );

/**
 *	----------------------------------------------------------------
 *	Better JPG and SSL 
 *	----------------------------------------------------------------
 */
require_once( HOUZEZ_FRAMEWORK . 'thumbnails/better-jpgs.php');
require_once( HOUZEZ_FRAMEWORK . 'thumbnails/honor-ssl-for-attachments.php');

/**
 *	-----------------------------------------------------------------------------------------
 *	Styling
 *	-----------------------------------------------------------------------------------------
 */
if ( class_exists( 'ReduxFramework' ) ) {
	require_once( get_template_directory() . '/inc/styling-options.php' );
}

if ( houzez_check_elementor_installed() ) {
	require get_template_directory() . '/inc/blocks/blocks.php';
}

/**
 *	---------------------------------------------------------------------------------------
 *	Widgets
 *	---------------------------------------------------------------------------------------
 */
require_once(get_theme_file_path('/framework/widgets/about.php'));
require_once(get_theme_file_path('/framework/widgets/code-banner.php'));
require_once(get_theme_file_path('/framework/widgets/mortgage-calculator.php'));
require_once(get_theme_file_path('/framework/widgets/image-banner-300-250.php'));
require_once(get_theme_file_path('/framework/widgets/contact.php'));
require_once(get_theme_file_path('/framework/widgets/properties.php'));
require_once(get_theme_file_path('/framework/widgets/featured-properties.php'));
require_once(get_theme_file_path('/framework/widgets/properties-viewed.php'));
require_once(get_theme_file_path('/framework/widgets/property-taxonomies.php'));
require_once(get_theme_file_path('/framework/widgets/latest-posts.php'));
require_once(get_theme_file_path('/framework/widgets/agents-search.php'));
require_once(get_theme_file_path('/framework/widgets/agency-search.php'));
require_once(get_theme_file_path('/framework/widgets/advanced-search.php'));


 /**
 *	---------------------------------------------------------------------------------------
 *	Set up the content width value based on the theme's design.
 *	---------------------------------------------------------------------------------------
 */
if( !function_exists('houzez_content_width') ) {
	function houzez_content_width()
	{
		$GLOBALS['content_width'] = apply_filters('houzez_content_width', 1170);
	}

	add_action('after_setup_theme', 'houzez_content_width', 0);
}

/**
 *	------------------------------------------------------------------
 *	Visual Composer
 *	------------------------------------------------------------------
 */
if (is_plugin_active('js_composer/js_composer.php') && is_plugin_active('houzez-theme-functionality/houzez-theme-functionality.php') ) {

	if( !function_exists('houzez_include_composer') ) {
		function houzez_include_composer()
		{
			require_once(get_template_directory() . '/framework/vc_extend.php');
		}

		add_action('init', 'houzez_include_composer', 9999);
	}

	// Filter to replace default css class names for vc_row shortcode and vc_column
	if( !function_exists('houzez_custom_css_classes_for_vc_row_and_vc_column') ) {
		//add_filter('vc_shortcodes_css_class', 'houzez_custom_css_classes_for_vc_row_and_vc_column', 10, 2);
		function houzez_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag)
		{
			if ($tag == 'vc_row' || $tag == 'vc_row_inner') {
				$class_string = str_replace('vc_row-fluid', 'row-fluid', $class_string);
				$class_string = str_replace('vc_row', 'row', $class_string);
				$class_string = str_replace('wpb_row', '', $class_string);
			}
			if ($tag == 'vc_column' || $tag == 'vc_column_inner') {
				$class_string = preg_replace('/vc_col-sm-(\d{1,2})/', 'col-sm-$1', $class_string);
				$class_string = str_replace('wpb_column', '', $class_string);
				$class_string = str_replace('vc_column_container', '', $class_string);
			}
			return $class_string;
		}
	}

}

/*-----------------------------------------------------------------------------------*/
/*	Register blog sidebar, footer and custom sidebar
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_widgets_init') ) {
	add_action('widgets_init', 'houzez_widgets_init');
	function houzez_widgets_init()
	{
		register_sidebar(array(
			'name' => esc_html__('Default Sidebar', 'houzez'),
			'id' => 'default-sidebar',
			'description' => esc_html__('Widgets in this area will be shown in the blog sidebar.', 'houzez'),
			'before_widget' => '<div id="%1$s" class="widget widget-wrap %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => esc_html__('Property Listings', 'houzez'),
			'id' => 'property-listing',
			'description' => esc_html__('Widgets in this area will be shown in property listings sidebar.', 'houzez'),
			'before_widget' => '<div id="%1$s" class="widget widget-wrap %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => esc_html__('Search Sidebar', 'houzez'),
			'id' => 'search-sidebar',
			'description' => esc_html__('Widgets in this area will be shown in search result page.', 'houzez'),
			'before_widget' => '<div id="%1$s" class="widget widget-wrap %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => esc_html__('Single Property', 'houzez'),
			'id' => 'single-property',
			'description' => esc_html__('Widgets in this area will be shown in single property sidebar.', 'houzez'),
			'before_widget' => '<div id="%1$s" class="widget widget-wrap %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => esc_html__('Page Sidebar', 'houzez'),
			'id' => 'page-sidebar',
			'description' => esc_html__('Widgets in this area will be shown in page sidebar.', 'houzez'),
			'before_widget' => '<div id="%1$s" class="widget widget-wrap %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => esc_html__('Agency Sidebar', 'houzez'),
			'id' => 'agency-sidebar',
			'description' => esc_html__('Widgets in this area will be shown in agencies template and agency detail page.', 'houzez'),
			'before_widget' => '<div id="%1$s" class="widget widget-wrap %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => esc_html__('Agent Sidebar', 'houzez'),
			'id' => 'agent-sidebar',
			'description' => esc_html__('Widgets in this area will be shown in agents template and angent detail page.', 'houzez'),
			'before_widget' => '<div id="%1$s" class="widget widget-wrap %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => esc_html__('Mobile Menu', 'houzez'),
			'id' => 'hz-mobile-menu',
			'description' => esc_html__('Widgets in this area will be shown in the mobile menu', 'houzez'),
			'before_widget' => '<div id="%1$s" class="widget widget-wrap %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => esc_html__('Custom Widget Area 1', 'houzez'),
			'id' => 'hz-custom-widget-area-1',
			'description' => esc_html__('You can assign this widget are to any page.', 'houzez'),
			'before_widget' => '<div id="%1$s" class="widget widget-wrap %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => esc_html__('Custom Widget Area 2', 'houzez'),
			'id' => 'hz-custom-widget-area-2',
			'description' => esc_html__('You can assign this widget are to any page.', 'houzez'),
			'before_widget' => '<div id="%1$s" class="widget widget-wrap %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => esc_html__('Custom Widget Area 3', 'houzez'),
			'id' => 'hz-custom-widget-area-3',
			'description' => esc_html__('You can assign this widget are to any page.', 'houzez'),
			'before_widget' => '<div id="%1$s" class="widget widget-wrap %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => esc_html__('Footer Area 1', 'houzez'),
			'id' => 'footer-sidebar-1',
			'description' => esc_html__('Widgets in this area will be show in footer column one', 'houzez'),
			'before_widget' => '<div id="%1$s" class="footer-widget widget widget-wrap %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => esc_html__('Footer Area 2', 'houzez'),
			'id' => 'footer-sidebar-2',
			'description' => esc_html__('Widgets in this area will be show in footer column two', 'houzez'),
			'before_widget' => '<div id="%1$s" class="footer-widget widget widget-wrap %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => esc_html__('Footer Area 3', 'houzez'),
			'id' => 'footer-sidebar-3',
			'description' => esc_html__('Widgets in this area will be show in footer column three', 'houzez'),
			'before_widget' => '<div id="%1$s" class="footer-widget widget widget-wrap %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => esc_html__('Footer Area 4', 'houzez'),
			'id' => 'footer-sidebar-4',
			'description' => esc_html__('Widgets in this area will be show in footer column four', 'houzez'),
			'before_widget' => '<div id="%1$s" class="footer-widget widget widget-wrap %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
	}
}

/**
 *	---------------------------------------------------------------------
 *	Disable emoji scripts
 *	---------------------------------------------------------------------
 */
if( !function_exists('houzez_disable_emoji') ) {
	function houzez_disable_emoji() {
		if ( ! is_admin() && houzez_option( 'disable_emoji', 0 ) ) {
			remove_action('wp_head', 'print_emoji_detection_script', 7);
			remove_action('wp_print_styles', 'print_emoji_styles');
		}
	}
	houzez_disable_emoji();
}


/**
 *	---------------------------------------------------------------------
 *	Remove jQuery migrate.
 *	---------------------------------------------------------------------
 */
if( !function_exists('houzez_remove_jquery_migrate') ) {
	function houzez_remove_jquery_migrate( $scripts ) {
		if ( ! houzez_option( 'disable_jquery_migrate', 0 ) ) return;
		if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
			$script = $scripts->registered['jquery'];

			if ( $script->deps ) { // Check whether the script has any dependencies.
				$script->deps = array_diff( $script->deps, array(
					'jquery-migrate',
				) );
			}
		}
	}
	//add_action( 'wp_default_scripts', 'houzez_remove_jquery_migrate' );
}


if( !function_exists('houzez_js_async_attr')) {
	function houzez_js_async_attr($url){
	 
		# Do not add defer or async attribute to these scripts
		$scripts_to_exclude = array('jquery.js');
		
		//if ( is_user_logged_in() ) return $url;
		if ( is_admin() || houzez_is_dashboard() || is_preview() || houzez_option('defer_async_enabled', 0 ) == 0 ) return $url;
		
		foreach($scripts_to_exclude as $exclude_script){
		    if(true == strpos($url, $exclude_script ) )
		    return $url;    
		}
		 
		# Defer or async all remaining scripts not excluded above
		return str_replace( ' src', ' defer src', $url );
	}
	//add_filter( 'script_loader_tag', 'houzez_js_async_attr', 10 );
}

if( !function_exists('houzez_instantpage_script_loader_tag')) {
	function houzez_instantpage_script_loader_tag( $tag, $handle ) {
	  if ( 'houzez-instant-page' === $handle && houzez_option('preload_pages', 1) ) {
	    $tag = str_replace( 'text/javascript', 'module', $tag );
	  }
	  return $tag;
	}
	add_filter( 'script_loader_tag', 'houzez_instantpage_script_loader_tag', 10, 2 );
}

if(!function_exists('houzez_hide_admin_bar')) {
	function houzez_hide_admin_bar($bool) {
	  
	  if ( !current_user_can('administrator') && !is_admin() ) {
	  		return false;

	  } else if ( houzez_is_dashboard() ) :
	    return false;

	  else :
	    return $bool;
	  endif;
	}
	add_filter('show_admin_bar', 'houzez_hide_admin_bar');
}

if ( !function_exists( 'houzez_block_users' ) ) {

	add_action( 'admin_init', 'houzez_block_users' );

	function houzez_block_users() {
		$users_admin_access = houzez_option('users_admin_access');

		if( is_user_logged_in() && $users_admin_access && !houzez_is_demo() ) {
			
			if (is_admin() && !current_user_can('administrator') && isset( $_GET['action'] ) != 'delete' && !(defined('DOING_AJAX') && DOING_AJAX)) {
				wp_die(esc_html("You don't have permission to access this page.", "Houzez"));
				exit;
			}
		}
	}

}

if( !function_exists('houzez_unset_default_templates') ) {
	function houzez_unset_default_templates( $templates ) {
		if( !is_admin() ) {
			return $templates;
		}
		$houzez_templates = houzez_option('houzez_templates');

		if( !empty($houzez_templates) ) {
			foreach ($houzez_templates as $template) {
				unset( $templates[$template] );
			}
		}
	    
	    return $templates;
	}
	add_filter( 'theme_page_templates', 'houzez_unset_default_templates' );
}

if(!function_exists('houzez_author_pre_get')) {
	function houzez_author_pre_get( $query ) {
	    if ( $query->is_author() && $query->is_main_query() && !is_admin() ) :
	        $query->set( 'posts_per_page', houzez_option('num_of_agent_listings', 10) );
	        $query->set( 'post_type', array('property') );
	    endif;
	}
	add_action( 'pre_get_posts', 'houzez_author_pre_get' );
}

add_action ('redux/options/houzez_options/saved', 'houzez_save_custom_options_for_cron');
if( ! function_exists('houzez_save_custom_options_for_cron') ) {
    function houzez_save_custom_options_for_cron() {

    	
        $insights_removal = houzez_option('insights_removal', '60');
        $custom_days = houzez_option('custom_days', '90');
        
        update_option('houzez_insights_removal', $insights_removal);
        update_option('houzez_custom_days', $custom_days);

    }
}

if( ! function_exists( 'houzez_is_mobile_filter' ) ) {
	function houzez_is_mobile_filter( $is_mobile ) {
		if ( empty( $_SERVER['HTTP_USER_AGENT'] ) ) {
			$is_mobile = false;
		} elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Mobile' ) !== false // Many mobile devices (all iPhone, iPad, etc.)
			|| strpos( $_SERVER['HTTP_USER_AGENT'], 'Android' ) !== false
			|| strpos( $_SERVER['HTTP_USER_AGENT'], 'Silk/' ) !== false
			|| strpos( $_SERVER['HTTP_USER_AGENT'], 'Kindle' ) !== false
			|| strpos( $_SERVER['HTTP_USER_AGENT'], 'BlackBerry' ) !== false
			|| strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' ) !== false
			|| strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mobi' ) !== false ) {
				$is_mobile = true;
		} else {
			$is_mobile = false;
		}
		return $is_mobile ;
	}
	//add_filter( 'wp_is_mobile', 'houzez_is_mobile_filter' );
}

if( ! function_exists('houzez_update_existing_users_with_manager_role_once') ) {
	function houzez_update_existing_users_with_manager_role_once() {
	    // Check if the update has already been done
	    if (get_option('houzez_manager_role_updated')) {
	        return; // Exit if already run
	    }

	    // Fetch all users with the houzez_manager role
	    $args = [
	        'role' => 'houzez_manager'
	    ];
	    $users = get_users($args);

	    foreach ($users as $user) {
	        // Ensure each user has the houzez_manager role, which now has updated capabilities
	        $user->add_role('houzez_manager');
	    }

	    // Set an option to indicate the update has been run
	    update_option('houzez_manager_role_updated', true);
	}

	// Run the function to update users
	houzez_update_existing_users_with_manager_role_once();
}


/**
 * Task Management System for WordPress
 * Include this code in your theme's `functions.php` file.
 */




// Enqueue FullCalendar scripts and styles
function enqueue_fullcalendar_scripts() {
    //wp_enqueue_style('fullcalendar-style', 'https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.css', [], '3.8.0');
    wp_enqueue_script('jquery');
    wp_enqueue_script('moment-js', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js', ['jquery'], '2.29.4', true);
    wp_enqueue_script('fullcalendar-js', 'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js', ['jquery', 'moment-js'], '3.8.0', true);
    wp_enqueue_script('tasks-management-js', get_template_directory_uri() . '/js/en.js', ['jquery', 'fullcalendar-en-js'], time(), true);
    wp_enqueue_script('tasks-management-js', get_template_directory_uri() . '/js/tasks-management.js', ['jquery', 'fullcalendar-js'], time(), true);
}
add_action('wp_enqueue_scripts', 'enqueue_fullcalendar_scripts');



// Handle AJAX requests for fetching and managing tasks
add_action('wp_ajax_fetch_tasks', 'fetch_tasks');
add_action('wp_ajax_save_task', 'save_task');
add_action('wp_ajax_delete_task', 'delete_task');

// Fetch tasks from the database
function fetch_tasks() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tasks';
    $tasks = $wpdb->get_results("SELECT * FROM $table_name");

    $events = [];
    foreach ($tasks as $task) {
        $events[] = [
            'id' => $task->id,
            'title' => $task->task_name,
            'start' => $task->start_date,
            'end' => $task->due_date,
            'description' => $task->task_description,
            'category' => $task->task_category,
            'user_id' => json_decode($task->user_id),  // Decode JSON
            'lead_id' => json_decode($task->lead_id),  // Decode JSON
            'property_id' => $task->property_id,
            'remind_before' => $task->remind_before,
            'task_category' => $task->task_category,
            'task_duration' => $task->task_duration,
            'task_status' => $task->task_status,
            'task_repeat' => $task->task_repeat,
            'task_address' => $task->task_address,
        ];
    }

    wp_send_json($events);
}


// Save a task to the database
function save_task() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tasks';

    // Sanitize and retrieve form data
    $formData = [
        'task_name' => sanitize_text_field($_POST['task_name'] ?? ''),
        'user_id' => json_encode(array_map('intval', $_POST['user_id'] ?? [])),  // Store as JSON
        'lead_id' => json_encode(array_map('intval', $_POST['lead_id'] ?? [])),  // Store as JSON
        'property_id' => sanitize_text_field($_POST['property_id'] ?? null),
        'remind_before' => sanitize_text_field($_POST['remind_before'] ?? null),
        'task_category' => sanitize_text_field($_POST['task_category'] ?? ''),
        'start_date' => sanitize_text_field($_POST['start_date'] ?? null),
        'due_date' => sanitize_text_field($_POST['due_date'] ?? null),
        'task_duration' => intval($_POST['task_duration'] ?? null),
        'task_description' => sanitize_textarea_field($_POST['task_description'] ?? ''),
        'task_status' => sanitize_text_field($_POST['task_status'] ?? 'Pending'),
        'task_repeat' => sanitize_text_field($_POST['task_repeat'] ?? 'does_not_repeat'),
        'task_address' => sanitize_text_field($_POST['task_address'] ?? ''),
    ];

    $task_id = intval($_POST['task_id'] ?? 0);

    if ($task_id) {
        // Update task
        $wpdb->update(
            $table_name,
            $formData,
            ['id' => $task_id],
            array_fill(0, count($formData), '%s'),
            ['%d']
        );
    } else {
        // Insert new task
        $wpdb->insert(
            $table_name,
            $formData,
            array_fill(0, count($formData), '%s')
        );
    }

	
	 // Send emails to users
	 $user_ids = json_decode($formData['user_id'], true);
	 foreach ($user_ids as $user_id) {
		 $user_info = get_userdata($user_id);
		 if ($user_info && !empty($user_info->user_email)) {
			 $email = $user_info->user_email;
			 $subject = "New Task Assigned: " . $formData['task_name'];
			 $message = "Hello {$user_info->display_name},\n\n";
			 $message .= "You have been assigned a new task:\n";
			 $message .= "Task Name: " . $formData['task_name'] . "\n";
			 $message .= "Description: " . $formData['task_description'] . "\n";
			 $message .= "Start Date: " . $formData['start_date'] . "\n";
			 $message .= "Due Date: " . $formData['due_date'] . "\n";
			 $message .= "\nPlease log in to your account to view more details.\n\n";
			 $message .= "Thank you.";
 
			 // Send email
			 wp_mail($email, $subject, $message);
		 }
	 }
	 $leads_table = $wpdb->prefix . 'houzez_crm_leads';


	 // Send emails to leads
    $lead_ids = json_decode($formData['lead_id'], true);
    foreach ($lead_ids as $lead_id) {
        $lead = $wpdb->get_row($wpdb->prepare("SELECT display_name, email FROM $leads_table WHERE id = %d", $lead_id), ARRAY_A);

        if ($lead && !empty($lead['email'])) {
            $email = $lead['email'];
            $subject = "New Task Related to You: " . $formData['task_name'];
            $message = "Hello {$lead['display_name']},\n\n";
            $message .= "A new task related to you has been created:\n";
            $message .= "Task Name: " . $formData['task_name'] . "\n";
            $message .= "Description: " . $formData['task_description'] . "\n";
            $message .= "Start Date: " . $formData['start_date'] . "\n";
            $message .= "Due Date: " . $formData['due_date'] . "\n";
            $message .= "\nPlease contact us for more information.\n\n";
            $message .= "Thank you.";

            // Send email
            wp_mail($email, $subject, $message);
        }
    }



    wp_send_json(['success' => true]);
}

// Delete a task from the database
function delete_task() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tasks';
    $task_id = intval($_POST['task_id'] ?? 0);

    if ($task_id) {
        $wpdb->delete($table_name, ['id' => $task_id], ['%d']);
        wp_send_json(['success' => true]);
    } else {
        wp_send_json(['success' => false, 'message' => 'Invalid task ID']);
    }
}

// Hook for creating the database table on theme activation
add_action('after_switch_theme', 'create_task_management_table');
function create_task_management_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tasks';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        task_name VARCHAR(255) DEFAULT NULL,
        task_description TEXT DEFAULT NULL,
        user_id TEXT DEFAULT NULL,
        lead_id TEXT DEFAULT NULL,
        property_id VARCHAR(255) DEFAULT NULL,
        remind_before VARCHAR(50) DEFAULT NULL,
        task_category VARCHAR(100) DEFAULT NULL,
        start_date DATETIME DEFAULT NULL,
        due_date DATETIME DEFAULT NULL,
        task_duration VARCHAR(255) DEFAULT NULL,
        task_status VARCHAR(50) DEFAULT 'Pending',
        task_repeat VARCHAR(50) DEFAULT 'does_not_repeat',
        task_address VARCHAR(255) DEFAULT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}


// Shortcode for task creation form
add_shortcode('task_creation_form', 'render_task_creation_form');
function render_task_creation_form() {
    global $wpdb;

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_task'])) {
        $table_name = $wpdb->prefix . 'tasks';

        $data = [
            'task_name'        => sanitize_text_field($_POST['task_name']),
            'task_description' => sanitize_textarea_field($_POST['task_description']),
            'task_type'        => sanitize_text_field($_POST['task_type']),
            'priority'         => sanitize_text_field($_POST['priority']),
            'priority_weight'  => intval($_POST['priority_weight']),
            'lead_id'          => intval($_POST['lead_id']),
            'user_id'          => intval($_POST['user_id']),
            'start_date'       => sanitize_text_field($_POST['start_date']),
            'due_date'         => sanitize_text_field($_POST['due_date']),
            'status'           => sanitize_text_field($_POST['status']),
            'created_by'       => get_current_user_id(),
            'notes'            => sanitize_textarea_field($_POST['notes']),
            'is_recurring'     => isset($_POST['is_recurring']) ? 1 : 0,
            'tags'             => sanitize_text_field($_POST['tags']),
        ];

        $wpdb->insert($table_name, $data);
        echo '<p>Task successfully created!</p>';
    }

    // Render the form
    ob_start();
    ?>
    <form method="post">
    <div class="mb-3">
        <label for="task_name" class="form-label">Task Name:</label>
        <input type="text" id="task_name" name="task_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="task_description" class="form-label">Task Description:</label>
        <textarea id="task_description" name="task_description" class="form-control" rows="3"></textarea>
    </div>

    <div class="mb-3">
        <label for="task_type" class="form-label">Task Type:</label>
        <input type="text" id="task_type" name="task_type" class="form-control">
    </div>

    <div class="mb-3">
        <label for="priority" class="form-label">Priority:</label>
        <select id="priority" name="priority" class="form-select">
            <option value="High">High</option>
            <option value="Medium" selected>Medium</option>
            <option value="Low">Low</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="lead_id" class="form-label">Lead ID:</label>
        <input type="number" id="lead_id" name="lead_id" class="form-control" required>
    </div>

    <div class="mb-3">
    <label for="user_id" class="form-label">Assign User:</label>
    <select id="user_id" name="user_id" class="form-select" required>
        <option value="">Select User</option>
        <?php
        $users = get_users(); // Fetch all WordPress users
        foreach ($users as $user) {
            echo '<option value="' . esc_attr($user->ID) . '">' . esc_html($user->display_name) . '</option>';
        }
        ?>
    </select>
</div>


    <div class="row mb-3">
        <div class="col-md-6">
            <label for="start_date" class="form-label">Start Date:</label>
            <input type="datetime-local" id="start_date" name="start_date" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="due_date" class="form-label">Due Date:</label>
            <input type="datetime-local" id="due_date" name="due_date" class="form-control">
        </div>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status:</label>
        <select id="status" name="status" class="form-select">
            <option value="Pending">Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="notes" class="form-label">Notes:</label>
        <textarea id="notes" name="notes" class="form-control" rows="3"></textarea>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" id="is_recurring" name="is_recurring" class="form-check-input">
        <label for="is_recurring" class="form-check-label">Recurring</label>
    </div>

    <div class="mb-3">
        <label for="tags" class="form-label">Tags:</label>
        <input type="text" id="tags" name="tags" class="form-control">
    </div>

    <button type="submit" name="create_task" class="btn btn-primary">Create Task</button>
</form>

    <?php
    return ob_get_clean();
}

// Shortcode for displaying tasks
add_shortcode('task_list', 'render_task_list');
function render_task_list() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'tasks';
    $tasks = $wpdb->get_results("SELECT * FROM $table_name");

    ob_start();
    ?>
    <table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Task Name</th>
            <th>Description</th>
            <th>Priority</th>
            <th>Lead ID</th>
            <th>Assigned User</th>
            <th>Start Date</th>
            <th>Due Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?php echo $task->id; ?></td>
                <td><?php echo esc_html($task->task_name); ?></td>
                <td><?php echo esc_html($task->task_description); ?></td>
                <td><?php echo esc_html($task->priority); ?></td>
                <td><?php echo $task->lead_id; ?></td>
                <td><?php echo $task->user_id; ?></td>
                <td><?php echo $task->start_date; ?></td>
                <td><?php echo $task->due_date; ?></td>
                <td><?php echo $task->status; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    <?php
    return ob_get_clean();
}


// Shortcode for custom search
add_shortcode('custom_search_form', 'render_custom_search_form');

function render_custom_search_form() {
	 // Add inline CSS
	  // Enqueue CSS and JS for shortcode
	  wp_enqueue_style('my-shortcode-style', get_template_directory_uri() . '/css/customsearch/style.css');
	  wp_enqueue_script('my-shortcode-script', get_template_directory_uri() . '/js/customsearch/script.js', array('jquery'), null, true);
	
	  ob_start();
	  ?>
	  <aside id="sidebar" class="sidebar-white">
		<div
			id="houzez_advanced_search-2"
			class="widget widget_houzez_advanced_search"
		>
			<div class="widget-top"><h3 class="widget-title">Search</h3></div>
			<div class="widget-range">
			<div class="widget-body">
				<div class="widget-body-title">Zoeken</div>
				<div class="panel_count_filter">
				<span class="count_filter"><span>0</span> filters</span
				><a href="?" class="clear_filter"></a>
				</div>
				<form
				autocomplete="off"
				method="get"
				action="https://curacao3d.getexperthere.online/search-results/"
				class="houzez-search-form-js houzez-search-builder-form-js"
				>
				<div class="range-block rang-form-block">
					<div class="row">
					<div class="col-sm-12 col-xs-12 keyword_search">
						<div class="form-group">
						<input
							type="text"
							class="houzez_geocomplete form-control"
							value=""
							name="keyword"
							placeholder="Voer een adres, stad, straat, postcode of object-ID in"
						/>
						<div id="auto_complete_ajax" class="auto-complete"></div>
						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						<input
							type="text"
							class="form-control"
							value=""
							name="property_id"
							placeholder="Object ID"
						/>
						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group"></div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						<div class="sel__group_select">
							<div class="sel__label">
							<input
								type="checkbox"
								class="radio-style"
								name="status[]"
								value="huur"
								id="sel__radio-huur"
								<?php 
									if (isset($_GET['status']) && is_array($_GET['status']) && in_array('huur', $_GET['status'])) {
										echo 'checked';
									}
								?>
								onclick="sel__select_check(this);"
							/>
							<label for="sel__radio-huur">Huur</label>
							</div>
						</div>
						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						<div class="sel__group_select">
							<div class="sel__label">
							<input
								type="checkbox"
								class="radio-style"
								name="status[]"
								value="koop"
								id="sel__radio-koop"
								<?php 
									if (isset($_GET['status']) && is_array($_GET['status']) && in_array('koop', $_GET['status'])) {
										echo 'checked';
									}
								?>
								onclick="sel__select_check(this);"
							/>
							<label for="sel__radio-koop">Koop</label>
							</div>
						</div>
						</div>
					</div>
					<div class="col-sm-6 col-xs-12">
						<div class="form-group prices-for-all">
						<select name="min-price" class="sel_picker">
							<option value="">Min. Prijs</option>
							<option value="any" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == 'any') echo 'selected'; ?>>Alles</option>
							<option value="50000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '50000') echo 'selected'; ?>>ANG. 50.000</option>
							<option value="100000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '100000') echo 'selected'; ?>>ANG. 100.000</option>
							<option value="200000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '200000') echo 'selected'; ?>>ANG. 200.000</option>
							<option value="250000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '250000') echo 'selected'; ?>>ANG. 250.000</option>
							<option value="300000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '300000') echo 'selected'; ?>>ANG. 300.000</option>
							<option value="350000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '350000') echo 'selected'; ?>>ANG. 350.000</option>
							<option value="400000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '400000') echo 'selected'; ?>>ANG. 400.000</option>
							<option value="450000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '450000') echo 'selected'; ?>>ANG. 450.000</option>
							<option value="500000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '500000') echo 'selected'; ?>>ANG. 500.000</option>
							<option value="600000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '600000') echo 'selected'; ?>>ANG. 600.000</option>
							<option value="700000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '700000') echo 'selected'; ?>>ANG. 700.000</option>
							<option value="800000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '800000') echo 'selected'; ?>>ANG. 800.000</option>
							<option value="900000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '900000') echo 'selected'; ?>>ANG. 900.000</option>
							<option value="1000000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '1000000') echo 'selected'; ?>>ANG. 1.000.000</option>
							<option value="1500000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '1500000') echo 'selected'; ?>>ANG. 1.500.000</option>
							<option value="2000000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '2000000') echo 'selected'; ?>>ANG. 2.000.000</option>
							<option value="2500000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '2500000') echo 'selected'; ?>>ANG. 2.500.000</option>
							<option value="5000000" <?php if (isset($_GET['min-price']) && $_GET['min-price'] == '5000000') echo 'selected'; ?>>ANG. 5.000.000</option>
						</select>

						</div>
						<div class="form-group hide prices-only-for-rent">
						<select
							name="min-price"
							disabled="disabled"
							class="sel_picker"
						>
							<option value="">Min. Prijs</option>
							<option value="any">Alles</option>
							<option value="100">ANG. 100</option>
							<option value="600">ANG. 600</option>
							<option value="700">ANG. 700</option>
							<option value="800">ANG. 800</option>
							<option value="900">ANG. 900</option>
							<option value="1000">ANG. 1.000</option>
							<option value="1250">ANG. 1.250</option>
							<option value="1500">ANG. 1.500</option>
							<option value="1750">ANG. 1.750</option>
							<option value="2000">ANG. 2.000</option>
							<option value="2500">ANG. 2.500</option>
							<option value="3000">ANG. 3.000</option>
							<option value="3500">ANG. 3.500</option>
							<option value="4000">ANG. 4.000</option>
							<option value="4500">ANG. 4.500</option>
							<option value="5000">ANG. 5.000</option>
							<option value="10000">ANG. 10.000</option>
						</select>
						</div>
					</div>
					<div class="col-sm-6 col-xs-12">
						<div class="form-group prices-for-all">
						<select name="max-price" class="sel_picker">
							<option value="">Max. Prijs</option>
							<option value="any" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == 'any') echo 'selected'; ?>>Alles</option>
							<option value="100000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '100000') echo 'selected'; ?>>ANG. 100.000</option>
							<option value="200000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '200000') echo 'selected'; ?>>ANG. 200.000</option>
							<option value="250000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '250000') echo 'selected'; ?>>ANG. 250.000</option>
							<option value="300000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '300000') echo 'selected'; ?>>ANG. 300.000</option>
							<option value="350000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '350000') echo 'selected'; ?>>ANG. 350.000</option>
							<option value="400000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '400000') echo 'selected'; ?>>ANG. 400.000</option>
							<option value="450000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '450000') echo 'selected'; ?>>ANG. 450.000</option>
							<option value="500000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '500000') echo 'selected'; ?>>ANG. 500.000</option>
							<option value="600000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '600000') echo 'selected'; ?>>ANG. 600.000</option>
							<option value="700000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '700000') echo 'selected'; ?>>ANG. 700.000</option>
							<option value="800000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '800000') echo 'selected'; ?>>ANG. 800.000</option>
							<option value="900000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '900000') echo 'selected'; ?>>ANG. 900.000</option>
							<option value="1000000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '1000000') echo 'selected'; ?>>ANG. 1.000.000</option>
							<option value="1500000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '1500000') echo 'selected'; ?>>ANG. 1.500.000</option>
							<option value="2000000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '2000000') echo 'selected'; ?>>ANG. 2.000.000</option>
							<option value="2500000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '2500000') echo 'selected'; ?>>ANG. 2.500.000</option>
							<option value="5000000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '5000000') echo 'selected'; ?>>ANG. 5.000.000</option>
							<option value="10000000" <?php if (isset($_GET['max-price']) && $_GET['max-price'] == '10000000') echo 'selected'; ?>>ANG. 10.000.000</option>
						</select>

						</div>
						<div class="form-group hide prices-only-for-rent">
						<select
							name="max-price"
							disabled="disabled"
							class="sel_picker"
						>
							<option value="">Max. Prijs</option>
							<option value="any">Alles</option>
							<option value="600">ANG. 600</option>
							<option value="700">ANG. 700</option>
							<option value="800">ANG. 800</option>
							<option value="900">ANG. 900</option>
							<option value="1000">ANG. 1.000</option>
							<option value="1250">ANG. 1.250</option>
							<option value="1500">ANG. 1.500</option>
							<option value="1750">ANG. 1.750</option>
							<option value="2000">ANG. 2.000</option>
							<option value="2500">ANG. 2.500</option>
							<option value="3000">ANG. 3.000</option>
							<option value="3500">ANG. 3.500</option>
							<option value="4000">ANG. 4.000</option>
							<option value="4500">ANG. 4.500</option>
							<option value="5000">ANG. 5.000</option>
							<option value="10000">ANG. 10.000</option>
							<option value="25000">ANG. 25.000</option>
						</select>
						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						<div class="sel__group_select">
							<div class="sel__label">
							<input
								type="checkbox"
								class="radio-style"
								name="type[]"
								value="apartment"
								id="sel__radio-appartement"
								<?php if (isset($_GET['type']) && is_array($_GET['type']) && in_array('apartment', $_GET['type'])) echo 'checked'; ?>
								onclick="sel__select_check(this);"
							/>
							<label for="sel__radio-appartement">Apartment</label>
							</div>
						</div>
						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						<div class="sel__group_select">
							<div class="sel__label">
							<input
								type="checkbox"
								class="radio-style"
								name="type[]"
								value="bouwgrond"
								id="sel__radio-bouwgrond"
								<?php if (isset($_GET['type']) && is_array($_GET['type']) && in_array('bouwgrond', $_GET['type'])) echo 'checked'; ?>
								onclick="sel__select_check(this);"
							/>
							<label for="sel__radio-bouwgrond">Bouwgrond</label>
							</div>
						</div>
						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						<div class="sel__group_select">
							<div class="sel__label">
							<input
								type="checkbox"
								class="radio-style"
								name="type[]"
								value="overig-og"
								id="sel__radio-overig-og"
								<?php if (isset($_GET['type']) && is_array($_GET['type']) && in_array('overig-og', $_GET['type'])) echo 'checked'; ?>
								onclick="sel__select_check(this);"
							/>
							<label for="sel__radio-overig-og">Overig OG</label>
							</div>
						</div>
						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						<div class="sel__group_select">
							<div class="sel__label">
							<input
								type="checkbox"
								class="radio-style"
								name="type[]"
								value="woonhuis"
								id="sel__radio-woonhuis"
								<?php if (isset($_GET['type']) && is_array($_GET['type']) && in_array('woonhuis', $_GET['type'])) echo 'checked'; ?>
								onclick="sel__select_check(this);"
							/>
							<label for="sel__radio-woonhuis">Woonhuis</label>
							</div>
						</div>
						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						<div class="sel__group_select">
							<div class="sel__label">
							<div class="sel__label_panel">
								<input
								type="checkbox"
								class="radio-style"
								name="type[]"
								value="bedrijfsobjecten"
								id="sel__radio-bedrijfsobjecten"
								<?php if (isset($_GET['type']) && is_array($_GET['type']) && in_array('bedrijfsobjecten', $_GET['type'])) echo 'checked'; ?>
								onclick="sel__select_check(this);"
								/>
								<label for="sel__radio-bedrijfsobjecten"
								>Bedrijfsobjecten</label
								>
								<span class="icon-arrow-right-blue"></span>
							</div>
							</div>
							<div class="sel__panel_list" style="display: none">
							<div class="backdrop"></div>
							<span class="icon-close-blue"></span>
							<div class="sel__group_list sel__box_list">
								<!--div class="sel__group_head">'. $term->name .'</div-->
								<ul>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="type[]"
									value="horeca"
									id="sel__radio-horeca"
									<?php if (isset($_GET['type']) && is_array($_GET['type']) && in_array('horeca', $_GET['type'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-horeca">Horeca</label>
								</li>
								</ul>
							</div>
							</div>
							<div class="sel__selected_options"></div>
						</div>
						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						<select
							name="location"
							class="sel_picker"
							data-live-search="true"
						>
							<option value="">Alle plaatsnamen</option>
							<option data-parentstate="" value="grote-berg" 
								<?php if (isset($_GET['location']) && $_GET['location'] === 'grote-berg') echo 'selected'; ?>>
								Grote Berg
							</option>
							<option data-parentstate="" value="jan-thiel" 
								<?php if (isset($_GET['location']) && $_GET['location'] === 'jan-thiel') echo 'selected'; ?>>
								Jan Thiel
							</option>
							<option data-parentstate="" value="oranjestad" 
								<?php if (isset($_GET['location']) && $_GET['location'] === 'oranjestad') echo 'selected'; ?>>
								Oranjestad
							</option>
							<option data-parentstate="" value="sabakoe" 
								<?php if (isset($_GET['location']) && $_GET['location'] === 'sabakoe') echo 'selected'; ?>>
								Sabakoe
							</option>
							<option data-parentstate="" value="sint-michiel" 
								<?php if (isset($_GET['location']) && $_GET['location'] === 'sint-michiel') echo 'selected'; ?>>
								Sint Michiel
							</option>
							<option data-parentstate="" value="willemstad" 
								<?php if (isset($_GET['location']) && $_GET['location'] === 'willemstad') echo 'selected'; ?>>
								Willemstad
							</option>
						</select>

						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						<select name="area" class="sel_picker" data-live-search="true">
							<option value="" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == '' ? 'selected' : ''; ?>>Alle wijken</option>
							<option data-parentcity="" value="abrahamsz" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'abrahamsz' ? 'selected' : ''; ?>>Abrahamsz</option>
							<option data-parentcity="" value="atlanta-resort" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'atlanta-resort' ? 'selected' : ''; ?>>Atlanta Resort</option>
							<option data-parentcity="" value="barber" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'barber' ? 'selected' : ''; ?>>Barber</option>
							<option data-parentcity="" value="bottelier" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'bottelier' ? 'selected' : ''; ?>>Bottelier</option>
							<option data-parentcity="" value="cas-cora" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'cas-cora' ? 'selected' : ''; ?>>Cas Cora</option>
							<option data-parentcity="" value="cas-coraweg" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'cas-coraweg' ? 'selected' : ''; ?>>cas coraweg</option>
							<option data-parentcity="" value="cas-grandi" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'cas-grandi' ? 'selected' : ''; ?>>Cas Grandi</option>
							<option data-parentcity="" value="curasol" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'curasol' ? 'selected' : ''; ?>>Curasol</option>
							<option data-parentcity="" value="damasco-resort-jan-thiel" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'damasco-resort-jan-thiel' ? 'selected' : ''; ?>>Damasco Resort Jan Thiel</option>
							<option data-parentcity="" value="emmastad" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'emmastad' ? 'selected' : ''; ?>>Emmastad</option>
							<option data-parentcity="" value="esperanza" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'esperanza' ? 'selected' : ''; ?>>Esperanza</option>
							<option data-parentcity="" value="groot-davelaar" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'groot-davelaar' ? 'selected' : ''; ?>>Groot Davelaar</option>
							<option data-parentcity="" value="grote-berg" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'grote-berg' ? 'selected' : ''; ?>>Grote Berg</option>
							<option data-parentcity="" value="hoenderberg" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'hoenderberg' ? 'selected' : ''; ?>>Hoenderberg</option>
							<option data-parentcity="" value="jan-sofat" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'jan-sofat' ? 'selected' : ''; ?>>Jan Sofat</option>
							<option data-parentcity="" value="jan-thiel" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'jan-thiel' ? 'selected' : ''; ?>>Jan Thiel</option>
							<option data-parentcity="" value="julianadorp" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'julianadorp' ? 'selected' : ''; ?>>Julianadorp</option>
							<option data-parentcity="" value="klein-sint-michiel" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'klein-sint-michiel' ? 'selected' : ''; ?>>Klein Sint Michiel</option>
							<option data-parentcity="" value="koraal-partier" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'koraal-partier' ? 'selected' : ''; ?>>Koraal Partier</option>
							<option data-parentcity="" value="mahaai" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'mahaai' ? 'selected' : ''; ?>>Mahaai</option>
							<option data-parentcity="" value="mahuma" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'mahuma' ? 'selected' : ''; ?>>Mahuma</option>
							<option data-parentcity="" value="matancia" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'matancia' ? 'selected' : ''; ?>>Matancia</option>
							<option data-parentcity="" value="montana-rey" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'montana-rey' ? 'selected' : ''; ?>>Montana Rey</option>
							<option data-parentcity="" value="noord-aruba" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'noord-aruba' ? 'selected' : ''; ?>>Noord Aruba</option>
							<option data-parentcity="" value="papaya-resort" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'papaya-resort' ? 'selected' : ''; ?>>Papaya Resort</option>
							<option data-parentcity="" value="parasasa" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'parasasa' ? 'selected' : ''; ?>>Parasasa</option>
							<option data-parentcity="" value="pietermaai" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'pietermaai' ? 'selected' : ''; ?>>Pietermaai</option>
							<option data-parentcity="" value="piscadera" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'piscadera' ? 'selected' : ''; ?>>Piscadera</option>
							<option data-parentcity="" value="resort" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'resort' ? 'selected' : ''; ?>>Resort</option>
							<option data-parentcity="" value="salina" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'salina' ? 'selected' : ''; ?>>Salina</option>
							<option data-parentcity="" value="santa-catharina" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'santa-catharina' ? 'selected' : ''; ?>>Santa Catharina</option>
							<option data-parentcity="" value="santa-maria" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'santa-maria' ? 'selected' : ''; ?>>Santa Maria</option>
							<option data-parentcity="" value="santa-rosa" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'santa-rosa' ? 'selected' : ''; ?>>Santa Rosa</option>
							<option data-parentcity="" value="schelpwijk" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'schelpwijk' ? 'selected' : ''; ?>>Schelpwijk</option>
							<option data-parentcity="" value="scherpenheuvel" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'scherpenheuvel' ? 'selected' : ''; ?>>Scherpenheuvel</option>
							<option data-parentcity="" value="semikok" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'semikok' ? 'selected' : ''; ?>>Semikok</option>
							<option data-parentcity="" value="suffisant" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'suffisant' ? 'selected' : ''; ?>>Suffisant</option>
							<option data-parentcity="" value="tera-kora" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'tera-kora' ? 'selected' : ''; ?>>Tera Kora</option>
							<option data-parentcity="" value="toni-kunchi" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'toni-kunchi' ? 'selected' : ''; ?>>Toni Kunchi</option>
							<option data-parentcity="" value="vredenberg" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'vredenberg' ? 'selected' : ''; ?>>Vredenberg</option>
							<option data-parentcity="" value="wacawa" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'wacawa' ? 'selected' : ''; ?>>Wacawa</option>
							<option data-parentcity="" value="west-ronde-klip" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'west-ronde-klip' ? 'selected' : ''; ?>>West Ronde Klip</option>
							<option data-parentcity="" value="white-wall" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'white-wall' ? 'selected' : ''; ?>>White Wall</option>
							<option data-parentcity="" value="zuurzak" style="display: block" <?php echo isset($_GET['area']) && $_GET['area'] == 'zuurzak' ? 'selected' : ''; ?>>Zuurzak</option>
						</select>

						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						<!--select class="sel_picker" name="label" data-live-search="false">
						<option value="">Alle labels</option>                                        </select-->
						<!-- <div>
							<input
							type="checkbox"
							name="label[]"
							value="aangekocht"
							<?php //echo isset($_GET['label']) && in_array('aangekocht', $_GET['label']) ? 'checked' : ''; ?>
							id="sel__radio-aangekocht"
							class="radio-style"
							/>
							<label for="sel__radio-aangekocht">Aangekocht</label>
						</div> -->
						<div>
							<input
							type="checkbox"
							name="label[]"
							value="beleggingspand"
							<?php echo isset($_GET['label']) && in_array('beleggingspand', $_GET['label']) ? 'checked' : ''; ?>
							id="sel__radio-beleggingspand"
							class="radio-style"
							/>
							<label for="sel__radio-beleggingspand"
							>Beleggingspand</label
							>
						</div>
						<!-- <div>
							<input
							type="checkbox"
							name="label[]"
							value="in-prijs-verlaagd"
							<?php //echo isset($_GET['label']) && in_array('in-prijs-verlaagd', $_GET['label']) ? 'checked' : ''; ?>
							id="sel__radio-in-prijs-verlaagd"
							class="radio-style"
							/>
							<label for="sel__radio-in-prijs-verlaagd"
							>In prijs verlaagd</label
							>
						</div> -->
						<div>
							<input
							type="checkbox"
							name="label[]"
							value="nieuwbouw"
							<?php echo isset($_GET['label']) && in_array('nieuwbouw', $_GET['label']) ? 'checked' : ''; ?>
							id="sel__radio-nieuwbouw"
							class="radio-style"
							/>
							<label for="sel__radio-nieuwbouw">Nieuwbouw</label>
						</div>
						<!-- <div>
							<input
							type="checkbox"
							name="label[]"
							value="open-huis"
							<?php //echo isset($_GET['label']) && in_array('open-huis', $_GET['label']) ? 'checked' : ''; ?>
							id="sel__radio-open-huis"
							class="radio-style"
							/>
							<label for="sel__radio-open-huis">Open huis</label>
						</div> -->
						<div>
							<input
							type="checkbox"
							name="label[]"
							value="recreatie"
							<?php echo isset($_GET['label']) && in_array('recreatie', $_GET['label']) ? 'checked' : ''; ?>
							id="sel__radio-recreatie"
							class="radio-style"
							/>
							<label for="sel__radio-recreatie">Recreatie</label>
						</div>
						<!-- <div>
							<input
							type="checkbox"
							name="label[]"
							value="vakantieverhuur"
							<?php //echo isset($_GET['label']) && in_array('vakantieverhuur', $_GET['label']) ? 'checked' : ''; ?>
							id="sel__radio-vakantieverhuur"
							class="radio-style"
							/>
							<label for="sel__radio-vakantieverhuur"
							>Vakantieverhuur</label
							>
						</div> -->
						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						<div class="sel__group_select">
							<div class="sel__label">
							<div class="sel__label_panel">
								Slaapkamers <span class="icon-arrow-right-blue"></span>
							</div>
							</div>
							<div class="sel__panel_list" style="display: none">
							<div class="backdrop"></div>
							<span class="icon-close-blue"></span>
							<div class="sel__group_list">
								<input
								name="bedrooms"
								type="radio"
								value=""
								style="display: none"
								/>
								<ul>
									<li>
										<input
											name="bedrooms"
											type="radio"
											value="1"
											id="bedrooms-1-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bedrooms']) && $_GET['bedrooms'] == '1' ? 'checked' : ''; ?>
										/>
										<label for="bedrooms-1-radiobox">1 Slaapkamer</label>
									</li>
									<li>
										<input
											name="bedrooms"
											type="radio"
											value="2"
											id="bedrooms-2-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bedrooms']) && $_GET['bedrooms'] == '2' ? 'checked' : ''; ?>
										/>
										<label for="bedrooms-2-radiobox">2+ Slaapkamers</label>
									</li>
									<li>
										<input
											name="bedrooms"
											type="radio"
											value="3"
											id="bedrooms-3-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bedrooms']) && $_GET['bedrooms'] == '3' ? 'checked' : ''; ?>
										/>
										<label for="bedrooms-3-radiobox">3+ Slaapkamers</label>
									</li>
									<li>
										<input
											name="bedrooms"
											type="radio"
											value="4"
											id="bedrooms-4-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bedrooms']) && $_GET['bedrooms'] == '4' ? 'checked' : ''; ?>
										/>
										<label for="bedrooms-4-radiobox">4+ Slaapkamers</label>
									</li>
									<li>
										<input
											name="bedrooms"
											type="radio"
											value="5"
											id="bedrooms-5-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bedrooms']) && $_GET['bedrooms'] == '5' ? 'checked' : ''; ?>
										/>
										<label for="bedrooms-5-radiobox">5+ Slaapkamers</label>
									</li>
									<li>
										<input
											name="bedrooms"
											type="radio"
											value="6"
											id="bedrooms-6-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bedrooms']) && $_GET['bedrooms'] == '6' ? 'checked' : ''; ?>
										/>
										<label for="bedrooms-6-radiobox">6+ Slaapkamers</label>
									</li>
									<li>
										<input
											name="bedrooms"
											type="radio"
											value="7"
											id="bedrooms-7-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bedrooms']) && $_GET['bedrooms'] == '7' ? 'checked' : ''; ?>
										/>
										<label for="bedrooms-7-radiobox">7+ Slaapkamers</label>
									</li>
									<li>
										<input
											name="bedrooms"
											type="radio"
											value="8"
											id="bedrooms-8-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bedrooms']) && $_GET['bedrooms'] == '8' ? 'checked' : ''; ?>
										/>
										<label for="bedrooms-8-radiobox">8+ Slaapkamers</label>
									</li>
								</ul>

							</div>
							</div>
							<div class="sel__selected_options"></div>
						</div>
						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						<div class="sel__group_select">
							<div class="sel__label">
							<div class="sel__label_panel">
								Badkamers <span class="icon-arrow-right-blue"></span>
							</div>
							</div>
							<div class="sel__panel_list" style="display: none">
							<div class="backdrop"></div>
							<span class="icon-close-blue"></span>
							<div class="sel__group_list">
								<input
								name="bathrooms"
								type="radio"
								value=""
								style="display: none"
								/>
								<ul>
									<li>
										<input
											name="bathrooms"
											type="radio"
											value="1"
											id="bathrooms-1-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bathrooms']) && $_GET['bathrooms'] == '1' ? 'checked' : ''; ?>
										/>
										<label for="bathrooms-1-radiobox">1 Badkamer</label>
									</li>
									<li>
										<input
											name="bathrooms"
											type="radio"
											value="2"
											id="bathrooms-2-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bathrooms']) && $_GET['bathrooms'] == '2' ? 'checked' : ''; ?>
										/>
										<label for="bathrooms-2-radiobox">2+ Badkamers</label>
									</li>
									<li>
										<input
											name="bathrooms"
											type="radio"
											value="3"
											id="bathrooms-3-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bathrooms']) && $_GET['bathrooms'] == '3' ? 'checked' : ''; ?>
										/>
										<label for="bathrooms-3-radiobox">3+ Badkamers</label>
									</li>
									<li>
										<input
											name="bathrooms"
											type="radio"
											value="4"
											id="bathrooms-4-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bathrooms']) && $_GET['bathrooms'] == '4' ? 'checked' : ''; ?>
										/>
										<label for="bathrooms-4-radiobox">4+ Badkamers</label>
									</li>
									<li>
										<input
											name="bathrooms"
											type="radio"
											value="5"
											id="bathrooms-5-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bathrooms']) && $_GET['bathrooms'] == '5' ? 'checked' : ''; ?>
										/>
										<label for="bathrooms-5-radiobox">5+ Badkamers</label>
									</li>
									<li>
										<input
											name="bathrooms"
											type="radio"
											value="6"
											id="bathrooms-6-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bathrooms']) && $_GET['bathrooms'] == '6' ? 'checked' : ''; ?>
										/>
										<label for="bathrooms-6-radiobox">6+ Badkamers</label>
									</li>
									<li>
										<input
											name="bathrooms"
											type="radio"
											value="7"
											id="bathrooms-7-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bathrooms']) && $_GET['bathrooms'] == '7' ? 'checked' : ''; ?>
										/>
										<label for="bathrooms-7-radiobox">7+ Badkamers</label>
									</li>
									<li>
										<input
											name="bathrooms"
											type="radio"
											value="8"
											id="bathrooms-8-radiobox"
											class="radio-style"
											onclick="sel__select_radio(this);"
											<?php echo isset($_GET['bathrooms']) && $_GET['bathrooms'] == '8' ? 'checked' : ''; ?>
										/>
										<label for="bathrooms-8-radiobox">8+ Badkamers</label>
									</li>
								</ul>

							</div>
							</div>
							<div class="sel__selected_options"></div>
						</div>
						</div>
					</div>
					</div>
				</div>
				<div class="range-block">
					<label>Woonoppervlakte</label>
					<?php 
						// Fetch minimum and maximum area values from GET parameters or set defaults
							$min_area = isset($_GET['min-area']) && !empty($_GET['min-area']) ? $_GET['min-area'] : 25; // Default minimum area
							$max_area = isset($_GET['max-area']) && !empty($_GET['max-area']) ? $_GET['max-area'] : 1000; // Default maximum area
							?>
					<div class="clearfix range-text">
					<div class="range-text">
						<input
						type="hidden"
						name="min-area"
						id="min-area"
						class="min-area-range-hidden range-input"
						value=""
						/>
						<input
						type="hidden"
						name="max-area"
						id="max-area"
						class="max-area-range-hidden range-input"
						value=""
						/>
						<span class="range-title"
						><?php echo houzez_option('srh_area_range', 'Area Range:'); ?></span
						>
						<?php echo houzez_option('srh_from', 'from'); ?>
						<span class="min-area-range"
						><?php echo esc_html($min_area); ?></span
						>
						<?php echo houzez_option('srh_to', 'to'); ?>
						<span class="max-area-range"
						><?php echo esc_html($max_area); ?></span
						>
					</div>
					<!-- range-text -->
					<div class="area-range-wrap">
						<div id="area-range" class="area-range"></div>
						<!-- area-range -->
					</div>
					<!-- area-range-wrap -->
					</div>
				</div>
				<div class="range-block rang-form-block">
					<div class="row">
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
							<div>
								<input
									type="checkbox"
									name="gated_community"
									value="1"
									id="sel__radio-gated_community"
									class="radio-style"
									<?php echo isset($_GET['gated_community']) && $_GET['gated_community'] == '1' ? 'checked' : ''; ?>
								/>
								<label for="sel__radio-gated_community">Resort</label>
							</div>
						</div>
					</div>

					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
							<div>
								<input
									type="checkbox"
									name="pets_allowed"
									value="1"
									id="sel__radio-pets_allowed"
									class="radio-style"
									<?php echo isset($_GET['pets_allowed']) && $_GET['pets_allowed'] == '1' ? 'checked' : ''; ?>
								/>
								<label for="sel__radio-pets_allowed">Huisdieren toegestaan</label>
							</div>
						</div>
					</div>

					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						<div class="sel__group_select">
							<div class="sel__label">
							<div class="sel__label_panel">
								Bijzonderheden
								<span class="icon-arrow-right-blue"></span>
							</div>
							</div>
							<div class="sel__panel_list" style="display: none">
							<div class="backdrop"></div>
							<span class="icon-close-blue"></span>
							<div class="sel__group_list sel__box_list">
							<ul>
								<li>
									<input
										type="checkbox"
										class="radio-style"
										name="specialities[]"
										value="Furnished"
										id="sel__radio-Furnished"
										onclick="sel__select_check(this);"
										<?php echo isset($_GET['specialities']) && in_array('Furnished', $_GET['specialities']) ? 'checked' : ''; ?>
									/>
									<label for="sel__radio-Furnished">Gemeubileerd</label>
								</li>
								<li>
									<input
										type="checkbox"
										class="radio-style"
										name="specialities[]"
										value="Partly upholstered"
										id="sel__radio-Partly upholstered"
										onclick="sel__select_check(this);"
										<?php echo isset($_GET['specialities']) && in_array('Partly upholstered', $_GET['specialities']) ? 'checked' : ''; ?>
									/>
									<label for="sel__radio-Partly upholstered">Gedeeltelijk gestoffeerd</label>
								</li>
								<li>
									<input
										type="checkbox"
										class="radio-style"
										name="specialities[]"
										value="Monumental building"
										id="sel__radio-Monumental building"
										onclick="sel__select_check(this);"
										<?php echo isset($_GET['specialities']) && in_array('Monumental building', $_GET['specialities']) ? 'checked' : ''; ?>
									/>
									<label for="sel__radio-Monumental building">Monumentaal pand</label>
								</li>
								<li>
									<input
										type="checkbox"
										class="radio-style"
										name="specialities[]"
										value="Monument"
										id="sel__radio-Monument"
										onclick="sel__select_check(this);"
										<?php echo isset($_GET['specialities']) && in_array('Monument', $_GET['specialities']) ? 'checked' : ''; ?>
									/>
									<label for="sel__radio-Monument">Monument</label>
								</li>
								<li>
									<input
										type="checkbox"
										class="radio-style"
										name="specialities[]"
										value="Upholstered"
										id="sel__radio-Upholstered"
										onclick="sel__select_check(this);"
										<?php echo isset($_GET['specialities']) && in_array('Upholstered', $_GET['specialities']) ? 'checked' : ''; ?>
									/>
									<label for="sel__radio-Upholstered">Gestoffeerd</label>
								</li>
								<li>
									<input
										type="checkbox"
										class="radio-style"
										name="specialities[]"
										value="Partly rented"
										id="sel__radio-Partly rented"
										onclick="sel__select_check(this);"
										<?php echo isset($_GET['specialities']) && in_array('Partly rented', $_GET['specialities']) ? 'checked' : ''; ?>
									/>
									<label for="sel__radio-Partly rented">Gedeeltelijk verhuurd</label>
								</li>
								<li>
									<input
										type="checkbox"
										class="radio-style"
										name="specialities[]"
										value="Double occupancy possible"
										id="sel__radio-Double occupancy possible"
										onclick="sel__select_check(this);"
										<?php echo isset($_GET['specialities']) && in_array('Double occupancy possible', $_GET['specialities']) ? 'checked' : ''; ?>
									/>
									<label for="sel__radio-Double occupancy possible">Dubbele bewoning mogelijk</label>
								</li>
								<li>
									<input
										type="checkbox"
										class="radio-style"
										name="specialities[]"
										value="Double occupancy present"
										id="sel__radio-Double occupancy present"
										onclick="sel__select_check(this);"
										<?php echo isset($_GET['specialities']) && in_array('Double occupancy present', $_GET['specialities']) ? 'checked' : ''; ?>
									/>
									<label for="sel__radio-Double occupancy present">Dubbele bewoning aanwezig</label>
								</li>
								<li>
									<input
										type="checkbox"
										class="radio-style"
										name="specialities[]"
										value="Accessible to the elderly"
										id="sel__radio-Accessible to the elderly"
										onclick="sel__select_check(this);"
										<?php echo isset($_GET['specialities']) && in_array('Accessible to the elderly', $_GET['specialities']) ? 'checked' : ''; ?>
									/>
									<label for="sel__radio-Accessible to the elderly">Toegankelijk voor ouderen</label>
								</li>
								<li>
									<input
										type="checkbox"
										class="radio-style"
										name="specialities[]"
										value="Accessible for the disabled"
										id="sel__radio-Accessible for the disabled"
										onclick="sel__select_check(this);"
										<?php echo isset($_GET['specialities']) && in_array('Accessible for the disabled', $_GET['specialities']) ? 'checked' : ''; ?>
									/>
									<label for="sel__radio-Accessible for the disabled">Toegankelijk voor gehandicapten</label>
								</li>
								<li>
									<input
										type="checkbox"
										class="radio-style"
										name="specialities[]"
										value="Fixer-upper"
										id="sel__radio-Fixer-upper"
										onclick="sel__select_check(this);"
										<?php echo isset($_GET['specialities']) && in_array('Fixer-upper', $_GET['specialities']) ? 'checked' : ''; ?>
									/>
									<label for="sel__radio-Fixer-upper">Kluswoning</label>
								</li>
								<li>
									<input
										type="checkbox"
										class="radio-style"
										name="specialities[]"
										value="Protected city or village view"
										id="sel__radio-Protected city or village view"
										onclick="sel__select_check(this);"
										<?php echo isset($_GET['specialities']) && in_array('Protected city or village view', $_GET['specialities']) ? 'checked' : ''; ?>
									/>
									<label for="sel__radio-Protected city or village view">Beschermd stads- of dorpsgezicht</label>
								</li>
							</ul>

							</div>
							</div>
							<div class="sel__selected_options"></div>
						</div>
						</div>
					</div>
					<div class="col-sm-12 col-xs-12">
						<div class="form-group">
						<div class="sel__group_select">
							<div class="sel__label">
							<div class="sel__label_panel">
								Voorzieningen
								<span class="icon-arrow-right-blue"></span>
							</div>
							</div>
							<div class="sel__panel_list" style="display: none">
							<div class="backdrop"></div>
							<span class="icon-close-blue"></span>
							<div class="sel__group_list sel__box_list">
							<ul>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Shutters"
									id="sel__radio-Shutters"
									<?php if (isset($_GET['feature_facilities']) && in_array('Shutters', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Shutters">Rolluiken</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="TV cable"
									id="sel__radio-TV cable"
									<?php if (isset($_GET['feature_facilities']) && in_array('TV cable', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-TV cable">TV kabel</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Elevator"
									id="sel__radio-Elevator"
									<?php if (isset($_GET['feature_facilities']) && in_array('Elevator', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Elevator">Lift</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Swimming pool"
									id="sel__radio-Swimming pool"
									<?php if (isset($_GET['feature_facilities']) && in_array('Swimming pool', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Swimming pool">Zwembad</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Mechanical ventilation"
									id="sel__radio-Mechanical ventilation"
									<?php if (isset($_GET['feature_facilities']) && in_array('Mechanical ventilation', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Mechanical ventilation">Mechanische ventilatie</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Alarm installation"
									id="sel__radio-Alarm installation"
									<?php if (isset($_GET['feature_facilities']) && in_array('Alarm installation', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Alarm installation">Alarminstallatie</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Outdoor awnings"
									id="sel__radio-Outdoor awnings"
									<?php if (isset($_GET['feature_facilities']) && in_array('Outdoor awnings', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Outdoor awnings">Buitenzonwering</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Air conditioning"
									id="sel__radio-Air conditioning"
									<?php if (isset($_GET['feature_facilities']) && in_array('Air conditioning', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Air conditioning">Airconditioning</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Solar collectors"
									id="sel__radio-Solar collectors"
									<?php if (isset($_GET['feature_facilities']) && in_array('Solar collectors', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Solar collectors">Zonnecollectoren</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Satellite dish"
									id="sel__radio-Satellite dish"
									<?php if (isset($_GET['feature_facilities']) && in_array('Satellite dish', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Satellite dish">Satellietschotel</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Jacuzzi"
									id="sel__radio-Jacuzzi"
									<?php if (isset($_GET['feature_facilities']) && in_array('Jacuzzi', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Jacuzzi">Jacuzzi</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Steam room"
									id="sel__radio-Steam room"
									<?php if (isset($_GET['feature_facilities']) && in_array('Steam room', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Steam room">Stoomcabine</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Chimney"
									id="sel__radio-Chimney"
									<?php if (isset($_GET['feature_facilities']) && in_array('Chimney', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Chimney">Rookkanaal</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Sliding door"
									id="sel__radio-Sliding door"
									<?php if (isset($_GET['feature_facilities']) && in_array('Sliding door', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Sliding door">Schuifpui</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="French balcony"
									id="sel__radio-French balcony"
									<?php if (isset($_GET['feature_facilities']) && in_array('French balcony', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-French balcony">Frans balkon</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Windmill"
									id="sel__radio-Windmill"
									<?php if (isset($_GET['feature_facilities']) && in_array('Windmill', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Windmill">Windmolen</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Porthole"
									id="sel__radio-Porthole"
									<?php if (isset($_GET['feature_facilities']) && in_array('Porthole', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Porthole">Dakraam</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Sauna"
									id="sel__radio-Sauna"
									<?php if (isset($_GET['feature_facilities']) && in_array('Sauna', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Sauna">Sauna</label>
								</li>
								<li>
									<input
									type="checkbox"
									class="radio-style"
									name="feature_facilities[]"
									value="Fiber optic cable"
									id="sel__radio-Fiber optic cable"
									<?php if (isset($_GET['feature_facilities']) && in_array('Fiber optic cable', $_GET['feature_facilities'])) echo 'checked'; ?>
									onclick="sel__select_check(this);"
									/>
									<label for="sel__radio-Fiber optic cable">Glasvezel kabel</label>
								</li>
							</ul>

							</div>
							</div>
							<div class="sel__selected_options"></div>
						</div>
						</div>
					</div>
					</div>
				</div>
				<div class="range-block rang-form-block">
					<div class="row">
					<div class="col-sm-12 col-xs-12">
						<button type="submit" class="btn btn-secondary btn-block">
						<i class="fa fa-search fa-left"></i>Zoeken
						</button>
					</div>
					</div>
				</div>
				</form>
			</div>
			</div>
		</div>
		</aside>

  
	  <?php
	  return ob_get_clean();
	}
?>





