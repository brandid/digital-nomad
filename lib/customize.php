<?php
/**
 * Loads customizer images and settings for Digital Nomad theme.
 *
 * @since 1.0
 *
 * @package Digital Nomad Theme
 */

add_action( 'customize_register', 'digital_nomad_customizer_register_2' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 1.0.0
 */
function digital_nomad_customizer_register_2() {

	if ( class_exists( 'WP_Customize_Control' ) ) {
		require_once( CHILD_THEME_DIR . '/includes/class-customizer-range-value-control/class-customizer-range-value-control.php' );
	}
	/**
	 * Customize Background Image Control Class
	 *
	 * @package WordPress
	 * @subpackage Customize
	 * @since 3.4.0
	 */
	class Child_digital_nomad_Image_Control_2 extends WP_Customize_Image_Control {

		/**
		 * Constructor.
		 *
		 * If $args['settings'] is not defined, use the $id as the setting ID.
		 *
		 * @since 3.4.0
		 * @uses WP_Customize_Upload_Control::__construct()
		 *
		 * @param WP_Customize_Manager $manager
		 * @param string               $id
		 * @param array                $args
		 */
		public function __construct( $manager, $id, $args ) {
			$this->statuses = array( '' => __( 'No Image', 'digital-nomad' ) );

			parent::__construct( $manager, $id, $args );

			// $this->add_tab( 'upload-new', __( 'Upload New', 'digital-nomad' ), array( $this, 'tab_upload_new' ) );
			// $this->add_tab( 'uploaded',   __( 'Uploaded', 'digital-nomad' ),   array( $this, 'tab_uploaded' ) );
			//
			// if ( $this->setting->default ) {
			// 	$this->add_tab( 'default',  __( 'Default', 'digital-nomad' ),  array( $this, 'tab_default_background' ) );
			// }

			// Early priority to occur before $this->manager->prepare_controls();.
			add_action( 'customize_controls_init', array( $this, 'prepare_control' ), 5 );
		}

		/**
		 * Tab.
		 *
		 * @since 3.4.0
		 * @uses WP_Customize_Image_Control::print_tab_image()
		 */
		public function tab_default_background() {
			$this->print_tab_image( $this->setting->default );
		}
	}

	global $wp_customize;

	$images = apply_filters( 'digital_nomad_images', array( '1', '2', '3', '4' ) );

	$wp_customize->add_section( 'digital-nomad-settings', array(
		'title'    => __( 'Front Page Background Images', 'digital-nomad' ),
		'priority' => 80,
		'active_callback' => 'is_front_page',
	) );

	foreach ( $images as $image ) {

		$wp_customize->add_setting( $image .'-digitalnomad-image', array(
				'default'  => sprintf( ' %s/images/bg-%s.jpg', CHILD_THEME_URI, $image ),
				'type'     => 'theme_mod',
				'sanitize_callback'	=> 'digital_nomad_sanitize_image',
		) );

		if ( '1' === $image ) {

			$wp_customize->add_control( new Child_digital_nomad_Image_Control_2( $wp_customize, $image .'-image', array(
				'label'    => sprintf( __( 'Front Page Welcome Section Image:', 'digital-nomad' ), $image ),
						'section'  => 'digital-nomad-settings',
						'description' => ' <hr> ',
						'settings' => $image .'-digitalnomad-image',
						'priority' => $image + 1,
			) ) );

		} elseif ( '2' === $image ) {

			$wp_customize->add_control( new Child_digital_nomad_Image_Control_2( $wp_customize, $image .'-image', array(
				'label'    => sprintf( __( 'Front Page Call To Action Section Image:', 'digital-nomad' ), $image ),
						'section'  => 'digital-nomad-settings',
						'description' => ' <hr> ',
						'settings' => $image .'-digitalnomad-image',
						'priority' => $image + 1,
			) ) );

		} elseif ( '3' === $image ) {

			$wp_customize->add_control( new Child_digital_nomad_Image_Control_2( $wp_customize, $image .'-image', array(
				'label'    => sprintf( __( 'Front Page Content Block 1 Image:', 'digital-nomad' ), $image ),
						'section'  => 'digital-nomad-settings',
						'description' => ' <hr> ',
						'settings' => $image .'-digitalnomad-image',
						'priority' => $image + 1,
			) ) );

		} else {

			$wp_customize->add_control( new Child_digital_nomad_Image_Control_2( $wp_customize, $image .'-image', array(
				'label'    => sprintf( __( 'Front Page Content Block 2 Image:', 'digital-nomad' ), $image ),
						'section'  => 'digital-nomad-settings',
						'description' => ' <hr> ',
						'settings' => $image .'-digitalnomad-image',
						'priority' => $image + 1,
			) ) );
		}

		$wp_customize->add_section('header_settings' , array(
				'title'     => __( 'General Settings', 'digital-nomad' ),
				'priority'  => 70,
		));

		$wp_customize->add_setting('fixed_header_off', array(
				'default'    => false,
				'type'     => 'theme_mod',
				'sanitize_callback' => 'digital_nomad_sanitize_checkbox',
		));

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'fixed_header_off',
				array(
								'label'     => __( 'Turn off Sticky Header Navigation on Desktop (allow header to scroll) ', 'digital-nomad' ),
								'section'   => 'header_settings',
								'settings'  => 'fixed_header_off',
								'type'      => 'checkbox',
						)
			)
		);

		$wp_customize->add_setting('mincss_header_on', array(
				'default'    => false,
				'type'     => 'theme_mod',
				'sanitize_callback' => 'digital_nomad_sanitize_checkbox',
		));

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'mincss_header_on',
				array(
								'label'     => __( 'Use minified CSS stylesheet', 'digital-nomad' ),
								'section'   => 'header_settings',
								'settings'  => 'mincss_header_on',
								'type'      => 'checkbox',
						)
			)
		);

		$wp_customize->add_section( 'header_image', array(
				 'title'          => __( 'Logo Image', 'digital-nomad' ),
				 'theme_supports' => 'custom-header',
				 'priority'       => 60,
		) );
		$wp_customize->add_setting( $image .'-digitalnomad-image-repeat', array(
			'default' => 'no-repeat',
			'type'     => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( $image .'-digitalnomad-image-repeat', array(
								'label'    => __( 'Background Repeat', 'digital-nomad' ),
								'section'  => 'digital-nomad-settings',
								'type'     => 'select',
								'priority' => $image + 1,
								'choices'  => array(
										'no-repeat'  => __( 'No Repeat', 'digital-nomad' ),
										'repeat'     => __( 'Tile' , 'digital-nomad' ),
										'repeat-x'   => __( 'Tile Horizontally', 'digital-nomad' ),
										'repeat-y'   => __( 'Tile Vertically' , 'digital-nomad' ),
								),
		) );

		$wp_customize->add_setting( $image .'-digitalnomad-image-size', array(
					'default' => 'cover',
					'type'     => 'theme_mod',
					'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( $image .'-digitalnomad-image-size', array(
								'label'      => __( 'Background Size', 'digital-nomad' ),
								'section'    => 'digital-nomad-settings',
								'type'       => 'select',
								'priority'   => $image + 1,
								'choices'    => array(
								'cover'      => __( 'Cover', 'digital-nomad' ),
								'contain'    => __( 'Contain', 'digital-nomad' ),
								'100% auto'  => __( '100% width', 'digital-nomad' ),
								'auto 100% '  => __( '100% height', 'digital-nomad' ),
								'auto'       => __( 'Actual Size' , 'digital-nomad' ),
						),

		));

		$wp_customize->add_setting( $image .'-digitalnomad-image-position-x', array(
						  'default'  => 'center',
							'type'     => 'theme_mod',
							'sanitize_callback' => 'sanitize_text_field',
		));

		$wp_customize->add_control( $image .'-digitalnomad-image-position-x', array(
							'label'      => __( 'Background Position Horizontal', 'digital-nomad' ),
							'section'    => 'digital-nomad-settings',
							'type'       => 'select',
							'priority'   => $image + 1,
							'choices'    => array(
									'left'       => __( 'Left', 'digital-nomad' ),
									'center'     => __( 'Center', 'digital-nomad' ),
									'right'      => __( 'Right', 'digital-nomad' ),
							),
		));

		$wp_customize->add_setting( $image .'-digitalnomad-image-position-y', array(
							'default'        => 'center',
									'type'     => 'theme_mod',
					 'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( $image .'-digitalnomad-image-position-y', array(
				'label'      => __( 'Background Position Vertical', 'digital-nomad' ),
				'section'  => 'digital-nomad-settings',
				'type'       => 'select',
				'priority' => $image + 1,
				'choices'    => array(
						'top'       => __( 'Top', 'digital-nomad' ),
						'center'     => __( 'Center', 'digital-nomad' ),
						'bottom'      => __( 'Bottom', 'digital-nomad' ),
				),
		) );

			$wp_customize->add_setting($image .'-digitalnomad-image-overlay-color', array(
				'default'           => '#333333',
				'sanitize_callback' => 'sanitize_hex_color',
				'type'     => 'theme_mod',
				)
			);

			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $image .'-digitalnomad-image-overlay-color', array(
					'description' => __( 'Change the color of the overlay for this image.', 'digital-nomad' ),
					'label'       => __( 'Overlay Color', 'digital-nomad' ),
					'section'  => 'digital-nomad-settings',
					'settings'    => $image .'-digitalnomad-image-overlay-color',
					'priority' => $image + 1,
			) ) );

			$wp_customize->add_setting( $image .'-digitalnomad-image-overlay', array(
								'default'        => '0.4',
								'type'     => 'theme_mod',
								'sanitize_callback' => 'sanitize_text_field',
			) );

			$wp_customize->add_control(new Customizer_Range_Value_Control( $wp_customize, $image .'-digitalnomad-image-overlay', array(
					'label'      => __( 'Background Overlay', 'digital-nomad' ),
					'description' => __( 'Opacity (0 = transparent | 1 = solid)', 'digital-nomad' ),
					'section'  => 'digital-nomad-settings',
					'type'       => 'range-value',
					'input_attrs' => array(
				'min' => 0.0,
				'max' => 1.0,
				'step' => 0.01,
				'suffix' => '',
				),
					'priority' => $image + 1,
			) ) );

			$wp_customize->add_control(new Customizer_Range_Value_Control( $wp_customize, $image .'-digitalnomad-image-overlay', array(
				'label'      => __( 'Overlay Opacity', 'digital-nomad' ),
				'description' => __( 'Opacity (0 = transparent | 1 = solid) <br><br><hr>', 'digital-nomad' ),
				'section'  => 'digital-nomad-settings',
				'type'       => 'range-value',
				'input_attrs' => array(
				'min' => 0.0,
				'max' => 1.0,
				'step' => 0.01,
				'suffix' => '',
				),
				'priority' => $image + 1,

			) ) );
	}
}



/**
 * Image sanitization callback.
 *
 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
 * send back the filename, otherwise, return the setting default.
 *
 *- Sanitization: image file extension
 *- Control: text, WP_Customize_Image_Control
 *
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @param string               $image   Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 */
function digital_nomad_sanitize_image( $image, $setting ) {

	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
	$mimes = array(
		'jpg|jpeg|jpe' => 'image/jpeg',
		'gif'          => 'image/gif',
		'svg'          => 'image/svg',
		'png'          => 'image/png',
		'bmp'          => 'image/bmp',
		'tif|tiff'     => 'image/tiff',
		'ico'          => 'image/x-icon',
	);

	// Return an array with file extension and mime_type.
	$file = wp_check_filetype( $image, $mimes );

	// If $image has a valid mime_type, return it; otherwise, return nothing.
	return ( $file['ext'] ? $image : '');
}

/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function digital_nomad_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}
