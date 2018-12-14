<?php
/**
 * AT: Featured Slider
 *
 * Widget to display posts from selected categories in featured slider ( slider + featured section )
 *
 * @package AquariusThemes
 * @subpackage B86_s
 * @since 1.0.0
 */

class B86_s_Featured_Slider extends WP_widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'B86_s_featured_slider',
            'description' => __( 'Displays posts from selected categories in slider with featured section.', 'B86_s' )
        );
        parent::__construct( 'B86_s_featured_slider', __( 'AT: Banner Posts Slider', 'B86_s' ), $widget_ops );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {

        $B86_s_categories_lists = B86_s_categories_lists();

        $fields = array(
            'slider_cat_slugs' => array(
                'B86_s_widgets_name'         => 'slider_cat_slugs',
                'B86_s_widgets_title'        => __( 'Slider Categories', 'B86_s' ),
                'B86_s_widgets_field_type'   => 'multicheckboxes',
                'B86_s_widgets_field_options' => $B86_s_categories_lists
            ),
            'caption_layout' => array(
                'B86_s_widgets_name'         => 'caption_layout',
                'B86_s_widgets_title'        => __( 'Caption Layouts', 'B86_s' ),
                'B86_s_widgets_default'      => 'left-align-caption',
                'B86_s_widgets_field_type'   => 'selector',
                'B86_s_widgets_field_options' => array(
                    'no-caption' => esc_url( get_template_directory_uri() . '/assets/images/no-caption.png' ),
                    'left-align-caption' => esc_url( get_template_directory_uri() . '/assets/images/left-caption.png' ),
                    'right-align-caption' => esc_url( get_template_directory_uri() . '/assets/images/right-caption.png' ),
                    'center-align-caption' => esc_url( get_template_directory_uri() . '/assets/images/center-caption.png' ),
                )
            ),
            'featured_cat_slugs' => array(
                'B86_s_widgets_name'         => 'featured_cat_slugs',
                'B86_s_widgets_title'        => __( 'Featured Post Categories', 'B86_s' ),
                'B86_s_widgets_field_type'   => 'multicheckboxes',
                'B86_s_widgets_field_options' => $B86_s_categories_lists
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

        $B86_s_slider_cat_slugs    = empty( $instance['slider_cat_slugs'] ) ? '' : $instance['slider_cat_slugs'];
        $B86_s_caption_layout     = empty( $instance['caption_layout'] ) ? 'left-align-caption' : $instance['caption_layout'];
        $B86_s_featured_cat_slugs  = empty( $instance['featured_cat_slugs'] ) ? '' : $instance['featured_cat_slugs'];

        echo wp_kses_post($before_widget);
        $B86_s_class = ' B86_s-empty';
        if( !empty( $B86_s_slider_cat_slugs )  && !empty( $B86_s_featured_cat_slugs ) ) {
            $B86_s_class = ' B86_s-slider-featured';
        }
        elseif( !empty( $B86_s_slider_cat_slugs ) ) {
            $B86_s_class = ' B86_s-slider-single';
        }
        elseif( !empty( $B86_s_featured_cat_slugs ) ) {
            $B86_s_class = ' B86_s-featured-single';
        }
        ?>
        <div class="B86_s-block-wrapper B86_s-clearfix <?php echo esc_attr( $B86_s_caption_layout.$B86_s_class); ?>">
            <div class="slider-posts">
                <?php
                if( !empty( $B86_s_slider_cat_slugs ) ) {
                    $checked_cats = array();
                    foreach( $B86_s_slider_cat_slugs as $cat_key => $cat_value ){
                        $checked_cats[] = $cat_key;
                    }
                    $get_checked_cat_slugs = implode( ",", $checked_cats );
                    $B86_s_post_count = apply_filters( 'B86_s_slider_posts_count', 4 );
                    $B86_s_slider_args = array(
                        'post_type'      => 'post',
                        'category_name'  => wp_kses_post( $get_checked_cat_slugs ),
                        'posts_per_page' => absint( $B86_s_post_count ),
                        'orderby'        => 'rand'
                    );
                    $B86_s_slider_query = new WP_Query( $B86_s_slider_args );
                    if( $B86_s_slider_query->have_posts() ) {
                        echo '<ul class="owl-carousel B86_s-main-slider">';
                        while( $B86_s_slider_query->have_posts() ) {
                            $B86_s_slider_query->the_post();
                            if( has_post_thumbnail() ) {
                                ?>
                                <li>
                                    <div class="B86_s-single-slide-wrap">
                                        <div class="B86_s-slide-thumb">
                                            <?php
                                            if(' B86_s-slider-single' == $B86_s_class){
                                                the_post_thumbnail( 'B86_s-slider' );
                                            }else{
                                                the_post_thumbnail( 'B86_s-slider-half' );
                                            } ?>
                                        </div><!-- .B86_s-slide-thumb -->
                                        <?php if($B86_s_caption_layout!='no-caption'){ ?>
                                            <div class="B86_s-slide-content-wrap">
                                                <h3 class="post-title large-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                <div class="B86_s-excerpt">
                                                    <?php the_excerpt();?>
                                                    <a class="B86_s-read-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','B86_s');?></a>
                                                </div>
                                            </div> <!-- B86_s-slide-content-wrap -->
                                        <?php } ?>
                                    </div><!-- .single-slide-wrap -->
                                </li>
                                <?php
                            }
                        }
                        echo '</ul>';
                        wp_reset_postdata();
                    }
                }
                ?>
            </div><!-- .slider-posts -->
            <?php
            if( !empty( $B86_s_featured_cat_slugs ) ) {
                ?>
                <div class="featured-posts">
                    <div class="featured-posts-wrapper">
                        <?php
                        $checked_cats = array();
                        foreach( $B86_s_featured_cat_slugs as $cat_key => $cat_value ){
                            $checked_cats[] = $cat_key;
                        }
                        $get_checked_cat_slugs = implode( ",", $checked_cats );
                        $B86_s_post_count = apply_filters( 'B86_s_slider_featured_posts_count', 2 );
                        $B86_s_slider_args = array(
                            'post_type'      => 'post',
                            'category_name'  => wp_kses_post( $get_checked_cat_slugs ),
                            'posts_per_page' => absint( $B86_s_post_count ),                            
                            'orderby'        => 'rand'
                        );
                        $B86_s_slider_query = new WP_Query( $B86_s_slider_args );
                        if( $B86_s_slider_query->have_posts() ) {
                            while( $B86_s_slider_query->have_posts() ) {
                                $B86_s_slider_query->the_post();
                                ?>
                                <div class="B86_s-single-post-wrap B86_s-clearfix">
                                    <div class="B86_s-single-post">
                                        <div class="B86_s-post-thumb">
                                            <?php
                                            if( has_post_thumbnail() ) {
                                                the_post_thumbnail( 'B86_s-featured-medium' );
                                            }
                                            ?>
                                        </div><!-- .B86_s-post-thumb -->
                                        <div class="B86_s-post-content">
                                            <h3 class="B86_s-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <a class="B86_s-read-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','B86_s');?></a>
                                        </div><!-- .B86_s-post-content -->
                                    </div> <!-- B86_s-single-post -->
                                </div><!-- .B86_s-single-post-wrap -->

                                <?php
                            }
                            wp_reset_postdata();
                        }
                        ?>
                    </div>
                </div><!-- .featured-posts -->
                <?php
            }
            ?>
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