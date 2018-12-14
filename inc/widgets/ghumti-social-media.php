<?php
/**
 * AT: Social Media
 *
 * Widget show the social media icons.
 *
 * @package AquariusThemes
 * @subpackage B86_s
 * @since 1.0.0
 */

class B86_s_Social_Media extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'B86_s_social_media',
            'description' => __( 'A widget shows the social media icons. Add Social Icons from Customizer > Header Settings > Social Icons', 'B86_s' )
        );
        parent::__construct( 'B86_s_social_media', __( 'AT: Social Media', 'B86_s' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        
        $fields = array(

            'widget_title' => array(
                'B86_s_widgets_name'         => 'widget_title',
                'B86_s_widgets_title'        => __( 'Widget title', 'B86_s' ),
                'B86_s_widgets_field_type'   => 'text'
            )
        );
        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        if( empty( $instance ) ) {
            return ;
        }

        $B86_s_widget_title  = empty( $instance['widget_title'] ) ? '' : $instance['widget_title'];

        $get_social_media_icons = get_theme_mod( 'social_media_icons', '' );
        $get_decode_social_media = json_decode( $get_social_media_icons );

        echo wp_kses_post($before_widget);
    ?>
            <div class="B86_s-aside-social-wrapper">
                <?php
                    if( ! empty( $B86_s_widget_title ) ) {
                        echo wp_kses_post($before_title) . esc_html( $B86_s_widget_title ) . wp_kses_post($after_title);
                    }
                ?>
                <div class="B86_s-social-icons-wrapper">
                    <?php
                        if( !empty( $get_decode_social_media ) ) {
                            foreach ( $get_decode_social_media as $single_icon ) {
                                $icon_class = $single_icon->social_icon_class;
                                $icon_url = $single_icon->social_icon_url;
                                if( !empty( $icon_url ) ) {
                                    echo '<span class="social-link"><a href="'. esc_url( $icon_url ) .'" target="_blank"><i class="'. esc_attr( $icon_class ) .'"></i></a></span>';
                                }
                            }
                        }
                    ?>
                </div><!-- .B86_s-social-icons-wrapper -->
            </div><!-- .B86_s-aside-social-wrapper -->
    <?php
        echo wp_kses_post($after_widget);
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param   array   $new_instance   Values just sent to be saved.
     * @param   array   $old_instance   Previously saved values from database.
     *
     * @uses    B86_s_widgets_updated_field_value()     defined in B86_s-widget-fields.php
     *
     * @return  array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            extract( $widget_field );

            // Use helper function to get updated field values
            $instance[$B86_s_widgets_name] = B86_s_widgets_updated_field_value( $widget_field, $new_instance[$B86_s_widgets_name] );
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param   array $instance Previously saved values from database.
     *
     * @uses    B86_s_widgets_show_widget_field()       defined in B86_s-widget-fields.php
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ( $widget_fields as $widget_field ) {

            // Make array elements available as variables
            extract( $widget_field );
            $B86_s_widgets_field_value = !empty( $instance[$B86_s_widgets_name] ) ? wp_kses_post( $instance[$B86_s_widgets_name] ) : '';
            B86_s_widgets_show_widget_field( $this, $widget_field, $B86_s_widgets_field_value );
        }
    }
}