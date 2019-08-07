<?php
/**
 * Digital Nomad Theme Front Page Images
 *
 * This file adds the required CSS to the front end to the Digital Nomad Theme
 *
 * @package Digital Nomad
 * @author  BrandiD
 * @license GPL-2.0+
 * @link    https://thebrandid.com
 */

add_action( 'wp_enqueue_scripts', 'digital_nomad_css_output' );
/**
 * Checks the settings for the home page images.
 * If any of these value are set the appropriate CSS is output.
 *
 * @since 2.2.3
 */
function digital_nomad_css_output() {

	if ( ! is_front_page()) {
		return;
	}

	$handle  = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';

	$opts = apply_filters( 'digital_nomad_images', array( '1', '2', '3', '4' ) );

	$settings = array();

	foreach ( $opts as $opt ) {

		$settings[ $opt ]['image'] = preg_replace( '/^https?:/', '', get_theme_mod( $opt .'-digitalnomad-image', sprintf( '%s/images/bg-%s.jpg', CHILD_THEME_URI, $opt ) ) );
		$settings[ $opt ]['image-repeat'] = get_theme_mod( $opt .'-digitalnomad-image-repeat' );
		$settings[ $opt ]['image-size'] = get_theme_mod( $opt .'-digitalnomad-image-size' );
		$settings[ $opt ]['image-digitalnomad-image-position-x'] = get_theme_mod( $opt .'-digitalnomad-image-position-x' );
		$settings[ $opt ]['image-digitalnomad-image-position-y'] = get_theme_mod( $opt .'-digitalnomad-image-position-y' );
		$settings[ $opt ]['image-digitalnomad-image-overlay'] = get_theme_mod( $opt .'-digitalnomad-image-overlay' );
		$settings[ $opt ]['image-digitalnomad-image-overlay-color'] = get_theme_mod( $opt .'-digitalnomad-image-overlay-color' );
	}

	$css = '';

	foreach ( $settings as $section => $value ) {
		$background_repeat = $value['image-repeat'] ? $value['image-repeat'] : 'no-repeat' ;
		$background_size = $value['image-size'] ? $value['image-size'] : 'cover' ;
		$background_pos_x = $value['image-digitalnomad-image-position-x'] ? $value['image-digitalnomad-image-position-x'] : 'center' ;
		$background_pos_y = $value['image-digitalnomad-image-position-y'] ? $value['image-digitalnomad-image-position-y'] : 'center' ;
		$background = $value['image'] ? sprintf( 'background: url(%s) %s %s %s/%s;', $value['image'], $background_repeat, $background_pos_x, $background_pos_y ,  $background_size ) : '';
		if (null === $value['image-digitalnomad-image-overlay']) {
			$value['image-digitalnomad-image-overlay'] = '0.4';
		}
		$background_overlay = $value['image-digitalnomad-image-overlay'];

		$background_overlay_color = $value['image-digitalnomad-image-overlay-color'] ? $value['image-digitalnomad-image-overlay-color'] : '#333333' ;
		$background_overlay_rgba = digital_nomad_convert_hex2rgba( $background_overlay_color, $background_overlay );

		if ( is_front_page() ) {

			if ( 1 === $section  ) {
				$css .= ( ! empty( $section ) && ! empty( $background ) ) ? sprintf( '.front-page-welcome { %s }', $background ) : '';
				$css .= ( ! empty( $section ) && ! empty( $background_overlay ) ) ? '.front-page-welcome:before { background: ' . $background_overlay_rgba . '}' : '';

			} elseif ( 2 === $section ) {

				$css .= ( ! empty( $section ) && ! empty( $background ) ) ? sprintf( '.front-page-cta { %s }',  $background ) : '';
				$css .= ( ! empty( $section ) && ! empty( $background_overlay ) ) ? '.front-page-cta:before { background: ' . $background_overlay_rgba . '}' : '';

			} elseif ( 3 === $section ) {

				$css .= ( ! empty( $section ) && ! empty( $background ) ) ? sprintf( '.front-page-block-1 { %s }', $background ) : '';
				$css .= ( ! empty( $section ) && ! empty( $background_overlay ) ) ? '.front-page-block-1:before { background: ' . $background_overlay_rgba . '}' : '';

			} else {
				$css .= ( ! empty( $section ) && ! empty( $background ) ) ? sprintf( '.front-page-block-2 { %s }', $background ) : '';
				$css .= ( ! empty( $section ) && ! empty( $background_overlay ) ) ? '.front-page-block-2:before { background: ' . $background_overlay_rgba . '}' : '';
			}
		}
	}

	if ( $css ) {
			wp_add_inline_style( $handle, $css );
	}
}
