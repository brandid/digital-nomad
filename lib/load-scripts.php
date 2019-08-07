<?php
/**
 * Loads scripts and stylesheets for Digital Nomad theme.
 *
 * @since 1.0
 *
 * @package Digital Nomad Theme
 */


// Enqueue Scripts and Styles.

// Load the main stylesheet
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'genesis_meta', 'digital_nomad_enqueue_main_stylesheet', 5 );

function digital_nomad_enqueue_main_stylesheet() {

	$use_minified_stylesheet = get_theme_mod( 'mincss_header_on' );

	$suffix = ! $use_minified_stylesheet ? '' : '.min';
	$handle  = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';
	wp_enqueue_style( $handle , CHILD_THEME_URI . "/style{$suffix}.css", false, CHILD_THEME_VERSION );

	if ( is_front_page() ) {
		// Enqueue styles
		wp_enqueue_style( 'front-styles', CHILD_THEME_URI . "/home{$suffix}.css", array( 'digital-nomad' ), CHILD_THEME_VERSION, false );

	}
}


	add_action( 'wp_enqueue_scripts', 'digital_nomad_enqueue_scripts_styles' );
	/**
 * Enqueue Scripts and Styles
 *
 * @since 1.0.0
 */
function digital_nomad_enqueue_scripts_styles() {
	$suffix = ( defined( 'DIGITAL_NOMAD_DEBUG' ) && DIGITAL_NOMAD_DEBUG ) ? '' : '.min';
	wp_enqueue_style( 'digital-nomad-fonts', '//fonts.googleapis.com/css?family=Questrial:400|Raleway:400,400i,600,600i,700,700i', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_script( 'global-scripts', CHILD_THEME_URI . "/js/global{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	if ( is_front_page() ) {
		// Enqueue script
			wp_enqueue_script( 'homepage-scripts', CHILD_THEME_URI . "/js/home{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	}
	wp_enqueue_script( 'digital-nomad-responsive-menu', CHILD_THEME_URI. "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'digital-nomad-responsive-menu',
		'genesis_responsive_menu',
		digital_nomad_responsive_menu_settings()
	);

}



	/**
 * Define our responsive menu settings.
 *
 * @since  1.0.0
 */
function digital_nomad_responsive_menu_settings() {

	$settings = array(
	'mainMenu'          => __( 'Menu', 'digital-nomad' ),
	'menuIconClass'     => 'dashicons-before dashicons-menu',
	'subMenu'           => __( 'Submenu', 'digital-nomad' ),
	'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
	'menuClasses'       => array(
		'combine' => array(
			'.nav-primary',
			'.nav-header',
		),
		'others'  => array(),
	),
	);

	return $settings;

}
