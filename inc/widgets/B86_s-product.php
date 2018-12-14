<?php
/**
 * AT: Products Slider
 *
 * Widget show the woocommerce products.
 *
 * @package AquariusThemes
 * @subpackage B86_s
 * @since 1.0.0
 */

class B86_s_product extends WP_Widget {
/**
* Register Widget with Wordpress
* 
*/
public function __construct() {
  $widget_ops = array( 
    'classname' => 'B86_s_product',
    'description' => __( 'Slider with woocommerce products.', 'B86_s' )
  );
  parent::__construct( 'B86_s_product', __( 'AT: Product Slider', 'B86_s' ), $widget_ops );
}

/**
* Helper function that holds widget fields
* Array is used in update and form functions
*/
private function widget_fields() {

  $prod_type = array(
    'latest_product' => __('Latest Product', 'B86_s'),
    'category' => __('Category', 'B86_s'),
    'upsell_product' => __('UpSell Product', 'B86_s'),
    'feature_product' => __('Feature Product', 'B86_s'),
    'on_sale' => __('On Sale Product', 'B86_s'),
  );

  $fields = array(
    'product_title' => array(
      'B86_s_widgets_name' => 'product_title',
      'B86_s_widgets_title' => __('Title', 'B86_s'),
      'B86_s_widgets_field_type' => 'text',

    ),
    'product_type' => array(
      'B86_s_widgets_name' => 'product_type',
      'B86_s_widgets_title' => __('Select Product Type', 'B86_s'),
      'B86_s_widgets_field_type' => 'select',
      'B86_s_widgets_field_options' => $prod_type,
      'B86_s_widgets_field_class' => 'B86_s-type-wrap',
    ),
    'product_category' => array(
      'B86_s_widgets_name' => 'product_category',
      'B86_s_widgets_title' => __('Select Product Category', 'B86_s'),
      'B86_s_widgets_field_type' => 'select',
      'B86_s_widgets_field_options' => B86_s_woocommerce_categories_lists(),
      'B86_s_widgets_field_class' => 'B86_s-type-select',
    ),
    'product_number' => array(
      'B86_s_widgets_name' => 'product_number',
      'B86_s_widgets_title' => __('Select the number of Product to show', 'B86_s'),
      'B86_s_widgets_default'      => '2',
      'B86_s_widgets_field_type' => 'number',
    ),
    // 'product_size_type' => array(
    //   'B86_s_widgets_name' => 'product_size_type',
    //   'B86_s_widgets_title' => __('Product Slider Type', 'B86_s'),
    //   'B86_s_widgets_field_type' => 'select',
    //   'B86_s_widgets_field_options' => array('full-width'=>__('Full Width','B86_s'),
    //     'half-width'=>__('With Sidebar Form on Right','B86_s'),                                                    
    //   )
    // ),
  );
  return $fields;
}

public function widget($args, $instance){
  extract($args);

  if(!empty($instance)):
    $product_title = empty( $instance['product_title'] ) ? '' : $instance['product_title'];
    $product_size_type = empty( $instance['product_size_type'] ) ? 'full-width' : $instance['product_size_type'];
    $product_type = empty( $instance['product_type'] ) ? 'latest_product' : $instance['product_type'];
    $product_category = empty( $instance['product_category'] ) ? '' : $instance['product_category'];
    $product_number = empty( $instance['product_number'] ) ? '2' : $instance['product_number'];

    $product_args       =   '';
    if($product_type == 'category'){
      $product_args = array(
        'post_type' => 'product',
        'tax_query' => array(array('taxonomy'  => 'product_cat',
          'field'     => 'id', 
          'terms'     => $product_category                                                                 
        )),
        'posts_per_page' => $product_number
      );
    }
    elseif($product_type == 'latest_product'){
      $product_args = array(
        'post_type' => 'product',
        'posts_per_page' => $product_number
      );
    }
    elseif($product_type == 'upsell_product'){
      $product_args = array(
        'post_type'         => 'product',
        'meta_key'          => 'total_sales',
        'orderby'           => 'meta_value_num',
        'posts_per_page'    => $product_number
      );
    }
    elseif($product_type == 'feature_product'){

      $product_visibility_term_ids = wc_get_product_visibility_term_ids();
      $product_args = array(  
       'post_type' => 'product',  
       'posts_per_page' => $product_number,
       'meta_query'     => array(),
       'tax_query'      => array(
         'relation' => 'AND',
       ),
     ); 
      $product_args['tax_query'][] = array(
        'taxonomy' => 'product_visibility',
        'field'    => 'term_taxonomy_id',
        'terms'    => $product_visibility_term_ids['featured'],
      );
    }
    elseif($product_type == 'on_sale'){
      $product_args = array(
        'post_type'      => 'product',
        'meta_query'     => array(
          'relation' => 'OR',
          array(
            // Simple products type
            'key'           => '_sale_price',
            'value'         => 0,
            'compare'       => '>',
            'type'          => 'numeric'
          ),
          array(
            // Variable products type
            'key'           => '_min_variation_sale_price',
            'value'         => 0,
            'compare'       => '>',
            'type'          => 'numeric'
          )
        )
      );
    }

    ?>
    <?php echo wp_kses_post($before_widget); ?>
    <div class="product-wrapper">
      <?php 
      if( !empty( $product_title ) ) {
        echo wp_kses_post($before_title) . esc_html( $product_title ) . wp_kses_post($after_title);
      }
      ?>
      <div class="<?php echo 'prod-slider-'.esc_attr($product_size_type);?> clear">
        <div class="slider-<?php echo esc_attr($product_size_type);?>">
          <ul class="owl-carousel B86_s-product-slider">
            <?php
            $count=0;
            $product_loop = new WP_Query( $product_args );
            if ( $product_loop->have_posts() ) {
              while ( $product_loop->have_posts() ) {
                $product_loop->the_post(); 
                wc_get_template_part( 'content', 'product' );
              }
              wp_reset_postdata();
            }
            ?>
          </ul>
        </div>
        <?php
        // if($product_size_type=='half-width'){
        //   echo do_shortcode(get_theme_mod('B86_s_form_shortcode'));
        // }
        ?>
      </div>
    </div>
    <?php echo wp_kses_post($after_widget);?>
    <?php
  endif;
}

/**
* Sanitize widget form values as they are saved.
*
* @see WP_Widget::update()
*
* @param	array	$new_instance	Values just sent to be saved.
* @param	array	$old_instance	Previously saved values from database.
*
* @uses	B86_s_widgets_updated_field_value()		defined in widget-fields.php
*
* @return	array Updated safe values to be saved.
*/
public function update($new_instance, $old_instance) {
  $instance = $old_instance;

  $widget_fields = $this->widget_fields();
  foreach ($widget_fields as $widget_field) {
    extract($widget_field);
    $instance[$B86_s_widgets_name] = B86_s_widgets_updated_field_value($widget_field, $new_instance[$B86_s_widgets_name]);
  }

  return $instance;
}

/**
* Back-end widget form.
*
* @see WP_Widget::form()
*
* @param	array $instance Previously saved values from database.
*
* @uses	B86_s_widgets_show_widget_field()		defined in widget-fields.php
*/
public function form($instance) {
  $widget_fields = $this->widget_fields();
  foreach ($widget_fields as $widget_field) {
    extract($widget_field);
    $B86_s_widgets_field_value = !empty($instance[$B86_s_widgets_name]) ? esc_attr($instance[$B86_s_widgets_name]) : '';
    B86_s_widgets_show_widget_field($this, $widget_field, $B86_s_widgets_field_value);
  }
}
}