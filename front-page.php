<?php
/**
* Digital Nomad Theme
*
* This file adds the home page to the Digital Nomad theme.
*
* @package Digital Nomad Theme
* @author  thebrandiD
* @license GPL-2.0+
* @link    https://thebrandidthemes.com/
*/


add_filter( 'genesis_site_title_wrap', 'digital_nomad_h1_for_site_title' );
/**
 * Use h1 for site title.
 *
 * @param  string $wrap site title.
 * @return $wrap force h1.
 */
function digital_nomad_h1_for_site_title( $wrap ) {
	return 'h1';
}

add_action( 'genesis_meta', 'digital_nomad_front_page_genesis_meta' );

function digital_nomad_front_page_genesis_meta() {

	$home_widgets_active = false;

	if ( is_active_sidebar( 'front-page-welcome' ) || is_active_sidebar( 'front-page-block-1' ) || is_active_sidebar( 'front-page-grid' ) || is_active_sidebar( 'front-page-testimonials' ) || is_active_sidebar( 'front-page-blog' ) || is_active_sidebar( 'front-page-cta' ) || is_active_sidebar( 'front-page-block-2' )) {

		$home_widgets_active = true;

		// Remove .site-inner's .wrap from front page.
		add_theme_support( 'genesis-structural-wraps', array(
			'header',
			'nav',
			'subnav',
			'footer-widgets',
			'footer-widget-1',
			'footer-widget-2',
			'footer',
		) );
		//* Force full width content layout
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		//* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

		//* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		// Update header for home page.
		add_action( 'genesis_before_header', 'digital_nomad_before_header' );
		// add_action( 'genesis_header', 'digital_nomad_home_hero', 15 );
		add_action( 'genesis_after_header', 'digital_nomad_after_header' );
		//* Add homepage widgets
		add_action( 'genesis_loop', 'digital_nomad_front_page_widgets' );

	}

	//* Add featured-section body class
	if ( ! is_active_sidebar( 'front-page-welcome' ) ) {

			//* Add image-section-start body class
		add_filter( 'body_class', 'digital_nomad_featured_body_class' );
		function digital_nomad_featured_body_class( $classes ) {

			$classes[] = 'no-featured-section';

			return $classes;

		}

	}
	if ( ! $home_widgets_active) {

		//* Add image-section-start body class
		add_filter( 'body_class', 'digital_nomad_featured_body_class_widgets' );
		function digital_nomad_featured_body_class_widgets( $classes ) {

			$classes[] = 'home-widgets-inactive';

			return $classes;

		}

	}

}


	//* Add markup for front page widgets
function digital_nomad_front_page_widgets() {

	// Output remaining widget content.
	echo '<h2 class="genesis-content-title screen-reader-text">Main Content Area</h2>';

	genesis_widget_area( 'front-page-welcome', array(
		'before'	=> '<div class="front-page-welcome image-section widget-area">',
		'after'		=> '</div>',
		'before_title' => '<h2 class="widget-title widgettitle">',
		'before_after' => '</h2>',
	) );

	genesis_widget_area( 'front-page-grid', array(
		'before'	=> '<div class="front-page-grid widget-area">',
		'after'		=> '</div>',
		'before_title' => '<h2 class="widget-title widgettitle">',
		'before_after' => '</h2>',
	) );

	genesis_widget_area( 'front-page-cta', array(
		'before'	=> '<div class="front-page-cta image-section widget-area">',
		'after'		=> '</div>',
		'before_title' => '<h2 class="widget-title widgettitle">',
		'before_after' => '</h2>',
	) );

	genesis_widget_area( 'front-page-block-1', array(
		'before'	=> '<div class="front-page-block-1 image-section widget-area"><div class="wrap">',
		'after'		=> '</div></div>',
		'before_title' => '<h2 class="widget-title widgettitle">',
		'before_after' => '</h2>',
	) );

	genesis_widget_area( 'front-page-testimonials', array(
		'before'	=> '<div class="front-page-testimonials image-section widget-area">',
		'after'		=> '</div>',
		'before_title' => '<h2 class="widget-title widgettitle">',
		'before_after' => '</h2>',
	) );

	genesis_widget_area( 'front-page-blog', array(
		'before'	=> '<div class="front-page-blog widget-area"><div class="wrap">',
		'after'		=> '</div></div>',
		'before_title' => '<h2 class="widget-title widgettitle">',
		'before_after' => '</h2>',
	) );

	genesis_widget_area( 'front-page-block-2', array(
		'before'	=> '<div class="front-page-block-2 image-section widget-area">',
		'after'		=> '</div>',
		'before_title' => '<h2 class="widget-title widgettitle">',
		'before_after' => '</h2>',
	) );
}

/**
* Add markup
*/
function digital_nomad_before_header() {
	echo '<div class="custom-header-background open">';
}


/**
* Add markup
*/
function digital_nomad_home_hero() {

}

	/**
* Add markup
*/
function digital_nomad_after_header() {
	echo '</div>';
}

genesis();
