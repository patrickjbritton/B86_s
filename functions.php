<?php
/**
 * B86_s functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AquariusThemes
 * @subpackage B86_s
 * @since 1.0.0
 */

if ( ! function_exists( 'B86_s_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function B86_s_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on B86_s, use a find and replace
	 * to change 'B86_s' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'B86_s', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'B86_s-slider', 1280, 600, true );
	add_image_size( 'B86_s-slider-half', 866, 600, true );
	add_image_size( 'B86_s-featured-medium', 768, 570, true );
	add_image_size( 'B86_s-cat-square', 640, 583, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'B86_s_top_menu' => esc_html__( 'Top Menu', 'B86_s' ),
		'B86_s_primary_menu' => esc_html__( 'Primary Menu', 'B86_s' ),
		'B86_s_footer_menu' => esc_html__( 'Footer Menu', 'B86_s' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 300,
		'height'      => 45,
		'flex-width'  => true,
	) );

	add_theme_support( 'custom-header', array(
		'flex-width'    => true,
		'width'         => 1920,
		'flex-height'    => true,
		'height'        => 200,
		'wp-head-callback'       => 'B86_s_header_style',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'B86_s_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	//add theme woocommerce support
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
endif;
add_action( 'after_setup_theme', 'B86_s_setup' );

if ( ! function_exists( 'B86_s_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see the100_custom_header_setup().
 */
function B86_s_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
	if ( ! display_header_text() ) :
		?>
		.site-title,
		.site-description {
		position: absolute;
		clip: rect(1px, 1px, 1px, 1px);
	}
	<?php
		// If the user has set a custom color for the text use that.
else :
	?>
	.site-title a,
	.site-description {
	color: #<?php echo esc_attr( $header_text_color ); ?>;
}
<?php endif; ?>
</style>
<?php
}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function B86_s_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'B86_s_content_width', 640 );
}
add_action( 'after_setup_theme', 'B86_s_content_width', 0 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Set the theme version
 *
 * @global int $B86_s_version
 * @since 1.0.0
 */
function B86_s_theme_version() {
	$B86_s_theme_info = wp_get_theme();
	$GLOBALS['B86_s_version'] = $B86_s_theme_info->get( 'Version' );
}
add_action( 'after_setup_theme', 'B86_s_theme_version', 0 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function B86_s_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'B86_s_pingback_header' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Widget function file
 */
require get_template_directory() . '/inc/widgets/B86_s-widget-functions.php';

/**
 * Custom files for hook
 */
require get_template_directory() . '/inc/hooks/B86_s-header-hooks.php';
require get_template_directory() . '/inc/hooks/B86_s-widget-hooks.php';
require get_template_directory() . '/inc/hooks/B86_s-custom-hooks.php';
require get_template_directory() . '/inc/hooks/B86_s-footer-hooks.php';

/**
 * Custom files for post metabox
 */

require get_template_directory() . '/inc/metaboxes/B86_s-post-metabox.php';

if ( ! function_exists( 'is_woocommerce_available' ) ) {
	function is_woocommerce_available() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

/**
 * Registers an editor stylesheet for the theme.
 */
if(!function_exists('B86_s_editor_style')){
	function B86_s_editor_style() {
		add_editor_style( 'assets/css/B86_s-editor-style.css' );
	}
	add_action( 'admin_init', 'B86_s_editor_style' );
}