<?php
/**
 * Loads widgets for Digital Nomad theme.
 *
 * @since 1.0
 *
 * @package Digital Nomad Theme
 */

genesis_register_widget_area(
	array(
	'id'          => 'front-page-welcome',
	'name'        => __( 'Front Page Welcome Section', 'digital-nomad' ),
	'description' => __( 'This is the welcome area in the header.', 'digital-nomad' ),
	)
);

genesis_register_widget_area(
	array(
	'id'          => 'front-page-grid',
	'name'        => __( 'Front Page Grid', 'digital-nomad' ),
	'description' => __( 'This is the front page grid section.', 'digital-nomad' ),
	)
);

genesis_register_widget_area(
	array(
	'id'          => 'front-page-cta',
	'name'        => __( 'Front Page Call to Action', 'digital-nomad' ),
	'description' => __( 'This is the call to action  section.', 'digital-nomad' ),
	)
);

genesis_register_widget_area(
	array(
	'id'          => 'front-page-block-1',
	'name'        => __( 'Front Page Block 1', 'digital-nomad' ),
	'description' => __( 'This is a front page section widget area.', 'digital-nomad' ),
	)
);

genesis_register_widget_area(
	array(
	'id'          => 'front-page-testimonials',
	'name'        => __( 'Front Page Testimonials', 'digital-nomad' ),
	'description' => __( 'This is the front page testimonials section.', 'digital-nomad' ),
	)
);

genesis_register_widget_area(
	array(
	'id'          => 'front-page-blog',
	'name'        => __( 'Front Page Blog', 'digital-nomad' ),
	'description' => __( 'This is a front page blog section widget area.', 'digital-nomad' ),
	)
);

genesis_register_widget_area(
	array(
	'id'          => 'front-page-block-2',
	'name'        => __( 'Front Page Block 2', 'digital-nomad' ),
	'description' => __( 'This is a front page section widget area.', 'digital-nomad' ),
	)
);
