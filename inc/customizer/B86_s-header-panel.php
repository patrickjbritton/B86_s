<?php
/**
 * B86_s Header Settings panel at Theme Customizer
 *
 * @package B86
 * @subpackage B86_s
 * @since 1.0.0
 */

add_action( 'customize_register', 'B86_s_header_settings_register' );

function B86_s_header_settings_register( $wp_customize ) {


	/**
     * Add General Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel('B86_s_header_settings_panel',array(
        'priority'       => 10,
        'capability'     => 'edit_theme_options',
        'theme_supports' => '',
        'title'          => __( 'Header Settings', 'B86_s' ),
    ));


$wp_customize->get_section('header_image')->panel = 'B86_s_header_settings_panel';
$wp_customize->get_section('header_image')->title = 'Header Background Image';
$wp_customize->get_section('header_image')->priority = 3;

    /*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Header Section
     */
    $wp_customize->add_section(
        'B86_s_header_option_section',
        array(
            'title'     => __( 'General Header Options', 'B86_s' ),
            'priority'  => 5,
            'panel'     => 'B86_s_header_settings_panel'
        )
    );

    /**
     * Switch option for Top Header
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_top_header_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'B86_s_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new B86_s_Customize_Switch_Control(
        $wp_customize, 'B86_s_top_header_option', array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Top Header Section', 'B86_s' ),
            'description'   => esc_html__( 'Show/Hide option for top header section.', 'B86_s' ),
            'section'   => 'B86_s_header_option_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'B86_s' ),
                'hide'  => esc_html__( 'Hide', 'B86_s' )
            ),
            'priority'  => 5,
        )
    ));

    /**
     * Switch option for user and cart Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_top_icons_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'B86_s_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new B86_s_Customize_Switch_Control(
        $wp_customize,
        'B86_s_top_icons_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'User & Cart Icons', 'B86_s' ),
            'description'   => esc_html__( 'Show/Hide option for user,cart and wishlist icon beside logo.', 'B86_s' ),
            'section'   => 'B86_s_header_option_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'B86_s' ),
                'hide'  => esc_html__( 'Hide', 'B86_s' )
            ),
            'priority'  => 10,
        )
    ));
    
    /**
     * Switch option for Search Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_search_icon_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'B86_s_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new B86_s_Customize_Switch_Control(
        $wp_customize,
        'B86_s_search_icon_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Search Icon', 'B86_s' ),
            'description'   => esc_html__( 'Show/Hide option for search icon at primary menu.', 'B86_s' ),
            'section'   => 'B86_s_header_option_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'B86_s' ),
                'hide'  => esc_html__( 'Hide', 'B86_s' )
            ),
            'priority'  => 15,
        )
    ));

    /*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Ticker Section
     */
    $wp_customize->add_section(
        'B86_s_ticker_section',
        array(
            'title'     => __( 'Ticker Section', 'B86_s' ),
            'priority'  => 15,
            'panel'     => 'B86_s_header_settings_panel'
        )
    );

    /**
     * Switch option for Home Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_ticker_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'B86_s_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new B86_s_Customize_Switch_Control(
        $wp_customize,
        'B86_s_ticker_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Ticker Option', 'B86_s' ),
            'description'   => esc_html__( 'Show/Hide option for news ticker section.', 'B86_s' ),
            'section'   => 'B86_s_ticker_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'B86_s' ),
                'hide'  => esc_html__( 'Hide', 'B86_s' )
            ),
            'priority'  => 5,
        )
    ));

    /**
     * Text field for ticker caption
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_ticker_caption',
        array(
            'default'    => __( 'Breaking News', 'B86_s' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'B86_s_ticker_caption',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Ticker Caption', 'B86_s' ),
            'section'   => 'B86_s_ticker_section',
            'priority'  => 10
        )
    );
    $wp_customize->selective_refresh->add_partial(
        'B86_s_ticker_caption', 
        array(
            'selector' => '.ticker-caption',
            'render_callback' => 'B86_s_customize_partial_ticker_caption',
        )
    );

    /*-----------------------------------------------------------------------------------------------------------------------*/
    /**
     * Social Icons Section
     *
     * @since 1.0.0
     */
    $wp_customize->add_section(
        'B86_s_social_icons_section',
        array(
            'title'     => esc_html__( 'Social Icons', 'B86_s' ),
            'panel'     => 'B86_s_header_settings_panel',
            'priority'  => 5,
        )
    );

    /**
     * Switch option for Social Icon
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'B86_s_top_social_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'B86_s_sanitize_switch_option',
        )
    );
    $wp_customize->add_control( new B86_s_Customize_Switch_Control(
        $wp_customize,
        'B86_s_top_social_option',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Social Icons', 'B86_s' ),
            'description'   => esc_html__( 'Show/Hide option for social media icons at top header section.', 'B86_s' ),
            'section'   => 'B86_s_social_icons_section',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'B86_s' ),
                'hide'  => esc_html__( 'Hide', 'B86_s' )
            ),
            'priority'  => 5,
        )
    ));

    /**
     * Repeater field for social media icons
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting( 
        'social_media_icons', 
        array(
            'sanitize_callback' => 'B86_s_sanitize_repeater',
            'default' => json_encode(array(
                array(
                    'social_icon_class' => 'fa fa-facebook-f',
                    'social_icon_url' => '',
                )
            ))
        )
    );
    $wp_customize->add_control( new B86_s_Repeater_Controler(
        $wp_customize, 
        'social_media_icons', 
        array(
            'label'   => __( 'Social Media Icons', 'B86_s' ),
            'section' => 'B86_s_social_icons_section',
            'settings' => 'social_media_icons',
            'priority' => 15,
            'B86_s_box_label' => __( 'Social Media Icon','B86_s' ),
            'B86_s_box_add_control' => __( 'Add Icon','B86_s' )
        ),
        array(
            'social_icon_class' => array(
                'type'        => 'social_icon',
                'label'       => __( 'Social Media Logo', 'B86_s' ),
                'description' => __( 'Choose social media icon.', 'B86_s' )
            ),
            'social_icon_url' => array(
                'type'        => 'url',
                'label'       => __( 'Social Icon Url', 'B86_s' ),
                'description' => __( 'Enter social media url.', 'B86_s' )
            )
        )
    ));

}//header panel close