<?php
/**
 * B86_s custom function and work related to widgets.
 *
 * @package B86
 * @subpackage B86_s
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function B86_s_widgets_init() {
	
	/**
	 * Register right sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'B86_s' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'B86_s' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register left sidebar
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Left Sidebar', 'B86_s' ),
		'id'            => 'B86_s_left_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'B86_s' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register home middle section area
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Home Middle Section', 'B86_s' ),
		'id'            => 'B86_s_home_middle_section_area',
		'description'   => esc_html__( 'This only works if you set a static home page, and select the provided homepage template as page template.', 'B86_s' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="B86_s-block-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	/**
	 * Register Top footer different footer area 
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Top Footer', 'B86_s' ),
		'id'            => 'B86_s_top_footer',
		'description'   => esc_html__( 'Added widgets are display at Top Footer Widget Area.', 'B86_s' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	/**
	 * Register Main footer different footer area 
	 *
	 * @since 1.0.0
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Main Footer', 'B86_s' ),
		'id'            => 'B86_s_main_footer',
		'description'   => esc_html__( 'Added widgets are display at Main Footer Widget Area.', 'B86_s' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'B86_s_widgets_init' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register different widgets
 *
 * @since 1.0.1
 */
add_action( 'widgets_init', 'B86_s_register_widgets' );

function B86_s_register_widgets() {

	// Block Posts
	register_widget( 'B86_s_Block_Posts' );

	// Featured Slider
	register_widget( 'B86_s_Featured_Slider' );

	// Social Media
	register_widget( 'B86_s_Social_Media' );
	
	//cta with form
	register_widget('B86_s_cta_form');

	if ( class_exists( 'WooCommerce' ) ) {
		register_widget( 'B86_s_product_Carousel' );
		register_widget('B86_s_cat_product');
		register_widget('B86_s_product');
		register_widget('B86_s_special_product');
	}
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Load widget required files
 *
 * @since 1.0.0
 */

get_template_part('inc/widgets/B86_s','widget-fields');    // Widget fields
get_template_part('inc/widgets/B86_s','featured-slider');  // Featured Slider widget
get_template_part('inc/widgets/B86_s','block-posts');      // Block posts widget
get_template_part('inc/widgets/B86_s','social-media');     // Social Media widget
get_template_part('inc/widgets/B86_s','cta-form');     // CTA with shortcode widget

if ( class_exists( 'WooCommerce' ) ) {
	get_template_part('inc/widgets/B86_s','product-carousel');  // Product Carousel widget
	get_template_part('inc/widgets/B86_s','product' );  // product slider widget
	get_template_part('inc/widgets/B86_s','cat-product');     // category & product widget
	get_template_part('inc/widgets/B86_s','sale-withdate');     // onsale product widget
}