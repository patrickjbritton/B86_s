<?php
/**
 * B86_s Footer Settings panel at Theme Customizer
 *
 * @package AquariusThemes
 * @subpackage B86_s
 * @since 1.0.0
 */

add_action( 'customize_register', 'B86_s_footer_settings_register' );

function B86_s_footer_settings_register( $wp_customize ) {

	/**
     * Add Additional Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'B86_s_footer_settings_panel',
	    array(
	        'priority'       => 30,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Footer Settings', 'B86_s' ),
	    )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
	 * Widget Area Section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
        'B86_s_footer_widget_section',
        array(
            'title'		=> esc_html__( 'Widget Area', 'B86_s' ),
            'panel'     => 'B86_s_footer_settings_panel',
            'priority'  => 5,
        )
    );

    /**
     * Switch option for Top Header
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_footer_widget_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'B86_s_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new B86_s_Customize_Switch_Control(
        $wp_customize,
            'B86_s_footer_widget_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Footer Widget Section', 'B86_s' ),
                'description'   => esc_html__( 'Show/Hide option for footer widget area section.', 'B86_s' ),
                'section'   => 'B86_s_footer_widget_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'B86_s' ),
                    'hide'  => esc_html__( 'Hide', 'B86_s' )
                    ),
                'priority'  => 5,
            )
        )
    );

    /**
     * Field for Image Radio
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'footer_widget_layout',
        array(
            'default'           => 'column_three',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new B86_s_Customize_Control_Radio_Image(
        $wp_customize,
        'footer_widget_layout',
            array(
                'label'    => esc_html__( 'Footer Widget Layout', 'B86_s' ),
                'description' => esc_html__( 'Choose layout from available layouts', 'B86_s' ),
                'section'  => 'B86_s_footer_widget_section',
                'choices'  => array(
	                    'column_four' => array(
	                        'label' => esc_html__( 'Columns Four', 'B86_s' ),
	                        'url'   => '%s/assets/images/footer-4.png'
	                    ),
	                    'column_three' => array(
	                        'label' => esc_html__( 'Columns Three', 'B86_s' ),
	                        'url'   => '%s/assets/images/footer-3.png'
	                    ),
	                    'column_two' => array(
	                        'label' => esc_html__( 'Columns Two', 'B86_s' ),
	                        'url'   => '%s/assets/images/footer-2.png'
	                    ),
	                    'column_one' => array(
	                        'label' => esc_html__( 'Column One', 'B86_s' ),
	                        'url'   => '%s/assets/images/footer-1.png'
	                    )
	            ),
	            'priority' => 10
            )
        )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
	 * Bottom Section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
        'B86_s_footer_bottom_section',
        array(
            'title'		=> esc_html__( 'Bottom Section', 'B86_s' ),
            'panel'     => 'B86_s_footer_settings_panel',
            'priority'  => 10,
        )
    );

    /**
     * Text field for copyright
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_copyright_text',
        array(
            'default'    => __( 'B86_s', 'B86_s' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'B86_s_copyright_text',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Copyright Text', 'B86_s' ),
            'section'   => 'B86_s_footer_bottom_section',
            'priority'  => 5
        )
    );
    $wp_customize->selective_refresh->add_partial( 
        'B86_s_copyright_text', 
            array(
                'selector' => 'span.B86_s-copyright-text',
                'render_callback' => 'B86_s_customize_partial_copyright',
            )
    );
}