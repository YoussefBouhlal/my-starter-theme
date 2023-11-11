<?php
/**
 * Sidebar
 *
 * @package      mystartertheme
 * @author       Youssef Bouhlal
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

use Mystartertheme\Block_Areas;

if ( ! function_exists( 'mystartertheme_page_layout' ) ) {
	return;
}

$layout = mystartertheme_page_layout();
if ( ! in_array( $layout, array( 'content-sidebar', 'sidebar-content' ), true ) ) {
	return;
}

if ( ! apply_filters( 'mystartertheme_display_sidebar', true ) ) {
	return;
}

tha_sidebars_before();

echo '<aside class="sidebar-primary" role="complementary">';
tha_sidebar_top();
Block_Areas\show( 'sidebar' );
tha_sidebar_bottom();
echo '</aside>';

tha_sidebars_after();
