<?php
/**
 * Functions
 *
 * @package      mystartertheme
 * @author       Youssef Bouhlal
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

// Theme.
require_once get_template_directory() . '/inc/tha-theme-hooks.php';
require_once get_template_directory() . '/inc/layouts.php';
require_once get_template_directory() . '/inc/helper-functions.php';
require_once get_template_directory() . '/inc/wordpress-cleanup.php';
require_once get_template_directory() . '/inc/comments.php';
include_once get_template_directory() . '/inc/site-header.php';
include_once get_template_directory() . '/inc/site-footer.php';
include_once get_template_directory() . '/inc/archive-header.php';
include_once get_template_directory() . '/inc/archive-navigation.php';
include_once get_template_directory() . '/inc/template-tags.php';

// Functionality.
require_once get_template_directory() . '/inc/blocks.php';
require_once get_template_directory() . '/inc/block-areas.php';
require_once get_template_directory() . '/inc/loop.php';
include_once get_template_directory() . '/inc/login-logo.php';

// Plugin Support.
require_once get_template_directory() . '/inc/acf.php';
require_once get_template_directory() . '/inc/wordpress-seo.php';
include_once get_template_directory() . '/inc/wpforms.php';

/**
 * Enqueue scripts and styles.
 */
function mystartertheme_scripts() {

	$main_js_assets = include( get_theme_file_path( '/assets/build/js/main.asset.php' ) );
	wp_enqueue_script( 'theme-global', get_theme_file_uri( '/assets/build/js/main.js' ), $main_js_assets['dependencies'], $main_js_assets['version'], true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$main_css_assets = include( get_theme_file_path( '/assets/build/css/main.asset.php' ) );
	wp_enqueue_style( 'theme-style', get_theme_file_uri( '/assets/build/css/main.css' ), $main_css_assets['dependencies'], $main_css_assets['version'] );

}
add_action( 'wp_enqueue_scripts', 'mystartertheme_scripts' );

/**
 * Gutenberg scripts and styles
 */
function mystartertheme_gutenberg_scripts() {
	$editor_assets = include( get_theme_file_path( '/assets/build/js/editor.asset.php' ) );
	wp_enqueue_script( 'theme-editor', get_theme_file_uri( '/assets/build/js/editor.js' ), $editor_assets['dependencies'], $editor_assets['version'], true );
}
add_action( 'enqueue_block_editor_assets', 'mystartertheme_gutenberg_scripts' );

if ( ! function_exists( 'mystartertheme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mystartertheme_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'mystartertheme_textdomain', get_template_directory() . '/languages' );

		// Editor Styles.
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/build/css/editor.css' );

		// Admin Bar Styling.
		add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Body open hook.
		add_theme_support( 'body-open' );

		// Remove block templates.
		remove_theme_support( 'block-templates' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 */
		$GLOBALS['content_width'] = apply_filters( 'mystartertheme_content_width', 800 );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			]
		);

		// Gutenberg.

		// -- Responsive embeds
		add_theme_support( 'responsive-embeds' );

	}

endif;
add_action( 'after_setup_theme', 'mystartertheme_setup' );

/**
 * Template Hierarchy
 *
 * @param string $template Template.
 */
function mystartertheme_template_hierarchy( $template ) {

	if ( is_search() ) {
		$template = get_query_template( 'archive' );
	}
	return $template;
}
add_filter( 'template_include', 'mystartertheme_template_hierarchy' );