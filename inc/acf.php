<?php
/**
 * ACF customizations
 *
 * @package      mystartertheme
 * @author       Youssef Bouhlal
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

namespace Mystartertheme\ACF;

/**
 * Register Options Page
 */
function register_options_page() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page(
			[
				'title'      => __( 'Site Options', 'mystartertheme_textdomain' ),
				'capability' => 'manage_options',
			]
		);
	}
}
add_action( 'init', __NAMESPACE__ . '\\register_options_page' );