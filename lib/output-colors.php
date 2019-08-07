<?php
/**
* This file adds the required CSS to the front end of Digital Nomad theme.
*
* @package Digital Nomad theme
* @author  The BrandiD
* @license GPL-2.0+
* @link    https://thebrandidthemes.com/
*/

add_action( 'wp_enqueue_scripts', 'load_digital_nomad_color_css' );


function load_digital_nomad_color_css() {

	$selected_scheme = get_theme_mod( 'digital_nomad_colorscheme_setting', 'custom' );

	digital_nomad_color_css( $selected_scheme );
}
/**
 * Checks the settings for the colors.
 *
 * @since  1.0.0
 *
 * @param  array $selected_scheme scheme in use
 */
function digital_nomad_color_css( $selected_scheme ) {

	$handle  = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';

	// Check to be sure we have a theme color selected, if not use theme 3.
	if (empty( $selected_scheme ) || null === $selected_scheme ) {
		$selected_scheme = 'custom';
	}

	// Load the selected theme colors.
	$color = get_digital_nomad_theme_colors( $selected_scheme );

	$default_color = scheme_custom_default_colors();
	//  d( $color, $default_color );
	$css = '';

	/* ---------------------- COLOR 1 --------------------------------------------- */
	if ( ! empty( $color[0] ) && ($color[0] !== $default_color['one']) ) {
		$css .= sprintf('
		archive-pagination .active a,
		.button,
		.home .widget .button,
		.menu-toggle,
		.sidebar .enews-widget input[type="submit"],
		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		#menu-social-menu li,
		.menu-toggle:focus,
		.menu-toggle:hover,
		.archive-pagination li a:focus,
		.archive-pagination li a:hover  {
	background-color: %s;
}', $color[0] );

			$css .= sprintf('
		.footer-widgets .footer-widgets-2 a,
		.front-page-1a .widget-title,
		.front-page-2 section.digital-nomad-subtitle:last-of-type p:first-of-type,
		.front-page-3 section.digital-nomad-subtitle:first-of-type p:first-child,
		.menu-social-menu-container li > a,
		.sub-menu-toggle,
		.sub-menu-toggle:focus,
		.sub-menu-toggle:hover,
		.subtitle,
		a {
  color: %s;
}', $color[0] );

			$css .= sprintf('
		.footer-widgets .footer-widgets-2 a,
		.front-page-testimonials .testimonial-author-img img,
		.home .widget .button,
		.menu-toggle,
		.menu-toggle:focus,
		.menu-toggle:hover,
		.sub-menu-toggle,
		a {
  border-color: %s;
}', $color[0] );

	}
	/* ---------------------- COLOR 2 --------------------------------------------- */
	if ( ! empty( $color[1] ) && ($color[1] !== $default_color['two']) ) {
		$css .= sprintf('
.search-form {
  border-color: %s;
}', $color[1] );
		$css .= sprintf( '
		.entry-title a:focus,
		.entry-title a:hover,
		a:focus,
		a:hover  {
  color: %s
}', $color[1] );
		$css .= sprintf( '
		.js.fixed-header-off .custom-header-background .site-header,
		.js.fixed-header-on .custom-header-background.light .site-header,
		.genesis-nav-menu .sub-menu,
		.no-js.custom-header .site-header,
		.home.no-featured-section .custom-header-background .site-header,
		.js.home.no-featured-section.fixed-header-on .custom-header-background .site-header,
		.menu-toggle,
		.site-footer,
		.site-header {
  background-color: %s;
}', $color[1] );

	}
	/* ---------------------- COLOR 3 --------------------------------------------- */
	if ( ! empty( $color[2] ) && ($color[2] !== $default_color['three']) ) {
			$css .= sprintf( '
.front-page-testimonials {
  background-color: %s;
}', $color[2] );

	}
	/* ---------------------- COLOR 4 --------------------------------------------- */

	if ( ! empty( $color[3] ) && ($color[3] !== $default_color['four']) ) {
		$css .= sprintf( '
.footer-widgets-1  {
 background-color: %s;
}', $color[3], $color[3] );
	}

	/* ---------------------- COLOR 5 --------------------------------------------- */
	if ( ! empty( $color[4] ) && ($color[4] !== $default_color['five']) ) {
		$css .= sprintf( '
		#menu-social-menu li,
		#menu-social-menu li > a:focus,
		#menu-social-menu li > a:hover,
		#menu-social-menu li:focus,
		#menu-social-menu li:hover,
		.genesis-nav-menu a,
		.footer-widgets .footer-widgets-1 a,
		.footer-widgets .widget-area a.button,
		.site-footer,
		.site-footer a,
		.site-header .site-description,
		.site-header .site-title a,
		site-footer .genesis-nav-menu a {
  color: %s
}', $color[4] );
		$css .= sprintf( '
		.site-footer,
		.site-footer a,
		.footer-widgets .footer-widgets-1 a,
		.footer-widgets .widget-area a.button  {
border-bottom-color: %s
}', $color[4] );
	}

	/* ---------------------- COLOR 6 --------------------------------------------- */
	if ( ! empty( $color[5] ) && ($color[5] !== $default_color['six']) ) {
		// Use "Custom" colors
		$css .= sprintf( '
		.custom-header-background .site-header .site-title a:focus,
		.custom-header-background .site-header .site-title a:hover,
		.genesis-nav-menu .current-menu-item > a,
		.genesis-nav-menu a:focus,
		.genesis-nav-menu a:hover,
		.menu-social-menu-container li > a:focus,
		.menu-social-menu-container li > a:hover,
		.site-footer .genesis-nav-menu .current-menu-item > a,
		.site-footer .genesis-nav-menu a:focus,
		.site-footer .genesis-nav-menu a:hover,
		.site-footer a:hover,
		.site-footer a:focus,
		.site-header .site-title a:focus,
		.site-header .site-title a:hover {
  color: %s;
}', $color[5] );

		$css .= sprintf( '
		.genesis-nav-menu .current-menu-item > a > span,
		.genesis-nav-menu .current-menu-parent > a > span,
		.genesis-nav-menu a:focus > span,
		.genesis-nav-menu a:hover > span,
		.site-footer .genesis-nav-menu .current-menu-item > a > span,
		.site-footer .genesis-nav-menu .current-menu-parent > a > span,
		.site-footer .genesis-nav-menu a:focus > span,
		.site-footer .genesis-nav-menu a:hover > span {
   border-bottom-color: %s;
}', $color[5] );

		$css .= sprintf( '
				 .front-page-testimonials .testimonial-author-img img {
		 		  		  border-color: %s;
		}', $color[5]  );

		$css .= sprintf( '
		.sidebar .enews-widget input[type="submit"]:focus,
		.sidebar .enews-widget input[type="submit"]:hover,
		.button:focus,
		.button:hover,
		button:focus,
		button:hover,
		input[type="button"]:focus,
		input[type="button"]:hover,
		input[type="reset"]:focus,
		input[type="reset"]:hover,
		input[type="submit"]:focus,
		input[type="submit"]:hover,
		.home .widget .button:focus,
		.home .widget .button:focus p,
		.home .widget .button:focus p a,
		.home .widget .button:hover,
		.home .widget .button:hover p,
		.home .widget .button:hover p a,
		menu-social-menu li > a:focus,
		#menu-social-menu li > a:hover,
		#menu-social-menu li:focus,
		#menu-social-menu li:hover {
background-color: %s;

}', $color[5] );
	}

	/* OUTPUT INLINE STYLES IF NEEDED */
	if ( $css ) {
		wp_add_inline_style( $handle, $css );
	}
}
