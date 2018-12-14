<?php
/**
 * B86_s Theme Customizer
 *
 * @package B86
 * @subpackage B86_s
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function B86_s_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
    $wp_customize->selective_refresh->add_partial( 
        'blogname', 
            array(
                'selector' => '.site-title a',
                'render_callback' => 'B86_s_customize_partial_blogname',
            )
    );

    $wp_customize->selective_refresh->add_partial( 
        'blogdescription', 
            array(
                'selector' => '.site-description',
                'render_callback' => 'B86_s_customize_partial_blogdescription',
            )
    );
}
add_action( 'customize_register', 'B86_s_customize_register' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function B86_s_customize_preview_js() {
	wp_enqueue_script( 'B86_s_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20180416', true );
}
add_action( 'customize_preview_init', 'B86_s_customize_preview_js' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 */
function B86_s_customize_backend_scripts() {

    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
    
    wp_enqueue_style( 'B86_s_admin_customizer_style', get_template_directory_uri() . '/assets/css/B86_s-customizer-style.css' );

    wp_enqueue_script( 'B86_s_admin_customizer', get_template_directory_uri() . '/assets/js/B86_s-customizer-controls.js', array( 'jquery', 'customize-controls' ), '20180416', true );
}
add_action( 'customize_controls_enqueue_scripts', 'B86_s_customize_backend_scripts', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Load required files for customizer section
 *
 * @since 1.0.0
 */

get_template_part('inc/customizer/B86_s','general-panel');          // General Settings
get_template_part('inc/customizer/B86_s','header-panel');  		    // Header Settings
get_template_part('inc/customizer/B86_s','homepage-panel');       // Homepage Settings
get_template_part('inc/customizer/B86_s','innerpage-panel');           // Innerpage Design Settings
get_template_part('inc/customizer/B86_s','footer-panel');           // Footer Settings
get_template_part('inc/customizer/B86_s','custom-classes');         // Custom Classes
get_template_part('inc/customizer/B86_s','customizer-sanitize');    // Customizer Sanitize