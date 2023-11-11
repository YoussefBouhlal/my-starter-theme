<?php
/**
 * Wordpress Cleanup
 *
 * @package      mystartertheme
 * @author       Youssef Bouhlal
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Header Meta Tags
 */
function mystartertheme_header_meta_tags() {
	echo '<meta charset="' . esc_attr( get_bloginfo( 'charset' ) ) . '">';
	echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
	echo '<link rel="profile" href="http://gmpg.org/xfn/11">';
	echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">';
}
add_action( 'wp_head', 'mystartertheme_header_meta_tags' );

/**
 * Extra body classes
 *
 * @param array $classes Body classes.
 */
function mystartertheme_extra_body_classes( $classes ) {
	if ( is_singular() ) {
		$classes[] = 'singular';
	}
	return $classes;
}
add_filter( 'body_class', 'mystartertheme_extra_body_classes' );

/**
 * Clean body classes
 *
 * @param array $classes Body classes.
 */
function mystartertheme_clean_body_classes( $classes ) {

	$allowed_classes = [
		'singular',
		'single',
		'page',
		'archive',
		'home',
		'search',
		'admin-bar',
		'logged-in',
		'wp-embed-responsive',
	];

	if ( function_exists( 'mystartertheme_page_layout_options' ) ) {
		$allowed_classes = array_merge( $allowed_classes, mystartertheme_page_layout_options() );
	}

	return array_intersect( $classes, $allowed_classes );

}
add_filter( 'body_class', 'mystartertheme_clean_body_classes', 20 );

/**
 * Clean Nav Menu Classes
 *
 * @param array $classes Nav item classes.
 * @param \WP_Post $menu_item Nav menu item.
 * @param \stdClass $args Object of wp_nav_menu() arguments.
 */
function mystartertheme_clean_nav_menu_classes( $classes, $menu_item, $args ) {
	if ( ! is_array( $classes ) ) {
		return $classes;
	}

	foreach ( $classes as $i => $class ) {

		// Remove class with menu item id.
		$id = strtok( $class, 'menu-item-' );
		if ( 0 < intval( $id ) ) {
			unset( $classes[ $i ] );
		}

		// Remove menu-item-type-*.
		if ( false !== strpos( $class, 'menu-item-type-' ) ) {
			unset( $classes[ $i ] );
		}

		// Remove menu-item-object-*.
		if ( false !== strpos( $class, 'menu-item-object-' ) ) {
			unset( $classes[ $i ] );
		}

		// Change page ancestor to menu ancestor.
		if ( 'current-page-ancestor' === $class ) {
			$classes[] = 'current-menu-ancestor';
			unset( $classes[ $i ] );
		}
	}

	// Remove submenu class if depth is limited.
	if ( isset( $args->depth ) && 1 === $args->depth ) {
		$classes = array_diff( $classes, array( 'menu-item-has-children' ) );
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'mystartertheme_clean_nav_menu_classes', 5, 3 );

/**
 * Clean Post Classes
 *
 * @param array $classes Post Classes.
 */
function mystartertheme_clean_post_classes( $classes ) {

	if ( ! is_array( $classes ) ) {
		return $classes;
	}

	$allowed_classes = [
		'entry',
		'type-' . get_post_type(),
	];

	return array_intersect( $classes, $allowed_classes );
}
add_filter( 'post_class', 'mystartertheme_clean_post_classes', 5 );

/**
 * Archive Title, remove prefix
 *
 * @param string $title Title.
 */
function mystartertheme_archive_title_remove_prefix( $title ) {
	$title_pieces = explode( ': ', $title );
	if ( count( $title_pieces ) > 1 ) {
		unset( $title_pieces[0] );
		$title = join( ': ', $title_pieces );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'mystartertheme_archive_title_remove_prefix' );

/**
 * Use custom website as author url
 *
 * @param string $link Link.
 * @param int    $author_id Author ID.
 */
function mystartertheme_custom_author_url( $link, $author_id ) {
	$website = get_the_author_meta( 'user_url', $author_id );
	if ( ! empty( $website ) && false !== strpos( $website, home_url() ) ) {
		$link = esc_url_raw( $website );
	}
	return $link;
}
add_filter( 'author_link', 'mystartertheme_custom_author_url', 10, 2 );

/**
 * Excerpt More
 */
function mystartertheme_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'mystartertheme_excerpt_more' );

// Remove inline CSS for emoji.
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Max srcset width
 *
 * @param int   $max_width  The maximum image width to be included in the 'srcset'. Default '2048'.
 * @param int[] $size_array {
 *     An array of requested width and height values.
 *
 *     @type int $0 The width in pixels.
 *     @type int $1 The height in pixels.
 * }
 */
function mystartertheme_max_srcset_width( $max_width, $size_array ) {
	return 1200;
}
add_filter( 'max_srcset_image_width', 'mystartertheme_max_srcset_width', 10, 2 );

/**
 * Default image sizes
 */
function mystartertheme_default_image_sizes( $sizes, $size, $image_src, $image_meta, $attachment_id ) {

	$layout = mystartertheme_page_layout();
	if ( 'full-width-content' === $layout ) {
		return $sizes;
	}

	$content_width = $GLOBALS['content_width'];

	if ( $size[0] > $content_width ) {
		$sizes = esc_attr( '(max-width: ' . $content_width . 'px) 100vw, ' . $content_width . 'px' );
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'mystartertheme_default_image_sizes', 10, 5 );