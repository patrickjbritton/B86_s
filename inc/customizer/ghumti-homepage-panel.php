<?php
/**
 * B86_s Homepage Settings panel at Theme Customizer
 *
 * @package AquariusThemes
 * @subpackage B86_s
 * @since 1.0.0
 */

add_action( 'customize_register', 'B86_s_homepage_settings_register' );

function B86_s_homepage_settings_register( $wp_customize ) {

	/**
     * Add Homepage Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
	    'B86_s_homepage_settings_section',
	    array(
	        'priority'       => 20,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Home Template Setups', 'B86_s' ),
	    )
    );

    /**
     * option for Logo Alignment
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_homepage',
        array(
            'default' => __('All contents of this section are controlled from Widgets. It is just for your information and modifying this text will have no effect.','B86_s'),
            'sanitize_callback' => 'sanitize_text',
        )
    );
    $wp_customize->add_control('B86_s_homepage', array(
        'type'      => 'textarea',
        'label'     => esc_html__( 'Homepage Sections Setups', 'B86_s' ),
        'description'     => esc_html__( 'Go To Widgets section and add widgets as per the widget areas to load in homepage sections.', 'B86_s' ),
        'section'   => 'B86_s_homepage_settings_section',
        'priority'  => 5,
    ));

}