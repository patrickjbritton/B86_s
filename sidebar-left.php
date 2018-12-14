<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AquariusThemes
 * @subpackage B86_s
 * @since 1.0.0
 */

if ( ! is_active_sidebar( 'B86_s_left_sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'B86_s_left_sidebar' ); ?>
</aside><!-- #secondary -->
