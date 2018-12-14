<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package B86
 * @subpackage B86_s
 * @since 1.0.0
 */

?>

</div><!-- .at-container -->
</div><!-- #content -->

<?php
		/**
	     * B86_s_footer hook
	     * @hooked - B86_s_footer_start - 5
	     * @hooked - B86_s_top_footer_widget_section - 10
	     * @hooked - B86_s_main_footer_start - 15
	     * @hooked - B86_s_footer_menu_section - 20
	     * @hooked - B86_s_footer_site_info_section - 25
	     * @hooked - B86_s_main_footer_widget_section - 30
	     * @hooked - B86_s_footer_menu_section - 35
	     * @hooked - B86_s_bottom_footer_end - 40
	     * @hooked - B86_s_footer_end - 45
	     *
	     * @since 1.0.0
	     */
		do_action( 'B86_s_footer' );
		?>
	</div><!-- #page -->

	<?php
	/**
     * B86_s_after_page hook
     *
     * @since 1.0.0
     */
	do_action( 'B86_s_after_page' );
	?>

	<?php wp_footer(); ?>

</body>
</html>