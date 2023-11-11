<?php
/**
 * Archive
 *
 * @package      mystartertheme
 * @author       Youssef Bouhlal
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

 // Full width.
add_filter( 'mystartertheme_page_layout', 'mystartertheme_return_full_width_content' );

/**
 * Body Class
 *
 * @param array $classes Body classes.
 */
function mystartertheme_archive_body_class( $classes ) {
	$classes[] = 'archive';
	return $classes;
}
add_filter( 'body_class', 'mystartertheme_archive_body_class' );

// Build the page.
require get_template_directory() . '/index.php';
