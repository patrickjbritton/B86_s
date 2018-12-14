<?php
/**
 * Template Name: Home Page
 *
 * This is the template that displays all widgets included in homepage widget area.
 *
 * @package AquariusThemes
 * @subpackage B86_s
 * @since 1.0.0
 */

get_header(); 

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Home Middle Section Area
 * 
 * @since 1.0.0
 */
if ( is_active_sidebar( 'B86_s_home_middle_section_area' ) ) {
	?>
	<div class="B86_s-home-middle-section B86_s-clearfix">
		<?php dynamic_sidebar( 'B86_s_home_middle_section_area' ); ?>
	</div><!-- .B86_s-home-middle-section -->
	<?php 
}

get_footer();