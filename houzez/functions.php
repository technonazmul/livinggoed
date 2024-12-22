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
            'user_id' => $task->user_id,
            'lead_id' => $task->lead_id,
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
        'user_id' => intval($_POST['user_id'] ?? null),
        'lead_id' => intval($_POST['lead_id'] ?? null),
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
        user_id INT(11) DEFAULT NULL,
        lead_id INT(11) DEFAULT NULL,
        property_id VARCHAR(255) DEFAULT NULL,
        remind_before VARCHAR(50) DEFAULT NULL,
        task_category VARCHAR(100) DEFAULT NULL,
        start_date DATETIME DEFAULT NULL,
        due_date DATETIME DEFAULT NULL,
        task_duration INT(11) DEFAULT NULL,
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
?>


