<?php
/**
 * Content & Image block
 *
 * @package      YoussefBouhlal2023
 * @subpackage   blocks/social-links/01
 * @author       Youssef Bouhlal
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

$classes = [ 'content-image' ];
if ( ! empty( $block['className'] ) ) {
	$classes = array_merge( $classes, explode( ' ', $block['className'] ) );
}

if ( ! empty( $block['backgroundColor'] ) ) {
	$classes[] = 'has-background';
	$classes[] = 'has-' . $block['backgroundColor'] . '-background-color';
}

$reverse    = get_field( 'reverse' );

if ( $reverse ) {
    $classes[] = 'reverse';
}

$template = array(
    array( 'core/image', array() ),
    array( 'core/group', array(), array(
        array( 'core/heading', array(
            'placeholder' => __( 'Heading', 'youssef_bouhlal_2023_textdomain' ),
        ) ),
        array( 'core/paragraph', array(
            'placeholder' => __( 'Paragraph', 'youssef_bouhlal_2023_textdomain' ),
        ) )
    ) )
);

printf(
    '<div class="%s"%s>',
	esc_attr( join( ' ', $classes ) ),
	! empty( $block['anchor'] ) ? ' id="' . esc_attr( sanitize_title( $block['anchor'] ) ) . '"' : '',
);

echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template ) ) . '" templateLock="all" />';

echo '</div>';