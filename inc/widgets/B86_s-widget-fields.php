<?php
/**
 * Define custom fields for widgets
 * 
 * @package B86
 * @subpackage B86_s
 * @since 1.0.0
 */

function B86_s_widgets_show_widget_field( $instance = '', $widget_field = '', $B86_s_widget_field_value = '' ) {

    extract( $widget_field );
    if(isset($B86_s_widgets_field_class)){
        $B86_s_widgets_field_class=" class=$B86_s_widgets_field_class";
    }else{
        $B86_s_widgets_field_class='';
    }
    switch ( $B86_s_widgets_field_type ) {

        /**
         * text widget field
         */
        case 'text'
        ?>
        <p<?php echo esc_attr($B86_s_widgets_field_class);?>>
        <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $B86_s_widgets_name ) ); ?>"><?php echo esc_html( $B86_s_widgets_title ); ?></label></span>
        <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $B86_s_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $B86_s_widgets_name ) ); ?>" type="text" value="<?php echo esc_html( $B86_s_widget_field_value ); ?>" />

        <?php if ( isset( $B86_s_widgets_description ) ) { ?>
            <br />
            <em><?php echo wp_kses_post( $B86_s_widgets_description ); ?></em>
        <?php } ?>
    </p>
    <?php
    break;

        /**
        * Textarea field
        */
        case 'textarea' :
        ?>
        <p<?php echo esc_attr($B86_s_widgets_field_class);?>>
        <span class="field-label"><label for="<?php echo esc_attr($instance->get_field_id($B86_s_widgets_name)); ?>"><?php echo esc_html($B86_s_widgets_title); ?>:</label></span>
        <textarea class="widefat" rows="5" id="<?php echo esc_attr($instance->get_field_id($B86_s_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($B86_s_widgets_name)); ?>"><?php echo wp_kses_post($B86_s_widget_field_value); ?></textarea>
        <?php if ( isset( $B86_s_widgets_description ) ) { ?>
            <br />
            <em><?php echo wp_kses_post( $B86_s_widgets_description ); ?></em>
        <?php } ?>
    </p>
    <?php
    break;

        /**
         * url widget field
         */
        case 'url' :
        ?>
        <p<?php echo esc_attr($B86_s_widgets_field_class);?>>
        <span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $B86_s_widgets_name ) ); ?>"><?php echo esc_html( $B86_s_widgets_title ); ?></label></span>
        <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $B86_s_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $B86_s_widgets_name ) ); ?>" type="text" value="<?php echo esc_url( $B86_s_widget_field_value ); ?>" />

        <?php if ( isset( $B86_s_widgets_description ) ) { ?>
            <br />
            <em><?php echo wp_kses_post( $B86_s_widgets_description ); ?></em>
        <?php } ?>
    </p>
    <?php
    break;

        /**
         * checkbox widget field
         */
        case 'checkbox' :
        ?>
        <p<?php echo esc_attr($B86_s_widgets_field_class);?>>
        <input id="<?php echo esc_attr( $instance->get_field_id( $B86_s_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $B86_s_widgets_name ) ); ?>" type="checkbox" value="1" <?php checked( '1', $B86_s_widget_field_value ); ?>/>
        <label for="<?php echo esc_attr( $instance->get_field_id( $B86_s_widgets_name ) ); ?>"><?php echo esc_html( $B86_s_widgets_title ); ?></label>

        <?php if ( isset( $B86_s_widgets_description ) ) { ?>
            <br />
            <em><?php echo wp_kses_post( $B86_s_widgets_description ); ?></em>
        <?php } ?>
    </p>
    <?php
    break;
        /**
         * select dropdown widget field
         */
        case 'select' :
        ?>
        <p<?php echo esc_attr($B86_s_widgets_field_class);?>>
        <span class="field-label"><label for="<?php echo esc_attr($instance->get_field_id($B86_s_widgets_name)); ?>"><?php echo esc_html($B86_s_widgets_title); ?>:</label></span>
        <select name="<?php echo esc_attr($instance->get_field_name($B86_s_widgets_name)); ?>" id="<?php echo esc_attr($instance->get_field_id($B86_s_widgets_name)); ?>" class="widefat">
            <?php 
            foreach ($B86_s_widgets_field_options as $B86_s_option_name => $B86_s_option_title) { ?>
                <option value="<?php echo esc_attr($B86_s_option_name); ?>" id="<?php echo esc_attr($instance->get_field_id($B86_s_option_name)); ?>" <?php selected($B86_s_option_name, $B86_s_widget_field_value); ?>><?php echo esc_html($B86_s_option_title); ?></option>
            <?php } ?>
        </select>
        <?php if (isset($B86_s_widgets_description)) { ?>
            <br />
            <em><?php echo wp_kses_post($B86_s_widgets_description); ?></em>
        <?php } ?>
    </p>
    <?php
    break;

        /**
         * category dropdown widget field
         */
        case 'category_dropdown' :
        if( empty( $B86_s_widget_field_value ) ) {
            $B86_s_widget_field_value = $B86_s_widgets_default;
        }
        $select_field = 'name="'. esc_attr( $instance->get_field_name( $B86_s_widgets_name ) ) .'" id="'. esc_attr( $instance->get_field_id( $B86_s_widgets_name ) ) .'" class="widefat"';
        ?>
        <p<?php echo esc_attr($B86_s_widgets_field_class);?>>
        <label for="<?php echo esc_attr( $instance->get_field_id( $B86_s_widgets_name ) ); ?>"><?php echo esc_html( $B86_s_widgets_title ); ?>:</label>
        <?php
        $dropdown_args = wp_parse_args( array(
            'taxonomy'          => 'category',
            'show_option_none'  => __( '- - Select Category - -', 'B86_s' ),
            'selected'          => esc_attr( $B86_s_widget_field_value ),
            'show_option_all'   => '',
            'orderby'           => 'id',
            'order'             => 'ASC',
            'show_count'        => 0,
            'hide_empty'        => 1,
            'child_of'          => 0,
            'exclude'           => '',
            'hierarchical'      => 1,
            'depth'             => 0,
            'tab_index'         => 0,
            'hide_if_empty'     => false,
            'option_none_value' => 0,
            'value_field'       => 'slug',
            'name'              => esc_attr( $instance->get_field_name( $B86_s_widgets_name ) ),
            'id'                => esc_attr( $instance->get_field_id( $B86_s_widgets_name ) ),
            'class'             => 'widefat'
        ) );

        wp_dropdown_categories( $dropdown_args );
        ?>
    </p>
    <?php
    break;

        /**
         * number widget field
         */
        case 'number' :
        if( empty( $B86_s_widget_field_value ) ) {
            $B86_s_widget_field_value = $B86_s_widgets_default;
        }
        ?>
        <p<?php echo esc_attr($B86_s_widgets_field_class);?>>
        <label for="<?php echo esc_attr( $instance->get_field_id( $B86_s_widgets_name ) ); ?>"><?php echo esc_html( $B86_s_widgets_title ); ?></label>
        <input name="<?php echo esc_attr( $instance->get_field_name( $B86_s_widgets_name ) ); ?>" type="number" step="1" min="1" id="<?php echo esc_attr( $instance->get_field_id( $B86_s_widgets_name ) ); ?>" value="<?php echo esc_html( $B86_s_widget_field_value ); ?>" class="small-text" />

        <?php if ( isset( $B86_s_widgets_description ) ) { ?>
            <br />
            <em><?php echo wp_kses_post( $B86_s_widgets_description ); ?></em>
        <?php } ?>
    </p>
    <?php
    break;

        /**
         * multi checkboxes widget field
         */
        case 'multicheckboxes':
        ?>
        <p<?php echo esc_attr($B86_s_widgets_field_class);?>>
        <span class="field-label"><label><?php echo esc_html( $B86_s_widgets_title ); ?></label></span></p>

        <?php
        foreach ( $B86_s_widgets_field_options as $checkbox_option_name => $checkbox_option_title ) {
            $B86_s_rand = rand(00000,99999).'-';
            if( isset( $B86_s_widget_field_value[$checkbox_option_name] ) ) {
                $B86_s_checked_val = 1;
            }else{
                $B86_s_checked_val = 0;
            }
            ?>
            <p>
                <input id="<?php echo esc_attr( $B86_s_rand.$instance->get_field_id( $checkbox_option_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $B86_s_widgets_name ).'['.$checkbox_option_name.']' ); ?>" type="checkbox" value="1" <?php checked( '1', $B86_s_checked_val ); ?>/>
                <label for="<?php echo esc_attr( $B86_s_rand.$instance->get_field_id( $checkbox_option_name ) ); ?>"><?php echo esc_html( $checkbox_option_title ); ?></label>
            </p>
            <?php
        }
        if ( isset( $B86_s_widgets_description ) ) {
            ?>
            <em><?php echo wp_kses_post( $B86_s_widgets_description ); ?></em>
            <?php
        }
        break;

        /**
         * selector widget field
         */
        case 'selector':
        if( empty( $B86_s_widget_field_value ) ) {
            $B86_s_widget_field_value = $B86_s_widgets_default;
        }
        ?>
        <p<?php echo esc_attr($B86_s_widgets_field_class);?>><span class="field-label"><label class="field-title"><?php echo esc_html( $B86_s_widgets_title ); ?></label></span></p>
        <?php            
        echo '<div class="selector-labels">';
        foreach ( $B86_s_widgets_field_options as $option => $val ){
            $class = ( $B86_s_widget_field_value == $option ) ? 'selector-selected': '';
            echo '<label class="'.esc_attr($class).'" data-val="'.esc_attr( $option ).'">';
            echo '<img src="'.esc_url( $val ).'"/>';
            echo '</label>'; 
        }
        echo '</div>';
        echo '<input data-default="'.esc_attr( $B86_s_widget_field_value ).'" type="hidden" value="'.esc_attr( $B86_s_widget_field_value ).'" name="'.esc_attr( $instance->get_field_name( $B86_s_widgets_name ) ).'"/>';
        break;

        /**
         * upload widget field
         */
        case 'upload':
        $image = $image_class = "";
        if( $B86_s_widget_field_value ){ 
            $image = '<img src="'.esc_url( $B86_s_widget_field_value ).'" style="max-width:100%;"/>';    
            $image_class = ' hidden';
        }
        ?>
        <div class="attachment-media-view">

            <p><span class="field-label"><label for="<?php echo esc_attr( $instance->get_field_id( $B86_s_widgets_name ) ); ?>"><?php echo esc_html( $B86_s_widgets_title ); ?>:</label></span></p>
            
            <div class="placeholder<?php echo esc_attr( $image_class ); ?>">
                <?php esc_html_e( 'No image selected', 'B86_s' ); ?>
            </div>
            <div class="thumbnail thumbnail-image">
                <?php echo wp_kses_post($image); ?>
            </div>

            <div class="actions B86_s-clearfix">
                <button type="button" class="button B86_s-delete-button align-left"><?php esc_html_e( 'Remove', 'B86_s' ); ?></button>
                <button type="button" class="button B86_s-upload-button alignright"><?php esc_html_e( 'Select Image', 'B86_s' ); ?></button>

                <input name="<?php echo esc_attr( $instance->get_field_name( $B86_s_widgets_name ) ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $B86_s_widgets_name ) ); ?>" class="upload-id" type="hidden" value="<?php echo esc_url( $B86_s_widget_field_value ) ?>"/>
            </div>

            <?php if ( isset( $B86_s_widgets_description ) ) { ?>
                <br />
                <em><?php echo wp_kses_post( $B86_s_widgets_description ); ?></em>
            <?php } ?>

        </div>
        <?php
        break;
    }
}

function B86_s_widgets_updated_field_value( $widget_field, $new_field_value ) {

    extract( $widget_field );
    
    if ( $B86_s_widgets_field_type == 'number') {
        return absint( $new_field_value );
    } elseif ( $B86_s_widgets_field_type == 'url' ) {
        return esc_url( $new_field_value );
    } elseif( $B86_s_widgets_field_type == 'multicheckboxes' ) {
        return wp_kses_post($new_field_value);
    } elseif ($B86_s_widgets_field_type == 'textarea') {
        if (!isset($B86_s_widgets_allowed_tags)) {
            $B86_s_widgets_allowed_tags = '<a><br><em><span><strong>';
        }
        return strip_tags($new_field_value, $B86_s_widgets_allowed_tags);
    } else {
        return sanitize_text_field( $new_field_value );
    }
}