<?php
/**
 * Loads customizer colors for Digital Nomad theme.
 *
 * @since 1.0
 *
 * @package Digital Nomad Theme
 */

function scheme_custom_default_colors() {
	// Defaults
	$colors['one'] = '#445740';
	$colors['two'] = '#2c2e2b';
	$colors['three'] = '#474b57';
	$colors['four'] = '#965223';
	$colors['five'] = '#ffffff';
	$colors['six'] = '#c66c21';
	return $colors;
}
/**
 * Get default colors for color schemes
 */
function get_color_defaults( $scheme, $color ) {

	// Use color scheme number arg
	$colorscheme_num = $scheme;

	$scheme_custom_default_colors = scheme_custom_default_colors();

	$color_default = '';

	if ( 'custom' === $colorscheme_num ) {

		// Custom
		switch ($color) {
			case 1:
				$color_default = $scheme_custom_default_colors['one'];
				//	$color_default = $scheme_custom_default_colors['one'];
				break;
			case 2:
				$color_default = $scheme_custom_default_colors['two'];
				//	$color_default = $scheme_custom_default_colors['two'];
				break;
			case 3:
				$color_default = $scheme_custom_default_colors['three'];
				//	$color_default = $scheme_custom_default_colors['three'];
				break;
			case 4:
				$color_default = $scheme_custom_default_colors['four'];
				//	$color_default = $scheme_custom_default_colors['four'];
				break;
			case 5:
				$color_default = $scheme_custom_default_colors['five'] ;
				//		$color_default = $scheme_custom_default_colors['five'];
				break;
			case 6:
				$color_default = $scheme_custom_default_colors['six'];
				//	$color_default = $scheme_custom_default_colors['six'];
				break;
			default:
				$color_default = '';
				break;
		}
	}

	// return default colorX for this scheme
	return $color_default;
}



add_action( 'customize_register', 'digital_nomad_color_settings' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function digital_nomad_color_settings() {

	global $wp_customize;

	// 'COLOR OPTIONS' SECTION
	$wp_customize->add_section( 'color_options_section', array(
		'title' => __( 'Color Scheme', 'digital-nomad' ),
		'priority' => 20,
	));

	/* COLOR SCHEME
	------------------------------------------------------ */

	/* CUSTOM COLOR 1
	------------------------------------------------------ */
	// setting
	$wp_customize->add_setting( 'digital_nomad_theme_color1_setting', array(
		'default' => get_color_defaults( 'custom','1' ),
		'sanitize_callback' => 'sanitize_hex_color',
	));

	// control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'digital_nomad_theme_color1_setting',
			array(
				'label'       => __( 'Text Link / Button Background', 'digital-nomad' ),
				'section'     => 'color_options_section',
				'settings'    => 'digital_nomad_theme_color1_setting',
			)
		)
	);

	/* CUSTOM COLOR 2
	------------------------------------------------------ */
	// setting
	$wp_customize->add_setting( 'digital_nomad_theme_color2_setting', array(
		'default' => get_color_defaults( 'custom','2' ),
		'sanitize_callback' => 'sanitize_hex_color',
	));

	// control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'digital_nomad_theme_color2_setting',
			array(
				'label'       => __( 'Header / Footer Background', 'digital-nomad' ),
				'section'     => 'color_options_section',
				'settings'    => 'digital_nomad_theme_color2_setting',
			)
		)
	);

	/* CUSTOM COLOR 3
	------------------------------------------------------ */
	// setting
	$wp_customize->add_setting( 'digital_nomad_theme_color3_setting', array(
		'default' => get_color_defaults( 'custom','3' ),
		'sanitize_callback' => 'sanitize_hex_color',
	));

	// control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'digital_nomad_theme_color3_setting',
			array(
				'label'       => __( 'Home Page Testimonial Background', 'digital-nomad' ),
				'section'     => 'color_options_section',
				'settings'    => 'digital_nomad_theme_color3_setting',
			)
		)
	);

	/* CUSTOM COLOR 4
	------------------------------------------------------ */
	// setting
	$wp_customize->add_setting( 'digital_nomad_theme_color4_setting', array(
		'default' => get_color_defaults( 'custom','4' ),
		'sanitize_callback' => 'sanitize_hex_color',
	));

	// control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'digital_nomad_theme_color4_setting',
			array(
				'label'       => __( 'Footer Widget # 1 Background', 'digital-nomad' ),
				'section'     => 'color_options_section',
				'settings'    => 'digital_nomad_theme_color4_setting',
			)
		)
	);

	/* CUSTOM NAV TEXT COLOR
	------------------------------------------------------ */
	// setting
	$wp_customize->add_setting( 'digital_nomad_theme_nav_text_color_setting', array(
		'default' => get_color_defaults( 'custom','5' ),
		'sanitize_callback' => 'sanitize_hex_color',
	));

	// control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'digital_nomad_theme_nav_text_color_setting',
			array(
				'label'       => __( 'Navigation Text in Header / Footer', 'digital-nomad' ),
				'section'     => 'color_options_section',
				'settings'    => 'digital_nomad_theme_nav_text_color_setting',
			)
		)
	);

	/* CUSTOM NAV TEXT HOVER COLOR
	------------------------------------------------------ */
	// setting
	$wp_customize->add_setting( 'digital_nomad_theme_nav_text_hover_color_setting', array(
		'default' => get_color_defaults( 'custom','6' ),
		'sanitize_callback' => 'sanitize_hex_color',
	));

	// control
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'digital_nomad_theme_nav_text_hover_color_setting',
			array(
				'label'       => __( 'Navigation Text / Button Hover Background', 'digital-nomad' ),
				'section'     => 'color_options_section',
				'settings'    => 'digital_nomad_theme_nav_text_hover_color_setting',
			)
		)
	);

}
