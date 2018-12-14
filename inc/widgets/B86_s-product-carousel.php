<?php
/**
 * AT: Carousel
 *
 * Widget show the posts from selected categories in carousel layouts.
 *
 * @package B86
 * @subpackage B86_s
 * @since 1.0.0
 */

class B86_s_product_Carousel extends WP_widget {

	/**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'B86_s_product_carousel',
            'description' => __( 'Displays products from selected categories in carousel.', 'B86_s' )
        );
        parent::__construct( 'B86_s_product_carousel', __( 'AT: Product Carousel', 'B86_s' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $B86_s_woocommerce_categories_lists = B86_s_woocommerce_categories_lists();
        
        $fields = array(

            'product_title' => array(
                'B86_s_widgets_name'         => 'product_title',
                'B86_s_widgets_title'        => __( 'Widget title', 'B86_s' ),
                'B86_s_widgets_description'  => __( 'Enter your product title. (Optional - Leave blank to hide title.)', 'B86_s' ),
                'B86_s_widgets_field_type'   => 'text'
            ),

            'product_cat_slugs' => array(
                'B86_s_widgets_name'         => 'product_cat_slugs',
                'B86_s_widgets_title'        => __( 'Product Categories', 'B86_s' ),
                'B86_s_widgets_field_type'   => 'select',
                'B86_s_widgets_field_options' => $B86_s_woocommerce_categories_lists
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

        $cat_product_title      = empty( $instance['product_title'] ) ? '' : $instance['product_title'];
        $B86_s_product_cat  = empty( $instance['product_cat_slugs'] ) ? '' : $instance['product_cat_slugs'];
        $B86_s_product_layout     = 'layout1';

        if(!empty($B86_s_product_cat)) {
            echo wp_kses_post($before_widget);
            ?>
            <div class="cat-product-wrap clearfix">
              <?php 
              if( !empty( $cat_product_title ) ) {
                echo wp_kses_post($before_title) . esc_html( $cat_product_title ) . wp_kses_post($after_title);
            }
            ?>
            <div class="B86_s-product-carousel-wrap">
                <ul class="B86_s-product-carousel owl-carousel">
                    <?php 
                    $prod_args = array(
                        'post_type' => 'product',
                        'tax_query' => array(array('taxonomy'  => 'product_cat',
                            'field'     => 'id', 
                            'terms'     => $B86_s_product_cat                                                                 
                        )),
                        'posts_per_page' => '4'
                    );
                    $product_query = new WP_Query($prod_args);
                    if($product_query->have_posts()){
                        while($product_query->have_posts()){
                            $product_query->the_post();
                            wc_get_template_part( 'content', 'productcarousel' );
                        }
                        wp_reset_postdata();
                    }
                    ?>
                </ul>
            </div>
            <?php 
        }?>
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