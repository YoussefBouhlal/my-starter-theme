<?php
/**
 * Layouts
 *
 * @package      mystartertheme
 * @author       Youssef Bouhlal
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Layout Options
 **/
function mystartertheme_page_layout_options() {
	return [
		'content-sidebar',
		'content',
		'full-width-content',
	];
}

/**
 * Gutenberg layout style
 */
function mystartertheme_editor_layout_style() {
	$editor_layout_assets = include( get_theme_file_path( '/assets/build/editor-layout.asset.php' ) );
	wp_enqueue_style( 'cwp-editor-layout', get_theme_file_uri( '/assets/build/editor-layout.css' ), [], $editor_layout_assets['version'], 'all' );
}
add_action( 'enqueue_block_editor_assets', 'mystartertheme_editor_layout_style' );

/**
 * Editor layout class
 *
 * @param string $classes Classes.
 * @return string
 */
function mystartertheme_editor_layout_class( $classes ) {
	$screen = get_current_screen();
	if ( ! method_exists( $screen, 'is_block_editor' ) || ! $screen->is_block_editor() ) {
		return $classes;
	}

	$post_id = isset( $_GET['post'] ) ? intval( $_GET['post'] ) : false;
	$layout  = mystartertheme_page_layout( $post_id );
	if ( false === strpos( $classes, 'block-area-' ) ) {
		$classes .= ' ' . $layout . ' ';
	}
	return $classes;
}
add_filter( 'admin_body_class', 'mystartertheme_editor_layout_class', 20 );

/**
 * Layout Metabox (ACF)
 */
function mystartertheme_page_layout_metabox() {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$choices = [];
	$layouts = mystartertheme_page_layout_options();
	foreach ( $layouts as $layout ) {
		$label              = str_replace( '-', ' ', $layout );
		$choices[ $layout ] = ucwords( $label );
	}

	acf_add_local_field_group(
		[
			'key' => 'group_5dd714b369526',
			'title' => 'Page Layout',
			'fields' => array(
				array(
					'key' => 'field_5dd715a02eaf0',
					'label' => 'Page Layout',
					'name' => 'mystartertheme_page_layout',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => $choices,
					'default_value' => array(
					),
					'allow_null' => 1,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'page',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'side',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		]
	);
}
add_action( 'acf/init', 'mystartertheme_page_layout_metabox' );

/**
 * Layout Body Class
 *
 * @param array $classes Body Classes.
 */
function mystartertheme_layout_body_class( $classes ) {
	$classes[] = mystartertheme_page_layout();
	return $classes;
}
add_filter( 'body_class', 'mystartertheme_layout_body_class', 5 );

/**
 * Page Layout
 *
 * @param int|false $id Post ID.
 */
function mystartertheme_page_layout( $id = false ) {

	$id = $id ? intval( $id ) : false;
	if ( empty( $id ) && is_singular() ) {
		$id = get_the_ID();
	}

	$available_layouts = mystartertheme_page_layout_options();
	$layout            = 'content';

	// Default layouts.
	$defaults = [
		'post'              => 'content-sidebar',
		'page'              => 'content',
	];
	foreach ( $defaults as $post_type => $default_layout ) {
		if ( ( $id && $post_type === get_post_type( $id ) ) || ( ! empty( $_GET['post_type'] ) && $post_type === $_GET['post_type'] ) ) {
			$layout = $default_layout;
		}
	}

	// Selected layout.
	if ( $id ) {
		$selected = get_post_meta( $id, 'mystartertheme_page_layout', true );
		if ( ! empty( $selected ) && in_array( $selected, $available_layouts, true ) ) {
			$layout = $selected;
		}
	}

	$layout = apply_filters( 'mystartertheme_page_layout', $layout );
	$layout = in_array( $layout, $available_layouts, true ) ? $layout : $available_layouts[0];

	return sanitize_title_with_dashes( $layout );
}

/**
 * Return Full Width Content
 */
function mystartertheme_return_full_width_content() {
	return 'full-width-content';
}

/**
 * Return Content Sidebar
 */
function mystartertheme_return_content_sidebar() {
	return 'content-sidebar';
}

/**
 * Return Content
 */
function mystartertheme_return_content() {
	return 'content';
}