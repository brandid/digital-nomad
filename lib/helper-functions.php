<?php
/**
 * Digital Nomad Theme
 *
 * This file adds helper functions to the Digital Nomad theme.
 *
 * @package Digital Nomad Theme
 * @author  thebrandiD
 * @license GPL-2.0+
 * @link    https://thebrandidthemes.com/
 */
/**
 * Loads theme colors.
 *
 * @since  1.0.0
 *
 * @param  string $selected_scheme The selected scheme in the customizer.
 *
 * @return array $color Return the array $color.
 */
function get_digital_nomad_theme_colors( $selected_scheme ) {

	if ( empty( $selected_scheme ) || null === $selected_scheme ) {
		// Set the default theme.
		$selected_scheme = 'custom';
	}

	// Set defaults
	$color = array();
	$default = scheme_custom_default_colors();
	$color[0] = get_theme_mod( 'digital_nomad_theme_color1_setting' ) ? get_theme_mod( 'digital_nomad_theme_color1_setting' ) : $default['one'];
	$color[1] = get_theme_mod( 'digital_nomad_theme_color2_setting' ) ? get_theme_mod( 'digital_nomad_theme_color2_setting' ) : $default['two'];
	$color[2] = get_theme_mod( 'digital_nomad_theme_color3_setting' ) ? get_theme_mod( 'digital_nomad_theme_color3_setting' ) : $default['three'];
	$color[3] = get_theme_mod( 'digital_nomad_theme_color4_setting' ) ? get_theme_mod( 'digital_nomad_theme_color4_setting' ) : $default['four'];
	$color[4] = get_theme_mod( 'digital_nomad_theme_nav_text_color_setting' ) ? get_theme_mod( 'digital_nomad_theme_nav_text_color_setting' ) : $default['five'];
	$color[5] = get_theme_mod( 'digital_nomad_theme_nav_text_hover_color_setting' ) ? get_theme_mod( 'digital_nomad_theme_nav_text_hover_color_setting' ) : $default['six'];

	return $color;
}


function digital_nomad_convert_hex2rgba( $color, $opacity = false ) {
	$default = 'rgb(0,0,0)';

	if ( empty( $color ) ) {
		return $default; }

	if ( '#' === $color[0] ) {
		$color = substr( $color, 1 );
	}

	if ( strlen( $color ) === 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) === 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else { 		return $default; }

	$rgb = array_map( 'hexdec', $hex );

	if ( $opacity ) {
		if ( abs( $opacity ) > 1 ) {
			$opacity = 1.0;
		}
		$output = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';
	} else {
		$output = 'rgb(' . implode( ',', $rgb ) . ')';
	}
		return $output;
}
