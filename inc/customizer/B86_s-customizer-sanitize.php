<?php
/**
 * File to sanitize customizer field
 *
 * @package B86
 * @subpackage B86_s
 * @since 1.0.0
 */

/**
 * Sanitize checkbox value
 *
 * @since 1.0.1
 */
function B86_s_sanitize_checkbox( $input ) {
    //returns true if checkbox is checked
    return ( ( isset( $input ) && true == $input ) ? true : false );
}

/**
 * Sanitize repeater value
 *
 * @since 1.0.0
 */
function B86_s_sanitize_repeater( $input ){
    $input_decoded = json_decode( $input, true );
    
    if( !empty( $input_decoded ) ) {
        foreach ( $input_decoded as $boxes => $box ){
            foreach ( $box as $key => $value ){
                $input_decoded[$boxes][$key] = wp_kses_post( $value );
            }
        }
        return json_encode( $input_decoded );
    }
    
    return $input;
}

/**
 * Sanitize site layout
 *
 * @since 1.0.0
 */
function B86_s_sanitize_site_layout( $input ) {
    $valid_keys = array(
        'fullwidth_layout' => __( 'Fullwidth Layout', 'B86_s' ),
        'boxed_layout'     => __( 'Boxed Layout', 'B86_s' )
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * switch option (show/hide)
 *
 * @since 1.0.0
 */
function B86_s_sanitize_switch_option( $input ) {
    $valid_keys = array(
        'show'  => __( 'Show', 'B86_s' ),
        'hide'  => __( 'Hide', 'B86_s' )
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Sanitize header layout
 *
 * @since 1.0.0
 */
function B86_s_sanitize_header_layouts( $input ) {
    $valid_keys = array(
        'left-logo'  => esc_html__( 'Logo on Left', 'B86_s' ),
        'center-logo'  => esc_html__( 'Logo on Center', 'B86_s' ),
        'right-logo'  => esc_html__( 'Logo on Right', 'B86_s' ),
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * sanitize function for multiple checkboxes
 *
 * @since 1.0.0
 */
function B86_s_sanitize_mulitple_checkbox( $values ) {

    $multi_values = !is_array( $values ) ? explode( ',', $values ) : $values;

    return !empty( $multi_values ) ? array_map( 'sanitize_text_field', $multi_values ) : array();
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Render the site title for the selective refresh partial.
 *
 * @since B86_s 1.0.0
 * @see B86_s_customize_register()
 *
 * @return void
 */
function B86_s_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since B86_s 1.0.0
 * @see B86_s_customize_register()
 *
 * @return void
 */
function B86_s_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since B86_s 1.0.0
 * @see B86_s_footer_settings_register()
 *
 * @return void
 */
function B86_s_customize_partial_copyright() {
    return get_theme_mod( 'B86_s_copyright_text' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since B86_s 1.0.0
 * @see B86_s_design_settings_register()
 *
 * @return void
 */
function B86_s_customize_partial_related_title() {
    return get_theme_mod( 'B86_s_related_posts_title' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since B86_s 1.0.0
 * @see B86_s_design_settings_register()
 *
 * @return void
 */
function B86_s_customize_partial_archive_more() {
    return get_theme_mod( 'B86_s_archive_read_more_text' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since B86_s 1.0.0
 * @see B86_s_header_settings_register()
 *
 * @return void
 */
function B86_s_customize_partial_ticker_caption() {
    return get_theme_mod( 'B86_s_ticker_caption' );
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Active callback function for featured post section at top header
 *
 * @since 1.0.0
 */
function B86_s_featured_posts_active_callback( $control ) {
    if ( $control->manager->get_setting( 'B86_s_top_featured_option' )->value() == 'show' ) {
        return true;
    } else {
        return false;
    }
}