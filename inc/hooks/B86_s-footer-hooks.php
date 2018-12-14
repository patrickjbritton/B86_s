<?php
/**
 * Custom hooks functions are define about footer section.
 *
 * @package B86
 * @subpackage B86_s
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer start
 *
 * @since 1.0.0
 */
if( ! function_exists( 'B86_s_footer_start' ) ) :
	function B86_s_footer_start() {
		echo '<footer id="colophon" class="site-footer" role="contentinfo">';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer Top widget section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'B86_s_top_footer_widget_section' ) ) :
	function B86_s_top_footer_widget_section() {
		$B86_s_footer_layout = get_theme_mod( 'footer_widget_layout', 'column_three' );
		?>
		<div id="top-footer" class="footer-widgets-wrapper footer_<?php echo esc_attr( $B86_s_footer_layout ); ?> B86_s-clearfix">
			<div class="at-container">
				<div class="B86_s-top-footer-widget wow fadeInLeft" data-wow-duration="0.5s">
					<?php
					if ( !dynamic_sidebar( 'B86_s_top_footer' ) ):
					endif;
					?>
				</div>
			</div><!-- .at-container -->
		</div><!-- .footer-widgets-wrapper -->
		<?php
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
* Bottom footer start
*
* @since 1.0.0
*/
if( ! function_exists( 'B86_s_main_footer_start' ) ) :
	function B86_s_main_footer_start() {
		echo '<div class="main-footer B86_s-clearfix">';
		echo '<div class="at-container">';
	}
endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
	/**
	* Bottom footer menu
	*
	* @since 1.0.0
	*/
	if( ! function_exists( 'B86_s_footer_menu_section' ) ) :
		function B86_s_footer_menu_section() {
			?>
			<nav id="footer-navigation" class="footer-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'B86_s_footer_menu', 'menu_id' => 'footer-menu' ) );
				?>
			</nav><!-- #site-navigation -->
			<?php
		}
	endif;

	/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer main widget section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'B86_s_main_footer_widget_section' ) ) :
	function B86_s_main_footer_widget_section() {
		?>
		<div class="main-footer-widgets-area B86_s-clearfix">
			<div class="B86_s-footer-widget-wrapper B86_s-column-wrapper B86_s-clearfix">
				<div class="B86_s-footer-widget wow fadeInLeft" data-woww-duration="1s">
					<?php
					if ( !dynamic_sidebar( 'B86_s_main_footer' ) ):
					endif;
					?>
				</div>
			</div><!-- .B86_s-footer-widget-wrapper -->
		</div><!-- .footer-widgets-area -->
		<?php
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'B86_s_main_footer_end' ) ) :
	function B86_s_main_footer_end() {
		echo '</div><!-- .at-container -->';
		echo '</div> <!-- bottom-footer -->';
	}
endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Bottom footer side info
 *
 * @since 1.0.0
 */
if( ! function_exists( 'B86_s_footer_site_info_section' ) ) :
	function B86_s_footer_site_info_section() {
		?>
		<div class="site-info">
			<span class="B86_s-copyright-text">
				<?php 
				$B86_s_copyright_text = get_theme_mod( 'B86_s_copyright_text', __( 'B86_s', 'B86_s' ) );
				echo esc_html( $B86_s_copyright_text );
				?>
			</span>
			<span class="sep"> | </span>
			<?php
			$B86_s_author_url = 'http://B86.com/';
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %1$s by %2$s.', 'B86_s' ), 'B86_s', '<a href="'. esc_url( $B86_s_author_url ).'" rel="designer" target="_blank">B86</a>' );
			?>
		</div><!-- .site-info -->
		<?php
	}
endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Footer end
 *
 * @since 1.0.0
 */
if( ! function_exists( 'B86_s_footer_end' ) ) :
	function B86_s_footer_end() {
		echo '</footer><!-- #colophon -->';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Go to Top Icon
 *
 * @since 1.0.0
 */

if( ! function_exists( 'B86_s_go_top' ) ) :
	function B86_s_go_top() {
		echo '<div id="B86_s-scrollup" class="animated arrow-hide"><i class="fa fa-chevron-up"></i></div>';
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Managed functions for footer hook
 *
 * @since 1.0.0
 */
add_action( 'B86_s_footer', 'B86_s_footer_start', 5 );
add_action( 'B86_s_footer', 'B86_s_top_footer_widget_section', 10 );
add_action( 'B86_s_footer', 'B86_s_main_footer_start', 15 );
add_action( 'B86_s_footer', 'B86_s_footer_menu_section', 20 );
add_action( 'B86_s_footer', 'B86_s_main_footer_widget_section', 25 );
add_action( 'B86_s_footer', 'B86_s_main_footer_end', 30 );
add_action( 'B86_s_footer', 'B86_s_footer_site_info_section', 35 );
add_action( 'B86_s_footer', 'B86_s_footer_end', 40 );
add_action( 'B86_s_footer', 'B86_s_go_top', 45 );