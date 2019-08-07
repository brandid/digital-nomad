<?php
/**
* Digital Nomad Theme
*
* This file adds custom search form to the Digital Nomad theme.
*
* @package Digital Nomad Theme
* @author  thebrandiD
* @license GPL-2.0+
* @link    https://thebrandidthemes.com/
*/

$unique_id = esc_attr( uniqid( 'search-form-' ) );

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'digital-nomad' ); ?></span>
	</label>
	<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'digital-nomad' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />

	<button type="submit" class="search-submit"><?php  echo digital_nomad_get_svg( array( 'icon' => 'search' ) ); ?><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'digital-nomad' ); ?></span></button>
</form>
