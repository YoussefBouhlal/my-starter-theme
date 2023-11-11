<?php
/**
 * Single Post
 *
 * @package      mystartertheme
 * @author       Youssef Bouhlal
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

use Mystartertheme\Block_Areas;

/**
 * After Post
 */
function mystartertheme_after_post() {
	Block_Areas\show( 'after-post' );
}
add_action( 'tha_content_while_after', 'mystartertheme_after_post', 8 );


// Build the page.
require get_template_directory() . '/index.php';
