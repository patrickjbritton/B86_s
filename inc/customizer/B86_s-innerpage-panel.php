<?php
/**
 * B86_s Innerpage Design Settings panel at Theme Customizer
 *
 * @package B86
 * @subpackage B86_s
 * @since 1.0.0
 */

add_action( 'customize_register', 'B86_s_design_settings_register' );

function B86_s_design_settings_register( $wp_customize ) {

	// Register the radio image control class as a JS control type.
    $wp_customize->register_control_type( 'B86_s_Customize_Control_Radio_Image' );

	/**
     * Add Innerpage Design Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'B86_s_design_settings_panel',
	    array(
	        'priority'       => 25,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'InnerPage Designs', 'B86_s' ),
	    )
    );

/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * Archive Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'B86_s_archive_settings_section',
        array(
            'title'     => esc_html__( 'Archive Settings', 'B86_s' ),
            'panel'     => 'B86_s_design_settings_panel',
            'priority'  => 5,
        )
    );      

    /**
     * Image Radio field for archive sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_archive_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new B86_s_Customize_Control_Radio_Image(
        $wp_customize,
        'B86_s_archive_sidebar',
            array(
                'label'    => esc_html__( 'Archive Sidebars', 'B86_s' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'B86_s' ),
                'section'  => 'B86_s_archive_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'B86_s' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'B86_s' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'B86_s' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Image Radio field for archive layout
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_archive_layout',
        array(
            'default'           => 'classic',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new B86_s_Customize_Control_Radio_Image(
        $wp_customize,
        'B86_s_archive_layout',
            array(
                'label'    => esc_html__( 'Archive Layouts', 'B86_s' ),
                'description' => esc_html__( 'Choose layout from available layouts', 'B86_s' ),
                'section'  => 'B86_s_archive_settings_section',
                'choices'  => array(
                        'classic' => array(
                            'label' => esc_html__( 'Classic', 'B86_s' ),
                            'url'   => '%s/assets/images/archive-layout1.png'
                        ),
                        'grid' => array(
                            'label' => esc_html__( 'Grid', 'B86_s' ),
                            'url'   => '%s/assets/images/archive-layout2.png'
                        )
                ),
                'priority' => 10
            )
        )
    );

    /**
     * Text field for archive read more
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_archive_read_more_text',
        array(
            'default'      => __( 'Continue Reading', 'B86_s' ),
            'transport'    => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'B86_s_archive_read_more_text',
        array(
            'type'      	=> 'text',
            'label'        	=> esc_html__( 'Read More Text', 'B86_s' ),
            'description'  	=> __( 'Enter read more button text for archive page.', 'B86_s' ),
            'section'   	=> 'B86_s_archive_settings_section',
            'priority'  	=> 15
        )
    );
    $wp_customize->selective_refresh->add_partial( 
        'B86_s_archive_read_more_text', 
            array(
                'selector' => '.B86_s-archive-more > a',
                'render_callback' => 'B86_s_customize_partial_archive_more',
            )
    );

/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * Page Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'B86_s_page_settings_section',
        array(
            'title'     => esc_html__( 'Page Settings', 'B86_s' ),
            'panel'     => 'B86_s_design_settings_panel',
            'priority'  => 10,
        )
    );      

    /**
     * Image Radio for page sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_default_page_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new B86_s_Customize_Control_Radio_Image(
        $wp_customize,
        'B86_s_default_page_sidebar',
            array(
                'label'    => esc_html__( 'Page Sidebars', 'B86_s' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'B86_s' ),
                'section'  => 'B86_s_page_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'B86_s' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'B86_s' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'B86_s' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

/*---------------------------------------------------------------------------------------------------------------*/
    /**
     * Post Settings
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'B86_s_post_settings_section',
        array(
            'title'     => esc_html__( 'Post Settings', 'B86_s' ),
            'panel'     => 'B86_s_design_settings_panel',
            'priority'  => 15,
        )
    );      

    /**
     * Image Radio for post sidebar
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_default_post_sidebar',
        array(
            'default'           => 'right_sidebar',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new B86_s_Customize_Control_Radio_Image(
        $wp_customize,
        'B86_s_default_post_sidebar',
            array(
                'label'    => esc_html__( 'Post Sidebars', 'B86_s' ),
                'description' => esc_html__( 'Choose sidebar from available layouts', 'B86_s' ),
                'section'  => 'B86_s_post_settings_section',
                'choices'  => array(
                        'left_sidebar' => array(
                            'label' => esc_html__( 'Left Sidebar', 'B86_s' ),
                            'url'   => '%s/assets/images/left-sidebar.png'
                        ),
                        'right_sidebar' => array(
                            'label' => esc_html__( 'Right Sidebar', 'B86_s' ),
                            'url'   => '%s/assets/images/right-sidebar.png'
                        ),
                        'no_sidebar' => array(
                            'label' => esc_html__( 'No Sidebar', 'B86_s' ),
                            'url'   => '%s/assets/images/no-sidebar.png'
                        )
                ),
                'priority' => 5
            )
        )
    );

    /**
     * Switch option for Related posts
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_related_posts_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'B86_s_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new B86_s_Customize_Switch_Control(
        $wp_customize,
            'B86_s_related_posts_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Related Post Option', 'B86_s' ),
                'description'   => esc_html__( 'Show/Hide option for related posts section at single post page.', 'B86_s' ),
                'section'   => 'B86_s_post_settings_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'B86_s' ),
                    'hide'  => esc_html__( 'Hide', 'B86_s' )
                    ),
                'priority'  => 10,
            )
        )
    );

    /**
     * Text field for related post section title
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_related_posts_title',
        array(
            'default'    => __( 'Related Posts', 'B86_s' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'B86_s_related_posts_title',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Related Post Section Title', 'B86_s' ),
            'section'   => 'B86_s_post_settings_section',
            'priority'  => 15
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'B86_s_related_posts_title', 
            array(
                'selector' => 'h2.B86_s-related-title',
                'render_callback' => 'B86_s_customize_partial_related_title',
            )
    );
}