<?php
/**
 * Loads theme setup for Digital Nomad theme.
 *
 * @since 1.0
 *
 * @package Digital Nomad Theme
 */
// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// * Remove content/sidebar/sidebar layout
genesis_unregister_layout( 'content-sidebar-sidebar' );

// * Remove sidebar/sidebar/content layout
genesis_unregister_layout( 'sidebar-sidebar-content' );

// * Remove sidebar/content/sidebar layout
genesis_unregister_layout( 'sidebar-content-sidebar' );

// * Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 120,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
	'flex-width'     => true,
) );


// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 2-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 2 );

// Add Image Sizes.
add_image_size( 'featured-image', 900, 400, true );
add_image_size( 'featured-grid', 636, 758, true );
add_image_size( 'featured-blog', 760, 334, true );

function digital_nomad_show_custom_image_sizes( $sizes ) {

	return array_merge($sizes, array(
		'featured-image' => __( 'Featured Image', 'digital-nomad' ),
		'featured-grid' => __( 'Featured Grid', 'digital-nomad' ),
		'featured-blog' => __( 'Featured Blog', 'digital-nomad' ),
	));
}

/**
 * Remove Genesis Page Templates
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 * @param array $page_templates
 * @return array
 */
function digital_nomad_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_blog.php'] );
	//unset( $page_templates['page_archive.php'] );
	return $page_templates;
}
add_filter( 'theme_page_templates', 'digital_nomad_remove_genesis_page_templates', 20, 1 );

/**
 * Remove the blog page settings metabox from the Genesis Theme Settings
 * Desired if following the suggestion by Bill Erickson to not use the Blog page template
 * that comes standard in the Genesis Theme
 *
 * @link    http://www.billerickson.net/dont-use-genesis-blog-template/
 */
function digital_nomad_remove_unwanted_genesis_metaboxes() {
	remove_meta_box( 'genesis-theme-settings-blogpage', 'toplevel_page_genesis', 'main' );
}
add_action( 'toplevel_page_genesis_settings_page_boxes', 'digital_nomad_remove_unwanted_genesis_metaboxes' );

// * Add new image sizes to the image size dropdown
add_filter( 'image_size_names_choose', 'digital_nomad_show_custom_image_sizes' );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Menu', 'digital-nomad' ), 'secondary' => __( 'Footer Menu', 'digital-nomad' ) ) );

// Reposition the primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'digital_nomad_secondary_menu_args' );
function digital_nomad_secondary_menu_args( $args ) {

	if ( 'secondary' !== $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}
// Remove header right widget area
unregister_sidebar( 'header-right' );

remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Add a body class for the color scheme selected
add_filter( 'body_class', 'digital_nomad_theme_color_body_class' );
function digital_nomad_theme_color_body_class( $classes ) {

	// $selected_scheme = get_theme_mod( 'digital_nomad_colorscheme_setting', '3' );
	$fixed_header_off = get_theme_mod( 'fixed_header_off', false );
	$classes[] = ($fixed_header_off ? 'fixed-header-off' : 'fixed-header-on');
	// $classes[] = 'digital-nomad-color-scheme-' . $selected_scheme;
	$classes[] = 'no-js';
	$classes[] = has_nav_menu( 'primary' ) ? '' : 'no-primary-nav';
	return $classes;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'digital_nomad_author_box_gravatar' );
function digital_nomad_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'digital_nomad_comments_gravatar' );
function digital_nomad_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}
// Let's use the search form from WordPress core instead.
remove_filter( 'get_search_form', 'genesis_search_form' );

// Move the secondary sidebar within content-sidebar-wrap for flexbox
//
remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );
add_action( 'genesis_after_content','genesis_get_sidebar_alt' );


// Customize entry meta header
add_filter( 'genesis_post_info', 'digital_nomad_post_info_filter' );
function digital_nomad_post_info_filter( $post_info ) {
	$post_info = '[post_date] by [post_author_posts_link] | [post_comments] [post_edit]';
	return $post_info;
}

add_action( 'genesis_before_comments' , 'digital_nomad_comment_count' );
/**
 * Add comment count and remove standard comment title
 */
function digital_nomad_comment_count () {
	add_filter( 'genesis_title_comments', '__return_null' );
	if ( is_single() ) {
		if ( have_comments() ) {
			echo '<div class="comment-count-heading"><h3>';
			comments_number( 'No Comments', '(1) Comment', '(%) Comments' );
			echo '</h3></div>';
		}
	}
}

// * Customize read more text to include post title for screen readers
add_filter( 'excerpt_more', 'genesis_read_more_link' );
add_filter( 'get_the_content_more_link', 'genesis_read_more_link' );
add_filter( 'the_content_more_link', 'genesis_read_more_link' );
function genesis_read_more_link() {

	return '...</p><p><a href="'. get_permalink() .'" class="more-link">' . __( 'Read more ', 'digital-nomad' ) . '<span class="screen-reader-text"> ' . __( 'about', 'digital-nomad' ) . ' ' . get_the_title() . '</span></a>';

}

// Adds subtitles to single posts, only if the plugin WPSubtitle is active.
add_action( 'genesis_entry_header', 'digital_nomad_do_post_subtitle', 11 );
function digital_nomad_do_post_subtitle() {
	if ( function_exists( 'the_subtitle' ) ) {
		if ( is_singular() ) {
			$subtitle = trim( the_subtitle( '<p class="subtitle">','</p>', false ) );
			if ( '' !== $subtitle ) {
				echo $subtitle;
			}
		}
	}
}


// * Remove 'You are here' from the front of breadcrumb trail
function digital_nomad_prefix_breadcrumb( $args ) {
	$args['labels']['prefix'] = '';

	return $args;
}
add_filter( 'genesis_breadcrumb_args', 'digital_nomad_prefix_breadcrumb' );


function digital_nomad_change_breadcrumb_separator( $args ) {
	$args['sep'] = ' &rsaquo; ';
	return $args;
}
add_filter( 'genesis_breadcrumb_args', 'digital_nomad_change_breadcrumb_separator' );


// * Removes alignleft from featured image and replaces with alignnone to avoid wrapping of text on blog / archive pages
function digital_nomad_remove_image_alignment( $attributes ) {
	$attributes['class'] = str_replace( 'alignleft', 'alignnone', $attributes['class'] );
	return $attributes;
}
add_filter( 'genesis_attr_entry-image', 'digital_nomad_remove_image_alignment' );

add_action( 'genesis_entry_header', 'digital_nomad_show_featured_post_image', 1 );
function digital_nomad_show_featured_post_image() {
	// only show on single posts and pages
	if ( ! is_single() && ! is_page() || ! has_post_thumbnail() ) {
		return;
	}

	if ( $image = genesis_get_image( 'format=url&size=featured-image' ) ) {
		printf( '<img class="post-photo aligncenter" src="%s" alt="%s" />', $image, the_title_attribute( 'echo=0' ) );
	}
}

add_filter( 'genesis_footer_widget_areas', 'bid_add_footer_widgets_classes', 10, 2 );

/**
 * Add image-section class to footer widget areas 1
 *
 * @param string $output         Existing footer widget areas container markup.
 * @param int    $footer_widgets Number of configured footer widget areas.
 * @return string Possibly amended markup for footer widget areas container.
 */
function bid_add_footer_widgets_classes( string $output, int $footer_widgets ) {

	$output = str_replace( 'footer-widgets-1', 'footer-widgets-1 image-section', $output );

	return $output;
}
