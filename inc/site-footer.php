<?php
/**
 * Site Footer
 *
 * @package      mystartertheme
 * @author       Youssef Bouhlal
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Site Footer
 */
function mystartertheme_site_footer() {
	echo '<a href="' . esc_url( home_url() ) . '" rel="home" class="site-header__logo" aria-label="' . esc_attr( get_bloginfo( 'name' ) ) . ' Home">' . mystartertheme_icon( array( 'icon' => 'secondary', 'size' => false, 'width' => 154, 'height' => 32 ) ) . '</a>';

	echo '<p>&copy;' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) . '. All rights reserved.</p>';
}
add_action( 'tha_footer_top', 'mystartertheme_site_footer' );
