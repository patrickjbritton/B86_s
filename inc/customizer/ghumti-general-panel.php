<?php
/**
 * B86_s General Settings panel at Theme Customizer
 *
 * @package AquariusThemes
 * @subpackage B86_s
 * @since 1.0.0
 */

add_action( 'customize_register', 'B86_s_general_settings_register' );

function B86_s_general_settings_register( $wp_customize ) {

	$wp_customize->get_section( 'title_tagline' )->panel = 'B86_s_general_settings_panel';
    $wp_customize->get_section( 'title_tagline' )->priority = '5';
    $wp_customize->get_section( 'colors' )->panel    = 'B86_s_general_settings_panel';
    $wp_customize->get_section( 'colors' )->priority = '10';
    $wp_customize->get_section( 'background_image' )->panel = 'B86_s_general_settings_panel';
    $wp_customize->get_section( 'background_image' )->priority = '15';
    $wp_customize->get_section( 'static_front_page' )->panel = 'B86_s_general_settings_panel';
    $wp_customize->get_section( 'static_front_page' )->priority = '20';

    /**
     * Add General Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'B86_s_general_settings_panel',
	    array(
	        'priority'       => 5,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'General Settings', 'B86_s' ),
	    )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/

    /**
     * Title Color
     *
     * @since 1.0.0
     */

    $wp_customize->add_setting(
        'B86_s_site_title_color',
        array(
            'default'     => '#000000',
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );
 
    $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize,
            'B86_s_site_title_color',
            array(
                'label'      => __( 'Header Text Color', 'B86_s' ),
                'section'    => 'colors',
                'priority'   => 5
            )
        )
    );
    
/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Website layout section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'B86_s_website_layout_section',
        array(
            'title'         => __( 'Website Layout', 'B86_s' ),
            'description'   => __( 'Choose a site to display your website more effectively.', 'B86_s' ),
            'priority'      => 55,
            'panel'         => 'B86_s_general_settings_panel',
        )
    );
    
    $wp_customize->add_setting(
        'B86_s_site_layout',
        array(
            'default'           => 'fullwidth_layout',
            'sanitize_callback' => 'B86_s_sanitize_site_layout',
        )       
    );
    $wp_customize->add_control(
        'B86_s_site_layout',
        array(
            'type' => 'radio',
            'priority'    => 5,
            'label' => __( 'Site Layout', 'B86_s' ),
            'section' => 'B86_s_website_layout_section',
            'choices' => array(
                'fullwidth_layout' => __( 'FullWidth Layout', 'B86_s' ),
                'boxed_layout' => __( 'Boxed Layout', 'B86_s' )
            ),
        )
    );
// /*------------------------------------------------------------------------------------------*/
//     /**
//      * Title and tagline checkbox
//      *
//      * @since 1.0.1
//      */
//     $wp_customize->add_setting( 
//         'B86_s_site_title_option', 
//         array(
//             'default' => true,
//             'sanitize_callback' => 'B86_s_sanitize_checkbox'
//         )
//     );
//     $wp_customize->add_control( 
//         'B86_s_site_title_option', 
//         array(
//             'label' => esc_html__( 'Display Site Title and Tagline', 'B86_s' ),
//             'section' => 'title_tagline',
//             'type' => 'checkbox'
//         )
//     );

}