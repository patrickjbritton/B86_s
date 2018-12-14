<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AquariusThemes
 * @subpackage B86_s
 * @since 1.0.0
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
		/**
	     * B86_s_before_page hook
	     *
	     * @since 1.0.0
	     */
		do_action( 'B86_s_before_page' );
		?>

		<div id="page" class="site">
			<?php 
			$B86_s_top_header_option = get_theme_mod( 'B86_s_top_header_option', 'show' );
			if( $B86_s_top_header_option == 'show' ) {

				/**
			     * B86_s_top_header hook
			     *
			     * @hooked - B86_s_top_header_start - 5
			     * @hooked - B86_s_top_left_section - 10
			     * @hooked - B86_s_top_right_section - 15
			     * @hooked - B86_s_featured_post_toggle - 20
			     * @hooked - B86_s_top_header_end - 25
			     *
			     * @since 1.0.0
			     */
				do_action( 'B86_s_top_header' );
				$B86_s_ticker_option = get_theme_mod( 'B86_s_ticker_option', 'show' );
				if( $B86_s_ticker_option == 'show' ) {

					/**
				     * B86_s_top_header hook
				     *
				     * @hooked - B86_s_ticker_section_start - 5
				     * @hooked - B86_s_ticker_content - 10
				     * @hooked - B86_s_ticker_section_end - 15
				     *
				     * @since 1.0.0
				     */
					do_action( 'B86_s_ticker_section' );
				}
			}
			?>

			<?php 	
			/**
		     * B86_s_header_section hook
		     *
		     * @hooked - B86_s_header_section_start - 5
		     * @hooked - B86_s_header_logo_ads_section_start - 10
		     * @hooked - B86_s_site_branding_section - 15
		     * @hooked - B86_s_header_ads_section - 20
		     * @hooked - B86_s_header_logo_ads_section_end - 25
		     * @hooked - B86_s_primary_menu_section - 30
		     * @hooked - B86_s_header_section_end - 35
		     *
		     * @since 1.0.0
		     */
			do_action( 'B86_s_header_section' );
			?>

			<div id="content" class="site-content">
				<div class="at-container">