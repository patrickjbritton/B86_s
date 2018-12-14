<?php
/**
 * AT: Block Posts
 *
 * Widget show the block posts from selected category in different layouts.
 *
 * @package AquariusThemes
 * @subpackage B86_s
 * @since 1.0.0
 */

class B86_s_Block_Posts extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'B86_s_block_posts B86_s-clearfix',
            'description' => __( 'Displays block posts from selected category in different layouts.', 'B86_s' )
        );
        parent::__construct( 'B86_s_block_posts', __( 'AT: Block Posts', 'B86_s' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $fields = array(

            'block_title' => array(
                'B86_s_widgets_name'         => 'block_title',
                'B86_s_widgets_title'        => __( 'Block title', 'B86_s' ),
                'B86_s_widgets_description'  => __( 'Enter your block title. (Optional - Leave blank to hide title.)', 'B86_s' ),
                'B86_s_widgets_field_type'   => 'text'
            ),

            'block_cat_slug' => array(
                'B86_s_widgets_name'         => 'block_cat_slug',
                'B86_s_widgets_title'        => __( 'Block Category', 'B86_s' ),
                'B86_s_widgets_default'      => '',
                'B86_s_widgets_field_type'   => 'category_dropdown'
            ),
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

        $B86_s_block_title    = empty( $instance['block_title'] ) ? '' : $instance['block_title'];
        $B86_s_block_cat_slug = empty( $instance['block_cat_slug'] ) ? '' : $instance['block_cat_slug'];
        $B86_s_block_layout   = 'layout1';

        echo wp_kses_post($before_widget);
        ?>
        <div class="B86_s-block-wrapper block-posts B86_s-clearfix <?php echo esc_attr( $B86_s_block_layout ); ?>">
            <?php 
            if( !empty( $B86_s_block_title ) ) {
                echo wp_kses_post($before_title) . esc_html( $B86_s_block_title ) . wp_kses_post($after_title);
            }
            ?>
            <div class="B86_s-block-posts-wrapper B86_s-clearfix">
            	<?php
                B86_s_block_default_layout_section( $B86_s_block_cat_slug );
                ?>
            </div><!-- .B86_s-block-posts-wrapper -->
        </div><!--- .B86_s-block-wrapper -->
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